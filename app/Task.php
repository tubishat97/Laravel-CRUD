<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{

    use SoftDeletes;
    protected $fillable = ['name', 'description'];

    public function todoTasks()
    {
        $this->belongsToMany('App/Mirror','task_mirror');
    }
}
