

<?php $__env->startSection('content'); ?><br><br><br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

    <?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::open(array('route' => 'usermanagement2.createuser', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')); ?>

    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       <?php echo e(csrf_field()); ?>


       <fieldset>


<!-- include the partial    -->
       <?php echo $__env->make('CreateUser/_crud', array('rwstate' => 'false') , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>




       <!-- Button (Double) -->
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
         <input type="button" id="adduser"  value="Add"  class="btn btn-primary">
           <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <input type="submit" id="save" value="Save" class="btn btn-success createuser">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="<?php echo e(url('usermanagement2')); ?>" role="button">Return</a>
         </div>
         
       </div>

       </fieldset>

    <?php echo Form::close(); ?>

 

    </div>
    </div>
</div>
<div class="container col-md-6 col-md-offset-3">
  <div class="panel panel-primary">
      <div class="panel panel-heading "><h4> Added Data</h4></div>
    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>User Name</th>
            <th>Email</th>
            <th>User Level</th>
            <th>Children Name</th>
            
          </tr>
        </thead>
               
      </tbody>
    </table>
  </div>
    </div>
  </div>
  <script>
  var data = [];
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>