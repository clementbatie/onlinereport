<?php

namespace App\Http\Controllers;

use App\Classattendance;
use App\Classes;
use App\Classmember;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassattendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Classattendance::where('NationalID',auth()->user()->NationalID)
        ->groupBy('date','class_id')
        ->paginate(30);
        $classes = Classes::where('NationalID',auth()->user()->NationalID)->lists('classname','id');
        return view('classattendance.list',compact('rows','classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::where('NationalID',auth()->user()->NationalID)->lists('classname','id');
        $rows = [];
        return view("classattendance.create",compact('classes','rows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request,[
            'date' => 'required|date',
            'topic' => 'required|string',
            'classname' => 'required|numeric',
        ]);

        $classattendance = Classattendance::where('date',$request->date)->where('class_id',$request->classname);
        if ($classattendance->exists()) {
            return back()->withMessage('Attendance Exists for given class and date');
        }else{
            $classmembers = Classmember::where('class_id',$request->classname)->get();
            foreach ($classmembers as $key => $classmember) {
                # code...
                $classattendance = new Classattendance;
                $classattendance->date = $request->date; 
                $classattendance->class_id = $request->classname; 
                $classattendance->classmember_id = $classmember->id; 
                $classattendance->topic = $request->topic; 
                $classattendance->flag = 0; 
                $classattendance->NationalID = auth()->user()->NationalID; 
                $classattendance->save();
            }
        }
        return redirect()->route('classattendancemark',[$request->date,$request->classname]);
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
         $rows= Classattendance::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classattendance');
          }
          $classes = Classes::where('NationalID',auth()->user()->NationalID)->lists('classname','id');
          $classmembers = Classmember::find($rows->classmember_id)->lists('name','id');
        return view('classattendance.edit',compact('rows','classes','classmembers'));
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
        $this->validate($request,[
            'flag' => 'required|numeric'
        ]);
        $rows= Classattendance::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classattendance');
          }

          $rows->flag = $request->flag ;
          $rows->save();
        return redirect('classattendance')->withMessage('Record Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rows = Classattendance::find($id)->delete();
        Session::flash('message','Records Deleted!');
        Session::flash('alert-class','alert-danger');    
        return back();
    }

    public function delete($date,$class_id)
    {
        $rows = Classattendance::where('date',$date)->where('class_id',$class_id)->delete();
        Session::flash('message','Records Deleted!');
        Session::flash('alert-class','alert-danger');    
        return redirect('classattendance');
    }

    public function classattendancemark($date,$class_id)
    {
        //dd($data);
        $classmembers = Classmember::where('class_id',$class_id)->lists('name','id');
        $classes = Classes::where('NationalID',auth()->user()->NationalID)->lists('classname','id');
//dd($classmembers);
        return view("classattendance.create",compact('classes','rows','classmembers','date','class_id'));
    }

    public function classattendancemarkstore($date,$class_id,Request $request)
    {
        $this->validate($request,[
            'date' => 'required|date',
            'classmember' => 'required|array|min:1',
        ]);
       // return $request->all();
       
       $classattendance = Classattendance::whereIn('classmember_id',$request->classmember)
       ->where('class_id',$class_id)
       ->where('date',$date)
       ->where('NationalID',auth()->user()->NationalID)
       ->update(['flag' => 1]);

        return redirect('classattendance')->withMessage('Attendance Recorded');
    }

    public function showlist($date,$class_id)
    {
        $rows = Classattendance::where('NationalID',auth()->user()->NationalID)
        ->where('date',$date)
        ->where('class_id',$class_id)
        ->paginate(30);
        $classes = Classes::where('NationalID',auth()->user()->NationalID)->lists('classname','id');
        return view('classattendance.show',compact('rows','classes'));
    }


}
