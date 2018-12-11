       <br>
       
       <legend style="text-align: center; font-size: 50px;"><strong>Student</strong></legend>

        <div class="col-md-offset-4">
          <img id="blah" src="#" alt="" height="150px" width="150px"/img>

           <div class="pull-left"><img src="{{asset('uploads/').'/'.$Images2}}" alt="" height="150px" width="150px"></div>
       </div>

        
      <br><br><br><br><br><br><br><br><br><br>

         {{--  <div class="form-group{{ $errors->has('Year') ? ' has-error' : '' }}">
         {!! Form::label('Year', ' Year:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('Year',$Year, null, array('class' => 'form-control','id'=>'year',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('Year'))
          <span class="help-block">
          <strong>{{ $errors->first('Year') }}</strong>
          </span>
          @endif
          </div>
       </div> 

        <div class="form-group{{ $errors->has('Term') ? ' has-error' : '' }}">
         {!! Form::label('Term', 'Term:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('Term',$Term, null, array('class' => 'form-control','id'=>'term',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('Term'))
          <span class="help-block">
          <strong>{{ $errors->first('Term') }}</strong>
          </span>
          @endif
          </div>
       </div>  --}}
  

       <div class="form-group{{ $errors->has('StudentName') ? ' has-error' : '' }}">
         {!! Form::label('StudentName', 'Student Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::text('StudentName', null, array('class' => 'form-control', 'placeholder'=>'Enter Student Name', 'id'=>'studentnames',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('StudentName'))
          <span class="help-block">
          <strong>{{ $errors->first('StudentName') }}</strong>
          </span>
          @endif
          </div>
       </div>

       <div class="form-group{{ $errors->has('Gender') ? ' has-error' : '' }}">
         {!! Form::label('Gender', 'Gender:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-2">
            {!! Form::select('Gender',['Male'=>'Male','Female'=>'Female'], null, array('class' => 'form-control', 'placeholder'=>'Select Gender', 'id'=>'gender',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('Gender'))
          <span class="help-block">
          <strong>{{ $errors->first('Gender') }}</strong>
          </span>
          @endif
          </div>

           {!! Form::label('DOB', 'Date Of Birth:' , array('class'=>'col-md-2 control-label'  )) !!}
         <div class="col-md-2">
            {!! Form::text('DOB', null, array('class' => 'form-control', 'placeholder'=>'Date Of Birth', 'id'=>'datepicker',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('DOB'))
          <span class="help-block">
          <strong>{{ $errors->first('DOB') }}</strong>
          </span>
          @endif
       </div>
</div>


        <div class="form-group{{ $errors->has('ClassID') ? ' has-error' : '' }}">
         {!! Form::label('ClassID', 'Class Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
          {!! Form::select('ClassID',$Class,null, array('class' => 'form-control', 'id' => 'classnameID',
          ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          @if ($errors->has('ClassID'))
          <span class="help-block">
            <strong>{{ $errors->first('ClassID') }}</strong>
          </span>
          @endif
        </div>
        </div>
       

        <div class="form-group{{ $errors->has('parentname') ? ' has-error' : '' }}">
         {!! Form::label('parentname', 'Parent Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::text('ParentName',null, array('class' => 'form-control', 'placeholder'=>'Select Parent Name', 'id'=>'parentname','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('parentname'))
          <span class="help-block">
          <strong>{{ $errors->first('parentname') }}</strong>
          </span>
          @endif
          </div>
       </div> 

          <div class="form-group{{ $errors->has('ParentNumber') ? ' has-error' : '' }}">
         {!! Form::label('ParentNumber', 'Parent Number:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::number('ParentNumber',null, array('class' => 'form-control', 'placeholder'=>'Select Parent Name', 'id'=>'parentnumber','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('ParentNumber'))
          <span class="help-block">
          <strong>{{ $errors->first('ParentNumber') }}</strong>
          </span>
          @endif
          </div>
       </div> 


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



      



       
        