@extends('layouts.header')
@section('header')

<section class="section-head"  style="background-image: url('{{url('/assets/images/gallery-back.png')}}');">
  <div class="head-content">
    <div class="container-main">
      <h2>Gallery</h2>
      
    </div>
  </div>
</section>


<section id="demos">
  <div class="container-main">

      @if(count($categories) > 0)
        @foreach($categories as $key => $value)
          <h1 class="heading-one">{{$value->name}}</h1>
          <div class="row">
            <div class="large-12 columns">
              <?php $gallery = App\Http\Controllers\HomeController::getGallery($value->id); ?>

              <div class=" @if($key == 0) owl-carousel @else owl-carousel owl-extra{{$key}} @endif owl-theme">
                @if(count($gallery) > 0)
                  @foreach($gallery as $key => $value)
                    <div class="owl item">
                      <a href="{{url($value->image)}}" target="_blank">
                        <img src="{{url($value->image)}}" alt="{{$value->name}}" style="height: 100%;">
                      </a>
                    </div>
                  @endforeach
                @endif
              </div>


            </div>
          </div>
        @endforeach
      @endif

  </div>
</section>

<script>
  @if(count($categories) > 0)
    @foreach($categories as $key => $value)
      $(document).ready(function() {
        @if($key == 0)
          $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            nav: false,
            responsive: {
              0: {
                items: 1
              },
              300: {
                items: 2
              },
              600: {
                items: 3
              },
              900: {
                items: 4
              },
              1200: {
                items: 6
              }
            }
          })
        @else
          $('.owl-extra{{$key}}').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            nav: false,
            responsive: {
              0: {
                items: 1
              },
              300: {
                items: 2
              },
              600: {
                items: 3
              },
              900: {
                items: 4
              },
              1200: {
                items: 6
              }
            }
          });
        @endif
      });
    @endforeach
  @endif
</script>

@endsection