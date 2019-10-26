<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Yly;
use App\Models\DiancanOrder;
use App\Models\Task;
use DB;

class YlyController extends Controller
{
    public function index(Request $request)
    {
    	
		$yly = new Yly();
		$order = Task::where('id',38)->first();
		$shopPrinter = DB::table('task_printer')->first();
		$yly->task($order,$shopPrinter);

		// $order = DiancanOrder::where('id',468)->first();
		// $shopPrinter = DB::table('diancan_shop_printer')->where('shop_id',20)->first();
		// $yly->index($order,$shopPrinter);
		
    }
}
