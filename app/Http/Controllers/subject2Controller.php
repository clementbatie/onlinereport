<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\subjectsetup;
use App\year_term_setup;
use Session;
use Illuminate\Support\Facades\Input;

class subject2Controller extends Controller
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

        $rows = subjectsetup::where('SchoolCode',auth()->user()->SchoolCode)->paginate(15);
        //dd($rows);

        return view('SubjectSetup.list',compact('rows','getYear','getTerm'));
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

        return view('SubjectSetup.create',compact('getTerm','getYear'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (object) $request->data;
            
            foreach ($data->data as $value) {
             $value = (object)$value;

             $person = subjectsetup::where('SubjectName',$value->subjectname)->where('SchoolCode',auth()->user()->SchoolCode);
              if ($person->exists()) {
                  $person = $person->get(['SubjectName'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'person' => $person
                  ]);
                }  
            }
            
            foreach ($data->data as $value) {

           $value = (object)$value;
           $member = new subjectsetup;
           $member->SubjectName  = $value->subjectname; 
           $member->SchoolCode  = auth()->user()->SchoolCode; 
          
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
    public function show($SubjectSetupID)
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows = subjectsetup::find($SubjectSetupID);
        if (is_null($rows)) {
            return redirect('subject2')->withMessage('Class Not Found');
        }
       
        return view('SubjectSetup.show',compact('rows','children','getYear','getTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($SubjectSetupID)
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows = subjectsetup::find($SubjectSetupID);
        if (is_null($rows)) {
            return redirect('subject2')->withMessage('Class Not Found');
        }
    
        return view('SubjectSetup.edit',compact('rows','children','getYear','getTerm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $SubjectSetupID)
    {
         $this->validate($request,[
            'SubjectName' => 'required',
           
        ]);

         $UserEmailUser = subjectsetup::where('SchoolCode',auth()->user()->SchoolCode)->where('SubjectName',$request->SubjectName);

              if ($UserEmailUser->exists()) {

                  Session::flash('message','Subject Already Exit, Change Subject Name');
                  return redirect('subject2');
                } 

        $rows = subjectsetup::find($SubjectSetupID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('subject2');
          }

           $rows->SubjectName  = $request->SubjectName; 
           $rows->SchoolCode  = auth()->user()->SchoolCode; 
          
           $rows->save();

        Session::flash('message','Subject Edited Successfully');
        return redirect('subject2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($SubjectSetupID)
    {
         subjectsetup::find($SubjectSetupID)->delete();
        \Session::flash('message','Subject has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('subject2');
    }

    public function deleteMultiple(Request $request)
    {
        subjectsetup::destroy($request->categories7); 
         Session::flash('message','Subject has been deleted successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('subject2');
    }
    
     public function search()
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $searchStr=Input::get('searchString');

        $rows= subjectsetup::where('SubjectName','LIKE', "%$searchStr%")->where('SchoolCode',auth()->user()->SchoolCode)->paginate(20);
        return view('SubjectSetup.list')->with(compact('rows','getYear','getTerm'));
    }
     
}
