<!-- form details -->


       <!-- Form Name -->
       <legend>Activity Description</legend>

       <!-- Text input-->
       <div class="form-group">
         {!! Form::label('Activity', 'Activity:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-6">
            {!! Form::text('Activity',null, array('class' => 'form-control',  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          </div>
       </div>
        <div class="form-group">
         {!! Form::label('Short Code', 'Code:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-6">
            {!! Form::text('Code',null, array('class' => 'form-control',  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          </div>
       </div>


   
   
          



  

   