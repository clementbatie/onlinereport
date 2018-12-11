<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">

		<?php echo Form::open(array('method' => 'GET','route' => 'studentbehaviour.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?>

	
	
	

        <div class="col-md-12 col-md-offset-0">
	        <h1>Student Behaviour</h1>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				<p>
					<a class="btn btn-primary" href="<?php echo e(route('studentbehaviour.create')); ?>" >Add new data</a>
				<a class="btn btn-default" href="<?php echo e(route('studentbehaviour.index')); ?>" role="button">Show All</a>
					
				</p>
			

			<?php if(count($rows)): ?>


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<!-- <th>SchoolIfoID</th> -->
								<th>Student</th>					
								<th>Year</th>
								<th>term</th>
								<th>ClassID</th>
								<th>Attendance Expected</th>

								<th>Actual Attendance</th>					
								<th>Promoted To</th>
								<th>Student Character</th>
								<th>Interest</th>
								<th>Class Teacher Remarks</th>
								<th>Head Teacher Remarks</th>
								<th>School Code</th>

							</tr>
							<?php foreach($rows as $row): ?>
							<tr>

                                <td><?php echo e(isset($row->StudentName) ? $row->StudentName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->Year) ? $row->Year : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->TermName) ? $row->TermName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->ClassName) ? $row->ClassName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->AttendanceExpected) ? $row->AttendanceExpected : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->ActualAttendance) ? $row->ActualAttendance : 'DEFAULT'); ?></td>

                                <td><?php echo e(isset($row->PromotedTo) ? $row->PromotedTo : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->CharacterOfStu) ? $row->CharacterOfStu : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->Interest) ? $row->Interest : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->ClassTeacherRemarks) ? $row->ClassTeacherRemarks : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->HeadTeacherRemarks) ? $row->HeadTeacherRemarks : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>
                                
								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('studentbehaviour.show',[$row->StudentPerformanceID])); ?>">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('studentbehaviourController@edit', array($row->StudentPerformanceID))); ?>"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('studentbehaviour.destroy',$row->StudentPerformanceID)))); ?>  	                  
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