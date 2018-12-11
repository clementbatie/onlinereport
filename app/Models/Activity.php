<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activitydescription';   
    protected $guarded =['Activity_ID'];
    public $timestamps=false;
    protected $primaryKey='Activity_ID';
}


