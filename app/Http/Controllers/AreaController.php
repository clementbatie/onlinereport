<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

use App\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Input;
class Areacontroller extends Controller
{
    
  private  $rules =   [
          'AreaName'=>'required',
         // 'AreaCode'=>'required', 
		//  'NationalID'=>'required', 
		                    
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
        switch (auth()->user()->UserLevelID) {
            case '10':
         $rows=\App\Models\Area::paginate(15);
                break;
            
            default:
         $rows=\App\Models\Area::where('NationalID',auth()->user()->NationalID)->paginate(15);
                break;
        }
        return view('Area.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

      switch (auth()->user()->UserLevelID) {
          case '10':
            $National = \App\National::lists('NationalName','NationalID');
              break;
          
          default:
             $National = \App\National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
              break;
      }
      return view('Area.create',compact('National'));
     
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
  
        $data = new Area();
        $data->AreaName=$request->AreaName;
        $data->AreaCode="";// $request->AreaCode;  
		if(auth()->user()->UserLevelID == 10){
            $data->NationalID=$request->NationalID;
        }  elseif (auth()->user()->UserLevelID == 4) {
           $data->NationalID=auth()->user()->NationalID;
        }
		$data->id=auth()->user()->id;         
        $data->save();
        return redirect('Area');

    }
    
    return redirect('Area/create')
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
          $rows=\App\Models\Area::find($id);
          switch (auth()->user()->UserLevelID) {
          case '10':
            $National = \App\National::lists('NationalName','NationalID');
              break;
          
          default:
             $National = \App\National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
              break;
      }
          
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Area.index');
          }

      return view('Area.show')->with(compact('rows','National'));           
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows=\App\Models\Area::find($id);
      
        switch (auth()->user()->UserLevelID) {
          case '10':
            $National = \App\National::lists('NationalName','NationalID');
              break;
          
          default:
             $National = \App\National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
              break;
      }
          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Area.index');
          }
        
          return view('Area.edit')->with(compact('rows','department','National'));
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
        $data=Area::find($id);
        $data->AreaName=$request->AreaName;
		$data->AreaCode="";//$request->AreaCode;
        $data->NationalID= auth()->user()->NationalID;  
		$data->id=auth()->user()->id;         
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('Area');

    }
    
    return \Redirect::route('Area.edit', $id)  
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
    {Area::find($id)->delete();
        return redirect ('Area');
    }
     public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\Models\Area::orderBy('AreaID', 'desc')
            ->where('AreaName','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('Area.list')->with(compact('rows'));
            

            
    }
}