       <legend>Terminal Score</legend>
  
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

<div class="form-group<?php echo e($errors->has('Class') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Class', 'Class :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('Class',$Class,null, array('class' => 'form-control', 'placeholder'=>'Select Class', 'id'=>'Class',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Class')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Class')); ?></strong>
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
<div class="form-group<?php echo e($errors->has('subject') ? ' has-error' : ''); ?>">
 <?php echo Form::label('subject', 'Subject :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('SubjectID',$Subject, null, array('class' => 'form-control', 'placeholder'=>'Select Subject','id'=>'subjectname',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('subject')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('subject')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>


<div class="form-group<?php echo e($errors->has('classscore') ? ' has-error' : ''); ?>">
 <?php echo Form::label('classscore ', 'Class Score:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::number('classscore',null, array('class' => 'form-control', 'placeholder'=>'Enter Class Score', 'id' => 'classscore',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('classscore')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('classscore')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('examscore') ? ' has-error' : ''); ?>">
 <?php echo Form::label('examscore', 'Exams Score :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::number('examscore',null, array('class' => 'form-control', 'placeholder'=>'Enter Exams Score', 'id'=>'examscore',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('examscore')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('examscore')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>


<div class="form-group<?php echo e($errors->has('position') ? ' has-error' : ''); ?>">
 <?php echo Form::label('position', 'Position :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('position',null, array('class' => 'form-control', 'placeholder'=>'Enter Position', 'id'=>'position',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('position')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('position')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>
<div class="form-group<?php echo e($errors->has('remarks') ? ' has-error' : ''); ?>">
 <?php echo Form::label('remarks', 'Remarks :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('remarks',null, array('class' => 'form-control', 'placeholder'=>'Enter Remaks', 'id'=>'remarks',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('remarks')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('number')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>


