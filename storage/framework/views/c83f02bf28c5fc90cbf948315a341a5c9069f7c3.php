      

       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Users</strong></legend>

       <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>
      <br><br><br>
  
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
 <?php echo Form::label('Phone Number', 'Password:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::password('PhoneNo', array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'PhoneNo',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('PhoneNo')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('PhoneNo')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<?php /* <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
 <?php echo Form::label('password', 'Password:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::password('PhoneNo',array('class' => 'form-control'   )); ?>

  <?php if($errors->has('password')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('password')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div> */ ?>

<!-- Form Name -->

<div class="form-group<?php echo e($errors->has('UserLevelID') ? ' has-error' : ''); ?>">
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

<div style="display: none" class="tohide2 form-group<?php echo e($errors->has('to') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Class', 'Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('Class',$classname,null, array('class' => 'form-control selectpicker','data-live-search'=>'true','id'=>'classteacher',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Class')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Class')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('SetupTeacherID ') ? ' has-error' : ''); ?>">
 <?php echo Form::label('SetupTeacherID ', ' Teacher/Parent :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('SetupTeacherID ', $teacher ,null, array('class' => 'form-control','placeholder' => 'Select Teacher Name', 'id'=>'nameParentTeacher',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('SetupTeacherID ')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('SetupTeacherID ')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>


<div style="display: none" class="tohide form-group<?php echo e($errors->has('to') ? ' has-error' : ''); ?>">
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
