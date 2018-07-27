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
    Route::get('shop_category/index', "ShopCategoryController@index")->name('shop_category.index');
    Route::any('shop_category/add', "ShopCategoryController@add")->name('shop_category.add');
    Route::any('shop_category/edit/{id}', "ShopCategoryController@edit")->name('shop_category.edit');
    Route::any('shop_category/del/{id}', "ShopCategoryController@del")->name('shop_category.del');

    //商家信息
    Route::get('shops/index', "ShopsController@index")->name('shops.index');
    Route::any('shops/add', "ShopsController@add")->name('shops.add');
    Route::any('shops/edit/{id}', "ShopsController@edit")->name('shops.edit');
    Route::any('shops/del/{id}', "ShopsController@del")->name('shops.del');
    Route::any('shops/on/{id}', "ShopsController@on")->name('shops.on');
    Route::any('shops/off/{id}', "ShopsController@off")->name('shops.off');

    //admin表
    Route::any('admin/reg', "AdminController@reg")->name('admin.reg');
    Route::any('admin/login', "AdminController@login")->name('admin.login');
    Route::any('admin/index', "AdminController@index")->name('admin.index');
    Route::any('admin/edit/{id}', "AdminController@edit")->name('admin.edit');
    Route::any('admin/del/{id}', "AdminController@del")->name('admin.del');
    Route::any('admin/logout', "AdminController@logout")->name('admin.logout');

    //活动管理
    Route::any('activity/index', "ActivityController@index")->name('activity.index');
    Route::any('activity/add', "ActivityController@add")->name('activity.add');
    Route::any('activity/edit/{id}', "ActivityController@edit")->name('activity.edit');
    Route::any('activity/del{id}', "ActivityController@del")->name('activity.del');

});


//商户
Route::domain('shop.com')->namespace('Shop')->group(function () {

    //user表
    Route::any('user/reg', "UserController@reg")->name('user.reg');
    Route::any('user/login', "UserController@login")->name('user.login');
    Route::any('user/index', "UserController@index")->name('user.index');
    Route::any('user/edit/{id}', "UserController@edit")->name('user.edit');
    Route::any('user/del/{id}', "UserController@del")->name('user.del');
    Route::any('user/logout', "UserController@logout")->name('user.logout');

    //菜品分类表 menu_categories
    Route::any('menu_cate/index', "MenuCategoryController@index")->name('menu_cate.index');
    Route::any('menu_cate/add', "MenuCategoryController@add")->name('menu_cate.add');
    Route::any('menu_cate/edit/{id}', "MenuCategoryController@edit")->name('menu_cate.edit');
    Route::any('menu_cate/del/{id}', "MenuCategoryController@del")->name('menu_cate.del');

//菜品信息表 menu
    Route::any('menu/index', "MenuController@index")->name('menu.index');
    Route::any('menu/add', "MenuController@add")->name('menu.add');
    Route::any('menu/edit/{id}', "MenuController@edit")->name('menu.edit');
    Route::any('menu/del/{id}', "MenuController@del")->name('menu.del');

//活动
    Route::any('activity/show', "ActivityController@show")->name('activity.show');

});

