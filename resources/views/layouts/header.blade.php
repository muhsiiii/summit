<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link href="{{url('/assets/images/favicon.png')}}" type="image/png" rel="icon" alt="summit-ias-logo">
  <link href="{{url('/assets/images/favicon.png')}}" type="image/png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>{{$title ?? 'Summit IAS'}}</title>
  <meta name="description" content="{{$content ?? ''}}">
  <meta name="keywords" content="{{$keyword ?? ''}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{url('/assets/assets/css/docs.theme.min.css')}}">
  <!-- Owl Stylesheets -->
  <link rel="stylesheet" href="{{url('/assets/assets/owlcarousel/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{url('/assets/assets/owlcarousel/assets/owl.theme.default.min.css')}}">
  <!-- My Styles -->
  <link rel="stylesheet" href="{{url('/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{url('/assets/css/mystyle.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
</head>
<body>
  <header class="container-main">
    <nav class="navbar">
      <a href="{{url('/')}}" class="navbar-logo"><img src="{{url('assets/images/bluewhite 1.png')}}" alt="Summit-Logo"></a>
      <ul class="navbar-links">
        <li @if($page == 'Home') class="active" @endif ><a href="{{url('/')}}">Home</a></li>
        <li @if($page == 'About Us') class="active" @endif ><a href="{{url('/aboutus')}}">About Us</a></li>
        <li @if($page == 'Courses') class="active" @endif ><a href="{{url('/courses')}}">Courses</a></li>
        <li @if($page == 'Downloads') class="active" @endif ><a href="{{url('/downloads')}}">Downloads</a></li>
        <!-- <li @if($page == 'Quiz') class="active" @endif ><a href="{{url('/quiz')}}">Quiz</a></li> -->
        <li @if($page == 'Toppers') class="active" @endif ><a href="{{url('/toppers')}}">Toppers</a></li>
        <li @if($page == 'Gallery') class="active" @endif ><a href="{{url('/gallery')}}">Gallery</a></li>
        <li @if($page == 'Contact Us') class="active" @endif ><a href="{{url('/contactus')}}">Contact Us</a></li>
      </ul>
      <div class="navbar-hamburger">
        <i class="fa-solid fa-bars openbtn" onclick="openNav()"></i>
      </div>
    </nav>
  </header>
    <div id="mySidebar" class="sidebar hide">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <br><br>
      <a  href="{{url('/')}}">
        <img src="{{url('assets/images/icons/Vector.png')}}" /> &nbsp; Home
      </a>
      <a href="{{url('/aboutus')}}">
        <img  src="{{url('assets/images/icons/Vector (1).png')}}" /> &nbsp; About us 
      </a>
      <a href="{{url('/courses')}}">
        <img src="{{url('assets/images/icons/Vector (2).png')}}" /> &nbsp; Courses
      </a>
      <a href="{{url('/downloads')}}">
        <img src="{{url('assets/images/icons/Vector (3).png')}}" /> &nbsp; Downloads
      </a>
      <!-- <a href="{{url('/quiz')}}"> -->
        <!-- <img src="{{url('assets/images/icons/Vector (4).png')}}" /> &nbsp; Quiz -->
      <!-- </a> -->
      <a href="{{url('/toppers')}}">
        <img src="{{url('assets/images/icons/Vector (5).png')}}" /> &nbsp; Toppers
      </a>
      <a href="{{url('/gallery')}}">
        <img src="{{url('assets/images/icons/Vector (6).png')}}" /> &nbsp; Gallery
      </a>
      <a href="{{url('/contactus')}}">
        <img src="{{url('assets/images/icons/Vector (7).png')}}" /> &nbsp; Contact us
      </a>
    </div>

    @yield('header')


    <section class="mtp-2 mb-3 why-submit-main back-image" style="background-image: url('{{url('/assets/images/footer-back.png')}}');">
      <div class="container-main ">
        <div class="why-submit">
          <h3>Why Summit IAS ?</h3>
          <p>&emsp; {!! $settings->why_submit ?? '' !!}</p>
        </div>
      </div>
    </section>

    <footer class="mtp-3 mb-3 footer">
      <div class="container-main ">
        <div class="row">
          <div class="col-lg-3">
            <img src="{{url('/assets/images/bluewhite 1.png')}}" alt="Summit-Logo" style="max-width: 300px; margin-bottom: 10px;">
            <p>{{$settings->footer_desc ?? ''}}</p>
            <div class="store">
              <div class="row">
                <div class="col-6">
                  <a href="{{$settings->google_play ?? ''}}" target="_blank">
                    <img src="{{url('/assets/images/playstore_icon.png')}}" alt="Play Store">
                  </a>
                </div>
                <div class="col-6">
                  <a href="{{$settings->app_store ?? ''}}" target="_blank">
                    <img src="{{url('/assets/images/appstore_icon.png')}}" alt="App Store">
                  </a>
                </div>
              </div>
            </div>
            <div class="social-media">
              <h5 class="mt-1">Follow us on</h5>
              <hr>
              <a href="tel:{{$settings->footer_mobile ?? ''}}"><i class="fa-solid fa-phone"></i></a>
              <a href="https://wa.me/9188669488" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
              <a href="{{$settings->instagram_link ?? ''}}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
              <a href="{{$settings->facebook_link ?? ''}}" target="_blank"><i class="fa-brands fa-facebook"></i></a>
              <a href="https://t.me/KASstudymaterial" target="_blank"><i class="fa-brands fa-telegram"></i></a>
              
            </div>
          </div>
          <div class="col-md-2 md-hide">
            <h4>About Us</h4>
            <p>{{$settings->footer_about ?? ''}}</p>              
          </div>
          <div class="col-md-2 md-hide">
            <h4>Courses</h4>
            <ul>
              @if(count($fcourses) > 0)
              @foreach($fcourses as $key => $value)
              <li><a href="{{url('/course/'.$value->id)}}">{{$value->name}}</a></li>
              @endforeach
              @endif
            </ul>
          </div>
          <div class="col-md-2 md-hide">
            <h4>Download</h4>
            <ul>
              @if(count($fdownloads) > 0)
              @foreach($fdownloads as $key => $value)
              <li><a href="{{url('/course/'.$value->id)}}">{{$value->name}}</a></li>
              @endforeach
              @endif
            </ul>
          </div>
          <div class="col-md-3 md-hide">
            <h4>Contact Us</h4>
            <ul>
              <li>
                <a href="tel:{{$settings->footer_mobile ?? ''}}">
                  <i class="fa-solid fa-phone"></i>
                  {{$settings->footer_mobile ?? ''}}
                </a>
              </li>
              <li><a href="mailto:{{$settings->footer_email ?? ''}}"><i class="fa-solid fa-envelope"></i> {{$settings->footer_email ?? ''}}</a></li>
              <li><a href="https://maps.google.com/maps?q={{$settings->footer_address ?? ''}}" target="_blank">{{$settings->footer_address ?? ''}}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <div class="copy-right mt-2">
      <p>Copyright 2022 Summit IAS Academy. All Rights Reserved  |  Designed & Developed by <a href="https://erebsindia.com/" target="_blank">ERE Business Solutions</a></p>
    </div>
  </div>
  <!-- jQuery -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

    <script src="{{url('/assets/assets/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{url('/assets/assets/vendors/highlight.js')}}"></script>
    <script src="{{url('/assets/assets/js/app.js')}}"></script>
  <script>
    function openNav() {
      $('#mySidebar').removeClass('hide');
    }
    function closeNav() {
      $('#mySidebar').addClass('hide');
    }
  </script>
  @if(Session::has('success'))
  <script>
    toastr.success('{{Session::get('success')}}')
  </script>
  @endif

  @if(Session::has('error'))
  <script>
    toastr.error('{{Session::get('error')}}')
  </script>
  @endif

  @if(Session::has('warning'))
  <script>
    toastr.warning('{{Session::get('warning')}}')
  </script>
  @endif

</body>
</html>