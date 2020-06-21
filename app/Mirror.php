<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Mirror extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = ['name', 'description'];

}
