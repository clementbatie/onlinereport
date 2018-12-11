<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use App\Models\Assembly;
use App\Models\Area;
use App\Models\District;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Input;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');  //enable this for auth! //**************todo
    } 

    public function index()
    {
        if (auth()->user()->UserLevelID == 2) {
            $rows=\App\Models\Finance::join('Assembly', 'Assembly.AssemblyCode', '=', 'Finance.AssemblyID')->where('DistrictID',auth()->user()->DistrictID)->orderBy('date','desc')->paginate(15);
        }elseif (auth()->user()->UserLevelID == 3) {
            $rows=\App\Models\Finance::join('Assembly', 'Assembly.AssemblyCode', '=', 'Finance.AssemblyID')->where('AssemblyCode',auth()->user()->CellID)->orderBy('date','desc')->paginate(15);
        }else{
            return redirect('/');
        }
       
      //  dd($rows);
        return view('Finance.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $rows=\App\Models\Finance::join('Assembly', 'Assembly.AssemblyCode', '=', 'Finance.AssemblyID')->orderBy('date','desc')->find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Finance.index');
          }
 
      return view('Finance.show')->with(compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows=\App\Models\Finance::join('Assembly', 'Assembly.AssemblyCode', '=', 'Finance.AssemblyID')->orderBy('date','desc')->find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Finance.index');
          }
 
      return view('Finance.edit')->with(compact('rows'));
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
        $rows=\App\Models\Finance::join('Assembly', 'Assembly.AssemblyCode', '=', 'Finance.AssemblyID')->orderBy('date','desc')->find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Finance.index');
          }
        $rows->IndValues = $request->IndValues;
        $rows->date = $request->date;
        $rows->save();
        Session::flash('message','Records Added');
        Session::flash('alert-class','alert-success');   
        return redirect('Finance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Finance::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Finance');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\Models\Assembly::orderBy('AssemblyID', 'desc')
            ->where('AssemblyName','LIKE', "%$searchStr%")            
            ->paginate(10);
        $rows=\App\Models\Finance::join('Assembly', 'Assembly.AssemblyCode', '=', 'Finance.AssemblyID')->orderBy('date','desc')->where('Assembly.AssemblyName','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('Finance.list')->with(compact('rows'));       
    }

    public function approvefinance()
    {
        switch (auth()->user()->UserLevelID) {
            case '2':
           $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
                break;
            case '1':
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
                break;
            case '4':
            $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
           $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
                break;
            
            default:
              $assemblies = [];
                break;
        }
        $rows = Finance::whereIn('finance.AssemblyID',$assemblies)->where('Activity_State',0)->where('IndicatorType','F')->leftjoin('assembly','assembly.AssemblyCode','=','finance.AssemblyID')
        ->select('finance.*','assembly.AssemblyName')->orderBy('created_at')->paginate(30);
        return view('Finance.approve',compact('rows'));
    }

    public function approvestats()
    {
        switch (auth()->user()->UserLevelID) {
            case '2':
           $assemblies = Assembly::where('DistrictID',auth()->user()->DistrictID)->lists('AssemblyCode');
                break;
            case '1':
            $districts = District::where('AreaID',auth()->user()->AreaID)->lists('DistrictID');
           $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
                break;
            case '4':
            $areas = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $districts = District::whereIn('AreaID',$areas)->lists('DistrictID');
           $assemblies = Assembly::whereIn('DistrictID',$districts)->lists('AssemblyCode');
                break;
            
            default:
              $assemblies = [];
                break;
        }
        $rows = Finance::whereIn('finance.AssemblyID',$assemblies)->where('Activity_State',0)->where('IndicatorType','S')->leftjoin('assembly','assembly.AssemblyCode','=','finance.AssemblyID')
        ->select('finance.*','assembly.AssemblyName')->orderBy('created_at')->paginate(30);
        return view('Finance.approvestats',compact('rows'));
    }



    public function approvefinancesave($id)
    {
        $finance = Finance::find($id);
        if (is_null($finance))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('finances.approve');
          }
          $finance->Activity_State = 1;
          $finance->save();
          \Session::flash('alert-class','alert-success');
          \Session::flash('message','Finance Accepted');
        return redirect('approvefinance');
    }

    public function approvestatssave($id)
    {
        $finance = Finance::find($id);
        if (is_null($finance))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('finances.stats');
          }
          $finance->Activity_State = 1;
          $finance->save();
          \Session::flash('alert-class','alert-success');
          \Session::flash('message','Record Accepted');
        return redirect('approvestats');
    }
}
