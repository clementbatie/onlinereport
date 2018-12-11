       
       <br>
       
       <legend style="text-align: center; font-size: 50px;"> <strong>Create School Logo</strong></legend>
      
      <br><br><br>
  
<!-- Text input-->
{{-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
 {!! Form::label('name ', 'Name :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('name',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'name',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('name'))
  <span class="help-block">
    <strong>{{ $errors->first('name') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
 {!! Form::label('email ', 'Email :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('email',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'useremail',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('email'))
  <span class="help-block">
    <strong>{{ $errors->first('email') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
 {!! Form::label('Phone Number', 'Password:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::password('PhoneNo', array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'PhoneNo',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('PhoneNo'))
  <span class="help-block">
    <strong>{{ $errors->first('PhoneNo') }}</strong>
  </span>
  @endif
</div>
</div> --}}

{{-- <div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
 {!! Form::label('Phone Number', 'Password:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::password('PhoneNo', array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'PhoneNo',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('PhoneNo'))
  <span class="help-block">
    <strong>{{ $errors->first('PhoneNo') }}</strong>
  </span>
  @endif
</div>
</div> --}}


<!-- Form Name -->

<div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }}">
 {!! Form::label('Name', 'School Name :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Name', $school ,null, array('class' => 'form-control','placeholder' => 'Select School Name', 'id'=>'name',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Name'))
  <span class="help-block">
    <strong>{{ $errors->first('Name') }}</strong>
  </span>
  @endif
</div>
</div>

{{-- <div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
 {!! Form::label('UserLevelID', 'User Level :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('UserLevelID', $userlevel ,null, array('class' => 'form-control','placeholder' => 'Select User Level', 'id'=>'UserLevelID2',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('UserLevelID'))
  <span class="help-block">
    <strong>{{ $errors->first('UserLevelID') }}</strong>
  </span>
  @endif
</div>
</div> --}}

<div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
        {!! Form::label('file', ' File:' , array('class'=>'col-md-4 control-label'  )) !!}
      <div class="col-md-6">
        {!! Form::file('file',  array('class' => 'form-control', 'placeholder'=>'','id'=>'imgInp', 
        ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
        @if ($errors->has('file'))
        <span class="help-block">
         <strong>{{ $errors->first('file') }}</strong>
       </span>
       @endif
      </div>
      </div>

<div class="col-md-offset-4" style="margin-bottom: 15px">
  <img id="blah" src="#" alt="" height="150px" width="150px"/img>
</div>



  




