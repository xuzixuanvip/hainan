<?php
namespace App\Services;

use Illuminate\Support\Facades\Redis;
use App\Config\YlyConfig;
use App\Oauth\YlyOauthClient;
use App\Api\PrinterService;
use App\Api\PrintService;
use App\Api\PicturePrintService;
use Log;

class Yly
{
    public function index($order,$shop)
    {
		$print   = $this->init();
		if(!$print) return false;
		
		//58mm排版 排版指令详情请看 http://doc2.10ss.net/332006
		$content = "<FS><center>**#1 东湖分院**</center></FS>";
		$content .= '<audio>东湖分院订单 订餐人 '.object_get($order,'user.name').'</audio>';
		$content .= str_repeat('.', 32);		
		$content .= "<center>".object_get($order,'shop.name')."</center>";
		$content .= "订单时间:". date("Y-m-d H:i") . "\n";
		$content .= "订单编号:".$order->code."\n";
		$content .= "<FS>流水号： 【". $order->serial_num."】</FS>\n";
		$content .= str_repeat('*', 14) . "商品" . str_repeat("*", 14);
		$content .= "<table>";
		foreach($order->product as $p) {
			$content .= "<tr><td><FS>".object_get($p,'product.name')."</FS></td><td><FS>x".$p->product_num." 份</FS></td><td><FS>，￥".$p->subtotal."</FS></td></tr>";
		}
		$content .= "</table>";
		$content .= str_repeat('.', 32);
		// $content .= "<QR>这是二维码内容</QR>";
		$content .= "<FS>小计:￥".$order->total_price."</FS>\n";		
		$content .= str_repeat('*', 32);
		$content .= "<FS>订单总价:￥".$order->total_price."</FS> \n";
		$content .= "<FS>用户: ".object_get($order,'user.name')." </FS>\n";
		$content .= "<FS>电话: ".object_get($order,'user.mobile')." </FS>\n";	
		$content .= "<FS>地址: ".object_get($order,'user.department')."</FS> \n";
		$content .= "<FS>备注: ".$order->remark." </FS>\n";
		$content .= "<FB><center>**事务处理中心 65331563**</center></FB>";
		$data = $print->index($shop->client_code,$content,$order->code);
		//var_dump($data);
		return true;
		
    }

    public function task($task,$taskPrint)
    {
		$print   = $this->init();
		if(!$print) return false;
		
		//58mm排版 排版指令详情请看 http://doc2.10ss.net/332006
		$content = "<FS><center>**东湖分院**</center></FS>";
		$content .= '<audio>事务处理中心 兄弟们 来活咯 请听好 报障人 '.$task->customer_name .' 报障位置 '.object_get($task,'depart.name').' 请尽快赶赴现场处理</audio>';
		$content .= str_repeat('.', 32);		
		$content .= "<center>事务处理中心</center>";
		$content .= "<FS>报修人员: ".$task->customer_name . "</FS>\n";
		$content .= "<FS>联系方式: ".$task->mobile."</FS>\n";		
		$content .= "<FS>故障类型: ".object_get($task,'category.name')." </FS>\n";
		$content .= "<FS>故障地点: ".object_get($task,'depart.name')."</FS> \n";	
		$content .= "<FS>报障时间:". date("m-d H:i") . "</FS>\n";
		$content .= "<FS>说明备注: ".$task->content."</FS> \n";
		$content .= str_repeat('.', 32);
		$content .= "<FS>处理人员:  </FS>\n";
		$content .= "\n";
		$content .= "\n";
		$content .= "<FS>处理结果:  </FS>\n";
		$content .= "\n";
		$content .= "\n";
		$content .= "<FB><center>**事务处理中心 65331563**</center></FB>";
		$data = $print->index($taskPrint->client_code,$content,$task->code);
		//var_dump($data);
		return true;
		
    }

    private function init()
    {
    	$config = new YlyConfig('1094107717', '30c7cf79f03a6202e8eca66a221d94bc');
    	$client = new YlyOauthClient($config);

		// 先从缓存里取token
		$access_token = Redis::get('hainan:yly:access_token');
		//dd($access_token);
		if(!$access_token) {
			$token = null;
			try {
				$token = $client->getToken();	
			} catch (\Exception $e) {
				Log::info('获取易联云token失败：'.$e->getMessage());
			}
			
			if($token) {
				Redis::set('hainan:yly:access_token',$token->access_token,'EX', 86400);
				$access_token = $token->access_token;	
			}			
		}	
		
		if(!$access_token) {
			Log::info('获取易联云access_token失败');
			return false;		
		}
		
		try {
			$print = new PrintService($access_token, $config);		
		} catch (\Exception $e) {
			Log::info('打印机初始化失败:'.$e->getMessage());	
		}	
		
		return $print;
		
    }
}
