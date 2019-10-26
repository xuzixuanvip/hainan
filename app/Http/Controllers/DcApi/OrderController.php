<?php
namespace App\Http\Controllers\DcApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Models\DiancanOrder;
use App\Models\DiancanCart;
use App\Models\DiancanShopUser;
use App\Models\DiancanUser;
use App\Models\DiancanOrderProduct;
use App\Services\Wechat;
use App\Services\Yly;
use DB,Log;

class OrderController extends Controller
{
    
    public function index(ApiRequest $request)
    {
        $rs['status']       =  true;        
        $where['user_id']   = $request->user_id; 
        if($request->status) {
            $where['status'] = $request->status;
        }       
        $rs['data'] = DiancanOrder::with(['shop'])
                        ->where($where)
                        ->orderBy('created_at','desc')
                        ->get();
        return response()->json($rs);

    }

    public function add(ApiRequest $request)
    {
        $rs['status'] = true;        
        
        $data['user_id'] = $request->user_id;
        $cart_ids = explode(',', $request->cart_ids); 
        $carts = DiancanCart::whereIn('id',$cart_ids)->get();
        $data['total_price'] = $carts->sum('subtotal');

        // 判断订单总额是否大于可用额度
        $user = DiancanUser::find($request->user_id);
        if($user->money<$data['total_price']) {
            $rs['msg']    = '无法订餐 超过当日额度';
            $rs['status'] = false;
            return response()->json($rs);
        }
        $data['shop_id']     = $carts->first()->shop_id;
        $data['status']      = 1;
        $data['code']        = $data['user_id'].date('YmdHis').$data['shop_id'];
        $data['remark'] = $request->remark;
        $total = DiancanOrder::where(['shop_id'=>$data['shop_id']])->count();
        $data['serial_num'] = $total+1;
        $order = DiancanOrder::create($data);
        foreach ($carts as $k => $v) {
            $op['order_id']    = $order->id;
            $op['product_id']  = $v->product_id;
            $op['product_num'] = $v->num;
            $op['product_price'] = $v->price;
            $op['subtotal']    = $v->subtotal;
            DiancanOrderProduct::create($op);
        }
        DiancanCart::whereIn('id',$cart_ids)->delete();  

        // 推送
        $suWhere['shop_id'] = $order->shop_id;
        //$suWhere['rank'] = 100;    
        $users = DiancanShopUser::where($suWhere)->get(); 
        foreach ($users as $k => $v) {
            if($v->openid == '') continue; 
            $msg = $order->toArray();
            $msg['openid'] = $v->openid;
            $msg['name'] = object_get($order,'user.name');
            $msg['url']  = config('app.url').'/diancan/shop/orders/show?code='.$order->code;
            Wechat::sendMsgTpl('new_order_to_shop',$msg);     
        }   

        // 推送给点餐用户
        if($user->openid) {
            $msg = $order->toArray();
            $msg['openid'] = $user->openid;
            $msg['contents'] = object_get($order,'shop.name');
            $msg['type'] = '职工点餐';
            $msg['url']  = config('app.url').'/diancan-h5/personalCenter_order.html';
            Wechat::sendMsgTpl('new_order_to_user',$msg);       
        }

        // 打印
        try {
            $printer = DB::table('diancan_shop_printer')
                    ->where(['shop_id'=>$data['shop_id']])
                    ->first();
            if($printer) {
                Log::info('打印小票:'.$data['shop_id']);
                $yly = new Yly();
                $yly->index($order,$printer);    
            }        
        } catch (\Exception $e) {
            Log::info('打印出错'.$e->getMessage());
        }
                
        
    
        return response()->json($rs);
    }

    public function repeat(ApiRequest $request) 
    {
        $rs['status'] = true;
        $where['user_id'] = $request->user_id;
        $where['id']      = $request->order_id;
        $order = DiancanOrder::where($where)->first();
        if($order) {
            $arr = $order->toArray();
            $data = array_only($arr,['shop_id','user_id','total_price']);
            $data['status']      = 1;
            $data['code']        = $data['user_id'].date('YmdHis').$data['shop_id'];
            $new_order = DiancanOrder::create($data);
            $ops = DiancanOrderProduct::where('order_id',$order->id)
                                        ->get();
            foreach ($ops as $k => $v) {
                $op  = array_except($v->toArray(),['id','created_at','updated_at']);
                $op['order_id'] = $new_order->id;
                DiancanOrderProduct::create($op);
            }
        }else {
            $rs['status'] = false;
            $rs['msg'] = '订单错误';
            return response()->json($rs);
        }

        return response()->json($rs);
    }

    public function complete(ApiRequest $request)
    {
        $rs['status'] = false;
        $where['code']    = $request->code;
        $where['user_id'] = $request->user_id;
        $order = DiancanOrder::where($where)->first();
        if($order) {
            if($order->status==1) {
                $order->status = 100;
                $order->completed_at = date('Y-m-d H:i:s');
                $order->save();

                DiancanUser::where(['id'=>$order->user_id])->decrement('money',$order->total_price);
                

                //推送用户
                // 推送
            
                if(object_get($order,'user.openid')){
                    $msg = $order->toArray();
                    $msg['openid'] = object_get($order,'user.openid');
                    $msg['time'] = date('Y-m-d H:i:s');
                    $msg['remark'] = '您的订单已完成,祝您用餐愉快';
                    $msg['url']  = config('app.url').'/diancan-h5/orderlist.html';
                    Wechat::sendMsgTpl('order_complete',$msg);    
                }    
            }
            $rs['status'] = true;
            return redirect('/diancan/shop/orders/show?code='.$order->code);
        }
        $rs['msg'] = '订单错误';
        return response()->json($rs);
    }


    // 用户确认完成
    public function confirmComplete(ApiRequest $request)
    {
        $rs['status'] = false;
        $where['code']    = $request->code;        
        $order = DiancanOrder::where($where)->first();
        if($order) {
            if($order->status==1) {
                $order->status = 100;
                $order->completed_at = date('Y-m-d H:i:s');
                $order->save();

                DiancanUser::where(['id'=>$order->user_id])->decrement('money',$order->total_price);
                

                //推送用户
                // 推送
            
                if(object_get($order,'user.openid')){
                    $msg = $order->toArray();
                    $msg['openid'] = object_get($order,'user.openid');
                    $msg['time'] = date('Y-m-d H:i:s');
                    $msg['remark'] = '您的订单已完成,祝您用餐愉快';
                    $msg['url']  = config('app.url').'/diancan-h5/orderlist.html';
                    Wechat::sendMsgTpl('order_complete',$msg);    
                }    
            }
            $rs['status'] = true;
            $rs['msg'] = '操作成功';
            return response()->json($rs);
        }
        $rs['msg'] = '订单错误';
        return response()->json($rs);
    }

    

   

    
}
