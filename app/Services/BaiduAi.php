<?php
namespace App\Services;

class BaiduAi
{
    /**
     * 发起http post请求(REST API), 并获取REST请求的结果
     * @param string $url
     * @param string $param
     * @return - http response body if succeeds, else false.
     */
    private static  function requestPost($url = '', $param = '')
    {
        if (empty($url) || empty($param)) {
            return false;
        }

        $postUrl = $url;
        $curlPost = $param;
        // 初始化curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $postUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // 要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // post提交方式
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        // 运行curl
        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

    public static function getToken()
    {
        $url = 'https://aip.baidubce.com/oauth/2.0/token';
        $post_data['grant_type']     = 'client_credentials';
        $post_data['client_id']      = 'uKpYUdSFzmyAXsmvRAG9Ebmn';
        $post_data['client_secret']  = 'oESOZARlzkq904MwzWF64Osl79A9wfMq';
        $o = "";
        foreach ( $post_data as $k => $v ) 
        {
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);
        
        $res = self::requestPost($url, $post_data);

        $rs = json_decode($res,true);
        return $rs['access_token'];
        
    }


    public static  function faceMatch($img1,$img2)
    {
        $rs['status'] = false;
        $token = self::getToken();       
        $base64_1 = self::imgToBase64($img1);
        $base64_2 = self::imgToBase64($img2);
        //dd($base64_1,$base64_2);
        $url = 'https://aip.baidubce.com/rest/2.0/face/v3/match?access_token=' . $token;
        $img1 = '';
        $img2 = '';
        $bodys = "[{\"image\":\"".$base64_1."\",\"image_type\":\"BASE64\",\"face_type\":\"LIVE\",\"quality_control\":\"LOW\",\"liveness_control\":\"HIGH\"},{\"image\":\"".$base64_2."\",\"image_type\":\"BASE64\",\"face_type\":\"LIVE\",\"quality_control\":\"LOW\",\"liveness_control\":\"HIGH\"}]";
        $res = self::requestPost($url, $bodys);

        $rs = json_decode($res,true);
        if($rs['error_code']==0) {
            $rs['status'] = true;
            $rs['score'] = array_get($rs,'result.score');
            return $rs;
        }
        $rs['msg'] = '人脸比对失败';
    }

    public static function  imgToBase64($img)
    {

        $path = $img;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
       // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $base64 = base64_encode($data);
        return $base64;
    }


}

