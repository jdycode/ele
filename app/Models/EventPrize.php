<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //可以修改的字段
    public $fillable=['events_id','name','description','user_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
