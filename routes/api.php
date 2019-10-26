<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CheckApiBuyer;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::namespace('Api')->group(function(){	
	Route::get('depart',  'DepartController@index');	
	Route::middleware('auth:api')->group(function(){

	});
	
});
