<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		<?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

     <?php echo e(Form::model($rows1->toArray(), array('method' => 'PATCH', 'route' =>array('teacher.update', $rows1->SetupTeacherID), 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true'  ))); ?>

    
         <?php echo e(csrf_field()); ?>


       <fieldset>




       <!-- include the partial    -->
       <?php echo $__env->make('teacher/_crud', array('rwstate' => 'true') , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           
           <a class="btn btn-info" href="<?php echo e(action('TeachersController@edit', array($rows1->SetupTeacherID))); ?>" role="button">Edit</a>
           <a class="btn btn-danger" href="<?php echo e(url('/teacher')); ?>" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    <?php echo Form::close(); ?>

 

    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>