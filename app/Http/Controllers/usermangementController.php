<?php
namespace App\Http\Controllers;
use Validator;
use Redirect;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\usermangementController;
use App\Models\usermanagement;
use Illuminate\Support\Facades\Input;
use App\Models\UserLevel;
use App\models\userstate;
use App\Models\District;
use App\Models\Designation;
class usermangementController extends Controller
{
	
	
public $userlevel;
public $userstate;
public $District;
public $Designation;
public $Area;
public $Category;

private $rules=[
	'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            			'PhoneNo'=>'required',
						'UserLevelID'=>'required',
						'Userstatus'=>'required',
						 'AreaID'=>'required',
						 'CellID'=>'required',
						// 'NationalID'=>'required',
						 'DistrictID'=>'required',];
 private $messages=[
						 'AreaID.required'=>'The Area field is required.',
						 'DistrictID.required'=>'The Zone field is required.',];
private	$passrules = [
          'oldpassword'=> 'required|string|min:8',
                    'password'=>'required|string|min:8',
                    'password_confirmation'=>'required|same:password',];

    

    
    public function __construct(){
		

    	$this->middleware('auth');
		
	//$this->userlevel = \App\Models\UserLevel::orderBy('UserLevel')->lists('UserLevel','UserLevelID');
$this->userstate =\App\Models\userstate::orderBy('Userstatus')->lists('Userstatus','id');
//$this->District =\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');

//$this->Cell = \App\Models\Assembly::orderBy('AssemblyName')->lists('AssemblyName','AssemblyID');

$this->National = \App\National::orderBy('NationalName')->lists('NationalName','NationalID');
switch (auth()->user()->UserLevelID) {
	// case '1':
	// $this->userlevel = \App\Models\UserLevel::orderBy('UserLevel')->where('area',1)->lists('UserLevel','UserLevelID');
	// $this->Area = \App\Models\Area::where('AreaID',auth()->user()->AreaID)->orderBy('AreaName')->lists('AreaName','AreaID');
	
	// $this->District =\App\Models\District::where('AreaID',auth()->user()->AreaID)->orderBy('DistrictName')->lists('DistrictName','DistrictID');
	// $districts =\App\Models\District::where('AreaID',auth()->user()->AreaID)->orderBy('DistrictName')->lists('DistrictID');
	// $this->Cell = \App\Models\Assembly::whereIn('DistrictID',$districts)->orderBy('AssemblyName')->lists('AssemblyName','AssemblyID');
	// 	break;
		
	// case '4':
	// $this->userlevel = \App\Models\UserLevel::orderBy('UserLevel')->where('national',1)->lists('UserLevel','UserLevelID');
	// $this->Area = \App\Models\Area::where('NationalID',auth()->user()->NationalID)->orderBy('AreaName')->lists('AreaName','AreaID');
	// $areas = \App\Models\Area::where('NationalID',auth()->user()->NationalID)->orderBy('AreaName')->lists('AreaID');
	// $this->District =\App\Models\District::whereIn('AreaID',$areas)->orderBy('DistrictName')->lists('DistrictName','DistrictID');
	// $districts =\App\Models\District::orderBy('DistrictName')->lists('DistrictID');
	// $this->Cell = \App\Models\Assembly::whereIn('DistrictID',$districts)->orderBy('AssemblyName')->lists('AssemblyName','AssemblyID');
	// 	break;
	// case '10':
	// $this->userlevel = \App\Models\UserLevel::orderBy('UserLevel')->lists('UserLevel','UserLevelID');
	// $this->Area = \App\Models\Area::orderBy('AreaName')->lists('AreaName','AreaID');
	// $this->District =\App\Models\District::orderBy('DistrictName')->lists('DistrictName','DistrictID');
	// $this->Cell = \App\Models\Assembly::orderBy('AssemblyName')->lists('AssemblyName','AssemblyID');
	// 	break;
	
	default:
	$this->userlevel = [];
		break;
}
    }


    public function index(){


    	switch (auth()->user()->UserLevelID) {


    		case '1':
    		$rows = \App\Models\usermanagement::where('AreaID',auth()->user()->AreaID)->paginate(15);
    			break;
    		case '4':
    		$rows = \App\Models\usermanagement::where('NationalID',auth()->user()->NationalID)->paginate(15);
    			break;
    		case '10':
    		$rows = \App\Models\usermanagement::paginate(15);
    			break;
    		default:
    			$rows = [];
    			break;
    	}
  
    	return view('usermanagement.list')->with(compact('rows'));
    	
	}
	
	public function create(){

$UserLevelID=$this->userlevel;
$Userstatus = $this->userstate;
$District = $this->District;
$Area = $this->Area;
$Cell = $this->Cell;
$National = $this->National;


		return view('usermanagement.create')->with(compact('UserLevelID','Userstatus','District','Area','Cell','National'));
		
	}
	
	public function store(Request $request){
		 
		$userFormData=$request->all();

		$validation = Validator::make($userFormData,$this->rules,$this->messages);
		
		if($validation->passes()){
		//dd($request);
		  $user = new usermanagement();
		   $password=$request->password;
		$user->name=$request->name;
		$user->email=$request->email;
		$user->PhoneNo=$request->PhoneNo;
		$user->password=bcrypt($password);
		$user->UserLevelID=$request->UserLevelID;
		$user->Userstatus=$request->Userstatus;
		$user->AreaID=$request->AreaID ?: auth()->user()->AreaID;
		if (auth()->user()->UserLevelID == 10) {
			$user->NationalID=$request->NationalID;
			$user->bannerimg= "banner.jpeg";
		}else{
			$user->NationalID=auth()->user()->NationalID;
			$user->bannerimg=auth()->user()->bannerimg;
		}
		$user->CellID=\App\Models\Assembly::find($request->CellID)->AssemblyCode;
		$user->DistrictID=$request->DistrictID;
         $user->save();
        
        return redirect('usermangement');
		}
		//dd($validation);
		 return redirect('usermangement/create')
        ->withInput()
        ->withErrors($validation);
			
		}

		public function show($id){
			$District=$this->District;
          
			$UserLevelID=$this->userlevel;
            $Userstatus=$this->userstate;
            $Area = $this->Area;
            $Cell = $this->Cell;
            $National = $this->National;
			$rows = \App\Models\usermanagement::find($id);

			if(is_null($rows)){

				Session_flash('message','Records could not be found');
				Session_flash('alert-class','alert-warning');
				return redirect('usermangement.index');
			}
			return view('usermanagement.show')->with(compact('rows','UserLevelID','Userstatus','District','Area','Cell','National'));

		}

		
		public function edit($id){
			$UserLevelID=$this->userlevel;
			$Userstatus=$this->userstate;
			$District=$this->District;
			$Area = $this->Area;
			$Cell = $this->Cell;
			$National = $this->National;
			$rows=\App\Models\usermanagement::find($id);

          if(is_null($rows)){
			Session_flash('message','Data could not be found');
			Session_flash('alert-class','alert-warning');

		}
		
		return view('usermanagement.edit')->with(compact('rows','UserLevelID','Userstatus','District','Area','Cell','National'));
	}
	public function update(Request $request, $id){

		$validator = Validator::make($request->all(),$this->rules,$this->messages);
		if($validator->passes()){
		$data=usermanagement::find($id);
		$data->name=$request->name;
		$data->email=$request->email;
		$data->PhoneNo=$request->PhoneNo;
		$data->UserLevelID=$request->UserLevelID;
        $data->Userstatus=$request->Userstatus;
		$data->AreaID=$request->AreaID;
		if (auth()->user()->UserLevelID == 10) {
			$data->NationalID=$request->NationalID;
		}else{
			$data->NationalID=auth()->user()->NationalID;
		}
		$data->CellID=\App\Models\Assembly::find($request->CellID)->AssemblyCode;
		$data->DistrictID=$request->DistrictID;
		$data->save();

		\Session::flash('message','Data is Updated');
		\Session::flash('alert-class','alert-success');
	return redirect('usermangement');
}
return \Redirect::route('usermangement.edit',$id)->withErrors($validator)->withInput()
->with('message', 'There were validation errors.');;


	}
	public function destroy($id){
		$rows = \App\Models\usermanagement::find($id)->delete();
		return redirect('usermangement');
		
		
	}
	public function search(){
		$search =Input::get('quicksearch');
		$rows =\App\Models\usermanagement::orderBY('id','desc')->where('name','LIKE',"%$search%")->paginate(10);
		return view('usermanagement.list')->with(compact('rows'));
		
		
		
	}
	
 public function changepassword(){

	return view('usermanagement.resetpassword');	
	}
	
	public function passwordchangeprocess(Request $request){

		$datainput = $request->all();
		$validation = Validator::make($datainput,$this->passrules);
	if($validation->passes()){	
	   $id=Auth::user()->id;
	   $data=usermanagement::find($id);
	if(Hash::check($request->oldpassword,$data->password)){
		
		if($request->password == $request->password_confirmation){
			$password=$request->password;
			$data->password=bcrypt($password);
			$data->save();
			\Session::flash('message','Password is updated');
		\Session::flash('alert-class','alert-success');
	return redirect('logout');
		}
		else{
			\Session::flash('message','New password and Confirm password did not match');
				\Session::flash('alert-class','alert-warning');
				return redirect('resetpassword');
		}
	
	}
		
	else{
		
		\Session::flash('message','Current Password Is Incorrect');
				\Session::flash('alert-class','alert-warning');
				return redirect('resetpassword');
	}
		
	
		}
	else{
		return redirect('resetpassword')->withErrors($validation)->withInput();
	}
	} 
}
