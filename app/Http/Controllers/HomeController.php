<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Finance;

use \Config;
use \Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  //enaable this for auth! //**************todo
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }
       /* public function page1()
    {
		return view('welcome');
    }*/


    public function mailbox()
    {
 $user=auth()->user()->id;
 $Area=auth()->user()->AreaID;
 $DistrictID = auth()->user()->DistrictID;
 $CellID = auth()->user()->CellID;
            if(auth()->user()->UserLevelID==2){
		$baseQuery="Select count(finance.FinanceID) as total from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode
  	where finance.Activity_State=0 and  assembly.DistrictID=".$DistrictID; 
$inbox= \DB::select($baseQuery);
//dd($inbox);
		
			}
			elseif(auth()->user()->UserLevelID==1){

              $baseQuery="Select count(finance.FinanceID) as total from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode
              join district on  district.DistrictID = assembly.DistrictID 
              where finance.Activity_State=1 and  district.AreaID=".$Area; 
              $inbox= \DB::select($baseQuery);

          }elseif(auth()->user()->UserLevelID==3){
             $baseQuery="Select count(finance.FinanceID) as total from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode
              join district on  district.DistrictID = assembly.DistrictID 
              where finance.Activity_State=1 and  district.AreaID=".$CellID; 
              $inbox= \DB::select($baseQuery);
          }


          if(auth()->user()->UserLevelID==1){
            $baseQuery="Select count(finance.FinanceID) as total from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode
            where finance.Activity_State=2   and  assembly.DistrictID=".$DistrictID;
            $outbox= \DB::select($baseQuery);

			   }
			elseif(auth()->user()->UserLevelID==2){
              $baseQuery="Select count(finance.FinanceID) as total from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode
              where (finance.Activity_State=1  or finance.Activity_State=2) and  assembly.DistrictID=".$DistrictID;
              $outbox= \DB::select($baseQuery);

			}
            elseif(auth()->user()->UserLevelID==3){
            $baseQuery="Select count(finance.FinanceID) as total from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode
            where finance.Activity_State=2   and  assembly.DistrictID=".$CellID;
            $outbox= \DB::select($baseQuery);

               }


			
			
			 if(auth()->user()->UserLevelID==2){

		$baseQuery="Select count(finance.FinanceID) as total from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode
  	where finance.Activity_State=3 and  assembly.DistrictID=".$DistrictID;
	$rejected = \DB::select($baseQuery);		
	
		}

			else{
	 $rejected=array();

			}
			
			//dd($rejected);
		/*$data1=array(        
            'inbox'=>$inbox,
			 'rejected'=>$rejected,
            'recentlySent'=>$outbox
            );  
        
        
        $data=json_decode(json_encode($data1), FALSE);
        //needs an object, not an array.
        $theRoute1 =route ('/inbox');
        $inboxRoute=json_decode(json_encode($theRoute1), FALSE);
        $outboxRoute1 =route ('/outbox');
        $outboxRoute=json_decode(json_encode($outboxRoute1), FALSE);*/

        return view('general.mailbox')->with(compact('inbox','rejected','outbox'));//, 'inboxRoute', 'outboxRoute'));;

   
    }

}
