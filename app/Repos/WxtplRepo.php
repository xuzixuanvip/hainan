<?php
namespace App\Repos;

use App\Models\Wxtpl;
use App\Models\WxtplContent;
use DB;

class WxtplRepo
{
    public static function find($where)
    {
        return Wxtpl::where($where)->first();
    }

    public static function getPages($where=[],$num=20)
    {
        $list = Wxtpl::where($where)->paginate($num);
        return $list;
    }
    
    public static function create($data,$keys,$remarks)
    {
        $rs['status'] = true;
        
        DB::beginTransaction();
        try {
            $wxtpl = Wxtpl::create($data);
            foreach ($keys as $k => $v) {
                $content['wxtpl_id'] = $wxtpl->id;
                $content['key']    = $v;
                //$content['value']  = $v;
                $content['remark'] = array_get($remarks,$k);
                WxtplContent::create($content);
            }

            DB::commit();   
        } catch (\Exception $e) {
             DB::rollBack();
             $rs['status'] = true;
             $rs['msg'] = $e->getMessage(); 
             return $rs;
        }
       
        return $rs;  
    }

    public static function update($data)
    {
        $rs['status'] = true;
        DB::beginTransaction();

        try {
            Wxtpl::where(['id'=>$data['id']])
                    ->update(['code'=>$data['code']]);
            WxtplContent::where(['wxtpl_id'=>$data['id']])->delete();
            $keys    = $data['key'];
            $remarks = $data['remark'];
            $colors  =  $data['color'];
            $default = $data['default']; // 默认值
           
            foreach ($keys as $k => $v) {

                $content['wxtpl_id'] = $data['id'];
                $content['key']    = $k;
                $content['value']  = $v;
                $content['remark'] = array_get($remarks,$k);
                $content['color']  = array_get($colors,$k);
                $content['default_value'] = array_get($default,$k);
                //dd($content);
                WxtplContent::create($content);
            } 
            DB::commit();           
        } catch (\Exception $e) {
            DB::rollBack();
            $rs['status'] = false;
            $rs['msg'] = $e->getMessage();
            //dd($rs);
            return $rs;
        }
        
        return $rs; 
    }

    public static function getContents($tpl_id,$data)
    {

        $arr = [];
        $list = WxtplContent::where(['wxtpl_id'=>$tpl_id])->get();
        foreach ($list as $k => $v) {
            if($v->default_value) {
                $value = $v->default_value;
            } else {
                $value = array_get($data,$v->value);
            }
            
            $arr[$v->key] = [$value,$v->color];
        }
        return $arr;
    }

    public static function delete($templateId)
    {
        $flag = Wxtpl::where(['template_id'=>$templateId])->first();
        if($flag) {
            WxtplContent::where(['wxtpl_id'=>$flag->id])->delete();
        }
        $flag->delete();
        return true;

    }

    

	
}