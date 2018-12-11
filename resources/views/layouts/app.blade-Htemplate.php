<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.includes.head')
</head>

<body>
<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            @include('layouts.includes.topbar')
            @include('layouts.includes.sidebar')
        </nav>

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   {{-- <h1 class="page-header">Blank</h1>  --}}
                    @yield('content')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
@include('layouts.includes.tail')
