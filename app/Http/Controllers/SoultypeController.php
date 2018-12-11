<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Soultype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SoultypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Soultype::where('NationalID',auth()->user()->NationalID)->paginate(10);
        return view('soultype.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('soultype.create');
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
          $classes = new Soultype;
          $classes->name = $value->name;
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
        $rows = Soultype::find($id);
         if (is_null($rows))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('soultype');
        }
        return view('soultype.show',compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $rows = Soultype::find($id);
         if (is_null($rows))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('soultype');
        }
        return view('soultype.edit',compact('rows'));
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
            'name' => 'required|string'
        ]);
        $rows = Soultype::find($id);
        $rows->name = $request->name;
        $rows->save();
         Session::flash('message','Records Updated!');
            Session::flash('alert-class','alert-warning');            
            return redirect('soultype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rows = Soultype::find($id)->delete();
        Session::flash('message','Records Deleted!');
            Session::flash('alert-class','alert-danger');            
            return redirect('soultype');
    }

    public function search(Request $request)
    {//return $request->all();
        $rows = Soultype::where('NationalID',auth()->user()->NationalID)->where('name','LIKE','%' .$request->searchString.  '%')->paginate(10);
        return view('soultype.list',compact('rows'));
    }
}
