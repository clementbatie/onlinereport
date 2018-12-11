@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

	@if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }}">
            <h2>{{ Session::get('message') }}</h2>
        </div>
    @endif
        	
        <div class="col-md-10 col-md-offset-1">
            
			<div class="row">
				
				
			</div>

			<hr>
            
            
            <div class="panel panel-primary">
                <div class="panel-heading">Mail Box </div>

                <div class="panel-body">
                
                
                
                  <table class="table table-striped">
					<tr>
						<th>Report Notification</th><th></th>
					</tr>
					<tr>
						<td>
                        <a href=" {{ url('/inbox') }} ">Inbox</a>   
						</td>						
						<td>
                        <p>
 {{ $inbox[0]->total or 4 }}
 @if($inbox[0]->total > 0)
 <span class="notify blink">new</span>
 @endif
 </p>
						</td>
					</tr>
@if(auth()->user()->UserLevelID==2)
				<tr>
						<td>
                        <a href=" {{ url('/rejected') }} ">Rejected</a>   
						</td>						
						<td>
                        <p>
 {{ $rejected[0]->total or 4 }}
 
 </p>
						</td>
					</tr>
	@endif
	    			<tr>
						<td>
                        <a href=" {{ url('/sent') }} ">OutBox</a>   
						</td>						
						<td>
                        <p>
 {{ $outbox[0]->total or 4 }}
 
 </p>
						</td>
					</tr>	
				  </table>
                </div>
            </div>




        </div>
    </div>
</div>
@endsection
