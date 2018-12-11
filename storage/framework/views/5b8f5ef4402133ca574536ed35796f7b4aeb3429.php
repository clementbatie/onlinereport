<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">

		<?php echo Form::open(array('method' => 'GET','route' => 'terminalscore.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?>

	
	
	

        <div class="col-md-11 col-md-offset-1">
	        <h1>Terminal Scores </h1>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				<p>
					<a class="btn btn-primary" href="<?php echo e(route('terminalscore.create')); ?>" >Add new data</a>
					<a class="btn btn-default" href="<?php echo e(route('terminalscore.index')); ?>" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					
				</p>
			

			<?php if(count($rows)): ?>


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<!-- <th>SchoolIfoID</th> -->
								<th>School Code</th>
									<th>Student Name</th>
								<th>Subject</th>					
								<th>Class</th>
								<th>Year</th>
								<th>Term</th>
								<th>Class Score</th>
								<th>Exams Score</th>
								<th>Total Score</th>
								<th>Position</th>
								<th>Remarks</th>
						

							</tr>
							<?php foreach($rows as $row): ?>

							<tr>
                               <!--  <td><?php echo e(isset($row->SchoolIfoID) ? $row->SchoolIfoID : 'DEFAULT'); ?></td> -->
                                <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->StudentName) ? $row->StudentName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->SubjectName) ? $row->SubjectName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->ClassName) ? $row->ClassName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->Year) ? $row->Year : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->Term) ? $row->Term : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->classscore) ? $row->classscore : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->examscore) ? $row->examscore : 'DEFAULT'); ?></td>
                                <td><?php echo e(($row->classscore)+($row->examscore)); ?></td>    
                                <td><?php echo e(isset($row->position) ? $row->position : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->remarks) ? $row->remarks : 'DEFAULT'); ?></td>

		<td><a class="btn btn-xs btn-success" href="<?php echo e(route('terminalscore.show',[$row->TerminanlScoreID])); ?>">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			         <a href="<?php echo e(action('terminalscoreController@edit', array($row->TerminanlScoreID))); ?>"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    	=> 'delete', 'route' => array('terminalscore.destroy',$row->TerminanlScoreID)))); ?>  	                  
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>