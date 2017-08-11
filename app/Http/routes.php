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
//后台路由
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
//    首页
    Route::get('/','AdminController@index');
//    商品分类
    Route::resource('cate','CateController');
//    商品
    Route::resource('good','GoodController');
});

//前台路由
Route::group(['prefix'=>'home','namespace'=>'Home'], function(){

    Route::get('/','IndexController@index');

});
