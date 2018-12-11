<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mainfinance extends Model
{
    protected $table = 'mainfinance';   
    protected $guarded =['MainFinanceID'];
    public $timestamps=false;
    protected $primaryKey='MainFinanceID';
}
