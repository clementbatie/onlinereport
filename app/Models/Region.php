<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{


     protected $table = 'Regions';   
    protected $guarded =['RegionID'];
    public $timestamps=false;
    protected $primaryKey='RegionID';

        public function project()
        {
        	return $this->hasMany('\App\Models\Project', 'RegionID', 'RegionID');
        }
    }


