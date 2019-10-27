<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('yly','YlyController@index');
Route::get('ai-test','IndexController@AiTest');
Route::get('test',   'IndexController@test');
Route::any('wechat',   		 'WechatController@serve');
Route::get('wechat/login',   'WechatController@login')->middleware(['wechat.oauth']);
Route::any('create-menu',    'WechatController@createMenu');

Route::any('upload','UploadController@upload');
//服务信息
Route::prefix('info')->group(function(){
	Route::get('notice',   'IndexController@notice');
	Route::get('notice-show/{id}','IndexController@noticeShow');
 	Route::get('worklog',  'IndexController@worklog');
 	Route::get('worker',   'IndexController@worker');
});



Route::get('logout',   'LoginController@logOut');


Route::middleware(['wechat.oauth'])->group(function(){
	Route::get('login',    'LoginController@login');
 	Route::any('logindo', 'LoginController@loginDo');
});


Route::middleware(['web','wechat.oauth:snsapi_userinfo'])->prefix('user')->namespace('User')->group(function(){
//Route::middleware(['web','checkUser','wechat.oauth'])->prefix('user')->namespace('User')->group(function(){

	
	// 留言板	
	Route::get('message',	     'MessageController@index');
	Route::get('message/new',	 'MessageController@new');
	Route::post('message/save',	 'MessageController@save');

	// 意见箱
	Route::get('yijian',	 	'MessageController@yijian');
    Route::post('yijian-save',	'MessageController@yijianSave');	

    // 求救
   
    Route::get('emergency/send-msg' ,'EmergencyController@senMessage');
    Route::get('emergency/index' ,   'EmergencyController@index');
    Route::get('emergency/test' ,    'EmergencyController@test');
	Route::prefix('task')->group(function(){
		
		Route::get('create', 	 'TaskController@create');
		Route::post('save',  	 'TaskController@save');
		Route::any('complete',	 'TaskController@complete');
		Route::get('show/{id}',  'TaskController@show');
		Route::get('edit/{id}',  'TaskController@edit');

		Route::post('update',     'TaskController@update');
		Route::any('reply',       'TaskController@reply');
		Route::any('process',       'TaskController@process');
		Route::any('process-price', 'TaskController@processPrice');	
		Route::get('price-detail/{id}',  'TaskController@priceDetail');		
		Route::any('price-confirmed','TaskController@priceConfirmed');
		
		// 报修任务完成		
		Route::any('process-complete','TaskController@processComplete');

		Route::any('comment',       'TaskController@comment');
		Route::any('refund',      'TaskController@refund');
		Route::any('/',		      'TaskController@index');	
	});
	
	Route::get('/',        'IndexController@index');
});

Route::prefix('zadmin')->namespace('Admin')->group(function(){
	Route::middleware('checkAdmin')->group(function(){
		Route::namespace('Diancan')->prefix('diancan')->group(function(){
			
		});
		Route::get('test','IndexController@test');
		Route::get('system-info','SystemController@info');
		Route::get('system-update','SystemController@update');
		Route::prefix('task')->group(function(){
			Route::get('edit/{id}',  'TaskController@edit');
			Route::get('show/{id}',  'TaskController@show');
			Route::get('print/{id}',  'TaskController@print');
			Route::get('check/{id}', 'TaskController@check');
			Route::any('complete',	'TaskController@complete');
			Route::get('add',        'TaskController@add');
			Route::post('save',      'TaskController@save');
			Route::post('update',      'TaskController@update');
			Route::get('buyer-task/{task_id}',   'TaskController@buyerTask');
			Route::get('del/{id}',   'TaskController@del');

			// 导出
			Route::get('export','TaskController@taskExport');
			
			// 回复任务
			Route::any('reply', 'TaskController@reply');


			Route::get('/','TaskController@index');
		});

		
		Route::resource('admins',     'AdminController');
		Route::resource('users',      'UserController');
		Route::resource('roles',      'RoleController');
		Route::resource('menus',      'MenuController');
		Route::resource('depart',     'DepartController');
		Route::resource('services',   'ServiceController');
		Route::resource('articles',   'ArticleController');
		Route::resource('message',    'MessageController');
		Route::any('message/reply',  'MessageController@reply');
		Route::get('yijian',	  'MessageController@yijian');
		Route::resource('emergency',   'EmergencyController');
		Route::get('menus/permission/{menu_id}', 'MenuController@menuPermission');
		Route::resource('permissions', 'PermissionController');	
		Route::resource('category',   'CategoryController');	
		Route::resource('system','SystemController');
		//智能导诊-症状管理
		Route::resource('symptom','SymptomController');
		Route::post('symptom/bath-del','SymptomController@bathDel');
		//智能导诊-疾病管理
        Route::resource('disease','DiseaseController');
        Route::post('disease/bath-del','DiseaseController@bathDel');
        Route::resource('body','BodyController',['only'=>['index']]);// 身体部位管理












//        ---------------------------
		// 工种管理
		Route::resource('worktype',   'WorktypeController');	

		
		// 采购信息
		Route::resource('purchases',  'PurchaseController');

		// 出库
		Route::resource('outstock',  'OutstockController');

		Route::get('fee/change',  'FeeController@change');
		Route::get('fee/del',  'FeeController@del');
		Route::get('fee/month','FeeController@month');
		Route::resource('fee',  	'FeeController');		
		Route::resource('feetype',  'FeetypeController');
		Route::resource('yezhu',    'YezhuController');

		Route::get('outstock/del-goods/{id}','OutstockController@delGoods');
		Route::post('outstock/save-goods','OutstockController@saveGoods');
		Route::post('outstock/update-goods','OutstockController@updateGoods');
		Route::get('outstock/print/{id}',  'OutstockController@print');
		
		Route::resource('goods',     'GoodsController');
		Route::post('goods/bath-del','GoodsController@bathDel');
		Route::post('goods/import',  'GoodsController@import');
		Route::resource('goodscates','GoodsCateController');
		Route::resource('goodslogs', 'GoodsLogController');

		Route::prefix('wechat')->group(function(){
			Route::get('wxuser/pull',  'WxuserController@pull');
			Route::get('wxuser/import',  'WxuserController@import');
			Route::post('wxuser/save-user','WxuserController@saveToUser');
			Route::resource('wxuser',  'WxuserController');
			
			
			
			Route::get('msgtpl',     'MsgtplController@index');
			Route::get('msgtpl-show/{tpl_key}','MsgtplController@show');
			Route::get('msgtpl-edit/{tpl_key}','MsgtplController@edit');
			Route::post('msgtpl-save',         'MsgtplController@save');
			Route::get('msgtpl-del/{tpl_key}', 'MsgtplController@del');
			Route::get('msgtpl-import','MsgtplController@import');
			Route::get('msgtpl-all','MsgtplController@all');
			Route::get('menu','WxMenuController@index');

			// 素材管理
			Route::any('get-material','WxMaterialController@getMaterial');

			Route::get('material-downvideo','WxMaterialController@downVideo');

			// 发送消息到个人
			Route::any('send-msg','WxMsgController@sendMsg');
		});


		
		

		// 统计报表
		Route::prefix('census')->group(function(){
			Route::any('worker-count','CensusController@workerCount');
			Route::any('worker-count-export','CensusController@workerCountExport');
		});

		// 服务信息
		Route::resource('notice','NoticeController');
		Route::resource('worklog','WorklogController');
		Route::resource('worker','WorkerController');

		
		//退单 
		Route::post('refund','IndexController@refund');

		//派工
		Route::post('process','IndexController@process');

		Route::prefix('diancan')->group(function(){
			Route::resource('notice', 'DiancanNoticeController');
			Route::post('notice/update', 'DiancanNoticeController@update');
			Route::resource('shops', 'DiancanShopController');
			Route::resource('users', 'DiancanUserController');
			Route::get('products/repeat/{id}', 'DiancanProductController@repeat');
			Route::resource('products', 'DiancanProductController');
			Route::resource('orders','DiancanOrderController');
			Route::get('order-export','DiancanOrderController@orderExport');
			Route::resource('cates','DiancanProductCateController');
			Route::resource('shopusers','DiancanShopUserController');
			Route::resource('types','DiancanTypeController');

		});
		Route::get('diancan-orders','DiancanOrderController@index');

		//后台首页
		Route::get('/',		   'IndexController@index');
		
	});
	
		Route::get('login',    'LoginController@login');
		Route::post('logindo', 'LoginController@loginDo');
		Route::get('logout',   'LoginController@logOut');


		
	
});

// 公开的
Route::get('diancan-orders','DiancanOrderController@index');
Route::get('task-list',   'Admin\TaskPublicController@index');






