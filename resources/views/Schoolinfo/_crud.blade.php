   
  <br>
       
       <legend style="text-align: center; font-size: 50px;"> <strong>Create School</strong></legend>
      
      <br><br><br>
<!-- Text input-->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
 {!! Form::label('name ', 'Name of School:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('Name',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'Name',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('name'))
  <span class="help-block">
    <strong>{{ $errors->first('name') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
 {!! Form::label('address', 'School Address :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('Address',null, array('class' => 'form-control', 'id'=>'address',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('address'))
  <span class="help-block">
    <strong>{{ $errors->first('address') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
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
</div>
<div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
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

 <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
        {!! Form::label('file', ' School Background Pic:' , array('class'=>'col-md-4 control-label'  )) !!}
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

{{-- <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
        {!! Form::label('file', ' File:' , array('class'=>'col-md-4 control-label'  )) !!}
      <div class="col-md-6">
        {!! Form::file('file',  array('class' => 'form-control', 'placeholder'=>'','id'=>'imgInp2', 
        ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
        @if ($errors->has('file'))
        <span class="help-block">
         <strong>{{ $errors->first('file') }}</strong>
       </span>
       @endif
      </div>
      </div>

<div class="col-md-offset-4" style="margin-bottom: 15px">
  <img id="blah2" src="#" alt="" height="150px" width="150px"/img>
</div> --}}


