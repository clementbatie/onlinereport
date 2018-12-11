<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\OverallPosition;
use App\setupteachers;
use App\Terminalscore;
use App\teacher;
use App\classes;
use App\year_term_setup;

use DB;

use Session;
use Illuminate\Support\Facades\Input;

class OveralPositionController extends Controller
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
        
        $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('classes.ClassName','classes.ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('subjectsetups.SubjectName');

       $rows = OverallPosition::leftjoin('teachers','OverallPositions.ClassTeacherName','=','teachers.TeachersetupID')->leftjoin('students','OverallPositions.UniqueCode','=','students.UniqueCode')->leftjoin('terms','OverallPositions.TermID','=','terms.TermID')->leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->orderBy('OverallTotal','desc')->select('OverallPositions.*','classes.ClassName','terms.TermName','teachers.TeacherSetupName','students.StudentName')->paginate(200);

        
        return view('OverallTotal.list',compact('rows','Class','Subject','getTerm','getYear'));
      }else{

        // $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');

        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('ClassName','ClassID');

         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');

        $rows = OverallPosition::leftjoin('teachers','OverallPositions.ClassTeacherName','=','teachers.TeachersetupID')->leftjoin('students','OverallPositions.UniqueCode','=','students.UniqueCode')->leftjoin('terms','OverallPositions.TermID','=','terms.TermID')->leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->where('OverallPositions.ClassID',auth()->user()->Class)->orderBy('OverallTotal','desc')->select('OverallPositions.*','classes.ClassName','terms.TermName','teachers.TeacherSetupName','students.StudentName')->paginate(200);
//$rows = OverallPosition::where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->where('TermID',25)->get();
        //dd($rows);
        return view('OverallTotal.list',compact('rows','Class','Subject','getTerm','getYear'));
      }
    }


   // public function index2()
   // {dd(1);
   //    if ((auth()->user()->UserLevelID == 1) || auth()->user()->UserLevelID == 4) {
        
   //      $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
       
   //       $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');

   //     $rows = OverallPosition::leftjoin('teachers','OverallPositions.ClassTeacherName','=','teachers.TeachersetupID')->leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->orderBy('OverallTotal','desc')->get();

        
   //      return view('OverallTotal.list2',compact('rows','Class','Subject'));
   //    }else{

   //      $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
       
   //       $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');

   //      $rows = OverallPosition::leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->orderBy('OverallTotal','desc')->get();

   //      //dd($rows);
   //      return view('OverallTotal.list2',compact('rows','Class','Subject'));
   //    }
   // }

    public function search(Request $request){

        
    $searchStr2=Input::get('classID');

        $rows = Terminalscore::where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->where('Class',$searchStr2)->select('terminalscores.*',DB::raw('sum(totalscore) as total'),'students.StudentName')->GroupBy('terminalscores.id')->paginate(200);

         // $rows = Terminalscore::where('SetupTeacherID',auth()->user()->SetupTeacherID)->where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.UniqueCode')->where('Class',$searchStr2)->select('Terminalscores.*',DB::raw('sum(totalscore) as total'),'students.StudentName')->GroupBy('Terminalscores.id')->get();

//dd($rows);
         DB::table('OverallPositions')->where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',$searchStr2)->delete();

        foreach ($rows as $key => $value) {
//dd($value);
         

            // $UserEmailUser = OverallPosition::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',$searchStr2)->where('ClassTeacherName',auth()->user()->SetupTeacherID)->where('UniqueCode',$value->id);

            //   if ($UserEmailUser->exists()) {
            //        Session::flash('message','Class!');
            // Session::flash('alert-class','alert-warning');            
            // return redirect('overalposition');
            //     }  
            //dd($value);
            
            
            // $studentUniquecode = 
             // $studentName = $value->StudentName;
            // $className = 
            // $overallTotal = 
            // $year =  
            // $TermName = 
            // $classTeacherName = 
            // $schoolCode = 
//dd($value);
            $rows = new OverallPosition;

            $rows->UniqueCode = $value->id;
            $rows->StudentID = $value->id; 
            $rows->ClassID = $value->Class;
            $rows->OverallTotal = $value->total;
            $rows->Year = $value->Year;
            $rows->TermID = $value->TermID;
            $rows->Position = 0;
            $rows->ClassTeacherName = auth()->user()->SetupTeacherID;
            $rows->SchoolCode = auth()->user()->SchoolCode;


            $rows->save();

        }



        //Sent The user a message if he tries to come through this process with the same Class ID, This is supposed to be done once per Class, in case you still want to edit or go through here with the same ClassID The search and delete that class and do again//
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->paginate(200);
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;


        $check = OverallPosition::where('ClassTeacherName',auth()->user()->SetupTeacherID)->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','OverallPositions.TermID','=','terms.TermID')->leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.ClassID',$searchStr2)->orderBy('OverallTotal','desc')->lists('OverallPositionID');
       //dd($check);

        foreach ($check as $key => $value2) {
//dd($value2);
          // $getID = $check[0]->UniqueCode;

          
            $rows2 = OverallPosition::find($value2);

         if (is_null($rows2))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('overalposition');
          }

          $rows2->Position = $key + 1;

          $rows2->save();

         }
        //dd($check);

        Session::flash('message','OverallTotal Score Has Been Saved Successfully');

        return redirect('overalposition');
 
    }


    
      public function searchStudent(){

        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        if ((auth()->user()->UserLevelID == 1) || auth()->user()->UserLevelID == 4) {
        
        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->lists('subjectsetups.SubjectName');
        }else{

            // $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
            $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('ClassName','ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');
        }

        

    $searchStr=Input::get('getclassid');
//dd($searchStr);
    //$getClassID = classes::where('SchoolCode',auth()->user()->SchoolCode)->where('C')->lists()->first();
if ((auth()->user()->UserLevelID == 1) || auth()->user()->UserLevelID == 4) {
        
    $rows= OverallPosition::leftjoin('teachers','OverallPositions.ClassTeacherName','=','teachers.TeachersetupID')->leftjoin('terms','OverallPositions.TermID','=','terms.TermID')->leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.ClassID',$searchStr)->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->orderBy('OverallTotal','desc')->select('OverallPositions.*','classes.ClassName','terms.TermName','teachers.TeacherSetupName')->paginate(200);

        return view('OverallTotal.list')->with(compact('rows','Class','Subject','getTerm','getYear')); 
    }else{

        $rows= OverallPosition::leftjoin('teachers','OverallPositions.ClassTeacherName','=','teachers.TeachersetupID')->leftjoin('students','OverallPositions.UniqueCode','=','students.UniqueCode')->leftjoin('terms','OverallPositions.TermID','=','terms.TermID')->leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.ClassID',$searchStr)->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->where('ClassTeacherName',auth()->user()->SetupTeacherID)->orderBy('OverallTotal','desc')->select('OverallPositions.*','classes.ClassName','terms.TermName','teachers.TeacherSetupName','students.StudentName')->paginate(200);
 
        return view('OverallTotal.list')->with(compact('rows','Class','Subject','getTerm','getYear'));
    }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
