<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mirror extends Model
{

    protected $fillable = ['name', 'description'];

    public function todoTasks()
    {
        $this->belongsToMany('App/Task','task_mirror');
    }
}
