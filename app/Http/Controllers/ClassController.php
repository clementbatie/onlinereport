<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Classes::where('NationalID',auth()->user()->NationalID)->paginate(10);
        //dd($rows);
        return view('classes.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classes.create');
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
          $classes = new Classes;
          $classes->classname = $value->classname;
          $classes->user_id = auth()->user()->id;
          $classes->NationalID = auth()->user()->NationalID;
          $classes->save();
      }

      return response()->json(['message' => 'correct']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $rows = Classes::find($id);
         if (is_null($rows))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classes');
        }
        return view('classes.show',compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows = Classes::find($id);
         if (is_null($rows))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classes');
        }
        return view('classes.edit',compact('rows'));
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
            'classname' => 'required'
        ]);
         $classes = Classes::find($id);
         if (is_null($classes))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('classes');
        }
          $classes->classname = $request->classname;
          $classes->user_id = auth()->user()->id;
          $classes->NationalID = auth()->user()->NationalID;
          $classes->save();

           Session::flash('message','Records Updated!');
            Session::flash('alert-class','alert-success');     
          return redirect("classes");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rows = Classes::find($id)->delete();
        Session::flash('message','Records Deleted!');
            Session::flash('alert-class','alert-danger');            
            return redirect('classes');
    }

    public function search(Request $request)
    {
        $rows = Classes::where('NationalID',auth()->user()->NationalID)->where('classname','LIKE','%'.$request->searchString.'%')->paginate(10);
        return view('classes.list',compact('rows'));
    }
}
