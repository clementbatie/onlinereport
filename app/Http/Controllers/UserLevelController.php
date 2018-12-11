<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\Models\UserLevel;
use App\Models\Document;
use Illuminate\Support\Facades\Input;

class UserLevelController extends Controller
{
private  $rules =   [
          'UserLevel'=>'required',                    
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
        $rows=\App\Models\UserLevel::paginate(15);
        return view('userlevels.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {         
      return view('userlevels.create');
     
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
  
        $data = new UserLevel();
        $data->UserLevel=$request->UserLevel;        
        $data->save();
        return redirect('userlevel');

    }
    
    return redirect('userlevel/create')
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
          $rows=\App\Models\UserLevel::find($id);
    
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('userlevel.index');
          }

        
          return view('userlevels.show')->with(compact('rows'));
           
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows=\App\Models\UserLevel::find($id);
        
          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('userlevel.index');
          }
        
          return view('userlevels.edit')->with(compact('rows'));
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
        $data=UserLevel::find($id);
        $data->UserLevel=$request->UserLevel;        
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('userlevel');

    }
    
    return \Redirect::route('userlevel.edit', $id)  
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
         UserLevel::find($id)->delete();
        return redirect ('userlevel');
    }
     public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\Models\UserLevel::orderBy('UserLevelID', 'desc')
            ->where('UserLevel','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('userlevels.list')->with(compact('rows'));
            

            
    }
}
