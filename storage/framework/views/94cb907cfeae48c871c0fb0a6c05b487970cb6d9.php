     
       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Teacher</strong></legend>

        <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>
      <br><br><br>
  
<!-- Text input-->

 <div class="form-group<?php echo e($errors->has('TeacherSetupName') ? ' has-error' : ''); ?>">
         <?php echo Form::label('TeacherSetupName', 'Teacher Name :' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php /* <?php echo Form::text('TeacherSetupName', null, array('class' => 'inputForm',"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Teacher Name','id'=>'teachersetupname', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?> */ ?>

            <?php echo Form::text('TeacherSetupName', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Class Name', 'id'=>'teachersetupname',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('TeacherSetupName')): ?>
              <span class="help-block">
             <strong><?php echo e($errors->first('TeacherSetupName')); ?></strong>
             </span>
               <?php endif; ?>
          </div>
       </div>

        <div class="form-group<?php echo e($errors->has('PhoneNo') ? ' has-error' : ''); ?>">
         <?php echo Form::label('PhoneNo', 'Phone number :' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
          <?php /* <?php echo Form::number('PhoneNo',null, array('class' => 'form-control', 'id'=>'phonenumber','placeholder'=>'Enter Phone Number',
          ( $rwstate=='true' ?  'readonly'  :null )  )); ?> */ ?>

          <?php echo Form::number('PhoneNo', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Phone Number', 'id'=>'phonenumber',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

          <?php if($errors->has('PhoneNo')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('PhoneNo')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
        </div>


