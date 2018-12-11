<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Student;
use App\Parents;
use App\classes;
use App\setupparent;
use App\year_term_setup;
use App\testing;
use Illuminate\Support\Str;
use App\User;

use Session;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows = Student::where('students.SchoolCode',auth()->user()->SchoolCode)->leftjoin('classes','students.ClassID','=','classes.ClassID')->select('students.*','classes.ClassName')->paginate(15);
//dd($rows);
        //$stu = Student::where('StudentName','Clem')->lists('ImageType');
         
        // $randomNum = substr(str_shuffle("0123456789qwertyuiopasdfghjklzxcvbnm"),0,5);
        // dd($randomNum);
 
        return view('Student.list', compact('rows','stu','getYear','getTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $stu = Student::where('StudentName','yyy')->lists('ImageType');
          
        // dd($stu);

         $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','year_term_setups.Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('terms.TermName','year_term_setups.TermID');

        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

        $Parent = setupparent::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SetupParentID');
        return view('Student.create', compact('Class','Parent','Year','Term','stu','getYear','getTerm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $image = Input::file('file');
//dd($image);
      $arr = array();

        $data = (object)$request->data;
            
            $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermID;

        $getYear = $Year[0]->Year;

            foreach ($data->data as $value) {
           
           $value = (object)$value;
           $path = $value->imgInp;
           $length = strlen("C:\fakepath");

           $substract = substr($path, $length, strlen($path)-$length);

           $length2 = strlen("h\n");
           $substract2 = substr($substract, $length2, strlen($substract)-$length2);

           $randomNum = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,5);
          // dd($substract2);
           // $arr[] = $substract2;

           //  $arr = base64_decode($substract2);
           // dd($arr);
            // $fp = fopen('/Applications/XAMPP/xamppfiles/htdocs/terminalreport_green/public/uploads/','wb+');
            // fwrite($fp, $substract2);
            // fclose($fp);


            // $arr2 = public_path()."/uploads/".$substract2;
            // dd($arr2);
            // file_put_contents($arr2, $substract2);




           //$substract2=move('uploads');

               // if($path) {
               //  var_dump($value->getRealPath());
               //  $filename = $path->getClientOriginalName();
               //  }
                
      ///////////////////////
           $member = new Student;
           $member->StudentName  = $value->studentnames; 
           $member->Gender = $value->gender;
           $member->DOB = $value->dob;
           $member->ClassID = $value->classnameID;
           $member->ParentName = $value->parentname;
           $member->Year  = $getYear;
           $member->Term  = $getTerm;
           $member->ParentNumber  = $value->parentnumber;
           $member->SchoolCode  = auth()->user()->SchoolCode;
           // $member->ImageType = $substract2;
           $member->UniqueCode = $randomNum;

           $member->ImageType = $substract2;
           
            switch (auth()->user()->UserLevelID) {
            case '1':
              $member->EntryUser = auth()->user()->UserLevelID;
                break;
             case '3':
              $member->EntryUser = auth()->user()->UserLevelID;
              //$meeting->NationalID = auth()->user()->NationalID;
                break;
                case '4':
              $member->EntryUser = auth()->user()->UserLevelID;
              //$meeting->NationalID = auth()->user()->NationalID;
                break;
            default:
            break;   
          }

            $member->save();


     $name = $value->studentnames; 
     $combinenames = str_replace(' ', '', $name);

$lowercase =Str::lower($combinenames);
//dd($FF);
         

           $member2 = new User;
           $member2->name  = $value->studentnames; 
           $member2->Class = $value->classnameID;
           $member2->UniqueCode = $randomNum;
           // $member2->Class = $value->classnameID;
           $member2->password = bcrypt('password');
           $member2->status = 1;
           $member2->UserLevelID = 3;
           $member2->Userstatus = 1;
           $member2->email = $lowercase.'@abc.com';
           $member2->SchoolCode  = auth()->user()->SchoolCode;
           $member2->save();

/////////////////

         // $member = new Student([
         //    'StudentName' => $value->studentnames;
         //    'Gender' => $value->gender;
         //    'DOB' => $value->dob;
         //    'ClassID' => $value->classnameID;
         //    'ParentName' => $value->parentname;
         //    'Year' => $getYear;
         //    'Term' => $getTerm;
         //    'ParentNumber' => $value->parentnumber;
         //    'SchoolCode' => auth()->user()->SchoolCode;
         //    'ImageType' => $substract2;
         //    'UniqueCode' => $randomNum;
         //    'ImageType' => $substract2;
         // ]); 

         //  $member2 = new User([
         //    'name' => $value->studentnames;
            
         //    'Class' => $value->classnameID;
            
         //    'SchoolCode' => auth()->user()->SchoolCode;
            
         //    'UniqueCode' => $randomNum;
         //    'password' => bcrypt('password');
         // ]); 

         // $member2->save();
         
          }

      return response()->json(['message' => 'correct']);


////////Correct Working Code For Inserting One Record and One Image At a time into The Database///////////////

            // $stu = Student::where('StudentName','yyy')->lists('ImageType');
              

            //  $Year = year_term_setup::leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','year_term_setups.Year');
            // $Term = year_term_setup::leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('terms.TermName','year_term_setups.TermID');
            // $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
            // $Parent = setupparent::lists('Name','SetupParentID');
           

            // $image = Input::file('file');
            //  $image->move('uploads',$image->getClientOriginalName());
            // $post = new Student();

            //    $post->StudentName  = $request->StudentName; 
            //    $post->ClassID = $request->ClassID; 
            //    $post->Year  = $request->Year;
            //    $post->Term  = $request->Term;
            //    $post->ParentName = $request->ParentName;
            //    $post->ParentNumber  = $request->ParentNumber;
            //    $post->SchoolCode = auth()->user()->SchoolCode;

            //     if($image) {
            //     var_dump($image->getRealPath());
            //     $filename = $image->getClientOriginalName();

            //     $post->ImageType = $filename;



            // }

            // $post->save();

            //  return view('Student.create', compact('Class','Parent','Year','Term','stu'));

 ////////End Correct Working Code For Inserting One Record and One Image At a time into The Database//////////

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $StudentImage = Student::where('id',$id)->lists('ImageType');
    
       $Images = json_decode($StudentImage,true);

       $Images2 = $Images[0];


        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','year_term_setups.Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('terms.TermName','year_term_setups.TermID');


        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $Parent = setupparent::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SetupParentID');
        $rows= Student::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('student');
          }

          
        return view('Student.show',compact('rows','Class','Parent','Year','Term','Images2','getTerm','getYear'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $StudentImage = Student::where('id',$id)->lists('ImageType');
        $Images = json_decode($StudentImage,true);

       $Images2 = $Images[0];

        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','year_term_setups.Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('terms.TermName','year_term_setups.TermID');
        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $Parent = setupparent::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SetupParentID');

       $rows= Student::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('student');
          }

     
          
        return view('Student.edit',compact('rows','Class','Parent','Year','Term','Images2'));
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
        $this->validate($request,[
            'StudentName' => 'required',
            'ClassID' => 'required',
            
        ]);

        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermID;

        $getYear = $Year[0]->Year;

        $rows = Student::find($id);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('student');

          }

           $image = Input::file('file');

           if(is_null($image))
           {
            // $randomNum = substr(str_shuffle("0123456789qwertyuiopasdfghjklzxcvbnm"),0,5);

              $rows->StudentName = $request->StudentName;
              $rows->Gender = $request->Gender;
              $rows->DOB = $request->DOB;
              $rows->ClassID = $request->ClassID;
              $rows->Year = $getYear;
              $rows->Term = $getTerm;
              $rows->ParentNumber = $request->ParentNumber;
              $rows->ParentName = $request->ParentName;
              // $rows->UniqueCode = $randomNum;

              $rows->save();

              return redirect('student');
           }else {
               $image->move('uploads',$image->getClientOriginalName());
        
      $randomNum = substr(str_shuffle("0123456789qwertyuiopasdfghjklzxcvbnm"),0,5);
          //return $request->requestss;
        $rows->StudentName = $request->StudentName;
        $rows->ClassID = $request->ClassID;
        $rows->Year = $request->Year;
        $rows->Term = $request->Term;
        $rows->Gender = $request->Gender;
        $rows->DOB = $request->DOB; 
        $rows->ParentNumber = $request->ParentNumber;
        $rows->ParentName = $request->ParentName;
        // $rows->UniqueCode = $randomNum;

if($image) {
    var_dump($image->getRealPath());
    $filename = $image->getClientOriginalName();  

    $rows->ImageType = $filename;
}
        // $rows->Deleted = 1;

        $rows->save();
         //dd();
        Session::flash('message','Sudent Has Been Edited Successfully');

        return redirect('student');
           }

         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Student::find($id)->delete();
        \Session::flash('message','Student Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('student');
    }

    public function delete2(Request $request)
     {
    //     rent::find($RentID)->delete();
    //     \Session::flash('message','Rent Has Been Deleted Successfully!');
    //     \Session::flash('alert-class','alert-warning');

//dd($request->categories);

         Student::destroy($request->categories); 
         Session::flash('message','Student Has Been Deleted Successfully!');
         Session::flash('alert-class','alert-warning');


////////////// Start Code For Promotion ///////////////////////

         // $from = $request->categories;
         // $arr = array();
         // foreach ($from as $key => $value) {
         //     $seed = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('id',$value)->first();
         //     $rr = $seed->ParentName;
         //     $rr2 = $seed->StudentName;



         //     $test = new testing();
         //     $test->Name = $rr2;
         //     $test->Name2 = $rr;

         //     $test->save();
 
             
         // }
 ////////////////////////End Code For Promotion //////////////////        
         //dd($arr);

        return redirect ('student');  
    }


    public function search(){

       $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

    $searchStr=Input::get('searchString');

    $rows= Student::where('StudentName','LIKE', "%$searchStr%")->where('students.SchoolCode',auth()->user()->SchoolCode)->leftjoin('classes','students.ClassID','=','classes.ClassID')->select('students.*','classes.ClassName')->paginate(10);

        return view('Student.list')->with(compact('rows','getTerm','getYear'));  
    }

    public function showAllPicUploaded()
    {
        $user = Student::all();
     //$user2 = $user[0]->ImageType;
 // dd($user2);
        return view('Student.showallpicuploaded',compact('user'));
    }
}
