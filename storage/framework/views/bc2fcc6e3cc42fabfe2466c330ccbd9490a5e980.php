       <legend>Parents Records</legend>
  
<!-- Text input-->
<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
 <?php echo Form::label('name ', 'Name :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('name',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'name',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('name')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('name')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
 <?php echo Form::label('email ', 'Email :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('email',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'useremail',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('email')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('email')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Phone Number', 'Phone Number:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('PhoneNo', null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'PhoneNo',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('PhoneNo')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('PhoneNo')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<!-- Form Name -->

<div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
 <?php echo Form::label('UserLevelID', 'User Level :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('UserLevelID', $userlevel ,null, array('class' => 'form-control','placeholder' => 'Select User Level', 'id'=>'UserLevelID',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('UserLevelID')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('UserLevelID')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<!-- <div class="form-group<?php echo e($errors->has('Children') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Member Name', 'Children Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('children[]',$children,$rows ? json_decode($rows->SelectallChildren) : null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'parentchildren',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Children')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Children')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div> -->


<div class="form-group<?php echo e($errors->has('Children') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Member Name', 'Children Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('children[]',$children,$rows ? json_decode($rows->SelectallChildren) : null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'parentchildren',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Children')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Children')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>
