@extends('layouts.header')
@section('header')

<section>
  <img src="{{url('/assets/images/bannerhome.jpeg')}}" alt="Summit-Banner-Image" >
  <div class="container-main">
    <marquee width="100%" direction="left" class="md-show">{{$settings->marquee ?? ''}}</marquee>
    <div class="get-in-touch">
      <h2>Get in Touch</h2>
      <form action="{{url('get-in-touch')}}" method="POST" id="getForm">
        @csrf
        <label for="name">Tell us your name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" required>
        <label for="email">Enter your email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Your message here" rows="5"></textarea>
        <button type="submit">Submit</button>
      </form>
    </div>
    <marquee width="100%" direction="left" class="md-hide">{{$settings->marquee ?? ''}}</marquee>
  </div>
</section>

<section class="mtp-2">
  <div class="container-main">
    <h1 class="heading-one">Our Popular Courses</h1>
    <div class="row">
      @if(count($courses) > 0)
        @foreach($courses as $key => $value)
          @if($key > 5) @endif
          <div class="col-md-4 col-sm-6 col-xs-6 col-lg-4 col-xl-4 mbp-2 @if($key > 5) md-hide @endif " >
            <div class="course-main">
              <a href="{{url('/course/'.$value->id)}}" >
                <h4>{{$value->name}}</h4>
              </a>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</section>

<section class="mtp-2">
  <div class="container-main">
    <div class="row">
      <div class="col-md-12 col-lg-6">
        <div class="articles-home">
          <div class="articles-heading"><h3>Todays Articles</h3></div>
          <ol class="article-body">
            @if(count($articles) > 0)
              @foreach($articles as $key => $value)
                <li>
                  <a href="{{url('/article/'.$value->id)}}" target="_blank">
                    {{$value->heading}}
                  </a>
                </li>
              @endforeach
            @endif
          </ol>
        </div>
      </div>
      <div class="col-md-12 col-lg-6">
        <div class="articles-home">
          <div class="articles-heading"><h3>Downloads(Notes)</h3></div>
          <ol class="article-body downloads">
            @if(count($downloads) > 0)
              @foreach($downloads as $key => $value)
                <li>
                  <div class="folder">
                    <i class="far fa-folder-open"></i>
                    <div class="foldr-detils">
                      <a href="{{url('/downloads/'.$value->id)}}" >
                        <h4>{{$value->name}}</h4>
                        <p>{{$value->desc}}</p>
                      </a>
                    </div>
                  </div>
                </li>
              @endforeach
            @endif
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="mtp-2 mb-3">
  <div class="container-main">
    <h1 class="heading-one inline-block">Current Affairs</h1>
    <a class="affairs-viewall" href="{{url('/affairs')}}">View All</a>

    <div class="row">
      @if(count($affairs) > 0)
        @foreach($affairs as $key => $value)
          <div class="col-md-12 col-lg-4 affairs-items mb-2" >
            <img src="{{url($value->image)}}">
            @if(strlen($value->heading) > 90)
              <h4>{{substr($value->heading, 0, 90)}}...</h4>
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