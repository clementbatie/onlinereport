<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Terminalscore;
use App\Classes;
use App\Student;
use App\subject;
use App\Term;
use App\setupteachers;
use App\year_term_setup;

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
        if (auth()->user()->UserLevelID == 1) {
           $rows = Terminalscore::where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjects','terminalscores.SubjectID','=','subjects.SubjectID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.id')->select('terminalscores.*','subjects.SubjectName','classes.ClassName','students.StudentName','TermName')->paginate(20);
        }elseif (auth()->user()->UserLevelID == 2) {
            $rows = Terminalscore::where('SetupTeacherID',auth()->user()->SetupTeacherID)->where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjects','terminalscores.SubjectID','=','subjects.SubjectID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.id')->select('terminalscores.*','subjects.SubjectName','classes.ClassName','students.StudentName','TermName')->paginate(20);
        }elseif (auth()->user()->UserLevelID == 4) {
            $rows = Terminalscore::where('SetupTeacherID',auth()->user()->SetupTeacherID)->where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjects','terminalscores.SubjectID','=','subjects.SubjectID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('terms','terminalscores.TermID','=','terms.TermID')->leftjoin('students','terminalscores.id','=','students.id')->select('terminalscores.*','subjects.SubjectName','classes.ClassName','students.StudentName','TermName')->paginate(20);
        }
        
        
        return view('Terminalscore.list', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //  $select = [];
       //  $Class = Classes::lists('ClassName','ClassID');
       //  $StudentName = Student::get();
       // // dd($StudentName);
       //  $Subject = subject::lists('SubjectName','SubjectID');
       //  $Year = year_term_setup::lists('Year','Year');
       //  $Term = year_term_setup::leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

       // return view('Terminalscore.create', compact('Class','StudentName','Subject','Year','Term','select'));


        $Class = setupteachers::where('SetupTeacherID',auth()->user()->SetupTeacherID)->lists('ClassID');

        //$Class = setupteachers::leftjoin('users','users.SetupTeacherID','=','setupteachers.SetupTeacherID')->where('SetupTeacherID',auth()->user()->ClassID)->lists('ClassName');

        $array = array();
        $decode = json_decode($Class,true);
    
        $class2 =  $decode[0];

        //dd($Class);

             $string = str_replace(array('[',']'),'',$class2);

             $AA = str_replace('"', '', $string);

            // $pp = string.split(',');


         $arr=explode(",",$AA);
             //$check = $array;

     // dd($arr);        

     

        $Class2 = Classes::whereIn('ClassID',$arr)->lists('ClassName','ClassID');
   //dd($Class2);

        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->get();
        $Subject = subject::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectID');
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

      return view('Terminalscore.create', compact('Class','StudentName','Subject','Year','Term','Class2'));
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
           $member = new Terminalscore;
           $member->Year  = $value->year; 
           $member->TermID = $value->term; 
           $member->Class  = $value->Class;
           $member->id  = $value->studentname; 
           $member->SubjectID = $value->subjectname; 
           

           $member->classscore  = $value->classscore;
           $member->examscore  = $value->examscore; 

           $member->totalscore = $value->classscore + $value->examscore;

           $member->position = $value->position; 
           $member->remarks  = $value->remarks;
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
       
        $Class = setupteachers::where('SetupTeacherID',auth()->user()->SetupTeacherID)->lists('ClassID');

        $array = array();
        $decode = json_decode($Class,true);
    
        $class2 =  $decode[0];

        //dd($Class);

             $string = str_replace(array('[',']'),'',$class2);

             $AA = str_replace('"', '', $string);

            // $pp = string.split(',');


         $arr=explode(",",$AA);
             //$check = $array;

     // dd($arr);        

     

        $Class2 = Classes::whereIn('ClassID',$arr)->lists('ClassName','ClassID');
   //dd($Class2);

        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->get();
        $Subject = subject::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectID');
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

        $rows= Terminalscore::find($TerminanlScoreID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('terminalscore');
          }
          
        return view('Terminalscore.show',compact('rows','Class','StudentName','Subject','Year','Term','Class2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($TerminanlScoreID)
    {

      $Class = setupteachers::where('SetupTeacherID',auth()->user()->SetupTeacherID)->lists('ClassID');

        $array = array();
        $decode = json_decode($Class,true);
    
        $class2 =  $decode[0];

        //dd($Class);

             $string = str_replace(array('[',']'),'',$class2);

             $AA = str_replace('"', '', $string);

            // $pp = string.split(',');


         $arr=explode(",",$AA);
             //$check = $array;

        $Class2 = Classes::whereIn('ClassID',$arr)->lists('ClassName','ClassID');

        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->get();
        $Subject = subject::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectID');
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

        $rows= Terminalscore::find($TerminanlScoreID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('terminalscore');
          }
          
        return view('Terminalscore.edit',compact('rows','Class','StudentName','Subject','Year','Term','Class2'));
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
            'Year' => 'required',
            'Term' => 'required',
            'Class' => 'required',
            'member' => 'required',
            'SubjectID' => 'required',
            'classscore' => 'required',
            'examscore' => 'required',
            'position' => 'required',
            'remarks' => 'required',
        ]);
        $rows = Terminalscore::find($TerminanlScoreID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('terminalscore');
          }

        $rows->Year = $request->Year;
        $rows->TermID = $request->Term;
        $rows->Class = $request->Class;
        $rows->id = $request->member;
        $rows->SubjectID = $request->SubjectID;
        $rows->classscore = $request->classscore;
        $rows->examscore = $request->examscore;
        $rows->position = $request->position;
        $rows->remarks = $request->remarks;
        $rows->SchoolCode = auth()->user()->SchoolCode;
        $rows->SetupTeacherID = auth()->user()->SetupTeacherID;

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


    public function search(){

    $searchStr=Input::get('searchString');

    $rows= Terminalscore::where('students.StudentName','LIKE', "%$searchStr%")->leftjoin('subjects','terminalscores.SubjectID','=','subjects.SubjectID')->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->leftjoin('students','terminalscores.id','=','students.id')->select('terminalscores.*','subjects.SubjectName','classes.ClassName','students.StudentName')->paginate(20);

        return view('Terminalscore.list')->with(compact('rows'));  
    }
}
