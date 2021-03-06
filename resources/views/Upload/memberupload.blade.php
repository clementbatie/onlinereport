@extends('layouts.app')

@section('content')<br><br><br><br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

    {{-- @include('errors.messages') --}}
    {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true')) !!}
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>

      @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
              {{Session::get('message')}}
          </p>
      @endif

       @include('Upload/_crud', array('rwstate' => 'false') )

       <!-- Button (Double) -->
       <div style="margin-left: 100px;" class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
         <input type="button" id="viewfile" value="Fetch Data" onclick="ExportToTable()"  class="btn btn-primary">
         {!! Form::submit('Process Data',['class'=>'btn btn-success']) !!}
           <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <!-- <input type="submit" id="save" value="insert" class="btn btn-success createbuilding"> -->
            {{-- <input input type="submit" value="Process Data" class="btn btn-success" role="button"> --}}
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('/') }}" role="button">Cancel</a>
               

         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!} 

    </div>
    </div>
</div><br><br>
<div class="container col-md-8" style="margin-left: 250px;">
  <div class="panel panel-primary">
      <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 5px;padding-left: 20px;"  class="panel-primary2"><h4> Added Data</h4></div>
    <div class="panel panel-body">   

       <table id="exceltable" class="table table-responsive">  
    </table> 

  </div>
    </div>
  </div>

  <script src="{{asset('js/xlsx.core.min.js')}}"></script>  
  <script src="{{asset('js/xls.core.min.js')}}"></script>  

  <script>
  var data = [];
      function ExportToTable() {  

         var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;  
         /*Checks whether the file is a valid excel file*/  
         if (regex.test($("#excelfile").val().toLowerCase())) {  
             var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/  
             if ($("#excelfile").val().toLowerCase().indexOf(".xlsx") > 0) {  
                 xlsxflag = true;  
             }  
             /*Checks whether the browser supports HTML5*/  
             if (typeof (FileReader) != "undefined") {  

                 var reader = new FileReader();  
                 reader.onload = function (e) {  
                     var data = e.target.result;  
                     /*Converts the excel data in to object*/  
                     if (xlsxflag) {  
                         var workbook = XLSX.read(data, { type: 'binary' });  
                     }  
                     else {  
                         var workbook = XLS.read(data, { type: 'binary' });  
                     }  
                     /*Gets all the sheetnames of excel in to a variable*/  
                     var sheet_name_list = workbook.SheetNames;  
      
                     var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/  
                     sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/  
                         /*Convert the cell value to Json*/  
                         if (xlsxflag) {  
                             var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);  
                         }  
                         else {  
                             var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
                         }  
                         if (exceljson.length > 0 && cnt == 0) {  
                             BindTable(exceljson, '#exceltable');  
                             cnt++;  
                         }  
                     });  
                     $('#exceltable').show();  
                 }  
                 if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/  
                     reader.readAsArrayBuffer($("#excelfile")[0].files[0]);  
                 }  
                 else {  
                     reader.readAsBinaryString($("#excelfile")[0].files[0]);  
                 }  
             }  
             else {  
                 alert("Sorry! Your browser does not support HTML5!");  
             }  
         }  
         else {  
             alert("Please upload a valid Excel file!");  
         }  
     }  

         function BindTable(jsondata, tableid) {/*Function used to convert the JSON array to Html Table*/ 
         
         var columns = BindTableHeader(jsondata, tableid); /*Gets all the column headings of Excel*/  
         for (var i = 0; i < jsondata.length; i++) {  
             var row$ = $('<tr/>');  
             var splitter = 0;
             var dataarray = [];
              row$.append($('<td/>').html("<input type='checkbox' name='record'>"));  
             for (var colIndex = 0; colIndex < columns.length; colIndex++) {  

              splitter++;
              console.log(splitter);
                 var cellValue = jsondata[i][columns[colIndex]];  
                 if (cellValue == null)  
                   {
                     cellValue = "";  
                   }
                    console.log("cellValue is " + cellValue);
                 dataarray.push(cellValue);
                 row$.append($('<td/>').html(cellValue));  
             }  
             data.push(dataarray);
             $(tableid).append(row$);  
           
         }  
         console.log(data);
     }  
     function BindTableHeader(jsondata, tableid) {/*Function used to get all column names from JSON and bind the html table header*/  
         var columnSet = [];  
         var headerTr$ = $('<tr/>');  
          headerTr$.append($('<th/>').html('#'));
         for (var i = 0; i < jsondata.length; i++) {  
             var rowHash = jsondata[i];  
             for (var key in rowHash) {  
                 if (rowHash.hasOwnProperty(key)) {  
                     if ($.inArray(key, columnSet) == -1) {/*Adding each unique column names to a variable array*/  
                         columnSet.push(key);  
                         headerTr$.append($('<th/>').html(key));  
                     }  
                 }  
             }  
         }  
         $(tableid).append(headerTr$);  
         return columnSet;  
     }  
</script>
@endsection
