<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Parents;
use App\Student;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Parents::paginate(30);
        return view('parents.list',compact('rows'));
    }

    
    public function templateview()
    {
        return view('Template.template2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','id');
        $rows = [];
        
        return view('parents.create',compact('children','rows'));

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

            foreach ($data->data as $value) {
             $value = (object)$value;

             $person = Parents::where('PhoneNo',$value->phone)->where('SchoolCode',auth()->user()->SchoolCode);
              if ($person->exists()) {
                  $person = $person->get(['name','contact'])->toArray();
                  return response()->json([
                      'message' => 'exists',
                      'person' => $person
                  ]);
                }  
            }

           foreach ($data->data as $value) {
           $value = (object)$value;
           $member = new Parents;
           $member->Name = $value->name;
           $member->PhoneNo = $value->phone;
           $member->password = bcrypt($value->phone);
           $member->SelectallChildren = json_encode($value->children);
           $member->SchoolCode = auth()->user()->SchoolCode;
           //$member->user_id = auth()->user()->id;
           $member->save();
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
        $rows = Parents::find($id);
        if (is_null($rows)) {
            return redirect('parents')->withMessage('Parent Not Found');
        }
         $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
        return view('parents.show',compact('rows','children'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows = Parents::find($id);
        if (is_null($rows)) {
            return redirect('parents')->withMessage('Parent Not Found');
        }
         $children = Student::where('SchoolCode',auth()->user()->SchoolCode)->lists('StudentName','StudentID');
        return view('parents.edit',compact('rows','children'));
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
            'Name' => 'required',
            'PhoneNo' => 'required',
            'children' => 'required|array|min:1',
        ]);
        $parent =Parents::find($id);
        $parent->Name = $request->Name;
        $parent->PhoneNo = $request->PhoneNo;
        $parent->SelectallChildren = json_encode($request->children);
        $parent->save();
        return redirect('parents')->withMessage('Parent Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
