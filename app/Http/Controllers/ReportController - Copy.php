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
use DB;
use Illuminate\Support\Facades\Input;
class ReportController extends Controller
{

 public $Activity;
 public $Region;
 public $hours;
 public $Minutes;

 private  $rules =   [
 'Designation_ID'=>'required', 
 'Start_Date'=>'required', 
 'End_Date'=>'required',
 'id'=>'required',];


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


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Assembly()
    { 
      $DistrictID = auth()->user()->DistrictID;

      if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
      } elseif (auth()->user()->UserLevelID==1) {

        $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);

        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
      elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

      }
      $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

      $output=array();

      return view('Report.Assembly')->with(compact('rows','output','indicators'));

    }

    public function AssemblyDetailed()
    { 
      $DistrictID = auth()->user()->DistrictID;

    //  $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
      if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
      } 
       elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

      }
      elseif (auth()->user()->UserLevelID==1) {

        $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')->orderBy('AssemblyName')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
     $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');
     
      $output=array();

      return view('Report.AssemblyDetailed')->with(compact('rows','output','indicators'));

    }
    // District Summary Report
    public function PeriodicAssemblyDistrict(Request $request)
    {           // get list of various indicators
    $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

     $DistrictID = auth()->user()->DistrictID;
     $AreaID = auth()->user()->AreaID;

      if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
   }
    elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

      }
   elseif(auth()->user()->UserLevelID==1){

     $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',$AreaID)->lists('DistrictName','DistrictID');

   }
    if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('DistrictAssembly');
    }
    if ($request->FromDate > $request->ToDate){        
      \Session::flash('message','Start date must be less or equal to end date');
      \Session::flash('alert-class','alert-warning');            
      return redirect('DistrictAssembly');
    }
    if ($request->FinanceType==null){        
      \Session::flash('message','Please select Report Type');
      \Session::flash('alert-class','alert-warning');            
      return redirect('DistrictAssembly');
    }
    if ($request->DistrictName==null){        
      \Session::flash('message','Please select DistrictName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('DistrictAssembly');
    }
    $tota=$request->FinanceType;


    $baseQuery=" Select sum(finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
    district.DistrictCode,district.DistrictName,
    finance.date,finance.created_at	 from  district join assembly on district.DistrictID = assembly.DistrictID join finance 
    on  assembly.AssemblyCode = finance.AssemblyID "; 

    $baseQuery1="Select sum(finance.IndValues) as grand from  district   join assembly on district.DistrictID = assembly.DistrictID join finance 
    on  assembly.AssemblyCode = finance.AssemblyID  "; 
    $whereArray= array();

    if ($request->DistrictName!=null)                    
      $whereArray[]="district.DistrictID={$request->DistrictName}";
                //can only arrive here if both start date and end date exist but check anyway.
    if ($request->FromDate && $request->ToDate )
      if ($request->FromDate!=null)                    
        $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate }' ";
      if ($request->FinanceType!=null)                    
        $whereArray[]="finance.Indicators ='{$request->FinanceType}'";  
      $whereClause= implode(" and ", $whereArray);


      if ($whereClause!=null){
       if(auth()->user()->UserLevelID==2){

        $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by assembly.AssemblyName,assembly.AssemblyCode";
      }
      if(auth()->user()->UserLevelID==1){
        $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by assembly.AssemblyName,District.DistrictID";
       //     return "hi";

      }
      $baseQuery2=$baseQuery1." where ".$whereClause ."and finance.Activity_State=1";
      $output = \DB::select($baseQuery);
      session(['output' => $baseQuery]); 
      $total = \DB::select($baseQuery2);
    }
    else{
      $output=array();

    }   
    $from=$request->FromDate;
    $to=$request->ToDate;
     $districtname = \App\Models\District::find($request->DistrictName);
       $districtname = $districtname->DistrictName;
    $indicate = "(". $request->FinanceType .")";
     // return var_dump($output);
	 // dd($total);
    return view('Report.DistrictAssembly')->with(compact('output','rows','total','tota','indicators','indicate','from','to','districtname'));

  }


  public function DistrictAssembly()
  { 
   $AreaID = auth()->user()->AreaID;
  $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

   $DistrictID = auth()->user()->DistrictID;
   if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
   }
   elseif(auth()->user()->UserLevelID==1){

     $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',$AreaID)->lists('DistrictName','DistrictID');

   }
   $output=array();
   return view('Report.DistrictAssembly')->with(compact('rows','output','indicators'));

 }

// assembly summary search
 public function PeriodicAssembly(Request $request){
   $DistrictID = auth()->user()->DistrictID;
   $AreaID = auth()->user()->AreaID;
   if(auth()->user()->UserLevelID==2){
    $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
  }
  elseif (auth()->user()->UserLevelID==3) {

   $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

 }
   elseif (auth()->user()->UserLevelID==1) {
  // $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$AreaID)->lists('AssemblyName','AssemblyID');

    $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
    $arr;
    foreach ($query as $id) {
      $arr [] = $id->DistrictID;
    }
    
    $rows = \App\Models\Assembly::whereIn('id', ($arr))
    ->lists('AssemblyName','AssemblyID');
     // return $rows;
  }

 $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

  

  if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
    \Session::flash('message','Either Start date or End date is missing');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AssemblySearch');
  }
  if ($request->FromDate > $request->ToDate){        
    \Session::flash('message','Start date must be less or equal to end date');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AssemblySearch');
  }
  if ($request->FinanceType==null){        
    \Session::flash('message','Please select Report Type');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AssemblySearch');
  }
  if ($request->AssemblyName==null){        
    \Session::flash('message','Please select AssemblyName');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AssemblySearch');
  }

  $tota=$request->FinanceType;
  $from=$request->FromDate;
    $to=$request->ToDate;
     $districtname = \App\Models\Assembly::find($request->AssemblyName);
       $districtname = $districtname->AssemblyName;
       $indicate = "(". $request->FinanceType .")";

  $baseQuery="Select sum(finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
  finance.date,finance.created_at	 from  assembly   join finance on assembly.AssemblyCode = finance.AssemblyID "; 

  $baseQuery1="Select sum(finance.IndValues) as total from  assembly   join finance on assembly.AssemblyCode = finance.AssemblyID "; 
  $whereArray= array();

  if ($request->AssemblyName!=null)                    
    $whereArray[]="assembly.AssemblyID={$request->AssemblyName}";
                //can only arrive here if both start date and end date exisit but check anyway.
  if ($request->FromDate && $request->ToDate )
    if ($request->FromDate!=null)                    
      $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate }' ";
    if ($request->FinanceType!=null)                    
      $whereArray[]="finance.Indicators ='{$request->FinanceType}'";

    $whereClause= implode(" and ", $whereArray);


    if ($whereClause!=null){
      $baseQuery=$baseQuery." where ".$whereClause. "and finance.Activity_State=1";
      $baseQuery2=$baseQuery1." where ".$whereClause. "and finance.Activity_State=1";
      $output = \DB::select($baseQuery);
      session(['output' => $baseQuery]);
      $total = \DB::select($baseQuery2);
    }
    else{
      $output=array();

    }   
    $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by assembly.AssemblyName";
   //  return $baseQuery;
	 // dd(session('output'));
    return view('Report.Assembly')->with(compact('indicators','output','rows','total','tota','districtname','from','to','indicate'));

  }


//Assembly Detailed Report
  public function PeriodicAssemblyDetailed(Request $request){
    // return var_dump($request->all());
   $DistrictID = auth()->user()->DistrictID;
   $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
   if(auth()->user()->UserLevelID==2){
    $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
  } 
  elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

      }
  elseif (auth()->user()->UserLevelID==1) {

    $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
    $arr;
    foreach ($query as $id) {
      $arr [] = $id->DistrictID;
    }
    
    $rows = DB::table('assembly')->orderBy('AssemblyName')
    ->whereIn('DistrictID', ($arr))
    ->lists('AssemblyName','AssemblyID');

  }


  if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
    \Session::flash('message','Either Start date or End date is missing');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AssemblyDetailedSearch');
  }
  if ($request->FromDate > $request->ToDate){        
    \Session::flash('message','Start date must be less or equal to end date');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AssemblyDetailedSearch');
  }
  if ($request->FinanceType==null){        
    \Session::flash('message','Please select Report Type');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AssemblyDetailedSearch');
  }
  if ($request->AssemblyName==null){        
    \Session::flash('message','Please select AssemblyName');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AssemblyDetailedSearch');
  }

  $tota=$request->FinanceType;
$from=$request->FromDate;
    $to=$request->ToDate;
     $districtname = \App\Models\Assembly::find($request->AssemblyName);
       $districtname = $districtname->AssemblyName;

  $baseQuery="Select assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
  finance.date,finance.created_at  from  assembly   join finance on assembly.AssemblyCode = finance.AssemblyID "; 

  $baseQuery1="Select sum(finance.IndValues) as total from  assembly   join finance on assembly.AssemblyCode = finance.AssemblyID "; 
  $whereArray= array();

  if ($request->AssemblyName!=null)                    
    $whereArray[]="assembly.AssemblyID={$request->AssemblyName}";
                //can only arrive here if both start date and end date exisit but check anyway.
  if ($request->FromDate && $request->ToDate )
    if ($request->FromDate!=null)                    
      $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate }' ";
    if ($request->FinanceType!=null)                    
      $whereArray[]="finance.Indicators ='{$request->FinanceType}'";

    $whereClause= implode(" and ", $whereArray);


    if ($whereClause!=null){
      $baseQuery=$baseQuery." where ".$whereClause. "and finance.Activity_State=1";
      $baseQuery2=$baseQuery1." where ".$whereClause. "and finance.Activity_State=1";
      $output = \DB::select($baseQuery);
        session(['output' => $baseQuery]);
      $total = \DB::select($baseQuery2);
    }
    else{
      $output=array();

    }   

      //dd($total);
    return view('Report.AssemblyDetailed')->with(compact('indicators','output','rows','total','tota','to','from','districtname'));

  }

  //Area Summary
  public function AreaSearch()
  { 
    $AreaID = auth()->user()->AreaID;
    $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

    $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');

    $output=array();

    return view('Report.Area')->with(compact('rows','output','indicators'));

  }

  //Area Summary report search
  public function PeriodicArea(Request $request)
  {
   $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

   $DistrictID = auth()->user()->DistrictID;
   $AreaID = auth()->user()->AreaID;

   if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
   }
   elseif(auth()->user()->UserLevelID==1){

    $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');
    

  }
  if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
    \Session::flash('message','Either Start date or End date is missing');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AreaSearch');
  }
  if ($request->FromDate > $request->ToDate){        
    \Session::flash('message','Start date must be less or equal to end date');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AreaSearch');
  }
  if ($request->FinanceType==null){        
    \Session::flash('message','Please select Report Type');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AreaSearch');
  }
  if ($request->AreaName==null){        
    \Session::flash('message','Please select AreaName');
    \Session::flash('alert-class','alert-warning');            
    return redirect('AreaSearch');
  }

  $tota=$request->FinanceType;
$from=$request->FromDate;
    $to=$request->ToDate;
    $indicate = "(". $request->FinanceType .")";

  $baseQuery=" Select sum(finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
  district.DistrictCode,district.DistrictName,
  finance.date,finance.created_at	 from  area join district  on area.AreaID = district.AreaID 
  join assembly on  assembly.DistrictID = district.DistrictID  join finance 
  on  assembly.AssemblyCode = finance.AssemblyID "; 

  $baseQuery1="Select sum(finance.IndValues) as grand  from  area join district  on area.AreaID = district.AreaID 
  join assembly on  assembly.DistrictID = district.DistrictID  join finance 
  on  assembly.AssemblyCode = finance.AssemblyID   "; 

  $whereArray= array();

  if ($request->AreaName!=null)                    
    $whereArray[]="Area.AreaID={$request->AreaName}";


  if ($request->FromDate && $request->ToDate )
    if ($request->FromDate!=null)                    
      $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate}' ";
    if ($request->FinanceType!=null)                    
      $whereArray[]="finance.Indicators ='{$request->FinanceType}'";

    $whereClause= implode(" and ", $whereArray);


    if ($whereClause!=null){


      $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by district.DistrictName,District.DistrictID";

      $baseQuery2=$baseQuery1." where ".$whereClause. "and finance.Activity_State=1";
      $output = \DB::select($baseQuery);
      session(['output' => $baseQuery]);
      $total = \DB::select($baseQuery2);
    }
    else{
      $output=array();

    }   
    $areaname = \App\Models\Area::find($request->AreaName)->AreaName;
	  //dd($total);
    return view('Report.Area')->with(compact('output','rows','total','tota','indicators','areaname','indicate','to','from'));

  }

  // Assembly Report Per Period
  public function AssemblyOverall(){
    $DistrictID = auth()->user()->DistrictID;

     // $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
    if(auth()->user()->UserLevelID==2){
      $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
    }
    elseif(auth()->user()->UserLevelID==3){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
      } 
     elseif (auth()->user()->UserLevelID==1) {

      $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
      $arr;
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }
      
      $rows = \App\Models\Assembly::whereIn('DistrictID', ($arr))->orderBy('AssemblyName')
      ->lists('AssemblyName','AssemblyID');

    }
    $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

    $output=array();

    return view('Report.AssemblyOverall')->with(compact('rows','output','indicators'));
    
  }

  // Assembly Report Per Period Searh
  public function AssemblyOverallsearch(Request $request){
    $DistrictID = auth()->user()->DistrictID;
    $indicators =\App\Models\Finance::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
    if(auth()->user()->UserLevelID==2){
      $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
    } 
    elseif(auth()->user()->UserLevelID==3){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
      } 
    elseif (auth()->user()->UserLevelID==1) {

      $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
      $arr;
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }
      
      $rows = \App\Models\Assembly::whereIn('DistrictID', ($arr))->orderBy('AssemblyName')
      ->lists('AssemblyName','AssemblyID');

    }


    if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('AssemblyOverall');
    }
    if ($request->FromDate > $request->ToDate){        
      \Session::flash('message','Start date must be less or equal to end date');
      \Session::flash('alert-class','alert-warning');            
      return redirect('AssemblyOverall');
    }

    if ($request->AssemblyName==null){        
      \Session::flash('message','Please select AssemblyName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('AssemblyOverall');
    }

    $tota=$request->FinanceType;


    $baseQuery="Select sum(finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
    finance.date,finance.created_at  from  assembly   join finance on assembly.AssemblyCode = finance.AssemblyID "; 

    $baseQuery1="Select sum(finance.IndValues) as total from  assembly   join finance on assembly.AssemblyCode = finance.AssemblyID "; 
    $whereArray= array();

    if ($request->AssemblyName!=null)                    
      $whereArray[]="assembly.AssemblyID={$request->AssemblyName}";
                //can only arrive here if both start date and end date exisit but check anyway.
    if ($request->FromDate && $request->ToDate )
      if ($request->FromDate!=null)                    
        $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate }' ";
      if ($request->FinanceType!=null)                    
        $whereArray[]="finance.Indicators ='{$request->FinanceType}'";

      $whereClause= implode(" and ", $whereArray);


      if ($whereClause!=null){
        $baseQuery=$baseQuery." where ".$whereClause;
        $baseQuery2=$baseQuery1." where ".$whereClause."and finance.Activity_State=1";
        $baseQuery= $baseQuery ."and finance.Activity_State=1 group by finance.Indicators";
        $output = \DB::select($baseQuery);
        session(['output' => $baseQuery]);
        $total = \DB::select($baseQuery2);
      }
      else{
        $output=array();

      }   
      $from=$request->FromDate;
    $to=$request->ToDate;
     $districtname = \App\Models\Assembly::find($request->AssemblyName);
       $districtname = $districtname->AssemblyName;
      
      return view('Report.AssemblyOverall')->with(compact('rows','output','indicators','from','to','districtname'));
    }

    // District Report Per Period
    public function DistrictOverall(){
      $DistrictID = auth()->user()->DistrictID;
      $AreaID = auth()->user()->AreaID;
     if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
   }
   elseif(auth()->user()->UserLevelID==1){

     $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',$AreaID)->lists('DistrictName','DistrictID');

   }
      $indicators =\App\Models\Finance::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

      $output=array();

      return view('Report.DistrictOverall')->with(compact('rows','output','indicators'));
      
    }

    // District Report Per Period Search
    public function DistrictOverallsearch(Request $request){
     $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

      $DistrictID = auth()->user()->DistrictID;
      $AreaID = auth()->user()->AreaID;

      if(auth()->user()->UserLevelID==2){

       $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
     }
     elseif(auth()->user()->UserLevelID==1){

       $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',$AreaID)->lists('DistrictName','DistrictID');

     }
     if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('DistrictOverall');
    }
    if ($request->FromDate > $request->ToDate){        
      \Session::flash('message','Start date must be less or equal to end date');
      \Session::flash('alert-class','alert-warning');            
      return redirect('DistrictOverall');
    }
    
    if ($request->DistrictName==null){        
      \Session::flash('message','Please select DistrictName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('DistrictOverall');
    }
    $tota=$request->FinanceType;


    $baseQuery=" Select sum(finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
    district.DistrictCode,district.DistrictName,
    finance.date,finance.created_at  from  district join assembly on district.DistrictID = assembly.DistrictID join finance 
    on  assembly.AssemblyCode = finance.AssemblyID "; 

    $baseQuery1="Select sum(finance.IndValues) as grand from  district   join assembly on district.DistrictID = assembly.DistrictID join finance 
    on  assembly.AssemblyCode = finance.AssemblyID  "; 
    $whereArray= array();

    if ($request->DistrictName!=null)                    
      $whereArray[]="district.DistrictID={$request->DistrictName}";
                //can only arrive here if both start date and end date exist but check anyway.
    if ($request->FromDate && $request->ToDate )
      if ($request->FromDate!=null)                    
        $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate }' ";
      if ($request->FinanceType!=null)                    
        $whereArray[]="finance.Indicators ='{$request->FinanceType}'";  
      $whereClause= implode(" and ", $whereArray);


      if ($whereClause!=null){
       if(auth()->user()->UserLevelID==2){
       //   var_dump($baseQuery);
        $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by assembly.AssemblyName,assembly.AssemblyCode";
      }
      if(auth()->user()->UserLevelID==1){
        $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by finance.Indicators,District.DistrictID";
        
      }
      $baseQuery2=$baseQuery1." where ".$whereClause."and finance.Activity_State=1";
      $output = \DB::select($baseQuery);
      session(['output' => $baseQuery]);
      $total = \DB::select($baseQuery2);
    }
    else{
      $output=array();

    }   
     // return var_dump($output);
   // dd($total);
    $from=$request->FromDate;
    $to=$request->ToDate;
     $districtname = \App\Models\District::find($request->DistrictName);
       $districtname = $districtname->DistrictName;
    
    return view('Report.DistrictOverall')->with(compact('rows','output','indicators','from','to','districtname'));
  }

  //area report per period
  public function AreaOverall(){
   $AreaID = auth()->user()->AreaID;

   $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');
   
   $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

   $output=array();

   return view('Report.AreaOverall')->with(compact('rows','output','indicators'));
   
 }

 // Area report per period search
 public function AreaOverallsearch(Request $request){
  $indicators =\App\Models\Finance::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

  $DistrictID = auth()->user()->DistrictID;
  $AreaID = auth()->user()->AreaID;

  if(auth()->user()->UserLevelID==2){

   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
 }
 elseif(auth()->user()->UserLevelID==1){

  $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');
  

}
if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
  \Session::flash('message','Either Start date or End date is missing');
  \Session::flash('alert-class','alert-warning');            
  return redirect('AreaOverall');
}
if ($request->FromDate > $request->ToDate){        
  \Session::flash('message','Start date must be less or equal to end date');
  \Session::flash('alert-class','alert-warning');            
  return redirect('AreaOverall');
}

if ($request->AreaName==null){        
  \Session::flash('message','Please select AreaName');
  \Session::flash('alert-class','alert-warning');            
  return redirect('AreaOverall');
}

$tota=$request->FinanceType;


$baseQuery=" Select sum(finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
district.DistrictCode,district.DistrictName,
finance.date,finance.created_at  from  area join district  on area.AreaID = district.AreaID 
join assembly on  assembly.DistrictID = district.DistrictID  join finance 
on  assembly.AssemblyCode = finance.AssemblyID "; 

$baseQuery1="Select sum(finance.IndValues) as grand  from  area join district  on area.AreaID = district.AreaID 
join assembly on  assembly.DistrictID = district.DistrictID  join finance 
on  assembly.AssemblyCode = finance.AssemblyID   "; 

$whereArray= array();

if ($request->AreaName!=null)                    
  $whereArray[]="Area.AreaID={$request->AreaName}";


if ($request->FromDate && $request->ToDate )
  if ($request->FromDate!=null)                    
    $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate}' ";
  

  $whereClause= implode(" and ", $whereArray);


  if ($whereClause!=null){


    $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by area.AreaName,finance.Indicators";

    $baseQuery2=$baseQuery1." where ".$whereClause. "and finance.Activity_State=1";
    $output = \DB::select($baseQuery);
    session(['output' => $baseQuery]);
   //     dd($output);
    $total = \DB::select($baseQuery2);
  }
  else{
    $output=array();

  }   
  $areaname = \App\Models\Area::find($request->AreaName)->AreaName;
  $from=$request->FromDate;
    $to=$request->ToDate;
    $indicate = "(". $request->FinanceType .")";
  
  return view('Report.AreaOverall')->with(compact('output','rows','total','tota','indicators','areaname','from','to'));
}

  //income expenditure 
  public function assemblyincome(){
     $DistrictID = auth()->user()->DistrictID;

     // $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
      if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
      } 
      elseif(auth()->user()->UserLevelID==3){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
      } 
      elseif (auth()->user()->UserLevelID==1) {

        $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')->orderBy('AssemblyName')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
      $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

      $output=array();
      $exp = array();
      $disabled = true;
      $labels = array();
       $districtname = "";
      return view('Report.incomeexpendituresummary')->with(compact('rows','output','indicators','exp','tota','total','disabled','labels','districtname'));
  }

  //Income-Expenditure Summary Report
  public function assemblyincomesearch(Request $request){

       $DistrictID = auth()->user()->DistrictID;
    $indicators =\App\Models\Finance::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');
  //  return $request->all();
 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
    if(auth()->user()->UserLevelID==2){
      $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
    } 
    elseif(auth()->user()->UserLevelID==3){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
      } 
    elseif (auth()->user()->UserLevelID==1) {

      $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
      $arr;
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }
      
      $rows = DB::table('assembly')->orderBy('AssemblyName')
      ->whereIn('DistrictID', ($arr))
      ->lists('AssemblyName','AssemblyID');

    }


    if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpendituredetailed');
    }
    if ($request->FromDate > $request->ToDate){        
      \Session::flash('message','Start date must be less or equal to end date');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpendituredetailed');
    }

    if ($request->AssemblyName==null){        
      \Session::flash('message','Please select AssemblyName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpendituredetailed');
    }

    $from=$request->FromDate;
    $to=$request->ToDate;
     $districtname = \App\Models\Assembly::find($request->AssemblyName);
    // dd($districtname);
       $districtname = $districtname->AssemblyName;

  //  $labels = \App\Models\Finance::where('accountsubcode',0)->orderBy('accountcode','asc')->get(['Indicators','accountcode','accountsubcode']);
    $labels = \App\Accountheading::all();
  //  return $labels;
  //  dd($labels);
 
    $income="SELECT *,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators, finance.date,finance.created_at,finance.flag FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'I' AND finance.accountcode IN (4000,5000) AND accountsubcode != 0 AND assembly.AssemblyID='{$request->AssemblyName}' AND finance.date BETWEEN '{$request->FromDate}' AND '{$request->ToDate}'"; 
    $incomesum="SELECT SUM(finance.IndValues) as sumincome FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'I' AND assembly.AssemblyID='{$request->AssemblyName}' AND finance.date BETWEEN '{$request->FromDate}' AND '{$request->ToDate}' GROUP BY assembly.AssemblyID";

    $expenditure="SELECT *,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators, finance.date,finance.created_at,finance.flag FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'E' AND assembly.AssemblyID='{$request->AssemblyName}'"; 

   $expendituresum="SELECT SUM(finance.IndValues) as exptotal FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'E' AND assembly.AssemblyID='{$request->AssemblyName}' AND finance.date BETWEEN '{$request->FromDate}' AND '{$request->ToDate}' GROUP BY assembly.AssemblyID";
    

    //dd($income);
    
    
      
      
        $output = \DB::select($income);
        $sumincome = \DB::select($incomesum);
     //   $incomelabel = \DB::select($incomelabel);
       // dd($sumincome[0]->sumincome);
    //  dd($incomelabel);
        
         $exp = \DB::select($expenditure);
     //    return $exp;
      $exptotal = \DB::select($expendituresum);
      if (!$output) {
        $output=array();
      }
       
       $sumincome ;

       if (empty($exptotal)) {
        $exptotal = 0;
       }else{
        $exptotal = $exptotal[0]->exptotal;
       }
        if (empty($sumincome)) {
         $sumincome = 0;
        }else{
         $sumincome= $sumincome[0]->sumincome;
        }
     $excess = $sumincome - $exptotal;


      return view('Report.incomeexpendituresummary')->with(compact('rows','output','indicators','exp','exptotal','total','sumincome','excess','to','from','incomelabel','labels','districtname'));
  
}

  public function incomeexpenditure(){
     $DistrictID = auth()->user()->DistrictID;
      if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
   }
   elseif(auth()->user()->UserLevelID==1){

     $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',auth()->user()->AreaID)->lists('AreaName','AreaID');

   }

      $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');
        $summary = array();
      $output=array();
      $exp = array();
      $disabled = true;
       $districtname = "";
      return view('Report.incomeexpendituregeneral')->with(compact('rows','output','indicators','exp','tota','total','disabled','summary','districtname'));
  }

  //Income-Expenditure by Assembly Report
  public function incomeexpendituresearch(Request $request){
    
     if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
     $assem =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',auth()->user()->DistrictID)->get(['AssemblyCode']); 
      $districtname = \App\Models\District::find($request->AssemblyName);
       $districtname = $districtname->DistrictName;
   }
   elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

      }
   elseif(auth()->user()->UserLevelID==1){
      $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',auth()->user()->AreaID)->lists('AreaName','AreaID');

     $assem =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$request->AssemblyName)->get(['AssemblyCode']); 
      $districtname = \App\Models\Area::find($request->AssemblyName);
       $districtname = $districtname->AreaName;
   }
   if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpenditure');
    }
    if ($request->FromDate > $request->ToDate){        
      \Session::flash('message','Start date must be less or equal to end date');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpenditure');
    }

    if ($request->AssemblyName==null){        
      \Session::flash('message','Please select AssemblyName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpenditure');
    }

    $from=$request->FromDate;
    $to=$request->ToDate;
    $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

  
      $from = $request->FromDate;
      $To = $request->ToDate;
     
      

     $a;
     $b;
     \App\summary::truncate();
     for ($i=0; $i < sizeof($assem); $i++) { 
       $a []=  $assem[$i];

       $income="SELECT sum(finance.IndValues) as total  from finance 
   where finance.flag='I' and finance.AssemblyID = ". $a[$i]->AssemblyCode." AND  finance.Date between '{$request->FromDate}' and '{$request->ToDate }' and finance.Activity_State=1 GROUP BY AssemblyID "; 
    $expend="SELECT sum(finance.IndValues) as exp from finance 
   where finance.flag='E' and finance.AssemblyID = ". $a[$i]->AssemblyCode." and finance.Activity_State=1 GROUP BY AssemblyID "; 
   $AssemblyCode = \App\Models\Assembly::where('AssemblyCode',$a[$i]->AssemblyCode)->get(['AssemblyName']);

   $b = \DB::select($income);
  
   $c = \DB::select($expend);
    $copy = new \App\summary;
    if($b){
      
     $copy->assembly = $AssemblyCode[0]->AssemblyName or 0;
     $copy->balance = ($b[0]->total - $c[0]->exp) or 0;
     $copy->totalincome = $b[0]->total or 0;
     $copy->totalexpenditure = $c[0]->exp or 0;
     $copy->save();
    };
   

     }
    
    $summary = \App\summary::all();
   // $output =\DB::select($income);
    $output = array();
    
  //  dd($exp);
  //  $try = "SELECT * from $output";
    //$try = \DB::select($try);
    //dd($try);
   
    return view('Report.incomeexpendituregeneral',compact('rows','indicators','summary','ToDate','FromDate','output','from','to','districtname'));
  }

   public function assemblyincomedetailed(){
      $DistrictID = auth()->user()->DistrictID;

     // $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
      if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
      } 
      elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

      }
      elseif (auth()->user()->UserLevelID==1) {

        $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
      $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');

      $output=array();
      $exp = array();
      $disabled = true;
      $labels = array();
      $districtname = "";
      return view('Report.incomeexpendituredetailed')->with(compact('rows','output','indicators','exp','tota','total','disabled','labels','districtname'));
  }

  public function assemblyincomedetailedsearch(Request $request){

      $DistrictID = auth()->user()->DistrictID;
    $indicators =\App\Models\Finance::orderBy('Indicators')->Distinct('Indicators')->lists('Indicators','Indicators');
  //  return $request->all();
 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
    if(auth()->user()->UserLevelID==2){
      $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
    } 
    elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

      }
    elseif (auth()->user()->UserLevelID==1) {

      $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
      $arr;
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }
      
      $rows = DB::table('assembly')->orderBy('AssemblyName')
      ->whereIn('DistrictID', ($arr))
      ->lists('AssemblyName','AssemblyID');

    }


    if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpendituredetailed');
    }
    if ($request->FromDate > $request->ToDate){        
      \Session::flash('message','Start date must be less or equal to end date');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpendituredetailed');
    }

    if ($request->AssemblyName==null){        
      \Session::flash('message','Please select AssemblyName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('incomeexpendituredetailed');
    }

    $from=$request->FromDate;
    $to=$request->ToDate;
     $districtname = \App\Models\Assembly::find($request->AssemblyName);
    // dd($districtname);
       $districtname = $districtname->AssemblyName;

  //  $labels = \App\Models\Finance::where('accountsubcode',0)->orderBy('accountcode','asc')->get(['Indicators','accountcode','accountsubcode']);
    $labels = \App\Accountheading::all();
  //  return $labels;
  //  dd($labels);
 
    $income="SELECT *,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators, finance.date,finance.created_at,finance.flag FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'I' AND finance.accountcode IN (4000,5000) AND accountsubcode != 0 AND assembly.AssemblyID='{$request->AssemblyName}' AND finance.date BETWEEN '{$request->FromDate}' AND '{$request->ToDate}'"; 
    $incomesum="SELECT SUM(finance.IndValues) as sumincome FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'I' AND assembly.AssemblyID='{$request->AssemblyName}' AND finance.date BETWEEN '{$request->FromDate}' AND '{$request->ToDate}' GROUP BY assembly.AssemblyID";

    $expenditure="SELECT *,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators, finance.date,finance.created_at,finance.flag FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'E' AND assembly.AssemblyID='{$request->AssemblyName}'"; 

   $expendituresum="SELECT SUM(finance.IndValues) as exptotal FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'E' AND assembly.AssemblyID='{$request->AssemblyName}' AND finance.date BETWEEN '{$request->FromDate}' AND '{$request->ToDate}' GROUP BY assembly.AssemblyID";
    

    //dd($income);
    
    
      
      
        $output = \DB::select($income);
        $sumincome = \DB::select($incomesum);
     //   $incomelabel = \DB::select($incomelabel);
       // dd($sumincome[0]->sumincome);
    //  dd($incomelabel);
        
         $exp = \DB::select($expenditure);
     //    return $exp;
      $exptotal = \DB::select($expendituresum);
      if (!$output) {
        $output=array();
      }
       
       $sumincome ;

       if (empty($exptotal)) {
        $exptotal = 0;
       }else{
        $exptotal = $exptotal[0]->exptotal;
       }
        if (empty($sumincome)) {
         $sumincome = 0;
        }else{
         $sumincome= $sumincome[0]->sumincome;
        }
     $excess = $sumincome - $exptotal;

      return view('Report.incomeexpendituredetailed')->with(compact('rows','output','indicators','exp','exptotal','total','sumincome','excess','to','from','incomelabel','labels','districtname'));
  
}

  public function districtincome(){
    $districtname = "";
    if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
   }
   elseif(auth()->user()->UserLevelID==1){

     $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',auth()->user()->AreaID)->lists('DistrictName','DistrictID');

   }
      $indicators = array();
      $output = array();
      $labels = array();

    return view('Report.districtincomesummary',compact('rows','output','indicators','exp','exptotal','total','sumincome','excess','to','from','incomelabel','labels','districtname'));
  }

  //District Income-Expenditure Summary Report
  public function districtincomesearch(Request $request){
    if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('districtincome');
    }
    if ($request->FromDate > $request->ToDate){        
      \Session::flash('message','Start date must be less or equal to end date');
      \Session::flash('alert-class','alert-warning');            
      return redirect('districtincome');
    }

    if ($request->AssemblyName==null){        
      \Session::flash('message','Please select AssemblyName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('districtincome');
    }

    $from=$request->FromDate;
    $to=$request->ToDate;
    $districtname = \App\Models\District::find($request->AssemblyName);
       $districtname = $districtname->DistrictName;
    if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
     $query = \App\Models\Assembly::where('DistrictID',auth()->user()->DistrictID)->get(['AssemblyCode']);
    $arr;
    foreach ($query as $id) {
      $arr [] = $id->AssemblyCode;
    }
    
   }elseif(auth()->user()->UserLevelID==1){

     $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',auth()->user()->AreaID)->lists('DistrictName','DistrictID');
     $query = \App\Models\Assembly::where('DistrictID',$request->AssemblyName)->get(['AssemblyCode']);
    $arr = [];
    foreach ($query as $id) {
      $arr [] = $id->AssemblyCode;
    }
   /*  $assemblies =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',auth()->user()->AreaID)->lists('DistrictID');
   $ar;
     foreach ($assemblies as $dist) {
      $ar [] = $dist;
    }
    */
   // dd($arr);

      $query = \App\Models\Assembly::whereIn('DistrictID',$arr)->get();
     
    //  dd($query);
    $arr;
    foreach ($query as $id) {
      $arr [] = $id->AssemblyCode;
    }

   }

    $indicators = array();
      $output = array();
      $labels = \App\Accountheading::all();
  

     
    return view('Report.districtincomesummary',compact('rows','output','indicators','total','to','from','incomelabel','labels','districtname','arr'));
  }

  public function areaincome(){
    $districtname = "";
    if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
   }
   elseif(auth()->user()->UserLevelID==1){

     $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',auth()->user()->AreaID)->lists('AreaName','AreaID');

   }
      $indicators = array();
      $output = array();
      $labels = array();

    return view('Report.areaincomesummary',compact('rows','output','indicators','exp','exptotal','total','sumincome','excess','to','from','incomelabel','labels','districtname'));
  }

    //Area Income-Expenditure Summary Report
   public function areaincomesearch(Request $request){
    if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('districtincome');
    }
    if ($request->FromDate > $request->ToDate){        
      \Session::flash('message','Start date must be less or equal to end date');
      \Session::flash('alert-class','alert-warning');            
      return redirect('districtincome');
    }

    if ($request->AssemblyName==null){        
      \Session::flash('message','Please select AssemblyName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('districtincome');
    }

    $from=$request->FromDate;
    $to=$request->ToDate;
    $districtname = \App\Models\Area::find($request->AssemblyName);
       $districtname = $districtname->AreaName;
    if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
     $query = \App\Models\Assembly::where('DistrictID',auth()->user()->DistrictID)->get(['AssemblyCode']);
    $arr;
    foreach ($query as $id) {
      $arr [] = $id->AssemblyCode;
    }
    
   }elseif(auth()->user()->UserLevelID==1){

     $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',auth()->user()->AreaID)->lists('AreaName','AreaID');
     $finddistrcis = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
     $arr = [];
    foreach ($finddistrcis as $id) {
      $arr [] = $id->AssemblyCode;
    }
     $query = \App\Models\Assembly::whereIn('DistrictID',$arr)->get(['AssemblyCode']);
    $arr = [];
    foreach ($query as $id) {
      $arr [] = $id->AssemblyCode;
    }
     $assemblies =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',auth()->user()->AreaID)->lists('DistrictID');
   $arr = [];
     foreach ($assemblies as $dist) {
      $arr [] = $dist;
    }
    
   // dd($arr);

      $query = \App\Models\Assembly::whereIn('DistrictID',$arr)->get();
     
    //  dd($query);
    $arr = [];
    foreach ($query as $id) {
      $arr [] = $id->AssemblyCode;
    }

   }

    $indicators = array();
      $output = array();
      $labels = \App\Accountheading::all();

  return view('Report.areaincomesummary',compact('rows','output','indicators','total','to','from','incomelabel','labels','districtname','arr'));
  }

  public function statisticaldistrict(){
    $output = array();
    $indicators = array();
    $rows = array();
    return view('Report.statisticaldistrict',compact('output','rows','indicators'));
  }
}