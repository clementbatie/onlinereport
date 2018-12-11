<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';   
    protected $guarded =['CommentID'];
    public $timestamps=true;
    protected $primaryKey='CommentID';
	
	public function UserName(){
		return $this->belongsto('\App\User','id','id');
	}
}


