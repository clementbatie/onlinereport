<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <?php $rwstate = "false"; ?>
      <?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo Form::open(array('route' => 'Assembly.shortcodesave', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')); ?>

      <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       <?php echo e(csrf_field()); ?>


       <fieldset>


        <!-- include the partial    -->
        <!-- form details -->


        <!-- Form Name -->
        <legend>Short Code</legend>

        <!-- Text input-->
        

        <div class="form-group<?php echo e($errors->has('shortcode') ? ' has-error' : ''); ?>">
         <?php echo Form::label('shortcode', 'Shortcode:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
          <?php echo Form::text('shortcode',$shortcode, array('class' => 'form-control', 'placeholder'=>'Enter shortcode', 
          ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

          <?php if($errors->has('shortcode')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('shortcode')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
      </div>



      <!-- Button (Double) -->
      <div class="form-group">
       <label class="col-md-4 control-label" for="save"></label>
       <div class="col-md-8">
         <input type="submit" id="save"  class="btn btn-success">
         <input type="reset" id="reset"  class="btn btn-warning">
         <a class="btn btn-danger" href="<?php echo e(url('Assembly')); ?>" role="button">Cancel</a>
       </div>
       
     </div>

   </fieldset>

   <?php echo Form::close(); ?>

   

 </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>