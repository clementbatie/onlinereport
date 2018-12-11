<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolinfo extends Model
{
    protected $table = 'schoolinfos';   
    protected $primaryKey='SchoolIfoID';

    // public function myclass(){
    // 	return $this->belongsTo('App\Classes','ClassID','ClassID');
    // }

    // public function myterm(){
    // 	return $this->belongsTo('App\Term','Term','TermID');
    // }
}
