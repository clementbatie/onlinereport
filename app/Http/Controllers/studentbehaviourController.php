<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\studentperformances;
use App\Terminalscore;
use App\Classes;
use App\Student;
use App\subject;
use App\Term;
use App\year_term_setup;

use Session;
use Illuminate\Support\Facades\Input;

class studentbehaviourController extends Controller
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

    $rows = studentperformances::where('studentperformances.SchoolCode',auth()->user()->SchoolCode)->leftjoin('classes','studentperformances.ClassID','=','classes.ClassID')->leftjoin('terms','studentperformances.Term','=','terms.TermID')->leftjoin('students','studentperformances.id','=','students.UniqueCode')->select('studentperformances.*','classes.ClassName','students.StudentName','terms.TermName')->paginate(10);
       
        return view('Studentbehaviour.list', compact('rows','getYear','getTerm'));
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

        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;
        $PromotedTo = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

        $Class = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');
        $Subject = subject::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectID');
        $Year = year_term_setup::where('SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

         return view('Studentbehaviour.create', compact('Class','StudentName','Subject','Year','Term','PromotedTo','getYear','getTerm'));
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

        $getTerm = $Term[0]->TermID;

        $getYear = $Year[0]->Year;

         foreach ($data->data as $key => $value) {
          $value = (object)$value;

                $UserEmailUser = studentperformances::where('studentperformances.SchoolCode',auth()->user()->SchoolCode)->where('studentperformances.ClassID',$value->ClassofStudent)->where('studentperformances.id',$value->studentname);

              if ($UserEmailUser->exists()) {
              $UserEmailUser = $UserEmailUser->leftjoin('students','studentperformances.id','=','students.UniqueCode')->leftjoin('classes','studentperformances.ClassID','=','classes.ClassID')->get(['students.StudentName','classes.ClassName'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'UserEmailUser' => $UserEmailUser
                  ]);
                }  
            }
            
            foreach ($data->data as $value) {
           
           $value = (object)$value;
           $member = new studentperformances;
           $member->Year  = $getYear; 
           $member->Term = $getTerm; 
           $member->ClassID = $value->ClassofStudent;
           $member->id = $value->studentname; 
           // $member->PromotedTo = $value->PromotedTo; 
           $member->AttendanceExpected  = $value->AttendanceExpected;
           $member->ActualAttendance  = $value->ActualAttendance; 
           $member->Interest = $value->Interest; 
           $member->CharacterOfStu  = $value->CharacterOfStu;
           $member->ClassTeacherRemarks = $value->ClassTeacherRemarks;
           $member->HeadTeacherRemarks = $value->HeadTeacherRemarks;

            $member->SchoolCode  = auth()->user()->SchoolCode;
           
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
    public function show($StudentPerformanceID)
    {
         $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;
        
        $rows= studentperformances::find($StudentPerformanceID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('studentbehaviour');
          }
         
         $PromotedTo = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

        $Class = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');
        $Subject = subject::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectID');
        $Year = year_term_setup::where('SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

          
    return view('Studentbehaviour.show',compact('rows','Class','StudentName','Subject','Year','Term','PromotedTo','getTerm','getYear'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($StudentPerformanceID)
    {
         $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows= studentperformances::find($StudentPerformanceID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('studentbehaviour');
          }
      
       $PromotedTo = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

        $Class = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $StudentName = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');
        $Subject = subject::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectID');
        $Year = year_term_setup::where('SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

          
     return view('Studentbehaviour.edit',compact('rows','Class','StudentName','Subject','Year','Term','PromotedTo','getTerm','getYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $StudentPerformanceID)
    {
         $this->validate($request,[
            // 'Year' => 'required',
            // 'Term' => 'required',
            'ClassID' => 'required',
            'id' => 'required',
            // 'PromotedTo' => 'required',
            'AttendanceExpected' => 'required',
            'ActualAttendance' => 'required',
            'Interest' => 'required',
            'CharacterOfStu' => 'required',
            'ClassTeacherRemarks' => 'required',
            'HeadTeacherRemarks' => 'required',
        ]);
        $rows = studentperformances::find($StudentPerformanceID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('studentbehaviour');
          }



            //     $UserEmailUser = studentperformances::where('studentperformances.SchoolCode',auth()->user()->SchoolCode)->where('studentperformances.ClassID',$request->ClassID)->where('studentperformances.id',$request->id);

            //   if ($UserEmailUser->exists()) {
              
            //      Session::flash('message','Cannot Add Same Student Behaviour Twice!');
            // Session::flash('alert-class','alert-warning');            
            // return redirect('studentbehaviour'); 

            //     }  
            


        // $rows->Year = $request->Year;
        // $rows->Term = $request->Term;
        $rows->ClassID = $request->ClassID;
        $rows->id = $request->id;
        // $rows->PromotedTo = $request->PromotedTo;
        $rows->AttendanceExpected = $request->AttendanceExpected;
        $rows->ActualAttendance = $request->ActualAttendance;
        $rows->Interest = $request->Interest;
        $rows->CharacterOfStu = $request->CharacterOfStu;
        $rows->ClassTeacherRemarks = $request->ClassTeacherRemarks;
        $rows->HeadTeacherRemarks = $request->HeadTeacherRemarks;
        

        $rows->save();

        Session::flash('message','Student Behaviour Has Been Edited Successfully');

        return redirect('studentbehaviour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($StudentPerformanceID)
    {
        studentperformances::find($StudentPerformanceID)->delete();
        \Session::flash('message','Student Behaviour Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('studentbehaviour');
      
    }

    public function deleteMultiple(Request $request)
    {
        studentperformances::destroy($request->categories11); 
         Session::flash('message','Student Behaviour has been deleted successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('studentbehaviour');
    }

    public function search()
    {
         $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;
      
     $searchStr=Input::get('searchString');

    $rows= studentperformances::where('students.StudentName','LIKE', "%$searchStr%")->leftjoin('classes','studentperformances.ClassID','=','classes.ClassID')->leftjoin('terms','studentperformances.Term','=','terms.TermID')->leftjoin('students','studentperformances.id','=','students.id')->select('studentperformances.*','classes.ClassName','students.StudentName','terms.TermName')->paginate(20);

        return view('Studentbehaviour.list')->with(compact('rows','getYear','getTerm')); 
    }
}
