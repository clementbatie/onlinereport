      

       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Users</strong></legend>

       <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      <br><br><br>
  
<!-- Text input-->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
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
</div>

{{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
 {!! Form::label('password', 'Password:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::password('PhoneNo',array('class' => 'form-control'   )) !!}
  @if ($errors->has('password'))
  <span class="help-block">
    <strong>{{ $errors->first('password') }}</strong>
  </span>
  @endif
</div>
</div> --}}

<!-- Form Name -->

<div class="form-group{{ $errors->has('UserLevelID') ? ' has-error' : '' }}">
 {!! Form::label('UserLevelID', 'User Level :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('UserLevelID', $userlevel ,null, array('class' => 'form-control','placeholder' => 'Select User Level', 'id'=>'UserLevelID',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('UserLevelID'))
  <span class="help-block">
    <strong>{{ $errors->first('UserLevelID') }}</strong>
  </span>
  @endif
</div>
</div>

<div style="display: none" class="tohide2 form-group{{ $errors->has('to') ? ' has-error' : '' }}">
 {!! Form::label('Class', 'Class Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Class',$classname,null, array('class' => 'form-control selectpicker','data-live-search'=>'true','id'=>'classteacher',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Class'))
  <span class="help-block">
    <strong>{{ $errors->first('Class') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('SetupTeacherID ') ? ' has-error' : '' }}">
 {!! Form::label('SetupTeacherID ', ' Teacher/Parent :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('SetupTeacherID ', $teacher ,null, array('class' => 'form-control','placeholder' => 'Select Teacher Name', 'id'=>'nameParentTeacher',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('SetupTeacherID '))
  <span class="help-block">
    <strong>{{ $errors->first('SetupTeacherID ') }}</strong>
  </span>
  @endif
</div>
</div>


<div style="display: none" class="tohide form-group{{ $errors->has('to') ? ' has-error' : '' }}">
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
