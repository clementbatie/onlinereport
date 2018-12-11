<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\subject;
use App\classes;
use App\subjectsetup;

use Session;
use Illuminate\Support\Facades\Input;

class subjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = subject::where('subjects.SchoolCode',auth()->user()->SchoolCode)->leftjoin('subjectsetups','subjects.SubjectName','=','subjectsetups.SubjectSetupID')->leftjoin('classes','subjects.ClassID','=','classes.ClassID')->select('subjects.*','classes.ClassName','subjectsetups.SubjectName')->paginate(10);

        return view('Subject.list', compact('rows'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = subjectsetup::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectSetupID');
        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        return view('Subject.create', compact('Class','subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = (object)$request->data;
            
          // foreach ($data->data as $value) {
          //    $value = (object)$value;

          //    $person = subject::where('PhoneNo',$value->phonenumber)->where('SchoolCode',auth()->user()->SchoolCode);
          //     if ($person->exists()) {
          //         $person = $person->get(['TeacherSetupName','PhoneNo'])->toArray();
          //         return response()->json([
          //             'message' => 'exists',
          //             'person' => $person
          //         ]);
          //       }  
          //   }

            foreach ($data->data as $value) {
           
             $value = (object)$value;
           $member = new subject;
           $member->SubjectName = $value->subjectname; 
           $member->ClassID = $value->classID; 
           $member->SchoolCode  = auth()->user()->SchoolCode;
           
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
                case '2':
              $member->EntryUser = auth()->user()->UserLevelID;
              //$meeting->NationalID = auth()->user()->NationalID;
                break;
            default:
            break;   
          }
        
           $member->save();
          }
            return response()->json(['message' => 'correct']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($SubjectID)
    {
        $subject = subjectsetup::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectSetupID');
        $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');

        $rows = subject::find($SubjectID);
        if(is_null($rows)){
            Session::flash('message','record could not be found!');
            Session::flash('alert_class','alert_warning');
            return redirect('subject');
        }

      
        return view('subject.show',compact('rows','staff','Class','subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($SubjectID)
    {
        $subject = subjectsetup::where('SchoolCode',auth()->user()->SchoolCode)->lists('SubjectName','SubjectSetupID');
         $Class = classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
     
        $rows = subject::find($SubjectID);
        if(is_null($rows)){
            Session::flash('message','Records could not be found');
            Session::flash('alert-class','alert-warning');
            return redirect('subject');
        }   

         return view('Subject.edit',compact('rows','staff','Class','subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $SubjectID)
    {
        $this->validate($request,[
           'SubjectName' => 'required',
            'ClassID' => 'required',
          
            

        ]);


        $rows = subject::find($SubjectID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('subject');
          }

           $rows->SubjectName = $request->SubjectName; 
           $rows->ClassID = $request->ClassID;    
           $rows->SchoolCode = auth()->user()->SchoolCode;

        $rows->save();
        Session::flash('message','Subject Has Been Edited Successfully!');

        return redirect('subject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($SubjectID)
    {
        subject::find($SubjectID)->delete();
        \Session::flash('message','Subject Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect('subject');
    
    }

     public function delete2(Request $request)
     {//dd(5);
    //     rent::find($RentID)->delete();
    //     \Session::flash('message','Rent Has Been Deleted Successfully!');
    //     \Session::flash('alert-class','alert-warning');

         subject::destroy($request->categories1); 
         Session::flash('message','Subject Has Been Deleted Successfully!');
         Session::flash('alert-class','alert-warning');
        return redirect ('subject');  
    }

    public function deleteMultiple(Request $request)
    {
        subject::destroy($request->categories7); 
         Session::flash('message','Subject has been deleted successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('subject');
    }


    public function search()
    {
     $searchStr=Input::get('searchString');
          
    $rows= subject::where('SubjectName','LIKE',"%$searchStr%")->leftjoin('classes','subjects.ClassID','=','classes.ClassID')->select('subjects.*','classes.ClassName')->paginate(15);
        return view('Subject.list')->with(compact('rows'));
    }
}
