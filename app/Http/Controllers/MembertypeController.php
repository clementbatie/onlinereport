<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Membertype;
use Illuminate\Support\Facades\Input;

class MembertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        if (auth()->user()->UserLevelID != 4 ) {
            return redirect('/');
        }
    } 

    public function index()
    {
        if (auth()->user()->UserLevelID != 4 ) {
            return redirect('/');
        }
        $rows = Membertype::where('NationalID',auth()->user()->NationalID)->paginate(30);
        return view('membertype.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->UserLevelID != 4 ) {
            return redirect('/');
        }
        return view('membertype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data;
        foreach ($data['data'] as $value) {
            $value = (object)$value;
            $membertype = new Membertype;
            $membertype->typename = $value->membertype;
            $membertype->NationalID = auth()->user()->NationalID;
            $membertype->save();

        }
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows= Membertype::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('membertype.index');
          }
 
      return view('membertype.show')->with(compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->UserLevelID != 4 ) {
            return redirect('/');
        }
        $rows= Membertype::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('membertype.index');
          }
 
      return view('membertype.edit')->with(compact('rows'));
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
                'typename' => 'required'
        ]);
                $membertype = Membertype::find($id);
                if (is_null($membertype))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('membertype.index');
          }
            $membertype->typename = $request->typename;
           
            $membertype->save();
           \Session::flash('message','Member type updated');
            return redirect('membertype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->UserLevelID != 4 ) {
            return redirect('/');
        }
        Membertype::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('membertype');
    }

    public function search(Request $request)
    {
        $searchStr=Input::get('searchString');

        $rows=Membertype::where('typename','LIKE', "%$searchStr%")->orderBy('typename','asc')->paginate(30);
        return view('membertype.list')->with(compact('rows'));       
    }
}
