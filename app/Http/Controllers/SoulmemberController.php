<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Classmember;
use App\Http\Requests;
use App\MemberType;
use App\Models\Area;
use App\Models\Assembly;
use App\Models\District;
use App\Soulmember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class SoulmemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (auth()->user()->UserLevelID) {
            case '3':
           $rows = Soulmember::where('CellCode',auth()->user()->CellID)
           ->where('confirmed',1)
           ->leftjoin('assembly','assembly.AssemblyCode','=','soulmembers.CellCode')
           ->orderBy('soulmembers.CellCode')->orderBy('soulmembers.name')->select('soulmembers.*','assembly.AssemblyName')
           ->paginate(30);
                break;
           case '2':
           $districts = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
           $rows = Soulmember::whereIn('CellCode',$districts)
           ->where('confirmed',1)
           ->leftjoin('assembly','assembly.AssemblyCode','=','soulmembers.CellCode')
           ->orderBy('soulmembers.CellCode')->orderBy('soulmembers.name')->select('soulmembers.*','assembly.AssemblyName')
           ->paginate(30);
                break; 
            case '1':
            $area = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $rows = Soulmember::whereIn('CellCode',$districts)->where('confirmed',1)
           ->leftjoin('assembly','assembly.AssemblyCode','=','soulmembers.CellCode')
           ->orderBy('soulmembers.CellCode')->orderBy('soulmembers.name')->select('soulmembers.*','assembly.AssemblyName')
           ->paginate(30);
                break; 
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $area = District::whereIn('AreaID',$national)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $rows = Soulmember::whereIn('CellCode',$districts)->where('confirmed',1)
           ->leftjoin('assembly','assembly.AssemblyCode','=','soulmembers.CellCode')
           ->orderBy('soulmembers.CellCode')->orderBy('soulmembers.name')->select('soulmembers.*','assembly.AssemblyName')
           ->paginate(30);
                break;
            default:
             $rows =[];
                break;
        }
        return view('Soulmembers.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $membertype = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
        if (auth()->user()->UserLevelID == 3) {
             return view('Soulmembers.create',compact('membertype'));
        }elseif(auth()->user()->UserLevelID == 1){
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
            $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
               return view('Soulmembers.createtop',compact('membertype','assemblies'));
        }elseif(auth()->user()->UserLevelID == 4){
            $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$area)->lists('DistrictID');
            $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
               return view('Soulmembers.createtop',compact('membertype','assemblies'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (object)$request->data;
            foreach ($data->data as $value) {
             $value = (object)$value;
             $myareas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
             $mydistricts = District::whereIn('AreaID',$myareas)->lists('DistrictID');
             $myassembllies = Assembly::whereIn('DistrictID',$mydistricts)->lists('AssemblyCode');
          
             $person = Soulmember::where('contact',$value->contact)->whereIn('CellCode',$myassembllies);
              if ($person->exists()) {
                  $person = $person->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->get(['name','contact','AssemblyName'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'person' => $person
                  ]);
                }  
            }

            foreach ($data->data as $value) {
             $value = (object)$value;
           $member = new Soulmember;
           $member->name = $value->name;
           $member->contact = $value->contact;
           $member->datejoined = $value->date;
           $member->soultype = $value->soultype;
           $member->community = $value->community;
           $member->homeaddress = $value->homeaddress;
           $member->dob = $value->dob;
           $member->gender = $value->gender;
           $member->comments = $value->comments;
           $member->confirmed = 1;
           $member->CellCode = auth()->user()->CellID;
           $member->user_id = auth()->user()->id;
           $member->save();
            }

        return response()->json(['message' => 'correct']);
    }

    public function storetop(Request $request)
    {
       $data = (object)$request->data;
           
           foreach ($data->data as $value) {
             $value = (object)$value;
             $myareas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
             $mydistricts = District::whereIn('AreaID',$myareas)->lists('DistrictID');
             $myassembllies = Assembly::whereIn('DistrictID',$mydistricts)->lists('AssemblyCode');
            
             $person = Soulmember::where('contact',$value->contact)->whereIn('CellCode',$myassembllies);
              if ($person->exists()) {
                  $person = $person->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->get(['name','contact','AssemblyName'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'person' => $person
                  ]);
                }  
            }
            
            foreach ($data->data as $value) {
             $value = (object)$value;
           $member = new Soulmember;
           $member->name = $value->name;
           $member->contact = $value->contact;
           $member->dob = $value->dob;
           $member->datejoined = $value->date;
           $member->soultype = $value->soultype;
           $member->community = $value->community;
           $member->homeaddress = $value->homeaddress;
           $member->gender = $value->gender;
           $member->comments = $value->comments;
           $member->confirmed = 1;
           $member->CellCode = $value->assembly;
           $member->user_id = auth()->user()->id;
           $member->save();
            }

         return response()->json(['message' => 'correct']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows= Soulmember::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Soulmember');
          }
        return view('Soulmembers.show',compact('rows','membertype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows= Soulmember::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Soulmember');
          }
        return view('Soulmembers.edit',compact('rows','membertype'));
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
            'name' => 'required',
            'contact' => 'required',
            'datejoined' => 'required'
        ]);
        $rows = Soulmember::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Soulmember');
          }
        $rows->name = $request->name;
        $rows->contact = $request->contact;
        $rows->datejoined = $request->datejoined;
        $rows->soultype = $request->soultype;
        $rows->community = $request->community;
        $rows->dob = $request->dob;
        $rows->gender = $request->gender;
        $rows->comments = $request->comments;
        $rows->homeaddress = $request->homeaddress;
        $rows->user_id = auth()->user()->id;
        $rows->save();
        Session::flash('message','Member Edited');
        return redirect('Soulmember');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Soulmember::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Soulmember');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');
        switch (auth()->user()->UserLevelID) {
            case '1':
           $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
                break;
             case '2':
           $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
                break;
            case '3':
           $cells = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyCode');
                break;
            case '4':
           $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $area = District::whereIn('AreaID',$national)->lists('DistrictID');
           $cells = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
                break;
            default:
              $cells = [];
                break;
        }
        $rows= Soulmember::where('name','LIKE', "%$searchStr%")->where('confirmed',1)->whereIn('CellCode',$cells)->leftjoin('assembly','assembly.AssemblyCode','=','soulmembers.CellCode')
           ->orderBy('soulmembers.CellCode')->orderBy('name','asc')->select('soulmembers.*','assembly.AssemblyName')->paginate(30);
        return view('Soulmembers.list')->with(compact('rows'));       
    }

     public function transfer()
    {
        switch (auth()->user()->UserLevelID) {
            case '3':
           $rows = Soulmember::where('CellCode',auth()->user()->CellID)
           ->where('confirmed',1)->lists('name','id');
          
                break;
           case '2':
           $districts = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
           $rows = Soulmember::whereIn('CellCode',$districts)
           ->where('confirmed',1)->lists('name','id');
                break; 
            case '1':
            $area = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $rows = Soulmember::whereIn('CellCode',$districts)->where('confirmed',1)->lists('name','id');
                break; 
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $area = District::whereIn('AreaID',$national)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $rows = Soulmember::whereIn('CellCode',$districts)->where('confirmed',1)->lists('name','id');
                break;
            default:
             $rows =[];
                break;
        }
        $classes = Classes::where('NationalID',auth()->user()->NationalID)->lists('classname','id');
        $rwstate = null;
        return view('soulmembers.transfer',compact('rows','classes','rwstate'));
    }

    public function transferstore(Request $request)
    {
        $this->validate($request,[
            'members' => 'required|array|min:1',
            'classname' => 'required|numeric',
        ]);
        $members = Soulmember::whereIn('id',$request->members);
        if (is_null($members->get()))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return back();
          }
    
        foreach ($members->get() as $key => $member) {
            $classmember = Classmember::where('contact',$member->contact);
            if ($classmember->exists()) {
               $classmember = $classmember->first();
                $classmember->class_id = $request->classname;
                $classmember->save();
            }else{
              $classmember = new Classmember;
              $classmember->name = $member->name;
               $classmember->contact = $member->contact;
               $classmember->datejoined = $member->datejoined;
               $classmember->class_id = $request->classname;
               $classmember->community = $member->community;
               $classmember->homeaddress = $member->homeaddress;
               $classmember->dob = $member->dob;
               $classmember->gender = $member->gender;
               $classmember->comments = $member->comments;
               $classmember->NationalID = auth()->user()->NationalID;
               $classmember->save();
            }
        }
        Session::flash('message','Members Transferred');
        return redirect ('Soulmember');
    }
}
