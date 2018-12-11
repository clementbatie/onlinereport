<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dues extends Model
{
    protected $primaryKey='Dues_ID';

    public function member(){
    	return $this->belongsTo('\App\Member','Member_ID');
    }
}
