<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


     protected $table = 'users';   
    protected $primaryKey='id';

    
    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // //protected $primaryKey='UserID';
    // protected $fillable = [
    //     'name', 'email', 'password', 'UserLevelID', 'PhoneNo',
    // ];

    // /**
    //  * The attributes excluded from the model's JSON form.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
