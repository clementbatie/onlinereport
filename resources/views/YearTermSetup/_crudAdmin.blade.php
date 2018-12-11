     

        <br>
       
       <legend style="text-align: center; font-size: 50px; margin-top: -70px; margin-bottom: -16px;"> <strong>Create Year and Term</strong></legend>

       <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      
      <br><br><br>
       <!-- Text input-->
       <div class="form-group{{ $errors->has('Year') ? ' has-error' : '' }}">
         {!! Form::label('Year', 'Academic Year:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('Year',$Years, null, array('class' => 'form-control', 'placeholder'=>'Select Year', 'id'=>'yearsetup',
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
        {!! Form::select('TermID',$Term, null, array('class' => 'form-control', 'placeholder'=>'Select Term', 'id' => 'termsetup',
        ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
        @if ($errors->has('Term'))
        <span class="help-block">
          <strong>{{ $errors->first('Term') }}</strong>
        </span>
        @endif
      </div>
      </div>

     <div class="form-group{{ $errors->has('TermBegin') ? ' has-error' : '' }}">
       {!! Form::label('TermBegin', 'Term Begin Date:' , array('class'=>'col-md-4 control-label'  )) !!}
       <div class="col-md-6">
        {!! Form::text('TermBegin', null, array('class' => 'form-control', 'placeholder'=>'Select Start Date', 'id' => 'datepicker',
        ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
        @if ($errors->has(''))
        <span class="help-block">
          <strong>{{ $errors->first('TermBegin') }}</strong>
        </span>
        @endif
      </div>
      </div>

      <div class="form-group{{ $errors->has('TermEnd') ? ' has-error' : '' }}">
       {!! Form::label('TermEnd', 'Term End Date:' , array('class'=>'col-md-4 control-label'  )) !!}
       <div class="col-md-6">
        {!! Form::text('TermEnd', null, array('class' => 'form-control', 'placeholder'=>'Select End Date', 'id' => 'datepicker1',
        ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
        @if ($errors->has('TermEnd'))
        <span class="help-block">
          <strong>{{ $errors->first('TermEnd') }}</strong>
        </span>
        @endif
      </div>
      </div>
      