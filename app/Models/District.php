<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';   
    protected $guarded =['DistrictID'];
    public $timestamps=true;
    protected $primaryKey='DistrictID';

    public function myarea(){
		return $this->belongsto('\App\Models\Area','DistrictID','AreaID');
	}

	public function myassembly(){
		return $this->hasMany('\App\Models\Assembly','DistrictID','DistrictID');
	}
}


// class ProjectStatus extends Model
// {
//     //
// }
