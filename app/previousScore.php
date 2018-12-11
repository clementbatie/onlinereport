<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class previousScore extends Model
{
    protected $table = 'previousScores';   
    protected $primaryKey='PreviousID';
}
