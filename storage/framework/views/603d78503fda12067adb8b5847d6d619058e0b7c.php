

<?php $__env->startSection('content'); ?>
<br><br><br><br>

<div class="container spark-screen">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
        	<div class="col-md-10 col-md-offset-4">
	        <h1>Subjects</h1><br>
	    </div>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>

				<div class="row">

					<div class="col-md-6">
						<?php /* <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> */ ?>
						<a style="background-color:#ffffff; color:#000000;" class="btn btn-primary" href="<?php echo e(route('subject.create')); ?>" >Add new data</a>
						<a style="background-color:#ffffff; color:#000000;" class="btn btn-primary" href="<?php echo e(route('subject.index')); ?>" role="button">Show All</a>
						<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					</div>

					<div class="col-md-6">
						<?php echo Form::open(array('method' => 'GET','route' => 'subject.search')); ?>  
			            <?php echo Form::label('searchString', 'Quick Search:'); ?>

			            <?php echo Form::text('searchString'); ?>

			     	 
						<?php echo Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#ffffff; color:#000000;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>
				</div><br>
				
			

			<?php if(count($rows)): ?>


				
	            <div class="panel panel-primary">
	                <div style="background-color:#ffffff; color:#000000; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of  Students</div>

	                <div colspan="7" class="panel-body">

	                  <table class="table table-striped">
							<tr>
							<!-- 	<th>#</th> -->
								<th>Subject</th>					
								<th>Class</th>
								<th>School Code</th>
								

							</tr>
							<?php foreach($rows as $row): ?>
							<tr>

                             <td><?php echo e(isset($row->SubjectName) ? $row->SubjectName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->ClassName) ? $row->ClassName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>
                                


								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('subject.show',[$row->SubjectID])); ?>">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('subjectsController@edit', array($row->SubjectID))); ?>"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('subject.destroy',$row->SubjectID)))); ?>  	                  
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