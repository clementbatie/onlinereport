<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Member;
use App\Models\Area;
use App\Models\District;
use App\Models\Assembly;
use App\MemberType;
use Session;
use Illuminate\Support\Facades\Input;


class MembersController extends Controller
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
           $rows = Member::where('CellCode',auth()->user()->CellID)
           ->where('confirmed',1)
           ->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')
           ->orderBy('members.CellCode')->select('members.*','assembly.AssemblyName')
           ->paginate(30);
                break;
           case '2':
           $districts = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
           $rows = Member::whereIn('CellCode',$districts)
           ->where('confirmed',1)
           ->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')
           ->orderBy('members.CellCode')->select('members.*','assembly.AssemblyName')
           ->paginate(30);
                break; 
            case '1':
            $area = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $rows = Member::whereIn('CellCode',$districts)->where('confirmed',1)
           ->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')
           ->orderBy('members.CellCode')->select('members.*','assembly.AssemblyName')
           ->paginate(30);
                break; 
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $area = District::whereIn('AreaID',$national)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $rows = Member::whereIn('CellCode',$districts)->where('confirmed',1)
           ->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')
           ->orderBy('members.CellCode')->select('members.*','assembly.AssemblyName')
           ->paginate(30);
                break;
            default:
             $rows =[];
                break;
        }
        return view('members.list',compact('rows'));
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
             return view('Members.create',compact('membertype'));
        }elseif(auth()->user()->UserLevelID == 1){
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
            $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
               return view('Members.createtop',compact('membertype','assemblies'));
        }elseif(auth()->user()->UserLevelID == 4){
            $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$area)->lists('DistrictID');
            $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
               return view('Members.createtop',compact('membertype','assemblies'));
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
          
             $person = Member::where('contact',$value->contact)->whereIn('CellCode',$myassembllies);
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
           $member = new Member;
           $member->name = $value->name;
           $member->contact = $value->contact;
           $member->datejoined = $value->date;
           $member->membertype = $value->membertype;
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
            
             $person = Member::where('contact',$value->contact)->whereIn('CellCode',$myassembllies);
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
           $member = new Member;
           $member->name = $value->name;
           $member->contact = $value->contact;
           $member->dob = $value->dob;
           $member->datejoined = $value->date;
           $member->membertype = $value->membertype;
           $member->community = $value->community;
           $member->homeaddress = $value->homeaddress;
           $member->gender = $value->gender;
           $member->comments = $value->comments;
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
        $rows= Member::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Members');
          }
          $membertype = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
        return view('Members.show',compact('rows','membertype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows= Member::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Members');
          }
          $membertype = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
        return view('Members.edit',compact('rows','membertype'));
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
        $rows = Member::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Members');
          }
        $rows->name = $request->name;
        $rows->contact = $request->contact;
        $rows->datejoined = $request->datejoined;
        $rows->membertype = $request->membertype;
        $rows->community = $request->community;
        $rows->dob = $request->dob;
        $rows->gender = $request->gender;
        $rows->comments = $request->comments;
        $rows->homeaddress = $request->homeaddress;
        $rows->user_id = auth()->user()->id;
        $rows->save();
        Session::flash('message','Member Edited');
        return redirect('Members');
    }

    public function transfer()
    {
        $members = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',1)->lists('name','id');
        $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
        $area = District::whereIn('AreaID',$national)->lists('DistrictID');
        $assemblies = Assembly::whereIn('DistrictID',$area)->lists('AssemblyName','AssemblyCode');
        $rwstate = null;
        return view('Members.transfer',compact('members','assemblies','rwstate'));
    }

    public function transferstore(Request $request)
    {
        $this->validate($request,[
            'members' => 'required',
            'assemblies' => 'required',
        ]);
        $member = Member::find($request->members);
        if (is_null($member))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Members.index');
          }
        $assem = Assembly::where('AssemblyCode',$request->assemblies)->first()->AssemblyName;
        if (is_null($assem))
          {
            Session::flash('message','Cell Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Members.index');
          }
        $member->CellCode = $request->assemblies;
        $member->save();
        Session::flash('message','Member Transferred to ' . $assem);
        return redirect ('Members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Members');
    }

    public function approvemembers()
    {
        $rows = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',0)->get();
        return view('Members.approve',compact('rows'));
    }

    public function approvememberssave($id)
    {
        $member = Member::find($id);
        if (is_null($member))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Members.approve');
          }
          $member->confirmed = 1;
          $member->save();
          \Session::flash('alert-class','alert-success');
          \Session::flash('message','Member Accepted');
        return redirect('/');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');

        $rows= Member::where('name','LIKE', "%$searchStr%")->where('confirmed',1)->orderBy('name','asc')->where('CellCode',auth()->user()->CellID)->paginate(30);
        return view('Members.list')->with(compact('rows'));       
    }
}
