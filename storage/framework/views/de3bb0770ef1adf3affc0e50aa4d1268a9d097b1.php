<?php $__env->startSection('content'); ?><br>
<div class="container spark-screen">
    <div class="row">
  <div class="col-md-11 col-md-offset-1">

        <p>
  <?php /* <div style="padding-left: 20px" class="blinking"><h1></h1></div>
 */ ?>

  <div>
            <strong style="padding-left: 200px; font-size: 50px; position: fixed;" class="blinking">Promoting Of Students</strong>
          </div><br><br><br>
          <legend style="margin-bottom: 2px;"></legend>


 <div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 800px; "><?php echo e($getTerm); ?></span><?php echo e($getYear); ?></strong></div>
          <br><br>
  
     <div class="col-md-11">

      
          <?php echo Form::open(array('method' => 'GET','route' => 'promotestudents.search')); ?>  
 

      
        <div class="form-group" style="margin-left: -20px">
       <div class="col-md-3">
          
     <?php echo Form::select('classname',$class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true' ]); ?>


        </div>
        </div>

      

       <div class="form-group">
       <div class="col-md-4">
      
    <?php echo Form::submit('Search For Class',array('class'=>'btn btn-success')); ?>

    </div>
        </div>
    <?php echo Form::close(); ?>


        <div id="aaa" class="col-md-2">
            <a href="<?php echo e(url('/promotestudents')); ?>" class="btn btn-primary">Refresh Page</a>
        </div>
        <div id="aaa" class="col-md-2">
            <a href="#" id="export" class="btn btn-primary"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
        </div><br><br>

        </div>
    </div></p>




<form action="<?php echo e(route('categories2.destroy')); ?>" method="post">
              <?php echo e(csrf_field()); ?>

              
   
    <div class="col-md-10 col-sm-offset-1">
    
    <?php if(Session::has('message')): ?>
          <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
              <?php echo e(Session::get('message')); ?>

          </p>
      <?php endif; ?>

            
  

  
            <tr>
                
                  <div class="panel panel-primary">
                      <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of  Students In a Class</div>
                  <p>
                
 
                     
                    <div class="col-md-3" style="padding-top: 20px;">
                      <?php echo Form::select('classname2',$class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Promote To Class ','data-live-search'=>'true' ]); ?>

                        </div>
                     

                     
                    <div class="col-md-3" style="padding-top: 20px;">
                       <td><button class="btn btn-success">Promote Students</button></td>
                     </div><br><br>
                   
                    
                     
                     </p>
 </tr>

                  <div class="panel-body">

                    <table class="table table-striped panel1"> 

         
           
                
              <tr>
                <td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td>
                <th>Student Name</th>
                <th>Class Name</th>         
                <th>Parent Name</th>
                <th>Parent Number</th>
                <th>Year</th>
                <th>Term</th>
                <th></th>
              </tr>
      
 
              
              <?php foreach($output as $row): ?>
              <tr>
                
              <td><input type="checkbox" name="categories[]" class="checkboxes" value="<?php echo e($row->id); ?>" /></td>

                             <td><?php echo e(isset($row->StudentName) ? $row->StudentName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->ClassName) ? $row->ClassName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->ParentName) ? $row->ParentName : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->ParentNumber) ? $row->ParentNumber : 'DEFAULT'); ?></td>
                             <td><?php echo e(isset($row->Year) ? $row->Year : 'DEFAULT'); ?></td>
                            <td><?php echo e(isset($row->TermName) ? $row->TermName : 'DEFAULT'); ?></td>
           

                          <td> 
                              
                  
                            <?php echo e(Form::open(array('method' 
                              => 'delete', 'route' => array('student.destroy',$row->id)))); ?>                      
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
     </form>
     </tr>
   </form>
 </div>
</div>
 
 <style type="text/css">
  #datepicker1::placeholder,#datepicker2::placeholder{
    font-weight: bold;
  }
 </style>
 <script>
    function blinker(){
        $('.blinking').fadeOut(200);
        $('.blinking').fadeIn(200);
    }
    setInterval(blinker, 1000);
</script>
<?php $__env->stopSection(); ?>

        

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>