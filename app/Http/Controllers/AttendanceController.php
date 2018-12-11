<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Meeting;
use App\Leader;
use App\Models\Area;
use App\Markattendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Meeting::groupBy('Meeting_Time','Meeting_Name')->paginate(30);
        return view('Attendance.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leaders = Leader::where('AreaID',auth()->user()->AreaID)->lists('name','id');
         return view('Attendance.create',compact('rows','leaders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formdata = $request->data;
       // return 2;
       // return $formdata['data'];
         $mark = (object)$formdata['data'][0];
        // return $mark->toArray();
        $meetingid = Meeting::where('Meeting_Name',$mark->Meeting_Name)
        ->where('date',$mark->date)
        ->where('Meeting_Time',$mark->Meeting_Time)
        ->first()->id;
       
        foreach ($formdata['data'] as $invite) {
            $meeting = Markattendance::where('Leader_id',$invite['Leader_Name'])->where('Meeting_id',$meetingid)->first();
            if (count($meeting) > 0) {
                $meeting->Attended = 1;
                $meeting->save();
            }
            
        }
        return $formdata['data'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows = Meeting::find($id);
        $leaders = Leader::where('AreaID',auth()->user()->AreaID)->lists('name','name');
        return view('Attendance.show',compact('rows','leaders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
         $rows = Meeting::find($id);
        $leaderid = Markattendance::where('Meeting_id',$id)->lists('Leader_id');
       $leaders = Leader::whereIn('id',$leaderid)->lists('name','id');
        //dd($request->fullUrl());
        return view('Attendance.edit',compact('rows','leaders'));
    }

    public function personedit($id,Request $request)
    {
        $rows = Markattendance::find($id);
        $leader = Leader::find($rows->Leader_id);
        $meeting = Meeting::find($rows->Meeting_id);
        return view('Attendance.personedit',compact('rows','leader','meeting'));
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
            'mark' => 'required|numeric'
        ]);
        if (!in_array($request->mark,[0,1])) {
            return back();
        }
        $attendance = Markattendance::find($id);
        $attendance->Attended = $request->mark;
        $attendance->save();
        \Session::flash('message','Record Updated');
        return redirect('Meeting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rows = Markattendance::find($id)->delete();
        \Session::flash('message','Record Deleted');
        return redirect('Meeting');
    }

     public function search(Request $request){
         $searchStr = $request->searchString;
      //   dd($searchStr);
        $rows= Leader::where('name','LIKE', "%".$searchStr."%")   
            ->leftjoin('markattendances','leaders.id','=','markattendances.Leader_id')   
            ->leftjoin('meetings','meetings.id','=','Meeting_id')      
            ->paginate(50);
         return view('Attendance.listpeople',compact('rows','leader','meeting'));
    }
}
