<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classinfo extends Model
{
    protected $table = 'classinfos';   
    protected $primaryKey='ClassInfoID';

    public function myclass(){
    	return $this->belongsTo('App\Classes','ClassID','ClassID');
    }

    public function myterm(){
    	return $this->belongsTo('App\Term','Term','TermID');
    }
}
