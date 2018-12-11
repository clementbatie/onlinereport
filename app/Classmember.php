<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classmember extends Model
{
    public function myclass(){
    	return $this->belongsTo('App\Classes','class_id');
    }
}
