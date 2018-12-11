<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Member;
use App\Models\Area;
use App\Models\Assembly;
use App\Models\District;
use App\Outreach;
use Illuminate\Http\Request;

class OutreachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (auth()->user()->UserLevelID) {
            case '4':
            $area = Area::where('NationalID',auth()->user()->NationalID);
            $district = District::whereIn('AreaID',$area->lists('AreaID'));
            $cells = Assembly::whereIn('DistrictID',$district->lists('DistrictID'))->lists('AssemblyCode');
            break;
            case '1':
            $district = District::where('AreaID',auth()->user()->AreaID);
            $cells = Assembly::whereIn('DistrictID',$district->lists('DistrictID'))->lists('AssemblyCode');
            break;
            case '2':
            $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
            break;
            case '3':
            $cells = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
            break;
            default:
                # code...
            break;
        }//dd($soulswon->get());
        $rows = Outreach::whereIn('CellCode',$cells)->leftjoin('assembly','AssemblyCode','=','CellCode')->select('outreaches.*','AssemblyName')->orderBy('date','desc')->paginate(30);
        return view('outreach.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        switch (auth()->user()->UserLevelID) {
            case '3':
            $cells = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
            break;
            case '2':
            $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
            break;
            case '1':
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
            $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
            break;
            case '4':
            $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
            $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
            break;
            default:
            $cells = [];
            break;
        }
        $members = Member::whereIn('CellCode',$cells)->lists('name','id');
        $rows = [];
        $cell = Assembly::whereIn('AssemblyCode',$cells)->lists('AssemblyName','AssemblyCode');
        return view('outreach.create',compact('activitytype','members','rows','cell'));
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
            'location' => 'required|string',
            'CellCode' => 'required|string|unique:outreaches,CellCode,NULL,id,date,' . $request->date,
            'date' => 'required|date',
            'converts' => 'required|numeric',
            'member' => 'required|array|min:1',
        ],[
            'CellCode.unique' => "Data already exists for given Cell and Date"
        ]);

        $participants = [];
        foreach ($request->member as $key => $value) {
            if ($value == "") {
             continue;
         }else{
          $participants [] = $value;
      }

  }

  $outreach = new Outreach;
  $outreach->date = $request->date;
  $outreach->participants = json_encode($participants);
  $outreach->date = $request->date;
  $outreach->converts = $request->converts;
  $outreach->outreachname = "Outreach";
  $outreach->outreachlocation = $request->location;
  $outreach->comments = $request->comments;
  $outreach->CellCode = $request->CellCode;
  $outreach->user_id = auth()->user()->id;
  $outreach->save();
  \Session::flash('message','Record Added');
  \Session::flash('alert-class','alert-success'); 
  return redirect('outreach');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        switch (auth()->user()->UserLevelID) {
            case '3':
            $cells = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
            break;
            case '2':
            $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
            break;
            case '1':
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
            $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
            break;
            case '4':
            $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
            $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
            break;
            default:
            $cells = [];
            break;
        }
        $members = Member::whereIn('CellCode',$cells)->lists('name','id');
        $rows = [];
        $cell = Assembly::whereIn('AssemblyCode',$cells)->lists('AssemblyName','AssemblyCode');
        $rows = Outreach::find($id);
        return view('outreach.show',compact('activitytype','members','rows','cell'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         switch (auth()->user()->UserLevelID) {
            case '3':
            $cells = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
            break;
            case '2':
            $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
            break;
            case '1':
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
            $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
            break;
            case '4':
            $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
            $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
            break;
            default:
            $cells = [];
            break;
        }
        $members = Member::whereIn('CellCode',$cells)->lists('name','id');
        $rows = [];
        $cell = Assembly::whereIn('AssemblyCode',$cells)->lists('AssemblyName','AssemblyCode');
        $rows = Outreach::find($id);
        return view('outreach.edit',compact('activitytype','members','rows','cell'));
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
           'location' => 'required|string',
            'CellCode' => 'required|string',
            'date' => 'required|date',
            'converts' => 'required|numeric',
        ]);

               $participants = [];
        foreach ($request->member as $key => $value) {
            if ($value == "") {
             continue;
         }else{
          $participants [] = $value;
      }

  }
  $outreach = Outreach::find($id);
        //$outreach->date = $request->date;
        $outreach->participants = json_encode($participants);
  $outreach->date = $request->date;
  $outreach->converts = $request->converts;
  $outreach->outreachname = "Outreach";
  $outreach->outreachlocation = $request->location;
  $outreach->comments = $request->comments;
  $outreach->CellCode = $request->CellCode;
  $outreach->user_id = auth()->user()->id;
  $outreach->save();
  \Session::flash('message','Record Updated');
  \Session::flash('alert-class','alert-success');    
  return redirect('outreach');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Outreach::where('id',$id)->delete();
        \Session::flash('message','Record deleted!');
        \Session::flash('alert-class','alert-warning');    
        return redirect('outreach');
    }
}
