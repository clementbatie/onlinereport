<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';   
    protected $guarded =['AreaID'];
    public $timestamps=true;
    protected $primaryKey='AreaID';

    public function mynational(){
		return $this->belongsto('\App\National','AreaID','NationalID');
	}

	public function mydistrict(){
		return $this->hasMany('\App\Models\District','AreaID','AreaID');
	}
}


// class ProjectStatus extends Model
// {
//     //
// }
