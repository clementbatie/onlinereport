

<?php $__env->startSection('content'); ?><br><br><br><br>
<div class="container spark-screen">
    <div class="row">
  <div class="col-md-11 col-md-offset-1">
<div id="aaa" class="col-md-9">
       <?php /*  <a href="<?php echo e(url('/salarypay')); ?>"  class="btn btn-danger btn-block">
        Back
        </a> */ ?>
        </div>
        <div id="aaa" class="col-md-3">
         <a href="#" id="export" class="btn btn-success"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
        </div>
        </div>

     <div class="col-md-11 col-md-offset-1">
      
          <?php echo Form::open(array('method' => 'GET','route' => 'listsofclass.search')); ?>  
              
   <!--  <div class="form-group">
       <div class="col-md-3">
          
    <?php /*  <?php echo Form::select('searchString1',$student, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Student Name','data-live-search'=>'true' ]); ?> */ ?>

        </div>
        </div>
 -->
        <?php /* <div class="form-group">
       <div class="col-md-3">
          
     <?php echo Form::select('searchString1',$school, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true' ]); ?>


        </div>
        </div> */ ?>

       <div class="form-group">
       <div class="col-md-3">
          
     <?php echo Form::select('searchString2',$classes, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true' ]); ?>


      </div>
      </div>
        
        <div class="form-group">
       <div class="col-md-2">
   
        <?php echo Form::text('FromDate',null,['class'=>'form-control','id'=>'datepicker1',
       'placeholder'=>'Date From'
        ] ); ?>

        </div>
        </div>

         <div class="form-group">
       <div class="col-md-2">
   
        <?php echo Form::text('ToDate',null,['class'=>'form-control','id'=>'datepicker2',
       'placeholder'=>'Date To'
        ] ); ?>

        </div>
        </div>

       <div class="form-group">
       <div class="col-md-2">
      
    <?php echo Form::submit('Generate',array('class'=>'btn btn-info')); ?>

    </div>
        </div>
    <?php echo Form::close(); ?>

    <div id="aaa" class="col-md-2">
        <a href="<?php echo e(url('/listsofclass')); ?>"  class="btn btn-warning">
        Refresh
        </a>
        </div>

        </div>
   
    <div class="col-md-10 col-sm-offset-1">
    
        
    <h1>Class And Total Number Of Students</h1>
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
   <tr><td colspan="10" > Name: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($NameOfSchool) ? $NameOfSchool : ""); ?></span><?php echo e(isset($indicate) ? $indicate : ""); ?></td></tr>
    <tr><td colspan="10" class="">Report Period: <span style="margin-left: 10px; margin-right:10px"><u><?php echo e(isset($from) ? $from : "0"); ?></u> </span>To <span style="margin-left: 10px; margin-right:10px"><u><?php echo e(isset($to) ? $to : "0"); ?></u></span></td></tr>
            
              <tr style="background-color: rgb(192,192,192);">
               <?php /* <th colspan="4" class="text-left"></th>  */ ?>                
              <th class="text-left">Class</th>
               <th class="text-left">No of Students</th>
               <th class="text-left">Female</th>
               <th class="text-left">Male</th>
              <th colspan="7" class="text-left"></th>
       
                                
              </tr>

               <?php $memarray = []; ?> 
               <?php $memarray2 = []; ?> 
               <?php $memarray3 = []; ?> 

              <?php foreach($output as $index => $row): ?>
             
              <tr>
                <?php /* <td colspan="4"></td> */ ?>
                <td class="text-left"><?php echo e($row->ClassName); ?></td>

                <td class="text-left"><?php echo e($row->counter); ?></td>
                 <?php if(isset($con)){
                  $con = $row->counter;
                  $memarray[] = $con;
                }else{
                  $con = $row->counter;
                  $memarray[] = $con;
                }
                ?> 
                
               
              <?php $query = \App\student::where('students.SchoolCode',auth()->user()->SchoolCode)->GroupBy('classID')->where('Gender','Female')->where('students.ClassID',$row->ClassID)->leftjoin('classes','students.ClassID','=','classes.ClassID')->leftjoin('schoolinfos','students.SchoolCode','=','schoolinfos.SchoolCode')->select(DB::raw('count(*) as counter'),'students.*','classes.ClassName','schoolinfos.Name')->first();

              $query2 = \App\student::where('students.SchoolCode',auth()->user()->SchoolCode)->GroupBy('classID')->where('Gender','Male')->where('students.ClassID',$row->ClassID)->leftjoin('classes','students.ClassID','=','classes.ClassID')->leftjoin('schoolinfos','students.SchoolCode','=','schoolinfos.SchoolCode')->select(DB::raw('count(*) as counter'),'students.*','classes.ClassName','schoolinfos.Name')->first();

              $Female = $query ? $query->counter : "";
              $Male = $query2 ? $query2->counter : "";
             // dd($member);
              ?>

              <td class="text-left"><?php echo e($Female); ?></td>
              <?php if(isset($con2)){
                  $con2 = $Female;
                  $memarray2[] = $con2;
                }else{
                  $con2 = $Female;
                  $memarray2[] = $con2;
                }
                ?> 
              <td class="text-left"><?php echo e($Male); ?></td>
               <?php if(isset($con3)){
                  $con3 = $Male;
                  $memarray3[] = $con3;
                }else{
                  $con3 = $Male;
                  $memarray3[] = $con3;
                }
                ?> 
                <th colspan="7" class="text-left"></th>
              <?php /* <?php if($flag == '1'): ?>
              <td>Present</td>
              <?php elseif($flag == '0'): ?>
              <td>Absent</td>
              <?php else: ?>
              <td>----</td>

              <?php endif; ?> */ ?>

                <!-- <?php if(isset($mem)){
                  $mem += $row->assembly;
                }else{
                  $mem = $row->assembly;
                }
                ?>  -->
                
              <!--   <td class="text-left"><?php echo e($row->ClassName); ?></td>
                <?php if(isset($newmembers)){
                  $newmembers += $row->newmembers;
                }else{
                  $newmembers = $row->newmembers;
                }
                ?> 

                <td class="text-left"><?php echo e($row->SchoolCode); ?></td>
                 <?php if(isset($vis)){
                  $vis += $row->visitors;
                }else{
                  $vis = $row->visitors;
                }
                ?>  -->
<!--  -->

                <!-- <td><a class="btn btn-xs btn-success" data-toggle="modal" data-target="#<?php echo e($index); ?>"> <i class="glyphicon glyphicon-eye-open"></i></a> </td> -->        <!-- Modal -->
                <div id="<?php echo e($index); ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Message Discussed: <?php echo e(isset($row->topic) ? $row->topic : ""); ?></h4>
                      </div>
                      <div class="modal-body">
                        <u><h4>Comments</h4></u>
                        <p><?php echo e($row->comments); ?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div><!-- end modal -->                 
              </tr>

              </tr>
               
              <?php endforeach; ?>
              <tr style="font-weight: bolder;">
                <?php /* <td></td>
                <td></td>
                   <td></td>
                   <td></td> */ ?>
              
               
               <td style="font-size: 20px">Total : </td>

                <td style="font-size: 20px; " class="text-left text-primary"><?php echo e(array_sum($memarray)); ?></td>
                <td style="font-size: 20px; " class="text-left text-primary"><?php echo e(array_sum($memarray2)); ?></td>
                <td style="font-size: 20px; " class="text-left text-primary"><?php echo e(array_sum($memarray3)); ?></td>
                <th colspan="7" class="text-left"></th>
              </tr>

             <!--  <tr style="font-weight: bolder;">
                <td></td>
                <td></td>
                <td class="text-right text-primary"><?php echo e(isset($mem) ? $mem : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($mem) ? $mem : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($mem) ? $mem : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($con) ? $con : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($newconverts) ? $newconverts : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($chil) ? $chil : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($tot) ? $tot : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($prev) ? $prev : "0"); ?></td>
                <td class="text-right text-primary"><?php echo e(isset($variance) ? $variance : "0"); ?></td>
              </tr>    -->          
            </table>
</div>
                  </div>
               <!-- -->
                     
                  <?php /*  <?php echo $__env->make('trademark', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>
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