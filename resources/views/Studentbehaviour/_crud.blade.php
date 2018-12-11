      
       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Student Behaviour</strong></legend>
       <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      <br><br><br>
  
<!-- Text input-->
{{-- <div class="form-group{{ $errors->has('Year') ? ' has-error' : '' }}">
 {!! Form::label('Year ', 'Year:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Year',$Year, null, array('class' => 'form-control', 'id' => 'year',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Year'))
  <span class="help-block">
    <strong>{{ $errors->first('Year') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Term') ? ' has-error' : '' }}">
 {!! Form::label('Term', 'Term :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Term',$Term, null, array('class' => 'form-control', 'id'=>'term',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Term'))
  <span class="help-block">
    <strong>{{ $errors->first('Term') }}</strong>
  </span>
  @endif
</div>
</div> --}}

<div class="form-group{{ $errors->has('ClassID') ? ' has-error' : '' }}">
 {!! Form::label('ClassID', 'Class :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('ClassID',$Class,null, array('class' => 'form-control', 'placeholder'=>'Select Class', 'id'=>'ClassofStudent',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('ClassID'))
  <span class="help-block">
    <strong>{{ $errors->first('ClassID') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
 {!! Form::label('id', 'Student Name :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('id',$StudentName, null, array('class' => 'form-control', 'placeholder'=>'Select Student Name','id'=>'studentnameA',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('id'))
  <span class="help-block">
    <strong>{{ $errors->first('id') }}</strong>
  </span>
  @endif
</div>
</div>
{{-- <div class="form-group{{ $errors->has(' PromotedTo ') ? ' has-error' : '' }}">
 {!! Form::label('PromotedTo', 'Promoted To :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('PromotedTo',$PromotedTo , null, array('class' => 'form-control', 'placeholder'=>'PromotedTo ','id'=>'PromotedTo',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('PromotedTo'))
  <span class="help-block">
    <strong>{{ $errors->first('PromotedTo') }}</strong>
  </span>
  @endif
</div>
</div> --}}

<div class="form-group{{ $errors->has('AttendanceExpected') ? ' has-error' : '' }}">
 {!! Form::label('AttendanceExpected ', 'Attendance Expected:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-2">
  {!! Form::number('AttendanceExpected',null, array('class' => 'form-control', 'placeholder'=>'Expected', 'id' => 'AttendanceExpected',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('AttendanceExpected'))
  <span class="help-block">
    <strong>{{ $errors->first('AttendanceExpected') }}</strong>
  </span>
  @endif
</div>



 {!! Form::label('ActualAttendance', 'Actual Attendance :' , array('class'=>'col-md-2 control-label'  )) !!}
 <div class="col-md-2">
  {!! Form::number('ActualAttendance',null, array('class' => 'form-control', 'placeholder'=>'Actual', 'id'=>'ActualAttendance',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('ActualAttendance'))
  <span class="help-block">
    <strong>{{ $errors->first('ActualAttendance') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Interest') ? ' has-error' : '' }}">
 {!! Form::label('Interest', 'Interest :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('Interest',null, array('class' => 'form-control', 'placeholder'=>'Interest', 'id'=>'Interest',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Interest'))
  <span class="help-block">
    <strong>{{ $errors->first('Interest') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('CharacterOfStu') ? ' has-error' : '' }}">
 {!! Form::label('CharacterOfStu', 'Conduct:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('CharacterOfStu',null, array('class' => 'form-control', 'placeholder'=>'Conduct', 'id'=>'CharacterOfStu',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('CharacterOfStu'))
  <span class="help-block">
    <strong>{{ $errors->first('CharacterOfStu') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('ClassTeacherRemarks') ? ' has-error' : '' }}">
 {!! Form::label('ClassTeacherRemarks', 'Class Teacher Remarks :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('ClassTeacherRemarks',null, array('class' => 'form-control', 'placeholder'=>'Class Teacher Remarks', 'id'=>'ClassTeacherRemarks',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('ClassTeacherRemarks'))
  <span class="help-block">
    <strong>{{ $errors->first('ClassTeacherRemarks') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('HeadTeacherRemarks') ? ' has-error' : '' }}">
 {!! Form::label('HeadTeacherRemarks', 'Head Teacher Remarks:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('HeadTeacherRemarks',null, array('class' => 'form-control','placeholder'=>'Head Teacher Remarks ', 'id'=>'HeadTeacherRemarks',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('HeadTeacherRemarks'))
  <span class="help-block">
    <strong>{{ $errors->first('HeadTeacherRemarks') }}</strong>
  </span>
  @endif
</div>
</div>


