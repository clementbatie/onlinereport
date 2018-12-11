<?php

namespace App\Http\Controllers;

use App\Branchcode;
use App\Dues;
use App\Http\Requests;
use App\Member;
use App\Models\Area;
use App\Models\Assembly;
use App\Models\District;
use App\Models\Finance;
use App\Shortcode;
use App\Topic;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;

class AssemblyController extends Controller
{
    

    
    private  $rules =   [
          'AssemblyName'=>'required',
		
           'DistrictID'=>'required', 
           'Location'=>'required', 
           'TagCode'=>'required', 
           'Locality'=>'required', 
           'Meeting_time'=>'required', 
           'Owner'=>'required', 
		   'Owner_contact'=>'required', 
             
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
       // dd();
        switch (auth()->user()->UserLevelID) {
            case '1':
            $district = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
            $rows=\App\Models\Assembly::whereIn('DistrictID',$district)->orderBy('AssemblyName')->paginate(15);
         //   dd($rows);
                break;
            case '4':
            $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $district = District::whereIn('AreaID',$area)->lists('DistrictID');
            $rows=\App\Models\Assembly::whereIn('DistrictID',$district)->orderBy('AssemblyName')->paginate(15);
                break;
            
            default:
                # code...
                break;
        }
        
        return view('Assembly.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

	 $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
     switch (auth()->user()->UserLevelID) {
            case '1':
     $district=\App\Models\District::where('AreaID',auth()->user()->AreaID)->orderBy('DistrictName')->lists('DistrictName','DistrictID');
         //   dd($rows);
                break;
            case '4':
            $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
         $district=\App\Models\District::whereIn('AreaID',$area)->orderBy('DistrictName')->lists('DistrictName','DistrictID');   
                break;
            
            default:
          $district= [];   
                break;
        }
      
      return view('Assembly.create')->with(compact('district'));
     
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
  
        $data = new Assembly();
        $data->AssemblyName=$request->AssemblyName;
		$data->AssemblyCode= "abc"; 
			$data->DistrictID= $request->DistrictID;
            $data->Location= $request->Location;
            $data->TagCode= $request->TagCode;
            $data->Locality= $request->Locality;
            $data->Meeting_time= $request->Meeting_time;
            $data->Owner= $request->Owner;
            $data->Owner_contact= $request->Owner_contact;
 
		$data->id=auth()->user()->id;         
        $data->save();

        if (Assembly::where('AssemblyCode',$data->AssemblyID)->exists()) {
           $data->AssemblyCode = "C".$data->AssemblyID.$data->AssemblyID;;
        }else{
            $data->AssemblyCode = "C".$data->AssemblyID;
        }
        
        $data->save();
        Session::flash('message','Save Successful');
        return redirect('Assembly');

    }
    
    return redirect('Assembly/create')
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
	 $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');

          $rows=\App\Models\Assembly::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Assembly.index');
          }

        
      
      return view('Assembly.show')->with(compact('rows','district'));           
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
	
    {
	 $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');

        $rows=\App\Models\Assembly::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Assembly.index');
          }
        
          return view('Assembly.edit')->with(compact('rows','district'));
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
        $data=Assembly::find($id);
        $data->AssemblyName=$request->AssemblyName;
		
	    $data->DistrictID= $request->DistrictID;
        $data->Location= $request->Location;
        $data->TagCode= $request->TagCode;
        $data->Locality= $request->Locality;
        $data->Meeting_time= $request->Meeting_time;
        $data->Owner= $request->Owner;
        $data->Owner_contact= $request->Owner_contact;

		$data->id=auth()->user()->id;         
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('Assembly');

    }
    
    return \Redirect::route('Assembly.edit', $id)  
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
    {   Assembly::find($id)->delete();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Assembly');
    }
     public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\Models\Assembly::orderBy('AssemblyID', 'desc')
            ->where('AssemblyName','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('Assembly.list')->with(compact('rows'));
            

            
    }

    public function submitstats(){
         $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
        $rwstate = false;
        $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->
        where('IndicatorType','S')->lists('Indicators','Indicators');
       // $rows=\App\Models\Assembly::find(1);
        return view('Assembly.submitstat',compact('indicators','district','rows','rwstate'));
    }

    public function submitstatssave(Request $request){

        $formdata = Input::get('data');
       foreach ($formdata['data'] as $value) {
           $obj = (object)$value;
         //  return $formdata['data'];
          if ($obj->indicators == "Topic") {
             $output = Topic::where('AssemblyID',auth()->user()->CellID)->where('date',$obj->date);
             if ($output->exists()) {
            $output = $output->first();
            $message = "The following details already exists \n\nTopic: ". $output->topic . "\nFacilitator: " .$output->facilitator . "\nDate: " . $output->date . "\n\n";
            return response()->json([
                'message' => "exists",
                'details' => $message
            ]);
           }
          }else{

             $output = Finance::where('AssemblyID',auth()->user()->CellID)->where('Indicators',$obj->indicators)->where('date',$obj->date);
                 if ($output->exists()) {
                   $output = $output->first();
                  $message = "The following details already exists \n\nIndicator: ". $output->Indicators . "\nValue: " .$output->IndValues . "      \nDate: " . $output->date . "\n\n";
                  return response()->json([
                'message' => "exists",
                'details' => $message
                ]);                
                }
             }
        }

        /*save the data*/
        foreach ($formdata['data'] as $value) {
             
             if ($value['indicators'] == "Topic") {
                 $data = new Topic;
                 $data->topic = $value['topic'];
                 $data->AssemblyID = auth()->user()->CellID;
                 $data->comments = $value['comments'];
                 $data->facilitator = $value['facilitator'];
                 $data->date = $value['date'];
                 $data->save();
            }else{
        $data = new \App\Models\Finance;
        $data->AssemblyID = auth()->user()->CellID;
        $data->Indicators = $value['indicators'];
        $data->IndicatorType = "S";
        $data->IndValues = $value['amount'];
        $data->UserName = auth()->user()->id;
        $data->ReviewerID = 0;
        $data->id = 000;
        $data->Activity_State = 0;
        $data->date = $value['date'];
        $data->flag = NULL;
        $data->accountcode = 33;
        $data->accountsubcode = 33;
        $data->save();
            }
        }
        return response()->json([
            'message' => 'correct',
        ]);
      
    }

    public function submitstatsautosave(Request $request){

        $formdata = Input::get('data');
       
       foreach ($formdata['data'] as $value) {
           $obj = (object)$value;
          // return $formdata['data'];
          if ($obj->indicators == "Topic") {
             $output = Topic::where('AssemblyID',auth()->user()->CellID)->where('date',$obj->date);
             if ($output->exists()) {
            $output = $output->first();
            $message = "The following details already exists \n\nTopic: ". $output->topic . "\nFacilitator: " .$output->facilitator . "\nDate: " . $output->date . "\n\n";
            return response()->json([
                'message' => "exists",
                'details' => $message
            ]);
           }
          }else{

             $output = Finance::where('AssemblyID',auth()->user()->CellID)->where('Indicators',$obj->indicators)->where('date',$obj->date);
                 if ($output->exists()) {
                   $output = $output->first();
                  $message = "The following details already exists \n\nIndicator: ". $output->Indicators . "\nValue: " .$output->IndValues . "      \nDate: " . $output->date . "\n\n";
                  return response()->json([
                'message' => "exists",
                'details' => $message
                ]);                
                }
             }
        }

        /*save the data*/
        foreach ($formdata['data'] as $value) {
             
             if ($value['indicators'] == "Topic") {
                 $data = new Topic;
                 $data->topic = $value['topic'];
                 $data->AssemblyID = auth()->user()->CellID;
                 $data->comments = $value['comments'];
                 $data->facilitator = $value['facilitator'];
                 $data->date = $value['date'];
                 $data->save();
            }else{
        $data = new \App\Models\Finance;
        $data->AssemblyID = auth()->user()->CellID;
        $data->Indicators = $value['indicators'];
        $data->IndicatorType = "S";
        $data->IndValues = $value['amount'];
        $data->UserName = auth()->user()->id;
        $data->ReviewerID = 0;
        $data->id = 000;
        $data->Activity_State = 0;
        $data->date = $value['date'];
        $data->flag = NULL;
        $data->accountcode = 33;
        $data->accountsubcode = 33;
        $data->save();
            }
        }
        return response()->json([
            'message' => 'correct',
        ]);
      
    }

    public function verifysubmitstats(Request $request){
        $formdata = $request->data;
        foreach ($formdata['data'] as $value) {
           $obj = (object)$value;
         //  return $formdata['data'];
          if ($obj->indicators == "Topic") {
             $output = Topic::where('AssemblyID',auth()->user()->CellID)->where('date',$obj->date);
             if ($output->exists()) {
            $output = $output->first();
            $message = "The following details already exists \n\nTopic: ". $output->topic . "\nFacilitator: " .$output->facilitator . "\nDate: " . $output->date . "\n\n";
            return $message;
           }else{
            return "2";
           }
          }else{
             $output = Finance::where('AssemblyID',auth()->user()->CellID)->where('Indicators',$obj->indicators)->where('date',$obj->date);
           if ($output->exists()) {
            $output = $output->first();
            $message = "The following details already exists \n\nIndicator: ". $output->Indicators . "\nValue: " .$output->IndValues . "\nDate: " . $output->date . "\n\n";
            return $message;
           }else{
            return "2";
           }
          }
        }
        return "";
    }
     public function submitfinance(){
         $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
      
       $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->
        where('IndicatorType','F')->lists('Indicators','Indicators');
       $ie = \App\Incomeexp::lists('type','type');
       $incomelabels =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->where('FinanceType','I')->lists('Indicators','Indicators');
       
      // dd();
        $incomelabels = str_replace("{",'{ "":"",',$incomelabels);
       $explabels =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->where('FinanceType','E')->lists('Indicators','Indicators');
      $explabels = str_replace("{",'{ "":"",',$explabels);
        return view('Assembly.submitfinance',compact('indicators','district','rows','ie','incomelabels','explabels'));
    }

     public function submitfinancesave(Request $request){
      

        $formdata = Input::get('data');
            foreach ($formdata as $value) {
                switch ($value["ie"]) {
            case 'income':
               $a = "I";
                break;
            case 'expense':
               $a = "E";
                break;
            
            default:
               $a = "I";
                break;
        }// end switch
        if ($value['indicators'] == "Donation") {
            $item =Finance::where('Indicators',$value['indicators'])->
            where('IndicatorType',"F")->where('date',$value['date'])->
            where('AssemblyID',auth()->user()->CellID);
            if ($item->exists()) {
                $output = $item->first();
                $message = "The following details already exists \n\nIndicator: ". $output->Indicators . "\nValue: " .$output->IndValues . "\nDate: " . $output->date . "\n\n";
                return response()->json([
                     'message' => 'donationexists',
                     'details' => $message   
                ]);
            }
        }
        
        if ($value['indicators'] == "Offering") {
            $item =Finance::where('Indicators',$value['indicators'])->
            where('IndicatorType',"F")->where('date',$value['date'])->
            where('AssemblyID',auth()->user()->CellID);
            if ($item->exists()) {
                $output = $item->first();
                $message = "The following details already exists \n\nIndicator: ". $output->Indicators . "\nValue: " .$output->IndValues . "\nDate: " . $output->date . "\n\n";
                return response()->json([
                     'message' => 'exists',
                     'details' => $message   
                ]);
            }
        }
          /*  if ($item->exists()) {
                $output = $item->first();
                $message = "The following details already exists \n\nIndicator: ". $output->Indicators . "\nValue: " .$output->IndValues . "\nDate: " . $output->date . "\n\n";
                return response()->json([
                     'message' => 'exists',
                     'details' => $message   
                ]);
            }*/
          //  return $item->get();
            }
        foreach ($formdata as $value) {
            switch ($value["ie"]) {
            case 'income':
               $a = "I";
                break;
            case 'expense':
               $a = "E";
                break;
            
            default:
               $a = "I";
                break;
        }
            $data = new \App\Models\Finance;
        $data->AssemblyID = auth()->user()->CellID;
        $data->Indicators = $value['indicators'];
        $data->IndicatorType = "F";
        $data->IndValues = $value['amount'];
        $data->UserName = auth()->user()->id;
        $data->ReviewerID = 0;
        $data->id = 000;
        $data->Activity_State = 0;
        $data->date = $value['date'];
        $data->flag = $a;
        $data->comments = $value['comments'];
        $data->accountcode = 33;
        $data->accountsubcode = 33;
        $data->save();
        }
         return response()->json(['message' => 'correct'         
                ]);        
     }


     public function submitfinancedonationsave(Request $request){
      

        $formdata = Input::get('data');
            foreach ($formdata as $value) {
                switch ($value["ie"]) {
            case 'income':
               $a = "I";
                break;
            case 'expense':
               $a = "E";
                break;
            
            default:
               $a = "I";
                break;
        }// end switch
        
        
        if ($value['indicators'] == "Offering") {
            $item =Finance::where('Indicators',$value['indicators'])->
            where('IndicatorType',"F")->where('date',$value['date'])->
            where('AssemblyID',auth()->user()->CellID);
            if ($item->exists()) {
                $output = $item->first();
                $message = "The following details already exists \n\nIndicator: ". $output->Indicators . "\nValue: " .$output->IndValues . "\nDate: " . $output->date . "\n\n";
                return response()->json([
                     'message' => 'exists',
                     'details' => $message   
                ]);
            }
        }
          /*  if ($item->exists()) {
                $output = $item->first();
                $message = "The following details already exists \n\nIndicator: ". $output->Indicators . "\nValue: " .$output->IndValues . "\nDate: " . $output->date . "\n\n";
                return response()->json([
                     'message' => 'exists',
                     'details' => $message   
                ]);
            }*/
          //  return $item->get();
            }
        foreach ($formdata as $value) {
            switch ($value["ie"]) {
            case 'income':
               $a = "I";
                break;
            case 'expense':
               $a = "E";
                break;
            
            default:
               $a = "I";
                break;
        }
            $data = new \App\Models\Finance;
        $data->AssemblyID = auth()->user()->CellID;
        $data->Indicators = $value['indicators'];
        $data->IndicatorType = "F";
        $data->IndValues = $value['amount'];
        $data->UserName = auth()->user()->id;
        $data->ReviewerID = 0;
        $data->id = 000;
        $data->Activity_State = 0;
        $data->date = $value['date'];
        $data->flag = $a;
        $data->comments = $value['comments'];
        $data->accountcode = 33;
        $data->accountsubcode = 33;
        $data->save();
        }
         return response()->json(['message' => 'correct'         
                ]);        
     }


    public function submitstatsdata(){
         $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
        $rwstate = false;
        $indicators =\App\Indicator::orderBy('Indicators')->Distinct('Indicators')->
        where('IndicatorType','D')->lists('Indicators','Indicators');
       // $rows=\App\Models\Assembly::find(1);
        return view('Assembly.submitstatsdata',compact('indicators','district','rows','rwstate'));
    }

    public function submitstatsdatasave(Request $request){
        $formdata = Input::get('data');
               
        foreach ($formdata as $value) {
            
                 $data = new \App\Models\Finance;
        $data->AssemblyID = auth()->user()->CellID;
        $data->Indicators = $value['indicators'];
        $data->IndicatorType = "D";
        $data->IndValues = $value['amount'];
        $data->UserName = auth()->user()->id;
        $data->ReviewerID = 0;
        $data->id = 000;
        $data->Activity_State = 1;
        $data->date = $value['date'];
        $data->flag = NULL;
        $data->accountcode = 33;
        $data->accountsubcode = 33;
        $data->save();
            
       
        }
        return $formdata;
       
    }

    public function split(){
         $district=\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
         $assemblies=\App\Models\Assembly::orderBy('AssemblyName')->lists('AssemblyName','AssemblyID');

      $rwstate = false;
      return view('Assembly.split')->with(compact('district','assemblies','rwstate'));
    }

    public function splitsave(Request $request){
        $this->validate($request,[
            'AssemblyName'=>'required',
          'AssemblyCode'=>'required', 
           'DistrictID'=>'required', 
           'Location'=>'required', 
           'split'=>'required|string', 
       ]);

         $data = new Assembly();
        $data->AssemblyName=$request->AssemblyName;
        $data->AssemblyCode=$request->AssemblyCode; 
         $data->DistrictID= $request->DistrictID;
         $data->Location= $request->Location;
         $data->ParentID= $request->split;
        /*calculate TagCode*/
        $parenttagcode = Assembly::find($request->split)->TagCode;
        $laststring = substr($parenttagcode, -1);
        if (is_numeric($laststring)) {
            $azrange = range("A", "Z");
            foreach ($azrange as $value) {
               // dd(44);
                 $childtag = $parenttagcode . $value;
             //   dd($childtag);
                if (!Assembly::where("TagCode",$childtag)->exists()) {
                    break;
                }
            }
        }else{
            $azrange = range(1,20);
            foreach ($azrange as $value) {
               // dd(44);
                 $childtag = $parenttagcode . $value;
             //   dd($childtag);
                if (!Assembly::where("TagCode",$childtag)->exists()) {
                    break;
                }
            }
        }
       
        $data->TagCode = $childtag;       
        /*end of tagcode algo*/
        $data->id=auth()->user()->id;         
        $data->save();
        \Session::flash('message','Split Successful');
        return redirect('Assembly');
        
    }

    
    public function dues(){
        $members = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
        return view('Assembly.dues',compact('members'));
    }

    public function log(Request $request){
        return $request->fullUrl();
    }

     public function billduesall(Request $request)
    {
        $formdata = Input::get('data');
        $ob = (object)$formdata['data'][0];
        
        $members = Member::where('CellCode',auth()->user()->CellID)->lists('id');
        foreach ($members as $member) {
            $dues = new Dues;
            $dues->Dues_Date = $ob->date;
            $dues->Dues_Type = "type here";
            $dues->Dues_Amount = $ob->amount;
            $dues->Narration = $ob->comments;
            $dues->Member_ID = $member;
            $dues->Entry_date = Carbon::now();
            $dues->Entry_user = auth()->user()->id;
            $dues->save();
        }
       
       return response()->json([
            'message' => 'correct'
       ]);
    }

    public function billdues(Request $request)
    {
        $formdata = Input::get('data');
       // $ob = (object)$formdata['data'];

        foreach ($formdata['data'] as $member) {
           // return $member;
            $ob = (object)$member;
            $dues = new Dues;
            $dues->Dues_Date = $ob->date;
            $dues->Dues_Type = "type here";
            $dues->Dues_Amount = $ob->amount;
            $dues->Narration = $ob->comments;
            $dues->Member_ID = $ob->member;
            $dues->Entry_date = Carbon::now();
            $dues->Entry_user = auth()->user()->id;
            $dues->save();
        }
       
       return response()->json([
            'message' => 'correct'
       ]);
    }

     public function duespayment(){
        $members = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
        return view('Assembly.duespayment',compact('members'));
    }

    public function duespaymentsave(Request $request)
    {
        $formdata = Input::get('data');
       // $ob = (object)$formdata['data'];
        return  [];
        foreach ($formdata['data'] as $member) {
           // return $member;
            $ob = (object)$member;
            $dues = new Dues;
            $dues->Dues_Date = $ob->date;
            $dues->Dues_Type = "type here";
            $dues->Dues_Amount = $ob->amount;
            $dues->Narration = $ob->comments;
            $dues->Member_ID = $ob->member;
            $dues->Entry_date = Carbon::now();
            $dues->Entry_user = auth()->user()->id;
            $dues->save();
        }
       
       return response()->json([
            'message' => 'correct'
       ]);
    }
}