<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    public function todoMirror()
    {
        $this->hasOne('App/TodoMirror');
    }
}
