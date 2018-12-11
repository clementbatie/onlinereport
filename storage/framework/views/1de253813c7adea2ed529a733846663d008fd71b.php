



<?php $__env->startSection('content'); ?>
<br>
<div class="container" >
    <div class="row">
        <div style="margin-left: 180px;" class="col-md-8 col-md-offset-1">
            <div class="panel panel-primary">
               
              
                <div id="app-layout2" style="height: 600px; width: 748px;" >
                    <?php /* <div class="col-md-1" style="height: 10px">
                       <div class="panel-body">
                            <img class="imghome" style="height: 500px; width: 700px; padding-right: 60px;" src="<?php echo e(asset('uploads/img2.jpg')); ?>" alt="image">
                      </div>
                 </div> */ ?>

                <?php /* <div class="col-md-10" style="padding-right: -90px"> */ ?>
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo csrf_field(); ?><br><br><br><br>

                    <div style="background-color:#00663d; padding-top: 8px; padding-bottom: 10px; margin-right: 40px; margin-left: 40px;">
                      <div style=" color: #fff;font-size: 20px;font-weight: bold; margin-left: 280px; ">Account Login</div>
                    </div><br><br><br>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label"></label>

                            <div class="col-md-4">
                                <input type="email" class="form-control" placeholder="example@abc.com" name="email" value="<?php echo e(old('email')); ?>">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label"></label>

                            <div class="col-md-4">
                                <input type="password" placeholder="password"  class="form-control" name="password">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" >
                                <button type="submit" style="background-color:#00663d; margin-left: 40px;">
                               
                                    <div style="font-size: 20px; color: #fff; padding-right: 30px; padding-left: 30px; text-align: center;"><i class="fa fa-btn fa-sign-in"></i>Sign In</div>
                                
                                </button><br><br>

                                <a class="panel-heading text-center" href="<?php echo e(url('/password/reset')); ?>">Forgot Your Password?</a>  
                            </div>
                        </div>

                        <?php /* <div class="panel-body">
                            <img class="imghome" src="<?php echo e(asset('uploads/p7.jpg')); ?>" alt="image">
                       </div> */ ?>
                    </form>
                
            </div>
            
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>