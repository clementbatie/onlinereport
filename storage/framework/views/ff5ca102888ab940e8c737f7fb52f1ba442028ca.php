

<?php $__env->startSection('content'); ?><br><br><br><br>
<div class="container spark-screen">
    <div class="row">

		<?php echo Form::open(array('method' => 'GET','route' => 'Usermanagement3.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?>

	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1>School Users</h1>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>

			<p>
					<a class="btn btn-primary" href="<?php echo e(route('Usermanagement3.create')); ?>" >Add new data</a>
					<a class="btn btn-default" href="<?php echo e(route('Usermanagement3.create')); ?>" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					
				</p>
				
			

			<?php if($rows->count()): ?>


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Meeting</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<th>Name</th>
								<!-- <th>Email</th> -->
								<th>SchoolCode</th>
							</tr>
							<?php foreach($rows as $row): ?>
							<tr>

								<td><?php echo e(isset($row->name) ? $row->name : 'DEFAULT'); ?></td>
                               <!--  <td><?php echo e(isset($row->email) ? $row->email : 'DEFAULT'); ?></td> -->
                                <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>
                               
                               <!--  <td><?php echo e(isset($row->date) ? $row->date : 'DEFAULT'); ?></td> -->
								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('Usermanagement3.show', $row->id)); ?>">
		                         <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                        <a href="<?php echo e(action('Usermanagement3Controller@edit', array($row->id))); ?>"
			                            class="btn btn-info btn-xs">
			                            <i class="glyphicon glyphicon-pencil"></i>
			                        </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'DELETE', 'route' => array('Usermanagement3.destroy', $row->id)))); ?>  	                  
			                        <?php echo e(Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are You Sure You Want To Delete This Item?"))
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>