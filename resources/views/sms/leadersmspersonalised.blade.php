@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')
    {!! Form::open(array('url' => '', 'class'=>'form-horizontal','id'=>'myform', 'role'=>'form', 'files'=>'true')) !!}
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>
<legend>Send Personalised SMS to Leaders</legend>
<?php $rwstate = 'false' ; ?>
<!-- include the partial    -->
  
<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
 {!! Form::label('Date', 'Scedule Date:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('date',\Carbon\Carbon::now()->toDateString(), array('class' => 'form-control', 'placeholder'=>'Select Date', 'id'=>'datepicker2',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('date'))
  <span class="help-block">
    <strong>{{ $errors->first('date') }}</strong>
  </span>
  @endif
</div>
</div>

  <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Message</label>
  <div class="col-md-4">
    {!! Form::textarea('message', null, ['class' => 'form-control','id'=>'textmessage','rows' => '12',
    'placeholder'=>'Type Message Here' ,( $rwstate=='true' ?  'readonly'  :null )  ] ) !!}    
    @if ($errors->has('message'))
    <span class="help-block">
      <strong>{{ $errors->first('message') }}</strong>
    </span>
    @endif
  </div>
  <div class="col-md-2">
      <p style="float:left; width:auto;">Chars: <span id="display_count" style=" color:red;">0</span></p>
         <p style="float:right; width:auto;">Pages: <span id="usedsms" style=" color:red;">0</span></p>
           <div class="form-group">  
        {!! Form::select('areaname', $areaname, null, ['class' => 'form-control selectpicker','id'=>'areaname', 'data-live-search'=>'true', 
    'placeholder'=>'Area Name' ,( $rwstate=='true' ?  'readonly'  :null )  ] ) !!}  
      </div>
         <div class="form-group">  
        {!! Form::select('title', $titles, null, ['class' => 'form-control selectpicker','id'=>'title', 'data-live-search'=>'true', 
    'placeholder'=>'Title' ,( $rwstate=='true' ?  'readonly'  :null )  ] ) !!}  
      </div>
       
      
       <div class="form-group">  
          <input type="submit" id="queryleadersms"  class="btn btn-success queryleadersms" value="Search">
          <i class="fa fa-spinner fa-spin fa-lg" id="spinner2" aria-hidden="true" style="display: none"></i>
      </div>

  </div>
</div>


    <div class="leaderform">
  <div class="form-group{{ $errors->has('members') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Add Leader</label>
  <div class="col-md-6">
    {!! Form::select('members', $members, null, ['class' => 'form-control selectpicker','id'=>'smsmember', 'data-live-search'=>'true',
    'placeholder'=>'Leader Name' ,( $rwstate=='true' ?  'readonly'  :null )  ] ) !!}    
    @if ($errors->has('members'))
    <span class="help-block">
      <strong>{{ $errors->first('members') }}</strong>
    </span>
    @endif
  </div>
</div>
</div>


       <!-- Button (Double) -->
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           <input type="button" id="addmembersms"  value="Add"  class="btn btn-primary">
           <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <input type="submit" id="sendleadersmspersonalised"  class="btn btn-success sendleadersmspersonalised" value="Send Sms">
            <i class="fa fa-spinner fa-spin fa-lg" id="spinner" aria-hidden="true" style="display: none"></i>
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('/') }}" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>

 <div class="container col-md-6 col-md-offset-3 meetingpanel">
  <div class="panel panel-primary">
      <div class="panel panel-heading "><h4> Added Data</h4></div>
    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Title</th>
            <th>Area Name</th>
           
          </tr>
        </thead>
               
      </tbody>
    </table>
  </div>
    </div>
  </div>
  <script>
    var data = [];
    var tempo = [];
  </script>
@endsection
