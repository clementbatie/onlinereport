<!-- form details -->


<!-- Form Name -->
<legend>User</legend>

<!-- Text input-->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
 {{-- {!!Form::hidden('password', 'password.123')!!}  --}}
 {!! Form::label('name', 'Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('name',null, array('class' => 'form-control',  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('name'))
  <span class="help-block">
    <strong>{{ $errors->first('name') }}</strong>
  </span>
  @endif
</div>
</div>


<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
 {!! Form::label('email', 'Email:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('email',null, array('class' => 'form-control',  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('email'))
  <span class="help-block">
    <strong>{{ $errors->first('email') }}</strong>
  </span>
  @endif
</div>
</div>


<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
 {!! Form::label('password', 'Password:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::password('password',array('class' => 'form-control'   )) !!}
  @if ($errors->has('password'))
  <span class="help-block">
    <strong>{{ $errors->first('password') }}</strong>
  </span>
  @endif
</div>
</div>


<div class="form-group{{ $errors->has('PhoneNo') ? ' has-error' : '' }}">
 {!! Form::label('PhoneNo', 'Phone No:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('PhoneNo',null, array('class' => 'form-control', 'placeholder'=>'024xxxxxxx', 
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('PhoneNo'))
  <span class="help-block">
    <strong>{{ $errors->first('PhoneNo') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Userstatus') ? ' has-error' : '' }}">
 {!! Form::label('Userstatus', 'Acccount State:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">

   {!!Form::select('Userstatus',$Userstatus,null,['class'=>'form-control selectpicker','data-live-search'=>'true',
   'placeholder'=>'Select a User State',($rwstate=='true' ? 'readonly' :null ) ] )!!}
   @if ($errors->has('UserLevelID'))
   <span class="help-block">
    <strong>{{ $errors->first('Userstatus') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('CellID') ? ' has-error' : '' }}">
 {!! Form::label('Cell', 'Cell Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">     
   {!!Form::select('CellID',$Cell,null,['class'=>'form-control selectpicker','data-live-search'=>'true',
   'placeholder'=>'Select User Cell',($rwstate=='true' ? 'readonly' :null ) ] )!!}
   @if ($errors->has('CellID'))
   <span class="help-block">
    <strong>{{ $errors->first('CellID') }}</strong>
  </span>
  @endif
</div>
</div>


<div class="form-group{{ $errors->has('DistrictID') ? ' has-error' : '' }}">
 {!! Form::label('District', 'Zone:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
   {!!Form::select('DistrictID',$District,null,['class'=>'form-control selectpicker','data-live-search'=>'true',
   'placeholder'=>'Select User Zone',($rwstate=='true' ? 'readonly' :null ) ] )!!}
   @if ($errors->has('DistrictID'))
   <span class="help-block">
    <strong>{{ $errors->first('DistrictID') }}</strong>
  </span>
  @endif
</div>
</div>


<div class="form-group{{ $errors->has('AreaID') ? ' has-error' : '' }}">
 {!! Form::label('Area', 'Area:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">

   {!!Form::select('AreaID',$Area,null,['class'=>'form-control selectpicker','data-live-search'=>'true',
   'placeholder'=>'Select User Area',($rwstate=='true' ? 'readonly' :null ) ] )!!}
   @if ($errors->has('AreaID'))
   <span class="help-block">
    <strong>{{ $errors->first('AreaID') }}</strong>
  </span>
  @endif
</div>
</div>

@if(auth()->user()->UserLevelID == 10)
<div class="form-group{{ $errors->has('NationalID') ? ' has-error' : '' }}">
 {!! Form::label('National', 'National:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
   
   {!!Form::select('NationalID',$National,null,['class'=>'form-control selectpicker','data-live-search'=>'true',
   'placeholder'=>'Select User National',($rwstate=='true' ? 'readonly' :null ) ] )!!}
   @if ($errors->has('NationalID'))
   <span class="help-block">
    <strong>{{ $errors->first('NationalID') }}</strong>
  </span>
  @endif
</div>
</div>
@endif 

<div class="form-group{{ $errors->has('UserLevelID') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">User Level</label>

  <div class="col-md-6">
    <!-- the 4th param is to put old value back  -->
    {!! Form::select('UserLevelID', $UserLevelID, null, ['class' => 'form-control selectpicker','data-live-search'=>'true', 
    'placeholder'=>'Select a User Level' ,( $rwstate=='true' ?  'readonly'  :null )  ] ) !!}    

    @if ($errors->has('UserLevelID'))
    <span class="help-block">
      <strong>{{ $errors->first('UserLevelID') }}</strong>
    </span>
    @endif
  </div>
</div>





















