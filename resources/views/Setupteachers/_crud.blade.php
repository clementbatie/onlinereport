     
       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Teacher</strong></legend>

        <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      <br><br><br>
  
<!-- Text input-->

 <div class="form-group{{ $errors->has('TeacherSetupName') ? ' has-error' : '' }}">
         {!! Form::label('TeacherSetupName', 'Teacher Name :' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {{-- {!! Form::text('TeacherSetupName', null, array('class' => 'inputForm',"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Teacher Name','id'=>'teachersetupname', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!} --}}

            {!! Form::text('TeacherSetupName', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Class Name', 'id'=>'teachersetupname',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('TeacherSetupName'))
              <span class="help-block">
             <strong>{{ $errors->first('TeacherSetupName') }}</strong>
             </span>
               @endif
          </div>
       </div>

        <div class="form-group{{ $errors->has('PhoneNo') ? ' has-error' : '' }}">
         {!! Form::label('PhoneNo', 'Phone number :' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
          {{-- {!! Form::number('PhoneNo',null, array('class' => 'form-control', 'id'=>'phonenumber','placeholder'=>'Enter Phone Number',
          ( $rwstate=='true' ?  'readonly'  :null )  )) !!} --}}

          {!! Form::number('PhoneNo', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Phone Number', 'id'=>'phonenumber',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          @if ($errors->has('PhoneNo'))
          <span class="help-block">
            <strong>{{ $errors->first('PhoneNo') }}</strong>
          </span>
          @endif
        </div>
        </div>


