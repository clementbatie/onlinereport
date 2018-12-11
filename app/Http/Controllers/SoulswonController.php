<?php

namespace App\Http\Controllers;

use App\Activitytype;
use App\Busregister;
use App\Http\Requests;
use App\Member;
use App\Models\Area;
use App\Models\Assembly;
use App\Models\District;
use App\Soulmember;
use App\Soulswon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class SoulswonController extends Controller
{
     public function index()
    {
    	switch (auth()->user()->UserLevelID) {
    		case '4':
    		$soulswon = Soulswon::where('soulswon.NationalID',auth()->user()->NationalID);
       // dd($soulswon->get());
        break;
    		case '1':
    		$soulswon = Soulswon::where('soulswon.AreaID',auth()->user()->AreaID);
        break;
    		case '2':
    	$soulswon = Soulswon::where('soulswon.DistrictID',auth()->user()->DistrictID);
      break;
    		case '3':
    	$soulswon = Soulswon::where('soulswon.CellCode',auth()->user()->CellID);
    			break;
    		default:
    			# code...
    			break;
    	}//dd($soulswon->get());
        $rows = $soulswon->leftjoin('assembly','assembly.AssemblyCode','=','soulswon.CellCode')
        ->leftjoin('soulmembers','soulmembers.id','=','member_id')
        ->leftjoin('members as visitor','visitor.id','=','visitor_id')
        ->leftjoin('activitytypes','activitytypes.id','=','soulswon.activitytype')
        ->select('soulswon.date','soulswon.comments','soulswon.status','assembly.AssemblyName','visitor.name as visitorname','soulmembers.name','activitytypes.activitytype','soulswon.id','soulswon.visitor_id')
        ->paginate(30);
        //dd($soulswon->get());
        return view('soulswon.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $activitytype = Activitytype::where('NationalID',auth()->user()->NationalID)->lists('activitytype','id');
      switch (auth()->user()->UserLevelID) {
        case '3':
       $cells = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
          break;
        case '2':
       $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
          break;
        case '1':
        $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       $cells = Assembly::wherein('DistrictID',$districts)->lists('AssemblyCode');
          break;
        case '4':
        $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
        $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
       $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
      // dd($cells);
          break;
        default:
          # code...
          break;
      }
      $members = Soulmember::whereIn('CellCode',$cells)->lists('name','id');
      $visitor = Member::whereIn('CellCode',$cells)->lists('name','id');
      //dd($members);
      $rows = [];
      return view('soulswon.create',compact('activitytype','members','visitor','rows'));
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
            'data' => 'required'
        ]);
        
        $formdata = $request->data;

        //check for existence
        foreach ($formdata['data'] as $key => $value) {
          $value = (object)$value;
          $convertactivity = Soulswon::where('soulswon.activitytype',$value->activitytype)->where('soulswon.member_id',$value->member)->where('soulswon.date',$value->date);
          if ($convertactivity->exists()) {
            $convertactivity = $convertactivity->leftjoin('soulmembers','soulmembers.id','=','soulswon.member_id')->leftjoin('activitytypes','activitytypes.id','=','soulswon.activitytype')->get(['name','contact','soulswon.date','activitytypes.activitytype'])->toArray();
            return response()->json([
              'message' => 'exists',
              'person' => $convertactivity
            ]);
          }
        }

        //proceed to insert
        foreach ($formdata['data'] as $key => $value) {
        	$value = (object)$value;
        	$soul = new Soulswon;
        	$soul->activitytype = $value->activitytype;
        	$soul->member_id = $value->member;

            $membercell = Soulmember::find($value->member)->CellCode;
            $soul->CellCode = $membercell;

            $memberdistrict = Assembly::where('AssemblyCode',$membercell)->first()->DistrictID;
            $soul->DistrictID = $memberdistrict;
            $memberarea = District::where('DistrictID',$memberdistrict)->first()->AreaID;
             $soul->AreaID = $memberarea;

            $membernational = Area::where('AreaID',$memberarea)->first()->NationalID;
             $soul->NationalID = $membernational;


        	$soul->visitor_id = $value->visitor;
        	$soul->date = $value->date;
        	$soul->comments = $value->comments;

          if ($soul->activitytype == '2') {
            $soul->destination = $value->to;
           }
        	
            $soul->status = $value->status;
        	$soul->user_id = auth()->user()->id;
        	
        	$soul->save();

           if ($soul->activitytype == '2') {
            $rows = new Busregister;
            $rows->convert_id = $value->member;
            $rows->shepherd = $value->visitor;
            $rows->date = $value->date;
            $rows->busrequest = 0;
            $rows->activity = 1;
            $rows->flag = 1;
            $rows->save();
           }
        }
       
         return response()->json(['message'=>'correct']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows = Soulswon::find($id);
        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('soulswon.index');
          }
      $activitytype = Activitytype::where('NationalID',auth()->user()->NationalID)->lists('activitytype','id');
       switch (auth()->user()->UserLevelID) {
        case '3':
       $cells = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
          break;
        case '2':
       $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
          break;
        case '1':
        $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       $cells = Assembly::wherein('DistrictID',$districts)->lists('AssemblyCode');
          break;
        case '4':
        $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
        $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
       $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
      // dd($cells);
          break;
        default:
          # code...
          break;
      }
      $members = Soulmember::whereIn('CellCode',$cells)->lists('name','id');
      $visitor = Member::whereIn('CellCode',$cells)->lists('name','id');
      return view('soulswon.show')->with(compact('rows','activitytype','members','visitor'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows = Soulswon::find($id);
        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('soulswon.index');
          }
    $activitytype = Activitytype::where('NationalID',auth()->user()->NationalID)->lists('activitytype','id');
      switch (auth()->user()->UserLevelID) {
        case '3':
       $cells = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
          break;
        case '2':
       $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
          break;
        case '1':
        $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       $cells = Assembly::wherein('DistrictID',$districts)->lists('AssemblyCode');
          break;
        case '4':
        $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
        $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
       $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
      // dd($cells);
          break;
        default:
          # code...
          break;
      }
      $members = Soulmember::whereIn('CellCode',$cells)->lists('name','id');
      $visitor = Member::whereIn('CellCode',$cells)->lists('name','id');
      return view('soulswon.edit')->with(compact('rows','activitytype','members','visitor'));   
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
            'activitytype' => 'required|numeric',
            'member' => 'required|numeric',
            'visitor' => 'required|numeric',
        ]);
        
            $soul = Soulswon::find($id);
            if (is_null($soul))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return back();
          }
            $soul->activitytype = $request->activitytype;
            $soul->member_id = $request->member;
            $soul->visitor_id = $request->visitor;
            $soul->date = $request->date;
            $soul->comments = $request->comments;
            $soul->status = $request->status;
            $soul->CellCode = auth()->user()->CellID;
            $soul->save();

            Session::flash('message','Records Updated!');
            Session::flash('alert-class','alert-success');            
            return redirect('soulswon');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Soulswon::find($id)->delete();
        return redirect ('soulswon');
    }

    public function search(Request $request)
    {
        
        switch (auth()->user()->NationalID) {
            case '4':
            $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
        $cellcodes = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
            case '1':
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
        $cellcodes = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
            case '2':
        $cellcodes = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
            case '3':
        $cellcodes = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
                break;
            default:
                # code...
                break;
        }
        $searchStr=Input::get('searchString');
        $rows =  Soulswon::whereIn('soulswon.CellCode',$cellcodes)->leftjoin('assembly','assembly.AssemblyCode','=','soulswon.CellCode')
        ->leftjoin('soulmembers','soulmembers.id','=','member_id')
        ->leftjoin('members as visitor','visitor.id','=','visitor_id')
        ->leftjoin('activitytypes','activitytypes.id','=','soulswon.activitytype')
        ->where('soulmembers.name','LIKE', "%$searchStr%")  
        ->select('soulswon.date','soulswon.comments','soulswon.status','assembly.AssemblyName','visitor.name as visitorname','soulmembers.name','activitytypes.activitytype','soulswon.id','soulswon.visitor_id')
        ->paginate(30);
         return view('soulswon.list',compact('rows'));
    }

    public function counsel(){
        $rows = Busregister::where('flag',1)->orderBy('date','desc')->get();
        return view('soulswon.counselregister',compact('rows'));
    }

    public function counselmark($id){
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

            $soul->activitytype = 6;
            $soul->status = "yes";
            $soul->user_id = auth()->user()->id;
            $soul->save();
            Session::flash('alert-class','alert-success');   

            $rows->flag = 3;
            $rows->save();
        return redirect('counsel')->withMessage('Record Marked Present');
    }

    public function counselabsent($id){
            $rows = Busregister::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return back();
          }
          $rows->flag = 4;
            $rows->save();
          Session::flash('alert-class','alert-danger');   
          return redirect('counsel')->withMessage('Record Marked Absent');
    }

     public function churchattendance(){
        $rows = Busregister::where('churchattendance',null)->orderBy('date','desc')->get();
        return view('soulswon.churchattendance',compact('rows'));
    }

    public function churchattendancemark($id){
        $rows = Busregister::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return back();
          }
          $conv = Soulmember::find($rows->convert_id) ? Soulmember::find($rows->convert_id)->CellCode : 0;
            $soul = Soulswon::whereIn('activitytype',[4,7])->where('member_id',$rows->convert_id)->where('date',$rows->date);
           // dd($soul->get());
            if ($soul->exists()) {
              $rows->churchattendance = 1;
              $rows->save();
              return redirect('churchattendance')->withMessage('Record Marked Present');
            }else{
              $soul = new Soulswon;
            }
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

            $soul->activitytype = 7;
            $soul->status = "yes";
            $soul->user_id = auth()->user()->id;
            $soul->save();
            Session::flash('alert-class','alert-success');   

            $rows->churchattendance = 1;
            $rows->save();
        return redirect('churchattendance')->withMessage('Record Marked Present');
    }

    public function churchattendanceabsent($id){
            $rows = Busregister::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return back();
          }
            $rows->churchattendance = 0;
            $rows->save();
          Session::flash('alert-class','alert-danger');   
          return redirect('churchattendance')->withMessage('Record Marked Absent');
    }
}
