

<?php $__env->startSection('content'); ?><br>
<div class="container spark-screen">
    <div class="row">

		<?php /* <?php echo Form::open(array('method' => 'GET','route' => 'Usermanagement3.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?> */ ?>
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        
	        <div>
	       		<strong style="padding-left: 320px; font-size: 50px; position: fixed;" class="blinking">School Users</strong>
	       	</div><br><br><br>
	       	<legend></legend>
	       	<br>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>

			<?php /* <p>
					<a class="btn btn-primary" href="<?php echo e(route('Usermanagement3.create')); ?>" >Add new data</a>
					<a class="btn btn-default" href="<?php echo e(route('Usermanagement3.create')); ?>" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					
				</p> */ ?>


				<div class="row">

					<div class="col-md-8">
						<?php /* <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> */ ?>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('Usermanagement3.create')); ?>" >Add New Admin</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('Usermanagement3.index')); ?>" role="button">Refresh</a>
						<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> -->
					</div>

					


					<div class="col-md-4">
						<?php echo Form::open(array('method' => 'GET','route' => 'Usermanagement3.search')); ?>  
			            <?php /*  <?php echo Form::label('searchString', 'Quick Search:'); ?> */ ?>
			            <?php /* <?php echo Form::text('searchString'); ?> */ ?>

			            <?php echo Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Type Admin Name')); ?>


			            <?php /* <?php echo e(Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;"))); ?> */ ?>
			     	 
						<?php echo Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")); ?>

			 
			            <?php echo Form::close(); ?>

					</div>
				</div><br>
				
				
			

			<?php if($rows->count()): ?>


				<?php /* 
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of School Users</div>

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
							<?php endforeach; ?> */ ?>







							<form action="<?php echo e(route('categories14.deleteMultiple')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <thead>
                    <tr>
                      <th style="width: 8px;">
	            <div class="panel panel-primary">
	               <?php /*  <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Users</div> */ ?>

	                <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Users</th>
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
                           <div class="col-sm-12"> 
		                     <td> <button class="btn btn-danger">Delete Checked</button></td>
		                   </div> 
		             </p>
							<tr>
								<th>#</th>
								<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td>
								<th>Name</th>
								<th>Email</th>
								<th>SchoolCode</th>
							</tr>
							</tr>

						</tr>
	            </thead>


							<?php foreach($rows as $key=>$row): ?>
							<tr>
								<td> <?php echo e(($rows->currentpage()-1) * $rows->perpage() + $key + 1); ?></td>	
								<td><input type="checkbox" name="categories14[]" class="checkboxes" value="<?php echo e($row->id); ?>" /></td>

								<td><?php echo e(isset($row->name) ? $row->name : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->email) ? $row->email : 'DEFAULT'); ?></td>
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
			                        <?php echo e(Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
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