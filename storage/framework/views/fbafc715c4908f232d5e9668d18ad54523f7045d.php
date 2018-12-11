<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <?php $rwstate = "true"; ?>
      <?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo Form::open(array('route' => 'smsbalance', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')); ?>

      <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       <?php echo e(csrf_field()); ?>


       <fieldset>


        <!-- include the partial    -->
        <!-- form details -->


        <!-- Form Name -->
        <legend>SMS Credits Balance</legend>

        <!-- Text input-->
        

        <div class="form-group<?php echo e($errors->has('smsbalance') ? ' has-error' : ''); ?>">
         <?php echo Form::label('smsbalance', 'SMS Balance:' , array('class'=>'col-md-4 control-label'  )); ?>

         <div class="col-md-6">
          <?php echo Form::text('smsbalance',$balance, array('class' => 'form-control', 'placeholder'=>'Enter smsbalance', 
          ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

          <?php if($errors->has('smsbalance')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('smsbalance')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
      </div>



      <!-- Button (Double) -->

   </fieldset>

   <?php echo Form::close(); ?>

   

 </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>