<?php
namespace App\Helpers;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Response,Log;
use App\Models\Platform;
use App\Models\Area;
use App\Models\User;
use JPush\Client as JPush;
use App\Models\BuyerTask;
use App\Models\BuyerTaskLog;
use DB;

trait Common
{
    public function getPlatformCode($id)
    {
        return Platform::where('id',$id)->value('code');
    }

    public function getDistrict($parent_num=0)
    {
    	return Area::select('num','name')->where('parent_num',$parent_num)->get();    	
    }

    /**
    * 预约服务时间
    */
    public function serviceTime()
    {
        return [
                 '8:00-10:00',
                 '10:00-12:00',
                 '12:00-14:00',
                 '14:00-16:00',
                 '16:00-18:00',
                 '18:00-20:00',
                 '20:00-22:00',
                ];
    }

    public function taskStatus()
    {
    	$status['0']   = '审核中';
        $status['1']   = '进行中';
    	$status['2']   = '暂停';
    	$status['100'] = '已完成';
    	return $status;
    }

    public function commentPoint()
    {
        $point = [
                        '1'  =>'很差',
                        '2'  =>'较差',
                        '3'  =>'合格',
                        '4'  =>'较好',
                        '5'  =>'很好',
                        '0'  =>'没修好，要重来',
                    ];
        return $point;
    } 

    /**
     * 发送短信
     */
    public function sendsms($mobile,$username)
    {
        $ch = curl_init();

        /* 设置验证方式 */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8',
            'Content-Type:application/x-www-form-urlencoded', 'charset=utf-8'));
        /* 设置返回结果为流 */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* 设置超时时间*/
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        /* 设置通信方式 */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 云片代码
        $code = mt_rand(1000,9999);
        $text = $code.'(闲赚APP手机验证码，请完成验证)，如非本人操作，请忽略本短信';
        $apikey = config('app.smsAPI');
        $data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
        $json_data = $this->send($ch,$data);
        $array = json_decode($json_data,true);
        Log::info($json_data);
        curl_close($ch);
        if($array['code']==0) {
            $rs['status'] = true;
            $rs['data']   = $code;
            return $rs;
        } else {
            $rs['status'] = false;
            $rs['msg']    = $this->smsCode($array['code']);
            return $rs;
        }
        
    }

    private function send($ch,$data)
    {
        
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        $error  = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }

    public function batchSend($text, $mobile)
    {
        $ch = curl_init();

        /* 设置验证方式 */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8',
            'Content-Type:application/x-www-form-urlencoded', 'charset=utf-8'));
        /* 设置返回结果为流 */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* 设置超时时间*/
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        /* 设置通信方式 */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $apikey = config('app.smsAPI');
        $param  = [
                    'apikey' => 'c9c3eb615bfb5f75c059f22f79089714',
                    'mobile' => $mobile,
                    'text'   => $text,
                  ];
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/batch_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        $result = curl_exec($ch);
        $error  = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }

    // 语音短信
    public function voiceMsg($code, $mobile)
    {
        $ch = curl_init();

        /* 设置验证方式 */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8',
            'Content-Type:application/x-www-form-urlencoded', 'charset=utf-8'));
        /* 设置返回结果为流 */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* 设置超时时间*/
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        /* 设置通信方式 */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $apikey = config('app.smsAPI');
        $param  = [
                    'apikey' => 'c9c3eb615bfb5f75c059f22f79089714',
                    'mobile' => $mobile,
                    'code'   => $code,
                  ];
        curl_setopt ($ch, CURLOPT_URL, 'https://voice.yunpian.com/v2/voice/send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        $result = curl_exec($ch);
        $error  = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }

    private function checkErr($result,$error)
    {
        if ($result === false) {
            echo 'Curl error: ' . $error;
        } else {
            //echo '操作完成没有任何错误';
        }
    }

    /**
     * $mobile 手机号码,$type 1卖家 2买家
     */
    public function checkStauts($mobile,$type=2,$action='login')
    {
        $rs['status']    = false;
        $map['username'] = $mobile;
        $map['type']     = $type;
        $user = User::where($map)->first();
       
        if( $user && $action == 'reg' ) {
            $rs['msg']  = '手机号码已经注册过';
            return $rs;    
        } 

        if(!$user && $action=='login') {
            $rs['msg']  = '账号不存在';
            return $rs;       
        }

        if(object_get($user,'status')=== 0) {
            $rs['msg']  = '账号审核中，请耐心等待';
            return $rs;
        }



       
        $rs['status'] = true;
        return  $rs;
    }

    public function smsCode($code)
    {
        $msg[2] = '手机号码格式错误';
        $msg[3] = '发送短信失败请联系管理员';
        $msg[8] = '短信已发送，请不要重复点击';
        if (array_key_exists($code, $msg) ){
            return $msg[$code];
        }
        return '短信异常，请联系管理员';


    }

    public function jpushMsg($username,$title)
    {
        $app_key       = config('app.JP_appKey');
        $master_secret = config('app.JP_masterSecret');
        $client = new JPush($app_key, $master_secret);
        $pusher = $client->push();
        $pusher->setPlatform('android');
        $pusher->addAlias($username);
        //$pusher->addAllAudience();
        $pusher->setNotificationAlert($title);
        $flag = false;
        try {
            $flag = $pusher->send();
        } catch (\JPush\Exceptions\JPushException $e) {
            // try something else here
            Log::warning($e);
        }

        return $flag;
    }

   
           

    

    

}
?>