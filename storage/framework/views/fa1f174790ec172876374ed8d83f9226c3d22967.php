


<?php $__env->startSection('content'); ?><br>

<div class="container spark-screen">
    <div class="row">

		<?php /* <?php echo Form::open(array('method' => 'GET','route' => 'student.search')); ?>  
		            <?php echo Form::label('searchString', 'Quick Search:'); ?>

		            <?php echo Form::text('searchString'); ?>

		     	
					<?php echo Form::submit('Search', array('class' => 'btn btn-primary')); ?>

		 
		<?php echo Form::close(); ?> */ ?>
	
	
	

        <div class="col-md-12 ">
	       <?php /*  <h1>  </h1> */ ?>
	        <div>
	       		<strong style="padding-left: 250px; font-size: 50px; position: fixed;" class="blinking">Overal Position In A Class</strong>
	       	</div><br><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 890px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>

	       	<br><br>

	        <?php if(Session::has('message')): ?>
			    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
			        <?php echo e(Session::get('message')); ?>

			    </p>
			<?php endif; ?>

				<div class="row">

					<?php /* <div style="margin-right: -2000px;" class="col-md-4">

						<?php echo Form::open(array('method' => 'GET','route' => 'student.search')); ?>  

		            <?php echo e(-- <?php echo Form::text('searchString', null, array('placeholder'=>'Type Student Name')); ?>

 */ ?><?php /* <div style="margin-right: 200px;" class="col-md-7">
		            <?php echo Form::text('searchString',null, array('class' => 'form-control', 'placeholder'=>'Type Student Name', 'id'=>'position',
                          )); ?>

		     	</div>
					<?php echo Form::submit('Quick Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")); ?>

		 
		              <?php echo Form::close(); ?> */ ?>

						<?php /* <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> */ ?>
						<?php /* <a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('overalposition.create')); ?>" >Add New Terminal Score</a>
 */ ?>						
						<!-- <a class="btn btn-info" href="<?php /* <?php echo e(url('parents')); ?> */ ?>" role="button">Transfer</a> -->
					<?php /* </div>  */ ?>
             <?php if(auth()->user()->UserLevelID == 2): ?>
					<div class="col-md-6">
						<div class="row">
						<?php echo Form::open(array('method' => 'GET','route' => 'overalposition.search')); ?>  
			           <?php /*  <?php echo Form::label('searchString', 'Search:'); ?> */ ?>
			            <div class="col-md-4">
			              <?php echo Form::select('classID',$Class, null, ['class' => 'form-control','id'=>'Class' ]); ?>

			             </div>

                      <?php /* 
			             <div class="col-md-4">
			              <?php echo Form::select('classID',$Class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true','id'=>'Class' ]); ?>

			             </div> */ ?>
			     	 
						<?php echo Form::submit('Get Position', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")); ?>

			 
			            <?php echo Form::close(); ?>

			            </div>
					</div>
             <?php endif; ?>


					<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="<?php echo e(route('overalposition.index')); ?>" role="button"> Refresh</a>

					<?php /* <div class="col-md-4">
						<div class="row">
						<?php echo Form::open(array('method' => 'GET','route' => 'overalposition.searchStudent')); ?>  
			           <?php echo e(--  <?php echo Form::label('searchString', 'Search:'); ?> */ ?>
			           <?php /*  <div class="col-md-7">
			              <?php echo Form::text('StudentName', null, ['class' => 'form-control selectpicker', 'placeholder'=>'Type Student Name','data-live-search'=>'true','id'=>'Class' ]); ?>

			             </div>
			     	 
						<?php echo Form::submit('Quick Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")); ?>

			 
			            <?php echo Form::close(); ?>

			            </div>
					</div> */ ?> 
           
					<div class="col-md-4">
						<div class="row">
						<?php echo Form::open(array('method' => 'GET','route' => 'overalposition.searchStudent')); ?>  
			           <?php /*  <?php echo Form::label('searchString', 'Search:'); ?> */ ?>
			            <div class="col-md-6">
			           <?php echo Form::select('getclassid',$Class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true','id'=>'ClassB' ]); ?>

			       </div>


			            <?php /* <div class="col-md-4">
			           <?php echo Form::select('subjectID',[], null, array('class' => 'form-control', 'placeholder'=>'Select Subject','id'=>'subjectname')); ?> */ ?>
  

			      <?php /*  </div> */ ?>
			     	 
						<?php echo Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")); ?>

			 
			            <?php echo Form::close(); ?>

			            </div>
					</div>

					

					<?php /* <a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('overalposition.index2')); ?>" role="button">Show All Records</a> */ ?>

					<?php /* <li><a a href="<?php echo e(url('/overalposition2')); ?>">Enter Terminal Score</a></li> */ ?>

				</div><br>
			

			<?php if(count($rows)): ?>

<?php /* <form action="<?php echo e(route('categories10.deleteMultiple')); ?>" method="post">
    <?php echo e(csrf_field()); ?> */ ?>
	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                <?php /* <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Student Position In Class</div>
                    */ ?>
                   <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Student Position In Class</th>
                      </div>
                      <div>
                     <?php /* <th style="padding-left: 20px;">
                     	showing <?php echo e(($rows->currentpage()-1)*$rows->perpage()+1); ?> to <?php echo e($rows->currentpage()*$rows->perpage()); ?> of <?php echo e($rows->total()); ?> entries
                     </th> */ ?>

                     <th style="padding-left: 20px;">
                     	<?php echo e($rows->total()); ?> Records 
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
		                     <?php /* <td> <button class="btn btn-primary">Set Positions</button></td> */ ?>

		                   </div> 
		             </p>
							<tr>
							 	<?php /* <td style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td> */ ?>
								<th>#</th>
								<th>Student Name</th>
								<?php /* <th>UniqueCode</th> */ ?>					
								<th>Class Name</th>
								<th>Overall Total</th>
								<th>Position</th>
								<th>Class Teacher Name</th>
								<th>Year</th>
								<th>Term</th>
								<?php /* <th>School Code</th> */ ?>
							</tr>
			</tr>
	</thead>
							
							<?php foreach($rows as $i=>$row): ?>
							<tr>
								
                       <?php /*  <td><input type="checkbox" name="categories10[]" class="checkboxes" value="<?php echo e($row->TerminanlScoreID); ?>" /></td> */ ?>
                      <?php /* <?php for($is=0; $is>$i; $is++): ?> */ ?>
                        
                                <td> <?php echo e(($rows->currentpage()-1) * $rows->perpage() + $i + 1); ?></td>
                                <td><?php echo e(isset($row->StudentName) ? $row->StudentName : 'DEFAULT'); ?></td>
                                <?php /* <td><?php echo e(isset($row->UniqueCode) ? $row->UniqueCode : 'DEFAULT'); ?></td> */ ?>
                                <td><?php echo e(isset($row->ClassName) ? $row->ClassName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->OverallTotal) ? $row->OverallTotal : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->Position) ? $row->Position : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->TeacherSetupName) ? $row->TeacherSetupName : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->Year) ? $row->Year : 'DEFAULT'); ?></td>
                                <td><?php echo e(isset($row->TermName) ? $row->TermName : 'DEFAULT'); ?></td> 

                       <?php /* <?php endfor; ?> */ ?>
                             <?php /* <td><?php echo e(isset($row->SchoolCode) ? $row->SchoolCode : 'DEFAULT'); ?></td> */ ?>
                              <?php /* <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="<?php echo e($row->ImageType); ?>" frameborder="0" allowfullscreen></video>

          </div>  */ ?>


								<?php /* <td><a class="btn btn-xs btn-success" href="<?php echo e(route('terminalscore.show',[$row->TerminanlScoreID])); ?>">Show
		                                                   <?php echo e(-- <i class="glyphicon glyphicon-eye-open"> */ ?><?php /* </i></a> </td>  */ ?>  
								<?php /* <td>
		                        
			                         <a href="{{ action('terminalscoreController@edit', array($row->TerminanlScoreID))); ?>"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td> */ ?>
			                        
			            
			                      <?php /* <?php echo e(Form::open(array('method' 
			                    		=> 'delete', 'route' => array('terminalscore.destroy',$row->TerminanlScoreID)))); ?>  	                  
			                        <?php echo e(Form::button('<i>Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))); ?>

			                        <?php echo e(Form::close()); ?>   
			            
			                    </td>  */ ?> 
			                     
							</tr>
							<?php endforeach; ?>
                     <?php /* </form> */ ?>
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