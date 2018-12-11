<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Http\Requests;
use App\classmember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class ClassmemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = classmember::paginate(30);
        return view('classmembers.list',compact('rows'));
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
        return view('classmembers.create',compact('classes','rows'));
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
          
             $person = Classmember::where('contact',$value->contact);
              if ($person->exists()) {
                  $person = $person->leftjoin('classes','classes.id','=','classmembers.class_id')->get(['name','contact','classesName'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'person' => $person
                  ]);
                }  
            }

            foreach ($data->data as $value) {
             $value = (object)$value;
           $member = new Classmember;
           $member->name = $value->name;
           $member->contact = $value->contact;
           $member->datejoined = $value->date;
           $member->class_id = $value->classname;
           $member->community = $value->community;
           $member->homeaddress = $value->homeaddress;
           $member->dob = $value->dob;
           $member->gender = $value->gender;
           $member->comments = $value->comments;
    
           $member->NationalID = auth()->user()->NationalID;
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
        $rows= Classmember::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classmembers');
          }
          $classes = Classes::where('NationalID',auth()->user()->NationalID)->lists('classname','id');
        return view('classmembers.show',compact('rows','classes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows= Classmember::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classmembers');
          }
          $classes = Classes::where('NationalID',auth()->user()->NationalID)->lists('classname','id');
        return view('classmembers.edit',compact('rows','classes'));
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
        $rows = Classmember::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classmembers');
          }
        $rows->name = $request->name;
        $rows->contact = $request->contact;
        $rows->datejoined = $request->datejoined;
        $rows->class_id = $request->classname;
        $rows->community = $request->community;
        $rows->dob = $request->dob;
        $rows->gender = $request->gender;
        $rows->comments = $request->comments;
        $rows->homeaddress = $request->homeaddress;
        $rows->user_id = auth()->user()->id;
        $rows->save();
        Session::flash('message','Member Edited');
        return redirect('classmembers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Classmember::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('classmembers');
    }

     public function search()
    {
        $searchStr=Input::get('searchString');

        $rows= Classmember::where('name','LIKE', "%$searchStr%")->orderBy('name','asc')->paginate(30);
        return view('classmembers.list')->with(compact('rows'));       
    }
}
