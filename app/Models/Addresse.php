<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class addresse extends Model
{
    //可以修改字段
    public $fillable=['name','tel','provence','city','area','detail_address','is_default','user_id'];
    public $timestamps='false';
}
