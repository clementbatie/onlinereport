<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classattendance extends Model
{
    public function myclass(){
    	return $this->belongsTo('App\Classes','class_id');
    }

    public function mymember(){
    	return $this->belongsTo('App\Classmember','classmember_id');
    }
}
