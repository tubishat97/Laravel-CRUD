<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Mirror extends Model
{
    use SoftDeletes, LogsActivity;

    protected  static $logAttributes = ['name', 'description'];

    protected $fillable = ['name', 'description'];

}
