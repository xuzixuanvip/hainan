<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Wechat;

use App\Repos\WxtplRepo;

class MsgtplController extends Controller
{
    public function index()
    {
    	
		$list = WxtplRepo::getPages();
        //dd($list);
    	return view('admin.msgtpl.index',compact('list'));
    }

    public function all()
    {
        
        $list = Wechat::getMsgtpl();
        //dd($list);
        return view('admin.msgtpl.all',compact('list'));
    }

    public function show($tpl_key)
    {
    	$tpls = Wechat::getMsgtpl();
    	$data = $tpls[$tpl_key];
    	//dd($data);
    	return response()->json($data);
    	// return view('admin.msgtpl.show');
    }

    /**
     * 导入模板
     */
    public function import()
    {
        $list = Wechat::getMsgtpl();
        //dd($list);
        $flag = [];
        foreach ($list as $k => $v) {
            //dd($v);
            $contents  = preg_replace("/\{\{|\}\}|\.DATA/","",$v['content']);

            
            $contents = preg_split('/\r\n|\r|\n/',$contents); 
           
            //去掉所有换行符
            
            $keys = $remarks =  [];
            foreach ($contents as $key => $value) {
                $k = explode('：', $value);
                if(isset($k[1])) {
                    array_push($keys, $k[1]);    
                } else 
                {
                    array_push($keys, $k[0]); 
                }
                
                array_push($remarks, $k[0]);

            }


            $tpl = WxtplRepo::find(['template_id'=>$v['template_id']]);
            if(!$tpl){               
            
                $data = array_only($v,['template_id','title','example']);
                $data['industry'] = $v['primary_industry'].'-'.$v['deputy_industry'];
                $flag =WxtplRepo::create($data,$keys,$remarks);
            }            
        }
        if(array_get($flag,'status')===false) {
            $rs['status'] = 'warning';
            $rs['msg'] = $flag['msg'];
            return back()->with('rs',$rs);
        }
        return back();
    }

    public function edit($id)
    {
        $data = WxtplRepo::find(['id'=>$id]);    
        //dd($data);
        $contents = $data->contents;
        return view('admin.msgtpl.edit',compact('data','contents'));
    }

    public function save(Request $request)
    {
        $rs['status'] = 'warning';
        try {
            $data = $request->except(['_token']);
           
            WxtplRepo::update($data);
             
               
        } catch (\Exception $e) {
            $rs['msg'] = $e->getMessage();
            return back()->with('rs',$rs);
        }
        
        $rs['status'] = 'success';
        $rs['msg'] = '操作成功';
        return back()->with('rs',$rs);       

    }

    public function del($templateId)
    {
        $rs['status'] = 'warning';
        $rs['msg'] = '操作失败';
        $flag = Wechat::delMsgtpl($templateId);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return back()->with('rs',$rs);
        }
        return back()->with('rs',$rs);
    }


}
