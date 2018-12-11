       <legend>Parents Records</legend>
  
<!-- Text input-->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
 {!! Form::label('name ', 'Parent Name :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('name',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'parentname',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('name'))
  <span class="help-block">
    <strong>{{ $errors->first('name') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
 {!! Form::label('Date Joined', 'Phone number :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::number('PhoneNo',null, array('class' => 'form-control', 'id'=>'parentphonenumber',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('phonenumber'))
  <span class="help-block">
    <strong>{{ $errors->first('phonenumber') }}</strong>
  </span>
  @endif
</div>
</div>

<!-- Form Name -->

<div class="form-group{{ $errors->has('Children') ? ' has-error' : '' }}">
 {!! Form::label('Member Name', 'Children Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('children[]',$children,$rows ? json_decode($rows->SelectallChildren) : null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'parentchildren',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Children'))
  <span class="help-block">
    <strong>{{ $errors->first('Children') }}</strong>
  </span>
  @endif
</div>
</div>



