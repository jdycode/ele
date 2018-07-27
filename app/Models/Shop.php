<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

    public static $statusArray=['1'=>'正常','0'=>'待审核',"-1"=>'已禁用'];
    //可以修改字段

    public $fillable=['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status'];

    public   function  shopCate(){
        return $this->belongsTo(ShopCategory::class,'shop_category_id');
    }
    public function user(){
        return $this->hasOne(User::class);
    }


}

