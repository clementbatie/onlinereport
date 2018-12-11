       <legend>Create Class</legend>
  
<!-- Text input-->
<div class="form-group<?php echo e($errors->has('ClassName') ? ' has-error' : ''); ?>">
 <?php echo Form::label('ClassName ', 'Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('ClassName',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'classname',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('ClassName')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('ClassName')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('SchoolCode') ? ' has-error' : ''); ?>">
 <?php echo Form::label('SchoolCode', 'School Code :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('SchoolCode',null, array('class' => 'form-control', 'id'=>'schoolcode',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('SchoolCode')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('SchoolCode')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<!-- <div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
 <?php echo Form::label('contactnumber', 'Contact number :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('ContactNos',null, array('class' => 'form-control', 'id'=>'contactNos',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('contactNos')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('contactNos')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div> -->
<!-- <div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
 <?php echo Form::label('schoolcode', 'School Code :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('SchoolCode',null, array('class' => 'form-control', 'id'=>'SchoolCode',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('schoolcode')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('schoolcode')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>
<div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
 <?php echo Form::label('reportname', 'Report Name :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('reportname',null, array('class' => 'form-control', 'id'=>'ReportName',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('reportname')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('reportname')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>
 -->

