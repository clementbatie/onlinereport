<!-- form details -->


<!-- Form Name -->
<legend>Meeting Attendance Records</legend>
<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
 {!! Form::label('Date', 'Date:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('date',null, array('class' => 'form-control', 'placeholder'=>'Select Date', 'id'=>'datepicker2',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
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
  {!! Form::text('Meeting_Name',null, array('class' => 'form-control','id'=>'Meeting_Name', 'placeholder'=>'Meeting Name', 
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
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
  {!! Form::text('Meeting_Time',null, array('class' => 'form-control','id' => 'Meeting_Time', 'placeholder'=>'Meeting Time', 
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
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
    'placeholder'=>'Leader Name' ,( $rwstate=='true' ?  'readonly'  :null )  ] ) !!}    
    @if ($errors->has('Leader_Name'))
    <span class="help-block">
      <strong>{{ $errors->first('Leader_Name') }}</strong>
    </span>
    @endif
  </div>
</div>
