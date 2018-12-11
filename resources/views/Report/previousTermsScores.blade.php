@extends('layouts.app')

@section('content')

<div class="container spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-1">
     

      <div id="aaa" class="col-md-9">
      {{-- <h1 style="text-align: center; text-decoration: #ffffff; font-size: 60px;"><p class="blinking">STUDENT REPORT SEARCH</p></h1> --}}

      <div style="text-align: center; font-size: 40px; padding-left:100px; "><a style="text-decoration: #ffffff"  class="active_link"><span class=""></span><strong class="blinking">PREVIOUS REPORT SEARCH</strong></a></div>
      </div>    


    <div style="padding-left: 123px; margin-top: 4px; " id="aaa" class="col-md-3">
       <a style="margin-top: 40px; position: fixed;" href="#" id="export" class="btn btn-success"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
       {{-- <a href="#" id="graph" class="btn btn-success"><i class="fa fa-line-chart" onclick="chart()">Graph</i></a> --}}
     </div>
     <br><br><br><br>

   </div>

   {{-- <div class="col-md-10 col-md-offset-1">
    {!!Form::open(array('method'=>'GET','route'=>'Previous.search'))!!}

    <div class="form-group">
     <div class="col-md-3">
       {!! Form::select('student',$student, null, ['class' => 'form-control selectpicker','id'=>'studentPrevious', 'placeholder'=>'Select Student Name' ,'data-live-search'=>'true']) !!}
 
       @foreach($studentImage as $one)
             <option value="{{$one->id}}" image="{{$one->ImageType}}" regid="{{$one->StudentName}}">{{$one->StudentName}}</option>
            @endforeach
      
     </div>
       

   </div>
   <div class="form-group">
     <div class="col-md-2">
       {!! Form::select('class',$classes, null, ['class' => 'form-control', 'placeholder'=>'Select Class' ,'id'=> 'studentclass','disabled']) !!}
     </div>
   </div>
   <div class="form-group">
  {{--    <div class="col-md-2">
       {!! Form::select('term',$terms, null, ['class' => 'form-control selectpicker']) !!}
     </div>
   </div>
     <div class="form-group">
       <div class="col-md-2">
         <select name="year" id="" class="selectpicker form-control" data-live-search="true">
           @foreach($year as $one)
            <option value="{{$one}}">{{$one}}</option>
           @endforeach
         </select>
       </div>
     </div> --}}
 {{--   <div class="form-group">
     <div class="col-md-2">
      {!!Form::submit('Generate',array('class'=>'btn btn-info','id'=>'student'))!!}
    </div>
  </div>
   <div id="aaa" style="padding-left: 850px">
     
        <a href="{{url('/')}}"  class="btn btn-danger btn-block">
          Return
        </a>
      </div><br>
  {!!Form::close()!!}

</div> --}} 

 <div class="col-md-12">


    
        {{--  <div class="pull-left"> <img src="{{asset('uploads/me.jpg')}}" alt="" height="200px" width="200px"></div>  --}}

         {{-- <img width="560" height="315" src="uploads/p7.jpg"></img> --}}

         {{-- <div class="pull-left"> <img src="uploads/{{$StuImage2}}" alt="" height="200px" width="200px"></div> 
 --}}


      {{--  <div class="col-md-1 col-sm-offset-1" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="{{asset('uploads/').'/'.$Images2}}" alt="" height="130px" width="130px">
       </div>


       <div class="col-md-8" style="padding-left: 85px;">
            <h1 style="font-size: 43px; text-align: center">{{$schoolinfo->Name or "---"}}</h1>
            <p style="font-size: 16px; text-align: center">{{$schoolinfo->Address or "---"}}</p>
            <p style="font-size: 16px; text-align: center">{{$schoolinfo->ContactNos or "---"}}</p>
            <h3 style="font-size: 24px; text-align: center">{{$schoolinfo->reportname or "---"}}</h3>   
       </div> --}}
      
      {{--  <div cclass="col-md-4" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="{{asset('uploads/').'/'.$StuImage2}}" alt="" height="130px" width="130px">
       </div> --}}

       <div class="col-md-10 col-md-offset-1">
    {!!Form::open(array('method'=>'GET','route'=>'Previous.search'))!!}

    <div class="form-group">
     <div class="col-md-3">
       {!! Form::select('student',$student, null, ['class' => 'form-control','id'=>'studentPrevious']) !!}
 
       @foreach($studentImage as $one)
             <option value="{{$one->id}}" image="{{$one->ImageType}}" regid="{{$one->StudentName}}">{{$one->StudentName}}</option>
            @endforeach
      
     </div>
       

   </div>
   {{-- <div class="form-group">
     <div class="col-md-2">
       {!! Form::select('class',$classes, null, ['class' => 'form-control', 'placeholder'=>'Select Class' ,'id'=> 'studentclass','disabled']) !!}
     </div>
   </div>
   <div class="form-group"> --}}
  {{--    <div class="col-md-2">
       {!! Form::select('term',$terms, null, ['class' => 'form-control selectpicker']) !!}
     </div>
   </div>
     <div class="form-group">
       <div class="col-md-2">
         <select name="year" id="" class="selectpicker form-control" data-live-search="true">
           @foreach($year as $one)
            <option value="{{$one}}">{{$one}}</option>
           @endforeach
         </select>
       </div>
     </div> --}}
   <div class="form-group">
     <div class="col-md-2">
      {!!Form::submit('See Report',array('class'=>'btn btn-info','id'=>'student'))!!}
    </div>
  </div>
   {{-- <div id="aaa" style="padding-left: 850px">
     
        <a href="{{url('/')}}"  class="btn btn-danger btn-block">
          Return
        </a>
      </div><br> --}}


      <div id="aaa" style="padding-left: 400px; font-size: 30px; text-decoration-color: red">
     
        <a href="{{url('/')}}"  class="btn btn-danger fa fa-home">
          Return
        </a>
      </div><br>
  {!!Form::close()!!}

</div>
     
 </div>

<div class="col-md-11" style="margin-left: 70px;"><br>


   
  @if(Session::has('message'))
  <p style="font-size: 20px;" class="alert {{ Session::get('alert-class', 'alert-info') }}">
   {{Session::get('message')}}
 </p>
 @endif



@if(count($output))

 <div class="col-md-12">


    
        {{--  <div class="pull-left"> <img src="{{asset('uploads/me.jpg')}}" alt="" height="200px" width="200px"></div>  --}}

         {{-- <img width="560" height="315" src="uploads/p7.jpg"></img> --}}

         {{-- <div class="pull-left"> <img src="uploads/{{$StuImage2}}" alt="" height="200px" width="200px"></div> 
 --}}


       {{-- <div class="col-md-1 col-sm-offset-1" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="{{asset('uploads/').'/'.$Images2}}" alt="" height="130px" width="130px">
       </div>


       <div class="col-md-8" style="padding-left: 85px;">
            <h1 style="font-size: 43px; text-align: center">{{$schoolinfo->Name or "---"}}</h1>
            <p style="font-size: 16px; text-align: center">{{$schoolinfo->Address or "---"}}</p>
            <p style="font-size: 16px; text-align: center">{{$schoolinfo->ContactNos or "---"}}</p>
            <h3 style="font-size: 24px; text-align: center">{{$schoolinfo->reportname or "---"}}</h3>   
       </div>
      
       <div cclass="col-md-4" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="{{asset('uploads/').'/'.$StuImage2}}" alt="" height="130px" width="130px">
       </div> --}}


       <div class="row">

       {{-- <div class="col-md-1 col-sm-offset-1" style="padding-top: 25px; margin-left: 35px;"> --}}

       <div class="col-md-2" style="padding-top: 25px; ">
           <img style="margin-top: -7px; border-radius: 50%; margin-left: 20px;"  src="{{asset('uploads/').'/'.$Images2}}" alt="" height="130px" width="130px">
       </div>


       <div class="col-md-8">
            <h1 style="font-size: 43px; text-align: center">{{$schoolinfo->Name or "---"}}</h1>
            <p style="font-size: 16px; text-align: center">{{$schoolinfo->Address or "---"}}</p>
            <p style="font-size: 16px; text-align: center">{{$schoolinfo->ContactNos or "---"}}</p>
            <h3 style="font-size: 28px; text-align: center">{{$schoolinfo->reportname or "---"}}</h3>  
       </div>

    
      
       <div cclass="col-md-2" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="{{asset('uploads/').'/'.$StuImage2}}" alt="" height="130px" width="130px">
       </div>
  </div><br>

    {{--    <div class="col-md-10 col-md-offset-1">
    {!!Form::open(array('method'=>'GET','route'=>'Previous.search'))!!}

    <div class="form-group">
     <div class="col-md-3">
       {!! Form::select('student',$student, null, ['class' => 'form-control selectpicker','id'=>'studentPrevious', 'placeholder'=>'Select Student Name' ,'data-live-search'=>'true']) !!}
 
       @foreach($studentImage as $one)
             <option value="{{$one->id}}" image="{{$one->ImageType}}" regid="{{$one->StudentName}}">{{$one->StudentName}}</option>
            @endforeach
      
     </div>
       

   </div> --}}
   
   {{-- <div class="form-group">
     <div class="col-md-2">
      {!!Form::submit('Get Report',array('class'=>'btn btn-info','id'=>'student'))!!}
    </div>
  </div> --}}
   {{-- <div id="aaa" style="padding-left: 850px">
     
        <a href="{{url('/')}}"  class="btn btn-danger btn-block">
          Return
        </a>
      </div><br> --}}


     {{--  <div id="aaa" style="padding-left: 400px; font-size: 30px; text-decoration-color: red">
     
        <a href="{{url('/')}}"  class="btn btn-danger fa fa-home">
          Return
        </a>
      </div><br> --}}
  {{-- {!!Form::close()!!} --}}

{{-- </div> --}}
     
 </div>



 <div class="panel panel-default">
  {{-- <div class="panel-header"></div> --}}
  {{-- <div class="panel-body"> --}}
   {{--  <div class="table-responsive"> --}}
    <table class="table table-striped" id="exporttable">

       <tr >
        <td colspan="8">  
          <span class="col-md-6"><strong>Student Name</strong>: <span style="margin-left: 10px; margin-right:10px; font-size: 25px;">{{$selectedstudent->StudentName or "---"}}</span> </span>
          <span class="col-md-6"><strong>Year</strong>: <span style="margin-left: 10px; margin-right:10px;">{{$classinfo->Year or "---"}}</span> </span>
        </td>
       </tr>
     
       <tr>
        {{-- <tr>
          <td colspan="8">
            <span class="col-md-4"><strong>Term</strong>: <span style="margin-left: 10px; margin-right:10px">{{$classinfo->myterm->TermName or "---"}}</span> </span>
            <span class="col-md-4"><strong>Class</strong>: <span style="margin-left: 10px; margin-right:10px">{{$classinfo->myclass->ClassName or "---"}}</span> </span>
            <span class="col-md-4"><strong>No on Roll</strong> : <span style="margin-left: 10px; margin-right:10px">{{$classinfo->OnRoll or "---"}}</span> </span>
          </td>
        </tr> --}}
{{-- 
        <tr>
          <td colspan="8">
            <span class="col-md-4"><strong>School Closes</strong> : <span style="margin-left: 10px; margin-right:10px">{{$classinfo->SchoolCloses or "---"}}</span> </span>
            <span class="col-md-4"><strong>Next term begins</strong> : <span style="margin-left: 10px; margin-right:10px">{{$classinfo->NextTermBegins or "---"}}</span></span>
            <span class="col-md-4"><strong>Position</strong> : <span style="margin-left: 10px; margin-right:10px">{{$classinfo->a or "---"}}</span> </span>
          </td>
        </tr> --}}

       {{-- <tr style="background-color: rgb(192,192,192)" >
         <th style="text-align:">Subject</th>
         <th style="text-align:">Class Score</th>
         <th style="text-align:">Exams Score</th>
         <th style="text-align:">Total</th>
         <th style="text-align:">Position</th>
         <th style="text-align:">Remark</th>
         
        </tr> --}}
        <div class="panel panel-default">
        <table class="table table-striped" id="exporttable">
           @foreach($output as $i=>$collection)
              <tr>
                <tr style="background-color: rgb(192,192,192)" >
                     <th style="text-align:center">Subject</th>
                     <th style="text-align:center">Class Score</th>
                     <th style="text-align:center">Exams Score</th>
                     <th style="text-align:center">Total</th>
                     <th style="text-align:center">Grade</th>
                     <th style="text-align:center">Remark</th>
                     {{-- <th style="text-align:center">Term</th>
                     <th style="text-align:center">Class</th> --}}
                </tr>
            <tr>
                 <th colspan="20" style="padding-left: 350px; font-size: 20px">{{$arra3[$i]}}--{{$arra2[$i]}} Academic Year<br></th>
           </tr>

         {{--   @foreach($arra3 as $r=>$item)
                 @for($is=0; $is<count($is); $is++)

                 <th colspan="20">{{$arra3[$r]}}</th>
           
                 @endfor
             @endforeach --}}
              </tr>

            <?php $header = null ?>
            <?php $header1 = null ?>
            <?php $header2 = null ?>

             @foreach($collection as $item)
             {{--  @foreach($item as $r=>$item)
                 @for($is=0; $is<count($is); $is++)

                 <th colspan="20">{{$arra3[$is]}}</th>
            
                 @endfor
             @endforeach --}}
      @if(count($termName) === 3)
            @if($item->TermName === $termName[0])             
               <tr>
                @if($header != $item->TermName)
                  <th>{{$termName[0]}}</th>
                  <?$header = $item->TermName;?>

                @endif
               </tr>
               <td style="text-align: center;">{{$item->SubjectName}}</td>
               <td style="text-align: center;">{{$item->classscore }}</td>
               <td style="text-align: center;">{{$item->examscore}}</td>
               <td style="text-align: center;">{{($item->examscore)+($item->classscore)}}</td>
               <td style="text-align: center;">{{$item->Grade}}</td>
               {{-- <td style="text-align: center;">{{$item->remarks}}</td>
               <th style="text-align: center;">{{$item->TermName}}</th>
               <th style="text-align: center;">{{$item->ClassName}}</th><tr> --}}
            @endif


            @if($item->TermName === $termName[1])             
             <tr>
                @if($header1 != $item->TermName)
                  <th>{{$termName[1]}}</th>
                  <?$header1 = $item->TermName;?>

                @endif
               </tr>
               <td style="text-align: center;">{{$item->SubjectName}}</td>
               <td style="text-align: center;">{{$item->classscore }}</td>
               <td style="text-align: center;">{{$item->examscore}}</td>
               <td style="text-align: center;">{{($item->examscore)+($item->classscore)}}</td>
               <td style="text-align: center;">{{$item->Grade}}</td>
               <td style="text-align: center;">{{$item->remarks}}</td>
               {{-- <th style="text-align: center;">{{$item->TermName}}</th>
               <th style="text-align: center;">{{$item->ClassName}}</th><tr> --}}
            @endif

            @if($item->TermName === $termName[2])             
              <tr>
                @if($header2 != $item->TermName)
                  <th>{{$termName[2]}}</th>
                  <?$header2 = $item->TermName;?>

                @endif
               </tr>
               <td style="text-align: center;">{{$item->SubjectName}}</td>
               <td style="text-align: center;">{{$item->classscore }}</td>
               <td style="text-align: center;">{{$item->examscore}}</td>
               <td style="text-align: center;">{{($item->examscore)+($item->classscore)}}</td>
               <td style="text-align: center;">{{$item->Grade}}</td>
               <td style="text-align: center;">{{$item->remarks}}</td>
             {{--   <th style="text-align: center;">{{$item->TermName}}</th>
               <th style="text-align: center;">{{$item->ClassName}}</th><tr> --}}
            @endif
     @endif

     @if(count($termName) === 1)
           @if($item->TermName === $termName[0])             
               <tr>
                @if($header != $item->TermName)
                  <th>{{$termName[0]}}</th>
                  <?$header = $item->TermName;?>

                @endif
               </tr>
               <td style="text-align: center;">{{$item->SubjectName}}</td>
               <td style="text-align: center;">{{$item->classscore }}</td>
               <td style="text-align: center;">{{$item->examscore}}</td>
               <td style="text-align: center;">{{($item->examscore)+($item->classscore)}}</td>
               <td style="text-align: center;">{{$item->Grade}}</td>
               <td style="text-align: center;">{{$item->remarks}}</td>
               {{-- <th style="text-align: center;">{{$item->TermName}}</th>
               <th style="text-align: center;">{{$item->ClassName}}</th><tr> --}}
            @endif

     @endif
     @if(count($termName) === 2)
           @if($item->TermName === $termName[0])             
               <tr>
                @if($header != $item->TermName)
                  <th>{{$termName[0]}}</th>
                  <?$header = $item->TermName;?>

                @endif
               </tr>
               <td style="text-align: center;">{{$item->SubjectName}}</td>
               <td style="text-align: center;">{{$item->classscore }}</td>
               <td style="text-align: center;">{{$item->examscore}}</td>
               <td style="text-align: center;">{{($item->examscore)+($item->classscore)}}</td>
               <td style="text-align: center;">{{$item->Grade}}</td>
               <td style="text-align: center;">{{$item->remarks}}</td>
               {{-- <th style="text-align: center;">{{$item->TermName}}</th>
               <th style="text-align: center;">{{$item->ClassName}}</th><tr> --}}
            @endif

             @if($item->TermName === $termName[1])             
             <tr>
                @if($header1 != $item->TermName)
                  <th>{{$termName[1]}}</th>
                  <?$header1 = $item->TermName;?>

                @endif
               </tr>
               <td style="text-align: center;">{{$item->SubjectName}}</td>
               <td style="text-align: center;">{{$item->classscore }}</td>
               <td style="text-align: center;">{{$item->examscore}}</td>
               <td style="text-align: center;">{{($item->examscore)+($item->classscore)}}</td>
               <td style="text-align: center;">{{$item->Grade}}</td>
               <td style="text-align: center;">{{$item->remarks}}</td>
               {{-- <th style="text-align: center;">{{$item->TermName}}</th>
               <th style="text-align: center;">{{$item->ClassName}}</th><tr> --}}
            @endif

     @endif
           @endforeach 
           @endforeach  

     </table>
   </div>
 </div>
 {{-- <div class="container">
   <div class="col-md-6"><strong>Promoted To / Repeated To :</strong>  <span style="margin-left: 10px; margin-right:10px">{{$studentperformance->PromotedTo or "---"}}</span> </div>
   <div class="col-md-6"><strong>No of days opened for the term :</strong>  <span style="margin-left: 10px; margin-right:10px">{{$studentperformance->AttendanceExpected or "---"}}</span> </div>
   <div class="col-md-6"><strong>Attendance</strong> :  <span style="margin-left: 10px; margin-right:10px">{{$studentperformance->ActualAttendance or "---"}}</span> </div>
   <div class="col-md-6"><strong>Conduct</strong> :  <span style="margin-left: 10px; margin-right:10px">{{$studentperformance->CharacterOfStu or "---"}}</span> </div>
   <div class="col-md-6"><strong>Interest</strong> :  <span style="margin-left: 10px; margin-right:10px">{{$studentperformance->Interest or "---"}}</span> </div>
   <div class="col-md-6"><strong>Class Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px">{{$studentperformance->ClassTeacherRemarks or "---"}}</span> </div>
   <div class="col-md-6"><strong>Head Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px">{{$studentperformance->HeadTeacherRemarks or "---"}}</span> </div>
   
 </div> --}}
  {{-- @include('trademark') --}}
</div>
@else 
There Are No Records
@endif

</div>
</div>
</div>
<div class="container" id="piechart"></div>
<script type="text/javascript">
// Load google charts



// Draw the chart and set the chart values

</script>
<script>
    function blinker(){
        $('.blinking').fadeOut(200);
        $('.blinking').fadeIn(200);
    }
    setInterval(blinker, 1000);
</script>
<style>
  .row-border td{
    border: 1px solid black;
  }
  .row-border th{
    border: 1px solid black;
  }
</style>
@endsection


