

<?php $__env->startSection('content'); ?><br><br><br><br>
<div class="container spark-screen">
    <div class="row">

		<?php echo Form::open(array('method' => 'GET','route' => 'schoolinfo.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?>

	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1>School Information</h1>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				<p>
					<a class="btn btn-primary" href="<?php echo e(route('schoolinfo.create')); ?>" >Add new data</a>
					<a class="btn btn-default" href="<?php echo e(route('schoolinfo.index')); ?>" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					
				</p>
			

			<?php if(count($rows)): ?>


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<!-- <th>SchoolIfoID</th> -->
								<th>Name of School</th>					
								<th>Address</th>
								<th>Contact Nos</th>
								<th>School Code</th>
								<th>Report Name</th>

							</tr>
							<?php foreach($rows as $row): ?>
							<tr>
                               <!--  <td><?php echo e(isset($row->SchoolIfoID) ? $row->SchoolIfoID : 'DEFAULT'); ?></td> -->
                                <td><?php echo e(isset($row->Name) ? $row->Name : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->Address) ? $row->Address : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->ContactNos) ? $row->ContactNos : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->reportname) ? $row->reportname : 'DEFAULT'); ?></td>
                                
								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('schoolinfo.show',[$row->SchoolIfoID])); ?>">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('SchoolinfoController@edit', array($row->SchoolIfoID))); ?>"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('schoolinfo.destroy',$row->SchoolIfoID)))); ?>  	                  
			                        <?php echo e(Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>