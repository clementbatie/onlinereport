<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Schoolinfo;
use Session;
use Illuminate\Support\Facades\Input;

class SchoolinfoController extends Controller
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
        
        return view('Schoolinfo.list', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Schoolinfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // $data = (object) $request->data;
            
         //    //return $request->all();
         //    foreach ($data->data as $value) {

         //     $value = (object)$value;
           $member = new Schoolinfo;
           
          
          //   switch (auth()->user()->UserLevelID) {
          //   case '1':
          //     $member->EntryUser = auth()->user()->UserLevelID;
          //       break;
          //    case '3':
          //     $member->EntryUser = auth()->user()->UserLevelID;
          //     //$meeting->NationalID = auth()->user()->NationalID;
          //       break;
          //   default:
          //   break;   
          // }
 

             $image = Input::file('file');
             $image->move('uploads',$image->getClientOriginalName());
            

               $member->Name  = $request->Name; 
               $member->Address  = $request->Address; 
               $member->ContactNos = $request->ContactNos;
               $member->SchoolCode = $request->SchoolCode;
               $member->reportname = $request->reportname;

                if($image) {
                var_dump($image->getRealPath());
                $filename = $image->getClientOriginalName();

                $member->Logo = $filename;
                // }

           $member->save();  
      }


      //send the background picture to the BackgroundImage Table as well, so call the table here and send the picture to it//

       return view('Schoolinfo.create', compact('Class','Parent','Year','Term','stu'));
      // return response()->json(['message' => 'correct']);
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($SchoolIfoID)
    {

      $StudentImage = schoolinfo::where('SchoolIfoID',$SchoolIfoID)->lists('Logo');
        $Images = json_decode($StudentImage,true);

       $Images2 = $Images[0];

        $rows = schoolinfo::find($SchoolIfoID);
        if (is_null($rows)) {
            return redirect('schoolinfo')->withMessage('School Detail Not Found');
        }
        // $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
        return view('schoolinfo.show',compact('rows','children','Images2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($SchoolIfoID)
    {
      $StudentImage = schoolinfo::where('SchoolIfoID',$SchoolIfoID)->lists('Logo');
        $Images = json_decode($StudentImage,true);

       $Images2 = $Images[0];

        $rows = schoolinfo::find($SchoolIfoID);
        if (is_null($rows)) {
            return redirect('schoolinfo')->withMessage('School Detail Not Found');
        }
       //  $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
        return view('Schoolinfo.edit',compact('rows','children','Images2'));
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
         $this->validate($request,[
            'Name' => 'required',
            'Address' => 'required',  
            'ContactNos' => 'required',
            'SchoolCode' => 'required',
            'reportname' => 'required'
        ]);

        $rows = schoolinfo::find($SchoolIfoID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('schoolinfo');
          }


          $image = Input::file('file');

          if(is_null($image))
           {
           $rows->Name  = $request->Name; 
           $rows->Address  = $request->Address; 
           $rows->ContactNos = $request->ContactNos;
           $rows->SchoolCode = $request->SchoolCode;
           $rows->reportname = $request->reportname;

           $rows->save();
             return redirect('schoolinfo');
           }else {

            $image->move('uploads',$image->getClientOriginalName());

           $rows->Name  = $request->Name; 
           $rows->Address  = $request->Address; 
           $rows->ContactNos = $request->ContactNos;
           $rows->SchoolCode = $request->SchoolCode;
           $rows->reportname = $request->reportname;

              if($image) {
                  var_dump($image->getRealPath());
                  $filename = $image->getClientOriginalName();  

                  $rows->Logo = $filename;
                       }

        $rows->save();
       
         Session::flash('message','School Detail Edited Successfully');
        return redirect('schoolinfo');
           }
    }

    public function schoolinfosearch()
    {
        $searchStr=Input::get('searchString');

        $rows= schoolinfo::where('Name','LIKE', "%$searchStr%")->paginate(20);
        return view('Schoolinfo.list')->with(compact('rows'));   
    }

    public function deleteMultiple(Request $request)
    {
        schoolinfo::destroy($request->categories12); 
         Session::flash('message','School Detail has been deleted successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('schoolinfo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($SchoolIfoID)
    {
        schoolinfo::find($SchoolIfoID)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('schoolinfo');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');
          
    $rows= schoolinfo::where('Name','LIKE',"%$searchStr%")->select('schoolinfos.*')->paginate(10);
dd($rows);
        return view('Schoolinfo.list')->with(compact('rows'));
    }
}
