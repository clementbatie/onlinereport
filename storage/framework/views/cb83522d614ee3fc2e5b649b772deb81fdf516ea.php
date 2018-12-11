

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
    </div>
     <div class="col-md-12 ">
       <?php $imgpath = "uploads/"; $imgpath .= $bannerimg ? $bannerimg->link : "p7.jpg" ; ?>
        
      <img class="imghome" src="<?php echo e(asset($imgpath)); ?>" alt="homee image">
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
<!-- <div class="container spark-screen cellhome">
    <div class="row ">
      <div class="col-md-12 col-md-offset-3">
        <span><p> <img src="img/home-banner.png" alt=""></p></span>
       
      </div>
        <div class="col-md-12 col-md-offset-3">
          
           <div class="col-md-6 text-left cellhome">
          <p>19 Listen now to me and I will give you some advice, and may God be with you. You must be the people’s representative before God and bring their disputes to him. 20 Teach them his decrees and instructions, and show them the way they are to live and how they are to behave. 21 But select capable men from all the people—men who fear God, trustworthy men who hate dishonest gain—and appoint them as officials over thousands, hundreds, fifties and tens. 22 Have them serve as judges for the people at all times, but have them bring every difficult case to you; the simple cases they can decide themselves. That will make your load lighter, because they will share it with you. 23 If you do this and God so commands, you will be able to stand the strain, and all these people will go home satisfied.” <strong>Exodus 18:19-23</strong></p><br>
          <h4><u>Jetro Pricinple for Leaders</u></h4>
          <ol>
            <li>Effective leaders know their limitations. </li>
            <li>Effective leaders stand before God for the people</li>
            <li>Effective leaders teach. </li>
            <li>Effective leaders create teams. </li>
            <li>Effective leaders delegate. </li>
            <li>Effective leaders create a system of accountability. </li>
            <li>Effective leaders encourage and empower excellence. </li>
          </ol>
          <br>
          <h4><u>Riding on the Jetro principle to facilitate the fulfillment of the Great Commission</u></h4>
          <ol>
            <li>Through the cells the gospel is made readily available at the doorstep of people</li><br>
            <li>A member becomes a know identity and not just a statiscal member or figure especially as the church grows</li><br>
            <li>The burden of the pastor in carrying out the ministry of the people is shared.</li>
          </ol>
           </div>
          
        </div>
    </div>
</div>
<style type="text/css">
    .cellhome{
     // border: 1px solid black;
    }
   
  
</style> -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>