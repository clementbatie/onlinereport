<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
	protected $table = 'UserLevels';   
    protected $guarded =['UserLevelID'];
    public $timestamps=false;
    protected $primaryKey='UserLevelID';
}
