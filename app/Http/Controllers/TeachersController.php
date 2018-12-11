<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\setupteachers;
use App\Classes;
use App\Student;
use App\subjectsetup;
use App\teacher;
use App\year_term_setup;

use Session;
use Illuminate\Support\Facades\Input;


class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows = setupteachers::leftjoin('teachers','setupteachers.TeachersetupID','=','teachers.TeachersetupID')->leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->select('setupteachers.*','classes.ClassName','subjectsetups.SubjectName','teachers.TeacherSetupName')->paginate(10);
//dd($rows);
         $teachername = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeacherSetupID');

         return view('teacher.list', compact('arra','rows','array','arra2','arra','array','classArray','teachername','getYear','getTerm'));
        
//         $subject = setupteachers::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectID');

//         $class = setupteachers::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassID');

//         $arra = array();
//         $classArray = array();
//        $array2 = array();
//           $decode = json_decode($subject,true);

//           foreach ($decode as $key => $value) {
      

//               $string = str_replace(array('[',']'),'',$value);

//                $AA = str_replace('"', '', $string);

//                $arr=explode(",",$AA);

//                 $subject2 = subjectsetup::whereIn('SubjectSetupID',$arr)->lists('SubjectName');
               
         
//               $arra[] = $subject2;  

//           }
// //dd($arra);
//          foreach ($arra as $key => $value) {
//          // $ff = implode(" ", $value);
//            $AA = str_replace('"', '', $value);

//            $Classlist = str_replace(array('[',']'),'',$AA);

          
//            $array[] = $Classlist;

//          //  $array2[] = $array;
//          //  $ff = $array2[0];
//            //$links = implode("\n", array_flatten($array2));
//        }

//        $arra = array();
//        $array2 = array();
//           $className = json_decode($class,true);

//           foreach ($className as $key => $value) {
      

//               $string2 = str_replace(array('[',']'),'',$value);

//                $AA2 = str_replace('"', '', $string2);

//                $arr2=explode(",",$AA2);

//                 $subject3 = Classes::whereIn('ClassID',$arr2)->lists('ClassName');
               
         
//               $arra[] = $subject3;  

//           }
// //dd($arra);
//          foreach ($arra as $key => $value) {
//          // $ff = implode(" ", $value);
//            $AA = str_replace('"', '', $value);

//            $Classlist = str_replace(array('[',']'),'',$AA);

          
//            $classArray[] = $Classlist;

//        }
        
//dd($classArray);
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        if (auth()->user()->UserLevelID == 4) {
            $class = Classes::lists('ClassName','ClassID');
        $rows = [];
        $teachername = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeacherSetupID');
        $subject = subjectsetup::lists('SubjectName','SubjectSetupID');

        return view('teacher.create', compact('class','rows','subject','teachername','getYear','getTerm'));

        }else{

        $class = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $rows = [];
        $subject = subjectsetup::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectSetupID');
        $teachername = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeacherSetupID');
//dd($teachername);
        return view('teacher.create', compact('class','rows','subject','teachername','getYear','getTerm'));

        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $data = (object)$request->data;

            foreach ($data->data as $value) {
             $value = (object)$value;

             $person = setupteachers::where('setupteachers.TeachersetupID',$value->name)->where('setupteachers.SubjectID',$value->subject)->where('setupteachers.ClassID',$value->children)->where('setupteachers.SchoolCode',auth()->user()->SchoolCode);

              if ($person->exists()) {
                  $person = $person->leftjoin('teachers','setupteachers.TeachersetupID','=','teachers.TeachersetupID')->leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->get(['teachers.TeacherSetupName','classes.ClassName','subjectsetups.SubjectName'])->toArray();

                  return response()->json([
                      'message' => 'exists',
                      'person' => $person
                  ]);
                }  
            }

           foreach ($data->data as $value) {
           $value = (object)$value;
           $member = new setupteachers;
           $member->TeachersetupID = $value->name;
           // $member->PhoneNo = $value->phone;
        
           // $member->ClassID = json_encode($value->children);
           //  $member->SubjectID = json_encode($value->subject);
           // $member->SchoolCode = auth()->user()->SchoolCode;
            
            $member->ClassID = $value->children;
            $member->SubjectID = $value->subject;
           $member->SchoolCode = auth()->user()->SchoolCode;
           
           $member->save();
            }



        return response()->json(['message' => 'correct']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($SetupTeacherID)
    {
        
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows1 = setupteachers::find($SetupTeacherID);

        if (is_null($rows1)) {
            return redirect('teacher')->withMessage('Teacher Not Found');
        }

          if (auth()->user()->UserLevelID == 4) {
        $class = Classes::lists('ClassName','ClassID');
        $rows = [];
        $subject = subjectsetup::lists('SubjectName','SubjectSetupID');
        $teachername = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeacherSetupID');

    return view('teacher.show',compact('rows','class','rows1','subject','teachername','getYear','getTerm'));

        }else{

        $class = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $rows = [];
        $subject = subjectsetup::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectSetupID');
        $teachername = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeacherSetupID');

    return view('teacher.show',compact('rows','class','rows1','subject','teachername','getYear','getTerm'));

        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($SetupTeacherID)
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows1 = setupteachers::find($SetupTeacherID);
        if (is_null($rows1)) {
            return redirect('teacher')->withMessage('Teacher Not Found');
        }

          if (auth()->user()->UserLevelID == 4) {
        $class = Classes::lists('ClassName','ClassID');
        $rows = [];
        $subject = subjectsetup::lists('SubjectName','SubjectSetupID');
        $teachername = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeacherSetupID');

    return view('teacher.edit',compact('rows','class','rows1','subject','teachername','getYear','getTerm'));

        }else{

        $class = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $rows = [];
        $subject = subjectsetup::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectSetupID');
        $teachername = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeacherSetupID');

    return view('teacher.edit',compact('rows','class','rows1','subject','teachername','getYear','getTerm'));

        }

    //return view('teacher.edit',compact('rows','class','rows1','subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $SetupTeacherID)
    {
         $this->validate($request,[
           'TeachersetupID' => 'required',
           
            
        ]);

         $person = setupteachers::where('setupteachers.TeachersetupID',$request->TeachersetupID)->where('setupteachers.SubjectID',$request->SubjectID)->where('setupteachers.ClassID',$request->ClassID)->where('setupteachers.SchoolCode',auth()->user()->SchoolCode);

              if ($person->exists()) {

                  Session::flash('message','Teacher Record Already Exit, Check and EDit Again');
                  return redirect('teacher');
                } 


        $rows = setupteachers::find($SetupTeacherID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('teacher');
          }

           // $rows->Name = $request->Name; 
           // $rows->PhoneNo = $request->PhoneNo;
           // $rows->ClassID = json_encode($request->ClassID);
           //  $rows->SubjectID = json_encode($request->SubjectID);

             $rows->TeachersetupID = $request->TeachersetupID; 
           // $rows->PhoneNo = $request->PhoneNo;
           $rows->ClassID = $request->ClassID;
            $rows->SubjectID = $request->SubjectID;

           $rows->save();
        Session::flash('message','Teacher Has Been Edited Successfully!');

return redirect('teacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($SetupTeacherID)
    {
        setupteachers::find($SetupTeacherID)->delete();
        \Session::flash('message','Teacher & Class Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect('teacher');
    }

    public function deleteMultiple(Request $request)
    {
        setupteachers::destroy($request->categories8); 
         Session::flash('message','Teacher & Class has been deleted successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('teacher');
    }

     public function search()
    {
     $searchStr=Input::get('searchString1');
          
    $rows= setupteachers::leftjoin('teachers','setupteachers.TeachersetupID','=','teachers.TeachersetupID')->leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.TeachersetupID',$searchStr)->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->select('setupteachers.*','classes.ClassName','subjectsetups.SubjectName','teachers.TeacherSetupName')->paginate(15);

    $teachername = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeacherSetupID');

        return view('teacher.list')->with(compact('rows','teachername'));
    }
}
