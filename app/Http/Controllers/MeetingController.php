<?php

namespace App\Http\Controllers;

use App\Cellmeetingattendance;
use App\Http\Requests;
use App\Leader;
use App\Markattendance;
use App\Meeting;
use App\Member;
use App\Membertype;
use App\Models\Area;
use App\Models\Assembly;
use App\Models\District;
use App\Shortcode;
use App\Title;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        switch (auth()->user()->UserLevelID) {
            case '1':
           
          $rows = Meeting::groupBy('Meeting_Time','Meeting_Name')->where('AreaID',auth()->user()->AreaID)->paginate(30);
                break;
            case '4':
         //   $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
          $rows = Meeting::groupBy('Meeting_Time','Meeting_Name')->where('NationalID',auth()->user()->NationalID)->paginate(30);
                break;
            default:
              $rows = [];
                break;
        }
        
        return view('Meeting.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        switch (auth()->user()->UserLevelID) {
            case '1':
              $leaders = Leader::where('AreaID',auth()->user()->AreaID)->lists('name','id');
                break;
            case '4':
            $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
              $leaders = Leader::whereIn('AreaID',$areas)->lists('name','id');
                break;
            
            default:
              $leaders = [];
                break;
        }
       $titles = Title::where('NationalID',auth()->user()->NationalID)->lists('title','title');
         return view('Meeting.create',compact('rows','leaders','titles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formdata = Input::get('data');
        $ob = (object)$formdata['data'][0];

         $meeting = new Meeting;
         $meeting->Meeting_Name = $ob->Meeting_Name;
         $meeting->Meeting_Time = $ob->Meeting_Time;
         $meeting->date = $ob->date;
         switch (auth()->user()->UserLevelID) {
            case '1':
              $meeting->AreaID = auth()->user()->AreaID;
                break;
             case '4':
              $meeting->AreaID = auth()->user()->AreaID;
              $meeting->NationalID = auth()->user()->NationalID;
                break;
            default:
            break;
        }
        
         $meeting->save();
       //  return $meeting;
        foreach ($formdata['data'] as $invite) {
            $attendance = new Markattendance;
            $attendance->Meeting_id = $meeting->id;
            $attendance->Attended = 0;
            $attendance->Leader_id = $invite['Leader_Name'];
            $attendance->save();
        }
        return $formdata;
    }

    public function createmeetingall(Request $request)
    {
        $formdata = Input::get('data');
        $ob = (object)$formdata['data'][0];
        
         $meeting = new Meeting;
         $meeting->Meeting_Name = $ob->Meeting_Name;
         $meeting->Meeting_Time = $ob->Meeting_Time;
         $meeting->date = $ob->date;
//return $ob->titles;
         switch (auth()->user()->UserLevelID) {
            case '1':
              $meeting->AreaID = auth()->user()->AreaID;
              $leaders = Leader::where('AreaID',auth()->user()->AreaID)->leftjoin('positions','positions.leader_id','=','leaders.id')->whereIn('positions.title',$ob->titles)->lists('leaders.id');
                break;
             case '4':
              //$meeting->AreaID = auth()->user()->AreaID;
              $meeting->NationalID = auth()->user()->NationalID;
              $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
              $leaders = Leader::whereIn('AreaID',$areas)->leftjoin('positions','positions.leader_id','=','leaders.id')->whereIn('positions.title',$ob->titles)->lists('leaders.id');
                break;
            default:
            break;
        }

        if (!Meeting::where('Meeting_Name',$ob->Meeting_Name)->where('Meeting_Time',$ob->Meeting_Time)->where('date',$ob->date)->exists()) {
             $meeting->save();
            // return $leaders;
                    foreach ($leaders as $leader) {
            $attendance = new Markattendance;
            $attendance->Meeting_id = $meeting->id;
            $attendance->Attended = 0;
            $attendance->Leader_id = $leader;
            $attendance->save();
                                                }
             }else{
                $meeting =Meeting::where('Meeting_Name',$ob->Meeting_Name)->where('Meeting_Time',$ob->Meeting_Time)->where('date',$ob->date)->first();
             }
        
       
       return response()->json([
            'message' => 'correct'
       ]);
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
        $rows = Markattendance::where('Meeting_id',$id)->leftjoin('meetings','meetings.id','=','Meeting_id')->leftjoin('leaders','leaders.id','=','Leader_id')->select('markattendances.*','meetings.Meeting_Name','meetings.Meeting_Time','meetings.date','leaders.name')->paginate(50);
         return view('Attendance.listpeople',compact('rows'));
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
    {  // dd($id);
        $meeting = Meeting::find($id)->delete();
        return redirect('Meeting');
    }

    public function test(Request $request){
        return $request->all();
    }

   

    public function log(Request $request){
      //  return $request->fullUrl();
          $formdata = Input::get('data');
         $ob = $formdata['data'][0];
        
        return $ob->FromDate;
    }
}
