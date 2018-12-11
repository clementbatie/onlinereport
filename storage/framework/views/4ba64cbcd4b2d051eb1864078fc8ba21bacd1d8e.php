

<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">

		<?php /* <?php echo Form::open(array('method' => 'GET','route' => 'student.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?> */ ?>
	
	<?php /* <div style="text-align: center; font-size: 40px; padding-top: "><a style="text-decoration: #ffffff" href="<?php echo e(url('/login')); ?>"  class="active_link"><span class=""></span><strong class="blinking">STUDENT REPORT SEARCH</strong></a></div> */ ?>
	

        <div class="col-md-10 col-md-offset-1">
	        
	       	<div>
	       		<strong style="padding-left: 370px; font-size: 50px; position: fixed;" class="blinking">Students</strong>
	       	</div><br><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 760px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div><br><br>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>

				<div class="row">

					<div class="col-md-8">
						<?php /* <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> */ ?>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('student.create')); ?>" >Add New Student</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('student.index')); ?>" role="button">Show All Records</a>
						<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					</div>

					

					<div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'student.search')); ?>  
			            <?php /*  <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>

			            <?php echo Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Search By Student Name')); ?>


			            <?php /* <?php echo e(Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;"))); ?> */ ?>
			     	 
						<?php echo Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>
				</div><br>
			
<?php /* <a class="w3-bar-item-block w3-button"><i class="fa fa-search"></i></a> */ ?>
			<?php if(count($rows)): ?>

<form action="<?php echo e(route('categories.destroy')); ?>" method="post">
    <?php echo e(csrf_field()); ?>


	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                <?php /* <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Students</div> */ ?>

                    <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Students</th>
                      </div>
                      <div>
                     <th style="padding-left: 20px;">
                     	showing <?php echo e(($rows->currentpage()-1)*$rows->perpage()+1); ?> to <?php echo e($rows->currentpage()*$rows->perpage()); ?> of <?php echo e($rows->total()); ?> entries
                     </th>
                 </div>
	                </div>

	                <div class="panel-body">

	                  <table class="table table-striped">
	                  	<?php /* <tr class="info"> */ ?>
                   <p>
                              <?php /* <td style="font-size: 30px;: ;"> <input type="checkbox" id="selectAll" /> Select all</td> */ ?>
		                     
		                     <?php /*  </tr> */ ?>
		                       <div class="col-sm-12"> 
		                     <td> <button class="btn btn-danger">Delete Checked</button></td>
		                   </div> 
		             </p>
							<tr>
							 	<?php /* <td> <lable><input type="checkbox" style="font-size: 10px;" id="selectAll" /> Select all</lable></td>  */ ?>
							 	<th>#</th>
							 	<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td>
								<th>Student Name</th>					
								<th>Gender</th>
								<th>DOB</th>
								<th>Class Name</th>
								<th>Parent Name</th>
								<th>Parent Number</th>
								<?php /* <th>UniqueCode</th> */ ?>
								<?php /* <th>Show</th>
								<th>Edit</th>
								<th>Delete</th> */ ?>
								<?php /* <th>School Code</th> */ ?>
							</tr>
			</tr>
	</thead>
							
							<?php foreach($rows as $key=>$row): ?>
							<tr>
							<td> <?php echo e(($rows->currentpage()-1) * $rows->perpage() + $key + 1); ?></td>	
                        <td><input type="checkbox" name="categories[]" class="checkboxes" value="<?php echo e($row->id); ?>" /></td>

                             <td><?php echo e(isset($row->StudentName) ? $row->StudentName : 'DEFAULT'); ?></td>
                             <td><?php echo e($row->Gender); ?></td>
                             <td><?php echo e($row->DOB); ?></td>
                             <td><?php echo e(isset($row->ClassName) ? $row->ClassName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->ParentName) ? $row->ParentName : 'DEFAULT'); ?></td>
                              <td><?php echo e(isset($row->ParentNumber) ? $row->ParentNumber : 'DEFAULT'); ?></td>
                              <?php /* <td><?php echo e(isset($row->UniqueCode) ? $row->UniqueCode : 'DEFAULT'); ?></td> */ ?>

                            <?php /*  <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td> */ ?>
                              <?php /* <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="<?php echo e($row->ImageType); ?>" frameborder="0" allowfullscreen></video>

          </div>  */ ?>


								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('student.show',[$row->id])); ?>">Show<?php /* <i class="btn btn-xs btn-success"> */ ?></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('StudentController@edit', array($row->id))); ?>"
			                           class="btn btn-info btn-xs">Edit
			                            <i class="glyphicon glyphicon-pencil"> </i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('student.destroy',$row->id)))); ?>  	                  
			                        <?php echo e(Form::button('<i >Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))); ?>

			                        <?php echo e(Form::close()); ?>   
			            
			                    </td> 
			                     
							</tr>
							<?php endforeach; ?>

							
                </form>
					  </table>
                          <div style="margin-left: 600px;">
					  	<?php if($rows->lastPage() > 1): ?>
                         <ul class="pagination">
	                             <li class="<?php echo e(($rows->currentPage() == 1) ? ' disabled' : ''); ?>">
	                                 <a href="<?php echo e($rows->url(1)); ?>">Previous</a>
	                             </li>
                            <?php for($i = 1; $i <= $rows->lastPage(); $i++): ?>
	                           <li class="<?php echo e(($rows->currentPage() == $i) ? ' active' : ''); ?>">
	                                 <a href="<?php echo e($rows->url($i)); ?>"><?php echo e($i); ?></a>
	                           </li>
                           <?php endfor; ?>
                             <li class="<?php echo e(($rows->currentPage() == $rows->lastPage()) ? ' disabled' : ''); ?>">
                                  <a href="<?php echo e($rows->url($rows->currentPage()+1)); ?>" >Next</a>
                             </li>
                         </ul>
                      <?php endif; ?>
					  </div>
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