<!-- form details -->


       <!-- Form Name -->
       <legend> Organization</legend>

       <!-- Text input-->
        <div class="form-group{{ $errors->has('National') ? ' has-error' : '' }}">
         {!! Form::label('NationalName', ' Organization Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::text('NationalName',null, array('class' => 'form-control', 'placeholder'=>'', 
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('National'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('National') }}</strong>
                                    </span>
                                @endif
          </div>
       </div>

   


 <!-- Text input-->
        <div class="form-group{{ $errors->has('NationalCode') ? ' has-error' : '' }}">
         {!! Form::label('NationalCode', 'OrganizationCode:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::text('NationalCode',null, array('class' => 'form-control', 'placeholder'=>'', 
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('NationalCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('NationalCode') }}</strong>
                                    </span>
                                @endif
          </div>
       </div>
  

   