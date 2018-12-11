<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';   
    protected $guarded =['SectionID'];
    public $timestamps=false;
    protected $primaryKey='SectionID';
}


// class ProjectStatus extends Model
// {
//     //
// }
