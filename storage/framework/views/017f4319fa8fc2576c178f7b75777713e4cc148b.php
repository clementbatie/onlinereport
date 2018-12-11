       <legend>Teachers Records</legend>
  
<!-- Text input-->
<div class="form-group<?php echo e($errors->has('Name') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Name ', 'Teacher Name :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('Name',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'teachername',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Name')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Name')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('PhoneNo') ? ' has-error' : ''); ?>">
 <?php echo Form::label('PhoneNo', 'Phone number :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::number('PhoneNo',null, array('class' => 'form-control', 'id'=>'teacherphonenumber',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('PhoneNo')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('PhoneNo')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<!-- Form Name -->

<!-- <div class="form-group<?php echo e($errors->has('class') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Member Name', 'Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('class[]',$class, null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'class',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('class')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('class')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div> -->

<div class="form-group<?php echo e($errors->has('Children') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Member Name', 'Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('ClassID[]',$class,$rows ? json_decode($rows->SelectallChildren) : null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'teacherclass',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Children')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Children')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>



