<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Http\Requests;
use App\Student;
use App\Studentperformance;
use App\Term;
use App\Terminalscore;
use App\classinfo;
use App\Schoolinfo;
use App\teacher;
use App\setupteachers;
use App\year_term_setup;
use App\subject;
use App\OverallPosition;
use Auth;
use Session;
use App\subjectsetup;
use App\User;
use Carbon\Carbon;
use App\previousScore;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class ReportController extends Controller
{


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
    public function studentreport()
    {
      if (auth()->user()->UserLevelID == 3) {

        // $student = Student::whereIn('StudentID',json_decode(auth()->user()->children))->lists('StudentName','StudentID');
//dd(auth()->user()->children);
        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');

        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('UniqueCode',auth()->user()->UniqueCode)->lists('StudentName','UniqueCode');
//dd($student);
      }elseif (auth()->user()->UserLevelID == 2) {

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');


         $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
      }elseif (auth()->user()->UserLevelID == 4) {



         // $rr = json_decode(auth()->user()->children);
         // dd($rr);

           // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
      // dd($student);
        // $student = Student::lists('StudentName','id');
      }
      elseif (auth()->user()->UserLevelID == 6) {

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
         //$student = Student::lists('StudentName','id');
      }elseif(auth()->user()->UserLevelID == 1) {

        // $student = Student::whereIn('StudentID',json_decode(auth()->user()->children))->lists('StudentName','StudentID');

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');

      }
      
      $output = [];
      
      $studentImage = [];
      $StuImage2 = "";
      // $year = range(Carbon::now()->year,1980);

      $year = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];

      //$terms = Term::where('SchoolCode',auth()->user()->SchoolCode)->lists('TermName','TermID');
      $terms = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('TermName','year_term_setups.TermID');
      $classes = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
      //dd($classes);
      $schoolinfo = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->first();

      $Image = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Logo');
       //dd($Image);
       
      $Images = json_decode($Image,true);

      $Images2 = $Images[0];


       // $studentImage = Student::where('id',"")->lists('ImageType');

       // $StuImage = json_decode($studentImage,true);

       // $StuImage2 = $StuImage[0];


       //$AA = str_replace('"', '', $Images2);
      //dd($AA);

      return view('report.studentrep',compact('studentImage','rows','output','student','year','terms','classes','schoolinfo','Images2','StuImage2'));
    }

    public function studentreportsearch(Request $request)
    {

      if (auth()->user()->UserLevelID == 3) {

        // $student = Student::whereIn('StudentID',json_decode(auth()->user()->children))->lists('StudentName','StudentID');

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');

        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('UniqueCode',auth()->user()->UniqueCode)->lists('StudentName','UniqueCode');
        //dd($student);

      }elseif (auth()->user()->UserLevelID == 2) {

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
         //$student = Student::lists('StudentName','id');
      }elseif (auth()->user()->UserLevelID == 4) {

           // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');

          // dd($student);
        // $student = Student::lists('StudentName','id');
      }elseif(auth()->user()->UserLevelID == 1) {

        // $student = Student::whereIn('StudentID',json_decode(auth()->user()->children))->lists('StudentName','StudentID');

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');

      }


       $studentImage = Student::where('UniqueCode',$request->student)->lists('ImageType');

 $StuImage2 = $studentImage[0];

// dd($StuImage2);
        $StuImage = json_decode($studentImage,true);

        $StuImage2 = $StuImage[0];

  $studentImage = [];

      $output = [];

      $studentclassget = Student::where('UniqueCode',$request->student)->leftjoin('classes','students.ClassID','=','classes.ClassID')->orderBy('students.created_at','desc')->lists('students.ClassID');
      $id = $studentclassget[0];


     // dd($id);
      // $year = range(Carbon::now()->year,1980);
     
     //$year = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];

      //$terms = Term::where('SchoolCode',auth()->user()->SchoolCode)->lists('TermName','TermID');
      $terms = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->select('year_term_setups.*','TermName')->get();
    //dd($terms);  
$termsid = $terms[0]->TermID;
$termsname = $terms[0]->TermName;
$schbegins = $terms[0]->TermBegin;
$schends = $terms[0]->TermEnd;

//dd($termsid);
      $year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('Year');
$yearget = $year[0];
//dd($year);


 $output = Student::where('students.ClassID',$id)->where('students.SchoolCode',auth()->user()->SchoolCode)->GroupBy('classID')->leftjoin('classes','students.ClassID','=','classes.ClassID')->leftjoin('schoolinfos','students.SchoolCode','=','schoolinfos.SchoolCode')->select(DB::raw('count(*) as counter'),'students.*','classes.ClassName','schoolinfos.Name')->get();
$totalNo = $output[0]->counter;

$classname = $output[0]->ClassName;
//dd($classname);

$OverallpositionInClass = OverallPosition::where('SchoolCode',auth()->user()->SchoolCode)->where('UniqueCode',$request->student)->select('OverallTotal','Position')->get(); 

//dd($OverallpositionInClass);
      $classes = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
     // $classinfo = classinfo::where('SchoolCode',auth()->user()->SchoolCode)->where('year',$yearget)->where('term',$termsid)->where('ClassID',$id)->first();

      // $studentperformance = Studentperformance::where('SchoolCode',auth()->user()->SchoolCode)->where('Year',$yearget)->where('Term',$termsid)->where('ClassID',$id)->where('id',$request->student)->first();



      $studentperformance = Studentperformance::where('SchoolCode',auth()->user()->SchoolCode)->where('Year',$yearget)->where('Term',$termsid)->where('id',$request->student)->first();


//dd($studentperformance);
      //check if class info exists
      // if (is_null($classinfo)) {
      //   return redirect('studentreport')->withMessage('No information for selected Class');
      // }
      //end check info

      $terminalscores = Terminalscore::where('terminalscores.SchoolCode',auth()->user()->SchoolCode)->where('id',$request->student)->leftjoin('subjectsetups','terminalscores.SubjectID','=','subjectsetups.SubjectSetupID');

      // if ($request->class != null || $request->class != "") {
        $terminalscores = $terminalscores->where('Class',$id);
      // }

      // if ($request->term != null || $request->term != "") {
         $terminalscores = $terminalscores->where('TermID',$termsid);
      // }

      // if ($request->year != null || $request->year != "") {
         $terminalscores = $terminalscores->where('Year',$yearget);
      // }

      $output = $terminalscores->leftjoin('classes','terminalscores.Class','=','classes.ClassID')->select('terminalscores.*','subjectsetups.SubjectName','ClassName')->get();
      //dd($output);
     if (empty($output[0])) {
            Session::flash('message','No Records For This Student, Contact School Administration');
            Session::flash('alert-class','alert-warning');            
            return redirect('studentreport');
     }
      $StudentNameGet = $output[0]->ClassName;
      
       //dd($output);
      $selectedstudent = Student::where('UniqueCode',$request->student)->first();
     // dd($selectedstudent);

      $selectedyear = $request->year;
      $selectedterm = $request->term;
      $selectedclass = $request->class;

      $schoolinfo = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->first();

      $Image = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('LogoOnReport');
       
      $Images = json_decode($Image,true);

      $Images2 = $Images[0];

    //dd($Images2);

      return view('report.studentrep',compact('rows','output','student','year','terms','classes','selectedstudent','selectedyear','selectedclass','selectedterm','classinfo','studentperformance','schoolinfo','Images2','studentImage','StuImage2','totalNo','OverallpositionInClass','termsname','yearget','classname','schbegins','schends','StudentNameGet'));
    }


    public function Previous()
    {
      if (auth()->user()->UserLevelID == 3) {

        // $student = Student::whereIn('StudentID',json_decode(auth()->user()->children))->lists('StudentName','StudentID');
//dd(auth()->user()->children);
        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('UniqueCode',auth()->user()->UniqueCode)->lists('StudentName','UniqueCode');

      }elseif (auth()->user()->UserLevelID == 2) {

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');


         $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
      }elseif (auth()->user()->UserLevelID == 4) {



         // $rr = json_decode(auth()->user()->children);
         // dd($rr);

           // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
      // dd($student);
        // $student = Student::lists('StudentName','id');
      }
      elseif (auth()->user()->UserLevelID == 6) {

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
         //$student = Student::lists('StudentName','id');
      }elseif(auth()->user()->UserLevelID == 1) {

        // $student = Student::whereIn('StudentID',json_decode(auth()->user()->children))->lists('StudentName','StudentID');

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');

      }
      
      $output = [];
      
      $studentImage = [];
      $StuImage2 = "";

      $year = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];

      // $terms = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('TermName','year_term_setups.TermID');
      $terms = Term::where('SchoolCode',auth()->user()->SchoolCode)->lists('TermName','TermID');
      $classes = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
      
      $schoolinfo = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->first();

      $Image = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('LogoOnReport');
       
       
      $Images = json_decode($Image,true);

      $Images2 = $Images[0];



      return view('report.previousTermsScores',compact('studentImage','rows','output','student','year','terms','classes','schoolinfo','Images2','StuImage2'));
    }

    public function PreviousSearch(Request $request)
    {

      if (auth()->user()->UserLevelID == 3) {

        // $student = Student::whereIn('StudentID',json_decode(auth()->user()->children))->lists('StudentName','StudentID');
       //dd(auth()->user()->children);
        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('UniqueCode',auth()->user()->UniqueCode)->lists('StudentName','UniqueCode');

      }elseif (auth()->user()->UserLevelID == 2) {

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');


         $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
      }elseif (auth()->user()->UserLevelID == 4) {



         // $rr = json_decode(auth()->user()->children);
         // dd($rr);

           // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
      // dd($student);
        // $student = Student::lists('StudentName','id');
      }
      elseif (auth()->user()->UserLevelID == 6) {

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->where('ClassID',auth()->user()->Class)->lists('StudentName','UniqueCode');
         //$student = Student::lists('StudentName','id');
      }elseif(auth()->user()->UserLevelID == 1) {

        // $student = Student::whereIn('StudentID',json_decode(auth()->user()->children))->lists('StudentName','StudentID');

        // $student = Student::whereIn('UniqueCode',json_decode(auth()->user()->children))->leftjoin('classes','students.ClassID','=','classes.ClassID')->lists('StudentName','UniqueCode');
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');

      }

      // if (($request->student)==NULL || ($request->student) == "") {
      //     dd(90);
      // }

       $studentImage = Student::where('UniqueCode',$request->student)->lists('ImageType');

       $StuImage2 = $studentImage[0];

        $StuImage = json_decode($studentImage,true);

        $StuImage2 = $StuImage[0];

        $studentImage = [];

        $output = [];
     
     
     $year = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];

      // $terms = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('TermName','year_term_setups.TermID');
     $terms = Term::where('SchoolCode',auth()->user()->SchoolCode)->lists('TermName','TermID');
      $classes = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
      //$classinfo = classinfo::where('SchoolCode',auth()->user()->SchoolCode)->where('year',$request->year)->where('term',$request->term)->where('ClassID',$request->class)->first();
      // $studentperformance = Studentperformance::where('SchoolCode',auth()->user()->SchoolCode)->where('Year',$request->year)->where('Term',$request->term)->where('ClassID',$request->class)->where('UniqueCode',$request->student)->first();

      // if (is_null($classinfo)) {
      //   return redirect('Previous')->withMessage('No information for selected Class');
      // }
      

      // $terminalscores = previousScore::where('previousScores.SchoolCode',auth()->user()->SchoolCode)->where('id',$request->student)->orderBy('Year','TermID')->leftjoin('subjectsetups','previousScores.SubjectID','=','subjectsetups.SubjectSetupID');

      // if ($request->class != null || $request->class != "") {
      //   $terminalscores = $terminalscores->where('Class',$request->class);
      // }

      // if ($request->term != null || $request->term != "") {
      //   $terminalscores = $terminalscores->where('TermID',$request->term);
      // }

      // if ($request->year != null || $request->year != "") {
      //   $terminalscores = $terminalscores->where('Year',$request->year);
      // }

      //$output = $terminalscores->select('previousScores.*','subjectsetups.SubjectName')->get();

$arra = array();
$arra2 = array();
$arra3 = array();
      
$cats = DB::table('previousScores')->leftjoin('classes','previousScores.Class','=','classes.ClassID')->where('previousScores.SchoolCode',auth()->user()->SchoolCode)->where('id',$request->student)->GroupBy('Year')->select('Year')->get();

$cats2 = DB::table('previousScores')->leftjoin('classes','previousScores.Class','=','classes.ClassID')->where('previousScores.SchoolCode',auth()->user()->SchoolCode)->where('id',$request->student)->GroupBy('Year')->select('ClassName')->get();
//dd($cats);
$termName = DB::table('previousScores')->leftjoin('terms','previousScores.TermID','=','terms.TermID')->where('previousScores.SchoolCode',auth()->user()->SchoolCode)->where('id',$request->student)->GroupBy('previousScores.TermID')->orderBy('TermName')->lists('termName');
//dd($termName[1]);
//dd($termName);
foreach($cats as $cat){

    $output[] = DB::table('previousScores')->leftjoin('classes','previousScores.Class','=','classes.ClassID')->leftjoin('terms','previousScores.TermID','=','terms.TermID')->leftjoin('subjectsetups','previousScores.SubjectID','=','subjectsetups.SubjectSetupID')->where('id',$request->student)->where('Year',$cat->Year)->orderBy('previousScores.TermID','asc')->get();

}

  if (empty($output[0])) {
            Session::flash('message','No Records For This Student, Contact School Administration');
            Session::flash('alert-class','alert-warning');            
            return redirect('Previous');
     }
// $cats = DB::table('previousScores')->where('SchoolCode',auth()->user()->SchoolCode)->where('id',$request->student)->GroupBy('Year')->select('Year')->get();

// $termName = DB::table('previousScores')->leftjoin('terms','previousScores.TermID','=','terms.TermID')->where('previousScores.SchoolCode',auth()->user()->SchoolCode)->where('id',$request->student)->GroupBy('previousScores.TermID')->select('previousScores.TermID')->get();
// //dd($termName);
// foreach($cats as $cat){
//   foreach ($termName as $i=>$value) {
//    $output[] = DB::table('previousScores')->leftjoin('terms','previousScores.TermID','=','terms.TermID')->leftjoin('subjectsetups','previousScores.SubjectID','=','subjectsetups.SubjectSetupID')->where('id',$request->student)->where('previousScores.TermID',$value->TermID)->orderBy('previousScores.TermID')->get();
//   }
// }

//$arra[] = $cats;
//$date = ['2018'=>'2018','2019'=>'2019'];
foreach ($cats as $value) {
    foreach ($value as $yr) {
     // $ff = $yr[0]->Year;
      $arra2[] = $yr;
    }
}

foreach ($cats2 as $value) {
    foreach ($value as $classname) {
     // $ff = $yr[0]->Year;
      $arra3[] = $classname;
    }
}
//dd($arra3);
// foreach ($termName as $value2) {
//     foreach ($value2 as $yr2) {
//      // $ff = $yr[0]->Year;
//       $arra3[] = $yr2;
//     }
// }
//$arra2[] = $arra;

//dd($output);

      $selectedstudent = Student::where('UniqueCode',$request->student)->where('SchoolCode',auth()->user()->SchoolCode)->first();
    //dd($selectedstudent);
      $selectedyear = $request->year;
      $selectedterm = $request->term;
      $selectedclass = $request->class;

      $schoolinfo = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->first();

      $Image = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('LogoOnReport');
       
      $Images = json_decode($Image,true);

      $Images2 = $Images[0];


      return view('report.previousTermsScores',compact('rows','output','student','year','terms','classes','selectedstudent','selectedyear','selectedclass','selectedterm','classinfo','studentperformance','schoolinfo','Images2','studentImage','StuImage2','cats','arra2','arra3','termName'));
    }


    public function studentclass(Request $request){
      $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','id');

      $classes = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

      $terms = [];
      $output = [];
      $year = [];
      $terms = [];
      $school = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode');
      
       return view('report.studentclass',compact('rows','output','student','year','terms','classes','schoolinfo','school'));
    }

    public function studentclassSearch(Request $request){

      //  if ((($request->FromDate=="") || ($request->ToDate==null))  &&  ( ($request->ToDate=="") || ($request->FromDate==null) ) ) {        
      //   \Session::flash('message','Either Start date or End date is missing');
      //   \Session::flash('alert-class','alert-warning');            
      //   return redirect('studentclass');
      // }

       // if (($request->searchString1 == null || $request->searchString1 == "") && ($request->searchString2 == null || $request->searchString2 == "") && ($request->searchString3 == null || $request->searchString3 == "")) {
       //    \Session::flash('message','Please Select Student or Class ');
       //    \Session::flash('alert-class','alert-warning');            
       //    return redirect('studentclass');
       // }

      $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','id');

      $classes = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
      $terms = [];
      $school = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode');

      $selectedstudent = $request->searchString1;
      $selectedclass = $request->searchString2;
      $selectedschool = $request->searchString3;

      $from = $request->FromDate;
      $to = $request->ToDate;

       if (($request->searchString1 == null || $request->searchString1 == "") && ($request->searchString2 != null || $request->searchString2 != "") && ($request->searchString3 != null || $request->searchString3 != "")) 
       {
      
            $output = student::where('students.ClassID',$selectedclass)->where('students.SchoolCode',$selectedschool)->leftjoin('classes','students.ClassID','=','classes.ClassID')->select('students.*','students.StudentName','classes.ClassName')->paginate(20);
          
          
          if (is_null($output)) {

               $terms = [];
               $output = [];
                $year = [];
                $terms = [];
                $rows = [];

                $class = classes::where('ClassID',$selectedclass)->lists('ClassName');

                $string = str_replace(array('[',']'),'',$class);


               $AA = str_replace('"', '', $string);

                 $AA2 = "There Are No Student In {$AA}, Please Add Student"; 

                \Session::flash('message',$AA2);
                \Session::flash('alert-class','alert-warning');            
               return redirect('studentclass');

             // return redirect('studentclass',compact('rows','output','student','year','terms','classes','schoolinfo','school','name'));
          }else {

              $output = student::where('students.ClassID',$selectedclass)->where('students.SchoolCode',$selectedschool)->leftjoin('classes','students.ClassID','=','classes.ClassID')->select('students.*','students.StudentName','classes.ClassName')->paginate(20);

              $name = $output[0]->StudentName;

              return view('report.studentclass',compact('rows','output','student','year','terms','classes','schoolinfo','school','name'));
          }
           

      
       
       }
        elseif (($request->searchString1 == null || $request->searchString1 == "") && ($request->searchString2 == null || $request->searchString2 == "") && ($request->searchString3 != null || $request->searchString3 != "")) 
       {
          
      $output = student::where('students.SchoolCode',$selectedschool)->leftjoin('classes','students.ClassID','=','classes.ClassID')->where('students.SchoolCode',auth()->user()->SchoolCode)->select('students.*','students.StudentName','classes.ClassName')->paginate(20);

      $name = $output[0]->StudentName;
       
      
       return view('report.studentclass',compact('rows','output','student','year','terms','classes','schoolinfo','school','name'));
     }
    elseif (($request->searchString1 != null || $request->searchString1 != "") && ($request->searchString2 != null || $request->searchString2 != "") && ($request->searchString3 != null || $request->searchString3 != "")) 
       {
   
            $output = student::where('students.ClassID',$selectedclass)->where('students.id',$selectedstudent)->where('students.SchoolCode',$selectedschool)->leftjoin('classes','students.ClassID','=','classes.ClassID')->where('students.SchoolCode',auth()->user()->SchoolCode)->select('students.*','students.StudentName','classes.ClassName')->paginate(20);
      
      $name = $output[0]->StudentName;

       return view('report.studentclass',compact('rows','output','student','year','terms','classes','schoolinfo','school','name'));
       }elseif (($request->searchString1 == null || $request->searchString1 == "") && ($request->searchString2 == null || $request->searchString2 == "") && ($request->searchString3 == null || $request->searchString3 == "")) {
          $output = student::leftjoin('classes','students.ClassID','=','classes.ClassID')->where('students.SchoolCode',auth()->user()->SchoolCode)->select('students.*','students.StudentName','classes.ClassName')->paginate(20);

          $name = "";

          return view('report.studentclass',compact('rows','output','student','year','terms','classes','schoolinfo','school','name'));
       }

    }

    public function teacherclass()
    {


      $teacher = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeachersetupID');

      $classes = [];
      $school = [];
      $student = [];
      $output = [];
      $arra2 = [];
      $array = [];
      
       return view('report.teacherclass',compact('rows','output','student','year','terms','classes','teacher','school','arra2','array'));
    }

    public function teacherclasssearch(Request $request)
    {
       $teacher = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeachersetupID');

      $classes = [];
      $school = [];
      $student = [];
      $output = [];

       $selecteacher = $request->searchString1;
      
         if($request->searchString1 != null || $request->searchString1 != "") {
        
        //  $rows2 = setupteachers::where('SetupTeacherID',$selecteacher)->where('SchoolCode',auth()->user()->SchoolCode)->lists('SetupTeacherID');

          $array = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('teachers','setupteachers.TeachersetupID','=','teachers.TeachersetupID')->where('setupteachers.TeachersetupID',$selecteacher)->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->select('setupteachers.*','classes.ClassName','subjectsetups.SubjectName','teachers.TeacherSetupName','teachers.PhoneNo')->paginate(20);

          if (empty($array[0])) {
              
              \Session::flash('message','This Teacher Has Not Been Assigned Class and Subject');
              \Session::flash('alert-class','alert-warning');

              return redirect ('teacherclass');
          }

          $teacherName = $array[0]->TeacherSetupName;
          //dd($array);
       // $array = array();
       // $arra2 = array();

       //  foreach ($rows2 as $key => $value) {
 
       //   $rows = setupteachers::where('SetupTeacherID',$value)->lists('ClassID');

       //   $rows4 = setupteachers::where('SetupTeacherID',$value)->lists('Name');
       //   $rows5 = str_replace('"', '', $rows4);
       //   $rows3 = str_replace(array('[',']'),'',$rows5);

       //   $arra2[] = $rows3;
        
       //    $row = setupteachers::all();
       // $arra = array();
       //    $decode = json_decode($rows,true);

       //    foreach ($decode as $key => $value) {
      

       //        $string = str_replace(array('[',']'),'',$value);

       //         $AA = str_replace('"', '', $string);

       //         $arr=explode(",",$AA);

       //          $Class2 = Classes::whereIn('ClassID',$arr)->lists('ClassName');
               
         
       //        $arra[] = $Class2;  

       //    }
    
       //   $ff = implode(" ", $arra);
       //     $AA = str_replace('"', '', $ff);

       //     $Classlist = str_replace(array('[',']'),'',$AA);

          
       //     $array[] = $Classlist;
       //  }

       //  $rows = [];

        return view('report.teacherclass',compact('array','arra2','arra','output','teacher','student','year','terms','classes','school','teacherName'));
       }
       elseif($request->searchString1 == null || $request->searchString1 == "") 
       {
        $array = setupteachers::leftjoin('classes','setupteachers.ClassID','=','classes.ClassID')->leftjoin('subjectsetups','setupteachers.SubjectID','=','subjectsetups.SubjectSetupID')->leftjoin('teachers','setupteachers.TeachersetupID','=','teachers.TeachersetupID')->where('setupteachers.SchoolCode',auth()->user()->SchoolCode)->select('setupteachers.*','classes.ClassName','subjectsetups.SubjectName','teachers.TeacherSetupName','teachers.PhoneNo')->paginate(20);

        $teacherName = "";
        // dd($array);
       // $array = array();
       //$arra2 = array();
      
          
       //  foreach ($rows2 as $key => $value) {

       //   $rows = setupteachers::where('SetupTeacherID',$value)->lists('ClassID');

       //   $rows4 = setupteachers::where('SetupTeacherID',$value)->lists('Name');
       //   $rows5 = str_replace('"', '', $rows4);
       //   $rows3 = str_replace(array('[',']'),'',$rows5);

       //   $arra2[] = $rows3;
        
       //    $row = setupteachers::all();
       // $arra = array();
       //    $decode = json_decode($rows,true);

       //    foreach ($decode as $key => $value) {
      

       //        $string = str_replace(array('[',']'),'',$value);

       //         $AA = str_replace('"', '', $string);

       //         $arr=explode(",",$AA);

       //          $Class2 = Classes::whereIn('ClassID',$arr)->lists('ClassName');
               
         
       //        $arra[] = $Class2;  

        //   }
    
        //  $ff = implode(" ", $arra);
        //    $AA = str_replace('"', '', $ff);

        //    $Classlist = str_replace(array('[',']'),'',$AA);

          
        //    $array[] = $Classlist;
        // }

        // $rows = [];

        return view('report.teacherclass',compact('array','arra2','arra','output','teacher','student','year','terms','classes','school','teacherName'));
       }
    }

    public function listsofclass()
    {
        $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentName');

        $classes = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

      $terms = [];
      $output = [];
      $year = [];
      $terms = [];
      $school = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode');
      
       return view('report.listsofclass',compact('rows','output','student','year','terms','classes','schoolinfo','school'));
    }

    public function listsofclasssearch(Request $request)
    {
       $student = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentName');
      $classes = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
      $school = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode');

      $selectschool = $request->searchString1;
      $selectclass = $request->searchString2;
      $to = $request->ToDate;
      $from = $request->FromDate;

      if (($request->searchString2 != "" || $request->searchString2 != NULL) && ($request->ToDate == "" || $request->ToDate == NULL) && ($request->FromDate == "" || $request->FromDate == NULL) ) {
          

          $output = Student::where('students.ClassID',$request->searchString2)->where('students.SchoolCode',auth()->user()->SchoolCode)->GroupBy('students.classID')->leftjoin('classes','students.ClassID','=','classes.ClassID')->leftjoin('schoolinfos','students.SchoolCode','=','schoolinfos.SchoolCode')->select(DB::raw('count(*) as counter'),'students.*','classes.ClassName','schoolinfos.Name')->paginate(20);
//dd($output);
       $NameOfSchool = $output[0]->ClassName;

        return view('report.listsofclass',compact('rows','output','student','year','terms','classes','NameOfSchool','school','to','from'));


      }elseif (($request->searchString2 == "" || $request->searchString2 == NULL) && ($request->ToDate != "" || $request->ToDate != NULL) && ($request->FromDate != "" || $request->FromDate != NULL) ) {

          $output = Student::whereBetween('students.created_at',[$from,$to])->where('students.SchoolCode',auth()->user()->SchoolCode)->GroupBy('students.classID')->leftjoin('classes','students.ClassID','=','classes.ClassID')->leftjoin('schoolinfos','students.SchoolCode','=','schoolinfos.SchoolCode')->select(DB::raw('count(*) as counter'),'students.*','classes.ClassName','schoolinfos.Name')->paginate(20);

       $NameOfSchool = $output[0]->ClassName;

        return view('report.listsofclass',compact('rows','output','student','year','terms','classes','NameOfSchool','school','to','from'));
      }elseif (($request->searchString2 != "" || $request->searchString2 != NULL) && ($request->ToDate != "" || $request->ToDate != NULL) && ($request->FromDate != "" || $request->FromDate != NULL) ) {

          $output = Student::where('students.ClassID',$request->searchString2)->whereBetween('students.created_at',[$from,$to])->where('students.SchoolCode',auth()->user()->SchoolCode)->GroupBy('students.classID')->leftjoin('classes','students.ClassID','=','classes.ClassID')->leftjoin('schoolinfos','students.SchoolCode','=','schoolinfos.SchoolCode')->select(DB::raw('count(*) as counter'),'students.*','classes.ClassName','schoolinfos.Name')->paginate(20);

       $NameOfSchool = $output[0]->ClassName;

        return view('report.listsofclass',compact('rows','output','student','year','terms','classes','NameOfSchool','school','to','from'));
      }

        $output = Student::where('students.SchoolCode',auth()->user()->SchoolCode)->GroupBy('students.classID')->leftjoin('classes','students.ClassID','=','classes.ClassID')->leftjoin('schoolinfos','students.SchoolCode','=','schoolinfos.SchoolCode')->select(DB::raw('count(*) as counter'),'students.*','classes.ClassName','schoolinfos.Name')->paginate(20);

      //$output2 = Student::where('students.SchoolCode',auth()->user()->SchoolCode)->GroupBy('classID')->where('Gender','Female')->leftjoin('classes','students.ClassID','=','classes.ClassID')->leftjoin('schoolinfos','students.SchoolCode','=','schoolinfos.SchoolCode')->select(DB::raw('count(*) as counter'),'students.*','classes.ClassName','schoolinfos.Name')->get();
//dd($output);
       $NameOfSchool = $output[0]->Name;

        return view('report.listsofclass',compact('rows','output','student','year','terms','classes','NameOfSchool','school','to','from'));
    }
    
  }
