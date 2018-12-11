<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\year_term_setup;
use App\Term;
use App\Schoolinfo;
use Database\seeds\DatabaseSeeder;
use Session;
use Illuminate\Support\Facades\Input;

class yeartermsetupController extends Controller
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

        if (auth()->user()->UserLevelID == 4) {
            $rows = year_term_setup::leftjoin('schoolinfos','year_term_setups.SchoolCode','=','schoolinfos.SchoolCode')->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->select('year_term_setups.*','terms.TermName','schoolinfos.Name')->paginate(10);
//dd($rows);
        return view('YearTermSetup.list', compact('rows','getYear','getTerm'));
        }else{

            $rows = year_term_setup::leftjoin('schoolinfos','year_term_setups.SchoolCode','=','schoolinfos.SchoolCode')->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->select('year_term_setups.*','terms.TermName','Name')->paginate(10);

        return view('YearTermSetup.listAdmin', compact('rows','getYear','getTerm'));
        }
        
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

        if (auth()->user()->UserLevelID == 4) {
        $Years = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];
        $Term = Term::where('SchoolCode',auth()->user()->SchoolCode)->lists('TermName','TermID');
        $school = Schoolinfo::lists('Name','SchoolCode');

        return view('YearTermSetup.create', compact('Years','Term','school','getYear','getTerm'));
        }else{

        $Years = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];
        $Term = Term::where('SchoolCode',auth()->user()->SchoolCode)->lists('TermName','TermID');
        $school = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode');

        return view('YearTermSetup.create', compact('Years','Term','school','getYear','getTerm'));
        }
       
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

                $yeartermsetup = year_term_setup::leftjoin('schoolinfos','year_term_setups.SchoolCode','=','schoolinfos.SchoolCode')->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->where('year_term_setups.SchoolCode',$value->SchoolCode);
               
              if ($yeartermsetup->exists()) {
              $yeartermsetup = $yeartermsetup->get(['TermName','year_term_setups.SchoolCode','Name'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'yeartermsetup' => $yeartermsetup
                  ]);
                }  
            }
            
            foreach ($data->data as $value) {
           
           $value = (object)$value;
           $member = new year_term_setup;
           $member->Year  = $value->year; 
           $member->TermID = $value->term; 
           $member->SchoolCode = $value->SchoolCode; 
           
            switch (auth()->user()->UserLevelID) {
            case '1':
              $member->Entry_User = auth()->user()->UserLevelID;
                break;
             case '3':
              $member->Entry_User = auth()->user()->UserLevelID;
                break;
            case '4':
              $member->Entry_User = auth()->user()->UserLevelID;
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
    public function show($Year_Term_SetipID)
    {
       $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        if (auth()->user()->UserLevelID == 4) {
        $Years = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];
        $Term = Term::lists('TermName','TermID');
        $school = Schoolinfo::lists('Name','SchoolCode');

        //return view('YearTermSetup.create', compact('Years','Term','school'));

        $rows= year_term_setup::find($Year_Term_SetipID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('yeartermsetup');
          }
          
    return view('YearTermSetup.show',compact('rows','Class','Term','Years','school','getYear','getTerm'));
        }else{

        $Years = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];
        $Term = Term::where('SchoolCode',auth()->user()->SchoolCode)->lists('TermName','TermID');
        $school = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode');

       // return view('YearTermSetup.create', compact('Years','Term','school'));

        $rows= year_term_setup::find($Year_Term_SetipID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('yeartermsetup');
          }
          
        return view('YearTermSetup.showAdmin',compact('rows','Class','Term','Years','getYear','getTerm'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Year_Term_SetipID)
    {
       $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;

        if (auth()->user()->UserLevelID == 4) {
        $Years = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];
        $Term = Term::lists('TermName','TermID');
        $school = Schoolinfo::lists('Name','SchoolCode');

        //return view('YearTermSetup.create', compact('Years','Term','school'));

        $rows= year_term_setup::find($Year_Term_SetipID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('yeartermsetup');
          }
          
    return view('YearTermSetup.edit',compact('rows','Class','Term','Years','school','getYear','getTerm'));
        }else{

        $Years = ['2018/2019'=>'2018/2019','2019/2020'=>'2019/2020','2020/2021'=>'2020/2021','2021/2022'=>'2021/2022','2022/2023'=>'2022/2023','2023/2024'=>'2023/2024','2024/2025'=>'2024/2025'];
        $Term = Term::where('SchoolCode',auth()->user()->SchoolCode)->lists('TermName','TermID');
        $school = Schoolinfo::where('SchoolCode',auth()->user()->SchoolCode)->lists('Name','SchoolCode');

       // return view('YearTermSetup.create', compact('Years','Term','school'));

        $rows= year_term_setup::find($Year_Term_SetipID);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('yeartermsetup');
          }
          
        return view('YearTermSetup.editAdmin',compact('rows','Class','Term','Years','getYear','getTerm'));
        }


         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Year_Term_SetipID)
    {
         $seeder = new \DatabaseSeeder();
        $seeder->run();

        if (auth()->user()->UserLevelID == 4) {
            $this->validate($request,[
           'Year' => 'required',
            'TermID' => 'required',
            'SchoolCode' => 'required',

        ]);


        $rows = year_term_setup::find($Year_Term_SetipID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('yeartermsetup');
          }


           $rows->Year = $request->Year; 
           $rows->TermID = $request->TermID; 
           $rows->SchoolCode = $request->SchoolCode; 

        $rows->save();
        Session::flash('message','Year/Term Setup Has Been Edited Successfully!');
        return redirect('yeartermsetup');

        }else{

            $this->validate($request,[
           'Year' => 'required',
            'TermID' => 'required',
            'TermBegin' => 'required',
            'TermBegin' => 'required',


        ]);


        $rows = year_term_setup::find($Year_Term_SetipID);
         if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('yeartermsetup');
          }

           $rows->Year = $request->Year; 
           $rows->TermID = $request->TermID; 
           $rows->SchoolCode = auth()->user()->SchoolCode;
           $rows->TermBegin = $request->TermBegin; 
           $rows->TermEnd = $request->TermEnd;  
                   


        $rows->save();
        Session::flash('message','Year/Term Setup Has Been Edited Successfully!');
        return redirect('yeartermsetup');
        }
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Year_Term_SetipID)
    {
        year_term_setup::find($Year_Term_SetipID)->delete();
        \Session::flash('message','Year/Term Setup Has Been Deleted Successfully!');
        \Session::flash('alert-class','alert-warning');
        return redirect('yeartermsetup');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');
          
    $rows= year_term_setup::where('Term','LIKE',"%$searchStr%")->select('year_term_setups.*')->paginate(10);

        return view('YearTermSetup.list')->with(compact('rows'));
    }

     public function transfer()
    { dd(6);
        //$rows = Terminalscore::all();

        $seeder = new \DatabaseSeeder();
        $seeder->run();
       // \Session::flash('message','Records Has Been Sent to History Successfully');
          // $rows->delete();
        // \Session::flash('alert-class','alert-warning');
         return redirect ('term');
    }
}
