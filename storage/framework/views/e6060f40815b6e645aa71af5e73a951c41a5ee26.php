      
       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Subject</strong></legend>

      <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>
      <br><br><br>
  
<!-- Text input-->
<div class="form-group<?php echo e($errors->has('SubjectName') ? ' has-error' : ''); ?>">
 <?php echo Form::label('SubjectName ', 'Subject Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php /* <?php echo Form::text('SubjectName',null, array('class' => 'form-control', 'placeholder'=>'Enter Subject Name', 'id' => 'subject2name',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?> */ ?>

  <?php echo Form::text('SubjectName', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Subject', 'id'=>'subject2name',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('SubjectName')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('SubjectName')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

