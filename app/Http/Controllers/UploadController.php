<?php

namespace App\Http\Controllers;

use App\Bannerimg;
use App\Http\Requests;
use App\Upload;
use App\User;
use App\year_term_setup;

use Illuminate\Http\Request;
use \Storage;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Upload::where('NationalID',auth()->user()->NationalID)->paginate(30);
      //dd($rows);
        return view('upload.list',compact('rows'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('upload.create',compact('getYear','getTerm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {dd(88);
        $file = $request->file('file');
        if ($request->file('file')->isValid()) {
        $image = $request->file;
        $path = $image->path();
        $extension = $image->extension();
        $imagename = time() . "." . $extension;
        $store = $image->move('fileupload/',$imagename);
       // dd($store->path());
        }
        $save = new Upload;
        $save->file = $store;
        $save->note = $request->note;
        $save->user_id = auth()->user()->id;
        $save->NationalID = auth()->user()->NationalID;
        $save->save();
        \Session::flash('message','File Uploaded Successfully');
        return redirect('upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function bannerimg(){
        return view('upload.bannerimg');
    }

    public function bannerimgstore(Request $request){
        
         $file = $request->file('file');
      //   dd($file);
         if ($request->file('file')->isValid()) {
              //$destinationPath = storage_path() . '/uploads/forwardingletters';
              
              $destinationPath = public_path() . '/img/';
              $fileName=$request->file->getClientOriginalName();
              $request->file('file')->move($destinationPath,$fileName);
             // $document->FilePath='/img/'.$fileName;
          }
      //    dd(45556);
        
        $bannerimg = Bannerimg::where('NationalID',auth()->user()->NationalID);
        if ($bannerimg->exists()) {
            $bannerimg = $bannerimg->first();
            $bannerimg->link =$fileName;
            $bannerimg->save();
        }else{
             $save = new Bannerimg;
             $save->NationalID = auth()->user()->NationalID;
             $save->link =$fileName;
             $save->save();
        }
        
         \Session::flash('message','Image Upload Successful');
        return redirect('/');
    }

    public function attendanceupload(){
            return view('Upload.attendanceupload');
    }
    
    public function memberupload(){

        $Year = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->get();

         $Term = year_term_setup::where('year_term_setups.SchoolCode',auth()->user()->SchoolCode)->leftjoin('terms','year_term_setups.TermID','=','terms.TermID')->get();
        //dd($Term);
        $getTerm = $Term[0]->TermName;

        $getYear = $Year[0]->Year;
        
        return view('Upload.memberupload',compact('getYear','getTerm'));
    }
}
