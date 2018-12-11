@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
@if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }}">
            <h2>{{ Session::get('message') }}</h2>
        </div>
    @endif
    <div class="col-md-12">
       @if(count($rows) > 0)
     <div class="panel panel-primary">
                <div class="panel-heading">Members  <span class="notify blink">new</span></div>

                <div class="panel-body">
                <div class="table-responsive">

                  <table class="table table-striped">
          <tr>
            <th>Name</th><th>Phone Number</th><th>Date Sent</th><th>Status</th><th></th>
          </tr>
          @foreach($rows as $row)
          <tr>
            <td>{{ $row->name or "Default" }}  </td>
                        <td>{{ $row->contact or "Default" }}  </td>           
            <td>{{ $row->created_at or "Default" }}  </td>
                        
                        <td>
                        @if($row->confirmed !=0)  
                        <div class="bg-success text-success">Approved</div>
                        @else
                        <div class="bg-warning text-warning">Not Received</div>
                        @endif
                        </td>
            <td><a href="{{route('Members.approvememberssave',[$row->id])}}" class="btn btn-primary" role="button"  data-toggle="tooltip" title="Receive"><i class="glyphicon glyphicon-ok"></i></a>  </td>
          </tr>
          @endforeach
          </table>  
          </div>
                </div>
            </div>
            @endif
    </div><br><br>
     <div class="col-md-12" style="width: 100px; height: 40px;">
       <?php $background = "uploads/"; $background .= $backgroundimage ? $backgroundimage->Logo : "p00.jpg" ; ?>
        
      <img class="col-md-12" style="width: 600px; height: 600px; margin-left: 265px" class="imghome" src="{{asset($background)}}" alt="homee image">
      </div>


  </div>
</div>
<style>
  .imghome{
    max-height: 100%;
    max-width: 100%;
    display: block;
    margin: auto;
  }

</style>

@endsection
