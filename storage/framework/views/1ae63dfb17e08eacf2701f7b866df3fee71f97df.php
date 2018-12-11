       <br>
       
       <legend> Term </legend>
      <br>
       <!-- Text input-->
       <div class="form-group<?php echo e($errors->has('TermName') ? ' has-error' : ''); ?>">
         <?php echo Form::label('TermName', 'Term Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::text('TermName', null, array('class' => 'form-control', 'placeholder'=>'Enter Term', 'id'=>'termid',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('TermName')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('TermName')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div>

       <!--  <div class="form-group<?php echo e($errors->has('SchoolCode') ? ' has-error' : ''); ?>">
         <?php echo Form::label('SchoolCode', ' School Code:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::text('SchoolCode', null, array('class' => 'form-control', 'placeholder'=>'Enter Code','id'=>'schoolcode', 
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('SchoolCode')): ?>
              <span class="help-block">
             <strong><?php echo e($errors->first('SchoolCode')); ?></strong>
             </span>
               <?php endif; ?>
          </div>
       </div> -->

        