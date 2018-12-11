<?php

namespace App\Http\Controllers;

use App\Busroute;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BusrouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Busroute::where('AreaID',auth()->user()->AreaID)->paginate(10);
        return view('busroute.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('busroute.create');
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
          $busroutes = new Busroute;
          $busroutes->route = $value->route;
          $busroutes->user_id = auth()->user()->id;
          $busroutes->AreaID = auth()->user()->AreaID;
          $busroutes->save();
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
        $rows = Busroute::find($id);
         if (is_null($rows))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('busroute');
        }
        return view('busroute.show',compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $rows = Busroute::find($id);
         if (is_null($rows))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('busroute');
        }
        return view('busroute.edit',compact('rows'));
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
            'route' => 'required'
        ]);
         $busroutes = Busroute::find($id);
         if (is_null($busroutes))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('busroute');
        }
          $busroutes->route = $request->route;
          $busroutes->user_id = auth()->user()->id;
          $busroutes->AreaID = auth()->user()->AreaID;
          $busroutes->save();

           Session::flash('message','Records Updated!');
            Session::flash('alert-class','alert-success');     
          return redirect("busroute");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Busroute::find($id)->delete();
         Session::flash('message','Records Deleted!');
            Session::flash('alert-class','alert-danger');     
          return redirect("busroute");
    }
}
