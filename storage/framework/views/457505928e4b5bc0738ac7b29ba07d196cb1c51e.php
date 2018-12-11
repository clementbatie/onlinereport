     

        <br>
       
       <legend style="text-align: center; font-size: 50px; margin-top: -70px; margin-bottom: -16px;"> <strong>Create Year and Term</strong></legend>

       <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>
      
      <br><br><br>
       <!-- Text input-->
       <div class="form-group<?php echo e($errors->has('Year') ? ' has-error' : ''); ?>">
         <?php echo Form::label('Year', 'Academic Year:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('Year',$Years, null, array('class' => 'form-control', 'placeholder'=>'Select Year', 'id'=>'yearsetup',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('Year')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('Year')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div>


      <div class="form-group<?php echo e($errors->has('Term') ? ' has-error' : ''); ?>">
       <?php echo Form::label('Term', 'Term:' , array('class'=>'col-md-4 control-label'  )); ?>

       <div class="col-md-6">
        <?php echo Form::select('TermID',$Term, null, array('class' => 'form-control', 'placeholder'=>'Select Term', 'id' => 'termsetup',
        ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

        <?php if($errors->has('Term')): ?>
        <span class="help-block">
          <strong><?php echo e($errors->first('Term')); ?></strong>
        </span>
        <?php endif; ?>
      </div>
      </div>

     <div class="form-group<?php echo e($errors->has('TermBegin') ? ' has-error' : ''); ?>">
       <?php echo Form::label('TermBegin', 'Term Begin Date:' , array('class'=>'col-md-4 control-label'  )); ?>

       <div class="col-md-6">
        <?php echo Form::text('TermBegin', null, array('class' => 'form-control', 'placeholder'=>'Select Start Date', 'id' => 'datepicker',
        ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

        <?php if($errors->has('')): ?>
        <span class="help-block">
          <strong><?php echo e($errors->first('TermBegin')); ?></strong>
        </span>
        <?php endif; ?>
      </div>
      </div>

      <div class="form-group<?php echo e($errors->has('TermEnd') ? ' has-error' : ''); ?>">
       <?php echo Form::label('TermEnd', 'Term End Date:' , array('class'=>'col-md-4 control-label'  )); ?>

       <div class="col-md-6">
        <?php echo Form::text('TermEnd', null, array('class' => 'form-control', 'placeholder'=>'Select End Date', 'id' => 'datepicker1',
        ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

        <?php if($errors->has('TermEnd')): ?>
        <span class="help-block">
          <strong><?php echo e($errors->first('TermEnd')); ?></strong>
        </span>
        <?php endif; ?>
      </div>
      </div>
      