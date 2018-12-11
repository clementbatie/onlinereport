       <br>
       
       <legend> Subjects </legend>
      <br>
       <!-- Text input-->
      {{--  <div class="form-group{{ $errors->has('  SubjectName') ? ' has-error' : '' }}">
         {!! Form::label('  SubjectName', 'Subject Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('SubjectName',$subject, null, array('class' => 'form-control', 'placeholder'=>'Enter Subject Name', 'id'=>'subjectname','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('   SubjectName'))
          <span class="help-block">
          <strong>{{ $errors->first('   SubjectName') }}</strong>
          </span>
          @endif
          </div>
       </div> --}}


       <div class="form-group{{ $errors->has('SubjectName') ? ' has-error' : '' }}">
         {!! Form::label('SubjectName', 'Subject Name :' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('SubjectName',$subject, null, array('class' => 'form-control', 'placeholder'=>'Select Subject Name','id'=>'subjectname', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('SubjectName'))
              <span class="help-block">
             <strong>{{ $errors->first('SubjectName') }}</strong>
             </span>
               @endif
          </div>
       </div>


          <div class="form-group{{ $errors->has('ClassID') ? ' has-error' : '' }}">
         {!! Form::label('ClassID', 'Class Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('ClassID',$Class, null, array('class' => 'form-control', 'placeholder'=>'Select Class Name', 'id'=>'classid','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('ClassID'))
          <span class="help-block">
          <strong>{{ $errors->first('ClassID') }}</strong>
          </span>
          @endif
          </div>
       </div>


       {{--  <div class="form-group{{ $errors->has('SchoolCode') ? ' has-error' : '' }}">
         {!! Form::label('SchoolCode', ' School Code:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
          {!! Form::text('SchoolCode',null, array('class' => 'form-control', 'placeholder'=>'Enter Code', 'id' => 'schoolcode',
          ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          @if ($errors->has('SchoolCode'))
          <span class="help-block">
            <strong>{{ $errors->first('SchoolCode') }}</strong>
          </span>
          @endif
        </div>
        </div> --}}


       
        