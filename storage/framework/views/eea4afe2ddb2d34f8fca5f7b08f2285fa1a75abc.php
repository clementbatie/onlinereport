 

 <?php $__env->startSection('content'); ?>
  <br><br><br> <br><br><br> <br><br><br>

<TITLE>Show All Pics</TITLE>
    
    	<?php foreach($user as $users): ?>
          

         <?php /*  <div class="media">
          	<div class="media-body">
          <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="<?php echo e($users->ImageType); ?>" frameborder="0" allowfullscreen></video>
 */ ?>

<?php /* <div class="col-md-offset-4" style="margin-bottom: 15px">
  <img height="200px" width="200px" src="uploads/<?php echo e($users->ImageType); ?>"/>
</div> */ ?>

<div class="col-md-offset-4" style="margin-bottom: 15px">
  <img id="blah" alt="" height="200px" width="200px" src="uploads/<?php echo e($users->ImageType); ?>"/>
</div>
          <?php /* </div> */ ?>
</iframe>
</div>
</div>
<br>

<?php /* <video height="300px" controls>
    <source src="<?php echo e(asset('assetlibr/public/uploads' . $users->Type . '/' . $users->Type)); ?>" type="video/mp4">
    <source src="<?php echo e(asset('assetlibr/public' . $upload->filepath . '/' . $upload->filename)); ?>" type="video/ogg">
    Your browser does not support the video tag.
</video> */ ?>
</div>
 
        <?php endforeach; ?> 


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>