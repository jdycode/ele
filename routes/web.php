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

//管理员平台
Route::domain('admin.com')->namespace('Admin')->group(function () {
    //店铺分类
    Route::get('shop_category/index', "ShopCategoryController@index")->name('shop_category.index');
    Route::any('shop_category/add', "ShopCategoryController@add")->name('shop_category.add');
    Route::any('shop_category/edit/{id}', "ShopCategoryController@edit")->name('shop_category.edit');
    Route::any('shop_category/del/{id}', "ShopCategoryController@del")->name('shop_category.del');

//    //测试
//    Route::get('/mail', function () {
//        $order =\App\Models\Order::find(26);
//
//        return new \App\Mail\OrderShipped($order);
//    });
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

    //角色
    Route::any('role/index', "RoleController@index")->name('role.index');
    Route::any('role/add', "RoleController@add")->name('role.add');
    Route::any('role/edit/{id}', "RoleController@edit")->name('role.edit');
    Route::any('role/del/{id}', "RoleController@del")->name('role.del');

    //权限
    Route::any('per/index', "PerController@index")->name('per.index');
    Route::any('per/add', "PerController@add")->name('per.add');
    Route::any('per/edit/{id}', "PerController@edit")->name('per.edit');
    Route::any('per/del/{id}', "PerController@del")->name('per.del');

    //导航设置nav
    Route::any('nav/index', "NavController@index")->name('nav.index');
    Route::any('nav/add', "NavController@add")->name('nav.add');
    Route::any('nav/del/{id}', "NavController@del")->name('nav.del');

    //会员表
    Route::any('member/index', "MemberController@index")->name('member.index');
    Route::any('member/add', "MemberController@add")->name('member.add');
    Route::any('member/edit/{id}', "MemberController@edit")->name('member.edit');
    Route::any('member/del/{id}', "MemberController@del")->name('member.del');

    //活动管理
    Route::any('event/index', "EventController@index")->name('event.index');
    Route::any('event/add', "EventController@add")->name('event.add');
    Route::any('event/edit/{id}', "EventController@edit")->name('event.edit');
    Route::any('event/del/{id}', "EventController@del")->name('event.del');

    //抽奖活动奖品管理
    Route::any('prize/index', "EventPrizeController@index")->name('prize.index');
    Route::any('prize/add', "EventPrizeController@add")->name('prize.add');
    Route::any('prize/edit/{id}', "EventPrizeController@edit")->name('prize.edit');
    Route::any('prize/del/{id}', "EventPrizeController@del")->name('prize.del');
});




//商户平台
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

//活动查看
    Route::any('activity/show', "ActivityController@show")->name('activity.show');

    //订单统计
    Route::get('order/day', "OrderController@day")->name('order.day');
//每月统计
    Route::get('order/month', "OrderController@month")->name('order.month');
    //订单管理
    Route::get('order/index', "OrderController@index")->name('order.index');
    //订单查看
    Route::get('order/select/{id}', "OrderController@select")->name('order.select');
    //改变订单状态
    Route::get('order/change/{id}/{status}', "OrderController@change")->name('order.change');


    //活动报名
    Route::any('event/index', "EventController@index")->name('event.index');
    Route::any('event/show/{id}', "EventController@show")->name('event.show');
    Route::any('event/add/{id}', "EventController@add")->name('event.add');
});

