<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markattendance extends Model
{
    public function meeting(){
    	$this->belongsTo('App\Meeting','id','Meeting_id');
    }
}
