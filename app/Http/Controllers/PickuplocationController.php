<?php

namespace App\Http\Controllers;

use App\Busroute;
use App\Http\Requests;
use App\Models\Area;
use App\Pickuplocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PickuplocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Pickuplocation::where('AreaID',auth()->user()->AreaID)->paginate(10);
        return view('pickuplocation.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = Busroute::where('AreaID',auth()->user()->AreaID)->lists('route','id');
        return view('pickuplocation.create',compact('area'));
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
          $busroutes = new Pickuplocation;
          $busroutes->location = $value->pickuplocation;
          $busroutes->busroute_id = $value->busroute;
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
         $rows = Pickuplocation::find($id);
         if (is_null($rows))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('pickuplocation');
        }
        $area = Busroute::where('AreaID',auth()->user()->AreaID)->lists('route','id');
        return view('pickuplocation.show',compact('rows','area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows = Pickuplocation::find($id);
         if (is_null($rows))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('pickuplocation');
        }
        $area = Busroute::where('AreaID',auth()->user()->AreaID)->lists('route','id');
        return view('pickuplocation.edit',compact('rows','area'));
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
            'location' => 'required'
        ]);
         $busroutes = Pickuplocation::find($id);
         if (is_null($busroutes))
        {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('busroute');
        }
          $busroutes->location = $request->location;
          $busroutes->user_id = auth()->user()->id;
          $busroutes->AreaID = auth()->user()->AreaID;
          $busroutes->save();

           Session::flash('message','Records Updated!');
            Session::flash('alert-class','alert-success');     
          return redirect("pickuplocation");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          Pickuplocation::find($id)->delete();
         Session::flash('message','Records Deleted!');
            Session::flash('alert-class','alert-danger');     
          return redirect("pickuplocation");
    }
}
