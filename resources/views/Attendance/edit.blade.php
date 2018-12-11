@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')
    
     {{  Form::model($rows->toArray(), array('method' => 'Post', 'route' =>array('Attendance.store'), 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true'  )) }}
    
         {{ csrf_field() }}

       <fieldset>




      <!-- form details -->


<!-- Form Name -->
<legend>Meeting Attendance Records</legend>
<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
 {!! Form::label('Date', 'Date:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('date',null, array('class' => 'form-control', 'placeholder'=>'Select Date', 'id'=>'datepicker2','disabled'=>'true',
   )) !!}
  @if ($errors->has('date'))
  <span class="help-block">
    <strong>{{ $errors->first('date') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Meeting_Name') ? ' has-error' : '' }}">
 {!! Form::label('Meeting', ' Meeting Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('Meeting_Name',null, array('class' => 'form-control','id'=>'Meeting_Name', 'placeholder'=>'Meeting Name', 'disabled'=>'true',
    )) !!}
  @if ($errors->has('Meeting_Name'))
  <span class="help-block">
    <strong>{{ $errors->first('Meeting_Name') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Meeting_Time') ? ' has-error' : '' }}">
 {!! Form::label('Meeting', ' Meeting Time:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('Meeting_Time',null, array('class' => 'form-control','id' => 'Meeting_Time', 'placeholder'=>'Meeting Time', 'disabled'=>'true',
    )) !!}
  @if ($errors->has('Meeting_Time'))
  <span class="help-block">
    <strong>{{ $errors->first('Meeting_Time') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Leader_Name') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Select Participants</label>
  <div class="col-md-6">
    {!! Form::select('Leader_Name', $leaders, null, ['class' => 'form-control selectpicker','id'=>'leader', 'data-live-search'=>'true',
    'placeholder'=>'Leader Name' , ] ) !!}    
    @if ($errors->has('Leader_Name'))
    <span class="help-block">
      <strong>{{ $errors->first('Leader_Name') }}</strong>
    </span>
    @endif
  </div>
</div>



       
            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
          <input type="button" id="addmeeting"  value="Add"  class="btn btn-primary">
           <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <input type="submit" id="markattendance"  class="btn btn-success markattendance">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('/Attendance') }}" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>

 <div class="container col-md-6 col-md-offset-3">
  <div class="panel panel-primary">
      <div class="panel panel-heading "><h4> Added Data</h4></div>
    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>Date</th>
            <th>Meeting Name</th>
            <th>Meeting Time</th>
            <th>Attended</th>
          </tr>
        </thead>
               
      </tbody>
    </table>
  </div>
    </div>
  </div>
  <script>
    var data = [];
  </script>
@endsection
