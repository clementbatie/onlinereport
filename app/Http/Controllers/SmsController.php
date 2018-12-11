<?php

namespace App\Http\Controllers;

use App\Branchcode;
use App\Http\Requests;
use App\Member;
use App\Leader;
use App\Title;
use \DB;
use App\Membertype;
use App\Models\Area;
use App\Models\Assembly;
use App\Models\District;
use App\Shortcode;
use GuzzleHttp\Client;
use App\Classes;
use App\Student;
use App\Parents;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Cellmeetingattendance;

class SmsController extends Controller
{
     public function sms(){
    
        //  switch (auth()->user()->UserLevelID) {
        //     case '3':
        //    $members = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',1)->select(DB::raw('CONCAT(name," -- ",contact) as membername'),'contact')->lists('membername','contact');
        // //   $member = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
        //         break;
        //    case '2':
        //    $districts = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
        //    $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->select(DB::raw('CONCAT(name," -- ",contact) as membername'),'contact')->lists('membername','contact');
        //            break; 
        //     case '1':
        //     $area = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
        //    $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
        //    $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->select(DB::raw('CONCAT(name," -- ",contact) as membername'),'contact')->lists('membername','contact');
        //         break; 
        //     case '4':
        //     $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
        //     $area = District::whereIn('AreaID',$national)->lists('DistrictID');
        //    $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
        //    $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->select(DB::raw('CONCAT(name," -- ",contact) as membername'),'contact')->lists('membername','contact');
        //         break;
        //     default:

           $student = Student::lists('StudentName','id');

           $class = Classes::lists('ClassName','ClassID');
        //         break;
        // }
      // $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');

      $membertypes = [];

      $members = [];

        return view('sms.sms',compact('class','members','membertypes'));
    }

    public function leadersms(){
         switch (auth()->user()->UserLevelID) {
            case '1':
            
           $members = Leader::where('AreaID',auth()->user()->AreaID)->select(DB::raw('CONCAT(name," -- ",contact) as leadername'),'contact')->lists('leadername','contact');
           $areaname = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
                break; 
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $members = Leader::whereIn('AreaID',$national)->select(DB::raw('CONCAT(name," -- ",contact) as leadername'),'contact')->lists('leadername','contact');
            $areaname = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
                break;
            default:
             $members =[];
                break;
        }
      $titles = Title::where('NationalID',auth()->user()->NationalID)->lists('title','title');
        return view('sms.leadersms',compact('members','areaname','titles'));
    }

     public function leadersmspersonalised(){
         switch (auth()->user()->UserLevelID) {
            case '1':
            
           $members = Leader::where('AreaID',auth()->user()->AreaID)->select(DB::raw('CONCAT(name," -- ",contact) as leadername'),'contact')->lists('leadername','contact');
           $areaname = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
                break; 
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $members = Leader::whereIn('AreaID',$national)->select(DB::raw('CONCAT(name," -- ",contact) as leadername'),'contact')->lists('leadername','contact');
            $areaname = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
                break;
            default:
             $members =[];
                break;
        }
      $titles = Title::where('NationalID',auth()->user()->NationalID)->lists('title','title');
        return view('sms.leadersmspersonalised',compact('members','areaname','titles'));
    }

    public function smspersonalised(){
          switch (auth()->user()->UserLevelID) {
            case '3':
           $members = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',1)->select(DB::raw('CONCAT(name," -- ",contact) as membername'),'contact')->lists('membername','contact');
        //   $member = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
                break;
           case '2':
           $districts = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->select(DB::raw('CONCAT(name," -- ",contact) as membername'),'contact')->lists('membername','contact');
                   break; 
            case '1':
            $area = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->select(DB::raw('CONCAT(name," -- ",contact) as membername'),'contact')->lists('membername','contact');
                break; 
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $area = District::whereIn('AreaID',$national)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->select(DB::raw('CONCAT(name," -- ",contact) as membername'),'contact')->lists('membername','contact');
                break;
            default:
             $members =[];
                break;
        }
      $membertypes = Membertype::where('NationalID',auth()->user()->NationalID)->lists('typename','id');
        return view('sms.smspersonalised',compact('members','membertypes'));
    }

    public function sendsms(Request $request){
    
        $data = $request->data;
        $details =  $data['data'];
        switch (auth()->user()->UserLevelID) {
            case '3':
         $branchcode = Branchcode::where('NationalID',auth()->user()->SchoolCode)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
         
                break;
            case '2':
        $branchcode = Branchcode::where('NationalID',auth()->user()->SchoolCode)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            case '1':
        $branchcode = Branchcode::where('NationalID',auth()->user()->SchoolCode)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            case '4':
         $branchcode = Branchcode::where('NationalID',auth()->user()->SchoolCode)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";

                break;
            
            default:
             return "unauthorised";
                break;
        }
        $cellcode = $branchcode;
        $message = urlencode(trim($data['textmessage']));
        $date = trim($details['date']);
       //$formatdate = strtotime($date);//explode("-", $date);
        //$formatdate  = date('Y-m-d',$formatdate);
        $formatdate = Carbon::parse($date);
       // return $formatdate;
        $phone = trim($details['ParentNumber']);

       // return $phone;
        $countsms = ceil(strlen($message)/160);
         $mybalance = new Client();
        // $cellcode = "8819";
         $mysmsbalance = $mybalance->request('GET',"http://3csms.3cprojects.org/checksmscreditbalance/{$cellcode}");
  
        $mysmsbalance =  $mysmsbalance->getBody()->getContents();
       // $mysmsbalance =  "";
      //  return $mysmsbalance;
        
        /* determine user*/
         switch (auth()->user()->UserLevelID) {
            case '3':
         $shortcode = Shortcode::where('CellCode',auth()->user()->CellID)->first();
         $branchcode = auth()->user()->CellID;
                break;
            case '2':
        $shortcode = Shortcode::where('DistrictID',auth()->user()->DistrictID)->first();
        $branch = Branchcode::where('DistrictID',auth()->user()->DistrictID)->first();
        $branchcode = $branch ? $branch->branchcode : "0";
                break;
            case '1':
          $shortcode = Shortcode::where('AreaID',auth()->user()->AreaID)->first();
          $branch = Branchcode::where('AreaID',auth()->user()->AreaID)->first();
         $branchcode = $branch ? $branch->branchcode : "0";
                break;
            case '4':
         $shortcode = Shortcode::where('NationalID',auth()->user()->SchoolCode)->first();
         $branch = Branchcode::where('NationalID',auth()->user()->SchoolCode)->first();
         $branchcode = $branch ? $branch->branchcode : "0";
                break;
            
            default:
                # code...
                break;
        }
        /**************/
        $myshortcode = $shortcode ? $shortcode->shortcode : "None";
        $myshortcode = strtoupper($myshortcode);
       // $myshortcode = "WEBHOST";
       // return $phone;
            $client = new Client();
          
        if ($mysmsbalance > $countsms) {
            if ($formatdate == Carbon::today()) {
              //return "date  match";
                  $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=0&time=01/12/2018&branchcode={$branchcode}&smspages={$countsms}");
                 
             }elseif ($formatdate > Carbon::today()) {
              //return "date didnt match";
               $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=1&time={$date}&branchcode={$branchcode}&smspages={$countsms}");
             }else{
           //   return "invalid date";
          $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=0&time=01/12/2018&branchcode={$branchcode}&smspages={$countsms}");
             }
         
           return response()->json(['message' => 'correct', 'details' => $apiresponse->getBody()->getContents()]);
        }else{
             return response()->json(['message' => 'nocredit', 'details' => "You dont have enough sms credits to send this message.\nPlease topup your account"]);
        }
  
        return response()->json([
            'message' => 'correct'
        ]);
    }

     public function sendsmspersonalised(Request $request){
        $data = $request->data;
        $details =  $data['data'];
        $phone = trim($details['phone']);
        $themember = Member::where('contact',$phone)->where('confirmed',1)->first();
        $checkmember = $themember ? $themember->name : "no member";
        if ($checkmember == "no member") {
        	return "no member";
        }
        Log::info('my request');
        Log::info($data);
        Log::info('member');
        Log::info($themember);
        switch (auth()->user()->UserLevelID) {
            case '3':
          $branchcode = auth()->user()->CellID;
         
                break;
            case '2':
         $branchcode = Branchcode::where('DistrictID',auth()->user()->DistrictID)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            case '1':
         $branchcode = Branchcode::where('AreaID',auth()->user()->AreaID)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            case '4':
         $branchcode = Branchcode::where('NationalID',auth()->user()->NationalID)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            
            default:
             return "unauthorised";
                break;
        }
        $cellcode = $branchcode ;
        $message = urlencode(trim("Dear {$checkmember}\n" . $details['textmessage']));
       Log::info($message);
        $date = trim($details['date']);
        $formatdate = Carbon::parse($date);//explode("-", $date);
       // $formatdate  = date('Y-m-d',$formatdate);
        
       // return $phone;
        $countsms = ceil(strlen($message)/160);
       // return $countsms;
         $mybalance = new Client();
        // $cellcode = "8819";
         $mysmsbalance = $mybalance->request('GET',"http://3csms.3cprojects.org/checksmscreditbalance/{$cellcode}");
      
        $mysmsbalance =  $mysmsbalance->getBody()->getContents();
       // $mysmsbalance =  "";
      //  return $mysmsbalance;
        
        /* determine user*/
         switch (auth()->user()->UserLevelID) {
            case '3':
         $shortcode = Shortcode::where('CellCode',auth()->user()->CellID)->first();
         $branchcode = auth()->user()->CellID;
                break;
            case '2':
        $shortcode = Shortcode::where('DistrictID',auth()->user()->DistrictID)->first();
        $branch = Branchcode::where('DistrictID',auth()->user()->DistrictID)->first();
        $branchcode = $branch ? $branch->branchcode : "0";
                break;
            case '1':
          $shortcode = Shortcode::where('AreaID',auth()->user()->AreaID)->first();
          $branch = Branchcode::where('AreaID',auth()->user()->AreaID)->first();
         $branchcode = $branch ? $branch->branchcode : "0";
                break;
            case '4':
         $shortcode = Shortcode::where('NationalID',auth()->user()->NationalID)->first();
         $branch = Branchcode::where('NationalID',auth()->user()->NationalID)->first();
         $branchcode = $branch ? $branch->branchcode : "0";
                break;
            
            default:
                # code...
                break;
        }
        /**************/
        $myshortcode = $shortcode ? $shortcode->shortcode : "None";
        $myshortcode = strtoupper($myshortcode);
       // $myshortcode = "WEBHOST";
       // return $phone;
            $client = new Client();
          
        if ($mysmsbalance > $countsms) {
            if ($formatdate == Carbon::today()) {
                  $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=0&time=01/12/2018&branchcode={$branchcode}&smspages={$countsms}");
                 
             }elseif ($formatdate > Carbon::today()) {
               $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=1&time={$date}&branchcode={$branchcode}&smspages={$countsms}");
             }else{
          $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=0&time=01/12/2018&branchcode={$branchcode}&smspages={$countsms}");
             }
         
           return response()->json(['message' => 'correct', 'details' => $apiresponse->getBody()->getContents()]);
        }else{
             return response()->json(['message' => 'nocredit', 'details' => "You dont have enough sms credits to send this message.\nPlease topup your account"]);
        }
  
        return response()->json([
            'message' => 'correct'
        ]);
    }

public function sendleadersmspersonalised(Request $request){
        $data = $request->data;
        $details =  $data['data'];
        $phone = trim($details['phone']);
        $themember = Leader::where('contact',$phone)->first();
        $checkmember = $themember ? $themember->name : "no member";
        if ($checkmember == "no member") {
          return "no member";
        }
        
        switch (auth()->user()->UserLevelID) {
           
            case '1':
         $branchcode = Branchcode::where('AreaID',auth()->user()->AreaID)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            case '4':
         $branchcode = Branchcode::where('NationalID',auth()->user()->NationalID)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            
            default:
             return "unauthorised";
                break;
        }
        $cellcode = $branchcode ;
        $message = urlencode(trim("Dear {$checkmember}\n" . $details['textmessage']));
       Log::info($message);
        $date = trim($details['date']);
        $formatdate = Carbon::parse($date);//explode("-", $date);
       // $formatdate  = date('Y-m-d',$formatdate);
        
       // return $phone;
        $countsms = ceil(strlen($message)/160);
       // return $countsms;
         $mybalance = new Client();
        // $cellcode = "8819";
         $mysmsbalance = $mybalance->request('GET',"http://3csms.3cprojects.org/checksmscreditbalance/{$cellcode}");
      
        $mysmsbalance =  $mysmsbalance->getBody()->getContents();
       // $mysmsbalance =  "";
      //  return $mysmsbalance;
        
        /* determine user*/
         switch (auth()->user()->UserLevelID) {
          
            case '1':
          $shortcode = Shortcode::where('AreaID',auth()->user()->AreaID)->first();
          $branch = Branchcode::where('AreaID',auth()->user()->AreaID)->first();
         $branchcode = $branch ? $branch->branchcode : "0";
                break;
            case '4':
         $shortcode = Shortcode::where('NationalID',auth()->user()->NationalID)->first();
         $branch = Branchcode::where('NationalID',auth()->user()->NationalID)->first();
         $branchcode = $branch ? $branch->branchcode : "0";
                break;
            
            default:
                # code...
                break;
        }
        /**************/
        $myshortcode = $shortcode ? $shortcode->shortcode : "None";
        $myshortcode = strtoupper($myshortcode);
       // $myshortcode = "WEBHOST";
       // return $phone;
            $client = new Client();
          
        if ($mysmsbalance > $countsms) {
            if ($formatdate == Carbon::today()) {
                  $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=0&time=01/12/2018&branchcode={$branchcode}&smspages={$countsms}");
                 
             }elseif ($formatdate > Carbon::today()) {
               $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=1&time={$date}&branchcode={$branchcode}&smspages={$countsms}");
             }else{
          $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/sendsms?phone={$phone}&provider=5&message={$message}&source={$myshortcode}&schedule=0&time=01/12/2018&branchcode={$branchcode}&smspages={$countsms}");
             }
         
           return response()->json(['message' => 'correct', 'details' => $apiresponse->getBody()->getContents()]);
        }else{
             return response()->json(['message' => 'nocredit', 'details' => "You dont have enough sms credits to send this message.\nPlease topup your account"]);
        }

    }
     public function smsbulk(){
         switch (auth()->user()->UserLevelID) {
            case '3':
           $members = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',1)->lists('name','contact');
            $cellname = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyName','AssemblyCode');
                break;
           case '2':
           $districts = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->lists('name','contact');
            $cellname = Assembly::whereIn('AssemblyCode',$districts)->lists('AssemblyName','AssemblyCode');
                   break; 
            case '1':
            $area = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->lists('name','contact');
            $cellname = Assembly::whereIn('AssemblyCode',$districts)->lists('AssemblyName','AssemblyCode');
                break; 
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $area = District::whereIn('AreaID',$national)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->lists('name','contact');
            $cellname = Assembly::whereIn('AssemblyCode',$districts)->lists('AssemblyName','AssemblyCode');
                break;
            default:
             $members =[];
             $cellname =[];
             $members =[];
                break;
        }
       
        return view('sms.smsbulk',compact('members','cellname'));
    }

    public function smsbulksearch(Request $request){
     //   return $request->all();
          $formdata = Input::get('data');
         $ob = $formdata['data'][0];
         $from = $ob['from'];
         $to = $ob['to'];
         $cellcode = $ob['cellname'];
         $category = $ob['category'];
         switch (auth()->user()->UserLevelID) {
           case '3':
            $cells [] = auth()->user()->CellID ;
             break;
            case '2':
            $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
             break;
            case '1':
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
            $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
             break;
            case '4':
            $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
            $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
             break;
           
           default:
             $cells = [];
             break;
         }
         $results = Cellmeetingattendance::whereIn('cellmeetingattendances.CellCode',$cells);
            if ($category == "" || $category == null) {
                $results = $results->whereBetween('cellmeetingattendances.date',[$from,$to])->leftjoin('members','members.id','=','member_id')->leftjoin('assembly','members.CellCode','=','AssemblyCode')
                ->orderBy('AssemblyName','asc')->get(['name','contact','flag','cellmeetingattendances.date','AssemblyName']);
            }else{
                 $results = $results->where('cellmeetingattendances.flag',$category)->whereBetween('cellmeetingattendances.date',[$from,$to])->leftjoin('members','members.id','=','member_id')->leftjoin('assembly','members.CellCode','=','AssemblyCode')
                  ->orderBy('AssemblyName','asc')->get(['name','contact','flag','cellmeetingattendances.date','AssemblyName']);
            }
         
         
         return response()->json(['message'=>'correct','details' => $results]);
    }

    public function smsbulkpersonalised(){
         switch (auth()->user()->UserLevelID) {
            case '3':
           $members = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',1)->lists('name','contact');
            $cellname = Assembly::where('AssemblyCode',auth()->user()->CellID)->lists('AssemblyName','AssemblyCode');
                break;
           case '2':
           $districts = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->lists('name','contact');
            $cellname = Assembly::whereIn('AssemblyCode',$districts)->lists('AssemblyName','AssemblyCode');
                   break; 
            case '1':
            $area = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->lists('name','contact');
            $cellname = Assembly::whereIn('AssemblyCode',$districts)->lists('AssemblyName','AssemblyCode');
                break; 
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $area = District::whereIn('AreaID',$national)->lists('DistrictID');
           $districts = Assembly::whereIn('DistrictID',$area)->lists('AssemblyCode');
           $members = Member::whereIn('CellCode',$districts)->where('confirmed',1)->lists('name','contact');
            $cellname = Assembly::whereIn('AssemblyCode',$districts)->lists('AssemblyName','AssemblyCode');
                break;
            default:
             $members =[];
             $cellname =[];
             $members =[];
                break;
        }
       
        return view('sms.smsbulkpersonalised',compact('members','cellname'));
    }

    public function searchmemberlists(Request $request){

     //   return $request->all();
          $formdata = Input::get('data');
         $ob = $formdata['data'][0];
         $from = $ob['from'];
         $to = $ob['to'];
         $gender = $ob['gender'];
         $membertypes = $ob['membertypes'];
  
         if($membertypes=="Parent")
         {
               $results = Student::where('students.ClassID',$gender)->where('students.SchoolCode',auth()->user()->SchoolCode)->leftjoin('classes','students.ClassID','=','classes.ClassID')->select('students.StudentName','classes.ClassName','students.ParentNumber')->get();
         }
         elseif($membertypes=="Teacher")
         {
                $results = Teacher::where('students.ClassID',$gender)->where('students.SchoolCode',auth()->user()->SchoolCode)->leftjoin('classes','students.ClassID','=','classes.ClassID')->select('students.StudentName','classes.ClassName','students.ParentNumber')->get();
         }



         //return $category;
         // switch (auth()->user()->UserLevelID) {
         //   case '3':
         //    $cells [] = auth()->user()->CellID ;
         //     break;
         //    case '2':
         //    $cells = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
         //     break;
         //    case '1':
         //    $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
         //    $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
         //     break;
         //    case '4':
         //    $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
         //    $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
         //    $cells = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
         //     break;
           
         //   default:
         //     $cells = [];
         //     break;
         // }



         // $results = Member::whereIn('CellCode',$cells)->where('confirmed',1)->leftjoin('membertypes','membertypes.id','=','members.membertype')->leftjoin('assembly','members.CellCode','=','AssemblyCode');
         //    if ($to != "" || $to != null) {
         //        $results = $results->whereBetween('members.dob',[$from,$to]);
                
         //    }

         //    if ($gender != "" || $gender != null) {
         //        $results = $results->where('members.gender',$gender);
         //    }

         //    if ($membertypes != "" || $membertypes != null) {
         //        $results = $results->where('members.membertype',$membertypes);
         //    }

         //    $results = $results->orderBy('AssemblyName','asc')->select('members.name','members.contact','membertypes.typename','members.gender','assembly.AssemblyName')->get();
         
    
         return response()->json(['message'=>'correct','details' => $results]);
    }

    public function searchleaderlists(Request $request){
       $formdata = Input::get('data');
         $ob = $formdata['data'][0];
        
         $areaid = $ob['areaname'];
         $titles = $ob['title'];
         //return $category;
         switch (auth()->user()->UserLevelID) {
           
            case '1':
           $leaders = Leader::where('leaders.AreaID',auth()->user()->AreaID);
             break;
            case '4':
            $national = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
           $leaders = Leader::whereIn('leaders.AreaID',$national);
             break;
           
           default:
             $cells = [];
             break;
         }



         $results = $leaders->leftjoin('positions','positions.leader_id','=','leaders.id');
            if ($areaid != "" || $areaid != null) {
                $results = $results->where('leaders.AreaID',$areaid);
                
            }

            if ($titles != "" || $titles != null) {
                $results = $results->where('positions.title',$titles);
            }

           

            $results = $results->leftjoin('area','area.AreaID','=','leaders.AreaID')->orderBy('area.AreaName','asc')->select('leaders.name','leaders.contact','positions.title','area.AreaName')->get();
         
    
         return response()->json(['message'=>'correct','details' => $results]);
    }

    public function shortcode(){
        switch (auth()->user()->UserLevelID) {
            case '3':
          $shortcode = Shortcode::where('CellCode',auth()->user()->CellID)->first();
                break;
            case '2':
          $shortcode = Shortcode::where('DistrictID',auth()->user()->DistrictID)->first();
                break;
            case '1':
          $shortcode = Shortcode::where('AreaID',auth()->user()->AreaID)->first();
                break;
            case '4':
          $shortcode = Shortcode::where('NationalID',auth()->user()->SchoolCode)->first();
                break;
            
            default:
                # code...
                break;
        }
        if (!empty($shortcode)) {
            $shortcode = $shortcode->shortcode;
        }
        return view ('sms.shortcode',compact('shortcode'));
    }

    public function shortcodesave(Request $request){

        $this->validate($request,[
            'shortcode' => 'max:11|required|unique:shortcodes'
        ]);
        
        switch (auth()->user()->UserLevelID) {
            case '3':
         $shortcode = Shortcode::where('CellCode',auth()->user()->CellID);
                break;
            case '2':
         $shortcode = Shortcode::where('DistrictID',auth()->user()->DistrictID);
                break;
            case '1':
          $shortcode = Shortcode::where('AreaID',auth()->user()->AreaID);
                break;
            case '4':
         $shortcode = Shortcode::where('NationalID',auth()->user()->NationalID);
                break;
            
            default:
                # code...
                break;
        }
        if ($shortcode->exists()) {
            $shortcode = $shortcode->first();
            $shortcode->shortcode = $request->shortcode;
            $shortcode->save();
            \Session::flash('message','Shortcode Updated');
        }else{
              $shortcode = new Shortcode;
            $shortcode->shortcode = $request->shortcode;
             switch (auth()->user()->UserLevelID) {
            case '3':
          $shortcode->CellCode = auth()->user()->CellID;
                break;
            case '2':
          $shortcode->DistrictID = auth()->user()->DistrictID;
                break;
            case '1':
          $shortcode->AreaID = auth()->user()->AreaID;
                break;
            case '4':
          $shortcode->NationalID = auth()->user()->NationalID;
                break;
            
            default:
                # code...
                break;
        }
          
            $shortcode->save();
            \Session::flash('message','Shortcode Added');
        }
        return redirect('/');
    }

    public function smsbalance(){
         $client = new Client();
         
           switch (auth()->user()->UserLevelID) {
            case '3':
          $branchcode = auth()->user()->CellID;
         
                break;
            case '2':
          $branchcode = Branchcode::where('DistrictID',auth()->user()->DistrictID)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            case '1':
          $branchcode = Branchcode::where('AreaID',auth()->user()->AreaID)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            case '4':
          $branchcode = Branchcode::where('NationalID',auth()->user()->SchoolCode)->first();
          $branchcode = $branchcode ? $branchcode->branchcode : "0";
                break;
            
            default:
             return "unauthorised";
                break;
        }//dd($branchcode);
        //$url = "http://3csms.3cprojects.org/checksmscreditbalance/" . $branchcode;
      //  dd(Assembly::where('AssemblyCode',auth()->user()->CellID)->first());
        $apiresponse = $client->request('GET',"http://3csms.3cprojects.org/checksmscreditbalance/{$branchcode}");
      //  dd($apiresponse->getBody()->getContents());
        $balance = $apiresponse->getBody()->getContents();
        return view('sms.smsbalance',compact('balance'));
    }
    
    public function branchcode(){
        switch (auth()->user()->UserLevelID) {
            case '3':
          $branchcode = (object)['branchcode' => auth()->user()->CellID];
                break;
            case '2':
          $branchcode = Branchcode::where('DistrictID',auth()->user()->DistrictID)->first();
                break;
            case '1':
          $branchcode = Branchcode::where('AreaID',auth()->user()->AreaID)->first();
                break;
            case '4':
          $branchcode = Branchcode::where('NationalID',auth()->user()->NationalID)->first();
                break;
            
            default:
                # code...
                break;
        }
      //  dd($branchcode);
        if (empty($branchcode)) {
            $branchcode = new Branchcode;
            switch (auth()->user()->UserLevelID) {
                case '1':
                $branchcode->AreaID =  auth()->user()->AreaID;
                $branchcode->branchcode = "A" . auth()->user()->AreaID;
                    break;
                case '2':
                $branchcode->DistrictID = auth()->user()->DistrictID;
                $branchcode->branchcode = "D" . auth()->user()->DistrictID;
                    break;
                case '4':
                $branchcode->NationalID =  auth()->user()->NationalID;
                $branchcode->branchcode = "N" . auth()->user()->NationalID;
                    break;
                
                default:
                    # code...
                    break;
            }
            $branchcode->save();
        }
        if (!empty($branchcode)) {
            $branchcode = $branchcode->branchcode;
        }
        return view ('sms.branchcode',compact('branchcode'));
    }
}
