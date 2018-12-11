<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';   
    protected $guarded =['Department_ID'];
    public $timestamps=false;
    protected $primaryKey='Department_ID';
}


// class ProjectStatus extends Model
// {
//     //
// }
