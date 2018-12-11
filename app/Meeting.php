<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public function attendance(){
    	$this->hasMany('App\Markattendance','Meeting_id','id');
    }
}
