       <br>
       
       <legend> Subjects </legend>
      <br>
       <!-- Text input-->
       <div class="form-group<?php echo e($errors->has('  SubjectName') ? ' has-error' : ''); ?>">
         <?php echo Form::label('  SubjectName', 'Subject Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::text('SubjectName', null, array('class' => 'form-control', 'placeholder'=>'Enter Subject Name', 'id'=>'subjectname','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('   SubjectName')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('   SubjectName')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div>


          <div class="form-group<?php echo e($errors->has('ClassID') ? ' has-error' : ''); ?>">
         <?php echo Form::label('ClassID', 'Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('ClassID',$Class, null, array('class' => 'form-control', 'placeholder'=>'Select Class Name', 'id'=>'classid','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('ClassID')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('ClassID')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div>


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


       
        