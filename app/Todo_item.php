<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo_item extends Model
{
    public function scopeItem($query){
        return $query->where('state',1);
    }
}
