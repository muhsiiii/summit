@extends('layouts.header')
@section('header')

<section class="section-head"  style="background-image: url('{{url('/assets/images/downloads.png')}}');">
  <div class="head-content">
    <div class="container-main">
      <h2>Downloads</h2>
     
    </div>
  </div>
</section>

<section class="folder-donwloads">
  <div style="background: none;" class="container-main down">

		@if(count($downloads) > 0)
			<div class="row">
				@foreach($downloads as $key => $value)
					<div class="col-md-2 col-sm-4 col-xs-4">
						<div class="boxx">
              @if($value->type == 'Folders')
                <a href="{{url('/downloads/'.$value->id)}}">
              @else
                <a href="{{url('/downloads/files/'.$value->id)}}">
              @endif
                <img src="{{url('/assets/images/Vector.png')}}"  alt="Folder Icon Downloads">
                <h4>{{$value->name}}</h4>
              </a>
            </div>
					</div>
				@endforeach
			</div>
    @else
      <center><h2 class="text-danger">File not Found!</h2></center>
		@endif

	</div>
</section>






@endsection