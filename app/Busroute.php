<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busroute extends Model
{
    public function myarea(){
    	return $this->belongsTo('App\Models\Area','AreaID','AreaID');
    }
}
