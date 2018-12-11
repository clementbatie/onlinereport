      
       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Subject</strong></legend>

      <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      <br><br><br>
  
<!-- Text input-->
<div class="form-group{{ $errors->has('SubjectName') ? ' has-error' : '' }}">
 {!! Form::label('SubjectName ', 'Subject Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {{-- {!! Form::text('SubjectName',null, array('class' => 'form-control', 'placeholder'=>'Enter Subject Name', 'id' => 'subject2name',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!} --}}

  {!! Form::text('SubjectName', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Subject', 'id'=>'subject2name',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('SubjectName'))
  <span class="help-block">
    <strong>{{ $errors->first('SubjectName') }}</strong>
  </span>
  @endif
</div>
</div>

