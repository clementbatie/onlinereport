@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')
    
     {{  Form::model($rows->toArray(), array('method' => 'PATCH', 'route' =>array('Attendance.update',$rows->id), 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true'  )) }}
    
         {{ csrf_field() }}

       <fieldset>




      <!-- form details -->


<!-- Form Name -->
<legend>Meeting Attendance Edit</legend>
<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
 {!! Form::label('Date', 'Date:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('date',$meeting->date, array('class' => 'form-control', 'placeholder'=>'Select Date', 'id'=>'datepicker2','disabled'=>'true',
   )) !!}
  @if ($errors->has('date'))
  <span class="help-block">
    <strong>{{ $errors->first('date') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Meeting_Name') ? ' has-error' : '' }}">
 {!! Form::label('Meeting_Name', 'Meeting Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('Meeting_Name',$meeting->Meeting_Name, array('class' => 'form-control', 'placeholder'=>'Select Meeting Name', 'id'=>'Meeting_Namepicker2','disabled'=>'true',
   )) !!}
  @if ($errors->has('Meeting_Name'))
  <span class="help-block">
    <strong>{{ $errors->first('Meeting_Name') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Meeting_Time') ? ' has-error' : '' }}">
 {!! Form::label('Meeting_Time', 'Meeting Time:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('Meeting_Time',$meeting->Meeting_Time, array('class' => 'form-control', 'placeholder'=>'Select Meeting Time', 'id'=>'Meeting_Timepicker2','disabled'=>'true',
   )) !!}
  @if ($errors->has('Meeting_Time'))
  <span class="help-block">
    <strong>{{ $errors->first('Meeting_Time') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Leader_Name') ? ' has-error' : '' }}">
 {!! Form::label('Leader_Name', 'Leader Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('Leader_Name',$leader->name, array('class' => 'form-control', 'placeholder'=>'Select Leader Name', 'id'=>'Leader_Namepicker2','disabled'=>'true',
   )) !!}
  @if ($errors->has('Leader_Name'))
  <span class="help-block">
    <strong>{{ $errors->first('Leader_Name') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('mark') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Mark Attendance</label>
  <div class="col-md-6">
    {!! Form::select('mark',["Absent","Present"], null, ['class' => 'form-control selectpicker','id'=>'', 'data-live-search'=>'true',
    'placeholder'=>'Mark Attendance' , ] ) !!}    
    @if ($errors->has('mark'))
    <span class="help-block">
      <strong>{{ $errors->first('mark') }}</strong>
    </span>
    @endif
  </div>
</div>



       
            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
     
           <input type="submit" id=""  class="btn btn-success">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('/Attendance') }}" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>

  <script>
    var data = [];
  </script>
@endsection
