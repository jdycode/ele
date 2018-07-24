<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/23
 * Time: 18:32
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
//可以修改字段
public  $fillable=['goods_name','rating','shop_id','category_id','goods_price','description','month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
}
    public function menu()
    {
        return $this->belongsTo(MenuCategory::class,'category_id');
    }
}