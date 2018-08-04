<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use HasRoles;

    protected $guard_name = 'admin'; // 使用任何你想要的守卫

    //可以修改字段
    public $fillable=['name','email','password'];

}
