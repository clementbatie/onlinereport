<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Position;
use App\Models\Assembly;
use App\Models\District;
use App\Models\Area;
use App\Leader;
use App\Title;
use Session;
use App\Positionlog;
use Illuminate\Support\Facades\Input;

class ZonepositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        if (auth()->user()->UserLevelID == 1) {
            $rows= Position::join('leaders',"leaders.id","=","leader_id")
             ->where('CellCode',"")->where('Zone_Name','!=',"")
             ->leftjoin('district','district.DistrictID','=','positions.Zone_Name')
             ->where('positions.Area_Name',auth()->user()->AreaID)
            ->select('positions.*','leaders.id as leadersid','leaders.name as name','district.DistrictName')
            ->paginate(15);
        }elseif (auth()->user()->UserLevelID == 4) {
             $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $rows= Position::join('leaders',"leaders.id","=","leader_id")
             ->where('CellCode',"")->where('Zone_Name','!=',"")
            ->leftjoin('district','district.DistrictID','=','positions.Zone_Name')
            ->whereIn('positions.Area_Name',$areas)
            ->select('positions.*','leaders.id as leadersid','leaders.name as name')->paginate(15);
        }else{
            return redirect('/');
        }
      
      //   dd($rows);
        return view('Zonepositions.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    // $cell = Assembly::lists('AssemblyName','AssemblyName');
     switch (auth()->user()->UserLevelID) {
         case '1':
      //   $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
      //       $cell = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
     $zone = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');
     $area = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
     $leader = Leader::where('AreaID',auth()->user()->AreaID)->lists("name","id");
     $title = Title::lists("title","title");
             break;
         case '4':
         $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
         $zone = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');
     //    $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
     //     $cell = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
     
     
     $leader = Leader::where('AreaID',auth()->user()->AreaID)->lists("name","id");
     $title = Title::lists("title","title");
         break;
         default:
             # code...
             break;
     }
        return view('Zonepositions.create',compact('cell','zone','area','leader','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     

     $data = $request->data;
        //   return $data;
            foreach ($data['data'] as $value) {
    $user =  Position::where('leader_id',$value['leader'])->join('leaders',"leaders.id","=","leader_id");
    $user2 = $user;
   // return $user2;
    if ($user->exists()) {
     //   return 3;
        $user = $user->first();
         $position = new Positionlog;
        $position->title = $user->title;
        $position->leader_id = $user->name;
       // $position->CellCode = $user->CellCode;
        $position->Zone_Name = $user->Zone_Name;
        $position->Area_Name = $user->Area_Name;    
        $position->entry_user = auth()->user()->id;
        $position->save();
        $user2->delete();
    }
        $position = new Position;
        $position->title = $value['pposition'];
        $position->leader_id = $value['leader'];
      //  $position->CellCode = $value['cell'];
        $position->Zone_Name = $value['zone'];
        $position->Area_Name = $value['area'];    
        $position->entry_user = auth()->user()->id;
        $position->save();

         $position = new Positionlog;
        $position->title = $value['pposition'];
        $position->leader_id = $value['leader'];
      //  $position->CellCode = "";
        $position->Zone_Name = $value['zone'];
        $position->Area_Name = $value['area'];    
        $position->entry_user = auth()->user()->id;
        $position->save();
            }
         return   $data;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows= Position::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Zonepositions');
          }
    
    // $cell = Assembly::lists('AssemblyName','AssemblyName');
     switch (auth()->user()->UserLevelID) {
         case '1':
       //  $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       //      $cell = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
     $zone = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');
     $area = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
     $leader = Leader::where('AreaID',auth()->user()->AreaID)->lists("name","id");
     $title = Title::lists("title","title");
             break;
         case '4':
         $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
         $zone = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');
     //    $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
     //     $cell = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
     
     
     $leader = Leader::where('AreaID',auth()->user()->AreaID)->lists("name","id");
     $title = Title::lists("title","title");
         break;
         default:
             # code...
             break;
     }
      return view('Zonepositions.show')->with(compact('rows','cell','zone','area','leader','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $rows= Position::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Zonepositions.index');
          }
   //  $cell = Assembly::lists('AssemblyName','AssemblyName');
     switch (auth()->user()->UserLevelID) {
         case '1':
         $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
             $cell = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
     $zone = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');
     $area = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
     $leader = Leader::where('AreaID',auth()->user()->AreaID)->lists("name","id");
     $title = Title::lists("title","title");
             break;
         case '4':
         $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
         $zone = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');
         $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
          $cell = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
     
     
     $leader = Leader::where('AreaID',auth()->user()->AreaID)->lists("name","id");
     $title = Title::lists("title","title");
         break;
         default:
             # code...
             break;
     }
      return view('Zonepositions.edit')->with(compact('rows','cell','zone','area','leader','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { //dd($request->all());
         $rows= Position::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Zonepositions.index');
          }
          $this->validate($request,[
          
            'Zone_Name' => 'required|numeric',
            'Area_Name' => 'required|numeric',
            'leader_id' => 'required|numeric',
            'title' => 'required|string|min:3',
        ]);
     
        $rows->title = $request->title;
        $rows->leader_id = $request->leader_id;
      
      
        $rows->Zone_Name = $request->Zone_Name;
        $rows->Area_Name = $request->Area_Name;
        
        $rows->entry_user = auth()->user()->id;
        $rows->save();

        $rows = new Positionlog;
        $leader = Leader::find($request->leader_id)->name;
       // dd($leader);
        $rows->title = $request->title;
        $rows->leader_id = $leader;
      
        $rows->Zone_Name = $request->Zone_Name;
        $rows->Area_Name = $request->Area_Name;  
        $rows->entry_user = auth()->user()->id;
        $rows->save();
        Session::flash('message','Records Added');
        Session::flash('alert-class','alert-success');   
        return redirect('Zonepositions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          Position::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Zonepositions');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');
        if (auth()->user()->UserLevelID == 1) {
            $leaders = Leader::where('AreaID',auth()->user()->AreaID)->where('name','LIKE', "%$searchStr%")->lists('id');
            $rows= Position::join('leaders',"leaders.id","=","leader_id")
             ->where('CellCode',"")->where('Zone_Name','!=',"")
             ->leftjoin('district','district.DistrictID','=','positions.Zone_Name')
             ->where('positions.Area_Name',auth()->user()->AreaID)
             ->whereIn('positions.leader_id',$leaders)
            ->select('positions.*','leaders.id as leadersid','leaders.name as name','district.DistrictName')
            ->paginate(15);
        }elseif (auth()->user()->UserLevelID == 4) {
             $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
             $leaders = Leader::whereIn('AreaID',$areas)->where('name','LIKE', "%$searchStr%")->lists('id');
            $rows= Position::join('leaders',"leaders.id","=","leader_id")
             ->where('CellCode',"")->where('Zone_Name','!=',"")
            ->leftjoin('district','district.DistrictID','=','positions.Zone_Name')
            ->whereIn('positions.Area_Name',$areas)
            ->whereIn('positions.leader_id',$leaders)
            ->select('positions.*','leaders.id as leadersid','leaders.name as name')->paginate(15);
        }else{
            return redirect('/');
        }
       // $rows= Position::where('name','LIKE', "%$searchStr%")->orderBy('title','asc')->paginate(10);
        return view('Zonepositions.list')->with(compact('rows'));       
    }
}
