ELE点餐平台

平台：网站管理者
商户：入住平台的餐馆
用户：订餐的用户
Day01
开发任务
平台端
商家分类管理
商家管理
商家审核
商户端
商家注册

数据迁移
创建表 php artisan make:model Models/ShopCategory -m

准备好基础模板

创建视图 视图也要分模块

路由需要分组
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


要点难点及解决方案
平台与平台之间关系的分析有点难  没有解决
还看不懂错误提示  解决方法靠百度翻译