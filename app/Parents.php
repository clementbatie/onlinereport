<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    protected $table = 'setupparents';   
    protected $primaryKey='SetupParentID';

    public function myclass(){
    	return $this->belongsTo('App\Classes','ClassID','ClassID');
    }
}
