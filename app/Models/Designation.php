<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designation';   
    protected $guarded =['Designation_ID'];
    public $timestamps=false;
    protected $primaryKey='Designation_ID';
}


// class ProjectStatus extends Model
// {
//     //
// }
