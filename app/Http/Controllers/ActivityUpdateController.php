<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityUpdate;
use App\Models\Minute;
use App\Models\hours;
use App\Models\Region;
use Auth;
use App\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Input;
class ActivityUpdateController extends Controller
{
    
   public $Activity;
   public $Project;
   public $hours;
   public $Minutes;
    
    private  $rules =   [
          'ActivityUpdate'=>'',  
		  'Activity_Description'=>'required',   
		  'Activity_ID'=>'required',
		  'ProjectID'=>'required',
		  'Date_Worked'=>'required',   
		  'Start_hour'=>'required',
		  'Start_minute'=>'required',
		  'End_hour'=>'required',
		  'End_minute'=>'required', 
		    'Remarks'=>'required',              
                ];


   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  //enable this for auth! //**************todo

$this->Activity =\App\Models\Activity::orderBy('Activity')->lists('Activity','Activity_ID');
$this->Project =\App\Models\Project::orderBy('ProjectName')->lists('ProjectName','ProjectID');
$this->hours =\App\Models\hours::orderBy('Hours')->lists('Hours','Hours');
$this->Minute =\App\Models\Minute::orderBy('minute')->lists('Gen_minute','minute');

    }               

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth::user()->id;
        $rows=\App\Models\ActivityUpdate::with('ActivityName')->where('id','=',$userid)->paginate(10);
        return view('ActivityUpdate.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
	$Project = $this->Project;
	$Activity=$this->Activity;    
	$hours = $this->hours;
	$Minute=$this->Minute;     
      return view('ActivityUpdate.create')->with(compact('Activity','Project','Minute','hours'));
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
	     'ActivityUpdate'=>'',  
		  'Start_hour'=>'required',
		  'Start_minute'=>'required',
		  'End_hour'=>'required',
		  'End_minute'=>'required', 
		    'Remarks'=>'required', 
     */
    public function store(Request $request)
    {
        
        $rules= $this->rules;         
        $validation = Validator::make($request->all(), $rules);  //third param: , $this->messages


 if ($validation->passes())
    {
    if($request->Start_hour > $request->End_hour){
	  $totalhours = 24 - $request->Start_hour +   $request->End_hour;
  }
  else if($request->Start_hour < $request->End_hour){
	  $totalhours =$request->End_hour - $request->Start_hour;  
}


  if($request->Start_minute + $request->End_minute == 118){
	   $totalminutes = 00;
	  $totalminutestohours = 1; 
}
	  
	  elseif($request->Start_minute > $request->End_minute){
		 $totalminutes = 60 - $request->Start_minute + $request->End_minute;
		   if($totalminutes >=60){
		 $totalminutes = $totalminutes - 60;
	   $totalminutestohours = 1;
		   }
	   else{
		  $totalminutes = $totalminutes;
	   $totalminutestohours = -1;  
	   }
}
	      elseif($request->Start_minute < $request->End_minute){
		 $totalminutes =$request->End_minute -  $request->Start_minute;
		$totalminutestohours = 0;
}

/*******CONVERTING INTO TOTAL WORKING HOURS******************/
  $workedhours = $totalminutestohours + $totalhours ;
  $workedminutes =  $totalminutes;
  $duration = $workedhours.":".$workedminutes;
        $data = new ActivityUpdate();
        $data->Activity_Description=$request->Activity_Description; 
		$data->Activity_ID=$request->Activity_ID; 
		$data->ProjectID=$request->ProjectID;          
		$data->Start_Time=$request->Start_hour .':'.$request->Start_minute.':00';  
		$data->End_Time = $request->End_hour.':'.$request->End_minute.':00';   
		$data->Date_Worked=$request->Date_Worked;        
		$data->Remarks=$request->Remarks; 
		$data->Activity_State=1; 
		$data->Hours_Worked=$duration;
		$data->Date=date('Y-m-d H:i:s');       
		$data->Department_ID=Auth::user()->Department_ID;  
		$data->SectionID=Auth::user()->SectionID;      
		$data->Designation_ID=Auth::user()->Designation_ID;        
		//$data->=$request->;        
		$data->id=Auth::user()->id;               
        $data->save();
        return redirect('ActivityUpdate');

    }
    
    return redirect('ActivityUpdate/create')
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
	$Project = $this->Project;
	$Activity=$this->Activity;    
	$hours = $this->hours;
	$Minute=$this->Minute;     
      
     $rows=\App\Models\ActivityUpdate::find($id);
    
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('ActivityUpdate.index');
          }

        
          return view('ActivityUpdate.show')->with(compact('rows','Project','Minute','hours','Activity'));
           
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $Project = $this->Project;
	$Activity=$this->Activity;    
	$hours = $this->hours;
	$Minute=$this->Minute; 
        $rows=\App\Models\ActivityUpdate::find($id);
        
          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('ActivityUpdate.index');
          }
        
          return view('ActivityUpdate.edit')->with(compact('rows','Project','Minute','hours','Activity'));
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
        if($request->Start_hour > $request->End_hour){
	  $totalhours = 24 - $request->Start_hour +   $request->End_hour;
  }
  else if($request->Start_hour < $request->End_hour){
	  $totalhours =$request->End_hour - $request->Start_hour;  
}


  if($request->Start_minute + $request->End_minute == 118){
	   $totalminutes = 00;
	  $totalminutestohours = 1; 
}
	  
	  elseif($request->Start_minute > $request->End_minute){
		 $totalminutes = 60 - $request->Start_minute + $request->End_minute;
		   if($totalminutes >=60){
		 $totalminutes = $totalminutes - 60;
	   $totalminutestohours = 1;
		   }
	   else{
		  $totalminutes = $totalminutes;
	   $totalminutestohours = -1;  
	   }
}
	      elseif($request->Start_minute < $request->End_minute){
		 $totalminutes =$request->End_minute -  $request->Start_minute;
		$totalminutestohours = 0;
}

/*******CONVERTING INTO TOTAL WORKING HOURS******************/
  $workedhours = $totalminutestohours + $totalhours ;
  $workedminutes =  $totalminutes;
  $duration = $workedhours.":".$workedminutes;
        $data=ActivityUpdate::find($id);
        $data->Activity_Description=$request->Activity_Description; 
		$data->Activity_ID=$request->Activity_ID; 
		$data->ProjectID=$request->ProjectID;        
		$data->Start_Time=$request->Start_hour .':'.$request->Start_minute.':00';  
		$data->End_Time = $request->End_hour.':'.$request->End_minute.':00';          
		$data->Date_Worked=$request->Date_Worked;        
		$data->Remarks=$request->Remarks; 
		$data->Activity_State=1; 
		$data->Hours_Worked=$duration;
		$data->Date=date('Y-m-d H:i:s');       
		$data->Department_ID=Auth::user()->Department_ID;  
		$data->SectionID=Auth::user()->SectionID;      
		$data->Designation_ID=Auth::user()->Designation_ID;        
		//$data->=$request->;        
		$data->id=Auth::user()->id;               
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('ActivityUpdate');

    }
    
    return \Redirect::route('ActivityUpdate.edit', $id)  
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
         ActivityUpdate::find($id)->delete();
        return redirect ('ActivityUpdate');
    }
     public function search()
    {
		$userid = Auth::user()->id;
        $searchStr=Input::get('searchString');
        $rows=\App\Models\ActivityUpdate::orderBy('ActivityUpdate_ID', 'desc')
            ->where('Activity_Description','LIKE', "%$searchStr%") ->where('id','=',$userid)            
            ->paginate(10);
        return view('ActivityUpdate.list')->with(compact('rows'));
            

            
    }
}