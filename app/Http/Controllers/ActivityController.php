<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

use App\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Input;
class Activitycontroller extends Controller
{
    

    
    private  $rules =   [
          'Activity'=>'required', 
		  'Code'=>'required',                  
                ];


   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  //enable this for auth! //**************todo
    }               

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rows=\App\Models\Activity::paginate(15);
        return view('Activity.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {         
      return view('Activity.create');
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules= $this->rules;         
        $validation = Validator::make($request->all(), $rules);  //third param: , $this->messages


    //$val=$validation->passes();
    if ($validation->passes())
    {
  
        $data = new Activity();
        $data->Activity=$request->Activity; 
		 $data->Code=$request->Code;       
        $data->save();
        return redirect('Activity');

    }
    
    return redirect('Activity/create')
        ->withInput()
        ->withErrors($validation)
        ->with('message', 'There were validation errors.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $rows=\App\Models\Activity::find($id);
    
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Activity.index');
          }

        
          return view('Activity.show')->with(compact('rows'));
           
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows=\App\Models\Activity::find($id);
        
          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Activity.index');
          }
        
          return view('Activity.edit')->with(compact('rows'));
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
    
    $validation = Validator::make($request->all(), $this->rules );// 3rd param: , $this->messages
            //dd($request);

    //$val=$validation->passes();
    if ($validation->passes())
    {
        $data=Activity::find($id);
        $data->Activity=$request->Activity; 
		 $data->Code=$request->Code;       
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('Activity');

    }
    
    return \Redirect::route('Activity.edit', $id)  
        ->withInput()
        ->withErrors($validation)
        ->with('message', 'There were validation errors.');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Activity::find($id)->delete();
        return redirect ('Activity');
    }
     public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\Models\Activity::orderBy('Activity_ID', 'desc')
            ->where('Activity','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('Activity.list')->with(compact('rows'));
            

            
    }
}