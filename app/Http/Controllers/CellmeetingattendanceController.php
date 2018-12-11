<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cellmeetingattendance;
use App\Member;
use App\Membertype;
use App\Meetingtype;
use Session;

class CellmeetingattendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (auth()->user()->UserLevelID) {
            case '3':
           $rows = Cellmeetingattendance::where('cellmeetingattendances.CellCode',auth()->user()->CellID)
         //  ->leftjoin('meetingtypes','meetingtypes.typename','=','cellmeetingattendances.meetingtype')
           ->groupBy('date')
           ->paginate(30);
        //   dd($rows);
                break;
            default:
              $rows = Cellmeetingattendance::groupBy('date')->where('CellCode',"")->paginate(30);
                break;
        }
        return view('Cellmeetingattendance.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meetingtype = Meetingtype::where('CellCode',auth()->user()->CellID)->lists('typename','id');
        $members = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',1)->lists('name','id');
        $flag = ["Present" => "Present",'Absent'=>"Absent"];
        return view('Cellmeetingattendance.create',compact('members','meetingtype','flag'));
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
        foreach ($data['data'] as $val) {
            $present [] = $val['name'];
        }
        $absent = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',1)->whereNotIn('id',$present)->lists('id');
      $meetingname =  $data['data'][0]['meetingtype'];
      $meetingdate =  $data['data'][0]['date'];
        foreach ($data['data'] as $value) {
            $value = (object)$value;
            if (Cellmeetingattendance::where('date',$value->date)->where('member_id',$value->name)->exists()){ 
                $person = Cellmeetingattendance::where('date',$value->date)->where('member_id',$value->name)->first();
                $person->flag = $value->flag;
                $person->save();
            }else{
                $mark = new Cellmeetingattendance;
                $mark->date = $value->date;
                $mark->member_id = $value->name;
                $mark->CellCode = auth()->user()->CellID;
                $mark->comments = $value->comments;
                $mark->flag = $value->flag;
                $mark->meetingtype = $value->meetingtype;
                $mark->save();
            }        

            $markabsent = Member::where('CellCode',auth()->user()->CellID)->where('confirmed',1)->whereIn('id',$absent)->get();
            foreach ($markabsent as $value) {
              //  return $value->id;
              //  dd(Cellmeetingattendance::where('date',$meetingdate)->where('member_id',$value->id)->get());
                if (Cellmeetingattendance::where('date',$meetingdate)->where('member_id',$value->id)->exists()){ 
             /*   $person = Cellmeetingattendance::where('date',$meetingdate)->where('member_id',$value->id)->first();
                $person->flag = "Absent";
                $person->save();*/
            }else{
                $mark = new Cellmeetingattendance;
                $mark->date = $meetingdate;
                $mark->member_id = $value->id;
                $mark->CellCode = auth()->user()->CellID;
                $mark->comments = "";
                $mark->flag = "Absent";
                $mark->meetingtype = $meetingname;
                $mark->save();
            }        
            }
        }
        $url = route('cellmeetingmark.show',$meetingdate);
        return response()->json(['message' => 'correct','url' => $url]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meeting = Cellmeetingattendance::where('cellmeetingattendances.CellCode',auth()->user()->CellID)->where('date',$id)->leftjoin('meetingtypes','meetingtypes.id','=','meetingtype')->select('meetingtypes.typename','cellmeetingattendances.*')->first();
        if (is_null($meeting)) {
           Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Cellmeetingattendance.index');
        }
        $all = Cellmeetingattendance::where('cellmeetingattendances.CellCode',auth()->user()->CellID)->where('cellmeetingattendances.flag',"Present")->where('date',$id)->leftjoin('members','members.id','=','cellmeetingattendances.member_id');
      $all2 = Cellmeetingattendance::where('cellmeetingattendances.CellCode',auth()->user()->CellID)->where('cellmeetingattendances.flag',"Present")->where('date',$id)->leftjoin('members','members.id','=','cellmeetingattendances.member_id');
      $all3 = Cellmeetingattendance::where('cellmeetingattendances.CellCode',auth()->user()->CellID)->where('cellmeetingattendances.flag',"Present")->where('date',$id)->leftjoin('members','members.id','=','cellmeetingattendances.member_id');
      $all4 = Cellmeetingattendance::where('cellmeetingattendances.CellCode',auth()->user()->CellID)->where('cellmeetingattendances.flag',"Present")->where('date',$id)->leftjoin('members','members.id','=','cellmeetingattendances.member_id');
      $all5 = Cellmeetingattendance::where('cellmeetingattendances.CellCode',auth()->user()->CellID)->where('cellmeetingattendances.flag',"Present")->where('date',$id)->leftjoin('members','members.id','=','cellmeetingattendances.member_id');

        $members = $all->whereIn('membertype',["11",'16','17','20'])->count();
      //  dd($members);
        $children = $all2->whereIn('membertype',['13'])->count();
          //dd($children);
        $visitors = $all3->whereIn('membertype',['12'])->count();
        // dd($visitors);
        $converts = $all4->whereIn('membertype',['14'])->count();
        // new graduates
        $newgraduates = $all5->whereIn('membertype',['15'])->count();
     
      $mymembers =  ['amount' => $members,'indicators' => "No of Members",'date' => $id];
       $mychildren =  ['amount' => $children,'indicators' => "No of Children",'date' => $id];
       $myvisitors = ['amount' => $visitors,'indicators' => "No of Visitors",'date' => $id];
      $myconverts =  ['amount' => $converts,'indicators' => "No of Converts",'date' => $id];
      $mynewgraduates =  ['amount' => $newgraduates,'indicators' => "No of New Graduates",'date' => $id];
    $arr [] = $mymembers;
    $arr [] = $mychildren;
    $arr [] = $myvisitors;
    $arr [] = $myconverts;
    $arr [] = $mynewgraduates;
    //dd($arr);
        $thelabels = ['No of Members','No of Children','No of Visitors' ,'No of Converts'];
        $rwstate = 'true';
       $arrlists = $arr;
        $arr = json_encode($arr);

        return view('Assembly.submitstatsauto',compact('meeting','rwstate','arr','thelabels','arrlists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows = Cellmeetingattendance::where('date',$id)->where('cellmeetingattendances.CellCode',auth()->user()->CellID)->leftjoin('members','members.id','=','member_id')->leftjoin('meetingtypes','meetingtypes.id','=','meetingtype')->select('cellmeetingattendances.*','members.name','meetingtypes.typename')->paginate(50);
        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Cellmeetingattendance.index');
          }
        return view('Cellmeetingattendance.listattendance',compact('rows'));
    }

    public function cellattendanceedit($id)
    {
        $rows = Cellmeetingattendance::where('date',$id)->where('cellmeetingattendances.CellCode',auth()->user()->CellID)->leftjoin('members','members.id','=','member_id')->select('cellmeetingattendances.*','members.name')->paginate(50);
        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Cellmeetingattendance.index');
          }
        return view('Cellmeetingattendance.listattendance',compact('rows'));
    }

    public function editattendance($id)
    {
        $rows = Cellmeetingattendance::where('cellmeetingattendances.id',$id)->where('cellmeetingattendances.CellCode',auth()->user()->CellID)->leftjoin('members','members.id','=','member_id')->select('cellmeetingattendances.*','members.name')->first();
        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Cellmeetingattendance.index');
          }
        return view('Cellmeetingattendance.editattendance',compact('rows'));
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
        $rows = Cellmeetingattendance::where('cellmeetingattendances.id',$id)->where('cellmeetingattendances.CellCode',auth()->user()->CellID)->first();
        if (is_null($rows))
          {
            Session::flash('message','Records could not be found!');
            Session::flash('alert-class','alert-warning');            
            return redirect('Cellmeetingattendance.index');
          }
        $rows->flag = $request->flag;
        $rows->save();
         \Session::flash('message','Records could not be found!');
         \Session::flash('alert-class','alert-success');   
        return redirect('cellmeetingmark');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cellmeetingattendance::where('date',$id)->where('CellCode',auth()->user()->CellID)->delete();
        \Session::flash('message','Record has been deleted!');
        \Session::flash('alert-class','alert-warning');
        return redirect ('cellmeetingmark');
    }

    public function search(Request $request){

    }

    public function searchattendance(Request $request){
         $searchStr = $request->searchString;
      //   dd($searchStr);
        $rows= Member::where('name','LIKE', "%".$searchStr."%")->where('confirmed',1)
            ->leftjoin('cellmeetingattendances','members.id','=','cellmeetingattendances.member_id')         
            ->paginate(50);
         return view('Cellmeetingattendance.listattendance',compact('rows'));
    }
}
