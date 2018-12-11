<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Leader;
use App\Title;
use App\Models\Area;
use \Session;
use Illuminate\Support\Facades\Input;

class LeadersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->UserLevelID == 1) {
            $rows= Leader::where('AreaID',auth()->user()->AreaID)->paginate(15);
        }elseif (auth()->user()->UserLevelID == 4) {
            $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaID');
            $rows= Leader::wherein('AreaID',$area)->paginate(30);
        }else{
            return redirect('/');
        }
      
      //   dd($rows);
        return view('Leaders.list')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (auth()->user()->UserLevelID == 1) {
             $area = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
           
        }elseif (auth()->user()->UserLevelID == 4) {
            $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
         //  $rows= Leader::wherein('AreaID',$area)->paginate(30);
        }else{
            return redirect('/');
        }
      //  $area = Area::lists('AreaName','AreaID');
        $title = Title::lists("title","title");
         return view('Leaders.create',compact('area','title'));
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
                 $title = new Leader;
      //  $title->title = $request->title;
        $title->name = $value['leader']; 
        $title->contact = $value['contact']; 
        $title->email = $value['email']; 
        $title->address = $value['address']; 
        $title->AreaID = $value['areaid']; 
        $title->entry_user = auth()->user()->id;
        $title->save();
            }
      
     //   Session::flash('message','Records Updated!');
    //    Session::flash('alert-class','alert-success'); 
         return   $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows= Leader::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Leaders.index');
          }
          
          if (auth()->user()->UserLevelID == 1) {
             $area = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
           
        }elseif (auth()->user()->UserLevelID == 4) {
            $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
        }else{
            return redirect('/');
        }
        $title = Title::lists("title","title");
      return view('Leaders.show')->with(compact('rows','area','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows= Leader::find($id);

          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Leaders.index');
          }
        if (auth()->user()->UserLevelID == 1) {
             $area = Area::where('AreaID',auth()->user()->AreaID)->lists('AreaName','AreaID');
           
        }elseif (auth()->user()->UserLevelID == 4) {
            $area = Area::where('NationalID',auth()->user()->NationalID)->lists('AreaName','AreaID');
           
        }else{
            return redirect('/');
        }
        $title = Title::lists("title","title");
      return view('Leaders.edit')->with(compact('rows','area','title'));
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
         $rows= Leader::find($id);
          if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Leaders.index');
          }
          $this->validate($request,[
          //  'title' => 'required|string|min:3',
            'name' => 'required|string|min:3',
            'email' => 'email|min:3',
            'contact' => 'required|string|min:3',
            'address' => 'required|string|min:3',
            'AreaID' => 'required|string|min:1',
        ]);
        $rows->name = $request->name;
      //  $rows->title = $request->title;
        $rows->contact = $request->contact;
        $rows->email = $request->email;
        $rows->address = $request->address;
        $rows->AreaID = $request->AreaID;
        $rows->entry_user = auth()->user()->id;
        $rows->save();
        Session::flash('message','Records Added');
        Session::flash('alert-class','alert-success');   
        return redirect('Leaders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Leader::find($id)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('Leaders');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');

        $rows= Leader::where('name','LIKE', "%$searchStr%")->orderBy('title','asc')->paginate(10);
        return view('Leaders.list')->with(compact('rows'));       
    }
}
