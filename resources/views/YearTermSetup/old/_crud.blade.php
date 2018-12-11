       <br>
       
       <legend>Year/Term Setup</legend>
      <br>
       <!-- Text input-->
       <div class="form-group{{ $errors->has('Year') ? ' has-error' : '' }}">
         {!! Form::label('Year', 'Year:' , array('class'=>'col-md-4 control-label'  )) !!}
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
        {!! Form::select('Term',$Term, null, array('class' => 'form-control', 'placeholder'=>'Select Term', 'id' => 'termsetup',
        ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
        @if ($errors->has('Term'))
        <span class="help-block">
          <strong>{{ $errors->first('Term') }}</strong>
        </span>
        @endif
      </div>
      </div>
       
