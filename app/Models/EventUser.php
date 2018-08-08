<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    //可以修改的字段
    public $fillable = ['events_id','user_id'];

}
