       <legend>School Info</legend>
  
<!-- Text input-->
<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
 <?php echo Form::label('name ', 'Name of School:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('Name',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'Name',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('name')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('name')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
 <?php echo Form::label('address', 'School Address :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('Address',null, array('class' => 'form-control', 'id'=>'address',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('address')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('address')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
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
</div>
<div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
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


