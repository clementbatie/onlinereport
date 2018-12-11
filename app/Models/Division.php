<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'pentecoastdivision';   
    protected $guarded =['DivisionID'];
    public $timestamps=false;
    protected $primaryKey='DivisionID';
	
	public function District(){
		return $this->belongsto('\App\Models\District','DistrictID','DistrictID');
		
	}
	public function Assembly(){
		return $this->belongsto('\App\Models\Assembly','AssemblyID','AssemblyID');
	}
	public function Area(){
		return $this->belongsto('\App\Models\Area','AreaID','AreaID');
	}
	
}
