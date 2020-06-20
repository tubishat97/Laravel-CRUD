<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoMirror extends Model
{
    public function todoTask()
    {
        $this->belongsTo('App/TodoTask');
    }
}
