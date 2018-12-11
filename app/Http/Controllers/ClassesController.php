<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Terminalscore;
use App\Student;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getstudentclassess(Request $request){
        $this->validate($request,[
            'student' => 'required'
        ]);

       // $student = Terminalscore::where('id',$request->student)->leftjoin('classes','class','=','classes.ClassID')->orderBy('terminalscores.created_at','desc')->lists('ClassName','Class');
        
        $student = Student::where('UniqueCode',$request->student)->leftjoin('classes','students.ClassID','=','classes.ClassID')->orderBy('students.created_at','desc')->lists('ClassName','students.ClassID');

        return response()->json([
            'message' => 'correct',
            'details' => $student,
        ]);
    }

    public function getstudentclassessPrevious(Request $request){
        $this->validate($request,[
            'studentPrevious' => 'required'
        ]);
       // $student = Terminalscore::where('id',$request->student)->leftjoin('classes','class','=','classes.ClassID')->orderBy('terminalscores.created_at','desc')->lists('ClassName','Class');
        
        $student = Student::where('id',$request->studentPrevious)->leftjoin('classes','students.ClassID','=','classes.ClassID')->orderBy('students.created_at','desc')->lists('ClassName','students.ClassID');

        return response()->json([
            'message' => 'correct',
            'details' => $student,
        ]);
    }
}
