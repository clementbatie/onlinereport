<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Duestype;
use Session;

class DuestypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Duestype::where('NationalID',auth()->user()->NationalID)->paginate(50);
        return view('Duestype.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Duestype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'duestype_name' => 'required'
        ]);
        $duestype = new Duestype;
        $duestype->duestype_name = $request->duestype_name;
        $duestype->NationalID = auth()->user()->NationalID;
        $duestype->save();

         Session::flash('message','Record Added');
        Session::flash('alert-class','alert-success'); 
        return redirect('Duestype');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows = Duestype::find($id);
        if (!$rows->exists()) {
        Session::flash('message','Record not found');
        Session::flash('alert-class','alert-info'); 
        return redirect('Duestype');
        }
        return view('Duestype.show',compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $rows = Duestype::find($id);
        if (!$rows->exists()) {
        Session::flash('message','Record not found');
        Session::flash('alert-class','alert-info'); 
        return redirect('Duestype');
        }
        return view('Duestype.edit',compact('rows'));
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
         $this->validate($request,[
                'duestype_name' => 'required'
        ]);
        $duestype = Duestype::find($id);
        $duestype->duestype_name = $request->duestype_name;
      //  $duestype->NationalID = auth()->user()->NationalID;
        $duestype->save();

         Session::flash('message','Record Updated');
        Session::flash('alert-class','alert-success'); 
        return redirect('Duestype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $rows = Duestype::find($id);
        if (!$rows->exists()) {
        Session::flash('message','Record not found');
        Session::flash('alert-class','alert-info'); 
        return redirect('Duestype');
        }
            $rows->delete();
        Session::flash('message','Record Deleted');
        Session::flash('alert-class','alert-danger'); 
        return redirect('Duestype');
    }
}
