<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pickuplocation extends Model
{
    public function myarea(){
    	return $this->belongsTo('App\Models\Area','AreaID','AreaID');
    }

    public function myroute(){
    	return $this->belongsTo('App\Busroute','busroute_id');
    }
}
