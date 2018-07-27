<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/24
 * Time: 17:55
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
//可以修改的字段
public $fillable=['title','content','start_time','end_time'];
}