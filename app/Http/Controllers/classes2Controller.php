<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\classes;
use App\year_term_setup;
use Session;
use Illuminate\Support\Facades\Input;

class classes2Controller extends Controller
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

         $rows = Classes::where('SchoolCode',auth()->user()->SchoolCode)->paginate(15);
       // dd($rows);
         //dd(3);
        return view('classes.list',compact('rows','getYear','getTerm'));
        
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

        return view('classes.create',compact('getYear','getTerm'));
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
            
            foreach ($data->data as $key => $value) {
          $value = (object)$value;

          $UserEmailUser = Classes::where('classes.SchoolCode',auth()->user()->SchoolCode)->where('ClassName',$value->Name);

              if ($UserEmailUser->exists()) {
               
              $UserEmailUser = $UserEmailUser->leftjoin('schoolinfos','classes.SchoolCode','=','schoolinfos.SchoolCode')->get(['ClassName','schoolinfos.Name'])->toArray();

                  return response()->json([
                      'message' => 'exists',
                      'UserEmailUser' => $UserEmailUser
                  ]);
                }  
            }


            foreach ($data->data as $value) {

           $value = (object)$value;
           $member = new classes;
           $member->ClassName  = $value->Name; 
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
    public function show($ClassID)
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows = classes::find($ClassID);
        if (is_null($rows)) {
            return redirect('classes')->withMessage('Class Not Found');
        }
        // $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
        return view('classes.show',compact('rows','children','getYear','getTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ClassID)
    {
        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        $rows = classes::find($ClassID);
        if (is_null($rows)) {
            return redirect('classes')->withMessage('Class Not Found');
        }
        // $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
        return view('classes.edit',compact('rows','children','getYear','getTerm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ClassID)
    {
        $this->validate($request,[
            'ClassName' => 'required',
            // 'SchoolCode' => 'required',  
           
        ]);

        $UserEmailUser = Classes::where('classes.SchoolCode',auth()->user()->SchoolCode)->where('ClassName',$request->ClassName);

              if ($UserEmailUser->exists()) {

                  Session::flash('message','Class Already Exit, Change Class Name');
                  return redirect('classes');
                }  

        $rows = classes::find($ClassID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classes');
          }

           $rows->ClassName  = $request->ClassName; 
           // $rows->SchoolCode  = $request->SchoolCode; 
          
           $rows->save();

        Session::flash('message','Class has been edited successfully');
        return redirect('classes');
    }

    public function destroy2()
    {
        dd(5);
        $searchStr=Input::get('searchString');

        $rows= classes::where('Name','LIKE', "%$searchStr%")->paginate(20);
        return view('Schoolinfo.list')->with(compact('rows'));
    }


    public function classessearch(Request $request)
    {
        $searchStr=Input::get('searchString');

        $rows= Classes::where('ClassName','LIKE', "%$searchStr%")->where('SchoolCode',auth()->user()->SchoolCode)->select('Classes.*')->paginate(10);

        return view('classes.list')->with(compact('rows'));    
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ClassID)
    {
         Classes::find($ClassID)->delete();
        \Session::flash('message','Class has been deleted successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('classes');
    }

    public function deleteMultiple(Request $request)
    {
        Classes::destroy($request->categories5); 
         Session::flash('message','Classes has been deleted successfully!');
         Session::flash('alert-class','alert-warning');

        return redirect ('classes');
    }
}
