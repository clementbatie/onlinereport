       
       <br>
       
       <legend style="text-align: center; font-size: 50px;"> <strong>Create School Logo</strong></legend>
      
      <br><br><br>
  
<!-- Text input-->
<?php /* <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
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
</div> */ ?>

<?php /* <div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
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
</div> */ ?>


<!-- Form Name -->

<div class="form-group<?php echo e($errors->has('Name') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Name', 'School Name :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('Name', $school ,null, array('class' => 'form-control','placeholder' => 'Select School Name', 'id'=>'name',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Name')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Name')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<?php /* <div class="form-group<?php echo e($errors->has('phonenumber') ? ' has-error' : ''); ?>">
 <?php echo Form::label('UserLevelID', 'User Level :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('UserLevelID', $userlevel ,null, array('class' => 'form-control','placeholder' => 'Select User Level', 'id'=>'UserLevelID2',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('UserLevelID')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('UserLevelID')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div> */ ?>

<div class="form-group<?php echo e($errors->has('file') ? ' has-error' : ''); ?>">
        <?php echo Form::label('file', ' File:' , array('class'=>'col-md-4 control-label'  )); ?>

      <div class="col-md-6">
        <?php echo Form::file('file',  array('class' => 'form-control', 'placeholder'=>'','id'=>'imgInp', 
        ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

        <?php if($errors->has('file')): ?>
        <span class="help-block">
         <strong><?php echo e($errors->first('file')); ?></strong>
       </span>
       <?php endif; ?>
      </div>
      </div>

<div class="col-md-offset-4" style="margin-bottom: 15px">
  <img id="blah" src="#" alt="" height="150px" width="150px"/img>
</div>



  




