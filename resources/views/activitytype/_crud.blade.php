<!-- form details -->


       <!-- Form Name -->
       <legend> Activity Type</legend>

   
       
      
        <div class="form-group{{ $errors->has('activitytype') ? ' has-error' : '' }}">
         {!! Form::label('activitytype', ' Activitytype Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::text('activitytype',null, array('class' => 'form-control', 'placeholder'=>'', 
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('activitytype'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activitytype') }}</strong>
                                    </span>
                                @endif
          </div>
       </div>

   

