<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\classinfo;
use App\Classes;
use App\year_term_setup;
use Session;
use Illuminate\Support\Facades\Input;

class classinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = classinfo::leftjoin('terms','classinfos.Term','=','terms.TermID')->where('classinfos.SchoolCode',auth()->user()->SchoolCode)->leftjoin('classes','classinfos.ClassID','=','classes.ClassID')->select('classinfos.*','classes.ClassName','TermName')->paginate(10);
        //dd($rows);

        return view('Classinfo.list', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();
        //   // $string = str_replace(array('[',']'),'',$Year);


        //   //      $AA = str_replace('"', '', $string);
        // $getYear = $Year[0]->Year;
        
        // $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

       
        $Classname = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        return view('Classinfo.create', compact('Classname','Year','Term'));
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

         $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();

        $getTerm = $Year[0]->TermID;

        $getYear = $Year[0]->Year;

         foreach ($data->data as $value) {
               $value = (object)$value;
            
           $person = classinfo::where('classinfos.ClassID',$value->classid)->where('Term',$getTerm)->where('classinfos.SchoolCode',auth()->user()->SchoolCode);

              if ($person->exists()) {
                  $person = $person->leftjoin('classes','classinfos.ClassID','=','classes.ClassID')->leftjoin('terms','classinfos.Term','=','terms.TermID')->get(['ClassName','TermName'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'person' => $person
                  ]);
                }
                }  
            

            foreach ($data->data as $value) {
           
             $value = (object)$value;
           $member = new classinfo;
           $member->ClassID = $value->classid; 
           $member->OnRoll = $value->onroll; 
           $member->NextTermBegins = $value->begindate;
           $member->SchoolCloses = $value->closedate;
           
           $member->Year = $getYear;
           $member->Term = $getTerm;
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
    public function show($ClassInfoID)
    {
        $Classname = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

        $rows = classinfo::find($ClassInfoID);
        if(is_null($rows)){
            Session::flash('message','record could not be found!');
            Session::flash('alert_class','alert_warning');
            return redirect('classinfo');
        }

      
        return view('Classinfo.show',compact('rows','staff','building','Classname','Year','Term'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ClassInfoID)
    {
          $Classname = Classes::where('SchoolCode',auth()->user()->SchoolCode)->lists('ClassName','ClassID');
          $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->lists('Year','Year');
        $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->lists('terms.TermName','year_term_setups.TermID');

        $rows = classinfo::find($ClassInfoID);
        if(is_null($rows)){
            Session::flash('message','Records could not be found');
            Session::flash('alert-class','alert-warning');
            return redirect('classinfo');
        }   

        return view('Classinfo.edit',compact('rows','staff','building','Classname','Term','Year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ClassInfoID)
    {
        $this->validate($request,[
           'ClassID' => 'required',
            'OnRoll' => 'required',
            'NextTermBegins' => 'required',
             'SchoolCloses' => 'required', 
             'Year' => 'required',
             'Term' => 'required',
             

        ]);

        $person = classinfo::where('ClassID',$request->ClassID)->where('SchoolCode',auth()->user()->SchoolCode);

              if ($person->exists()) {

                  Session::flash('message','Class Information Record Already Exit, Check and EDit Again');
                  return redirect('classinfo');
                } 



        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();

        $getTerm = $Year[0]->TermID;

        $getYear = $Year[0]->Year;


        $rows = classinfo::find($ClassInfoID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classinfo');
          }

           $rows->ClassID = $request->ClassID; 
           $rows->OnRoll = $request->OnRoll; 
           
           $rows->NextTermBegins = $request->NextTermBegins;
           $rows->SchoolCloses = $request->SchoolCloses;
           $rows->Year = $getYear;
           $rows->Term = $getTerm;
           $rows->SchoolCode = auth()->user()->SchoolCode;

        $rows->save();
        Session::flash('message','Class Information Has Been Edited Successfully!');
        return redirect('classinfo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ClassInfoID)
    {
        classinfo::find($ClassInfoID)->delete();
        \Session::flash('message','Class Information Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect('classinfo');
    }

     public function deleteMultiple(Request $request)
    {
        classinfo::destroy($request->categories9); 
         Session::flash('message','Class Information has been deleted successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('classinfo');
    }

    
    public function classinfosearch()
    {
        $searchStr=Input::get('searchString');
          
    $rows= classinfo::where('ClassName','LIKE',"%$searchStr%")->where('Classinfos.SchoolCode',auth()->user()->SchoolCode)->leftjoin('classes','classinfos.ClassID','=','classes.ClassID')->select('classinfos.*','classes.ClassName')->paginate(10);

        return view('Classinfo.list')->with(compact('rows'));
    }
}
