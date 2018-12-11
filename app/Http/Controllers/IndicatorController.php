<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Indicator;

class IndicatorController extends Controller
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
        $rows=\App\Indicator::orderBy('FinanceType','asc')->paginate(15);
        return view('Indicator.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $district=\App\Indicator::orderBy('Indicators')->lists('TypeName','IndicatorType');
      //  return $district;
      
      return view('Indicator.create')->with(compact('district'));
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = new Indicator();
        if ($request->IndicatorType == "F") {
           $this->validate($request, [
        'IndicatorType' => 'required',
        'Indicators' => 'required',
        'FinanceType' => 'required',
        ]);
        }else{
            $this->validate($request, [
        'IndicatorType' => 'required',
        'Indicators' => 'required',
        ]);
        }
        switch ($request->IndicatorType) {
            case 'S':
         $data->TypeName = "Statistics";
                break;
            case 'F':
        $data->TypeName = "Finance";
                break;
             case 'D':
        $data->TypeName = "Statistical Data";
                break;
            default:
        // $data->TypeName = "Finance";
                break;
        }
        $data->IndicatorType=$request->IndicatorType;
        $data->Indicators=$request->Indicators;
        $data->NationalID= auth()->user()->NationalID;
         if ($request->IndicatorType == "F") {
             $data->FinanceType=$request->FinanceType;
         }
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        return redirect('Indicator');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $district=\App\Indicator::orderBy('Indicators')->lists('TypeName','IndicatorType');

          $rows=\App\Indicator::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Indicator.index');
          }

        
      
      return view('Indicator.show')->with(compact('rows','district'));          
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district=\App\Indicator::orderBy('Indicators')->lists('TypeName','IndicatorType');

          $rows=\App\Indicator::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Indicator.index');
          }

        
      
      return view('Indicator.edit')->with(compact('rows','district'));       
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
         if ($request->IndicatorType == "F") {
           $this->validate($request, [
        'IndicatorType' => 'required',
        'Indicators' => 'required',
        'FinanceType' => 'required',
        ]);
        }else{
            $this->validate($request, [
        'IndicatorType' => 'required',
        'Indicators' => 'required',
        ]);
        }
         $data=Indicator::find($id);
        $data->IndicatorType=$request->IndicatorType;
        $data->Indicators=$request->Indicators;
        if ($request->IndicatorType == "F") {
             $data->FinanceType=$request->FinanceType;
         }
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('Indicator');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Indicator::find($id)->delete();
        \Session::flash('message','Record Deleted!');
        \Session::flash('alert-class','alert-danger');
        return redirect ('Indicator');
    }
}
