<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

use App\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Input;
class Divisioncontroller extends Controller
{
    

    
    private  $rules =   [
          'AreaID'=>'required', 
		   'DistrictID'=>'required', 
		    'AssemblyID'=>'required',                    
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
        $rows=\App\Models\Division::paginate(15);
        return view('Division.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {         
	 $assembly=\App\Models\Assembly::orderBy('AssemblyName')->lists('AssemblyName','AssemblyID');
	 $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
	 $area=\App\Models\Area::orderBy('AreaName')->lists('AreaName','AreaID');

      return view('Division.create')->with(compact('assembly','district','area'));
     
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
  
        $data = new Division();
        $data->AssemblyID=$request->AssemblyID; 
		$data->DistrictID=$request->DistrictID;
		$data->AreaID=$request->AreaID;       
        $data->save();
        return redirect('Division');

    }
    
    return redirect('Division/create')
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
          $rows=\App\Models\Division::find($id);
		  $assembly=\App\Models\Assembly::orderBy('AssemblyName')->lists('AssemblyName','AssemblyID');
	 $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
	 $area=\App\Models\Area::orderBy('AreaName')->lists('AreaName','AreaID');
    
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Division.index');
          }

        
          return view('Division.show')->with(compact('rows','assembly','district','area'));
           
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows=\App\Models\Division::find($id);
		$assembly=\App\Models\Assembly::orderBy('AssemblyName')->lists('AssemblyName','AssemblyID');
	 $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
	 $area=\App\Models\Area::orderBy('AreaName')->lists('AreaName','AreaID');
        
          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Division.index');
          }
        
          return view('Division.edit')->with(compact('rows','assembly','district','area'));
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
        $data=Division::find($id);
       $data->AssemblyID=$request->AssemblyID; 
		$data->DistrictID=$request->DistrictID;
		$data->AreaID=$request->AreaID;         
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('Division');

    }
    
    return \Redirect::route('Division.edit', $id)  
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
    {Division::find($id)->delete();
        return redirect ('Division');
    }
     public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\Models\Division::orderBy('AssemblyID', 'desc')
            ->where('AssemblyID','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('Division.list')->with(compact('rows'));
            

            
    }
}