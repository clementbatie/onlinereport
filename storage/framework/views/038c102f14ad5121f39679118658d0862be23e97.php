

<?php $__env->startSection('content'); ?>
<br><br><br><br><br>
<div class="container spark-screen">
    <div class="row">

		

        <div class="col-md-10 col-md-offset-1">
        	


	        <h1>Year/Term Setup </h1>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				
					  <div class="row">

					<div class="col-md-5">
                    <a class="btn btn-primary" href="<?php echo e(route('yeartermsetup.create')); ?>" >Add new data</a>
					<a class="btn btn-default" href="<?php echo e(route('yeartermsetup.index')); ?>" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
                     </div>
                    <div class="col-md-6">
			        	<?php echo Form::open(array('method' => 'GET','route' => 'yeartermsetup.search')); ?>  
					            <?php echo Form::label('searchString', 'Quick Search:'); ?>

					            <?php echo Form::text('searchString'); ?>

					     	
								<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

					 
					    <?php echo Form::close(); ?>

	                </div>
					</div><br>
			
			

			<?php if(count($rows)): ?>


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
							<!-- 	<th>#</th> -->
								<th>Year</th>					
								<th>Term</th>

							</tr>
							<?php foreach($rows as $row): ?>
							<tr>

                             <td><?php echo e(isset($row->Year) ? $row->Year : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->TermName) ? $row->TermName : 'DEFAULT'); ?></td>


								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('yeartermsetup.show',[$row->Year_Term_SetipID])); ?>">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('yeartermsetupController@edit', array($row->Year_Term_SetipID))); ?>"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('yeartermsetup.destroy',$row->Year_Term_SetipID)))); ?>  	                  
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