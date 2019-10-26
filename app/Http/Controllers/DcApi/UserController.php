<?php
namespace App\Http\Controllers\DcApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Models\DiancanUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function info(ApiRequest $request)
    {
        $rs['status']    = true;        
        $rs['data']       = $request->user;       
        return response()->json($rs);

    }

    public function update(ApiRequest $request)
    {
        $rs['status'] = true;
        $where['id']  = $request->user_id;
        $data = $request->pure();
        $rs['data'] = DiancanUser::where($where)->update($data);        
        return response()->json($rs);
    }

    
}
