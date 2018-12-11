<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\testing;
use App\classes;
use App\year_term_setup;

use App\Http\Requests;
use Session;

class PromotestudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    
    public function promotestudentsSearch(Request $request)
    {
         $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $Classid = $request->classname;


        $output = Student::leftjoin('terms','students.Term','=','terms.TermID')->leftjoin('classes','students.ClassID','=','classes.ClassID')->where('students.ClassID',$Classid)->where('students.SchoolCode',auth()->user()->SchoolCode)->select('students.*','ClassName','TermName')->get();

        //dd($output);

        $school = [];
        $classes = [];
        $rows = [];
        $classes = [];
        $class = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

         return view('PromoteStudents.studentslist',compact('rows','class','output','school','classes','output','getYear','getTerm'));
    }

    public function promotestudents(Request $request)
    {
         $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

       $student = [];//Student::where('ClassID',$Classid)->where('SchoolCode',auth()->user()->SchoolCode)->get();
        $school = [];
        $classes = [];
        $output = [];
        $rows = [];
        $classes = [];
        $class = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        //dd($class);
         return view('PromoteStudents.studentslist',compact('rows','student','output','class','school','classes','output','getYear','getTerm'));

    }

    

    public function editStudent(Request $request)
    {dd(8);
        $student = [];
        $school = [];
        $classes = [];
        $output = [];
        $rows = [];



        return view('PromoteStudents.studentslist',compact('student','school','classes','output','rows'));
    }

    public function deleteStudent(Request $request)
     {//dd(5);
    //     rent::find($RentID)->delete();
    //     \Session::flash('message','Rent Has Been Deleted Successfully!');
    //     \Session::flash('alert-class','alert-warning');


////////////// Delet Multiple Data Code Working///////////////////////
         // Student::destroy($request->categories); 
         // Session::flash('message','Student Has Been Deleted Successfully!');
         // Session::flash('alert-class','alert-warning');
////////////// End Delet Multiple Data Code ///////////////////////


////////////// Start Code For Promotion ///////////////////////

         $from = $request->categories;

         $from2 = $request->classname2;

         //dd($from2);

         if (is_null($from)) {

             Session::flash('message','Nothing Selected,Please Select Students to be Promoted!');
             return redirect ('promotestudents');
         }else{
           
         $arr = array();

         foreach ($from as $key => $value) {

             $seed = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('id',$value)->first();
             $rr = $seed->ParentName;
             $rr2 = $seed->StudentName;
             $rr3 = $seed->Term;
             $rr4 = $seed->ParentNumber;
             $rr5 = $seed->Year;
             $rr6 = $seed->UniqueCode;
          
             Student::find($value)->delete();

             $test = new Student();
             $test->StudentName = $rr2;
             $test->UniqueCode = $rr6;
             $test->ParentName = $rr;
             $test->Term = $rr3;
             $test->ParentNumber = $rr4;
             $test->Year = $rr5;
             $test->ClassID = $request->classname2;
             $test->SchoolCode = auth()->user()->SchoolCode;

             $test->save();
     
            }

         $class = Classes::where('ClassID',$from2)->where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName');
         
         $string = str_replace(array('[',']'),'',$class);


               $AA = str_replace('"', '', $string);

               $AA2 = "Students Have Been Promoted To {$AA} Successfully"; 

             
              Session::flash('message',$AA2);
       
        
          return redirect ('promotestudents');
     }
 ////////////////////////End Code For Promotion //////////////////        
         
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
