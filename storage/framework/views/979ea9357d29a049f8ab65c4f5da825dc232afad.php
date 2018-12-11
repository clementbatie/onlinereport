
  <br>
       
       <legend style="text-align: center; font-size: 50px; margin-bottom: -16px;"> <strong>Assign Class and Subject to Teacher</strong></legend>

 <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>
      
      <br><br><br>
<!-- Text input-->

 <div class="form-group<?php echo e($errors->has('TeachersetupID') ? ' has-error' : ''); ?>">
         <?php echo Form::label('TeachersetupID', 'Teacher Name :' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('TeachersetupID',$teachername, null, array('class' => 'form-control', 'placeholder'=>'Select Teacher Name','id'=>'teachername', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('TeachersetupID')): ?>
              <span class="help-block">
             <strong><?php echo e($errors->first('TeachersetupID')); ?></strong>
             </span>
               <?php endif; ?>
          </div>
       </div>

 <div class="form-group<?php echo e($errors->has('ClassID') ? ' has-error' : ''); ?>">
         <?php echo Form::label('ClassID', ' Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('ClassID',$class, null, array('class' => 'form-control', 'placeholder'=>'Select Class Name','id'=>'teacherclass', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('ClassID')): ?>
              <span class="help-block">
             <strong><?php echo e($errors->first('ClassID')); ?></strong>
             </span>
               <?php endif; ?>
          </div>
       </div>


 <div class="form-group<?php echo e($errors->has('SubjectID') ? ' has-error' : ''); ?>">
         <?php echo Form::label('SubjectID', ' Subject Name:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
            <?php echo Form::select('SubjectID',$subject, null, array('class' => 'form-control', 'placeholder'=>'Select Subject Name','id'=>'teachersubject', 'class'=>'selectpicker form-control', 'data-live-search'=>'true',
             ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

              <?php if($errors->has('SubjectID')): ?>
              <span class="help-block">
             <strong><?php echo e($errors->first('SubjectID')); ?></strong>
             </span>
               <?php endif; ?>
          </div>
       </div>

<?php /* <div class="form-group<?php echo e($errors->has('PhoneNo') ? ' has-error' : ''); ?>">
 <?php echo Form::label('PhoneNo', 'Phone number :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::number('PhoneNo',null, array('class' => 'form-control', 'id'=>'teacherphonenumber',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('PhoneNo')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('PhoneNo')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div> */ ?>



<?php /* <!-- <div class="form-group<?php echo e($errors->has('Children') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Member Name', 'Class Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('ClassID[]',$class,$rows ? json_decode($rows->SelectallChildren) : null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'teacherclass',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Children')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Children')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div> --> */ ?>



<?php /* <!-- <div class="form-group<?php echo e($errors->has('Children') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Member Name', 'Subject Name:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('SubjectID[]',$subject,$rows ? json_decode($rows->SelectallSubject) : null, array('class' => 'form-control selectpicker','multiple','data-live-search'=>'true', 'id'=>'teachersubject',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('Children')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('Children')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div> --> */ ?>




  



