<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class National extends Model
{
    protected $primaryKey='NationalID';

    public function myarea(){
		return $this->hasMany('\App\Models\Area','NationalID','NationalID');
	}
}
