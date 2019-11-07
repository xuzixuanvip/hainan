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

//服务信息
Route::middleware('web')->namespace('Dc')->prefix('shop')->group(function(){

    Route::post('match-face','IndexController@matchFace');
	Route::get('login',      'LoginController@index');
    Route::get('wx-login',   'LoginController@wxLogin');
    Route::any('dologin',    'LoginController@doLogin')->middleware(['wechat.oauth:snsapi_userinfo']);
    Route::get('logout',     'LoginController@logout');
    Route::get('orders/show','OrderController@show');
    
    Route::middleware(['wechat.oauth:snsapi_userinfo','checkShopAdmin'])->group(function(){
        
        Route::post('shop-update', 'ShopController@update');
        Route::get('products/repeat/{id}','ProductController@repeat'); 
        Route::get('products/change-status','ProductController@changeStatus'); 
        Route::resource('products','ProductController'); 
        Route::resource('cates',   'ProductCateController');   
        Route::resource('users',      'AdminUserController');
        Route::resource('shopusers',  'DiancanShopUserController');
        
        Route::get('orders',     'OrderController@index');

        Route::get('home',         'ShopController@home');
        Route::get('/',         'ShopController@home');
    });

    

});

Route::namespace('DcApi')->prefix('api')->group(function(
    ){
    

    Route::middleware(['wechat.oauth:snsapi_userinfo'])->group(function(
    ){
        
       
    });

     Route::any('login-do', 'IndexController@logDo');
    

    Route::middleware(['cors'])->group(function(
    ){
        Route::post('upload',    'IndexController@upload');
    Route::get('reset-money','IndexController@resetMoney');
        // 人脸比对
        Route::post('face-match',   'IndexController@faceMatch');
        Route::post('notice',   'IndexController@notice');
        Route::post('shop/list','ShopController@index');
        Route::post('shop/info','ShopController@info');

        Route::post('product/list','ProductController@index');
        Route::post('product/cate','ProductController@cate');
        Route::post('product/type','ProductController@type');

        Route::post('user/info','AdminUserController@info');

        Route::post('user/update','AdminUserController@update');

        Route::prefix('cart')->group(function(){
            Route::post('add',     'CartController@add');
            Route::post('list',    'CartController@index');
            Route::post('del',     'CartController@del');
            Route::post('increase','CartController@increase');
            Route::post('decrease','CartController@decrease');
            Route::post('del-all', 'CartController@delAll');
        });

        Route::prefix('order')->group(function(){
            Route::post('add',     'OrderController@add');
            Route::post('list',    'OrderController@index');
            Route::any('complete', 'OrderController@complete');
            Route::post('repeat',  'OrderController@repeat');
            Route::post('confirm-complete','OrderController@confirmComplete');
        });
    });   



});










