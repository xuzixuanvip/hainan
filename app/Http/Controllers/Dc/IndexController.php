<?php

namespace App\Http\Controllers\Dc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanUser;
use App\Models\DiancanOrder;
use App\Services\BaiduAi;
use App\Services\Wechat;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function matchFace(Request $request)
    {
        $rs['status'] = 'success';
        $rs['msg']    = '人脸比对失败';
        $where=[];
       
        if ($request->hasFile('pic')) {           
            $filename = $request->user_id.'.'.$request->pic->extension();
            $request->pic->storeAs('public/pic',$filename);     
            $pic  = 'storage/pic/'.$filename; 
        }
        $where['id'] = $request->user_id;
        $user = DiancanUser::where($where)->first();
        
        $avatar = ltrim($user->avatar,'/');
        $data = DiancanOrder::find($request->order_id);
        $res = BaiduAi::faceMatch($user->avatar,$pic);
        if($res['status']==true && $res['score']>80) {
            $rs['status'] = 'success';
            $rs['msg'] = '人脸比对成功，相似度：'.$res['score'];
            if($data->status==1) {
                $data->status = 100;
                $data->completed_at = date('Y-m-d H:i:s');
                $data->save();

                DiancanUser::where(['id'=>$data->user_id])->decrement('money',$data->total_price);
                

                //推送用户
                // 推送
            
                if(object_get($data,'user.openid')){
                    $msg = $data->toArray();
                    $msg['openid'] = object_get($data,'user.openid');
                    $msg['time'] = date('Y-m-d H:i:s');
                    $msg['remark'] = '您的订单已完成,祝您用餐愉快';
                    $msg['url']  = config('app.url').'/diancan-h5/orderlist.html';
                    Wechat::sendMsgTpl('order_complete',$msg);    
                }    
            }
              
        }

        return view('dingcan.order.show',compact('data','rs'));
        
    }

    
}
