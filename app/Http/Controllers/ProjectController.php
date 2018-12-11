<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\Models\Project;
use App\Models\Document;
use Illuminate\Support\Facades\Input;

class ProjectController extends Controller
{
    
public $Area;
public $Country;
public $District;
public $Project;
    
    private  $rules =   [
          'ProjectName'=>'required', 
		  'AreaID'=>'required',
		  'DistrictID'=>'required',
		  'CountryID'=>'required',
		  'RegionID'=>'required',
                ];


   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  //enable this for auth! //**************todo
		
$this->Area = \App\Models\Area::orderBy('AreaName')->lists('AreaName','AreaID');
$this->Country =\App\Models\Country::orderBy('CountryName')->lists('CountryName','CountryID');
$this->District =\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
$this->Project =\App\Models\ProjectStatus::orderBy('ProjectStatus')->lists('ProjectStatus','ProjectStatusID');
$this->Region =\App\Models\Region::orderBy('Region')->lists('Region','RegionID');

    }               

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rows=\App\Models\Project::paginate(15);
        return view('Project.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
	$Area =$this->Area;   
	$Country = $this->Country;
	$District =$this->District;
	$Project =$this->Project; 
	$Region =$this->Region; 
      return view('Project.create')->with(compact('Area','Country','District','Project','Region'));
     
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
  
        $data = new Project();
        $data->ProjectName=$request->ProjectName;   
		$data->AreaID=$request->AreaID;        
        $data->DistrictID=$request->DistrictID;
		$data->CountryID=$request->CountryID; 
		$data->RegionID=$request->RegionID;
		$data->ProjectStatusID = $request->ProjectStatusID;   
		$data->id=auth()->user()->id;
        $data->save();
        return redirect('Project');

    }
    
    return redirect('Project/create')
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
          $rows=\App\Models\Project::find($id);
		  $Area =$this->Area;   
	$Country = $this->Country;
	$District =$this->District;
	$Project =$this->Project; 
		$Region =$this->Region; 
    
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Project.index');
          }

        
          return view('Project.show')->with(compact('rows','Area','Country','District','Project','Region'));
           
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows=\App\Models\Project::find($id);
          $Area =$this->Area;   
	$Country = $this->Country;
	$District =$this->District;
	$Project =$this->Project; 
	$Region =$this->Region; 
          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Project.index');
          }
        
          return view('Project.edit')->with(compact('rows','Area','Country','District','Project','Region'));
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
        $data=Project::find($id);
        $data->ProjectName=$request->ProjectName;   
		$data->AreaID=$request->AreaID;        
        $data->DistrictID=$request->DistrictID;
		$data->RegionID=$request->RegionID;
		$data->CountryID=$request->CountryID; 
		$data->ProjectStatusID=$request->ProjectStatusID;   
		$data->id=auth()->user()->id;
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('Project');

    }
    
    return \Redirect::route('Project.edit', $id)  
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
         Project::find($id)->delete();
        return redirect ('Project');
    }
     public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\Models\Project::orderBy('ProjectID', 'desc')
            ->where('ProjectName','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('Project.list')->with(compact('rows'));
            

            
    }
}
