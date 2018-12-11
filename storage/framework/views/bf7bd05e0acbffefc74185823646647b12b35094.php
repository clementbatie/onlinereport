


<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading text-center"><h4>CELL LEADER'S COMPANION</h4></div>

                <div class="panel-body">
                    <img class="imghome" src="<?php echo e(asset('uploads/p7.jpg')); ?>" alt="image">
                </div>
            </div>
        </div>
     
    </div>
</div>

<style>
  .imghome{
    max-height: 100%;
    max-width: 100%;
    display: block;
    margin: auto;
    position: relative;
top: -15px;
   // margin: 0px;
   height: 100vh
  }
.panel-body{
    margin: 0px;
    padding: 0px;
    
}
.panel{
    margin: 0px;
    //border: none;
}
.panel-heading{
    margin: 0px;
}
h4{
    font-size: 28px
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>