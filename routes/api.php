<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//商家列表
Route::namespace('Api')->group(function (){
    //得到商家列表接口
    Route::get('shop/list','ShopController@list');
    //得到商家信息接口
    Route::get('shop/index','ShopController@index');

    //会员注册接口
    Route::post('member/reg','MemberController@reg');
//发送短信验证接口
    Route::any('member/sms','MemberController@sms');
//会员登录接口
    Route::any('member/login','MemberController@login');
//重置密码接口
    Route::any('member/forget','MemberController@forget');
//修改密码接口
    Route::any('member/changePassword','MemberController@changePassword');

    //添加地址接口
    Route::any('addresse/add','AddresseController@add');
    //地址列表接口
    Route::get('addresse/list','AddresseController@list');
    //修改地址接口
    Route::post('addresse/edit','AddresseController@edit');
    //保存购物车接口
    Route::any('addCart/add','CartController@add');
    Route::any('addCart/cart','CartController@cart');

});




