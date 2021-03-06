<?php $__env->startSection('content'); ?>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		<?php echo $__env->make('errors.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::open(array('route' => 'Meeting.store', 'class'=>'form-horizontal','id'=>'myform', 'role'=>'form', 'files'=>'true')); ?>

    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       <?php echo e(csrf_field()); ?>


       <fieldset>
<legend>Send SMS to Members</legend>
<?php $rwstate = 'false' ; ?>
<!-- include the partial    -->
  
<div class="form-group<?php echo e($errors->has('date') ? ' has-error' : ''); ?>">
 <?php echo Form::label('Date', 'Scedule Date:' , array('class'=>'col-md-4 control-label'  )); ?>

 <div class="col-md-6">
  <?php echo Form::text('date',\Carbon\Carbon::now()->toDateString(), array('class' => 'form-control', 'placeholder'=>'Select Date', 'id'=>'datepicker2',
  ( $rwstate=='true' ?  'readonly'  :null )  )); ?>

  <?php if($errors->has('date')): ?>
  <span class="help-block">
    <strong><?php echo e($errors->first('date')); ?></strong>
  </span>
  <?php endif; ?>
</div>
</div>

  <div class="form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
  <label class="col-md-4 control-label">Message</label>
  <div class="col-md-4">
    <?php echo Form::textarea('message', null, ['class' => 'form-control','id'=>'textmessage','rows' => '12',
    'placeholder'=>'Type Message Here' ,( $rwstate=='true' ?  'readonly'  :null )  ] ); ?>    
    <?php if($errors->has('message')): ?>
    <span class="help-block">
      <strong><?php echo e($errors->first('message')); ?></strong>
    </span>
    <?php endif; ?>
  </div>
  <div class="col-md-2">
      <p style="float:left; width:auto;">Chars: <span id="display_count" style=" color:red;">0</span></p>
         <p style="float:right; width:auto;">Pages: <span id="usedsms" style=" color:red;">0</span></p>
           <div class="form-group">  
        <?php echo Form::select('member', ['Parent'=>'Parent','Teacher'=>'Teacher'], null, ['class' => 'form-control selectpicker','id'=>'membertypes', 'data-live-search'=>'true', 
    'placeholder'=>'Search Type' ,( $rwstate=='true' ?  'readonly'  :null )  ] ); ?>  
      </div>
         <div class="form-group">  
        <?php echo Form::select('gender', $class, null, ['class' => 'form-control selectpicker','id'=>'gender', 'data-live-search'=>'true', 
    'placeholder'=>'Class Name' ,( $rwstate=='true' ?  'readonly'  :null )  ] ); ?>  
      </div>
        <div class="form-group">  
        <?php echo Form::text('FromDate', null, ['class' => 'form-control selectpicker','id'=>'datepicker1', 'data-live-search'=>'true',
    'placeholder'=>'Start Date ' ,( $rwstate=='true' ?  'readonly'  :null )  ] ); ?>  
      </div>
      <div class="form-group">  
        <?php echo Form::text('ToDate',null, ['class' => 'form-control selectpicker','id'=>'datepicker4', 'data-live-search'=>'true',
    'placeholder'=>'End Date ' ,( $rwstate=='true' ?  'readonly'  :null )  ] ); ?>  
      </div>
       <div class="form-group">  
          <input type="submit" id="querymembersms"  class="btn btn-success querymembersms" value="Search">
          <i class="fa fa-spinner fa-spin fa-lg" id="spinner2" aria-hidden="true" style="display: none"></i>
       </div>
  </div>
</div>


    <div class="leaderform">
  <div class="form-group<?php echo e($errors->has('members') ? ' has-error' : ''); ?>">
  <label class="col-md-4 control-label">Add Member</label>
  <div class="col-md-6">
    <?php echo Form::select('members', $members, null, ['class' => 'form-control selectpicker','id'=>'smsmember', 'data-live-search'=>'true',
    'placeholder'=>'Parent/Teacher Name' ,( $rwstate=='true' ?  'readonly'  :null )  ] ); ?>    
    <?php if($errors->has('members')): ?>
    <span class="help-block">
      <strong><?php echo e($errors->first('members')); ?></strong>
    </span>
    <?php endif; ?>
  </div>
</div>
</div>


       <!-- Button (Double) -->
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           <input type="button" id="addmembersms"  value="Add"  class="btn btn-primary">
           <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <input type="submit" id="sendsms"  class="btn btn-success sendsms" value="Send Sms">
            <i class="fa fa-spinner fa-spin fa-lg" id="spinner" aria-hidden="true" style="display: none"></i>
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="<?php echo e(url('/')); ?>" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    <?php echo Form::close(); ?>

 

    </div>
    </div>
</div>

 <div class="container col-md-6 col-md-offset-3 meetingpanel">
  <div class="panel panel-primary">
      <div class="panel panel-heading "><h4> Added Data</h4></div>
    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>Student Name</th>
            <th>Class</th>
            <th>Parent Member</th>
          </tr>
        </thead>
               
      </tbody>
    </table>
  </div>
    </div>
  </div>
  <script>
    var data = [];
    var tempo = [];
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>