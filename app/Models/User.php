<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //可以修改的数据
    public  $fillable=['name','password','email','status','shop_id',];

public function shop(){
    return $this->belongsTo(Shop::class);
}

}
