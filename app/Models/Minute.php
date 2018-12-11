<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minute extends Model
{
    protected $table = 'Minute';   
    protected $guarded =['Minute_ID'];
    public $timestamps=false;
    protected $primaryKey='Minute_ID';
}


