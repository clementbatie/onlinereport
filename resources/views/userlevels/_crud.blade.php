<!-- form details -->


       <!-- Form Name -->
       <legend>User Level</legend>

       <!-- Text input-->
       <div class="form-group">
         {!! Form::label('UserLevel', 'User Level:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-6">
            {!! Form::text('UserLevel',null, array('class' => 'form-control',  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          </div>
       </div>

   
   
          



  

   