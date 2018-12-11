<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Title;
use \Session;
use Illuminate\Support\Facades\Input;

class TitlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->UserLevelID == 1) {
            $rows= Title::where('NationalID',auth()->user()->NationalID)->paginate(15);
        }elseif (auth()->user()->UserLevelID == 4) {
            $rows= Title::where('NationalID',auth()->user()->NationalID)->paginate(15);
        }else{
            return redirect('/');
        }
      
      //   dd($rows);
        return view('Titles.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Titles.create');
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

        $title = new Title;
        $title->title = $value['title']; 
        $title->NationalID = auth()->user()->NationalID;
        $title->entry_user = auth()->user()->id;
        $title->save();
            }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows= Title::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Titles.index');
          }
 
      return view('Titles.show')->with(compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows=Title::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Titles.index');
          }
 
      return view('Titles.edit')->with(compact('rows'));
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
        $rows=Title::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Titles.index');
          }
        $rows->title = $request->title;
        $title->entry_user = auth()->user()->id;
        $rows->save();
        Session::flash('message','Records Added');
        Session::flash('alert-class','alert-success');   
        return redirect('Titles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Title::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Titles');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');

        $rows=Title::where('NationalID',auth()->user()->NationalID)->where('title','LIKE', "%$searchStr%")->orderBy('title','asc')->paginate(10);
        return view('Titles.list')->with(compact('rows'));       
    }
}
