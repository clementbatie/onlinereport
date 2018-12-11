


<?php $__env->startSection('content'); ?><br>

<div class="container spark-screen">
    <div class="row">

		<?php /* <?php echo Form::open(array('method' => 'GET','route' => 'student.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?> */ ?>
	
	
	

        <div class="col-md-10 col-md-offset-1">
	       
	         <div>
	       		<strong style="padding-left: 250px; font-size: 50px; position: fixed;" class="blinking">Class Information</strong>
	       	</div><br><br><br>
	       	<legend></legend>
	       	<br><br>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>

				<div class="row">

					<div class="col-md-8">
						<?php /* <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> */ ?>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('classinfo.create')); ?>" >Add New Class Info</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('classinfo.index')); ?>" role="button">Refresh</a>
						<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					</div>

					<?php /* <div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'classinfo.search')); ?>  
			            <?php echo e(-- <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>
			           <?php /*  <?php echo Form::text('searchString', null, array('placeholder'=>'   Search By Class Name')); ?>

			     	 
						<?php echo Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>  */ ?>

					<div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'classinfo.search')); ?>  
			            <?php /*  <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>

			            <?php echo Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Search By Class Name')); ?>


			            <?php /* {{ Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;"))); ?> */ ?>
			     	 
						<?php echo Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>
				</div><br>
			

			<?php if(count($rows)): ?>

<form action="<?php echo e(route('categories9.deleteMultiple')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Class Information</div>

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
							 	<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td> 
								<th>Class</th>					
								<th>OnRoll</th>
								<th>NextTermBegins</th>
								<th>SchoolCloses</th>
								<th>Year</th>
								<th>Term</th>
                                <?php /* <th>SchoolCode</th> */ ?>
								<?php /* <th>School Code</th> */ ?>
							</tr>
			</tr>
	</thead>
							
							<?php foreach($rows as $row): ?>
							<tr>
								
                        <td><input type="checkbox" name="categories9[]" class="checkboxes" value="<?php echo e($row->ClassInfoID); ?>" /></td>

                                <td><?php echo e(isset($row->ClassName) ? $row->ClassName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->OnRoll) ? $row->OnRoll : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->NextTermBegins) ? $row->NextTermBegins : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->SchoolCloses) ? $row->SchoolCloses : 'DEFAULT'); ?></td>
                                
                                <td><?php echo e(isset($row->Year) ? $row->Year : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->TermName) ? $row->TermName : 'DEFAULT'); ?></td>
                                <?php /* <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td> */ ?>
                             <?php /* <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td> */ ?>
                              <?php /* <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="<?php echo e($row->ImageType); ?>" frameborder="0" allowfullscreen></video>

          </div>  */ ?>


								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('classinfo.show',[$row->ClassInfoID])); ?>">Show
		                                                   <?php /* <i class="glyphicon glyphicon-eye-open"> */ ?></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('classinfoController@edit', array($row->ClassInfoID))); ?>"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('classinfo.destroy',$row->ClassInfoID)))); ?>  	                  
			                        <?php echo e(Form::button('<i>Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure you want to delete this item?"))
			                        {
			                        return false;};'    ))); ?>

			                        <?php echo e(Form::close()); ?>   
			            
			                    </td> 
			                     
							</tr>
							<?php endforeach; ?>
                        </form>

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