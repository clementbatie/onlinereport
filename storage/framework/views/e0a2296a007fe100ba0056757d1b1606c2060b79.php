

<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<?php if(Session::has('message')): ?>
        <div class="alert <?php echo e(Session::get('alert-class')); ?>">
            <h2><?php echo e(Session::get('message')); ?></h2>
        </div>
    <?php endif; ?>
    <div class="col-md-12">
       <?php if(count($rows) > 0): ?>
     <div class="panel panel-primary">
                <div class="panel-heading">Members  <span class="notify blink">new</span></div>

                <div class="panel-body">
                <div class="table-responsive">

                  <table class="table table-striped">
          <tr>
            <th>Name</th><th>Phone Number</th><th>Date Sent</th><th>Status</th><th></th>
          </tr>
          <?php foreach($rows as $row): ?>
          <tr>
            <td><?php echo e(isset($row->name) ? $row->name : "Default"); ?>  </td>
                        <td><?php echo e(isset($row->contact) ? $row->contact : "Default"); ?>  </td>           
            <td><?php echo e(isset($row->created_at) ? $row->created_at : "Default"); ?>  </td>
                        
                        <td>
                        <?php if($row->confirmed !=0): ?>  
                        <div class="bg-success text-success">Approved</div>
                        <?php else: ?>
                        <div class="bg-warning text-warning">Not Received</div>
                        <?php endif; ?>
                        </td>
            <td><a href="<?php echo e(route('Members.approvememberssave',[$row->id])); ?>" class="btn btn-primary" role="button"  data-toggle="tooltip" title="Receive"><i class="glyphicon glyphicon-ok"></i></a>  </td>
          </tr>
          <?php endforeach; ?>
          </table>  
          </div>
                </div>
            </div>
            <?php endif; ?>
    </div><br><br>
     <div class="col-md-12" style="width: 100px; height: 40px;">
       <?php $background = "uploads/"; $background .= $backgroundimage ? $backgroundimage->Logo : "p00.jpg" ; ?>
        
      <img class="col-md-12" style="width: 600px; height: 600px; margin-left: 265px" class="imghome" src="<?php echo e(asset($background)); ?>" alt="homee image">
      </div>


  </div>
</div>
<style>
  .imghome{
    max-height: 100%;
    max-width: 100%;
    display: block;
    margin: auto;
  }

</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>