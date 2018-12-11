

<?php $__env->startSection('content'); ?><br><br><br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
         <fieldset>
               <legend>Change Password</legend>

               
                   <?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php echo Html::ul($errors->all(), array('class'=>'errors')); ?>

<?php echo Form::open(array('method'=>'post','route' => 'usermangement.resetpassword','class'=>'form-horizontal','role'=>'form', 'files'=>'true')); ?>

<?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
                        <?php echo csrf_field(); ?>


                        

                        <div class="form-group<?php echo e($errors->has('oldpasssword') ? ' has-error' : ''); ?>">
                            <?php echo Form::label('oldpasssword','Current Password:', array('class'=>'col-md-4 control-label')); ?>


                            <div class="col-md-6">
                                <?php echo Form::password('oldpassword',array('class'=>'form-control')); ?>


                                <?php if($errors->has('oldpassword')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('oldpassword')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <?php echo Form::label('password','Password:', array('class'=>'col-md-4 control-label')); ?>


                            <div class="col-md-6">
                                <?php echo Form::password('password',array('class'=>'form-control')); ?>


                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                             <?php echo Form::label('ppassword_confirmation','Confirm Password:', array('class'=>'col-md-4 control-label')); ?>


                            <div class="col-md-6">
                                <?php echo Form::password('password_confirmation',array('class'=>'form-control')); ?>


                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           <input type="submit" id="save"  class="btn btn-success" value="Submit">
           <input type="reset" id="reset"  class="btn btn-warning" >
           <a class="btn btn-danger" href="<?php echo e(url('/home')); ?>" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>
                   <?php echo Form::open(); ?>

                </div>
            </div>
        </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>