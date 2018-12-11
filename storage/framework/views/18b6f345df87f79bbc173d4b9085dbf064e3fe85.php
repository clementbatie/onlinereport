

<?php $__env->startSection('content'); ?><br>
<div class="container spark-screen">
    <div class="row">

		<?php /* <?php echo Form::open(array('method' => 'GET','route' => 'yeartermsetup.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?> */ ?>
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        
	         <div>
	       		<strong style="padding-left: 200px; font-size: 50px; position: fixed;" class="blinking">Academic Year and term</strong>
	       	</div><br><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 760px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div><br><br>
	       	<br>
	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>
				<p>
					<!-- <a class="btn btn-primary" href="<?php echo e(route('yeartermsetup.create')); ?>" >Add new data</a> -->
					<?php /* <a class="btn btn-default" href="<?php echo e(route('yeartermsetup.index')); ?>" role="button">Show All</a> */ ?>
					<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('yeartermsetup.index')); ?>" role="button">Refresh</a>
					<?php /* <a class="btn btn-info" href="<?php echo e(route('yeartermsetup.transfer')); ?>" role="button">Transfer to History</a>
					<!-- <a class="btn btn-info" href="<?php echo e(url('parents')); ?>" role="button">Transfer</a> --> */ ?>
					
				</p>
			

			<?php if(count($rows)): ?>


				
	            <div class="panel panel-primary">
	               <?php /*  <div class="panel-heading">List of  Year and Term</div> */ ?>
	                <?php /* <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of  Year and Term</div> */ ?>

	                <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of  Year and Term</th>
                      </div>
                      <div>
                     <th style="padding-left: 20px;">
                     	showing <?php echo e(($rows->currentpage()-1)*$rows->perpage()+1); ?> to <?php echo e($rows->currentpage()*$rows->perpage()); ?> of <?php echo e($rows->total()); ?> entries
                     </th>
                 </div>
	                </div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<th>#</th>
								<th>Year</th>
								<th>Term</th>
								<th>Shool Name</th>					

							</tr>

							<?php foreach($rows as $key=>$row): ?>
							<tr>
                             <td> <?php echo e(($rows->currentpage()-1) * $rows->perpage() + $key + 1); ?></td>	
                             <td><?php echo e(isset($row->Year) ? $row->Year : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->TermName) ? $row->TermName : 'DEFAULT'); ?></td>
                              <td><?php echo e(isset($row->Name) ? $row->Name : 'DEFAULT'); ?></td>

								<td><a class="btn btn-xs btn-success" href="<?php echo e(route('yeartermsetup.show',[$row->Year_Term_SetipID])); ?>">Show
		                                                   <?php /* <i class="btn btn-xs btn-success"> */ ?>
		                                                   	
		                                                   </i></a> </td>   
								<td>
		                        
			                         <a href="<?php echo e(action('yeartermsetupController@edit', array($row->Year_Term_SetipID))); ?>"
			                           class="btn btn-info btn-xs">Edit
			                           <?php /* <i class="btn btn-info btn-xs"></i> */ ?>
			                       </a>

		                        </td>

			                   <!--  <td>
			                        
			            
 <?php echo e(Form::open(array('method'=> 'delete', 'route' => array('yeartermsetup.destroy',$row->Year_Term_SetipID)))); ?>  	                  
<?php echo e(Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))); ?>

			                        <?php echo e(Form::close()); ?>   
			            
			                    </td>  -->   
							</tr>
							<?php endforeach; ?>
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