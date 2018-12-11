<?php

namespace App\Http\Controllers;

use App\Activitytype;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ActivitytypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Activitytype::where('NationalID',auth()->user()->NationalID)->paginate(10);
        return view('activitytype.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('activitytype.create');
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
            'activitytype' => 'required'
        ]);
        $activity = new Activitytype;
        $activity->activitytype = $request->activitytype;
        $activity->user_id = auth()->user()->id;
        $activity->NationalID = auth()->user()->NationalID;
        $activity->save();
        \Session::flash('message','Record Added!');
        \Session::flash('alert-class','alert-success');
         return redirect('activitytype');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows = Activitytype::find($id);
        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('activitytype.index');
          }

      return view('activitytype.show')->with(compact('rows'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows = Activitytype::find($id);
        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('activitytype.index');
          }

      return view('activitytype.edit')->with(compact('rows'));   
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
            'activitytype' => 'required'
        ]);
        $activity = Activitytype::find($id);
        $activity->activitytype = $request->activitytype;
        $activity->user_id = auth()->user()->id;
        $activity->NationalID = auth()->user()->NationalID;
        $activity->save();
        \Session::flash('message','Record Updated!');
        \Session::flash('alert-class','alert-success');
         return redirect('activitytype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Activitytype::find($id)->delete();
        return redirect ('activitytype');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');
        $rows= Activitytype::orderBy('activitytype', 'desc')
            ->where('activitytype','LIKE', "%$searchStr%")            
            ->where('NationalID',auth()->user()->NationalID)            
            ->paginate(10);
        return view('activitytype.list')->with(compact('rows'));
    }
}
