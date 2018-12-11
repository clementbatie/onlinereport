@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Account Status</div>

                <div class="panel-body">
                   @if (Auth::user()->Userstatus ==2 )
                   

                                            @endif
                    </br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
