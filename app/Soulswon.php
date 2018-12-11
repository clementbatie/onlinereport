<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soulswon extends Model
{
    protected $table = 'soulswon'; 
    public function mysoultype(){
    	return $this->belongsTo('App\Soultype','soultype');
    }
}
