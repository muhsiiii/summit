@extends('layouts.header')
@section('header')

<section class="section-head"  style="background-image: url('{{url('/assets/images/Rectangle 4 (1).png')}}');">
  <div class="head-content">
    <div class="container-main">
      <h2>Courses</h2>
      <h6>{{$heading ?? ''}}</h6>
    </div>
  </div>
</section>

<section class="course mtp-2">
  <div style="background: none;" class="container-main cours">
    @if(count($courses) > 0)
      <div class="row cours-row">
        @foreach($courses as $key => $value)
          <div class="col-md-3 col-sm-6 col-xs-6 col-lg-2">
            <div class="course-box">
              <a href="{{url('/course/'.$value->id)}}">
                <img  src="{{url($value->image)}}" alt="{{$value->name}}">
                <div class="course-content">
                  <h4>{{$value->name}}</h4>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>


@endsection