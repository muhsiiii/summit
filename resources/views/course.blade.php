@extends('layouts.header')
@section('header')


<section class="section-head"  style="background-image: url('{{url('/assets/images/Rectangle 4 (1).png')}}');">
  <div class="head-content">
    <div class="container-main text-center">
      <h2>{{$course->name}}</h2>
      <p>{{$course->desc}}</p>
    </div>
  </div>
</section>

<!-- <section class="indroduction">
  <div style="background: none;" class="container-fluid intro">
    <div class="row">
      <div class="col-12">
        <h4>Here at SUMMIT IAS, we achieve this through a three-tiered civil services exam oriented structure:</h4>
        <p>Systematic & regular classes for comprehensive IAS exam syllabus coverage Timely evaluations & civil service mock tests for continuous assessment Personalized feedback & mentorship for guidance & IAS exam course correction.</p>
      </div>
    </div>
  </div>
</section> -->

<section class="course-details mt-2">
  <div style="background: none;" class="container-fluid course-det">
    <div class="row">
      @if(count($highlights) > 0)
        @foreach($highlights as $key => $value)
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="box-col">
              <h4>{{$value->heading}}</h4>
              <h5>{!! $value->desc !!}</h5>
            </div>
            <div class="number-div">
              <h1>0{{$value->disp_order}}</h1>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</section>

@endsection
