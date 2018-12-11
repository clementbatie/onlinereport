

<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">

		<?php echo Form::open(array('method' => 'GET','route' => 'student.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?>

	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1>Students </h1>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				<p>
					<a class="btn btn-primary" href="<?php echo e(route('student.create')); ?>" >Add new data</a>
					<a class="btn btn-default" href="<?php echo e(route('student.index')); ?>" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					
				</p>
			

			<?php if(count($rows)): ?>

<form action="<?php echo e(route('categories.destroy')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
	                  	<?php /* <tr class="info"> */ ?>
                   <p>
                              <?php /* <td style="font-size: 30px;: ;"> <input type="checkbox" id="selectAll" /> Select all</td> */ ?>
		                     
		                     <?php /*  </tr> */ ?>
		                       <div class="col-sm-10"> 
		                     <td> <button class="btn btn-danger">Delete Checked</button></td>
		                   </div> 
		             </p>
							<tr>
							 	<td> <input type="checkbox" id="selectAll" /> Select all</td> 
								<th>Student Name</th>					
								<th>Parent Name</th>
								<th>Class Name</th>
								<th>School Code</th>
							</tr>
			</tr>
	</thead>
							
							<?php foreach($rows as $row): ?>
							<tr>
								<tr class="odd gradeX">
                        <td><input type="checkbox" name="categories[]" class="checkboxes" value="<?php echo e($row->id); ?>" /></td>

                             <td><?php echo e(isset($row->StudentName) ? $row->StudentName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->Name) ? $row->Name : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->ClassName) ? $row->ClassName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>
                              <?php /* <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="<?php echo e($row->ImageType); ?>" frameborder="0" allowfullscreen></video>

          </div>  */ ?>


								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('student.show',[$row->id])); ?>">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('StudentController@edit', array($row->id))); ?>"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('student.destroy',$row->id)))); ?>  	                  
			                        <?php echo e(Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))); ?>

			                        <?php echo e(Form::close()); ?>   
			            
			                    </td> 
			                    </tr>   
							</tr>
							<?php endforeach; ?>

							
                </form>
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