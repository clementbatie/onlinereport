<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\teacher;
use App\year_term_setup;
use Session;
use Illuminate\Support\Facades\Input;


class TeachersetupController extends Controller
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

        $rows = teacher::where('SchoolCode',auth()->user()->SchoolCode)->paginate(15);
        return view('Setupteachers.list',compact('rows','getYear','getTerm'));
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

        return view('Setupteachers.create',compact('getYear','getTerm'));
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

            foreach ($data->data as $value) {
             $value = (object)$value;

             $person = teacher::where('PhoneNo',$value->phonenumber)->where('SchoolCode',auth()->user()->SchoolCode);
              if ($person->exists()) {
                  $person = $person->get(['TeacherSetupName','PhoneNo'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'person' => $person
                  ]);
                }  
            }

           foreach ($data->data as $value) {
           $value = (object)$value;
           $member = new teacher;
           $member->TeacherSetupName = $value->name;
           $member->PhoneNo = $value->phonenumber;

           $member->SchoolCode = auth()->user()->SchoolCode;
           
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
    public function show($TeachersetupID)
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

       $rows1 = teacher::find($TeachersetupID);

        if (is_null($rows1)) {
        return redirect('teachersetup')->withMessage('Teacher Not Found');
        }

        return view('Setupteachers.show',compact('rows1','getYear','getTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($TeachersetupID)
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;
    
        $rows1 = teacher::find($TeachersetupID);

        if (is_null($rows1)) {
        return redirect('teachersetup')->withMessage('Teacher Not Found');
        }

    return view('Setupteachers.edit',compact('rows1','getYear','getTerm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $TeachersetupID)
    {
        $this->validate($request,[
           'TeacherSetupName' => 'required',
            
            
        ]);

        $UserEmailUser = teacher::where('teachers.SchoolCode',auth()->user()->SchoolCode)->where('PhoneNo',$request->PhoneNo);

              if ($UserEmailUser->exists()) {

                  Session::flash('message','Phone Number Already Exit, Change Phone Name');
                  return redirect('teachersetup');
                }  


        $rows = teacher::find($TeachersetupID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('teachersetup');
          }

           $rows->TeacherSetupName = $request->TeacherSetupName; 
           $rows->PhoneNo = $request->PhoneNo;

           $rows->SchoolCode = auth()->user()->SchoolCode;

           $rows->save();
        Session::flash('message','Teacher Has Been Edited Successfully!');

        return redirect('teachersetup');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($TeachersetupID)
    {
        teacher::find($TeachersetupID)->delete();
        \Session::flash('message','Teacher Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect('teachersetup');
    }

    public function deleteMultiple(Request $request)
    {
        teacher::destroy($request->categories6); 
         Session::flash('message','Teacher has been deleted successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('teachersetup');
    }

     public function search()
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

     $searchStr=Input::get('searchString');
          
    $rows= teacher::where('TeacherSetupName','LIKE',"%$searchStr%")->where('SchoolCode',auth()->user()->SchoolCode)->select('teachers.*')->paginate(10);
        return view('Setupteachers.list')->with(compact('rows','getYear','getTerm'));
    }
}
