<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">

		<?php echo Form::open(array('method' => 'GET','route' => 'parents.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?>

	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1>Parents </h1>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				<p>
					<a class="btn btn-primary" href="<?php echo e(route('parents.create')); ?>" >Add new data</a>
					<a class="btn btn-default" href="<?php echo e(route('parents.index')); ?>" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					
				</p>
			

			<?php if(count($rows)): ?>


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  parents</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<th>Parent name</th>
								<th>Phone</th>					
								<th></th>
							</tr>
							<?php foreach($rows as $row): ?>
							<tr>
                                <td><?php echo e(isset($row->Name) ? $row->Name : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->PhoneNo) ? $row->PhoneNo : 'DEFAULT'); ?></td>
                        
                 
                                
                               
								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('parents.show',[$row->SetupParentID])); ?>">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('ParentController@edit', array($row->SetupParentID))); ?>"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('parents.destroy', $row->date,$row->SetupParentID)))); ?>  	                  
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
		            <?php echo $rows->links(); ?>


            <?php else: ?>
				There are no records
			<?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>