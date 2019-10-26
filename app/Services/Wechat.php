<?php
namespace App\Services;

use Cache,Log;
use App\Repos\WxtplRepo;

class Wechat
{
	/**
     * 推送模板消息 
     */
    public static function sendMsgTpl($code,$data)
    {
        $tpl  = WxtplRepo::find(['code'=>$code]);
        if($tpl) {
            $arr  = WxtplRepo::getContents($tpl->id,$data);
            $msg  = [
                        'touser' => $data['openid'],
                        'template_id' => $tpl->template_id,
                        'url'  => $data['url'],
                        'data' => $arr,
                    ];
            $app = app('wechat.official_account');
            $rs = $app->template_message->send($msg);   
            Log::info('消息模板'.$code.'结果：'.json_encode($rs)); 
        }
        
    }

    public static function getUserInfo($openid)
    {
        $app = app('wechat.official_account');
        $userInfo = $app->user->get($openid);
        $data['nickname']   = array_get($userInfo,'nickname');
        $data['headimgurl'] = array_get($userInfo,'headimgurl');
        return $data;
    } 

    public static function getMsgtpl()
    {
        if (Cache::has('msgTpl')) {

            $list = Cache::get('msgTpl'); 
        } else {
            $app = app('wechat.official_account');
            $list = $app->template_message->getPrivateTemplates()['template_list'];
            $expiresAt = now()->addMinutes(10);
            Cache::put('msgTpl',$list,$expiresAt); 
        }       
        
        return $list;
    } 

    /**
     * 删除模板
     */
    public static function delMsgtpl($templateId)
    {
        
        WxtplRepo::delete($templateId);
        $app = app('wechat.official_account');
        $rs = $app->template_message->deletePrivateTemplate($templateId);
        if($rs['errmsg']=='ok') {
           Cache::forget('msgTpl'); 
           return true;
        }
        return false;
        
        
    }

    public static function getMenu()
    {
        if (Cache::has('wxMenu')) {
            $list = Cache::get('wxMenu');
        } else {
            $app = app('wechat.official_account');
            $list = $app->menu->list()['menu']; 
            $expiresAt = now()->addMinutes(10);
            Cache::put('wxMenu',$list,$expiresAt);    
        }

        return $list;
       
    }

    public static function getUser()
    {
        $app = app('wechat.official_account');
        $users = $app->user->list();
      $openid_arr = array_chunk($users['data']['openid'],50);
   // dd($openid_arr);
      $ou = [];
        foreach($openid_arr as $oa) {
          
          $users = $app->user->select($oa);
         // dd($users['user_info_list']);
          array_push($ou,$users['user_info_list']);
        }
      
        return array_collapse($ou);;
    }


}
?>