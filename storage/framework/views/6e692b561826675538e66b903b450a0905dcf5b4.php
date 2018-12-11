
              
              <br>
       
       <legend style="text-align: center; font-size: 50px;"> <strong>Edit School Logo</strong></legend>
      
      <br><br><br>

              <div class="col-md-offset-4">
          <img id="blah" src="#" alt="" height="150px" width="150px"/img>

           <div class="pull-left"><img src="<?php echo e(asset('uploads/').'/'.$Images2); ?>" alt="" height="150px" width="150px"></div>
       </div><br><br><br><br><br><br><br><br><br>
  
<!-- Text input-->
<div class="form-group<?php echo e($errors->has('SchoolCode') ? ' has-error' : ''); ?>">
 <?php echo Form::label('SchoolCode', 'School Name :' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::select('SchoolCode', $school ,null, array('class' => 'form-control','placeholder' => 'Select School Name', 'id'=>'name',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('SchoolCode')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('SchoolCode')); ?></strong>
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


