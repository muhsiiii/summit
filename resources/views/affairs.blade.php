@extends('layouts.header')
@section('header')

<section class="section-head"  style="background-image: url('{{url('/assets/images/current-affairs-back.png')}}');">
  <div class="head-content">
    <div class="container-main text-center">
      <h2>Current Affairs</h2>
      {{-- <h6>Perfect civil service coaching environment is crucial for UPSC Civil Services preparation owing to the dynamic nature of the civil services exam</h6> --}}
    </div>
  </div>
</section>

<section class="mtp-1 mb-1">
  <div class="container-main">

    <div class="row" style="overflow:hidden;">
      @if(count($affairs) > 0)
        @foreach($affairs as $key => $value)
          <div class="col-md-12 col-lg-4 affairs-items mb-4" >
            <img src="{{url($value->image)}}">
            @if(strlen($value->heading) > 100)
            	<h4>{{substr($value->heading, 0, 100)}}...</h4>
            @else
            	<h4>{{$value->heading}}</h4>
            @endif
            <a href="{{url('/affair/'.$value->id)}}">Read More </a>
          </div>
        @endforeach
      @endif
    </div>

  </div>
</section>

@endsection