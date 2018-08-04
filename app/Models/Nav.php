<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    //可以修改字段
    public $fillable = ['name','url','pid','sort'];
}
