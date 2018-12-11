<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $table = 'projectstatus';   
    protected $guarded =['ProjectStatusID'];
    public $timestamps=false;
    protected $primaryKey='ProjectStatusID';
}


// class ProjectStatus extends Model
// {
//     //
// }
