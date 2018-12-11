       
      <br>
       
       <legend style="text-align: center; font-size: 50px;"> <strong>Create Class Information</strong></legend>
      <br>
       <!-- Text input-->
        {{-- <div class="form-group{{ $errors->has('Year') ? ' has-error' : '' }}">
         {!! Form::label('Year', 'Year:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
          {!! Form::select('Year',$Year, null, array('class' => 'form-control', 'id'=>'year',
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
            {!! Form::select('Term',$Term, null, array('class' => 'form-control', 'id'=>'term',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('Term'))
            <span class="help-block">
            <strong>{{ $errors->first('Term') }}</strong>
            </span>
            @endif
          </div>
       </div><br><br> --}}

       <div class="form-group{{ $errors->has('ClassID') ? ' has-error' : '' }}">
         {!! Form::label('ClassID', 'Class Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::select('ClassID',$Classname, null, array('class' => 'form-control', 'placeholder'=>'Select Class', 'id'=>'classid','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('ClassID'))
          <span class="help-block">
          <strong>{{ $errors->first('ClassID') }}</strong>
          </span>
          @endif
          </div>
       </div>

        <div class="form-group{{ $errors->has('OnRoll') ? ' has-error' : '' }}">
         {!! Form::label('OnRoll', ' Number On Roll:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::text('OnRoll', null, array('class' => 'form-control', 'placeholder'=>'No on Roll','id'=>'onroll', 
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('OnRoll'))
              <span class="help-block">
             <strong>{{ $errors->first('OnRoll') }}</strong>
             </span>
               @endif
          </div>
       </div>


        <div class="form-group{{ $errors->has('NextTermBegins') ? ' has-error' : '' }}">
         {!! Form::label('NextTermBegins', ' Next Term Begins:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
          {!! Form::text('NextTermBegins',null, array('class' => 'form-control', 'placeholder'=>'Select Date', 'id' => 'datepicker',
          ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          @if ($errors->has('NextTermBegins'))
          <span class="help-block">
            <strong>{{ $errors->first('NextTermBegins') }}</strong>
          </span>
          @endif
        </div>
        </div>


       <div class="form-group{{ $errors->has('SchoolCloses') ? ' has-error' : '' }}">
       {!! Form::label('SchoolCloses', 'School Closes:' , array('class'=>'col-md-4 control-label'  )) !!}
       <div class="col-md-6">
        {!! Form::text('SchoolCloses',null, array('class' => 'form-control', 'placeholder'=>'Select Date', 'id' => 'datepicker2',
        ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
        @if ($errors->has('SchoolCloses'))
        <span class="help-block">
          <strong>{{ $errors->first('SchoolCloses') }}</strong>
        </span>
        @endif
      </div>
      </div>

       

        {{-- <div class="form-group{{ $errors->has('SchoolCode') ? ' has-error' : '' }}">
         {!! Form::label('SchoolCode', 'School Code:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::text('SchoolCode',null, array('class' => 'form-control', 'placeholder'=>'Enter School Code','id'=>'schoolcode', 
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('SchoolCode'))
            <span class="help-block">
            <strong>{{ $errors->first('SchoolCode') }}</strong>
            </span>
            @endif
          </div>
       </div> --}}


        