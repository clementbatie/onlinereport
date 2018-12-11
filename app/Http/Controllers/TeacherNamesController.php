<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setupteachers;
use App\Student;
use App\teacher;
use App\setupparent;
use App\Http\Requests;

class TeacherNamesController extends Controller
{
    public function getTeacherNames(Request $request)
    {
           $this->validate($request,[
              'UserLevelID' => 'required'
          ]);
        
        $value = $request->UserLevelID;
        $value2 = 1;
       
if ($value == 2) {
	 $code =  teacher::where('SchoolCode',Auth()->user()->SchoolCode)->lists('TeacherSetupName','TeachersetupID');

}
elseif ($value == 3) {

	 $code =  Student::where('SchoolCode',Auth()->user()->SchoolCode)->lists('ParentName','id');

	 //$code = $code1->where('ClassID',$value2)->lists('ParentName');

 }elseif ($value == 6) {
 	 $code =  teacher::where('SchoolCode',Auth()->user()->SchoolCode)->lists('TeacherSetupName','TeachersetupID');
 }
 
   
        return response()->json([
            'message' => 'correct',
            'details' => $code,
           
            
        ]);
    }
}
