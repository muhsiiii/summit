@extends('layouts.header')
@section('header')

<section class="section-head"  style="background-image: url('{{url('/assets/images/downloads.png')}}');">
  <div class="head-content">
    <div class="container-main">
      <h2>Downloads</h2>
      <h6>{{$heading ?? ''}}</h6>
    </div>
  </div>
</section>

	@if(count($downloads) > 0)
    @foreach($downloads as $key => $value)
    	<section class="folder-donwloads">
        <div style="background: none;" class="container-main down">
          <h3 class="underline-small">{{$value->name}}</h3>
					<?php $subFolders = App\Http\Controllers\HomeController::getSubFolders($value->id); ?>

					@if(count($subFolders) > 0)
						<div class="row">
    					@foreach($subFolders as $key => $value1)
								<div class="col-md-2 col-sm-4 col-xs-4">
									<div class="boxx">
                    <a href="{{url('/downloads/'.$value1->id)}}">
                      <img src="{{url('/assets/images/Vector.png')}}"  alt="Folder Icon Downloads">
                      <h4>{{$value1->name}}</h4>
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
    @endforeach
  @endif


@endsection