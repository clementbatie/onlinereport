       <legend>Parents Records</legend>
  
<!-- Text input-->
<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
 <?php echo Form::label('name ', 'Parent Name :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('name',null, array('class' => 'form-control', 'placeholder'=>'', 'id' => 'parentname',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('name')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('name')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Date Joined', 'Phone number :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::number('PhoneNo',null, array('class' => 'form-control', 'id'=>'parentphonenumber',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('phonenumber')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('phonenumber')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<!-- Form Name -->

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



