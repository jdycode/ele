<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    //可以修改字段

    public $fillable=['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status'];

    public   function  shopCate(){
        return $this->belongsTo(ShopCategory::class,'shop_category_id');
    }
}

