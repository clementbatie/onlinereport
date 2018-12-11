<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busrequest extends Model
{
    public function myshepherd(){
    	return $this->hasOne('App\Member','id','shepherd_id');
    }

    public function convert(){
    	return $this->belongsToMany('App\Soulmember','converts');
    }

    public function mypickuplocation(){
    	return $this->belongsTo('App\Pickuplocation','pickuplocation','id');
    }
}
