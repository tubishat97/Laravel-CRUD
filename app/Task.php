<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{

    use SoftDeletes;
    protected $fillable = ['name', 'description'];

    public function mirror()
    {
       return $this->belongsToMany(Mirror::class,'task_mirror');
    }
}
