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

Route::get('/', function () {
    return view('welcome');
});

//平台
Route::domain('admin.com')->namespace('Admin')->group(function () {
    //店铺分类
    Route::get('shop_category/index',"ShopCategoryController@index")->name('shop_category.index');
    Route::any('shop_category/add',"ShopCategoryController@add")->name('shop_category.add');
    Route::any('shop_category/edit/{id}',"ShopCategoryController@edit")->name('shop_category.edit');
    Route::any('shop_category/del/{id}',"ShopCategoryController@del")->name('shop_category.del');

    //商家信息
    Route::get('shops/index',"ShopsController@index")->name('shops.index');
    Route::any('shops/add',"ShopsController@add")->name('shops.add');
    Route::any('shops/edit/{id}',"ShopsController@edit")->name('shops.edit');
    Route::any('shops/del/{id}',"ShopsController@del")->name('shops.del');
    });


//商户
Route::domain('shop.com')->namespace('Shop')->group(function () {
    Route::any('admin/reg',"AdminController@reg")->name('admin.reg');
    Route::any('admin/login',"AdminController@login")->name('admin.login');
    Route::any('admin/index',"AdminController@index")->name('admin.index');
    Route::any('admin/edit/{id}',"AdminController@edit")->name('admin.edit');
    Route::any('admin/del/{id}',"AdminController@del")->name('admin.del');
    Route::any('admin/logout',"AdminController@logout")->name('admin.logout');
});