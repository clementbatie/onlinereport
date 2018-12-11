<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schoolinfo;
use App\year_term_setup;
use App\User;
use App\Student;
use App\userlevel;
use App\setupteachers;
use App\teacher;
use App\classes;

use Session;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class schoollogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if (auth()->user()->UserLevelID == 4) {
           $rows = Schoolinfo::select('schoolinfos.*')->paginate(30);
        }elseif (auth()->user()->UserLevelID == 1) {
           $rows = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->get();
        }
        
        return view('SchoolLogo.list', compact('rows'));

        // return view('SchoolLogo.list',compact('rows','getTerm','getYear'));
        
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
        
        return view('SchoolLogo.create',compact('school','userlevel'));
         
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
             $image->move('uploads',$image->getClientOriginalName());


        $rr = $request->SchoolName;
        
        $parent =Schoolinfo::where('SchoolCode',$rr)->get();
       $getID = $parent[0]->SchoolIfoID;
         $parent2 =Schoolinfo::find($getID);
         
         

         if($image) {
                var_dump($image->getRealPath());
                $filename = $image->getClientOriginalName();

                $parent2->LogoOnReport = $filename;
                // }

           $parent2->save();  
    }
        return redirect('schoollogo')->withMessage(' Logo Has Been Added Sucessfully');
 //dd($parent2);
       
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
    public function edit($SchoolIfoID)
    {
        $school = Schoolinfo::lists('Name','SchoolCode');
        $userlevel = userlevel::lists('UserLevel','UserLevelID');

        $StudentImage = schoolinfo::where('SchoolIfoID',$SchoolIfoID)->lists('LogoOnReport');
        $Images = json_decode($StudentImage,true);

       $Images2 = $Images[0];

        $rows = schoolinfo::find($SchoolIfoID);
        if (is_null($rows)) {
            return redirect('schoollogo')->withMessage('School Detail Not Found');
        }
       //  $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
        return view('SchoolLogo.edit',compact('rows','children','Images2','school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $SchoolIfoID)
    {
        //  $this->validate($request,[
        //     'Name' => 'required',
        //     'Address' => 'required',  
        //     'ContactNos' => 'required',
        //     'SchoolCode' => 'required',
        //     'reportname' => 'required'
        // ]);

        $rows = schoolinfo::find($SchoolIfoID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('schoollogo');
          }


          $image = Input::file('file');

          if(is_null($image))
           {
        
             return redirect('schoollogo');
           }else {

            $image->move('uploads',$image->getClientOriginalName());

              if($image) {
                  var_dump($image->getRealPath());
                  $filename = $image->getClientOriginalName();  

                  $rows->LogoOnReport = $filename;
                       }

        $rows->save();
       
         Session::flash('message','School Logo Edited Successfully');
        return redirect('schoollogo');
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
        //
    }

//     public function search()
//     {
//         $searchStr=Input::get('searchString');
       
//     $rows= schoolinfo::where('Name','LIKE',"%$searchStr%")->where('SchoolCode',auth()->user()->SchoolCode)->select('schoolinfos.*')->paginate(10);
// //dd($rows);
//         return view('SchoolLogo.list')->with(compact('rows'));
//     }

    public function search()
    {
        $searchStr=Input::get('searchString');
          
    $rows= schoolinfo::where('Name','LIKE',"%$searchStr%")->select('schoolinfos.*')->paginate(10);
//dd($rows);
        return view('SchoolLogo.list')->with(compact('rows'));
    }
}
