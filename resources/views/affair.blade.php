@extends('layouts.header')
@section('header')


<section class="section-head"  style="background-image: url('{{url($affair->image)}}');">
  <div class="head-content">
    <div class="container-main text-center">
      <h2>{{$affair->heading}}</h2>
    </div>
  </div>
</section>

<section class="downloads-details">
	<div style="background: none;" class="container-fluid pg">
		<div class="row">
			{!! $affair->desc !!}
		</div>
	</div>
</section>


@endsection