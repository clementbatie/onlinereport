       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Class</strong></legend>

      <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      <br><br><br>
  
<!-- Text input-->
<div class="form-group{{ $errors->has('ClassName') ? ' has-error' : '' }}">
 {!! Form::label('ClassName ', 'Class Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {{-- {!! Form::text('ClassName',null, array('class' => 'form-control', 'placeholder'=>'Class Name', 'id' => 'classname',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!} --}}

  {!! Form::text('ClassName', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Class Name', 'id'=>'classname',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('ClassName'))
  <span class="help-block">
    <strong>{{ $errors->first('ClassName') }}</strong>
  </span>
  @endif
</div>
</div>

{{-- <div class="form-group{{ $errors->has('SchoolCode') ? ' has-error' : '' }}">
 {!! Form::label('SchoolCode', 'School Code :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('SchoolCode',null, array('class' => 'form-control', 'id'=>'schoolcode',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('SchoolCode'))
  <span class="help-block">
    <strong>{{ $errors->first('SchoolCode') }}</strong>
  </span>
  @endif
</div>
</div> --}}

<!-- <div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
 {!! Form::label('contactnumber', 'Contact number :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('ContactNos',null, array('class' => 'form-control', 'id'=>'contactNos',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('contactNos'))
  <span class="help-block">
    <strong>{{ $errors->first('contactNos') }}</strong>
  </span>
  @endif
</div>
</div> -->
<!-- <div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
 {!! Form::label('schoolcode', 'School Code :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('SchoolCode',null, array('class' => 'form-control', 'id'=>'SchoolCode',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('schoolcode'))
  <span class="help-block">
    <strong>{{ $errors->first('schoolcode') }}</strong>
  </span>
  @endif
</div>
</div>
<div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
 {!! Form::label('reportname', 'Report Name :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('reportname',null, array('class' => 'form-control', 'id'=>'ReportName',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('reportname'))
  <span class="help-block">
    <strong>{{ $errors->first('reportname') }}</strong>
  </span>
  @endif
</div>
</div>
 -->

