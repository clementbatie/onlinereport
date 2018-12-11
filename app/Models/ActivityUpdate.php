<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityUpdate extends Model
{
    protected $table = 'activityupdate';   
    protected $guarded =['ActivityUpdate_ID'];
    public $timestamps=false;
    protected $primaryKey='ActivityUpdate_ID';
	
	public function ActivityName(){
		return $this->belongsto('\App\Models\Activity','Activity_ID','Activity_ID');
		
	}
	public function UserName(){
		return $this->belongsto('\App\User','id','id');
	}
	public function ReviewerName(){
		return $this->belongsto('\App\User','ReviewerID','id');
	}
	public function DepartmentName(){
		return $this->belongsto('\App\Models\Department','Department_ID','Department_ID');
		
	}

public function DesignationName(){
		return $this->belongsto('\App\Models\Designation','Designation_ID','Designation_ID');
		
	}
	public function SectionName(){
		return $this->belongsto('\App\Models\Section','SectionID','SectionID');
		
	}
	public function CategoryName(){
		return $this->belongsto('\App\Models\Category','CategoryID','CategoryID');
		
	}
public function RegionName(){
		return $this->belongsto('\App\Models\Region','RegionID','RegionID');
		
	}
	
	public function projects(){
		return $this->belongsto('\App\Models\Project','ProjectID','ProjectID');
		
	}
}


