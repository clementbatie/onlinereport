    
        <br>
       
       <legend style="text-align: center; font-size: 50px;"> <strong>Create Year and Term</strong></legend>
      
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

      <div class="form-group<?php echo e($errors->has('SchoolCode') ? ' has-error' : ''); ?>">
         <?php echo Form::label('SchoolCode', ' School Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('SchoolCode',$school, null, array('class' => 'form-control', 'placeholder'=>'Select School Name','id'=>'schoolcode', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('SchoolCode')): ?>
              <span class="help-block">
             <strong><?php echo e($errors->first('SchoolCode')); ?></strong>
             </span>
               <?php endif; ?>
          </div>
       </div>
       
