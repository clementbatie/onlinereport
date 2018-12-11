


<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">

		<?php /* <?php echo Form::open(array('method' => 'GET','route' => 'usermanagement2.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?> */ ?>
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <div>
	       		<strong style="padding-left: 400px; font-size: 50px; position: fixed;" class="blinking">Terms</strong>
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
						<?php /* <a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('term.create')); ?>" >Add New Term</a>
						<a style="background-color:#00663d; color:#fff; font-size:30px" class="inputForm" href="<?php echo e(route('term.index')); ?>" role="button">Show All</a> */ ?>
						<!-- <a class="btn btn-info" href="<?php /* <?php echo e(url('parents')); ?> */ ?>" role="button">Transfer</a> -->
					<div class="col-md-3">
						<?php echo Form::open(array('method' => 'GET','route' => 'term.create')); ?>  
			     	 
						<?php echo Form::submit('Add New Term', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:20px;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>
					<div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'term.index')); ?>  
			     	 
						<?php echo Form::submit('Show All Records', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:20px;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>

						
					</div>

					<div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'term.search')); ?>  
			            <?php /*  <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>

			            <?php echo Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Search By Term Name')); ?>


			            <?php /* <?php echo e(Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;"))); ?> */ ?>
			     	 
						<?php echo Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>

					
				</div><br>
				
			

			<?php if($rows->count()): ?>
             <form action="<?php echo e(route('categories4.deleteMultiple')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <thead>
                    <tr>
                      <th style="width: 8px;">
	            <div class="panel panel-primary">
	                <?php /* <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Terms</div>
 */ ?>
	                <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Terms</th>

                      </div>
                      <div>
                     <th style="padding-left: 20px;">
                     	showing <?php echo e(($rows->currentpage()-1)*$rows->perpage()+1); ?> to <?php echo e($rows->currentpage()*$rows->perpage()); ?> of <?php echo e($rows->total()); ?> entries
                     </th>
                 </div>
	                </div>

	                <div class="panel-body">

	                  <table class="table table-striped">

	                 <p>
                           <div> 
		                     <td class="col-md-1"> <button class="btn btn-danger">Delete Checked</button></td>
		                   </div> 
		             </p>
							<tr>
								<th>#</th>	
								<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td>
								<th>Term Name</th>	
								<th>Term Name</th>					
								<th>School Code</th>
							</tr>

						</tr>
	            </thead>


							<?php foreach($rows as $key=>$row): ?>
							<tr>
								<td> <?php echo e(($rows->currentpage()-1) * $rows->perpage() + $key + 1); ?></td>
								<td><input type="checkbox" name="categories4[]" class="checkboxes" value="<?php echo e($row->TermID); ?>" /></td>

								<td><?php echo e(isset($row->TermName) ? $row->TermName : 'DEFAULT'); ?></td>
								<td><?php echo e(isset($row->TermID) ? $row->TermID : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td>
                               
                               <!--  <td><?php echo e(isset($row->date) ? $row->date : 'DEFAULT'); ?></td> -->
								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('term.show',[$row->TermID])); ?>">Show
		                                                   <?php /* <i class="glyphicon glyphicon-eye-open"> */ ?></i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('TermController@edit', array($row->TermID))); ?>"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('term.destroy',$row->TermID)))); ?>  	                  
			                        <?php echo e(Form::button('<i> Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
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