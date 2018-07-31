<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/30
 * Time: 14:57
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
//可以修改的字段
public $fillable = ['user_id','goods_id','amount'];
//关闭时间
public $timestamps = false;
}