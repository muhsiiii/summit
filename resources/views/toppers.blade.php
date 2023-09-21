@extends('layouts.header')
@section('header')

<section class="section-head"  style="background-image: url('{{url('/assets/images/toppers-back.png')}}');">
  <div class="head-content">
    <div class="container-main">
      <h2>Toppers</h2>

    </div>
  </div>
</section>


<section class="toppers mt-4">
  <div class="container-main">
    @if(count($toppers) > 0)
      <div class="row">
        @foreach($toppers as $key => $value)
          <div style="margin-bottom: 55px;"  class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="inner-col">
              <img class="frame-top"  src="{{url('/assets/images/WINNERS.png')}}" alt="" srcset="">
              <img class="topr-img" src="{{url($value->image)}}" alt="{{$value->name}}">
              <h4 style="padding-left: 30%;font-size: 15PX;"> {{$value->name}}</h4>

              <div class="">
                {{-- ^css class for hexagon - polygon --}}
                <img src="{{url('/assets/images/Group 320.png')}}" alt="">

                {{-- <h3> @if($value->rank > 10) 0{{$value->rank}} @else {{$value->rank}} @endif</h3> --}}
              </div>
              <h5 class="text-muted; " style="padding-left: 30%">{{$value->heading}}</h5>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

@endsection
