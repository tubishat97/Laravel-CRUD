<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mirror extends Model
{

    protected $fillable = ['name', 'description'];

    public function Task()
    {
      return  $this->belongsTo(Task::class,'id');
    }
}
