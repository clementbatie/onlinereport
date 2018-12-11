

<?php $__env->startSection('content'); ?><br><br><br>
<div class="container spark-screen">
    <div class="row">
  <div class="col-md-11 col-md-offset-1">
<div id="aaa" class="col-md-6">
        <a href="<?php echo e(url('/salarypay')); ?>"  class="btn btn-danger btn-block">
        Back
        </a>
        </div>
        <div id="aaa" class="col-md-6">
         <a href="#" id="export" class="btn btn-success"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
        </div>
        </div>

     <div class="col-md-11 col-md-offset-1">
      
          <?php echo Form::open(array('method' => 'GET','route' => 'teacherclass.search')); ?>  
              
    <div class="form-group">
       <div class="col-md-3">
          
     <?php echo Form::select('searchString1',$teacher, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Student Name','data-live-search'=>'true' ]); ?>


        </div>
        </div>

       <!--  <div class="form-group">
       <div class="col-md-3">
          
     <?php echo Form::select('searchString2',$classes, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true' ]); ?>


        </div>
        </div>
 -->
       <!-- <div class="form-group">
       <div class="col-md-4">
          
     <?php echo Form::select('searchString3',$school, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Term','data-live-search'=>'true' ]); ?>


      </div>
      </div> -->
        
       <!--  <div class="form-group">
       <div class="col-md-3">
        <br> 
        <?php echo Form::text('FromDate',null,['class'=>'form-control','id'=>'datepicker1',
       'placeholder'=>'Date From'
        ] ); ?>

        </div>
        </div>

         <div class="form-group">
       <div class="col-md-3">
        <br> 
        <?php echo Form::text('ToDate',null,['class'=>'form-control','id'=>'datepicker2',
       'placeholder'=>'Date To'
        ] ); ?>

        </div>
        </div> -->
       <div class="form-group">
       <div class="col-md-3">
    
    <?php echo Form::submit('Generate',array('class'=>'btn btn-info')); ?>

    </div>
        </div>
    <?php echo Form::close(); ?>


        </div>
   
    <div class="col-md-10 col-sm-offset-1">
    
        
    <h1>Teacher and Class</h1>
    <?php if(Session::has('message')): ?>
          <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
              <?php echo e(Session::get('message')); ?>

          </p>
      <?php endif; ?>
      
        <div class="panel panel-default">
        <div class="panel-header"></div>
        <div class="panel-body">
<div class="table-responsive">
                    <table class="table table-striped" id="exporttable">
   <tr><td colspan="10" > Name: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($searchStr) ? $searchStr : ""); ?></span><?php echo e(isset($indicate) ? $indicate : ""); ?></td></tr>
    <tr><td colspan="10" class="">Report Period: <span style="margin-left: 10px; margin-right:10px"><u><?php echo e(isset($from) ? $from : "0"); ?></u> </span>To <span style="margin-left: 10px; margin-right:10px"><u><?php echo e(isset($to) ? $to : "0"); ?></u></span></td></tr>
            
              <tr style="background-color: rgb(192,192,192);">
                              
              <th class="text-left">Teacher Name</th>
               <th class="text-left">Teacher's Number</th>
               <th class="text-left">Class Teaching</th>
                               
                                
              </tr>

               <?php $memarray = []; ?> 
              <?php foreach($arra2 as $row): ?>
             
              <tr>
    
                <td class="text-left"><?php echo e($row); ?></td>
           
                

                <div id="<?php echo e(""); ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Message Discussed: <?php echo e(""); ?></h4>
                      </div>
                      <div class="modal-body">
                        <u><h4>Comments</h4></u>
                        <p><?php echo e(""); ?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div><!-- end modal -->                 
              </tr>

              </tr>
               
      <!--         
              <tr style="font-weight: bolder;">
                <td></td>
                <td></td>
                   <td></td>
                   <td></td>
               <td></td>
               <td></td>
               <td></td> -->
               
           
                
              </tr>
                
              
              <?php endforeach; ?>
             
               <?php foreach($array as $row): ?>
             
                 <td class="text-left"><?php echo e($row); ?></td>
               <?php endforeach; ?>


               <tr style="font-weight: bolder;">
                
                <!-- <td></td>
                <td></td>
                <td class="text-right text-primary"><?php echo e(isset($mem) ? $mem : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($mem) ? $mem : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($mem) ? $mem : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($con) ? $con : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($newconverts) ? $newconverts : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($chil) ? $chil : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($tot) ? $tot : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($prev) ? $prev : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($variance) ? $variance : "0"); ?></td> -->
              </tr>            
            </table>
</div>
                  </div>
               <!-- -->
                     
                   <?php echo $__env->make('trademark', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
             </div>
      </div>
    </div>
</div>
 
 <style type="text/css">
  #datepicker1::placeholder,#datepicker2::placeholder{
    font-weight: bold;
  }
 </style>
<?php $__env->stopSection(); ?>

        

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>