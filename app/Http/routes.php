<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});



// 前台路由组
Route::group(['prefix'=>'home','namespace'=>'Home'], function(){
    //  前台首页页面路由
    Route::get('index','FirstController@index');
});
