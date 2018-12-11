<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soulmember extends Model
{
    public function mysoultype(){
    	return $this->belongsTo('App\Soultype','soultype');
    }
}
