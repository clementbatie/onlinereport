<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userstate extends Model
{
    //
    protected $table = 'user_state';   
    protected $guarded =['id'];
    public $timestamps=true;
    protected $primaryKey='id';
}
