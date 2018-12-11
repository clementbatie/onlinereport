<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';   
    protected $guarded =['ProjectID'];
    public $timestamps=true;
    protected $primaryKey='ProjectID';
	
	
	public function Country(){
		return $this->belongsto('\App\Models\country','CountryID','CountryID');
		
	}
	public function Status(){
		return $this->belongsto('\App\Models\projectstatus','ProjectStatusID','ProjectStatusID');
	}
	public function ReviewerName(){
		return $this->belongsto('\App\project','ReviewerID','id');
	}
}


// class ProjectStatus extends Model
// {
//     //
// }
