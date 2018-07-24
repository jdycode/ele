<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/23
 * Time: 14:37
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
//可以修改字段
public $fillable=['name','type_accumulation','shop_id','description','is_selected'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
}
}