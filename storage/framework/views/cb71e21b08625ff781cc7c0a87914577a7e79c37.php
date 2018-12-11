

<?php $__env->startSection('content'); ?><br>
<div class="container spark-screen">
    <div class="row">
<?php /* 
		<?php echo Form::open(array('method' => 'GET','route' => 'yeartermsetup.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?> */ ?>
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        

	        <div>
	       		<strong style="padding-left: 200px; font-size: 50px; position: fixed;" class="blinking">Academic Year and Term</strong>
	       	</div><br><br><br>
	       	<legend></legend>
	       	<br>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				<?php /* <p>
					<a class="btn btn-primary" href="<?php echo e(route('yeartermsetup.create')); ?>" >Add new data</a>
					<a class="btn btn-default" href="<?php echo e(route('yeartermsetup.index')); ?>" role="button">Show All</a>
					<a class="btn btn-info" href="<?php echo e(route('yeartermsetup.transfer')); ?>" role="button">Transfer to History</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					
				</p> */ ?>

				<div class="row">

					<div class="col-md-8">
						<?php /* <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> */ ?>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('yeartermsetup.create')); ?>" >Add New YearTerm</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('yeartermsetup.index')); ?>" role="button">Refresh</a>
						<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					</div>
<?php /* 
					<div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'classes.search')); ?>  
			           <?php echo e(--  <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>

			          <?php /*   <?php echo Form::text('searchString', null, array('placeholder'=>'Search By Class Name')); ?>

			     	 
						<?php echo Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>  */ ?>

					<div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'yeartermsetup.search')); ?>  
			            <?php /*  <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>

			            <?php echo Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Search By School Name')); ?>


			            <?php /* {{ Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;"))); ?> */ ?>
			     	 
						<?php echo Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>
				</div><br>
			

			<?php if(count($rows)): ?>


				
	            <div class="panel panel-primary">
	                <?php /* <div class="panel-heading">/div> */ ?>
	                 <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of  Year and Term</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
							<!-- 	<th>#</th> -->
								<th>Year</th>					
								<th>Term</th>
								<th>School Name</th>
                                <th>School Code</th>
							</tr>
							<?php foreach($rows as $row): ?>
							<tr>

                             <td><?php echo e(isset($row->Year) ? $row->Year : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->TermName) ? $row->TermName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->Name) ? $row->Name : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>

								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('yeartermsetup.show',[$row->Year_Term_SetipID])); ?>">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('yeartermsetupController@edit', array($row->Year_Term_SetipID))); ?>"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                   <td>
			                        
			            
 <?php echo e(Form::open(array('method'=> 'delete', 'route' => array('yeartermsetup.destroy',$row->Year_Term_SetipID)))); ?>  	                  
<?php echo e(Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))); ?>

			                        <?php echo e(Form::close()); ?>   
			            
			                    </td>    
							</tr>
							<?php endforeach; ?>
					  </table>
                          <?php echo $rows->links(); ?>

	                </div>
	            </div>
		            

            <?php else: ?>
				There are no records
			<?php endif; ?>
        </div>
    </div>
</div>
<script>
    function blinker(){
        $('.blinking').fadeOut(200);
        $('.blinking').fadeIn(200);
    }
    setInterval(blinker, 1000);
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>