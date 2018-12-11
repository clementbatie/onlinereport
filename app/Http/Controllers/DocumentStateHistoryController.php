<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\DocumentStateHistory;
use App\Models\ActivityUpdate;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Minute;
use App\Models\Comment;
use \DB;
use \Config;
use App\User;
use \Session;
use Validator;


class DocumentStateHistoryController extends Controller
{
  private  $rules =   [          
          'NextStateID'=>'required'          
                ];
  private $message = ['NextStateID.required'=>'The  Send To Ministry is required'];
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function inbox()
    {
        $sectionID=auth()->user()->SectionID;
        $Department_ID = auth()->user()->Department_ID;
		$user=auth()->user()->id;
       $Area=auth()->user()->AreaID;
       $DistrictID = auth()->user()->DistrictID;
       $CellID = auth()->user()->CellID;
 
            if(auth()->user()->UserLevelID==1){
        $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State 
		 from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join district on  district.DistrictID = assembly.DistrictID 
  	where finance.Activity_State=1 and  district.AreaID=".$Area; 
$inbox= \DB::select($baseQuery);      
			}
			
			elseif(auth()->user()->UserLevelID==2){
			      $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State 
		 from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join district on  district.DistrictID = assembly.DistrictID 
  	where finance.Activity_State=0 and  assembly.DistrictID = ".$DistrictID; 
$inbox= \DB::select($baseQuery);           
	
			}
			elseif(auth()->user()->UserLevelID==3){
                  $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State 
         from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join district on  district.DistrictID = assembly.DistrictID 
    where finance.Activity_State=0 and  assembly.DistrictID = ".$CellID; 
$inbox= \DB::select($baseQuery);           
    
            }

            return view('documents.inbox')->with(compact('inbox'));



        }

 public function sent()
    {
        $user=auth()->user()->id;
		 $Area=auth()->user()->AreaID;
       $DistrictID = auth()->user()->DistrictID;
       $CellID = auth()->user()->CellID;
             if(auth()->user()->UserLevelID==1){
       $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State 
		 from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join district on  district.DistrictID = assembly.DistrictID 
  	where finance.Activity_State=2 and  district.AreaID=".$Area;        
     $outbox= \DB::select($baseQuery);   
			 }
			 elseif(auth()->user()->UserLevelID==2){
               $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State 
               from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join district on  district.DistrictID = assembly.DistrictID 
               where (finance.Activity_State=1 or finance.Activity_State=2) and  assembly.DistrictID = ".$DistrictID; 

               $outbox= \DB::select($baseQuery);      

			 }
              elseif(auth()->user()->UserLevelID==3){
               $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State 
               from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join district on  district.DistrictID = assembly.DistrictID 
               where (finance.Activity_State=1 or finance.Activity_State=2) and  assembly.DistrictID = ".$CellID; 

               $outbox= \DB::select($baseQuery);      
               
             }
			 
            return view('documents.outbox')->with(compact('outbox'));



        }
		
		
		function rejected()
    {
        $user=auth()->user()->id;
		 $Area=auth()->user()->AreaID;
       $DistrictID = auth()->user()->DistrictID;
             if(auth()->user()->UserLevelID==2){
   $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State 
		 from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join district on  district.DistrictID = assembly.DistrictID 
  	where finance.Activity_State=3 and  assembly.DistrictID = ".$DistrictID;
	     $notapproved= \DB::select($baseQuery);      

			 }
			 
            return view('documents.notapproved')->with(compact('notapproved'));



        }
		
		
		
		
		 public function Activate($id){
                $update = \App\Models\Finance::find($id);
		if(auth()->user()->UserLevelID==2  && $update->Activity_State == 3){
			$update->Activity_State = 0;
			$update->save();
			
			 \Session::flash('message','Record Activated!');
        \Session::flash('alert-class','alert-success');
		  return redirect('home');
        }
		
		 }
		 
		public function ActivityDetails($id)
    {
		 $update = \App\Models\Finance::find($id);
if( $update->Activity_State == 1 && auth()->user()->UserLevelID==1 ){
			
			$update->Activity_State = 2;
			$update->save();
		}
	
		    $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State, 
			 assembly.AssemblyCode,users.name,district.DistrictCode,district.DistrictID,finance.IndValues,finance.Indicators
		 from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join users on users.id = finance.UserName join  
		 district on district.DistrictID = assembly.DistrictID 
  	where  finance.FinanceID=".$id; 
$rows= \DB::select($baseQuery);  
		   $comment = \App\Models\Comment::with('UserName')->orderby('created_at','desc')->where('FinanceID','=',$id)->get();   
     
		// dd($rows); 
            return view('documents.viewbeforeforward')->with(compact('rows','comment'));



        }
		
		
			public function ActivityApproved($id)
    {
		 $update = \App\Models\Finance::find($id);
		if(auth()->user()->UserLevelID==2  && $update->Activity_State == 0){
			$update->Activity_State = 1;
			$update->ReviewerID =auth()->user()->id;
			$update->save();
			
			$comment = new Comment();
			$comment->Comment ='Approved';
			$comment->FinanceID=$id;
			$comment->id = auth()->user()->id;
			$comment->save();
			
			 \Session::flash('message','Activity Approved successfully!');
        \Session::flash('alert-class','alert-success');
		  return redirect('home');
		}
         

 \Session::flash('message','Activity Approved Already!');
        \Session::flash('alert-class','alert-success');
		  return redirect('home');

        }
	
			public function ActivityRejected(Request $request, $id)
    {
		 $update = \App\Models\Finance::find($id);
		if(auth()->user()->UserLevelID==2  && $update->Activity_State ==0){
			$update->Activity_State = 3;
			$update->ReviewerID =auth()->user()->id;
			$update->save();
			
			$comment = new Comment();
			$comment->Comment =$request->Comment;
			$comment->FinanceID=$id;
			$comment->id = auth()->user()->id;
			$comment->save();
		}
		
    
\Session::flash('message','Activity Rejected Successfully!');
        \Session::flash('alert-class','alert-success');
     return redirect('home');


        }
		public function Activitydelete(Request $request, $id)
    {
		 \App\Models\Finance::find($id)->delete();
		
			\Session::flash('message','Record Deleted Successfully!');
        \Session::flash('alert-class','alert-success');
    $user=auth()->user()->id;
		 $Area=auth()->user()->AreaID;
       $DistrictID = auth()->user()->DistrictID;
             if(auth()->user()->UserLevelID==2){
   $baseQuery="Select finance.FinanceID, district.DistrictName,assembly.AssemblyName,finance.created_at,finance.updated_at,finance.Activity_State 
		 from finance  join assembly  on finance.AssemblyID = assembly.AssemblyCode join district on  district.DistrictID = assembly.DistrictID 
  	where finance.Activity_State=3 and  assembly.DistrictID = ".$DistrictID;
	     $notapproved= \DB::select($baseQuery);      

			 }
			 
            return view('documents.notapproved')->with(compact('notapproved'));
			
		}
		
		
    }
