<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Term;
use App\Student;
use App\Classes;
use App\Schoolinfo;
use App\year_term_setup;

use Session;
use Illuminate\Support\Facades\Input;

class TermController extends Controller
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

        $rows = Term::where('SchoolCode',auth()->user()->SchoolCode)->paginate(10);
        return view('Term.list', compact('rows','getYear','getTerm'));
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

        $maincatg = ['ggg'=>'ggg'];
        return view('Term.create',compact('maincatg','getTerm','getYear'));
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
            
           foreach ($data->data as $key => $value) {
          $value = (object)$value;

                $UserEmailUser = Term::where('terms.SchoolCode',auth()->user()->SchoolCode)->where('TermName',$value->termid);

              if ($UserEmailUser->exists()) {

              $UserEmailUser = $UserEmailUser->leftjoin('schoolinfos','terms.SchoolCode','=','schoolinfos.SchoolCode')->get(['TermName','schoolinfos.Name'])->toArray();

              //dd($UserEmailUser);
                  return response()->json([
                      'message' => 'exists',
                      'UserEmailUser' => $UserEmailUser
                  ]);
                }  
            }

            foreach ($data->data as $value) {
           
             $value = (object)$value;
           $member = new Term;
           $member->TermName = $value->termid; 
           // $member->SchoolCode = $value->schoolcode; 
           $member->SchoolCode = auth()->user()->SchoolCode; 

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
          }
            return response()->json(['message' => 'correct']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($TermID)
    {

        $rows = Term::find($TermID);
        if(is_null($rows)){
            Session::flash('message','record could not be found!');
            Session::flash('alert_class','alert_warning');
            return redirect('term');
        }

      
        return view('Term.show',compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($TermID)
    {
        $rows = Term::find($TermID);
        if(is_null($rows)){
            Session::flash('message','record could not be found!');
            Session::flash('alert_class','alert_warning');
            return redirect('term');
        }

      
        return view('Term.edit',compact('rows'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $TermID)
    {
        $this->validate($request,[
           'TermName' => 'required',
            // 'SchoolCode' => 'required',

        ]);

         $UserEmailUser = Term::where('terms.SchoolCode',auth()->user()->SchoolCode)->where('TermName',$request->TermName);

              if ($UserEmailUser->exists()) {

                  Session::flash('message','Term Already Exit, Change Term Name');
                  return redirect('term');
                }  


        $rows = Term::find($TermID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('term');
          }

           $rows->TermName = $request->TermName; 
           // $rows->SchoolCode = $request->SchoolCode; 

        $rows->save();
        Session::flash('message','Term Has Been Edited Successfully!');
        return redirect('term');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($TermID)
    {
        Term::find($TermID)->delete();
        \Session::flash('message','Term Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect('term');
    }

    public function deleteMultiple(Request $request)
    {
        Term::destroy($request->categories4); 
         Session::flash('message','Term Has Been Deleted Successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('term');
    }

     public function search()
    {
        $searchStr=Input::get('searchString');
          
    $rows= Term::where('TermName','LIKE',"%$searchStr%")->where('SchoolCode',auth()->user()->SchoolCode)->select('terms.*')->paginate(10);

        return view('Term.list')->with(compact('rows'));
    }
}
