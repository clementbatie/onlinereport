<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busregister extends Model
{
    public function myconvert(){
    	return $this->belongsTo('App\Soulmember','convert_id');
    }

    public function myshepherd(){
    	return $this->belongsTo('App\Member','shepherd');
    }

    public function mybusrequest(){
    	return $this->belongsTo('App\Busrequest','busrequest');
    }
}
