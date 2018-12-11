       
         <br>
       
       <legend style="text-align: center; font-size: 50px;margin-bottom: -16px;"> <strong>Create Term</strong></legend>
      <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>
      <br><br><br>

       <!-- Text input-->
       <div class="form-group<?php echo e($errors->has('TermName') ? ' has-error' : ''); ?>">
         <?php echo Form::label('TermName', 'Term Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::text('TermName', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Term', 'id'=>'termid',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('TermName')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('TermName')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div>


   