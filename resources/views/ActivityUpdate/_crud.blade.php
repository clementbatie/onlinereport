<!-- form details -->


       <!-- Form Name -->
       <legend>Activity Update</legend>

       <!-- Text input-->
        <div class="form-group">
         {!! Form::label('ProjectID', 'Project Name:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-6">
 {!!Form::select('ProjectID',$Project,null,['class'=>'form-control',
       'placeholder'=>'Select Project Name',($rwstate=='true' ? 'readonly' :null ) ] )!!}
                 </div>
       </div>
        <div class="form-group">
         {!! Form::label('Activity_Description', 'Activity Description:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-6">
            {!! Form::text('Activity_Description',null, array('class' => 'form-control',  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          </div>
       </div>
       <div class="form-group">
         {!! Form::label('Activity', 'Activity:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-6">
 {!!Form::select('Activity_ID',$Activity,null,['class'=>'form-control',
       'placeholder'=>'Select Work Activity',($rwstate=='true' ? 'readonly' :null ) ] )!!}
                 </div>
       </div>
  
          <div class="form-group">
         {!! Form::label('Date_Worked', 'Activity Date:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-6">
            {!! Form::text('Date_Worked',null, array('id' => 'datepicker','class' => 'form-control',  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          </div>
       </div>
          <div class="form-group">
         {!! Form::label('Start_Time', 'Start Time:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-3">
{!!Form::select('Start_hour',$hours,null,['class'=>'form-control',
       'placeholder'=>'GMT(24hrs)',($rwstate=='true' ? 'readonly' :null ) ] )!!}         
        </div>
<div class="col-sm-3">
{!!Form::select('Start_minute',$Minute,null,['class'=>'form-control',
       'placeholder'=>'Minutes',($rwstate=='true' ? 'readonly' :null ) ] )!!}
          </div>
       </div>
         <div class="form-group">
         
         {!! Form::label('End_Time', 'End Time:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-3">
{!!Form::select('End_hour',$hours,null,['class'=>'form-control',
       'placeholder'=>'GMT(24hrs)',($rwstate=='true' ? 'readonly' :null ) ] )!!}         
        </div>
<div class="col-sm-3">
{!!Form::select('End_minute',$Minute,null,['class'=>'form-control',
       'placeholder'=>'Minutes',($rwstate=='true' ? 'readonly' :null ) ] )!!}
          </div>
       </div>
          <div class="form-group">
         {!! Form::label('Remarks', 'Remarks:' , array('class'=>'col-sm-2 control-label'  )) !!}
         <div class="col-sm-6">
            {!! Form::textarea('Remarks',null, array('class' => 'form-control',  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          </div>
       </div>
        
