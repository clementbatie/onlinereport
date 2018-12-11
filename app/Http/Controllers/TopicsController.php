<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Topic;
use \Session;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Topic::where('AssemblyID',auth()->user()->CellID)->paginate(20);
        return view('Topics.list')->with(compact('rows'));
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
         $rows = Topic::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Topics.index');
          }
 
      return view('Topics.show')->with(compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $rows = Topic::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Topics.index');
          }
 
      return view('Topics.edit')->with(compact('rows'));
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
        $rows = Topic::find($id);

        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Topics.index');
          }

        $rows->comments = $request->comments;
        $rows->date = $request->date;
        $rows->facilitator = $request->facilitator;
        $rows->topic = $request->topic;
        $rows->save();
        Session::flash('message','Records Added');
        Session::flash('alert-class','alert-success');   
        return redirect('Topics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Topic::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Topics');
    }
}
