<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Member;
use App\BackgroundImage;
use App\Schoolinfo;
use Auth;
class MyhomeController extends Controller
{
    public function index(){
        $rows = [];
    	if (Auth::check()) {
    		if (auth()->user()->UserLevelID == 3) {
                $backgroundimage = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->first();
                //dd($backgroundimage);
    			// $rows = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',0)->get();
                $rows = [];
    			return view('welcome2',compact('rows','backgroundimage'));
    		}else{
    			$rows = [];
                  $backgroundimage = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->first();
//dd($backgroundimage);
    			return view('welcome2',compact('rows','backgroundimage'));
    		}
    		
    	}

    	return view('welcome',compact('rows','backgroundimage'));
    }
}


