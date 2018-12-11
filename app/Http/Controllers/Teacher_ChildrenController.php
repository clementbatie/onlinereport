<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Student;
use App\subject;
use App\setupteachers;
use App\Classes;
use App\teacher;
use App\subjectsetup;
use Illuminate\Support\Facades\Input;

class Teacher_ChildrenController extends Controller
{
    
    public function getTeacher_Children(Request $request)
    {
           $this->validate($request,[
              'UserLevelID' => 'required'
          ]);
        
        $value = $request->UserLevelID;
       
if($value == 2) {
   $code =  setupteachers::leftjoin('teachers','setupteachers.TeachersetupID','=','teachers.TeachersetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('teachers.TeacherSetupName','teachers.TeachersetupID');
}
elseif ($value == 3) {
	 $code =  Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('ParentName','id');
}elseif ($value == 5) {
   $code =  setupteachers::leftjoin('teachers','setupteachers.TeachersetupID','=','teachers.TeachersetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('teachers.TeacherSetupName','teachers.TeachersetupID');
}
 
   
        return response()->json([
            'message' => 'correct',
            'details' => $code,
           
            
        ]);
    }

     public function getStudentClass(Request $request)
    {
           $this->validate($request,[
              'Class' => 'required'
          ]);
        
        $value = $request->Class;
     

   $code =  Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',$request->Class)->lists('StudentName','UniqueCode');
//dd($code);
        return response()->json([
            'message' => 'correct',
            'details' => $code,
           
            
        ]);
    }

    
    public function getClassofStudent(Request $request)
    {
           $this->validate($request,[
              'ClassofStudent' => 'required'
          ]);
        
        $value = $request->ClassofStudent;
     //dd($value);

   $code =  Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',$request->ClassofStudent)->lists('StudentName','UniqueCode');
//dd($code);
        return response()->json([
            'message' => 'correct',
            'details' => $code,
           
            
        ]);
    }

    public function getSubjects(Request $request)
    {
           $this->validate($request,[
              'Class' => 'required'
          ]);
        
        $value = $request->Class;
     
if((auth()->user()->UserLevelID == 1) || (auth()->user()->UserLevelID == 4)){
    
    $this->validate($request,[
              'Class' => 'required'
          ]);
        
        $value = $request->Class;
     

   $code =  setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.ClassID',$value)->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('subjectsetups.SubjectName','setupteachers.SubjectID');
//dd($code);
        return response()->json([
            'message' => 'correct',
            'details' => $code,
           
            
        ]);
}else{
   $code =  setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('TeachersetupID',auth()->user()->SetupTeacherID)->where('setupteachers.ClassID',$value)->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('subjectsetups.SubjectName','setupteachers.SubjectID');
//dd($code);
        return response()->json([
            'message' => 'correct',
            'details' => $code,
           
            
        ]);
      }
    }



//      public function getSubjectsAdmin(Request $request)
//     {
//            $this->validate($request,[
//               'ClassAdmin' => 'required'
//           ]);
        
//         $value = $request->ClassAdmin;
     

//    $code =  setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.ClassID',$value)->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('subjectsetups.SubjectName','setupteachers.SubjectID');
// //dd($code);
//         return response()->json([
//             'message' => 'correct',
//             'details' => $code,
           
            
//         ]);
//     }
    

    public function getStudentName(Request $request)
    {
           $this->validate($request,[
              'ClassID' => 'required'
          ]);
        
        $value = $request->ClassID;
     

   $code =  Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',$request->ClassID)->lists('StudentName','id');

        return response()->json([
            'message' => 'correct',
            'details' => $code,
           
            
        ]);
    }

     
}
