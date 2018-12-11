

<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">

		<?php /* <?php echo Form::open(array('method' => 'GET','route' => 'schoolinfo.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?> */ ?>
	
	
	

        <div class="col-md-10 col-md-offset-1">
	       

	         <div>
	       		<strong style="padding-left: 240px; font-size: 50px; position: fixed;" class="blinking">School Credentials</strong>
	       	</div><br><br><br>
	       	<legend></legend>
	       	<br>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				<div class="row">

					<div class="col-md-8">
						<?php /* <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> */ ?>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('schoolinfo.create')); ?>" >Add New School Detail</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('schoolinfo.index')); ?>" role="button">Refresh</a>
						<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					</div>

					<?php /* <div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'schoolinfo.search')); ?>  
			            <?php echo e(-- <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString', null, array('placeholder'=>'   Search By School Name')); ?>

			     	 
						<?php echo Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>  */ ?>


					<div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'schoolinfo.search')); ?>  
			            <?php /*  <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>

			            <?php echo Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Search By School Name')); ?>


			            <?php /* {{ Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;"))); ?> */ ?>
			     	 
						<?php echo Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>

				</div><br>
			

			<?php if(count($rows)): ?>

<form action="<?php echo e(route('categories12.deleteMultiple')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

	 <thead>
	 	<tr>
				
	            <div class="panel panel-primary">
	                <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of School Detail</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
	                  	<p>
		                       <div class="col-sm-10"> 
		                          <td> <button class="btn btn-danger">Delete Checked</button></td>
		                       </div> 
		                </p>
							<tr>
								<!-- <th>SchoolIfoID</th> -->
								<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td> 
								<th>Name of School</th>					
								<th>Address</th>
								<th>Contact Nos</th>
								<th>School Code</th>
								<th>Report Name</th>

							</tr>
		</tr>
							<?php foreach($rows as $row): ?>
							<tr>
                               <!--  <td><?php echo e(isset($row->SchoolIfoID) ? $row->SchoolIfoID : 'DEFAULT'); ?></td> -->
                               <td><input type="checkbox" name="categories12[]" class="checkboxes" value="<?php echo e($row->SchoolIfoID); ?>" /></td>
                                <td><?php echo e(isset($row->Name) ? $row->Name : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->Address) ? $row->Address : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->ContactNos) ? $row->ContactNos : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->reportname) ? $row->reportname : 'DEFAULT'); ?></td>
                                
								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('schoolinfo.show',[$row->SchoolIfoID])); ?>">Show
		                                                   <?php /* <i class="glyphicon glyphicon-eye-open"> */ ?></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('SchoolinfoController@edit', array($row->SchoolIfoID))); ?>"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('schoolinfo.destroy',$row->SchoolIfoID)))); ?>  	                  
			                        <?php echo e(Form::button('<i>Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))); ?>

			                        <?php echo e(Form::close()); ?>   
			            
			                    </td>    
							</tr>
							<?php endforeach; ?>
					  </table>
                          
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