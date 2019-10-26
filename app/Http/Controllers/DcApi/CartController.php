<?php
namespace App\Http\Controllers\DcApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Models\DiancanCart;
use App\Models\DiancanProduct;
use App\Repos\DiancanUserRepo;
class CartController extends Controller
{
    
    public function index(ApiRequest $request)
    {
        $rs['status']       =  true;        
        $where['user_id']   = $request->user_id; 
        //dd($where);
        $rs['data'] = DiancanCart::where($where)->get();
        return response()->json($rs);

    }

    public function add(ApiRequest $request)
    {
        $rs['status'] = true;        
        $data            = $request->pure();
        $data['user_id'] = $request->user_id;

        $flag = DiancanUserRepo::checkMoney($data['user_id'],$data['product_id']);
        
        if($flag['status'] == false) {
            $rs['status'] = $flag['status'];
            $rs['msg']    = $flag['msg'];
            return response()->json($rs);
        }

        // 本次商品的价格
        $product = DiancanProduct::where(['id'=>$data['product_id']])
                                 ->first();

                             

        
        $dcWhere['user_id']    = $data['user_id'];
        $dcWhere['product_id'] = $data['product_id'];
        $dc = DiancanCart::where($dcWhere)->first(); 
        if($dc) {
            $dc->num +=1;
            $dc->subtotal +=  $product->price;
            $dc->save();
        } else {
            $data['shop_id']      = $product->shop_id;
            $data['price']        = $product->price;
            $data['product_name'] = $product->name; 
            $data['subtotal']     = $product->price*$data['num']; 
            $rs['data'] = DiancanCart::create($data); 
        }             
               
        return response()->json($rs);
    }

    public function del(ApiRequest $request)
    {
        $rs['status'] = true;
        $where['id']  = $request->id;       
        $rs['data']   = DiancanCart::where($where)->delete();        
        return response()->json($rs);
    }

    public function increase(ApiRequest $request)
    {
        $rs['status'] = true;
        $id  = $request->id;
        $cart = DiancanCart::find($id); 
        $flag = DiancanUserRepo::checkMoney($cart->user_id,$cart->product_id);
        if($flag['status'] == false) {
            $rs['status'] = $flag['status'];
            $rs['msg']    = $flag['msg'];
            return response()->json($rs);
        }
        
        $cart->num +=  1;
        $cart->subtotal += $cart->price;
        $cart->save();       
        return response()->json($rs);
    }

    public function decrease(ApiRequest $request)
    {
        $rs['status'] = true;
        $id  = $request->id;        
        $cart = DiancanCart::find($id); 
        if($cart->num==1) {
           DiancanCart::destroy($id);
           return response()->json($rs);
        }
        $cart->num -=  1;
        $cart->subtotal -= $cart->price;
        $cart->save();       
        return response()->json($rs);
    }

    public function delAll(ApiRequest $request)
    {
        $rs['status'] = true;
        $where['user_id']  = $request->user_id;       
        $rs['data']   = DiancanCart::where($where)->delete();        
        return response()->json($rs);
    }



    
}
