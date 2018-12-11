<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\user;
use App\Student;
use App\userlevel;
use App\setupteachers;
use App\teacher;
use App\classes;
use App\year_term_setup;

use Session;
use Illuminate\Support\Facades\Input;

class usermanagementController2 extends Controller
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

        if(auth()->user()->UserLevelID == 4){
            $rows = user::select('users.*')->paginate(15);
        }else{
            $rows = user::where('SchoolCode',auth()->user()->SchoolCode)->where('status',1)->select('users.*')->paginate(15);
        }

        

        return view('CreateUser.list',compact('rows','getYear','getTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','UniqueCode');
        //dd($children);
        $classname = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $rows = [];
         $userlevel = userlevel::where('national',2)->lists('UserLevel','UserLevelID');
        //$teacher = setupteachers::leftjoin('t')->where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SetupTeacherID');
          $teacher = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeachersetupID');
       // $teacher = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('ParentName');

        return view('CreateUser.create', compact('userlevel','children','rows','userlevel','teacher','classname','getTerm','getYear'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd(7);
         $data = (object)$request->data;

         foreach ($data->data as $key => $value) {
          $value = (object)$value;

                $UserEmailUser = User::where('email',$value->email);
              if ($UserEmailUser->exists()) {
              $UserEmailUser = $UserEmailUser->get(['email','SchoolCode'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'UserEmailUser' => $UserEmailUser
                  ]);
                }  
            }

        foreach ($data->data as $key => $value) {
          $value = (object)$value;
          $classes = new user;
          $classes->name = $value->name;
          $classes->email = $value->email;
          $classes->PhoneNo = $value->PhoneNo;
          $classes->password = bcrypt($value->PhoneNo);
          $classes->children = json_encode($value->parentchildren);
          $classes->UserLevelID = $value->UserLevelID; 
          $classes->SetupTeacherID = $value->nameParentTeacher;
          $classes->Class = $value->classteacher;
          $classes->Userstatus = 1; 
          $classes->status = 1;

          switch (auth()->user()->UserLevelID) {
            case '4':
              $classes->SchoolCode = auth()->user()->SchoolCode;
                break;
             case '3':
              $classes->SchoolCode = auth()->user()->SchoolCode;
                break;
                case '1':
              $classes->SchoolCode = auth()->user()->SchoolCode;
                break;
                case '6':
              $classes->SchoolCode = auth()->user()->SchoolCode;
                break;
                case '2':
              $classes->SchoolCode = auth()->user()->SchoolCode;
                break;
            default:
            break;   
        }
          $classes->save();
      }

      return response()->json(['message' => 'correct']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $classname = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

         $rows= user::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('usermanagement2');
          }

          $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

         $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
        $row = [];
       $userlevel = userlevel::where('national',2)->lists('UserLevel','UserLevelID');
         $teacher = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeachersetupID');
          
        return view('CreateUser.show',compact('rows','Class','Parent','children','row','userlevel','teacher','classname','getYear','getTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $classname = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

        $rows= user::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('usermanagement2');
          }

          $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        // $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
         $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','id');
        $row = [];
        $userlevel = userlevel::where('national',2)->lists('UserLevel','UserLevelID');
         $teacher = teacher::where('SchoolCode',auth()->user()->SchoolCode)->lists('TeacherSetupName','TeachersetupID');
          
        return view('CreateUser.edit',compact('rows','Class','Parent','children','row','userlevel','teacher','classname','getTerm','getYear'));
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
            'name' => 'required',
            'PhoneNo' => 'required',
            // 'children' => 'required|array|min:1',
        ]);
        $parent =user::find($id);
        $parent->name = $request->name;
        $parent->email = $request->email;
        $parent->PhoneNo = $request->PhoneNo;
         $parent->Class = $request->Class;
        $parent->children = json_encode($request->children);

        $parent->save();
        return redirect('usermanagement2')->withMessage('Parent Edited');
    }

   public function search(){

    $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

    $searchStr=Input::get('searchString');

    $rows= user::where('name','LIKE', "%$searchStr%")->where('SchoolCode',auth()->user()->SchoolCode)->select('users.*')->paginate(15);

        return view('CreateUser.list')->with(compact('rows','getYear','getTerm'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        user::destroy($id);
        \Session::flash('message','User Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('usermanagement2');  
    }


    public function deleteMultiple(Request $request)
     {
         user::destroy($request->categories3); 
         Session::flash('message','User Has Been Deleted Successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('usermanagement2');  
    }
}
