

<?php $__env->startSection('content'); ?>

<div class="container spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-1">
     

      <div id="aaa" class="col-md-9">
      <?php /* <h1 style="text-align: center; text-decoration: #ffffff; font-size: 60px;"><p class="blinking">STUDENT REPORT SEARCH</p></h1> */ ?>

      <div style="padding-left: 200px; font-size: 40px; padding-top: "><a style="text-decoration: #ffffff"  class="active_link"><span class=""></span><strong class="blinking">STUDENT REPORT SEARCH</strong></a></div>
      </div><br>    



   </div>



       <div class="col-md-10 col-md-offset-1">
    <?php echo Form::open(array('method'=>'GET','route'=>'studentreport.search')); ?>


    <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::select('student',$student, null, ['class' => 'form-control selectpicker','id'=>'studentAD', 'placeholder'=>'Select Student Name' ,'data-live-search'=>'true']); ?>

 
       <?php foreach($studentImage as $one): ?>
             <option value="<?php echo e($one->id); ?>" image="<?php echo e($one->ImageType); ?>" regid="<?php echo e($one->StudentName); ?>"><?php echo e($one->StudentName); ?></option>
            <?php endforeach; ?>
      
     </div>
       

   </div>
  
   <div class="form-group">
     <div class="col-md-2">
      <?php echo Form::submit('Generate',array('class'=>'btn btn-info','id'=>'student')); ?>

    </div>
  </div>
   <div id="aaa" style="padding-left: 850px">
     
        <a href="<?php echo e(url('/')); ?>"  class="btn btn-danger btn-block">
          Return
        </a>
      </div><br>
  <?php echo Form::close(); ?>


</div>
      
      
     
 </div>



<?php /* <div class="col-md-3" style="margin-left: 60px; padding-left: 50px;"> */ ?>
<div class="col-md-19 col-sm-offset-1">

   
  <?php if(Session::has('message')): ?>
  <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
   <?php echo e(Session::get('message')); ?>

 </p>
 <?php endif; ?>
<?php if(count($output)): ?>



 <div style="width: 1000px;" class="panel panel-default">
  <div class="panel-header"></div>
  <div class="panel-body">
    <div class="table-responsive">
     <table class="table table-striped" id="exporttable">

 <div class="col-md-12">


    
        
<div class="row">

      
       <div class="col-md-2" style="padding-top: 25px; ">
           <img style="margin-top: -7px; border-radius: 50%; margin-left: 20px;"  src="<?php echo e(asset('uploads/').'/'.$Images2); ?>" alt="" height="130px" width="130px">
       </div>


       <div class="col-md-8">
            <h1 style="font-size: 43px; text-align: center"><?php echo e(isset($schoolinfo->Name) ? $schoolinfo->Name : "---"); ?></h1>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->Address) ? $schoolinfo->Address : "---"); ?></p>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->ContactNos) ? $schoolinfo->ContactNos : "---"); ?></p>
            <h3 style="font-size: 28px; text-align: center"><?php echo e(isset($schoolinfo->reportname) ? $schoolinfo->reportname : "---"); ?></h3><br>  
       </div>

    
      
       <div cclass="col-md-2" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="<?php echo e(asset('uploads/').'/'.$StuImage2); ?>" alt="" height="130px" width="130px">
       </div>
  </div>
     
 </div>
       <tr>
        <td colspan="6">  
          <span class="col-md-6"><strong>Name</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($selectedstudent->StudentName) ? $selectedstudent->StudentName : "---"); ?></span> </span>
          <span class="col-md-6"><strong>Year</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->Year) ? $classinfo->Year : "---"); ?></span> </span>
        </td>
       </tr>
     
       
        <tr>
          <td colspan="6">
            <span class="col-md-4"><strong>Term</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->myterm->TermName) ? $classinfo->myterm->TermName : "---"); ?></span> </span>
            <span class="col-md-4"><strong>Class</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->myclass->ClassName) ? $classinfo->myclass->ClassName : "---"); ?></span> </span>
            <?php /* <span class="col-md-4"><strong>No on Roll</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->OnRoll) ? $classinfo->OnRoll : "---"); ?></span> </span> */ ?>
            
            <span class="col-md-4"><strong>No on Roll</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($totalNo) ? $totalNo : "---"); ?></span> </span>
          </td>
        </tr>

        <tr>
          <td colspan="6">
            <span class="col-md-4"><strong>School Closes</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->SchoolCloses) ? $classinfo->SchoolCloses : "---"); ?></span> </span>
            <span class="col-md-4"><strong>Next term begins</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->NextTermBegins) ? $classinfo->NextTermBegins : "---"); ?></span></span>
            <?php /* <span class="col-md-4"><strong>Position</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->a) ? $classinfo->a : "---"); ?></span> </span> */ ?>

            <span class="col-md-4"><strong>Position</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($OverallpositionInClass[0]->Position) ? $OverallpositionInClass[0]->Position : "---"); ?></span> </span>

            <?php /* <span class="col-md-4"><strong>Overall Total</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($OverallpositionInClass[0]->OverallTotal) ? $OverallpositionInClass[0]->OverallTotal : "---"); ?></span> </span> */ ?>
          </td>
        </tr>

       <tr style="background-color: rgb(192,192,192)" class="row-border">
         <th style="text-align: center;">Subject</th>
         <th style="text-align: center;">Class Score</th>
         <th style="text-align: center;">Exams Score</th>
         <th style="text-align: center;">Total</th>
         <th style="text-align: center;">Position</th>
         <th style="text-align: center;">Remark</th>
        </tr>
         
      <?php foreach($output as $row): ?>
        <tr class="row-border">
          <td style="text-align: center;"><?php echo e($row->SubjectName); ?></td>
          <td style="text-align: center;"><?php echo e($row->classscore); ?></td>
          <td style="text-align: center;"><?php echo e($row->examscore); ?></td>
          <td style="text-align: center;"><?php echo e($row->classscore + $row->examscore); ?></td>
          <td style="text-align: center;"><?php echo e($row->position); ?></td>
          <td style="text-align: center;"><?php echo e($row->remarks); ?></td>
        </tr>
      <?php endforeach; ?>
   
     </table>
     <span style="padding-left: 470px;" class="col-md-9"><strong>Overall Total :</strong><span style="margin-left: 10px; margin-right:10px; font-size: 20px;"> <?php echo e(isset($OverallpositionInClass[0]->OverallTotal) ? $OverallpositionInClass[0]->OverallTotal : "---"); ?></span> </span><br><br>
     <legend></legend>
   </div>
 </div>
 <div style="margin-left: 80px;" class="container">
   <div class="col-md-5"><strong>Promoted To / Repeated To :</strong>  <span><?php echo e(isset($studentperformance->PromotedTo) ? $studentperformance->PromotedTo : "---"); ?></span> </div>
   <div class="col-md-5"><strong>No of days opened for the term :</strong>  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->AttendanceExpected) ? $studentperformance->AttendanceExpected : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Attendance</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->ActualAttendance) ? $studentperformance->ActualAttendance : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Conduct</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->CharacterOfStu) ? $studentperformance->CharacterOfStu : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Interest</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->Interest) ? $studentperformance->Interest : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Class Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->ClassTeacherRemarks) ? $studentperformance->ClassTeacherRemarks : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Head Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->HeadTeacherRemarks) ? $studentperformance->HeadTeacherRemarks : "---"); ?></span> </div>
   
 </div><br><br>
  <?php /* <?php echo $__env->make('trademark', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>
</div>
<?php else: ?> 
<div class="col-md-19" style="padding-left:20px;">
    <strong>There Are No Records To Show</strong> 
</div>
<?php endif; ?>

</div>
</div>
</div>
<div class="container" id="piechart"></div>
<script type="text/javascript">
// Load google charts



// Draw the chart and set the chart values

</script>
<script>
    function blinker(){
        $('.blinking').fadeOut(200);
        $('.blinking').fadeIn(200);
    }
    setInterval(blinker, 1000);
</script>
<style>
  .row-border td{
    border: 1px solid black;
  }
  .row-border th{
    border: 1px solid black;
  }
</style>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>