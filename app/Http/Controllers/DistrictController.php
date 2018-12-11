<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;

use App\Http\Requests;
use App\Models\Area;
use Validator;
use Illuminate\Support\Facades\Input;
class Districtcontroller extends Controller
{
    

    
    private  $rules =   [
           'DistrictName'=>'required',
		                
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
        switch (auth()->user()->UserLevelID) {
            case '1':
        $rows=\App\Models\District::where('AreaID',auth()->user()->AreaID)->paginate(15);
                break;
             case '4':
        $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
        $rows=\App\Models\District::whereIn('AreaID',$area)->paginate(15);
                break;
             case '10':
        $rows=\App\Models\District::paginate(15);
                break;
            default:
        $rows=[];        
                break;
        }
        
        return view('District.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
      switch (auth()->user()->UserLevelID) {
            case '1':
       $area=\App\Models\Area::where('AreaID',auth()->user()->AreaID)->orderBy('AreaName')->lists('AreaName','AreaID');
                break;
             case '4':
        $area=\App\Models\Area::where('NationalID',auth()->user()->NationalID)->orderBy('AreaName')->lists('AreaName','AreaID');
                break;
             case '10':
        $area=\App\Models\Area::orderBy('AreaName')->lists('AreaName','AreaID');
                break;
            default:
        $area=[];        
                break;
        }
      return view('District.create')->with(compact('area'));
     
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
  
        $data = new District();
        $data->DistrictName=$request->DistrictName;
		$data->AreaID=$request->AreaID;
		$data->DistrictCode="";  
		$data->id=auth()->user()->id;         
        $data->save();
        return redirect('District');

    }
    
    return redirect('District/create')
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
			 $area=\App\Models\Area::orderBy('AreaName')->lists('AreaName','AreaID');

          $rows=\App\Models\District::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('District.index');
          }

        
      
      return view('District.show')->with(compact('rows','area'));           
 
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
            case '1':
       $area=\App\Models\Area::where('AreaID',auth()->user()->AreaID)->orderBy('AreaName')->lists('AreaName','AreaID');
                break;
             case '4':
        $area=\App\Models\Area::where('NationalID',auth()->user()->NationalID)->orderBy('AreaName')->lists('AreaName','AreaID');
                break;
             case '10':
        $area=\App\Models\Area::orderBy('AreaName')->lists('AreaName','AreaID');
                break;
            default:
        $area=[];        
                break;
        }

        $rows=\App\Models\District::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('District.index');
          }
        
          return view('District.edit')->with(compact('rows','area'));
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
        $data=District::find($id);
        $data->DistrictName=$request->DistrictName;
		
		$data->AreaID=$request->AreaID;
		$data->id=auth()->user()->id;         
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('District');

    }
    
    return \Redirect::route('District.edit', $id)  
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
    {District::find($id)->delete();
        return redirect ('District');
    }
     public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\Models\District::orderBy('DistrictID', 'desc')
            ->where('DistrictName','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('District.list')->with(compact('rows'));
            
    }
}