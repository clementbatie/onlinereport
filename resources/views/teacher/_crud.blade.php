
  <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Assign Class and Subject to Teacher</strong></legend>

 <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      
      <br><br><br>
<!-- Text input-->

 <div class="form-group{{ $errors->has('TeachersetupID') ? ' has-error' : '' }}">
         {!! Form::label('TeachersetupID', 'Teacher Name :' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('TeachersetupID',$teachername, null, array('class' => 'form-control', 'placeholder'=>'Select Teacher Name','id'=>'teachername', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('TeachersetupID'))
              <span class="help-block">
             <strong>{{ $errors->first('TeachersetupID') }}</strong>
             </span>
               @endif
          </div>
       </div>

 <div class="form-group{{ $errors->has('ClassID') ? ' has-error' : '' }}">
         {!! Form::label('ClassID', ' Class Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('ClassID',$class, null, array('class' => 'form-control', 'placeholder'=>'Select Class Name','id'=>'teacherclass', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('ClassID'))
              <span class="help-block">
             <strong>{{ $errors->first('ClassID') }}</strong>
             </span>
               @endif
          </div>
       </div>


 <div class="form-group{{ $errors->has('SubjectID') ? ' has-error' : '' }}">
         {!! Form::label('SubjectID', ' Subject Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('SubjectID',$subject, null, array('class' => 'form-control', 'placeholder'=>'Select Subject Name','id'=>'teachersubject', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('SubjectID'))
              <span class="help-block">
             <strong>{{ $errors->first('SubjectID') }}</strong>
             </span>
               @endif
          </div>
       </div>

{{-- <div class="form-group{{ $errors->has('PhoneNo') ? ' has-error' : '' }}">
 {!! Form::label('PhoneNo', 'Phone number :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::number('PhoneNo',null, array('class' => 'form-control', 'id'=>'teacherphonenumber',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('PhoneNo'))
  <span class="help-block">
    <strong>{{ $errors->first('PhoneNo') }}</strong>
  </span>
  @endif
</div>
</div> --}}



{{-- <!-- <div class="form-group{{ $errors->has('Children') ? ' has-error' : '' }}">
 {!! Form::label('Member Name', 'Class Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('ClassID[]',$class,$rows ? json_decode($rows->SelectallChildren) : null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'teacherclass',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Children'))
  <span class="help-block">
    <strong>{{ $errors->first('Children') }}</strong>
  </span>
  @endif
</div>
</div> --> --}}



{{-- <!-- <div class="form-group{{ $errors->has('Children') ? ' has-error' : '' }}">
 {!! Form::label('Member Name', 'Subject Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('SubjectID[]',$subject,$rows ? json_decode($rows->SelectallSubject) : null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'teachersubject',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Children'))
  <span class="help-block">
    <strong>{{ $errors->first('Children') }}</strong>
  </span>
  @endif
</div>
</div> --> --}}




  



