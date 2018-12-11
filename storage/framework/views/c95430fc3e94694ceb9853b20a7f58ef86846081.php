       <br>
       
       <legend> Subjects </legend>
      <br>
       <!-- Text input-->
       <div class="form-group<?php echo e($errors->has('StudentName') ? ' has-error' : ''); ?>">
         <?php echo Form::label('StudentName', 'Student Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::text('StudentName', null, array('class' => 'form-control', 'placeholder'=>'Enter Student Name', 'id'=>'studentnames',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('StudentName')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('StudentName')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div>


<div class="form-group<?php echo e($errors->has('ClassID') ? ' has-error' : ''); ?>">
 <?php echo Form::label('ClassID', 'Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('ClassID',$Class,null, array('class' => 'form-control', 'placeholder'=>'Select Class Name', 'id' => 'classnameID',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('ClassID')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('ClassID')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>
       
<?php /* 
          <div class="form-group<?php echo e($errors->has('ClassID') ? ' has-error' : ''); ?>">
         <?php echo Form::label('ClassID', 'Parent Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('ClassID',$Parent, null, array('class' => 'form-control', 'placeholder'=>'Select Parent Name', 'id'=>'classid','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('ClassID')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('ClassID')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div> */ ?>
  
        <div class="form-group<?php echo e($errors->has('SchoolCode') ? ' has-error' : ''); ?>">
         <?php echo Form::label('SchoolCode', ' School Code:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
          <?php echo Form::text('SchoolCode',null, array('class' => 'form-control', 'placeholder'=>'Enter Code', 'id' => 'schoolcode',
          ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

          <?php if($errors->has('SchoolCode')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('SchoolCode')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
        </div>


       
        