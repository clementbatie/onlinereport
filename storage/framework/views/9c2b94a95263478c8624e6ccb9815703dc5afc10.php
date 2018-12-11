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
   <div class="col-md-11 col-md-offset-1">
    <?php echo Form::open(array('method'=>'GET','route'=>'classattendancereportperperiod.search')); ?>

    <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::select('class',$rows, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select CellName' ,'data-live-search'=>'true']); ?>


     </div>
   </div>

   <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::text('FromDate',null,['class'=>'form-control','id'=>'datepicker2',
       'placeholder'=>'Select Start Date'
       ] ); ?>

     </div>
   </div>
   <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::text('ToDate',null,['class'=>'form-control','id'=>'datepicker1',
       'placeholder'=>'Select End Date'
       ] ); ?>

     </div>
   </div>
   <div class="form-group">
     <div class="col-md-2">
      <?php echo Form::submit('Generate',array('class'=>'btn btn-info')); ?>

    </div>
  </div>
  <?php echo Form::close(); ?>


</div>

<div class="col-md-10 col-sm-offset-1">


  <h1>Cell Attendance Sheet</h1>
  <?php if(Session::has('message')): ?>
  <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
   <?php echo e(Session::get('message')); ?>

 </p>
 <?php endif; ?>
 <?php if(count($output) >0): ?>
 <div class="panel panel-default">
  <div class="panel-header"></div>
  <div class="panel-body">
    <div class="table-responsive">
     <table class="table table-striped" id="exporttable">

       <tr><td colspan="3" > Name: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($districtname) ? $districtname : ""); ?></span></td></tr>
     
       <tr><td colspan="3" class="">Report Period: <span style="margin-left: 10px; margin-right:10px"><u><?php echo e(isset($from) ? $from : "0"); ?></u> </span>To <span style="margin-left: 10px; margin-right:10px"><u><?php echo e(isset($to) ? $to : "0"); ?></u></span></td></tr>

       <tr style="background-color: rgb(192,192,192)">
         <th>#</th>
         <th>Name</th>
         <?php foreach($output as $outp): ?>
         <th><?php echo e($outp); ?></th>
         <?php endforeach; ?>

       </tr>
       <?php if(2): ?>
        <?php $counter = 1; ?>
       <?php foreach($members as $member): ?>
       <tr>
         <td><?php echo e($counter++); ?></td>
         <td><?php echo e(isset($member->name) ? $member->name : "Default"); ?></td>
            <?php foreach($output as $key => $outp): ?>
              <?php $query = \App\Classattendance::where('date',$outp)
              ->where('NationalID',auth()->user()->NationalID)
              ->where('classmember_id',$member->id)
              //->where('class_id',$key)
              ->first(); 
              $flag = $query ? $query->flag : "";
             // dd($member);
              ?>
              <?php if($flag == '1'): ?>
              <td>Present</td>
              <?php elseif($flag == '0'): ?>
              <td>Absent</td>
              <?php else: ?>
              <td>----</td>
              <?php endif; ?>
            <?php endforeach; ?>
       </tr>
       <?php endforeach; ?>
      <?php endif; ?>
     </table>
   </div>
 </div>
  <?php echo $__env->make('trademark', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<?php else: ?>
There are no records

<?php endif; ?>
</div>
</div>
</div>
<div class="container" id="piechart"></div>
<script type="text/javascript">
// Load google charts



// Draw the chart and set the chart values

</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>