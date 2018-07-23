<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //可以修改字段
    public $fillable=['name','email','password'];
}
