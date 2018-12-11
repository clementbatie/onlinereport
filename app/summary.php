<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class summary extends Model
{
      protected $table = 'iesummary'; 
      protected $fillable = [
        'assembly', 'balance', 'totalincome', 'totalexpenditure', 
    ];
}
