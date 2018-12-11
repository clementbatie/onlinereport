 @extends('layouts/app')

 @section('content')
  <br><br><br> <br><br><br> <br><br><br>

<TITLE>Show All Pics</TITLE>
    
    	@foreach($user as $users)
          

         {{--  <div class="media">
          	<div class="media-body">
          <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="{{$users->ImageType}}" frameborder="0" allowfullscreen></video>
 --}}

{{-- <div class="col-md-offset-4" style="margin-bottom: 15px">
  <img height="200px" width="200px" src="uploads/{{$users->ImageType}}"/>
</div> --}}

<div class="col-md-offset-4" style="margin-bottom: 15px">
  <img id="blah" alt="" height="200px" width="200px" src="uploads/{{$users->ImageType}}"/>
</div>
          {{-- </div> --}}
</iframe>
</div>
</div>
<br>

{{-- <video height="300px" controls>
    <source src="{{asset('assetlibr/public/uploads' . $users->Type . '/' . $users->Type)}}" type="video/mp4">
    <source src="{{asset('assetlibr/public' . $upload->filepath . '/' . $upload->filename)}}" type="video/ogg">
    Your browser does not support the video tag.
</video> --}}
</div>
 
        @endforeach 


@endsection