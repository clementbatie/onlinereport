<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\National;

class NationalController extends Controller
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
        $rows=\App\National::paginate(15);
        return view('National.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('National.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  return $request->all();
        $this->validate($request, [
        'NationalName' => 'required',
        'NationalCode' => 'required|numeric',
        ]);
         $data = new National();
        $data->NationalName=$request->NationalName;
        $data->NationalCode=$request->NationalCode;  
       // $data->id=auth()->user()->id;         
        $data->save();
        return redirect('National');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $rows=\App\National::find($id);

          if (is_null($rows))
          {
            \Session::flash('message','Records could not be found!');
            \Session::flash('alert-class','alert-warning');            
            return redirect('National');
          }
      return view('National.show')->with(compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows=\App\National::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Data could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('National.index');
          }
        
          return view('National.edit')->with(compact('rows','department'));
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
        $data=National::find($id);
        $data->NationalName=$request->NationalName;
        $data->NationalCode=$request->NationalCode;  
      //  $data->id=auth()->user()->id;         
        $data->save();
        \Session::flash('message','Data is updated!');
        \Session::flash('alert-class','alert-success');
        
        return redirect('National');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        National::find($id)->delete();
        return redirect ('National');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');
        $rows=\App\National::orderBy('NationalName', 'desc')
            ->where('NationalName','LIKE', "%$searchStr%")            
            ->paginate(10);
        return view('National.list')->with(compact('rows'));
      }
}
