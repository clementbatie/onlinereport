<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityUpdate;
use App\Models\Minute;
use App\Models\hours;
use App\Models\Region;
use App\Models\Finance;
use App\Models\Assembly;
use App\Models\Area;
use App\Models\District;
use App\National;
use App\Cellattendance;
use Auth;
use App\Http\Requests;
use Validator; 
use DB;
use Illuminate\Support\Facades\Input;
use App\Topic;
use App\Position;
use App\Positionlog;
use App\Leader;
use App\Meeting;
use App\Meetingtype;
use App\Membertype;
use App\Markattendance;
use App\Member;
use App\Cellmeetingattendance;

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

     // $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
      if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
      } elseif (auth()->user()->UserLevelID==1) {

        $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
        $arr = array();
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')->orderBy('AssemblyName')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
      elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

     }
     elseif (auth()->user()->UserLevelID==4) {
      $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
       // dd($query);
      $Areaarray = array(); 
      foreach ($query as $id) {
        $Areaarray [] = $id->AreaID;
      }
       // dd($Areaarray);
      $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);
     //    dd($query);
      $arr = array();
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }

      $rows = DB::table('assembly')->orderBy('AssemblyName')
      ->whereIn('DistrictID', ($arr))
      ->lists('AssemblyName','AssemblyID');

    }
    $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
    ->lists('Indicators','Indicators');

    $output=array();

    return view('Report.Assembly')->with(compact('rows','output','indicators'));

  }

  public function AssemblyDetailed()
  { 
    $DistrictID = auth()->user()->DistrictID;

    //  $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
    if(auth()->user()->UserLevelID==2){
      $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
    } elseif (auth()->user()->UserLevelID==1) {

      $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
      $arr = array();
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }

      $rows = DB::table('assembly')->orderBy('AssemblyName')
      ->whereIn('DistrictID', ($arr))
      ->lists('AssemblyName','AssemblyID');

    }
    elseif (auth()->user()->UserLevelID==3) {

     $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

   }
   elseif (auth()->user()->UserLevelID==4) {
    $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = array(); //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr = array();
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
      $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');

      $output=array();

      return view('Report.AssemblyDetailed')->with(compact('rows','output','indicators'));

    }
    // District Summary Report
    public function PeriodicAssemblyDistrict(Request $request)
    {           // get list of various indicators
     $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
     ->lists('Indicators','Indicators');

     $DistrictID = auth()->user()->DistrictID;  
     $AreaID = auth()->user()->AreaID;

     if(auth()->user()->UserLevelID==2){

       $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
     }
     elseif(auth()->user()->UserLevelID==1){

       $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',$AreaID)->lists('DistrictName','DistrictID');

     }
     elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

     }
     elseif (auth()->user()->UserLevelID==4) {
      $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = array(); //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $rows = DB::table('district')->whereIn('AreaID',$Areaarray)->orderBy('DistrictName')->lists('DistrictName','DistrictID');


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
     $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
     ->lists('Indicators','Indicators');

     $DistrictID = auth()->user()->DistrictID;
     if(auth()->user()->UserLevelID==2){

       $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
     }
     elseif(auth()->user()->UserLevelID==1){

       $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',$AreaID)->lists('DistrictName','DistrictID');

     }elseif (auth()->user()->UserLevelID==4) {
      $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray= array(); //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $rows = DB::table('district')->whereIn('AreaID',$Areaarray)->orderBy('DistrictName')->lists('DistrictName','DistrictID');


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

     $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
     $arr = array();
     foreach ($query as $id) {
      $arr [] = $id->DistrictID;
    }

    $rows = DB::table('assembly')->orderBy('AssemblyName')
    ->whereIn('DistrictID', ($arr))
    ->lists('AssemblyName','AssemblyID');
     // return $rows;
  }
  elseif (auth()->user()->UserLevelID==4) {
    $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = array(); //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr = array();
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')
        ->lists('AssemblyName','AssemblyID');

      }

      $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');
      $ind = \App\Indicator::where('Indicators',$request->FinanceType)->first()->IndicatorType;

      switch ($ind) {
        case 'D':
        $subquery = " and finance.IndValues REGEXP '[A-z]'";
        break;

        default:
        $subquery = " and finance.IndValues REGEXP '[0-9]'";
        break;
      }

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
          $baseQuery=$baseQuery." where ".$whereClause. "and finance.Activity_State=1 " .$subquery;
          $baseQuery2=$baseQuery1." where ".$whereClause. "and finance.Activity_State=1 " .$subquery;
          $output = \DB::select($baseQuery);
     // dd($output);
          $total = \DB::select($baseQuery2);
        }
        else{
          $output=array();

        }   
        $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by assembly.AssemblyName";
   //  return $baseQuery;
	  //dd($total);
        return view('Report.Assembly')->with(compact('indicators','output','rows','total','tota','districtname','from','to','indicate'));

      }


//Assembly Detailed Report
      public function PeriodicAssemblyDetailed(Request $request){
    // return var_dump($request->all());
       $DistrictID = auth()->user()->DistrictID;
       $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
       ->lists('Indicators','Indicators');

 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
       if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
      } elseif (auth()->user()->UserLevelID==1) {

        $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
        $arr = array();
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }

        $rows = DB::table('assembly')->orderBy('AssemblyName')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
      elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

     }
     elseif (auth()->user()->UserLevelID==4) {
      $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = array(); //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr = array();
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')
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
        $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
        ->lists('Indicators','Indicators');


        $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');
        if (auth()->user()->UserLevelID==4) {

          $rows = DB::table('area')->where('NationalID',auth()->user()->NationalID)->orderBy('AreaName')->lists('AreaName','AreaID');
        }

        $output=array();

        return view('Report.Area')->with(compact('rows','output','indicators'));

      }

  //Area Summary report search
      public function PeriodicArea(Request $request)
      {
       $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
       ->lists('Indicators','Indicators');

       $DistrictID = auth()->user()->DistrictID;
       $AreaID = auth()->user()->AreaID;

       if(auth()->user()->UserLevelID==2){

         $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
       }
       elseif(auth()->user()->UserLevelID==1){

        $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');
      }elseif (auth()->user()->UserLevelID==4) {

        $rows = DB::table('area')->where('NationalID',auth()->user()->NationalID)->orderBy('AreaName')->lists('AreaName','AreaID');
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
        } elseif (auth()->user()->UserLevelID==1) {

          $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
          $arr;
          foreach ($query as $id) {
            $arr [] = $id->DistrictID;
          }

          $rows = \App\Models\Assembly::whereIn('DistrictID', ($arr))->orderBy('AssemblyName')
          ->lists('AssemblyName','AssemblyID');

        }
        elseif (auth()->user()->UserLevelID==3) {

         $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

       }
       elseif (auth()->user()->UserLevelID==4) {
        $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')
        ->lists('AssemblyName','AssemblyID');

      }
      $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');

      $output=array();

      return view('Report.AssemblyOverall')->with(compact('rows','output','indicators'));

    }

  // Assembly Report Per Period Searh
    public function AssemblyOverallsearch(Request $request){
      $DistrictID = auth()->user()->DistrictID;
      $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');

 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
      if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
      } elseif (auth()->user()->UserLevelID==1) {

        $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }

        $rows = \App\Models\Assembly::whereIn('DistrictID', ($arr))->orderBy('AssemblyName')
        ->lists('AssemblyName','AssemblyID');

      }
      elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

     }
     elseif (auth()->user()->UserLevelID==4) {
      $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')
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

       }elseif (auth()->user()->UserLevelID==4) {
        $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $rows = DB::table('district')->whereIn('AreaID',$Areaarray)->orderBy('DistrictName')->lists('DistrictName','DistrictID');


      }
      $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');

      $output=array();

      return view('Report.DistrictOverall')->with(compact('rows','output','indicators'));
      
    }

    // District Report Per Period Search
    public function DistrictOverallsearch(Request $request){
     $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
     ->lists('Indicators','Indicators');

     $DistrictID = auth()->user()->DistrictID;
     $AreaID = auth()->user()->AreaID;

     if(auth()->user()->UserLevelID==2){

       $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
     }
     elseif(auth()->user()->UserLevelID==1){

       $rows =\App\Models\District::orderBy('DistrictName')->where('AreaID','=',$AreaID)->lists('DistrictName','DistrictID');

     }
     elseif (auth()->user()->UserLevelID==4) {
      $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $rows = DB::table('district')->whereIn('AreaID',$Areaarray)->orderBy('DistrictName')->lists('DistrictName','DistrictID');


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
          $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by finance.Indicators,District.DistrictID";
        }
        if(auth()->user()->UserLevelID==1){
          $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by finance.Indicators,District.DistrictID";

        }
        $baseQuery2=$baseQuery1." where ".$whereClause."and finance.Activity_State=1";
        $output = \DB::select($baseQuery);
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
     if (auth()->user()->UserLevelID==4) {

      $rows = DB::table('area')->where('NationalID',auth()->user()->NationalID)->orderBy('AreaName')->lists('AreaName','AreaID');
    }
    $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
    ->lists('Indicators','Indicators');

    $output=array();

    return view('Report.AreaOverall')->with(compact('rows','output','indicators'));

  }

 // Area report per period search
  public function AreaOverallsearch(Request $request){
   $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
   ->lists('Indicators','Indicators');

   $DistrictID = auth()->user()->DistrictID;
   $AreaID = auth()->user()->AreaID;

   if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
   }
   elseif(auth()->user()->UserLevelID==1){

    $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');


  }elseif (auth()->user()->UserLevelID==4) {

    $rows = DB::table('area')->where('NationalID',auth()->user()->NationalID)->orderBy('AreaName')->lists('AreaName','AreaID');
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
  } elseif (auth()->user()->UserLevelID==1) {

    $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
    $arr;
    foreach ($query as $id) {
      $arr [] = $id->DistrictID;
    }

    $rows = DB::table('assembly')->orderBy('AssemblyName')
    ->whereIn('DistrictID', ($arr))
    ->lists('AssemblyName','AssemblyID');

  }
  elseif (auth()->user()->UserLevelID==3) {

   $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

 }
 elseif(auth()->user()->UserLevelID==4){
  $rows =\App\Models\Area::orderBy('AreaName')->where('NationalID','=',auth()->user()->NationalID)->lists('AreaName','AreaID');
  $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = []; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }
        
        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr = [];
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        $rows = DB::table('assembly')->orderBy('AssemblyName')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
      $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');

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
     $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
     ->lists('Indicators','Indicators');
     $split = explode("-", $request->FromDate);
    //  return $split;
     $openenddate = \Carbon\Carbon::create($split[0],$split[1],$split[2],0,0,0)->subDay()->toDateString();
 //   return $openenddate;
 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
     if(auth()->user()->UserLevelID==2){
      $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
    } elseif (auth()->user()->UserLevelID==1) {

      $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
      $arr;
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }
      
      $rows = DB::table('assembly')->orderBy('AssemblyName')
      ->whereIn('DistrictID', ($arr))
      ->lists('AssemblyName','AssemblyID');

    }
    elseif (auth()->user()->UserLevelID==3) {

     $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

   }
   elseif(auth()->user()->UserLevelID==4){
    $rows =\App\Models\Area::orderBy('AreaName')->where('NationalID','=',auth()->user()->NationalID)->lists('AreaName','AreaID');
    $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

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


      $labels = \App\Accountheading::all();
  //  return $labels;
  //  dd($labels);

      $income="SELECT *,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators, finance.date,finance.created_at,finance.flag FROM finance JOIN assembly on assembly.AssemblyCode = finance.AssemblyID WHERE finance.flag = 'I' AND accountsubcode != 0 AND assembly.AssemblyID='{$request->AssemblyName}' AND finance.date BETWEEN '{$request->FromDate}' AND '{$request->ToDate}'"; 
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
     elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

     }
     elseif(auth()->user()->UserLevelID==1){

       $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',auth()->user()->AreaID)->lists('AreaName','AreaID');

     }elseif(auth()->user()->UserLevelID==4){
      $rows =\App\National::find(auth()->user()->NationalID)->lists('NationalName','NationalID');
    }

     $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')->where('NationalID',auth()->user()->NationalID)->where('IndicatorType',"F")
      ->lists('Indicators','Indicators');
    $summary = array();
    $output=array();
    $exp = array();
    $disabled = true;
    $districtname = "";
    return view('Report.incomeexpendituregeneral')->with(compact('rows','output','indicators','exp','tota','total','disabled','summary','districtname'));
  }

  //Income-Expenditure by Assembly Report
  public function incomeexpendituresearch(Request $request){
//dd($request->all());

   if(auth()->user()->UserLevelID==2){

     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
     $assem =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('AssemblyCode'); 
     $districtname = \App\Models\District::find($request->AssemblyName)->DistrictName;
   }
   elseif (auth()->user()->UserLevelID==3) {

     $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
     $assem =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyID','=',auth()->user()->AssemblyID)->lists('AssemblyCode'); 

   }
   elseif(auth()->user()->UserLevelID==1){
    $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',auth()->user()->AreaID)->lists('AreaName','AreaID');
    $districts = \App\Models\District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       // dd($arr);
    $assem =\App\Models\Assembly::orderBy('AssemblyName')->whereIn('DistrictID',$districts)->lists('AssemblyCode');

    $districtname = \App\Models\Area::find($request->AssemblyName);
    $districtname = $districtname->AreaName;
  }
  elseif(auth()->user()->UserLevelID==4){
    $rows =\App\National::find(auth()->user()->NationalID)->lists('NationalName','NationalID');
    $areas = DB::table('area')->where('NationalID',auth()->user()->NationalID)->lists('AreaID');
        $districts = DB::table('district')->whereIn('AreaID',$areas)->lists('DistrictID');
        $assem =\App\Models\Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode'); 
    // dd($assem);
        $districtname = \App\Models\Area::find($request->AssemblyName)->AreaName;
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
      $split = explode("-", $from);
$openenddate = \Carbon\Carbon::create($split[0],$split[1],$split[2],0,0,0)->subDay()->toDateString();
$startdate = "0000-00-00";
$balancebf = 0;
      $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->where('NationalID',auth()->user()->NationalID)->where('IndicatorType',"F")
      ->lists('Indicators','Indicators');

      $from = $request->FromDate;
      $To = $request->ToDate;

      $ftype = $category = 1;
      $whereclause = "";
      if ($request->category == "" || $request->category == NULL) {
         $category = 0;
      }

      if ($request->FinanceType == "" || $request->FinanceType == NULL) {
         $ftype =0;
      }

      $a;
      $b;
      \App\summary::truncate();
      foreach ($assem as $assemblycode) {
      //  $assemblycode = "2003";
        $openincome =Finance::where('flag',"I")->where('AssemblyID',$assemblycode)->whereBetween('date',[$startdate,$openenddate])->where('Activity_State',1)->where('IndicatorType',"!=","D")->where('IndicatorType',"F")->sum('IndValues');

        $income = Finance::where('flag',"I")->where('AssemblyID',$assemblycode)->whereBetween('date',[$from,$to])->where('Activity_State',1)->where('IndicatorType',"!=","D")->where('IndicatorType',"F");
        if ($request->FinanceType == "I") {
            $income = $income->where('flag',"I");
        }
        if ($category == "1") {
            $income = $income->where('Indicators',$request->category);
        }
        $incometotal = $income->sum('IndValues');

        $openexpend =Finance::where('flag',"E")->where('AssemblyID',$assemblycode)->whereBetween('date',[$startdate,$openenddate])->where('Activity_State',1)->where('IndicatorType',"!=","D")->where('IndicatorType',"F")->sum('IndValues');

        $expemd = Finance::where('flag',"E")->where('AssemblyID',$assemblycode)->whereBetween('date',[$from,$to])->where('Activity_State',1)->where('IndicatorType',"!=","D")->where('IndicatorType',"F");
        if ($request->FinanceType == "E") {
            $income = $income->where('flag',"E");
        }
        if ($category == "1") {
            $income = $expemd->where('Indicators',$request->category);
        }
        $exptotal = $expemd->sum('IndValues');
//dd($incometotal);
         $copy = new \App\summary;
          $copy->balancebf = ( (float)$openincome - (float)$openexpend );
        $copy->assembly = Assembly::where('AssemblyCode',$assemblycode)->first()->AssemblyName;
        if ($request->FinanceType == "E") {
          
        $copy->totalincome = 0;
        $copy->totalexpenditure = (float)$exptotal;
        $copy->balance = ($copy->totalincome - $copy->totalexpenditure) +   $copy->balancebf;
        }elseif ($request->FinanceType == "I") {
        $copy->totalincome = (float)$incometotal;
        $copy->totalexpenditure = 0;
        $copy->balance = ($copy->totalincome - $copy->totalexpenditure) +   $copy->balancebf;
        }else{
        
        $copy->totalincome = (float)$incometotal;
        $copy->totalexpenditure = (float)$exptotal;
          $copy->balance = ($incometotal - $exptotal) +   $copy->balancebf;
        }
       
        //dd($copy->balancebf)
         $copy->save();
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

    $rows = DB::table('assembly')->orderBy('AssemblyName')
    ->whereIn('DistrictID', ($arr))
    ->lists('AssemblyName','AssemblyID');

  }
  $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
  ->lists('Indicators','Indicators');

  $output=array();
  $exp = array();
  $disabled = true;
  $labels = array();
  $districtname = "";
  return view('Report.incomeexpendituredetailed')->with(compact('rows','output','indicators','exp','tota','total','disabled','labels','districtname'));
}

public function assemblyincomedetailedsearch(Request $request){

  $DistrictID = auth()->user()->DistrictID;
  $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
  ->lists('Indicators','Indicators');
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
  $arr = [];
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

   $rows = District::where('DistrictID',auth()->user()->DistrictID)->lists("DistrictName",'DistrictID');
 }
 elseif(auth()->user()->UserLevelID==1){

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists("AreaName",'AreaID');   

 }elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  }
      $indicators = array();
      $output = array();
      $labels = array();
       $summary = [];

      return view('Report.districtincomesummary',compact('rows','output','indicators','exp','exptotal','total','sumincome','excess','to','from','incomelabel','summary','districtname'));
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

   $from = $request->FromDate;
      $to = $request->ToDate;
      $startdate = "0000-00-00";
       $split = explode("-", $from);
$openenddate = \Carbon\Carbon::create($split[0],$split[1],$split[2],0,0,0)->subDay()->toDateString();

 if(auth()->user()->UserLevelID==2){
  $rows = District::where('DistrictID',auth()->user()->DistrictID)->lists("DistrictName",'DistrictID');
   $assemblies = Assembly::where('DistrictID',auth()->user()->AreaID)->lists('AssemblyCode'); 
   $districtname = District::find(auth()->user()->DistrictID)->DistrictName;
 }
 elseif(auth()->user()->UserLevelID==1){
$rows = Area::where('AreaID',auth()->user()->AreaID)->lists("AreaName",'AreaID');   
   $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');    
 $districtname = Area::find(auth()->user()->AreaID)->AreaName;
 }elseif (auth()->user()->UserLevelID==4) {
   $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  $areas = DB::table('area')->where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');    
   $districtname = National::find(auth()->user()->NationalID)->NationalName;
  }
    \App\summary::truncate();
      for ($i=0; $i < sizeof($districts); $i++) { 
      $assemblies = Assembly::where('DistrictID',$districts[$i])->lists('AssemblyCode');   
       $income = Finance::where('flag','I')->whereIn('AssemblyID',$assemblies)->whereBetween('date',[$from,$to])->where('Activity_State',1)->where('IndicatorType','!=','D')
       ->sum('IndValues');
       $openincome =Finance::where('flag',"I")->whereIn('AssemblyID',$assemblies)->whereBetween('date',[$startdate,$openenddate])->where('Activity_State',1)->where('IndicatorType',"!=","D")->where('IndicatorType',"F")->sum('IndValues');
    //   dd($income);
       $openexpend =Finance::where('flag',"E")->whereIn('AssemblyID',$assemblies)->whereBetween('date',[$startdate,$openenddate])->where('Activity_State',1)->where('IndicatorType',"!=","D")->where('IndicatorType',"F")->sum('IndValues');
      $expend = Finance::where('flag','E')->whereIn('AssemblyID',$assemblies)->whereBetween('date',[$from,$to])->where('Activity_State',1)->where('IndicatorType','!=','D')
       ->sum('IndValues');

       $dist = \App\Models\District::find($districts[$i])->DistrictName;

  
    
       $copy = new \App\summary;


        $copy->assembly = $dist ;
       
        $copy->totalincome = (float)$income ;
        $copy->totalexpenditure =  (float)$expend ;
        $copy->balancebf =  (float)$openincome - (float)$openexpend ;
          $copy->balance =   ( $copy->totalincome - $copy->totalexpenditure) +   $copy->balancebf;
        $copy->save();
      }


    $indicators = array();
      $output = array();
      $labels = array();
    
    $summary = \App\summary::all();
   
      return view('Report.districtincomesummary',compact('rows','output','indicators','total','to','from','incomelabel','summary','districtname','arr'));
    }

    public function areaincome(){
      $districtname = "";
      if(auth()->user()->UserLevelID==2){
       $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
     }
     elseif(auth()->user()->UserLevelID==1){

       $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',auth()->user()->AreaID)->lists('AreaName','AreaID');

     }elseif (auth()->user()->UserLevelID==4) {

      $rows = DB::table('nationals')->where('NationalID',auth()->user()->NationalID)->orderBy('NationalName')->lists('NationalName','NationalID');
    }
    $indicators = array();
    $output = array();
    $summary = array();

    return view('Report.areaincomesummary',compact('rows','output','indicators','exp','exptotal','total','sumincome','excess','to','from','incomelabel','summary','districtname'));
  }

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
     $startdate = "0000-00-00";
       $split = explode("-", $from);
$openenddate = \Carbon\Carbon::create($split[0],$split[1],$split[2],0,0,0)->subDay()->toDateString();
   
    if(auth()->user()->UserLevelID==2){
  $rows = District::where('DistrictID',auth()->user()->DistrictID)->lists("DistrictName",'DistrictID');
   $assemblies = Assembly::where('DistrictID',auth()->user()->AreaID)->lists('AssemblyCode'); 
   $districtname = District::find(auth()->user()->DistrictID)->DistrictName;
 }
 elseif(auth()->user()->UserLevelID==1){
$rows = Area::where('AreaID',auth()->user()->AreaID)->lists("AreaName",'AreaID');   
$areas = DB::table('area')->where('AreaID',auth()->user()->AreaID)->lists('AreaID');
   $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');    
 $districtname = Area::find(auth()->user()->AreaID)->AreaName;
 }elseif (auth()->user()->UserLevelID==4) {
   $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  $areas = DB::table('area')->where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');    
   $districtname = National::find(auth()->user()->NationalID)->NationalName;
  }
    \App\summary::truncate();
      for ($i=0; $i < sizeof($areas); $i++) { 
        $districts = District::where('AreaID',$areas[$i])->lists('DistrictID');
      $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');   
       $income = Finance::where('flag','I')->whereIn('AssemblyID',$assemblies)->whereBetween('date',[$from,$to])->where('Activity_State',1)->where('IndicatorType','!=','D')
       ->sum('IndValues');
       $openincome =Finance::where('flag',"I")->whereIn('AssemblyID',$assemblies)->whereBetween('date',[$startdate,$openenddate])->where('Activity_State',1)->where('IndicatorType',"!=","D")->where('IndicatorType',"F")->sum('IndValues');
    //   dd($income);
       $openexpend =Finance::where('flag',"E")->whereIn('AssemblyID',$assemblies)->whereBetween('date',[$startdate,$openenddate])->where('Activity_State',1)->where('IndicatorType',"!=","D")->where('IndicatorType',"F")->sum('IndValues');
      $expend = Finance::where('flag','E')->whereIn('AssemblyID',$assemblies)->whereBetween('date',[$from,$to])->where('Activity_State',1)->where('IndicatorType','!=','D')
       ->sum('IndValues');

       $dist = \App\Models\Area::find($areas[$i])->AreaName;

       $copy = new \App\summary;


        $copy->assembly = $dist ;
      
        $copy->totalincome = (float)$income ;
        $copy->totalexpenditure =  (float)$expend ;
        $copy->balancebf =  ( (float)$openincome - (float)$openexpend );
        $copy->balance =  ( $copy->totalincome - $copy->totalexpenditure) +   $copy->balancebf;
        $copy->save();
      }


    $indicators = array();
      $output = array();
      $labels = array();
    
    $summary = \App\summary::all();
   

return view('Report.areaincomesummary',compact('rows','output','indicators','total','to','from','incomelabel','summary','districtname','arr'));
}

public function statisticaldistrict(){
  $output = array();
  $indicators = array();
  $rows = array();
  return view('Report.statisticaldistrict',compact('output','rows','indicators'));
}
  // National Summary Report
public function Nationals(){

 $rows = DB::table('nationals')->where('NationalID',auth()->user()->NationalID)->orderBy('NationalName')->lists('NationalName','NationalID');
 $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
 ->lists('Indicators','Indicators');
 $output = [];
 return view('Report.National',compact('rows','indicators','output'));
}

   // National Summary Report search
public function Nationalsearch(Request $request){

  $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
  ->lists('Indicators','Indicators');

  $DistrictID = auth()->user()->DistrictID;
  $AreaID = auth()->user()->AreaID;

  if(auth()->user()->UserLevelID==2){

   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
 }
 elseif(auth()->user()->UserLevelID==1){

  $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');
}elseif (auth()->user()->UserLevelID==4) {

  $rows = DB::table('nationals')->where('NationalID',auth()->user()->NationalID)->orderBy('NationalName')->lists('NationalName','NationalID');
}
if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
  \Session::flash('message','Either Start date or End date is missing');
  \Session::flash('alert-class','alert-warning');            
  return redirect('Nationals');
}
if ($request->FromDate > $request->ToDate){        
  \Session::flash('message','Start date must be less or equal to end date');
  \Session::flash('alert-class','alert-warning');            
  return redirect('Nationals');
}
if ($request->FinanceType==null){        
  \Session::flash('message','Please select Report Type');
  \Session::flash('alert-class','alert-warning');            
  return redirect('Nationals');
}
if ($request->AreaName==null){        
  \Session::flash('message','Please select AreaName');
  \Session::flash('alert-class','alert-warning');            
  return redirect('Nationals');
}

$tota=$request->FinanceType;
$from=$request->FromDate;
$to=$request->ToDate;
$indicate = "(". $request->FinanceType .")";

$baseQuery=" Select sum(finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
district.DistrictCode,district.DistrictName,area.AreaName,area.AreaID,nationals.NationalName,
finance.date,finance.created_at  from  area join district  on area.AreaID = district.AreaID 
join assembly on  assembly.DistrictID = district.DistrictID  join finance 
on  assembly.AssemblyCode = finance.AssemblyID join nationals on nationals.NationalID = area.NationalID "; 

$baseQuery1="Select sum(finance.IndValues) as grand  from  area join district  on area.AreaID = district.AreaID 
join assembly on  assembly.DistrictID = district.DistrictID  join finance 
on  assembly.AssemblyCode = finance.AssemblyID join nationals on nationals.NationalID = area.NationalID"; 

$whereArray= array();

if ($request->AreaName!=null)                    
  $whereArray[]="nationals.NationalID={$request->AreaName}";


if ($request->FromDate && $request->ToDate )
  if ($request->FromDate!=null)                    
    $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate}' ";
  if ($request->FinanceType!=null)                    
    $whereArray[]="finance.Indicators ='{$request->FinanceType}'";

  $whereClause= implode(" and ", $whereArray);


  if ($whereClause!=null){


    $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by area.AreaName,Area.AreaID";

    $baseQuery2=$baseQuery1." where ".$whereClause. "and finance.Activity_State=1";
    $output = \DB::select($baseQuery);
    $total = \DB::select($baseQuery2);
  }
  else{
    $output=array();

  }   
  $areaname = \App\National::find($request->AreaName)->NationalName;
  
  return view('Report.National')->with(compact('output','rows','total','tota','indicators','areaname','indicate','to','from'));

}

public function Nationaloverall(){
  $AreaID = auth()->user()->AreaID;

  $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');
  if (auth()->user()->UserLevelID==4) {

    $rows = DB::table('nationals')->where('NationalID',auth()->user()->NationalID)->orderBy('NationalName')->lists('NationalName','NationalID');
  }
  $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
  ->lists('Indicators','Indicators');

  $output=array();

  return view('Report.Nationaloverall',compact('rows','output','indicators'));
}

public function Nationaloverallsearch(Request $request){
  $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
  ->lists('Indicators','Indicators');

  $DistrictID = auth()->user()->DistrictID;
  $AreaID = auth()->user()->AreaID;

  if(auth()->user()->UserLevelID==2){

   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');
 }
 elseif(auth()->user()->UserLevelID==1){

  $rows =\App\Models\Area::orderBy('AreaName')->where('AreaID','=',$AreaID)->lists('AreaName','AreaID');
  

}elseif (auth()->user()->UserLevelID==4) {

 $rows = DB::table('nationals')->where('NationalID',auth()->user()->NationalID)->orderBy('NationalName')->lists('NationalName','NationalID');
}

if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
  \Session::flash('message','Either Start date or End date is missing');
  \Session::flash('alert-class','alert-warning');            
  return redirect('Nationaloverall');
}
if ($request->FromDate > $request->ToDate){        
  \Session::flash('message','Start date must be less or equal to end date');
  \Session::flash('alert-class','alert-warning');            
  return redirect('Nationaloverall');
}

if ($request->AreaName==null){        
  \Session::flash('message','Please select AreaName');
  \Session::flash('alert-class','alert-warning');            
  return redirect('Nationaloverall');
}

$tota=$request->FinanceType;


$baseQuery=" Select sum(finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,area.AreaName,
district.DistrictCode,district.DistrictName,
finance.date,finance.created_at  from  area join district  on area.AreaID = district.AreaID 
join assembly on  assembly.DistrictID = district.DistrictID  join finance 
on  assembly.AssemblyCode = finance.AssemblyID join nationals on nationals.NationalID = area.NationalID"; 

$baseQuery1="Select sum(finance.IndValues) as grand  from  area join district  on area.AreaID = district.AreaID 
join assembly on  assembly.DistrictID = district.DistrictID  join finance 
on  assembly.AssemblyCode = finance.AssemblyID join nationals on nationals.NationalID = area.NationalID "; 

$whereArray= array();

if ($request->AreaName!=null)                    
  $whereArray[]="nationals.NationalID={$request->AreaName}";


if ($request->FromDate && $request->ToDate )
  if ($request->FromDate!=null)                    
    $whereArray[]=" finance.Date between '{$request->FromDate}' and '{$request->ToDate}' ";
  

  $whereClause= implode(" and ", $whereArray);


  if ($whereClause!=null){


    $baseQuery=$baseQuery." where ".$whereClause."and finance.Activity_State=1 group by area.AreaName,finance.Indicators";

    $baseQuery2=$baseQuery1." where ".$whereClause. "and finance.Activity_State=1";
    $output = \DB::select($baseQuery);
   //     dd($output);
    $total = \DB::select($baseQuery2);
  }
  else{
    $output=array();

  }   
  $areaname = \App\National::find($request->AreaName)->NationalName;
  $from=$request->FromDate;
  $to=$request->ToDate;
  $indicate = "(". $request->FinanceType .")";
  
  return view('Report.Nationaloverall')->with(compact('output','rows','total','tota','indicators','areaname','from','to'));
}

    // cell detailed activity
public function celldetailedactivity()
{ 
  $DistrictID = auth()->user()->DistrictID;

  if(auth()->user()->UserLevelID==2){
    $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
  } elseif (auth()->user()->UserLevelID==1) {

    $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
    $arr = array();
    foreach ($query as $id) {
      $arr [] = $id->DistrictID;
    }

    $rows = DB::table('assembly')->orderBy('AssemblyName')
    ->whereIn('DistrictID', ($arr))
    ->lists('AssemblyName','AssemblyID');

  }
  elseif (auth()->user()->UserLevelID==3) {

   $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

 }
 elseif (auth()->user()->UserLevelID==4) {
  $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = array(); //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr = array();
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->lists('AssemblyName','AssemblyID');

      }
      $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');

      $output=array();

      return view('Report.celldetailedactivity')->with(compact('rows','output','indicators'));

    }

    public function celldetailedactivitysearch(Request $request){
    // return var_dump($request->all());
     $DistrictID = auth()->user()->DistrictID;
     $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
     ->lists('Indicators','Indicators');

 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
     if(auth()->user()->UserLevelID==2){
      $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
    } elseif (auth()->user()->UserLevelID==1) {

      $query = DB::table('district')->where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
      $arr = array();
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }

      $rows = DB::table('assembly')->orderBy('AssemblyName')
      ->whereIn('DistrictID', ($arr))
      ->lists('AssemblyName','AssemblyID');

    }
    elseif (auth()->user()->UserLevelID==3) {

     $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

   }
   elseif (auth()->user()->UserLevelID==4) {
    $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = array(); //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr = array();
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')
        ->lists('AssemblyName','AssemblyID');

      }


      if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
        \Session::flash('message','Either Start date or End date is missing');
        \Session::flash('alert-class','alert-warning');            
        return redirect('celldetailedactivity');
      }
      if ($request->FromDate > $request->ToDate){        
        \Session::flash('message','Start date must be less or equal to end date');
        \Session::flash('alert-class','alert-warning');            
        return redirect('celldetailedactivity');
      }
      if ($request->FinanceType==null){        
        \Session::flash('message','Please select Report Type');
        \Session::flash('alert-class','alert-warning');            
        return redirect('celldetailedactivity');
      }
      if ($request->AssemblyName==null){        
        \Session::flash('message','Please select AssemblyName');
        \Session::flash('alert-class','alert-warning');            
        return redirect('celldetailedactivity');
      }

      $tota=$request->FinanceType;
      $from=$request->FromDate;
      $to=$request->ToDate;
      $districtname = \App\Models\Assembly::find($request->AssemblyName);
      $districtname = $districtname->AssemblyName;

      $baseQuery="Select assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
      finance.date,finance.created_at  from  assembly   join finance on assembly.AssemblyCode = finance.AssemblyID "; 

 // $baseQuery1="Select sum(finance.IndValues) as total from  assembly   join finance on assembly.AssemblyCode = finance.AssemblyID "; 
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
   //   $baseQuery2=$baseQuery1." where ".$whereClause. "and finance.Activity_State=1";
          $output = \DB::select($baseQuery);
   //   $total = \DB::select($baseQuery2);
        }
        else{
          $output=array();

        }   

      //dd($total);
        return view('Report.celldetailedactivity')->with(compact('indicators','output','rows','total','tota','to','from','districtname'));

      }

      public function cellactivity(){
        $DistrictID = auth()->user()->DistrictID;

     // $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
        if(auth()->user()->UserLevelID==2){
          $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
        } elseif (auth()->user()->UserLevelID==1) {

          $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
          $arr;
          foreach ($query as $id) {
            $arr [] = $id->DistrictID;
          }

          $rows = \App\Models\Assembly::whereIn('DistrictID', ($arr))->orderBy('AssemblyName')
          ->lists('AssemblyName','AssemblyID');

        }
        elseif (auth()->user()->UserLevelID==3) {

         $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

       }
       elseif (auth()->user()->UserLevelID==4) {
        $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')
        ->lists('AssemblyName','AssemblyID');

      }
      $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');

      $output=array();

      return view('Report.cellactivity')->with(compact('rows','output','indicators'));

    }

  // Assembly Report Per Period Searh
    public function cellactivitysearch(Request $request){
      $DistrictID = auth()->user()->DistrictID;
      $indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
      ->lists('Indicators','Indicators');

 //$rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
      if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');  
      } elseif (auth()->user()->UserLevelID==1) {

        $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }

        $rows = \App\Models\Assembly::whereIn('DistrictID', ($arr))->orderBy('AssemblyName')
        ->lists('AssemblyName','AssemblyID');

      }
      elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

     }
     elseif (auth()->user()->UserLevelID==4) {
      $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }

        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr;
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        
        $rows = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')
        ->lists('AssemblyName','AssemblyID');

      }


      if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
        \Session::flash('message','Either Start date or End date is missing');
        \Session::flash('alert-class','alert-warning');            
        return redirect('cellactivity');
      }
      if ($request->FromDate > $request->ToDate){        
        \Session::flash('message','Start date must be less or equal to end date');
        \Session::flash('alert-class','alert-warning');            
        return redirect('cellactivity');
      }

      if ($request->AssemblyName==null){        
        \Session::flash('message','Please select AssemblyName');
        \Session::flash('alert-class','alert-warning');            
        return redirect('cellactivity');
      }

      $tota=$request->FinanceType;


      $baseQuery="Select (finance.IndValues) as total,assembly.AssemblyName,assembly.AssemblyCode,finance.IndValues,finance.Indicators,
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
          $total = \DB::select($baseQuery2);
        }
        else{
          $output=array();

        }   
        $from=$request->FromDate;
        $to=$request->ToDate;
        $districtname = \App\Models\Assembly::find($request->AssemblyName);
        $districtname = $districtname->AssemblyName;

        return view('Report.cellactivity')->with(compact('rows','output','indicators','from','to','districtname'));
      }

      public function cellattendance(){
       if(auth()->user()->UserLevelID==2){
         $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

       } elseif (auth()->user()->UserLevelID==1) {

        $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
      }
      elseif (auth()->user()->UserLevelID==3) {

       $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

     }
     elseif (auth()->user()->UserLevelID==4) {
      $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
    }
    $indicators = [];
    $output = [];
    return view('Report.cellattendance',compact('rows','indicators','output'));
  }

  public function cellattendancesearch(Request $request){
    if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
      \Session::flash('message','Either Start date or End date is missing');
      \Session::flash('alert-class','alert-warning');            
      return redirect('cellattendance');
    }
    

    if ($request->AssemblyName==null){        
      \Session::flash('message','Please select AssemblyName');
      \Session::flash('alert-class','alert-warning');            
      return redirect('cellattendance');
    }
    if(auth()->user()->UserLevelID==2){
      $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
      $assem = \App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',auth()->user()->DistrictID)->get();
      $districtname = District::find($request->AssemblyName)->DistrictName;
    } elseif (auth()->user()->UserLevelID==1) {
      $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
      $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
      $arr = [];
      foreach ($query as $id) {
        $arr [] = $id->DistrictID;
      }

      $assem = \App\Models\Assembly::whereIn('DistrictID', ($arr))->orderBy('AssemblyName')->get();
      $districtname = Area::find($request->AssemblyName)->AreaName;

    }
    elseif (auth()->user()->UserLevelID==3) {

     $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
     $assem = \App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->get(); 
     $districtname = Assembly::find($request->AssemblyName)->AssemblyName;

   }
   elseif (auth()->user()->UserLevelID==4) {
    $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = []; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }
        //dd($Areaarray);
        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr = [];
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        //dd($arr);
        $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
        $assem = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')->get();
        $districtname = National::find($request->AssemblyName)->NationalName;
       // dd($rows);
      }
      $to = $request->ToDate;
      $from = $request->FromDate;

      $indicators = [];
      $ind = ["No of Members","No of Visitors","No of Converts","No of Children","No of New Converts","No of New Members"];
      
      $a = [];
      foreach ($assem as $value) {
        $a [] = $value->AssemblyCode;
      }
     // dd($a);
      Cellattendance::truncate();
      foreach ($a as $data) {
        $tbcell = new Cellattendance;
        $tbcell->assembly = Assembly::where('AssemblyCode',$data)->first()->AssemblyName ?: "Default";
        $tbcell->members = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Members")->sum('IndValues') ?: 0;
        $tbcell->newmembers = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of New Members")->sum('IndValues') ?: 0;
        $tbcell->visitors = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Visitors")->sum('IndValues') ?: 0;
        $tbcell->converts = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Converts")->sum('IndValues') ?: 0;
        $tbcell->newconverts = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of New Converts")->sum('IndValues') ?: 0;
        $tbcell->children = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Children")->sum('IndValues') ?: 0;
        $comments =  Topic::where('AssemblyID',$data)->where('date',$from)->first();
        $tbcell->topic = $comments ? $comments->topic : "";
        $tbcell->comments = $comments ? $comments->comments : "No comments";
        $tbcell->total = $tbcell->children +  $tbcell->converts +  $tbcell->visitors + $tbcell->members + $tbcell->newmembers + $tbcell->newconverts;
        $tbcell->previous = Finance::where('AssemblyID',$data)->where('date',$to)->whereIn('Indicators',$ind)->sum('IndValues') ?: 0;
        $tbcell->variance = $tbcell->total - $tbcell->previous ;
        $tbcell->save();
      }
      $output = Cellattendance::all();

      return view('Report.cellattendance',compact('rows','indicators','output','to','from','districtname'));
    }

    public function cellattendance2(){
     if(auth()->user()->UserLevelID==2){
       $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

     } elseif (auth()->user()->UserLevelID==1) {

      $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
    }
    elseif (auth()->user()->UserLevelID==3) {

     $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

   }
   elseif (auth()->user()->UserLevelID==4) {
    $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  }
  $indicators = [];
  $output = [];
  return view('Report.cellattendance2',compact('rows','indicators','output'));
}


public function cellattendance2search(Request $request){
  if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
    \Session::flash('message','Either Start date or End date is missing');
    \Session::flash('alert-class','alert-warning');            
    return redirect('cellattendance2');
  }


  if ($request->AssemblyName==null){        
    \Session::flash('message','Please select AssemblyName');
    \Session::flash('alert-class','alert-warning');            
    return redirect('cellattendance2');
  }
  if(auth()->user()->UserLevelID==2){
    $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
    $codes = \App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('AssemblyCode');
    $districtname = District::find($request->AssemblyName)->DistrictName ?: "Default";
  } elseif (auth()->user()->UserLevelID==1) {
    $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
    $codes = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       // return $codes;
    $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);
    $arr = [];
    foreach ($query as $id) {
      $arr [] = $id->DistrictID;
    }

    $assem = \App\Models\Assembly::whereIn('DistrictID', ($arr))->orderBy('AssemblyName')->get();
    $districtname = Area::find($request->AssemblyName)->AreaName;

  }
  elseif (auth()->user()->UserLevelID==3) {

   $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
   $assem = \App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->get(); 
   $districtname = Assembly::find($request->AssemblyName)->AssemblyName;
   $codes = \App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyCode');

 }
 elseif (auth()->user()->UserLevelID==4) {
  $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
         $Areaarray = []; //get area ids
         foreach ($query as $id) {
          $Areaarray [] = $id->AreaID;
        }
        //dd($Areaarray);
        $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);

        $arr = [];
        foreach ($query as $id) {
          $arr [] = $id->DistrictID;
        }
        //dd($arr);
        $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
        $assem = DB::table('assembly')
        ->whereIn('DistrictID', ($arr))
        ->orderBy('AssemblyName')->get();
        $districtname = National::find($request->AssemblyName)->NationalName;
        $codes = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
       // dd($rows);
      }
      $to = $request->ToDate;
      $from = $request->FromDate;

      $indicators = [];
      $ind = ["No of Members","No of Visitors","No of Converts","No of Children","No of New Converts","No of New Members"];
      
     // $a = [];
      
     // dd($a);
      Cellattendance::truncate();
      switch (auth()->user()->UserLevelID) {
        case '1':
           // area table fill
        foreach ($codes as $data) {
          $assemblies = Assembly::where('DistrictID',$data)->lists('AssemblyCode');
       // return $data;
       // return $assemblies;
          $tbcell = new Cellattendance;
          $tbcell->assembly = District::where('DistrictID',$data)->first()->DistrictName ?: "Default";
          $tbcell->members = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of Members")->sum('IndValues') ?: 0;
          $tbcell->newmembers = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of New Members")->sum('IndValues') ?: 0;
          $tbcell->visitors = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of Visitors")->sum('IndValues') ?: 0;
          $tbcell->converts = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of Converts")->sum('IndValues') ?: 0;
          $tbcell->newconverts = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of New Converts")->sum('IndValues') ?: 0;
          $comments =  Topic::whereIn('AssemblyID',$assemblies)->where('date',$from)->first();
          $tbcell->topic = $comments ? $comments->topic : "";
          $tbcell->comments = $comments ? $comments->comments : "No comments";

          $tbcell->children = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of Children")->sum('IndValues') ?: 0;
          $tbcell->total = $tbcell->children +  $tbcell->converts +  $tbcell->visitors + $tbcell->members + $tbcell->newmembers + $tbcell->newconverts;
          $tbcell->previous = Finance::whereIn('AssemblyID',$assemblies)->where('date',$to)->whereIn('Indicators',$ind)->sum('IndValues') ?: 0;
          $tbcell->variance = $tbcell->total - $tbcell->previous ;
          $tbcell->save();
        }
        break;
        case '2':
        foreach ($codes as $data) {
          $tbcell = new Cellattendance;
          $tbcell->assembly = Assembly::where('AssemblyCode',$data)->first()->AssemblyName ?: "Default";
          $tbcell->members = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Members")->sum('IndValues') ?: 0;
          $tbcell->newmembers = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of New Members")->sum('IndValues') ?: 0;
          $tbcell->visitors = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Visitors")->sum('IndValues') ?: 0;
          $tbcell->converts = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Converts")->sum('IndValues') ?: 0;
          $tbcell->newconverts = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of New Converts")->sum('IndValues') ?: 0;
          $tbcell->children = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Children")->sum('IndValues') ?: 0;
          $comments =  Topic::where('AssemblyID',$data)->where('date',$from)->first();
          $tbcell->topic = $comments ? $comments->topic : "";
          $tbcell->comments = $comments ? $comments->comments : "No comments";
          $tbcell->total = $tbcell->children +  $tbcell->converts +  $tbcell->visitors + $tbcell->members + $tbcell->newmembers + $tbcell->newconverts;
          $tbcell->previous = Finance::where('AssemblyID',$data)->where('date',$to)->whereIn('Indicators',$ind)->sum('IndValues') ?: 0;
          $tbcell->variance = $tbcell->total - $tbcell->previous ;

          $tbcell->save();
        }
        break;

        case '3':
        foreach ($codes as $data) {
          $tbcell = new Cellattendance;
          $tbcell->assembly = Assembly::where('AssemblyCode',$data)->first()->AssemblyName ?: "Default";
          $tbcell->members = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Members")->sum('IndValues') ?: 0;
          $tbcell->newmembers = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of New Members")->sum('IndValues') ?: 0;
          $tbcell->visitors = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Visitors")->sum('IndValues') ?: 0;
          $tbcell->converts = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Converts")->sum('IndValues') ?: 0;
          $tbcell->newconverts = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of New Converts")->sum('IndValues') ?: 0;
          $tbcell->children = Finance::where('AssemblyID',$data)->where('date',$from)->where('Indicators',"No of Children")->sum('IndValues') ?: 0;
          $comments =  Topic::where('AssemblyID',$data)->where('date',$from)->first();
          $tbcell->topic = $comments ? $comments->topic : "";
          $tbcell->comments = $comments ? $comments->comments : "No comments";
          $tbcell->total = $tbcell->children +  $tbcell->converts +  $tbcell->visitors + $tbcell->members + $tbcell->newmembers + $tbcell->newconverts;
          $tbcell->previous = Finance::where('AssemblyID',$data)->where('date',$to)->whereIn('Indicators',$ind)->sum('IndValues') ?: 0;
          $tbcell->variance = $tbcell->total - $tbcell->previous ;

          $tbcell->save();
        }
        break;
        
        case '4':
             // National table fill
        foreach ($codes as $data) {
          $districts = District::where('AreaID',$data)->lists('DistrictID');
          $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
       // return $data;
       // return $assemblies;
          $tbcell = new Cellattendance;
          $tbcell->assembly = Area::where('AreaID',$data)->first()->AreaName ?: "Default";
          $tbcell->members = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of Members")->sum('IndValues') ?: 0;
          $tbcell->newmembers = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of New Members")->sum('IndValues') ?: 0;
          $tbcell->visitors = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of Visitors")->sum('IndValues') ?: 0;
          $tbcell->converts = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of Converts")->sum('IndValues') ?: 0;
          $tbcell->newconverts = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of New Converts")->sum('IndValues') ?: 0;
          $tbcell->children = Finance::whereIn('AssemblyID',$assemblies)->where('date',$from)->where('Indicators',"No of Children")->sum('IndValues') ?: 0;
          $comments =  Topic::whereIn('AssemblyID',$assemblies)->where('date',$from)->first();
          $tbcell->topic = $comments ? $comments->topic : "";
          $tbcell->comments = $comments ? $comments->comments : "No comments";
          $tbcell->total = $tbcell->children +  $tbcell->converts +  $tbcell->visitors + $tbcell->members + $tbcell->newmembers + $tbcell->newconverts;
          $tbcell->previous = Finance::whereIn('AssemblyID',$assemblies)->where('date',$to)->whereIn('Indicators',$ind)->sum('IndValues') ?: 0;
          $tbcell->variance = $tbcell->total - $tbcell->previous ;
          $tbcell->save();
        }
        break;
        default :
        return redirect('cellattendance2');
        break;
      }

      $output = Cellattendance::all();

      return view('Report.cellattendance2',compact('rows','indicators','output','to','from','districtname'));
    }

    public function tree(){
     if(auth()->user()->UserLevelID==2){
       $rows =\App\Models\District::where('DistrictID',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');  
        // $parents = Assembly::where('DistrictID','=',$DistrictID)->where('ParentID',0)->get();
     } elseif (auth()->user()->UserLevelID==1) {

      $rows = DB::table('district')->where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');

       // $parents = Assembly::where('ParentID',0)->whereIn('DistrictID',$arr)->get();

    }
    elseif (auth()->user()->UserLevelID==3) {

     $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
      // $parents = Assembly::where('AssemblyID','=',auth()->user()->AssemblyID)->where('ParentID',0)->get();
   }
   elseif (auth()->user()->UserLevelID==4) {
    $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
       // dd($query);
    $Areaarray = array(); 
    foreach ($query as $id) {
      $Areaarray [] = $id->AreaID;
    }
       // dd($Areaarray);
    $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);
     //    dd($query);
    $arr = array();
    foreach ($query as $id) {
      $arr [] = $id->DistrictID;
    }

    $rows = DB::table('assembly')->orderBy('AssemblyName')
    ->whereIn('DistrictID', ($arr))
    ->lists('AssemblyName','AssemblyID');

  }
  $parents = [];
  return view('Report.tree',compact('parents','rows'));
}

public function treesearch(Request $request){
  if(auth()->user()->UserLevelID==2){
    $rows =\App\Models\District::where('DistrictID',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');  
    $parents = Assembly::where('DistrictID',$request->AssemblyName)->where('ParentID',0)->get();
  } elseif (auth()->user()->UserLevelID==1) {

    $rows = DB::table('district')->where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');


    $parents = Assembly::where('DistrictID',$request->AssemblyName)->where('ParentID',0)->get();

  }
  elseif (auth()->user()->UserLevelID==3) {

   $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
   $parents = Assembly::where('AssemblyCode','=',auth()->user()->CellID)->where('ParentID',0)->get();
 }
 elseif (auth()->user()->UserLevelID==4) {
  $query = DB::table('area')->where('NationalID',auth()->user()->NationalID)->get(['AreaID']);
       // dd($query);
  $Areaarray = array(); 
  foreach ($query as $id) {
    $Areaarray [] = $id->AreaID;
  }
       // dd($Areaarray);
  $query = DB::table('district')->whereIn('AreaID',$Areaarray)->get(['DistrictID']);
     //    dd($query);
  $arr = array();
  foreach ($query as $id) {
    $arr [] = $id->DistrictID;
  }

  $rows = DB::table('assembly')->orderBy('AssemblyName')
  ->whereIn('DistrictID', ($arr))
  ->lists('AssemblyName','AssemblyID');

}

return view('Report.tree',compact('parents','rows'));
}

public function cellattendancetotal(){
 $DistrictID = auth()->user()->DistrictID;

    //  $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
 if(auth()->user()->UserLevelID==2){
  $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');  
  $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
  $assemblyname = Assembly::where('DistrictID',$DistrictID)->lists('AssemblyName','AssemblyCode');
  $indicators = $assemblyname;
} elseif (auth()->user()->UserLevelID==1) {

 $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
 $DistrictID = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');

 $assemblies = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyCode');

 $indicators = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');
}
elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
 $indicators = [];
}
elseif (auth()->user()->UserLevelID==4) {
 $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
 $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
 $DistrictID = District::whereIn('AreaID',$area)->lists('DistrictID');

 $assemblies = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyCode');
 
 $indicators =  Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
}

$state = 0;
$output=array();
return view('Report.cellattendancetotal',compact('state','output','rows','indicators'));
}

public function cellattendancetotalsearch(Request $request){
 $DistrictID = auth()->user()->DistrictID;
 $ind = ["No of Members","No of New Members","No of Visitors","No of Converts","No of New Converts","No of Children"];
 $from = $request->FromDate;
 $to = $request->ToDate;
    //  $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
 if(auth()->user()->UserLevelID==2){
  $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');  

  $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
  $assemblyname = Assembly::where('DistrictID',$DistrictID)->lists('AssemblyName','AssemblyCode');
  $indicators = $assemblyname;
  $output = Finance::whereIn('finance.AssemblyID',$assemblies)->whereIn("Indicators",$ind)->whereBetween("date",[$from,$to])->groupby('date','AssemblyCode')
  ->join("assembly","assembly.AssemblyCode","=","finance.AssemblyID")
  ->select("finance.*","assembly.AssemblyName",DB::raw("sum(Finance.IndValues) as total"))
  ->orderBy('AssemblyName');
  
  if ($request->FinanceType==null) {
    $output = $output->get();
    $state = 0;
  }else{
   $output = $output->where('AssemblyCode',$request->FinanceType)->get();
   $state = 1;
 }
      // dd($output); 
 $districtname = District::find($request->AssemblyName)->DistrictName;
} elseif (auth()->user()->UserLevelID==1) {


  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
  $DistrictID = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');

  $assemblies = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyCode');
  
  $indicators = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictName','DistrictID');

  $output = Finance::whereIn('finance.AssemblyID',$assemblies)->whereIn("Indicators",$ind)->whereBetween("date",[$from,$to])->groupby('date','assembly.DistrictID')
  ->join("assembly","assembly.AssemblyCode","=","finance.AssemblyID")
  ->join("district","district.DistrictID","=","assembly.DistrictID")
  ->select("finance.*","assembly.AssemblyName",DB::raw("sum(Finance.IndValues) as total"),'district.DistrictName','district.DistrictCode')
       //->sum('IndValues');
  ->orderBy('date');
  if ($request->FinanceType==null) {
    $output = $output->get();
    $state = 0;
  }else{
   $output = $output->where('district.DistrictID',$request->FinanceType)->get();
   $state = 1;
 }
      // dd($output); 
 $districtname = Area::find($request->AssemblyName)->AreaName;

}
elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID'); 
 $output = Finance::where('finance.AssemblyID',auth()->user()->CellID)->whereIn("Indicators",$ind)->whereBetween("date",[$from,$to])->groupby('date')
 ->join("assembly","assembly.AssemblyCode","=","finance.AssemblyID")
 ->select("finance.*","assembly.AssemblyName",DB::raw("sum(Finance.IndValues) as total"))
       //->sum('IndValues');
 ->orderBy('AssemblyName')
 ->get();
 $state = 1;
 $districtname = Assembly::find($request->AssemblyName)->AssemblyName;
 $indicators = [];
}
elseif (auth()->user()->UserLevelID==4) {
 $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
 $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
 $DistrictID = District::whereIn('AreaID',$area)->lists('DistrictID');

 $assemblies = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyCode');

 $indicators = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');

 $output = Finance::whereIn('finance.AssemblyID',$assemblies)->whereIn("Indicators",$ind)->whereBetween("date",[$from,$to])->groupby('date','area.AreaID')
 ->join("assembly","assembly.AssemblyCode","=","finance.AssemblyID")
 ->join("district","district.DistrictID","=","assembly.DistrictID")
 ->join("area","area.AreaID","=","district.AreaID")
 ->select("finance.*","assembly.AssemblyName",DB::raw("sum(Finance.IndValues) as total"),'district.DistrictName','area.AreaName','area.AreaCode')
       //->sum('IndValues');
 ->orderBy('date');
 if ($request->FinanceType==null) {
  $output = $output->get();
  $state = 0;
}else{
 $output = $output->where('area.AreaID',$request->FinanceType)->get();
 $state = 1;
}
      // dd($output); 
$districtname = National::find($request->AssemblyName)->NationalName;

}




return view('Report.cellattendancetotal',compact('state','output','rows','indicators','districtname','to','from'));
}

public function cellattendancetotalpercell(){
 $DistrictID = auth()->user()->DistrictID;

    //  $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
 if(auth()->user()->UserLevelID==2){
  $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');  
  $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
  $assemblyname = Assembly::where('DistrictID',$DistrictID)->lists('AssemblyName','AssemblyCode');
  $indicators = $assemblyname;
} elseif (auth()->user()->UserLevelID==1) {

 $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
 $DistrictID = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');

 $assemblies = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyCode');
 $assemblyname = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyName','AssemblyCode');
 $indicators = $assemblyname;
}
elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
 $indicators = [];

}
elseif (auth()->user()->UserLevelID==4) {
 $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
 $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
 $DistrictID = District::whereIn('AreaID',$area)->lists('DistrictID');

 $assemblies = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyCode');
 $assemblyname = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyName','AssemblyCode');
 $indicators = $assemblyname;
}
$state = 0;
$output=array();
return view('Report.cellattendancetotalpercell',compact('output','rows','indicators','state'));
}

public function cellattendancetotalpercellsearch(Request $request){
  if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
    \Session::flash('message','Either Start date or End date is missing');
    \Session::flash('alert-class','alert-warning');            
    return redirect('cellattendancetotalpercell');
  }
  if ($request->FromDate > $request->ToDate){        
    \Session::flash('message','Start date must be less or equal to end date');
    \Session::flash('alert-class','alert-warning');            
    return redirect('cellattendancetotalpercell');
  }
      /*if ($request->FinanceType==null){        
        \Session::flash('message','Please select Cell');
        \Session::flash('alert-class','alert-warning');            
        return redirect('cellattendancetotalpercell');
      }*/
      if ($request->AssemblyName==null){        
        \Session::flash('message','Please select Cell Name');
        \Session::flash('alert-class','alert-warning');            
        return redirect('cellattendancetotalpercell');
      }
      $DistrictID = auth()->user()->DistrictID;
      $ind = ["No of Members","No of New Members","No of Visitors","No of Converts","No of New Converts","No of Children"];
      $from = $request->FromDate;
      $to = $request->ToDate;
    //  $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',$DistrictID)->lists('AssemblyName','AssemblyID');
      if(auth()->user()->UserLevelID==2){
        $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',$DistrictID)->lists('DistrictName','DistrictID');  

        $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
        $assemblyname = Assembly::where('DistrictID',$DistrictID)->lists('AssemblyName','AssemblyCode');
        $indicators = $assemblyname;
        $output = Finance::whereIn('finance.AssemblyID',$assemblies)->whereIn("Indicators",$ind)->whereBetween("date",[$from,$to])->groupby('date','AssemblyCode')
        ->join("assembly","assembly.AssemblyCode","=","finance.AssemblyID")
        ->select("finance.*","assembly.AssemblyName",DB::raw("sum(Finance.IndValues) as total"))
        ->orderBy('AssemblyName');

        if ($request->FinanceType==null) {
          $output = $output->get();
          $state = 0;
        }else{
         $output = $output->where('AssemblyCode',$request->FinanceType)->get();
         $state = 1;
       }

      // dd($output); 
       $districtname = District::find($request->AssemblyName)->DistrictName;
     } elseif (auth()->user()->UserLevelID==1) {


      $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
      $DistrictID = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');

      $assemblies = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyCode');
      $assemblyname = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyName','AssemblyCode');
      $indicators = $assemblyname;
      $output = Finance::whereIn('finance.AssemblyID',$assemblies)->whereIn("Indicators",$ind)->whereBetween("date",[$from,$to])->groupby('date','assembly.AssemblyCode')
      ->join("assembly","assembly.AssemblyCode","=","finance.AssemblyID")
      ->join("district","district.DistrictID","=","assembly.DistrictID")
      ->select("finance.*","assembly.AssemblyName",DB::raw("sum(Finance.IndValues) as total"),'district.DistrictName')
       //->sum('IndValues');
      ->orderBy('date');
      if ($request->FinanceType==null) {
        $output = $output->get();
        $state = 0;
      }else{
       $output = $output->where('AssemblyCode',$request->FinanceType)->get();
       $state = 1;
     }
      // dd($output); 
     $districtname = Area::find($request->AssemblyName)->AreaName;

   }
   elseif (auth()->user()->UserLevelID==3) {

     $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID'); 
     $output = Finance::where('finance.AssemblyID',auth()->user()->CellID)->whereIn("Indicators",$ind)->whereBetween("date",[$from,$to])->groupby('date')
     ->join("assembly","assembly.AssemblyCode","=","finance.AssemblyID")
     ->select("finance.*","assembly.AssemblyName",DB::raw("sum(Finance.IndValues) as total"))
       //->sum('IndValues');
     ->orderBy('date');
     if ($request->FinanceType==null) {
      $output = $output->get();
      $state = 1;
    }else{
     $output = $output->where('AssemblyCode',$request->FinanceType)->get();
     $state = 1;
   }
      // dd($output); 
   $districtname = Assembly::find($request->AssemblyName)->AssemblyName;
   $indicators = [];
 }
 elseif (auth()->user()->UserLevelID==4) {
   $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
   $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
   $DistrictID = District::whereIn('AreaID',$area)->lists('DistrictID');

   $assemblies = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyCode');
   $assemblyname = Assembly::whereIn('DistrictID',$DistrictID)->lists('AssemblyName','AssemblyCode');
   $indicators = $assemblyname;
  //dd($assemblies);
   $output = Finance::whereIn('finance.AssemblyID',$assemblies)->whereIn("Indicators",$ind)->whereBetween("date",[$from,$to])->groupby('date','assembly.AssemblyCode')
   ->join("assembly","assembly.AssemblyCode","=","finance.AssemblyID")
 //->join("district","district.DistrictID","=","assembly.AssemblyCode")
 //->join("area","area.AreaID","=","district.AreaID")
   ->select("finance.*","assembly.AssemblyName",DB::raw("sum(Finance.IndValues) as total"))
       //->sum('IndValues');
   ->orderBy('date');
   if ($request->FinanceType==null) {
    $output = $output->get();
    $state = 0;
  }else{
   $output = $output->where('AssemblyCode',$request->FinanceType)->get();
   $state = 1;
 }
    //   dd($output); 
 $districtname = National::find($request->AssemblyName)->NationalName;

}


return view('Report.cellattendancetotalpercell',compact('output','rows','indicators','districtname','to','from','state'));
}


public function mycells(){
  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

 } elseif (auth()->user()->UserLevelID==1) {

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
}
elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
}
$indicators = [];
$output = [];
return view('Report.mycells',compact('rows','output','indicators'));
}

public function mycellssearch(Request $request){
 if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
  \Session::flash('message','Either Start date or End date is missing');
  \Session::flash('alert-class','alert-warning');            
  return redirect('mycells');
}


if ($request->AssemblyName==null){        
  \Session::flash('message','Please select AssemblyName');
  \Session::flash('alert-class','alert-warning');            
  return redirect('mycells');
}
if(auth()->user()->UserLevelID==2){
  $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
  $codes = \App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('AssemblyCode');
  $districtname = District::find($request->AssemblyName)->DistrictID ?: "Default";

  $output = Position::where('Zone_Name',$districtname)->groupby('title')
  ->leftjoin('assembly','assembly.AssemblyName','=','positions.CellCode')
  ->select(DB::raw('count(*) as counter'),'positions.*','assembly.AssemblyName')
  ->get();
  $districtname = District::find($request->AssemblyName)->DistrictName ?: "Default";
     //  dd($output);
} elseif (auth()->user()->UserLevelID==1) {
  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
  $codes = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       // return $codes;
  $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);

  $districtname = Area::find($request->AssemblyName)->AreaID;
  $output = Position::where('Area_Name',$districtname)->groupby('title')
  ->leftjoin('assembly','assembly.AssemblyName','=','positions.CellCode')
  ->select(DB::raw('count(*) as counter'),'positions.*','assembly.AssemblyName')
  ->get();
  $districtname = Area::find($request->AssemblyName)->AreaName;
}
elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
      //  $assem = \App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->get(); 
 $districtname = Assembly::find($request->AssemblyName)->AssemblyCode;
 $userassembly = Assembly::where('AssemblyCode',auth()->user()->CellID)->first()->AssemblyName;
 $output = Position::where('CellCode',$userassembly)->groupby('title')
 ->leftjoin('assembly','assembly.AssemblyName','=','positions.CellCode')
 ->select(DB::raw('count(*) as counter'),'positions.*','assembly.AssemblyName')
 ->get();
      // dd($output);
 $districtname = Assembly::find($request->AssemblyName)->AssemblyName;
}
elseif (auth()->user()->UserLevelID==4) {

  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');

  $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $codes = District::whereIn('AreaID',$areas)->lists('DistrictID');
       // return $codes;
  $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);

  $districtname = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $output = Position::whereIn('Area_Name',$districtname)->groupby('title')
  ->leftjoin('assembly','assembly.AssemblyName','=','positions.CellCode')
  ->select(DB::raw('count(*) as counter'),'positions.*','assembly.AssemblyName')
  ->get();
  $districtname = National::find($request->AssemblyName)->NationalName;
}
$indicators = [];
return view('Report.mycells',compact('rows','indicators','output','to','from','districtname')); 
}

public function listleaders(){
  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

 } elseif (auth()->user()->UserLevelID==1) {

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
}
elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyCode');  

}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
}
$indicators = [];
$output = [];
return view('Report.listleaders',compact('rows','output','indicators'));
}

public function listleaderssearch(Request $request){
 if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
  \Session::flash('message','Either Start date or End date is missing');
  \Session::flash('alert-class','alert-warning');            
  return redirect('mycells');
}


if ($request->AssemblyName==null){        
  \Session::flash('message','Please select AssemblyName');
  \Session::flash('alert-class','alert-warning');            
  return redirect('mycells');
}
if(auth()->user()->UserLevelID==2){
  $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
  $codes = \App\Models\Assembly::orderBy('AssemblyName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('AssemblyCode');
  $districtname = District::find($request->AssemblyName)->DistrictID ?: "Default";

  $output = Position::where('Zone_Name',$districtname)
  ->leftjoin('leaders','leaders.id','=','positions.leader_id')
  ->leftjoin('area','area.AreaID','=','positions.Area_Name')
  ->leftjoin('district','district.DistrictID','=','positions.Zone_Name')
  ->leftjoin('assembly','assembly.AssemblyCode','=','positions.CellCode')
  ->select('positions.*','leaders.name','leaders.contact','area.AreaName','district.DistrictName','assembly.AssemblyName')
  ->orderBy('CellCode')
  ->get();

  $districtname = District::find($request->AssemblyName)->DistrictName ?: "Default";

} elseif (auth()->user()->UserLevelID==1) {
  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
  $codes = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       // return $codes;
  $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);

  $districtname = Area::find($request->AssemblyName)->AreaID;
  $output = Position::where('Area_Name',$districtname)
  ->leftjoin('leaders','leaders.id','=','positions.leader_id')
  ->leftjoin('area','area.AreaID','=','positions.Area_Name')
  ->leftjoin('district','district.DistrictID','=','positions.Zone_Name')
  ->leftjoin('assembly','assembly.AssemblyCode','=','positions.CellCode')
  ->select('positions.*','leaders.name','leaders.contact','area.AreaName','district.DistrictName','assembly.AssemblyName')
  ->orderBy('CellCode')
  ->get();
  $districtname = Area::find($request->AssemblyName)->AreaName;
}
elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
      //  $assem = \App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->get(); 
 $districtname = Assembly::find($request->AssemblyName)->AssemblyName;
 $userassembly = Assembly::where('AssemblyCode',auth()->user()->CellID)->first()->AssemblyCode;
 $output = Position::where('CellCode',$userassembly)
 ->leftjoin('leaders','leaders.id','=','positions.leader_id')
 ->leftjoin('area','area.AreaID','=','positions.Area_Name')
 ->leftjoin('district','district.DistrictID','=','positions.Zone_Name')
 ->leftjoin('assembly','assembly.AssemblyCode','=','positions.CellCode')
 ->select('positions.*','leaders.name','leaders.contact','area.AreaName','district.DistrictName','assembly.AssemblyName')
 ->orderBy('CellCode')
 ->get();
 $districtname = Assembly::find($request->AssemblyName)->AssemblyName;
}
elseif (auth()->user()->UserLevelID==4) {
 $rows = National::find(auth()->user()->NationalID)->lists('NationalName','NationalID');
 $codes = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
       // return $codes;
 $query = \App\Models\District::where('AreaID',auth()->user()->AreaID)->get(['DistrictID']);

 $districtname = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
 $output = Position::whereIn('Area_Name',$districtname)
 ->leftjoin('leaders','leaders.id','=','positions.leader_id')
 ->leftjoin('area','area.AreaID','=','positions.Area_Name')
 ->leftjoin('district','district.DistrictID','=','positions.Zone_Name')
 ->leftjoin('assembly','assembly.AssemblyCode','=','positions.CellCode')
 ->select('positions.*','leaders.name','leaders.contact','area.AreaName','district.DistrictName','assembly.AssemblyName')
 ->orderBy('CellCode')
 ->get();
 $districtname = National::find($request->AssemblyName)->NationalName;
}
$to = $request->ToDate;
$from = $request->FromDate;
$indicators = [];
     // $output = [];


return view('Report.listleaders',compact('rows','indicators','output','to','from','districtname')); 
}

public function carrierhistory(){
  if(auth()->user()->UserLevelID==2){
         $rows = [];// Leader::lists('name','id');

       } elseif (auth()->user()->UserLevelID==1) {

        $rows =   Leader::where('AreaID',auth()->user()->AreaID)->lists('name','id');
      }
      elseif (auth()->user()->UserLevelID==3) {

       $rows = [];//  Leader::lists('name','id');  

     }
     elseif (auth()->user()->UserLevelID==4) {
      $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
      $rows =   Leader::whereIn('AreaID',$areas)->lists('name','id');
    }
    $indicators = [];
    $output = [];
    return view('Report.carrierhistory',compact('rows','output','indicators'));
  }

  public function carrierhistorysearch(Request $request){
   if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
    \Session::flash('message','Either Start date or End date is missing');
    \Session::flash('alert-class','alert-warning');            
    return redirect('carrierhistory');
  }


  if ($request->AssemblyName==null){        
    \Session::flash('message','Please select AssemblyName');
    \Session::flash('alert-class','alert-warning');            
    return redirect('carrierhistory');
  }

  if(auth()->user()->UserLevelID==2){
         $rows = [];// Leader::lists('name','id');

       } elseif (auth()->user()->UserLevelID==1) {

        $rows =   Leader::where('AreaID',auth()->user()->AreaID)->lists('name','id');
      }
      elseif (auth()->user()->UserLevelID==3) {

       $rows = [];//  Leader::lists('name','id');  

     }
     elseif (auth()->user()->UserLevelID==4) {
      $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
      $rows =   Leader::whereIn('AreaID',$areas)->lists('name','id');
    }

     // $rows =  Leader::lists('name','id');  
    $to = $request->ToDate;
    $from = $request->FromDate;
    $indicators = [];

    // dd($request->all());
    $output = Positionlog::where('leader_id',$request->AssemblyName)->orderby('created_at','desc')->get();
    //dd($output);
    return view('Report.carrierhistory',compact('rows','indicators','output','to','from','districtname')); 
  }


  public function directory(){
    if(auth()->user()->UserLevelID==2){

      $assemblies = Area::where('AreaID',auth()->user()->AreaID)->first()->AreaName;

      $mydistrict = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
      $rows =Assembly::whereIn('DistrictID',$mydistrict)->lists('Locality','Locality');
      $output = Assembly::whereIn('DistrictID',$mydistrict)
      ->join('positions','positions.CellCode','=','AssemblyCode')
      ->leftjoin('leaders','positions.leader_id',"=","leaders.id")
      ->where("positions.title","Cell Leader")
      ->orderBy('Locality')
      ->get();
        //dd($output);
      $areaname = Area::find(auth()->user()->AreaID)->AreaName;
      $leaders = Position::where('CellCode',"")->where("Zone_Name","")->where("Area_Name",$areaname)->join('leaders',"leaders.id","=","positions.leader_id")->get();


    } elseif (auth()->user()->UserLevelID==1) {

      $assemblies = Area::where('AreaID',auth()->user()->AreaID)->first()->AreaName;

      $mydistrict = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
      $rows =Assembly::whereIn('DistrictID',$mydistrict)->lists('Locality','Locality');
      $output = Assembly::whereIn('DistrictID',$mydistrict)
      ->join('positions','positions.CellCode','=','AssemblyCode')
      ->leftjoin('leaders','positions.leader_id',"=","leaders.id")
      ->where("positions.title","Cell Leader")
      ->orderBy('Locality')
      ->get();
        //dd($output);
      $areaname = Area::find(auth()->user()->AreaID)->AreaName;
      $leaders = Position::where('CellCode',"")->where("Zone_Name","")->where("Area_Name",$areaname)->join('leaders',"leaders.id","=","positions.leader_id")->get();

    }
    elseif (auth()->user()->UserLevelID==3) {

      $assemblies = Area::where('AreaID',auth()->user()->AreaID)->first()->AreaName;

      $mydistrict = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
      $rows =Assembly::whereIn('DistrictID',$mydistrict)->lists('Locality','Locality');
      $output = Assembly::whereIn('DistrictID',$mydistrict)
      ->join('positions','positions.CellCode','=','AssemblyCode')
      ->leftjoin('leaders','positions.leader_id',"=","leaders.id")
      ->where("positions.title","Cell Leader")
      ->orderBy('Locality')
      ->get();
        //dd($output);
      $areaname = Area::find(auth()->user()->AreaID)->AreaName;
      $leaders = Position::where('CellCode',"")->where("Zone_Name","")->where("Area_Name",$areaname)->join('leaders',"leaders.id","=","positions.leader_id")->get();


    }
    elseif (auth()->user()->UserLevelID==4) {

      $assemblies = National::where('NationalID',auth()->user()->NationalID)->first()->MationalName;
      $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
      $mydistrict = District::whereIn('AreaID',$areas)->lists('DistrictID');
      $rows =Assembly::whereIn('DistrictID',$mydistrict)->lists('Locality','Locality');
      $output = Assembly::whereIn('DistrictID',$mydistrict)
      ->join('positions','positions.CellCode','=','AssemblyCode')
      ->leftjoin('leaders','positions.leader_id',"=","leaders.id")
      ->where("positions.title","Cell Leader")
      ->orderBy('Locality')
      ->get();
        //dd($output);
      $areaname = Area::find(auth()->user()->AreaID)->AreaName;
      $leaders = Position::where('CellCode',"")->where("Zone_Name","")->where("Area_Name",$areaname)->join('leaders',"leaders.id","=","positions.leader_id")->get();

    }
    $indicators = [];
     // $output = [];
    $counter = 1;
    return view('Report.directory',compact('rows','output','indicators','counter','leaders'));
  }

  public function directorysearch(Request $request){
      //dd($request->all());
    if(auth()->user()->UserLevelID==2){

      $assemblies = Area::where('AreaID',auth()->user()->AreaID)->first()->AreaName;

      $mydistrict = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
      $rows =Assembly::whereIn('DistrictID',$mydistrict)->lists('Locality','Locality');
      $output = Assembly::whereIn('DistrictID',$mydistrict)
      ->join('positions','positions.CellCode','=','AssemblyCode')
      ->leftjoin('leaders','positions.leader_id',"=","leaders.id")
      ->where("positions.title","Cell Leader")
      ->where('Locality',$request->AssemblyName)
      ->orderBy('Locality')
      ->get();
        //dd($output);
      $areaname = Area::find(auth()->user()->AreaID)->AreaName;
      $leaders = Position::where('CellCode',"")->where("Zone_Name","")->where("Area_Name",$areaname)->join('leaders',"leaders.id","=","positions.leader_id")->get();


    } elseif (auth()->user()->UserLevelID==1) {

      $assemblies = Area::where('AreaID',auth()->user()->AreaID)->first()->AreaName;

      $mydistrict = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
      $rows =Assembly::whereIn('DistrictID',$mydistrict)->lists('Locality','Locality');
      $output = Assembly::whereIn('DistrictID',$mydistrict)
      ->join('positions','positions.CellCode','=','AssemblyCode')
      ->leftjoin('leaders','positions.leader_id',"=","leaders.id")
      ->where("positions.title","Cell Leader")
      ->where('Locality',$request->AssemblyName)
      ->orderBy('Locality')
      ->get();
        //dd($output);
      $areaname = Area::find(auth()->user()->AreaID)->AreaName;
      $leaders = Position::where('CellCode',"")->where("Zone_Name","")->where("Area_Name",$areaname)->join('leaders',"leaders.id","=","positions.leader_id")->get();

    }
    elseif (auth()->user()->UserLevelID==3) {

      $assemblies = Area::where('AreaID',auth()->user()->AreaID)->first()->AreaName;

      $mydistrict = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
      $rows =Assembly::whereIn('DistrictID',$mydistrict)->lists('Locality','Locality');
      $output = Assembly::whereIn('DistrictID',$mydistrict)
      ->join('positions','positions.CellCode','=','AssemblyCode')
      ->leftjoin('leaders','positions.leader_id',"=","leaders.id")
      ->where("positions.title","Cell Leader")
      ->where('Locality',$request->AssemblyName)
      ->orderBy('Locality')
      ->get();
        //dd($output);
      $areaname = Area::find(auth()->user()->AreaID)->AreaName;
      $leaders = Position::where('CellCode',"")->where("Zone_Name","")->where("Area_Name",$areaname)->join('leaders',"leaders.id","=","positions.leader_id")->get();


    }
    elseif (auth()->user()->UserLevelID==4) {

      $assemblies = National::where('NationalID',auth()->user()->NationalID)->first()->MationalName;
      $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
      $mydistrict = District::whereIn('AreaID',$areas)->lists('DistrictID');
      $rows =Assembly::whereIn('DistrictID',$mydistrict)->lists('Locality','Locality');
      $output = Assembly::whereIn('DistrictID',$mydistrict)
      ->join('positions','positions.CellCode','=','AssemblyCode')
      ->leftjoin('leaders','positions.leader_id',"=","leaders.id")
      ->where("positions.title","Cell Leader")
      ->where('Locality',$request->AssemblyName)
      ->orderBy('Locality')
      ->get();
        //dd($output);
      $areaname = Area::find(auth()->user()->AreaID)->AreaName;
      $leaders = Position::where('CellCode',"")->where("Zone_Name","")->where("Area_Name",$areaname)->join('leaders',"leaders.id","=","positions.leader_id")->get();

    }
    $indicators = [];
     // $output = [];
    $counter = 1;
    return view('Report.directory',compact('rows','output','indicators','counter','leaders'));
  }


  public function topicdiscussed(){
   if(auth()->user()->UserLevelID==2){
     $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
     
   } elseif (auth()->user()->UserLevelID==1) {

    $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
  }
  elseif (auth()->user()->UserLevelID==3) {

   $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

 }
 elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
}
$indicators = [];
$output = [];
return view('Report.topicdiscussed',compact('indicators','rows','output'));
}

public function topicdiscussedsearch(Request $request){
 if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
   $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
   $output = Assembly::whereIn('AssemblyCode',$assemblies)
   ->leftjoin('topics','Assembly.AssemblyCode','=','topics.AssemblyID')
   ->where("topics.date",$request->FromDate)
   ->leftjoin('positions','Assembly.AssemblyCode','=','positions.CellCode')
   ->leftjoin('leaders','leaders.id','=','positions.leader_id')
   ->get();
 } elseif (auth()->user()->UserLevelID==1) {

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');

  $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
       //dd($assemblies);
  $output = Assembly::whereIn('AssemblyCode',$assemblies)
  ->leftjoin('topics','Assembly.AssemblyCode','=','topics.AssemblyID')
  ->where("topics.date",$request->FromDate)
  ->leftjoin('positions','Assembly.AssemblyCode','=','positions.CellCode')
  ->leftjoin('leaders','leaders.id','=','positions.leader_id')
  ->select('assembly.AssemblyName','leaders.name','leaders.contact','topics.topic','topics.comments')
  ->get();
 // dd($output);
}
elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
 $output = Assembly::where('AssemblyCode',auth()->user()->CellID)
 ->leftjoin('topics','Assembly.AssemblyCode','=','topics.AssemblyID')
 ->where("topics.date",$request->FromDate)
 ->leftjoin('positions','Assembly.AssemblyCode','=','positions.CellCode')
 ->leftjoin('leaders','leaders.id','=','positions.leader_id')
 ->get();
       //var_dump($request->FromDate);
       //dd($output);

}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
       //dd($assemblies);
  $output = Assembly::whereIn('AssemblyCode',$assemblies)
  ->leftjoin('topics','Assembly.AssemblyCode','=','topics.AssemblyID')
  ->where("topics.date",$request->FromDate)
  ->leftjoin('positions','Assembly.AssemblyCode','=','positions.CellCode')
  ->leftjoin('leaders','leaders.id','=','positions.leader_id')
  ->get();
}
$indicators = [];

return view('Report.topicdiscussed',compact('indicators','rows','output'));
}

public function meetingattended(){
      switch (auth()->user()->UserLevelID) {
        case '1':
         $rows = Meeting::where('AreaID',auth()->user()->AreaID)->lists('Meeting_Name','id');
          break;
        case '4':
         $rows = Meeting::where('NationalID',auth()->user()->NationalID)->lists('Meeting_Name','id');
          break;
          default:
          $rows = [];
          break;
      }
  
  $indicators = [];
  $output = [];
  $attended = [];
  $unattended = [];
  $toattend = [];
  return view('Report.meetingattended',compact('meeting','rows','indicators','output','attended','toattend','unattended'));
}

public function meetingattendedsearch(Request $request){
     // $meeting = Meeting::lists('Meeting_Name','id');
   switch (auth()->user()->UserLevelID) {
        case '1':
         $rows = Meeting::where('AreaID',auth()->user()->AreaID)->lists('Meeting_Name','id');
          break;
        case '4':
         $rows = Meeting::where('NationalID',auth()->user()->NationalID)->lists('Meeting_Name','id');
          break;
          default:
          $rows = [];
          break;
      }
  $indicators = [];
  $toattend = Markattendance::where('Meeting_id',$request->Meeting_Name)->lists('Leader_id');
  $attended = Markattendance::where('Meeting_id',$request->Meeting_Name)->where('Attended',1)->leftjoin('leaders','leaders.id','=','markattendances.Leader_id')->leftjoin('area','area.AreaID',"=","leaders.AreaID")->orderBy('area.AreaName','asc')->
  select('leaders.*','area.AreaName')->get();
    //  dd($attended);
  $unattended = Markattendance::where('Meeting_id',$request->Meeting_Name)->where('Attended',0)->leftjoin('leaders','leaders.id','=','markattendances.Leader_id')->leftjoin('area','area.AreaID',"=","leaders.AreaID")->orderBy('area.AreaName','asc')->
  select('leaders.*','area.AreaName')->get();

      //dd($attended);
  return view('Report.meetingattended',compact('meeting','rows','indicators','output','attended','toattend','unattended'));
}

public function meetingsummary(){
      //$meeting = Meeting::all();
  switch (auth()->user()->UserLevelID) {
        case '1':
         $rows = Meeting::where('AreaID',auth()->user()->AreaID)->lists('Meeting_Name','id');
          break;
        case '4':
         $rows = Meeting::where('NationalID',auth()->user()->NationalID)->lists('Meeting_Name','id');
          break;
          default:
          $rows = [];
          break;
      }
  $indicators = [];
  $output = [];
  $attended = "";
  $unattended = "";
  $toattend = "";
  return view('Report.meetingsummary',compact('meeting','rows','indicators','output','attended','toattend','unattended'));
}

public function meetingsummarysearch(Request $request){
     // $meeting = Meeting::all();
  switch (auth()->user()->UserLevelID) {
        case '1':
         $rows = Meeting::where('AreaID',auth()->user()->AreaID)->lists('Meeting_Name','id');
          break;
        case '4':
         $rows = Meeting::where('NationalID',auth()->user()->NationalID)->lists('Meeting_Name','id');
          break;
          default:
          $rows = [];
          break;
      }
  $meetingname = Meeting::find($request->Meeting_Name)->Meeting_Name ;
  $indicators = [];

  $toattend = Markattendance::where('Meeting_id',$request->Meeting_Name)->lists('Leader_id');
  $attended = Markattendance::where('Meeting_id',$request->Meeting_Name)->where('Attended',1)->leftjoin('leaders','leaders.id','=','markattendances.Leader_id')->get();
    //  dd($attended);
  $unattended = Markattendance::where('Meeting_id',$request->Meeting_Name)->where('Attended',0)->leftjoin('leaders','leaders.id','=','markattendances.Leader_id')->get();

  $toattend = Markattendance::where('Meeting_id',$request->Meeting_Name)->count();
  $attended = Markattendance::where('Meeting_id',$request->Meeting_Name)->where('Attended',1)->leftjoin('leaders','leaders.id','=','markattendances.Leader_id')->count();
  $unattended = Markattendance::where('Meeting_id',$request->Meeting_Name)->where('Attended',0)->leftjoin('leaders','leaders.id','=','markattendances.Leader_id')->count();
  $from = $request->FromDate; 
  return view('Report.meetingsummary',compact('meeting','rows','indicators','output','attended','toattend','unattended','meetingname','from'));
}

public function meetingpattern(){
  switch (auth()->user()->UserLevelID) {
        case '1':
        $rows = Leader::where('AreaID',auth()->user()->AreaID)->lists('name','id');
          break;
        case '4':
        $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
          $rows = Leader::whereIn('AreaID',$areas)->lists('name','id');
          break;
          default:
          $rows = [];
          break;
      }
  $indicators = [];
  $output = [];

  return view('Report.meetingpattern',compact('meeting','rows','indicators','output'));
}

public function meetingpatternsearch(Request $request){

   switch (auth()->user()->UserLevelID) {
        case '1':
        $rows = Leader::where('AreaID',auth()->user()->AreaID)->lists('name','id');
          break;
        case '4':
        $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
          $rows = Leader::whereIn('AreaID',$areas)->lists('name','id');
          break;
          default:
          $rows = [];
          break;
      }
  $indicators = [];
  $from = $request->FromDate;
  $to = $request->ToDate;
     // dd($request->all());
  $output = Markattendance::where('Leader_id',$request->Leader_id)
  ->leftjoin('meetings','meetings.id','=','markattendances.Meeting_id')
  ->leftjoin('leaders','leaders.id','=','markattendances.Leader_id')
  ->whereBetween('date',[$from,$to])
  ->get();

  $districtname = Leader::find($request->Leader_id)->name;
  return view('Report.meetingpattern',compact('to','from','rows','indicators','output','attended','toattend','unattended','districtname'));
}

public function attendancesreport(){
  switch (auth()->user()->UserLevelID) {
    case '3':
    $rows = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
    break;
    case '2':
    $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
    $rows = Member::whereIn('CellCode',$assemblies)->lists('name','id');
    break;
    case '1':
    $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
    $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
    $rows = Member::whereIn('CellCode',$assemblies)->lists('name','id');
    break;
    case '4':
    $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
    $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
    $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
    $rows = Member::whereIn('CellCode',$assemblies)->lists('name','id');
    break;
    default:
    $rows = [];
    break;
  }
  $rows = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
  $indicators = [];
  $output = [];

  return view('Report.attendancereports',compact('meeting','rows','indicators','output'));
}

public function attendancesreportsearch(Request $request){
 switch (auth()->user()->UserLevelID) {
  case '3':
  $rows = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
  break;
  case '2':
  $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
  $rows = Member::whereIn('CellCode',$assemblies)->lists('name','id');
  break;
  case '1':
  $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
  $rows = Member::whereIn('CellCode',$assemblies)->lists('name','id');
  break;
  case '4':
  $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
  $rows = Member::whereIn('CellCode',$assemblies)->lists('name','id');
  break;
  default:
  $rows = [];
  break;
}

$indicators = [];
$from = $request->FromDate;
$to = $request->ToDate;
     // dd($request->all());
$output = Cellmeetingattendance::where('member_id',$request->member_id)->whereBetween('date',[$from,$to])->join('members','member_id','=','members.id')->orderBy('date','desc')->get();
$districtname = Member::find($request->member_id)->name;
     // dd($output)
//dd(4);
return view('Report.attendancereports',compact('meeting','rows','indicators','output','to','from','districtname'));
}

public function allmembers(){
  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
   $myassembly = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
   $members = Member::whereIn('CellCode',$myassembly)->lists('name','id');
   $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
    $indicators = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyName','AssemblyCode');
 } elseif (auth()->user()->UserLevelID==1) {
  $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts);
  $indicators = $assemblies->lists('AssemblyName','AssemblyCode');
  $myassembly = $assemblies->lists('AssemblyCode');
   $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
   $members = Member::whereIn('CellCode',$myassembly)->lists('name','id');
  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
}elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
$indicators = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyName','AssemblyCode');
$members = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
 $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
     $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
  $myassembly = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
  $members = Member::whereIn('CellCode',$myassembly)->lists('name','id');
   $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
   $indicators = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
}
$output = [];
return view('Report.allmembers',compact('rows','output','indicators','members','membertypes'));
}

public function allmemberssearch(Request $request){
  $stand = 1;
  if ($request->indicators == "" || $request->indicators == null) {
    $stand = 0;
  }
  $memberfield = 1;
  if ($request->members == "" || $request->members == null) {
    $memberfield = 0;
  }
  $membertype = 1;
  if ($request->membertypes == "" || $request->membertypes == null) {
    $membertype = 0;
  }
  $gender = 1;
  if ($request->gender == "" || $request->gender == null) {
    $gender = 0;
  }
  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

   $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
    $members = Member::whereIn('CellCode',$assemblies)->lists('name','id');
     $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
   if ($memberfield == 1) {
      $output = Member::whereIn('CellCode',$assemblies)->orderby('name')->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->where('members.id',$request->members)->leftjoin('membertypes','membertypes.id','=','members.membertype');
   }else{
      $output = Member::whereIn('CellCode',$assemblies)->orderby('name')->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->leftjoin('membertypes','membertypes.id','=','members.membertype');
   }
   if ($membertype == 1) {
      $output = $output->where('membertypes.id',$request->membertypes);
   }
   if ($gender == 1) {
      $output = $output->where('members.gender',$request->gender);
   }
   switch ($stand) {
     case '1':
      $output = $output->where('CellCode',$request->indicators)->paginate(50);
       break;
     
     default:
      $output = $output->paginate(50);
       break;
   }
   $indicators = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyName','AssemblyCode');
    $districtname = District::find(auth()->user()->DistrictID)->DistrictName;
 } elseif (auth()->user()->UserLevelID==1) {
  $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
  $members = Member::whereIn('CellCode',$assemblies)->lists('name','id');
   $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
  if ($memberfield == 1) {
      $output = Member::whereIn('CellCode',$assemblies)->orderby('name')->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->where('members.id',$request->members)->leftjoin('membertypes','membertypes.id','=','members.membertype');
   }else{
      $output = Member::whereIn('CellCode',$assemblies)->orderby('name')->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->leftjoin('membertypes','membertypes.id','=','members.membertype');
   }
   if ($membertype == 1) {
      $output = $output->where('membertypes.id',$request->membertypes);
   }
   if ($gender == 1) {
      $output = $output->where('members.gender',$request->gender);
   }
  switch ($stand) {
     case '1':
      $output = $output->where('CellCode',$request->indicators)->paginate(50);
       break;
     
     default:
      $output = $output->paginate(50);
       break;
   }
  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
  $indicators = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
  $districtname = Area::find(auth()->user()->AreaID)->AreaName ;
}elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
  $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
 if ($memberfield == 1) {
      $output = Member::where('CellCode',auth()->user()->CellID)->orderby('name')->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->where('members.id',$request->members)->leftjoin('membertypes','membertypes.id','=','members.membertype')->paginate(50);
   }else{
      $output = Member::where('CellCode',auth()->user()->CellID)->orderby('name')->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->leftjoin('membertypes','membertypes.id','=','members.membertype')->paginate(50);
   }
   if ($membertype == 1) {
      $output = $output->where('membertypes.id',$request->membertypes);
   }
   if ($gender == 1) {
      $output = $output->where('members.gender',$request->gender);
   }
    $members = Member::where('CellCode',auth()->user()->CellID)->orderBy('name')->lists('name','id');
  $indicators = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyName','AssemblyCode');
    $districtname = Assembly::where('AssemblyCode',auth()->user()->CellID)->first()->AssemblyName;
}
elseif (auth()->user()->UserLevelID==4) {
  $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
   $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
  $members = Member::whereIn('CellCode',$assemblies)->orderBy('name')->lists('name','id');
  if ($memberfield == 1) {
      $output = Member::whereIn('CellCode',$assemblies)->orderby('name')->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->where('members.id',$request->members)->leftjoin('membertypes','membertypes.id','=','members.membertype');
   }else{
      $output = Member::whereIn('CellCode',$assemblies)->orderby('name')->leftjoin('assembly','assembly.AssemblyCode','=','members.CellCode')->leftjoin('membertypes','membertypes.id','=','members.membertype');
   }
   if ($membertype == 1) {
      $output = $output->where('membertypes.id',$request->membertypes);
   }
   if ($gender == 1) {
      $output = $output->where('members.gender',$request->gender);
   }
  // dd($membertype);
  // dd($output->get());
  switch ($stand) {
     case '1':
      $output = $output->where('CellCode',$request->indicators)->paginate(50);
       break;
     
     default:
      $output = $output->paginate(50);
       break;
   }
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  $indicators = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
  $districtname = National::find(auth()->user()->NationalID)->NationalName;
}
//dd($output);
return view('Report.allmembers',compact('rows','output','indicators','districtname','members','membertypes'));
}


public function cellstatus(){
  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
   $indicators = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyName','AssemblyCode');

 } elseif (auth()->user()->UserLevelID==1) {

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
  $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  $indicators = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
}elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
   $indicators = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyName','AssemblyCode');

}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
  $indicators = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
}
$output = [];
return view('Report.cellstatus',compact('rows','output','indicators'));
}


public function cellstatussearch(Request $request){

  if ($request->member_id==null){        
    \Session::flash('message','Please select DistrictName');
    \Session::flash('alert-class','alert-warning');            
    return redirect('cellstatus');
  }

  $stand = 1;
  if ($request->indicators == "" || $request->indicators == null) {
    $stand = 0;
  }
  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');
$indicators = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyName','AssemblyCode');
  // $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
   $output = Assembly::where('DistrictID',auth()->user()->DistrictID)
   ->leftjoin('positions','positions.CellCode','=','assembly.AssemblyCode')
   ->leftjoin('leaders','leaders.id','=','positions.leader_id')
   ->orderby('AssemblyName')
   ->select('positions.title','assembly.AssemblyName','leaders.name','leaders.contact');
   switch ($stand) {
     case '1':
      $output = $output->where('AssemblyCode',$request->indicators)->get();
       break;
     
     default:
      $output = $output->get();
       break;
   }
   
   $districtname = District::find($request->member_id)->DistrictName;
 } elseif (auth()->user()->UserLevelID==1) {
  $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  // $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
  $output = Assembly::whereIn('DistrictID',$districts)
  ->leftjoin('positions','positions.CellCode','=','assembly.AssemblyCode')
  ->leftjoin('leaders','leaders.id','=','positions.leader_id')
  ->orderby('AssemblyName')
  ->select('positions.title','assembly.AssemblyCode','assembly.AssemblyName','leaders.name','leaders.contact');
  switch ($stand) {
     case '1':
      $output = $output->where('AssemblyCode',$request->indicators)->get();
       break;
     
     default:
      $output = $output->get();
       break;
   }
  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
  $indicators = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
  $districtname = Area::find($request->member_id)->AreaName;
}elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
 $output = Assembly::where('AssemblyCode',auth()->user()->CellID)
 ->leftjoin('positions','positions.CellCode','=','assembly.AssemblyCode')
 ->leftjoin('leaders','leaders.id','=','positions.leader_id')
 ->orderby('AssemblyName')
 ->select('positions.title','assembly.AssemblyName','leaders.name','leaders.contact')
 ->get();
  $indicators = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyName','AssemblyCode');
 $districtname = Assembly::find($request->member_id)->AssemblyName;
}
elseif (auth()->user()->UserLevelID==4) {
  $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
 // dd($areas);
  $output = Assembly::whereIn('DistrictID',$districts)
  ->leftjoin('positions','positions.CellCode','=','assembly.AssemblyCode')
  ->leftjoin('leaders','leaders.id','=','positions.leader_id')
  ->orderby('AssemblyName')
  ->select('positions.title','assembly.AssemblyName','leaders.name','leaders.contact');
  switch ($stand) {
     case '1':
      $output = $output->where('AssemblyCode',$request->indicators)->get();
       break;
     
     default:
      $output = $output->get();
       break;
   }
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  $indicators = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyName','AssemblyCode');
  $districtname = National::find($request->member_id)->NationalName;
}
//dd($output);
return view('Report.cellstatus',compact('rows','output','districtname','indicators'));
}

public function detailedactivity(){
  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

 } elseif (auth()->user()->UserLevelID==1) {

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
}elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  

}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
}
$output = [];
$indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
->lists('Indicators','Indicators');
return view('Report.detailedactivity',compact('rows','output','indicators'));
}

public function detailedactivitysearch(Request $request){
  //dd($request->all());
  if (  (($request->FromDate) && ($request->ToDate==null))  ||  ( ($request->ToDate) && ($request->FromDate==null) ) ) {        
    \Session::flash('message','Either Start date or End date is missing');
    \Session::flash('alert-class','alert-warning');            
    return redirect('detailedactivity');
  }
  if ($request->FromDate > $request->ToDate){        
    \Session::flash('message','Start date must be less or equal to end date');
    \Session::flash('alert-class','alert-warning');            
    return redirect('DistrictAssembly');
  }
  if ($request->FinanceType==null){        
    \Session::flash('message','Please select Report Type');
    \Session::flash('alert-class','alert-warning');            
    return redirect('detailedactivity');
  }
  if ($request->AssemblyName==null){        
    \Session::flash('message','Please select DistrictName');
    \Session::flash('alert-class','alert-warning');            
    return redirect('detailedactivity');
  }
  $to = $request->ToDate;
  $from = $request->FromDate;
  $ind = $request->FinanceType;

  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

   $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
  // dd($assemblies);
   $output = Finance::where('Indicators',$ind)->whereIn('finance.AssemblyID',$assemblies)->whereBetween('date',[$from,$to])
   ->join('assembly','assembly.AssemblyCode','=','finance.AssemblyID')
   ->groupby('date','assembly.AssemblyCode')
   ->select('assembly.*','finance.IndValues','finance.date',DB::raw('sum(IndValues) as total'))
   ->get();
   $districtname = District::find($request->AssemblyName)->DistrictName;
 } elseif (auth()->user()->UserLevelID==1) {

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');

  $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
  // dd($assemblies);
  $output = Finance::where('Indicators',$ind)->whereIn('finance.AssemblyID',$assemblies)->whereBetween('date',[$from,$to])
  ->join('assembly','assembly.AssemblyCode','=','finance.AssemblyID')
  ->leftjoin('district','district.DistrictID','=','assembly.DistrictID')
  ->groupby('date','assembly.DistrictID')
  ->select('assembly.*','finance.IndValues','finance.date','district.DistrictName','district.DistrictCode',DB::raw('sum(IndValues) as total'))
  ->get();
  $districtname = District::find($request->AssemblyName)->AreaName;
}elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
 $output = Finance::where('Indicators',$ind)->where('finance.AssemblyID',auth()->user()->CellID)->whereBetween('date',[$from,$to])
 ->join('assembly','assembly.AssemblyCode','=','finance.AssemblyID')
 ->groupby('date','assembly.AssemblyCode')
 ->select('assembly.*','finance.IndValues','finance.date',DB::raw('sum(IndValues) as total'))
 ->get();
//dd($output);
 $districtname = Assembly::find($request->AssemblyName)->AssemblyName;
}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
  $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
  $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
  $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
  // dd($assemblies);
  $output = Finance::where('Indicators',$ind)->whereIn('finance.AssemblyID',$assemblies)->whereBetween('date',[$from,$to])
  ->join('assembly','assembly.AssemblyCode','=','finance.AssemblyID')
  ->leftjoin('district','district.DistrictID','=','assembly.DistrictID')
  ->leftjoin('area','district.AreaID','=','area.AreaID')
  ->groupby('date','area.AreaID')
  ->select('assembly.*','finance.IndValues','finance.date','area.AreaName','area.AreaCode',DB::raw('sum(IndValues) as total'))
  ->get();
  $districtname = National::find($request->AssemblyName)->NationalName;
}

$indicators =\App\Indicator::where('NationalID',auth()->user()->NationalID)->orderBy('Indicators')->Distinct('Indicators')
->lists('Indicators','Indicators');

return view('Report.detailedactivity',compact('rows','output','ind','indicators','to','from','districtname'));
}

public function meetingreportperperiod(){
  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

 } elseif (auth()->user()->UserLevelID==1) {

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
}elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
$indicators = Meetingtype::where('CellCode',auth()->user()->CellID)->lists('typename','typename');
}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
}
$output = [];

return view('Report.meetingreportperperiod',compact('rows','output','indicators'));
}

public function meetingreportperperiodsearch(Request $request){
    $to = $request->ToDate;
  $from = $request->FromDate;
  $ind = $request->FinanceType;

  if(auth()->user()->UserLevelID==2){
   $rows =\App\Models\District::orderBy('DistrictName')->where('DistrictID','=',auth()->user()->DistrictID)->lists('DistrictName','DistrictID');

 } elseif (auth()->user()->UserLevelID==1) {

  $rows = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
}elseif (auth()->user()->UserLevelID==3) {

 $rows =\App\Models\Assembly::orderBy('AssemblyName')->where('AssemblyCode','=',auth()->user()->CellID)->lists('AssemblyName','AssemblyID');  
$indicators = Meetingtype::where('CellCode',auth()->user()->CellID)->lists('typename','typename');
$output = Cellmeetingattendance::whereBetween('date',[$from,$to])->where('CellCode',auth()->user()->CellID)
->groupby('meetingtype','date')
->take(7)
->orderBy('date','asc')
->lists('date');
$members = Member::where('CellCode',auth()->user()->CellID)->get(['name','id']);
$districtname = Assembly::where('AssemblyCode',auth()->user()->CellID)->first()->AssemblyName;
}
elseif (auth()->user()->UserLevelID==4) {
  $rows = National::where('NationalID',auth()->user()->NationalID)->lists('NationalName','NationalID');
}

//dd($members);
return view('Report.meetingreportperperiod',compact('rows','output','indicators','members','to','from','districtname'));
}

}
