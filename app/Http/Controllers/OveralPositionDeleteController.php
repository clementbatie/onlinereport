<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\OverallPosition;
use App\setupteachers;
use App\Terminalscore;
use DB;

use Session;
use Illuminate\Support\Facades\Input;

class OveralPositionDeleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ((auth()->user()->UserLevelID == 1) || auth()->user()->UserLevelID == 4) {
        
        $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');

       $rows = OverallPosition::leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->orderBy('OverallTotal','desc')->get();

        
        return view('OverallTotal.list2',compact('rows','Class','Subject'));
      }else{

        $Class = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('classes.ClassName','classes.ClassID');
       
         $Subject = setupteachers::leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->where('TeachersetupID',auth()->user()->SetupTeacherID)->lists('subjectsetups.SubjectName');

        $rows = OverallPosition::leftjoin('classes','OverallPositions.ClassID','=','classes.ClassID')->where('OverallPositions.SchoolCode',auth()->user()->SchoolCode)->orderBy('OverallTotal','desc')->get();

        //dd($rows);
        return view('OverallTotal.list2',compact('rows','Class','Subject'));
      }
    }


    public function deleteMultipleClass(Request $request)
    {
        dd(3);
         Student::destroy($request->categories); 
         Session::flash('message','Student Has Been Deleted Successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('student');
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
