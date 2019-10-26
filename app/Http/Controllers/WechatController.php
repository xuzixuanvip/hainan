<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\Media;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use EasyWeChat\Kernel\Messages\Article;
use Log;
use App\Models\DiancanUser;
use EasyWeChat;

class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        //dd($app);
        $app->server->push(function($message){
         
            //return "欢迎关注!业务问题请加微信 bzs1984 咨询，谢谢。";        
           return env('WELCOME_MSG', '欢迎关注!');
            
        });

        return $app->server->serve();
    }

   

    
    public function login(Request $request)
    {
        $wechat_user =  session('wechat.oauth_user.default');
        //dd($wechat_user);
        $openid = $wechat_user->id;
        $where['openid'] = $openid;
        $user = DiancanUser::where($where)->first();
        if($user) {
            return redirect('diancan-h5/index.html?code='.$user->token);
        }
        return redirect('diancan-h5/login.html');
    }

    public function getToken(Request $request)
    {
        $rs['status'] = false;
        $code = trim($request->code);
        $mini = EasyWeChat::miniProgram(); // 小程序
        $result = $mini->auth->session($code); // $code 为wx.login里的code
        if(!array_key_exists('openid', $result)) {
            $rs['msg'] = $result['errmsg'];
            return response()->json($rs);
        }
        
        $rs['status'] = true;
        

        $user = UserRepo::find(['openid'=>$result['openid']]);
        if($user) {
            $rs['data']['token']   = $user->remember_token;
            $rs['data']['user_id'] = $user->id;
            return response()->json($rs);
        }

        $data = array_only($request->all(),['longitude','latitude','avatar','nickname']);
        $data['small_openid'] = $result['openid'];
        $user =UserRepo::create($data);
        $rs['data']['token']   = $user->remember_token;
        $rs['data']['user_id'] = $user->id;
        return response()->json($rs);   
    }

   


    
}
