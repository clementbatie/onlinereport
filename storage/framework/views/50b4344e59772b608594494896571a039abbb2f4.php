<?php $__env->startSection('content'); ?>

<div class="container spark-screen">
  <div class="row">
    <div class="col-md-11 col-md-offset-1">
      <div id="aaa" class="col-md-6">
        <a href="<?php echo e(url('/home')); ?>"  class="btn btn-danger btn-block">
          Back
        </a>
      </div>
      <div id="aaa" class="col-md-6">
       <a href="#" id="export" class="btn btn-success"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
       <a href="#" id="graph" class="btn btn-success"><i class="fa fa-line-chart" onclick="chart()">Graph</i></a>
     </div>
   </div>
   <div class="col-md-10 col-md-offset-1">
    <?php echo Form::open(array('method'=>'GET','route'=>'studentreport.search')); ?>

    <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::select('student',$student, null, ['class' => 'form-control selectpicker','id'=>'student', 'placeholder'=>'Select CellName' ,'data-live-search'=>'true']); ?>

     </div>
   </div>
   <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::select('class',$classes, null, ['class' => 'form-control', 'placeholder'=>'Select Class' ,'id'=> 'studentclass','disabled']); ?>

     </div>
   </div>
   <div class="form-group">
     <div class="col-md-2">
       <?php echo Form::select('term',$terms, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Term' ,'data-live-search'=>'true']); ?>

     </div>
   </div>
     <div class="form-group">
       <div class="col-md-2">
         <select name="year" id="" class="selectpicker form-control" data-live-search="true">
           <?php foreach($year as $one): ?>
            <option value="<?php echo e($one); ?>"><?php echo e($one); ?></option>
           <?php endforeach; ?>
         </select>
       </div>
     </div>
   <div class="form-group">
     <div class="col-md-2">
      <?php echo Form::submit('Generate',array('class'=>'btn btn-info')); ?>

    </div>
  </div>
  <?php echo Form::close(); ?>


</div>
 <div class="col-md-12">
      
      <div class="col-md-8 col-md-offset-1">
        <div class="pull-left"> <img src="<?php echo e(asset('img/logo1.jpg')); ?>" alt="" height="200px" width="200px"></div>
        <div class="col-md-6 col-md-offset-1">
          <h1 style="font-size: 43px;"><?php echo e(isset($schoolinfo->Name) ? $schoolinfo->Name : "---"); ?></h1>
        <p style="font-size: 16px;"><?php echo e(isset($schoolinfo->Address) ? $schoolinfo->Address : "---"); ?></p>
        <p style="font-size: 16px;"><?php echo e(isset($schoolinfo->ContactNos) ? $schoolinfo->ContactNos : "---"); ?></p>
        <h3 style="font-size: 28px;"><?php echo e(isset($schoolinfo->reportname) ? $schoolinfo->reportname : "---"); ?></h3>
        </div>
      </div>
    </div>
<div class="col-md-10 col-sm-offset-1">


   
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

       <tr >
        <td colspan="6">  
          <span class="col-md-6"><strong>Name</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($selectedstudent->StudentName) ? $selectedstudent->StudentName : "---"); ?></span> </span>
          <span class="col-md-6"><strong>Year</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->Year) ? $classinfo->Year : "---"); ?></span> </span>
        </td>
       </tr>
     
       <tr>
        <tr>
          <td colspan="6">
            <span class="col-md-4"><strong>Term</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->myterm->TermName) ? $classinfo->myterm->TermName : "---"); ?></span> </span>
            <span class="col-md-4"><strong>Class</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->myclass->ClassName) ? $classinfo->myclass->ClassName : "---"); ?></span> </span>
            <span class="col-md-4"><strong>No on Roll</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->OnRoll) ? $classinfo->OnRoll : "---"); ?></span> </span>
          </td>
        </tr>

        <tr>
          <td colspan="6">
            <span class="col-md-4"><strong>School Closes</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->SchoolCloses) ? $classinfo->SchoolCloses : "---"); ?></span> </span>
            <span class="col-md-4"><strong>Next term begins</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->NextTermBegins) ? $classinfo->NextTermBegins : "---"); ?></span></span>
            <span class="col-md-4"><strong>Position</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->a) ? $classinfo->a : "---"); ?></span> </span>
          </td>
        </tr>

       <tr style="background-color: rgb(192,192,192)" class="row-border">
         <th>Subject</th>
         <th>Class Score</th>
         <th>Exams Score</th>
         <th>Total</th>
         <th>Position</th>
         <th>Remark</th>
        </tr>
         
      <?php foreach($output as $row): ?>
        <tr class="row-border">
          <td><?php echo e($row->SubjectName); ?></td>
          <td><?php echo e($row->classscore); ?></td>
          <td><?php echo e($row->examscore); ?></td>
          <td><?php echo e($row->totalscore); ?></td>
          <td><?php echo e($row->position); ?></td>
          <td><?php echo e($row->remarks); ?></td>
        </tr>
      <?php endforeach; ?>
       
   
     </table>
   </div>
 </div>
 <div class="container">
   <div class="col-md-6"><strong>Promoted To / Repeated To :</strong>  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->PromotedTo) ? $studentperformance->PromotedTo : "---"); ?></span> </div>
   <div class="col-md-6"><strong>No of days opened for the term :</strong>  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->AttendanceExpected) ? $studentperformance->AttendanceExpected : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Attendance</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->ActualAttendance) ? $studentperformance->ActualAttendance : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Conduct</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->CharacterOfStu) ? $studentperformance->CharacterOfStu : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Interest</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->Interest) ? $studentperformance->Interest : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Class Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->ClassTeacherRemarks) ? $studentperformance->ClassTeacherRemarks : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Head Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->HeadTeacherRemarks) ? $studentperformance->HeadTeacherRemarks : "---"); ?></span> </div>
   
 </div>
  <?php echo $__env->make('trademark', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>


</div>
</div>
</div>
<div class="container" id="piechart"></div>
<script type="text/javascript">
// Load google charts



// Draw the chart and set the chart values

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