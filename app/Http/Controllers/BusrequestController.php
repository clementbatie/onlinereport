<?php

namespace App\Http\Controllers;

use App\Busregister;
use App\Busrequest;
use App\Http\Requests;
use App\Member;
use App\Models\Area;
use App\Models\Assembly;
use App\Models\District;
use App\Pickuplocation;
use App\Soulmember;
use App\Soulswon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BusrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Busrequest::where('CellCode',auth()->user()->CellID)->paginate(10);
        return view('busrequest.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $converts = Soulmember::where('CellCode',auth()->user()->CellID)->lists('name','id');
        $shepherds = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
        $pickuplocation = Pickuplocation::where('AreaID',auth()->user()->AreaID)->lists('location','id');
        $rows = [];
        return view('busrequest.create',compact('converts','shepherds','rows','pickuplocation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'date' => 'required|date',
            'pickuplocation' => 'required|numeric',
            'shepherd' => 'required|numeric',
            'time' => 'required|string',
            'converts' => 'required|array',
        ]);

        $convertsarrays = $request->converts;
        $convertsarray = [];
        foreach ($convertsarrays as $key => $value) {
            if ($value == "") {
                continue;
            }
            $convertsarray [] = $value ;
        }
        //return $convertsarray;
        $busreq = new Busrequest;
        $busreq->numberofsouls = count($convertsarray);
        $busreq->pickuplocation = $request->pickuplocation;
        $busreq->time = $request->time;
        $busreq->shepherd_id = $request->shepherd;
        $busreq->date = $request->date;
        $busreq->converts = json_encode($convertsarray);
        $busreq->comments = $request->comments;
        $busreq->CellCode = auth()->user()->CellID;
        $busreq->user_id = auth()->user()->id;
        $busreq->save();

        foreach ($convertsarray as $key => $value) {
           $rows = new Busregister;
           $rows->convert_id = $value;
           $rows->shepherd = $request->shepherd;
           $rows->busrequest = $busreq->id;
           $rows->date = $request->date;
           $rows->activity = 1;
           $rows->save();
        }
        

        Session::flash('message','Records Created!');
            Session::flash('alert-class','alert-info');   
        return redirect('busrequest');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows = Busrequest::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('busrequest.index');
          }
        $converts = Soulmember::where('CellCode',auth()->user()->CellID)->lists('name','id');
        $shepherds = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
        $pickuplocation = Pickuplocation::where('AreaID',auth()->user()->AreaID)->lists('location','id');
        return view('busrequest.show',compact('converts','shepherds','rows','pickuplocation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows = Busrequest::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('busrequest.index');
          }
        $converts = Soulmember::where('CellCode',auth()->user()->CellID)->lists('name','id');
        $shepherds = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
        $pickuplocation = Pickuplocation::where('AreaID',auth()->user()->AreaID)->lists('location','id');
        return view('busrequest.edit',compact('converts','shepherds','rows','pickuplocation'));
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
            'date' => 'required|date',
            'pickuplocation' => 'required|numeric',
            'shepherd' => 'required|numeric',
            'time' => 'required|string',
            'converts' => 'required|array',
        ]);

        $convertsarrays = $request->converts;
        $convertsarray = [];
        foreach ($convertsarrays as $key => $value) {
            if ($value == "") {
                continue;
            }
            $convertsarray [] = $value ;
        }

        $busreq = Busrequest::find($id);
        $busreq->numberofsouls = count($convertsarray);
        $busreq->pickuplocation = $request->pickuplocation;
        $busreq->time = $request->time;
        $busreq->shepherd_id = $request->shepherd;
        $busreq->date = $request->date;
        $busreq->converts = json_encode($convertsarray);
        $busreq->comments = $request->comments;
        $busreq->CellCode = auth()->user()->CellID;
        $busreq->user_id = auth()->user()->id;
        $busreq->save();

            Busregister::where('busrequest',$id)->delete();
        foreach ($convertsarray as $key => $value) {
          
            $rows = new Busregister;
           $rows->convert_id = $value;
           $rows->shepherd = $request->shepherd;
           $rows->date = $request->date;
           $rows->busrequest = $id;
           $rows->activity = 1;
           $rows->save();
        }
        //Busregister::where('busrequest',$id)->whereNotIn('convert_id',$convertsarray)->delete();
         Session::flash('message','Records Updated!');
         Session::flash('alert-class','alert-info');    
        return redirect('busrequest');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Busrequest::find($id)->delete();
        Session::flash('message','Records Deleted!');
         Session::flash('alert-class','alert-warning');    
        return redirect('busrequest');
    }

    public function search(Request $request){
        $rows = Busrequest::where('CellCode',auth()->user()->CellID)->where('date',$request->searchString)->paginate(10);
        return view('busrequest.list',compact('rows'));
    }

    public function busregister(){
        $rows = Busregister::where('flag',0)->orderBy('date','desc')->get();
        return view('busrequest.busregister',compact('rows'));
    }

    public function busregistermark($id){
        $rows = Busregister::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return back();
          }
          $conv = Soulmember::find($rows->convert_id) ? Soulmember::find($rows->convert_id)->CellCode : 0;
            $soul = new Soulswon;
            $soul->member_id = $rows->convert_id;
            $soul->visitor_id = $rows->shepherd;
            $soul->date = $rows->date;
            $soul->comments = "";
            $soul->CellCode = $conv;

            $memberdistrict = Assembly::where('AssemblyCode',$conv)->first()->DistrictID;
            $soul->DistrictID = $memberdistrict;
            $memberarea = District::where('DistrictID',$memberdistrict)->first()->AreaID;
             $soul->AreaID = $memberarea;

            $membernational = Area::where('AreaID',$memberarea)->first()->NationalID;
             $soul->NationalID = $membernational;

            $soul->activitytype = 2;
            $soul->status = "yes";
            $soul->user_id = auth()->user()->id;
            $soul->save();
            Session::flash('alert-class','alert-success');   

            $rows->flag = 1;
            $rows->save();
        return redirect('busregister')->withMessage('Record Marked Present');
    }

    public function busregisterabsent($id){
            $rows = Busregister::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return back();
          }
          $rows->flag = 2;
            $rows->save();
          Session::flash('alert-class','alert-danger');   
          return redirect('busregister')->withMessage('Record Marked Absent');
    }
}
