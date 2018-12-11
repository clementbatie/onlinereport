<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		<?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
     <?php echo e(Form::model($rows->toArray(), array('method' => 'PATCH', 'route' =>array('term.update', $rows->TermID), 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true'  ))); ?>

    
         <?php echo e(csrf_field()); ?>


       <fieldset>




       <!-- include the partial    -->
       <?php echo $__env->make('Term/_crud', array('rwstate' => 'false    ') , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


       
            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           <input type="submit" id="save" value="Update" class="btn btn-success">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="<?php echo e(url('/term')); ?>" role="button">Return</a>
         </div>
         
       </div>

       </fieldset>

    <?php echo Form::close(); ?>

 

    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>