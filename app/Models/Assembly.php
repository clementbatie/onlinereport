<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assembly extends Model
{
    protected $table = 'assembly';   
    protected $guarded =['AssemblyID'];
    public $timestamps=false;
    protected $primaryKey='AssemblyID';

    public function mydistrict(){
		return $this->belongsto('\App\Models\District','DistrictID','DistrictID');
	}
}


// class ProjectStatus extends Model
// {
//     //
// }
