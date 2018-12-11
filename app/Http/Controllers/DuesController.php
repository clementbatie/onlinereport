<?php

namespace App\Http\Controllers;

use App\Dues;
use App\Duespayment;
use App\Paymentmode;
use App\Duestype;
use App\Http\Requests;
use App\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Session;

class DuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Dues::where('dues.CellCode',auth()->user()->CellID)
        ->leftjoin('members','dues.Member_ID','=','members.id')
        ->select('dues.*','members.name')
        ->paginate(50);
        return view('Dues.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
        $duestype = Duestype::where('NationalID',auth()->user()->NationalID)->lists('duestype_name','id');
        return view('Dues.dues',compact('members','duestype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $formdata = Input::get('data');
       // $ob = (object)$formdata['data'];

        foreach ($formdata['data'] as $member) {
           // return $member;
            $ob = (object)$member;
            $dues = new Dues;
            $dues->Dues_Date = $ob->date;
            $dues->Dues_Type = $ob->duestype;
            $dues->Dues_Amount = $ob->amount;
            $dues->Narration = $ob->comments;
            $dues->Member_ID = $ob->member;
            $dues->CellCode = auth()->user()->CellID;
            $dues->Entry_date = Carbon::now();
            $dues->Entry_user = auth()->user()->id;
            $dues->save();
        }
       
       return response()->json([
            'message' => 'correct'
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dues = Dues::find($id);
        if (!$dues->exists()) {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');  
            return redirect('dues');
        }
        return view('dues.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dues = Dues::find($id);
        if (!$dues->exists()) {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');  
            return redirect('dues');
        }
        return view('dues.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dues = Dues::find($id);
        if (!$dues->exists()) {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');  
            return redirect('dues');
        }
        $dues->delete();
        Session::flash('message','Records Deleted');
        Session::flash('alert-class','alert-info');  
        return redirect('dues');
    }

    public function billduesall(Request $request)
    {
        $formdata = Input::get('data');
        $ob = (object)$formdata['data'][0];
        
        $members = Member::where('CellCode',auth()->user()->CellID)->lists('id');
        foreach ($members as $member) {
            $dues = new Dues;
            $dues->Dues_Date = $ob->date;
            $dues->Dues_Type = $ob->duestype;
            $dues->Dues_Amount = $ob->amount;
            $dues->Narration = $ob->comments;
            $dues->Member_ID = $member;
            $dues->CellCode = auth()->user()->CellID;
            $dues->Entry_date = Carbon::now();
            $dues->Entry_user = auth()->user()->id;
            $dues->save();
        }
       
       return response()->json([
            'message' => 'correct'
       ]);
    }

   

     public function duespayment($id){
        $members = Member::where('CellCode',auth()->user()->CellID)->lists('name','id');
        $dues = Dues::find($id);
        if (!$dues->exists()) {
             Session::flash('message','Record not found');
        Session::flash('alert-class','alert-info'); 
            return redirect('dues');
        }
        $rows = $dues;
        $paymentmodes = Paymentmode::orderBy('paymentmode_name')->lists('paymentmode_name','paymentmode_ID');
        return view('dues.duespayment',compact('members','rows','paymentmodes'));
    }

    public function duespaymentsave($id,Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'amount' => 'required|numeric',
            'member' => 'required|numeric',
            'paymentmode' => 'required|numeric',
        ]);
      
           
            $dues = new Duespayment;
            $dues->Payment_Date = $request->date;
            $dues->Payment_Mode = $request->paymentmode;
            $dues->Payment_Amount = $request->amount;
            $dues->Narration = $request->comments;
            $dues->Dues_ID = $id;
            $dues->Entry_date = Carbon::now();
            $dues->Entry_user = auth()->user()->id;
            $dues->save();
        
        Session::flash('message','Records Added');
        Session::flash('alert-class','alert-success'); 
       return redirect('dues');
    }

    public function search()
    {
        $searchStr=Input::get('searchString');
        $rows= Member::orderBy('name', 'desc')
            ->where('name','LIKE', "%$searchStr%")
            ->leftjoin('dues','dues.Member_ID','=','members.id')
            ->where('dues.CellCode',auth()->user()->CellID)
            ->select('dues.*','members.name')
            ->paginate(50);            
           //dd($rows);
        return view('Dues.list')->with(compact('rows'));       
    }
    
}
