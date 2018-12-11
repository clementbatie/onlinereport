<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use App\Http\Requests;
use App\Terminalscore;
use App\Classes;
use App\Student;
use App\subject;
use App\Term;
use App\year_term_setup;
use App\setupteachers;
use App\subjectsetup;
use App\OverallPosition;

use Database\seeds\DatabaseSeeder;

use Session;
use Illuminate\Support\Facades\Input;

class terminalscoreController extends Controller
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

      if ((auth()->user()->UserLevelID == 1) || auth()->user()->UserLevelID == 4) {
        
        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('subjectsetups.SubjectName');

        $rows = Terminalscore::where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->OrderBy('Class','totalscore')->select('terminalscores.*','subjectsetups.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(50);
        
        return view('Terminalscore.listAdmin', compact('rows','Class','Subject','getYear','getTerm'));
      }else{

        $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');

        $rows = Terminalscore::where('SetupTeacherID',auth()->user()->SetupTeacherID)->where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->OrderBy('totalscore','desc')->select('terminalscores.*','subjectsetups.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(200);

       // dd($rows);
        return view('Terminalscore.list', compact('rows','Class','Subject','getYear','getTerm'));
      }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(auth()->user()->UserLevelID == 4){
          // dd(3);
        // $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->lists('classes.ClassName');
            $Class = classes::lists('ClassName','ClassID');
   
        $Subject = subjectsetup::lists('SubjectName');
        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');
        //dd($Subject);
       
    }elseif(auth()->user()->UserLevelID == 1){
 
         $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
        // dd($Class);
        // $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
     // dd($Class);
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');
         //dd($Subject);
         $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');

    }else{
 
         $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
        // dd($Class);
        // $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
     // dd($Class);
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');
         //dd($Subject);
         $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');

    }

        //$Class = setupteachers::leftjoin('users','users.SetupTeacherID','=','setupteachers.SetupTeacherID')->where('SetupTeacherID',auth()->user()->ClassID)->lists('ClassName');

//         $array = array();
//         $decode = json_decode($Class,true);
//     //dd($decode);
//         $class2 =  $decode[0];
// //dd($class2);
//              $string = str_replace(array('[',']'),'',$class2);

//              $AA = str_replace('"', '', $string);

//             // $pp = string.split(',');


//          $arr=explode(",",$AA);



//           $array2 = array();
//         $decode2 = json_decode($Subject,true);
    
//         //$class3 =  $decode2[0];
// //dd($class3);
//              $string2 = str_replace(array('[',']'),'',$class3);

//              $AA2 = str_replace('"', '', $string2);

//             // $pp = string.split(',');


//          $arr2=explode(",",$AA2);
//         // dd($arr2);
//              //$check = $array;

//      // dd($arr);        

     

//         $Class2 = Classes::whereIn('ClassID',$arr)->lists('ClassName','ClassID');
   //dd($Class2);

        
        //$StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->get();
        //dd($StudentName);
       // $Subject = subject::whereIn('SubjectID',$arr2)->lists('SubjectName','SubjectID');
       $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
//dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;


        $Year = year_term_setup::where('SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('terms.TermName','year_term_setups.TermID');

        return view('Terminalscore.create', compact('Class','StudentName','Subject','Year','Term','Class2','getTerm','getYear'));
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

        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();

        $getTerm = $Year[0]->TermID;

        $getYear = $Year[0]->Year;

         foreach ($data->data as $key => $value) {
          $value = (object)$value;

                $UserEmailUser = Terminalscore::where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->where('Class',$value->Class)->where('terminalscores.id',$value->studentname)->where('terminalscores.SubjectID',$value->subjectname);

              if ($UserEmailUser->exists()) {
              $UserEmailUser = $UserEmailUser->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->get(['subjectsetups.SubjectName','students.StudentName'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'UserEmailUser' => $UserEmailUser
                  ]);
                }  
            }
            
            foreach ($data->data as $value) {
             
             $test = Terminalscore::all();
  

           $value = (object)$value;

             $classscore = $value->classscore;
             $examscore = $value->examscore; 

             $total = $classscore + $examscore;

           
           $member = new Terminalscore;
           //$member->Year  = $value->year; 
           // $member->TermID = $value->term; 
           $member->Class  = $value->Class;
           $member->TermID = $getTerm; 
           $member->Year = $getYear;
           $member->id  = $value->studentname; 
           $member->SubjectID = $value->subjectname; 
           $member->classscore  = $value->classscore;
           $member->examscore  = $value->examscore; 
           $member->totalscore  = $total; 
           // $member->position = $value->position; 
           // $member->remarks  = $value->remarks;

             if (in_array($total, range(80, 100))) {   
                 $member->Grade = "A";
                 $member->remarks  = "Excellent";
             }elseif (in_array($total, range(70, 80))) {
                 $member->Grade = "B";
                 $member->remarks  = "Very Good";
             }elseif (in_array($total, range(60, 70))) {
                 $member->Grade = "C";
                 $member->remarks  = "Good";
             }elseif (in_array($total, range(50, 60))) {
                 $member->Grade = "D";
                 $member->remarks  = "Pass";
             }elseif (in_array($total, range(40, 50))) {
                 $member->Grade = "E";
                 $member->remarks  = "Credit";
             }else{
                 $member->Grade = "F";
                 $member->remarks  = "Fail";
             }

           $member->SchoolCode = auth()->user()->SchoolCode;
           $member->SetupTeacherID = auth()->user()->SetupTeacherID;
           
            switch (auth()->user()->UserLevelID) {
            case '1':
              $member->Entry_User = auth()->user()->UserLevelID;
                break;
             case '3':
              $member->Entry_User = auth()->user()->UserLevelID;
                break;
            case '4':
              $member->Entry_User = auth()->user()->UserLevelID;
                break;
                case '2':
              $member->Entry_User = auth()->user()->UserLevelID;
                break;
            default:
            break;   
          }
        
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
    public function show($TerminanlScoreID)
    { 

          $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
        // dd($Class);
        // $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
     // dd($Class);
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName','SubjectID');
 //       $array = array();
 //        $decode = json_decode($Class,true);
    
 //        $class2 =  $decode[0];

 //             $string = str_replace(array('[',']'),'',$class2);

 //             $AA = str_replace('"', '', $string);

 //            // $pp = string.split(',');


 //         $arr=explode(",",$AA);

 // $Class2 = Classes::whereIn('ClassID',$arr)->lists('ClassName','ClassID');
 //   //dd($Class2);

        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');
       // $Subject = subject::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectID');
        $Year = year_term_setup::where('SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('terms.TermName','year_term_setups.TermID');

        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows= Terminalscore::find($TerminanlScoreID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('terminalscore');
          }

       // $Class = Classes::lists('ClassName','ClassID');
       //  $StudentName = Student::lists('StudentName','id');
       //  $Subject = subject::lists('SubjectName','SubjectID');
       //  $Year = year_term_setup::lists('Year','Year');
       //  $Term = year_term_setup::lists('Term','Term');;
          
        return view('Terminalscore.show',compact('rows','Class','StudentName','Subject','Year','Term','Class2','getYear','getTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($TerminanlScoreID)
    {
         $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
        // dd($Class);
        // $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
     // dd($Class);
         

 //         $array = array();
 //        $decode = json_decode($Class,true);
    
 //        $class2 =  $decode[0];

 //             $string = str_replace(array('[',']'),'',$class2);

 //             $AA = str_replace('"', '', $string);


 //         $arr=explode(",",$AA);
 // $Class2 = Classes::whereIn('ClassID',$arr)->lists('ClassName','ClassID');
   //dd($Class2);

        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');
        //dd($StudentName);
        //$Subject = subject::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectID');
        $Year = year_term_setup::where('SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('terms.TermName','year_term_setups.TermID');

        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;
        //$Class = setupteachers::where('SetupTeacherID',auth()->user()->SetupTeacherID)->lists('ClassID');


        $rows= Terminalscore::find($TerminanlScoreID);
        //dd($rows);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('terminalscore');
          }

          $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName','SubjectID');
          
        return view('Terminalscore.edit',compact('rows','StudentName','Subject','Year','Term','Class','getYear','getTerm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $TerminanlScoreID)
    {
        $this->validate($request,[
            // 'Year' => 'required',
            // 'Term' => 'required',
            'Class' => 'required',
            'id' => 'required',
            'SubjectID' => 'required',
            'classscore' => 'required',
            'examscore' => 'required',
            // 'position' => 'required',
            // 'remarks' => 'required',
        ]);


        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();

        $getTerm = $Year[0]->TermID;

        $getYear = $Year[0]->Year;

        $rows = Terminalscore::find($TerminanlScoreID);
        //dd($rows);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('terminalscore');
          }

//           $UserEmailUser = Terminalscore::where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->where('Class',$request->Class)->where('terminalscores.id',$request->id)->where('terminalscores.SubjectID',$request->SubjectID);

//           $UserEmailUser2 = Terminalscore::leftjoin('subjectsetups','terminalscores.subjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('students','Terminalscores.id','=','students.UniqueCode')->where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->where('Class',$request->Class)->where('terminalscores.id',$request->id)->where('terminalscores.SubjectID',$request->SubjectID)->select('Terminalscores.*','students.StudentName','ClassName','SubjectName')->get();
// //dd($UserEmailUser2);
//          $AA = $UserEmailUser2[0]->StudentName;
//          $AAA = $UserEmailUser2[0]->ClassName;
//          $AA3 = $UserEmailUser2[0]->SubjectName;

//          $string = str_replace(array('[',']'),'',$AA);
//                $AA2 = str_replace('"', '', $string);

//          $string2 = str_replace(array('[',']'),'',$AAA);
//                $AAA = str_replace('"', '', $string2);
      
//         $string3 = str_replace(array('[',']'),'',$AA3);
//                $AA4 = str_replace('"', '', $string3);   


//                  $out = "{$AA2}, {$AAA}, {$AA4} Already Exit"; 

               

//               if ($UserEmailUser->exists()) {
//               $UserEmailUser = $UserEmailUser->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('students','terminalscores.id','=','students.id')->get(['subjectsetups.SubjectName','students.StudentName'])->toArray();
//                   // return response()->json([
//                   //     'message' => 'exists',
//                   //     'UserEmailUser' => $UserEmailUser
//                   // ]);
//                 Session::flash('message',$out); 
//                 Session::flash('alert-class','alert-warning');    
//               return redirect('terminalscore');
//                 }  

        $classscore = $request->classscore;
        $examscore = $request->examscore; 

        $total = $classscore + $examscore;

        $rows->Year = $getYear;
        $rows->TermID = $getTerm;
        $rows->Class = $request->Class;
        $rows->id = $request->id;
        $rows->SubjectID = $request->SubjectID;
        $rows->classscore = $request->classscore;
        $rows->examscore = $request->examscore;
        // $rows->position = $request->position;
        $rows->totalscore  = $total;

             if (in_array($total, range(80.0, 100.0))) {   
                 $rows->Grade = "A";
                 $rows->remarks  = "Excellent";
             }elseif (in_array($total, range(70.0, 80.0))) {
                 $rows->Grade = "B";
                 $rows->remarks  = "Very Good";
             }elseif (in_array($total, range(60.0, 70.0))) {
                 $rows->Grade = "C";
                 $rows->remarks  = "Good";
             }elseif (in_array($total, range(50.0, 60.0))) {
                 $rows->Grade = "D";
                 $rows->remarks  = "Pass";
             }elseif (in_array($total, range(40.0, 50.0))) {
                 $rows->Grade = "E";
                 $rows->remarks  = "Credit";
             }else{
                 $rows->Grade = "F";
                 $rows->remarks  = "Fail";
             }

        
        // $rows->remarks = $request->remarks;

        $rows->save();

        Session::flash('message','Terminal Score Has Been Edited Successfully');

        return redirect('terminalscore');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($TerminanlScoreID)
    {
         Terminalscore::find($TerminanlScoreID)->delete();
        \Session::flash('message','Terminal Score Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('terminalscore');
    }

    public function deleteMultiple(Request $request)
    {
        $getStudentIDS = $request->categories10;

        if (($getStudentIDS == NULL) || ($getStudentIDS == "")) {

             Session::flash('message','No Student Selected, Please Select All Students');
            Session::flash('alert-class','alert-warning');            
            return redirect('terminalscore');
        }
        

        foreach ($getStudentIDS as $key => $value) {

            $rows = Terminalscore::find($value);

         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('terminalscore');
          }

          $rows->position = $key + 1;

          $rows->save();

         }

        // Terminalscore::destroy($request->categories10); 
         Session::flash('message','Positions Has Been Set Successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('terminalscore');
    }

    public function testing()
    {$rows = Terminalscore::leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.id')->select('terminalscores.*','subjectsetups.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(10);
        
        return view('Terminalscore.list', compact('rows'));
    }

     public function transferd( $TerminanlScoreID)
    {
       
    }

    public function search(){

       $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;


        if ((auth()->user()->UserLevelID == 1) || (auth()->user()->UserLevelID == 4)) {
        
        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('subjectsetups.SubjectName');

        
    }else{

        $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');
        }

    $searchStr=Input::get('subjectID');
    $searchStr2=Input::get('classID');
//dd($searchStr2);
    if ((auth()->user()->UserLevelID == 1) || (auth()->user()->UserLevelID == 4)) {
    
         if ((($searchStr == NULL)||($searchStr == "")) &&  (($searchStr2 == NULL)||($searchStr2 == ""))) {

        $rows = Terminalscore::where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->OrderBy('Class','desc')->select('terminalscores.*','subjectsetups.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(200);

        return view('Terminalscore.listAdmin')->with(compact('rows','Class','Subject','getYear','getTerm'));  

    }else{

    // $rows= Terminalscore::where('students.StudentName','LIKE', "%$searchStr%")->leftjoin('subjects','terminalscores.SubjectID','=','subjects.SubjectID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.id')->select('terminalscores.*','subjects.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(20);

    $rows = Terminalscore::where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->where('SubjectID',$searchStr)->where('Class',$searchStr2)->GroupBy('terminalscores.id')->OrderBy('totalscore','desc')->select('terminalscores.*','subjectsetups.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(200);

       return view('Terminalscore.listAdmin')->with(compact('rows','Class','Subject','getYear','getTerm'));  
    
       }
    }else{
        
    if ((($searchStr == NULL)||($searchStr == "")) &&  (($searchStr2 == NULL)||($searchStr2 == ""))) {

        $rows = Terminalscore::where('SetupTeacherID',auth()->user()->SetupTeacherID)->where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->OrderBy('Class','desc')->select('terminalscores.*','subjectsetups.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(200);
        return view('Terminalscore.list')->with(compact('rows','Class','Subject','getYear','getTerm'));  
    }else{

    // $rows= Terminalscore::where('students.StudentName','LIKE', "%$searchStr%")->leftjoin('subjects','terminalscores.SubjectID','=','subjects.SubjectID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.id')->select('terminalscores.*','subjects.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(20);

    $rows = Terminalscore::where('SetupTeacherID',auth()->user()->SetupTeacherID)->where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->where('SubjectID',$searchStr)->where('Class',$searchStr2)->GroupBy('terminalscores.id')->OrderBy('totalscore','desc')->select('terminalscores.*','subjectsetups.SubjectName','classes.ClassName','students.StudentName','terms.TermName')->paginate(200);

    return view('Terminalscore.listforteachers')->with(compact('rows','Class','Subject','getYear','getTerm'));  
       }

        
     }

        
    }
}
