       <legend>Student Behaviour</legend>
  
<!-- Text input-->
<div class="form-group<?php echo e($errors->has('Year') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Year ', 'Year:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('Year',$Year, null, array('class' => 'form-control', 'placeholder'=>'Select Year', 'id' => 'year',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Year')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Year')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('Term') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Term', 'Term :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('Term',$Term, null, array('class' => 'form-control','placeholder'=>'Select Term', 'id'=>'term',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Term')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Term')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('ClassID') ? ' has-error' : ''); ?>">
 <?php echo Form::label('ClassID', 'Class :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('ClassID',$Class,null, array('class' => 'form-control', 'placeholder'=>'Select Class', 'id'=>'ClassID',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('ClassID')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('ClassID')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('id') ? ' has-error' : ''); ?>">
 <?php echo Form::label('id', 'Student Name :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('id',$StudentName, null, array('class' => 'form-control', 'placeholder'=>'Select Student Name','id'=>'studentname',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('id')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('id')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>
<div class="form-group<?php echo e($errors->has(' PromotedTo ') ? ' has-error' : ''); ?>">
 <?php echo Form::label('PromotedTo', 'Promoted To :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('PromotedTo',$PromotedTo , null, array('class' => 'form-control', 'placeholder'=>'PromotedTo ','id'=>'PromotedTo',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('PromotedTo')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('PromotedTo')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('AttendanceExpected') ? ' has-error' : ''); ?>">
 <?php echo Form::label('AttendanceExpected ', 'Attendance Expected:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::number('AttendanceExpected',null, array('class' => 'form-control', 'placeholder'=>'Enter Attendance Expected', 'id' => 'AttendanceExpected',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('AttendanceExpected')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('AttendanceExpected')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('ActualAttendance') ? ' has-error' : ''); ?>">
 <?php echo Form::label('ActualAttendance', 'Actual Attendance :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::number('ActualAttendance',null, array('class' => 'form-control', 'placeholder'=>'Enter Actual Attendance', 'id'=>'ActualAttendance',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('ActualAttendance')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('ActualAttendance')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('Interest') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Interest', 'Interest :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('Interest',null, array('class' => 'form-control', 'placeholder'=>'Interest', 'id'=>'Interest',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Interest')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Interest')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('CharacterOfStu') ? ' has-error' : ''); ?>">
 <?php echo Form::label('CharacterOfStu', 'Conduct:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('CharacterOfStu',null, array('class' => 'form-control', 'placeholder'=>'Conduct', 'id'=>'CharacterOfStu',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('CharacterOfStu')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('CharacterOfStu')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('ClassTeacherRemarks') ? ' has-error' : ''); ?>">
 <?php echo Form::label('ClassTeacherRemarks', 'Class Teacher Remarks :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('ClassTeacherRemarks',null, array('class' => 'form-control', 'placeholder'=>'Class Teacher Remarks', 'id'=>'ClassTeacherRemarks',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('ClassTeacherRemarks')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('ClassTeacherRemarks')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('HeadTeacherRemarks') ? ' has-error' : ''); ?>">
 <?php echo Form::label('HeadTeacherRemarks', 'Head Teacher Remarks:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('HeadTeacherRemarks',null, array('class' => 'form-control','placeholder'=>'Head Teacher Remarks ', 'id'=>'HeadTeacherRemarks',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('HeadTeacherRemarks')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('HeadTeacherRemarks')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>


