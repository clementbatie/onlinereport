<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Student;
use App\Classes;
use App\Schoolinfo;

class StudentImageController extends Controller
{
    public function getStudentImage(Request $request)
    {
        $this->validate($request,[
              'studentname' => 'required'
          ]);
      $value = $request->studentname;

      $filenames = array();

    $code = Student::where('UniqueCode',$value)->where('SchoolCode',auth()->user()->SchoolCode)->lists('ImageType'); 

    //return $code;
        
         return response()->json([
             'message' => 'correct',
            
             'details' => $code,
       
         ]);

    }

 public function getStudentClass2(Request $request)
    {
        $this->validate($request,[
              'searchString1' => 'required'
          ]);
      $value = $request->searchString1;

      $filenames = array();

    $code = Student::where('id',$value)->where('students.SchoolCode',auth()->user()->SchoolCode)->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('classes.ClassName','students.ClassID'); 

    //return $code;
        
         return response()->json([
             'message' => 'correct',
            
             'details' => $code,
       
         ]);

    }

    public function getStudentSchool(Request $request)
    {
     
    $code = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode'); 

    //return $code;
        
         return response()->json([
             'message' => 'correct',
            
             'details' => $code,
       
         ]);

    }

    public function getstudentSchool2(Request $request)
    {
        $code = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode'); 

    //return $code;
        
         return response()->json([
             'message' => 'correct',
            
             'details' => $code,
       
         ]);

    }

  public function getStudentNameDisplay(Request $request)
    {
       $this->validate($request,[
              'studentname' => 'required'
          ]);
      $value = $request->studentname;

      $filenames = array();

    $code = Student::where('UniqueCode',$value)->where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName'); 
    //return $code;
        
         return response()->json([
             'message' => 'correct',
            
             'details' => $code,
       
         ]);

    }  

//return $code;
    
}
