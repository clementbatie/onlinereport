<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $table = 'cell';   
    protected $guarded =['CellID'];
    public $timestamps=false;
    protected $primaryKey='CellID';
}
