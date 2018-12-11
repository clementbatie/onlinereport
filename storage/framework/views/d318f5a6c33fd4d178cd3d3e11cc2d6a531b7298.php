       <br>
       
       <legend> Class Information Form </legend>
      <br>
       <!-- Text input-->
       <div class="form-group<?php echo e($errors->has('ClassID') ? ' has-error' : ''); ?>">
         <?php echo Form::label('ClassID', 'Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('ClassID',$Classname, null, array('class' => 'form-control', 'placeholder'=>'Select Class', 'id'=>'classid','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('ClassID')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('ClassID')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div>

        <div class="form-group<?php echo e($errors->has('OnRoll') ? ' has-error' : ''); ?>">
         <?php echo Form::label('OnRoll', ' Number On Roll:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::text('OnRoll', null, array('class' => 'form-control', 'placeholder'=>'No on Roll','id'=>'onroll', 
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('OnRoll')): ?>
              <span class="help-block">
             <strong><?php echo e($errors->first('OnRoll')); ?></strong>
             </span>
               <?php endif; ?>
          </div>
       </div>


        <div class="form-group<?php echo e($errors->has('NextTermBegins') ? ' has-error' : ''); ?>">
         <?php echo Form::label('NextTermBegins', ' Next Term Begins:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
          <?php echo Form::text('NextTermBegins',null, array('class' => 'form-control', 'placeholder'=>'Select Date', 'id' => 'datepicker',
          ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

          <?php if($errors->has('NextTermBegins')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('NextTermBegins')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
        </div>


       <div class="form-group<?php echo e($errors->has('SchoolCloses') ? ' has-error' : ''); ?>">
       <?php echo Form::label('SchoolCloses', 'School Closes:' , array('class'=>'col-md-4 control-label'  )); ?>

       <div class="col-md-6">
        <?php echo Form::text('SchoolCloses',null, array('class' => 'form-control', 'placeholder'=>'Select Date', 'id' => 'datepicker2',
        ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

        <?php if($errors->has('SchoolCloses')): ?>
        <span class="help-block">
          <strong><?php echo e($errors->first('SchoolCloses')); ?></strong>
        </span>
        <?php endif; ?>
      </div>
      </div>

        <div class="form-group<?php echo e($errors->has('Year') ? ' has-error' : ''); ?>">
         <?php echo Form::label('Year', 'Year:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
          <?php echo Form::text('Year',null, array('class' => 'form-control', 'placeholder'=>'Enter Year', 'id' => 'year',( $rwstate=='true' ?  'readonly'  :null )  )); ?>

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
            <?php echo Form::text('Term',null, array('class' => 'form-control', 'placeholder'=>'Enter Term','id'=>'term', 
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('Term')): ?>
            <span class="help-block">
            <strong><?php echo e($errors->first('Term')); ?></strong>
            </span>
            <?php endif; ?>
          </div>
       </div>

        <div class="form-group<?php echo e($errors->has('SchoolCode') ? ' has-error' : ''); ?>">
         <?php echo Form::label('SchoolCode', 'School Code:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::text('SchoolCode',null, array('class' => 'form-control', 'placeholder'=>'Enter School Code','id'=>'schoolcode', 
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('SchoolCode')): ?>
            <span class="help-block">
            <strong><?php echo e($errors->first('SchoolCode')); ?></strong>
            </span>
            <?php endif; ?>
          </div>
       </div>


        