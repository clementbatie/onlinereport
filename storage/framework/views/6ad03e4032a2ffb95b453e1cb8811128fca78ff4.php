

<?php $__env->startSection('content'); ?><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

    <?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::open(array('route' => 'Usermanagement3.create3Cuser', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')); ?>

    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       <?php echo e(csrf_field()); ?>


       <fieldset>


<!-- include the partial    -->
       <?php echo $__env->make('SuperUser/_crud', array('rwstate' => 'false') , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>




       <!-- Button (Double) -->
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
         <input type="button" id="add3Cuser"  value="Add"  class="btn btn-primary">
           <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <input type="submit" id="save" value="Save" class="btn btn-success">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="<?php echo e(url('Usermanagement3')); ?>" role="button">Return</a>
         </div>
         
       </div>

       </fieldset>

    <?php echo Form::close(); ?>

 

    </div>
    </div>
<?php /* </div>
<div class="container col-md-6 col-md-offset-3">
  <div class="panel panel-primary">
    <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">Added Data</div>
     
    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>Admin Name</th>
            <th>Email</th>
            {{-- <th>Phone Number</th> */ ?>
           <?php /* <th>School Name</th>
           <th>User Level</th> */ ?>
        <?php /*   </tr>
        </thead>
               
      </tbody>
    </table>
  </div>
    </div>
  </div>  */ ?>
  <script>
  var data = [];
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>