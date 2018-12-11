

<?php $__env->startSection('content'); ?><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		<?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::open(array('route' => 'term.store', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')); ?>

    
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       <?php echo e(csrf_field()); ?>


       <fieldset>


<!-- include the partial    -->
       <?php echo $__env->make('Term/_crud', array('rwstate' => 'false') , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

       <!-- Button (Double) -->
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
         <input type="button" id="addterm"  value="Add"  class="btn-primary inputForm" style="color:#fff; font-size: 20px; width: 70px;">

           <input type="button" value="Delete Row"  class="btn-info inputForm delete-row" style="color:#fff; font-size: 20px; width: 120px;">

           <input type="submit" id="save" value="Save" class="btn-success inputForm createterm" style="color:#fff; font-size: 20px; width: 90px;">
            
           <input type="reset" id="reset"  class="btn-warning inputForm" style="color:#fff; font-size: 20px; width: 90px;">

           <a class="btn btn-danger inputForm" href="<?php echo e(url('term')); ?>" style="color:#fff; font-size: 20px; width:90px; padding-top: 1px; margin-bottom: 7px;">Return</a>

            

          <?php /* <div class="col-md-4">
            <?php echo Form::open(array('method' => 'GET','url' => 'term.index')); ?>  
             
            <?php echo Form::submit('Show All Records', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:20px;")); ?>

       
                  <?php echo Form::close(); ?>

          </div> */ ?>

         </div>
         
       </div>

       </fieldset>

    <?php echo Form::close(); ?>

 

    </div>
    </div>
</div>
<div class="container col-md-6 col-md-offset-3">
  <div class="panel panel-primary">

      <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">Added Data</div>
    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>Term Name</th>
             
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