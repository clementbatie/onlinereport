       <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Create Student</strong></legend>

       <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>
      <br><br><br>
       <!-- Text input-->
     <!--    <div class="form-group<?php echo e($errors->has('SchoolCode') ? ' has-error' : ''); ?>">
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
        </div> -->

         <?php /*  <div class="form-group<?php echo e($errors->has('Year') ? ' has-error' : ''); ?>">
         <?php echo Form::label('Year', ' Year:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('Year',$Year, null, array('class' => 'form-control','id'=>'year',
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
            <?php echo Form::select('Term',$Term, null, array('class' => 'form-control','id'=>'term',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('Term')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('Term')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div> <br><br> */ ?>
  

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


       <div class="form-group<?php echo e($errors->has('Gender') ? ' has-error' : ''); ?>">
         <?php echo Form::label('Gender', 'Gender:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-2">
            <?php echo Form::select('Gender',['Male'=>'Male','Female'=>'Female'], null, array('class' => 'form-control', 'placeholder'=>'Select Gender', 'id'=>'gender',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('Gender')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('Gender')); ?></strong>
          </span>
          <?php endif; ?>
          </div>

           <?php echo Form::label('DOB', 'Date Of Birth:' , array('class'=>'col-md-2 control-label'  )); ?>

         <div class="col-md-2">
            <?php echo Form::text('DOB', null, array('class' => 'form-control', 'placeholder'=>'Date Of Birth', 'id'=>'datepicker',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('DOB')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('DOB')); ?></strong>
          </span>
          <?php endif; ?>
       </div>
</div>
      <?php /*  <div class="form-group<?php echo e($errors->has('DOB') ? ' has-error' : ''); ?>">
         <?php echo Form::label('DOB', 'Date Of Birth:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-2">
            <?php echo Form::text('DOB', null, array('class' => 'form-control', 'placeholder'=>'Date Of Birth', 'id'=>'datepicker',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('DOB')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('DOB')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div> */ ?>


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
       

        <div class="form-group<?php echo e($errors->has('parentname') ? ' has-error' : ''); ?>">
         <?php echo Form::label('parentname', 'Parent Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::text('ParentName',null, array('class' => 'form-control', 'placeholder'=>'Select Parent Name', 'id'=>'parentname','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('parentname')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('parentname')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div> 

          <div class="form-group<?php echo e($errors->has('ParentNumber') ? ' has-error' : ''); ?>">
         <?php echo Form::label('ParentNumber', 'Parent Number:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::number('ParentNumber',null, array('class' => 'form-control', 'placeholder'=>'Select Parent Name', 'id'=>'parentnumber','class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('ParentNumber')): ?>
          <span class="help-block">
          <strong><?php echo e($errors->first('ParentNumber')); ?></strong>
          </span>
          <?php endif; ?>
          </div>
       </div> 


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

      



       
        