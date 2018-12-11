<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Student;
Use App\User;
use Illuminate\Support\Str;

use Session;

class FileController extends Controller
{
	public function file_import_export()
	{
        return view('Excel.fileImport');
	}

    public function importExportExcelORCSV(){
		        return view('Excel.fileImport');
		    }

	public function importFileIntoDB(Request $request){

		        if($request->hasFile('sample_file')){
		            $path = $request->file('sample_file')->getRealPath();
		            $data = \Excel::load($path)->get();
		            //dd($data);
		            if($data->count()){
		                foreach ($data as $key => $value) {

		                	// $extract = $value->classid;
		                	// dd($extract);



                            $randomNum = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,5);

                $checkUniqueCode = Student::where('UniqueCode',$randomNum)->where('SchoolCode',auth()->user()->SchoolCode);

                if ($checkUniqueCode->exists()) 
                 {
                 	 $randomNum = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"),0,5);
                 }
             
                $checkUniqueCodeAgain = Student::where('UniqueCode',$randomNum)->where('SchoolCode',auth()->user()->SchoolCode);

                if ($checkUniqueCodeAgain->exists()) 
                 {
                 	 $randomNum = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"),0,6);
                 }

		                    $arr[] = ['UniqueCode'=>$randomNum,'StudentName' => $value->studentname, 'Gender'=>$value->gender,'DOB'=>$value->dob,'ParentName' => $value->parentname, 'ParentNumber'=>$value->parentnumber,'ClassID'=>$value->classid,'SchoolCode'=>$value->schoolcode, 'Year'=>$value->year, 'Term'=>$value->term];


								 $name = $value->studentname; 
							     $combinenames = str_replace(' ', '', $name);
					           //dd($combinenames);
					            
					            $lowercase = Str::lower($combinenames);          
                    
					           $member2 = new User;
					           $member2->name  = $value->studentname; 
					           $member2->Class = $value->classid;
					           $member2->UniqueCode = $randomNum;
					           // $member2->Class = $value->classnameID;
					           $member2->password = bcrypt('password');
					           $member2->status = 1;
					           $member2->UserLevelID = 3;
					           $member2->Userstatus = 1;
					           $member2->email = $lowercase.'@abc.com';
					           $member2->SchoolCode  = $value->schoolcode;
					           $member2->save();
		                }
		                if(!empty($arr)){
		                    \DB::table('students')->insert($arr);
		                    // dd('Insert Record successfully.');
		                    // $Student = new Student();

		                    // $Student->EntryUser = auth()->user()->UserLevelID;

		                    // $Student->save();

		                    $AA = "Students Uploaded Successfully";
		                    Session::flash('message',$AA);

                            return redirect('excelfileupload'); 
		                }
		            }
		        }
		        // dd('Request data does not have any files to import.');  

		        Session::flash('message','No Files To Import, Please Select A File');
              return redirect('excelfileupload');    
		    } 

		    public function downloadExcelFile($type){
		        $products = Student::get()->toArray();
		        return \Excel::create('expertphp_demo', function($excel) use ($products) {
		            $excel->sheet('sheet name', function($sheet) use ($products)
		            {
		                $sheet->fromArray($products);
		            });
		        })->download($type);
		    }      
		

}
