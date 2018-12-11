<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Student;
use App\userlevel;
use App\Schoolinfo;
use App\Http\Requests;

use Session;
use Illuminate\Support\Facades\Input;

class Usermanagement3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $rows = user::get()->paginate(20);
         $rows = \DB::table('users')->paginate(30);
        //$rows = user::with('roles')->paginate(5);

        return view('SuperUser.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school = Schoolinfo::lists('Name','SchoolCode');
        $userlevel = userlevel::lists('UserLevel','UserLevelID');
        
        return view('SuperUser.create',compact('school','userlevel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $school = Schoolinfo::lists('Name','SchoolCode');
        $userlevel = userlevel::lists('UserLevel','UserLevelID');
        // $data = (object)$request->data;

          //   foreach ($data->data as $key => $value) {
          // $value = (object)$value;

                $UserEmail2 = User::where('email',$request->email);
              if ($UserEmail2->exists()) {
                Session::flash('message','Email Exit, Create New One!');
               Session::flash('alert-class','alert-warning');            
               return redirect('Usermanagement3');
                } 

            // }

      //   foreach ($data->data as $key => $value) {
      //     $value = (object)$value;
      //     $classes = new user;
      //     $classes->name = $value->name;
      //     $classes->email = $value->email;
      //     $classes->PhoneNo = $value->PhoneNo;
      //     $classes->SchoolCode = $value->schoolname;
      //     $classes->UserLevelID = $value->UserLevelID2;
      //     $classes->Userstatus = 1;
      //     $classes->password = bcrypt($value->PhoneNo);
      //     // $classes->children = json_encode($value->parentchildren2);
      //     // $classes->UserLevelID = $value->UserLevelID; 
      //     // $classes->SetupTeacherID = $value->parentchildren
    
      //     $classes->save();
  
      // }

      // return response()->json(['message' => 'correct']);




      $classes = new user;
 

             $image = Input::file('file');
             $image->move('uploads',$image->getClientOriginalName());
            

          $classes->name = $request->name;
          $classes->email = $request->email;
          // $classes->PhoneNo = $request->PhoneNo;
          $classes->SchoolCode = $request->SchoolCode;
          $classes->UserLevelID = $request->UserLevelID;
          $classes->Userstatus = 1;
          $classes->status = 0;
          $classes->password = bcrypt($request->PhoneNo);

                if($image) {
                var_dump($image->getRealPath());
                $filename = $image->getClientOriginalName();

                $classes->ImageType = $filename;
                // }

           $classes->save();  
    }

    return view('SuperUser.create', compact('school','userlevel','Year','Term','stu'));
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $school = Schoolinfo::lists('Name','SchoolCode');
          $userlevel = userlevel::lists('UserLevel','UserLevelID');

        $rows= user::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Usermanagement3');
          }

         $school = Schoolinfo::lists('Name','SchoolCode');
        $row = [];
        $userlevel = userlevel::lists('UserLevel','UserLevelID');
          
        return view('SuperUser.show',compact('rows','school','school','userlevel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school = Schoolinfo::lists('Name','SchoolCode');
          $userlevel = userlevel::lists('UserLevel','UserLevelID');

        $rows= user::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Usermanagement3');
          }

         $school = Schoolinfo::lists('Name','SchoolCode');
        $row = [];
        $userlevel = userlevel::lists('UserLevel','UserLevelID');
          
        return view('SuperUser.edit',compact('rows','school','school','userlevel'));
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
            // 'PhoneNo' => 'required',
            'email' => 'required|email',
        ]);

        $image = Input::file('file');
        $image->move('uploads',$image->getClientOriginalName());

        $parent =user::find($id);
        $parent->name = $request->name;
        $parent->email = $request->email;
        $parent->PhoneNo = $request->PhoneNo;
        $parent->SchoolCode = $request->SchoolCode;

        if($image) {
                var_dump($image->getRealPath());
                $filename = $image->getClientOriginalName();

                $parent->ImageType = $filename;


        // $parent->children = json_encode($request->children);

        $parent->save();
      }
        return redirect('Usermanagement3')->withMessage(' School Admin Edited Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function search(){

    $searchStr=Input::get('searchString');

    $rows= user::where('name','LIKE', "%$searchStr%")->select('users.*')->paginate(10);

        return view('SuperUser.list')->with(compact('rows'));  
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
        \Session::flash('message','School Admin Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Usermanagement3');  
    }


    public function deleteMultiple(Request $request)
     {
         user::destroy($request->categories14); 
         Session::flash('message','Admin Has Been Deleted Successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('Usermanagement3');  
    }
}
