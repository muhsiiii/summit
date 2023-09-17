@extends('layouts.header')
@section('header')


<section class="section-head"  style="background-image: url('{{url('/assets/images/aboutus-back.jpg')}}');">
  <div class="head-content">
    <div class="container-main">
      <h2>About us</h2>
      <h6>{{$heading}}</h6>
    </div>
  </div>
</section>


<section class="about  mtp-2">
  <div class="container-main">
    <div class="container-one container-about">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <h3>ABOUT</h3>
          <h5>Welcome to Summit IAS Academy, the top Civil Service coaching institute in Kozhikode, Kerala. Our aim is to provide the best possible coaching and guidance to our students and to help them achieve their dream of becoming successful IAS, IPS, IFS, and KAS officers.

At Summit IAS Academy, we believe in providing personalized coaching to each of our students. Our one-to-one mentorship program ensures that our students receive individual attention from our expert faculty members, who have a deep understanding of the UPSC syllabus and exam pattern.

We also offer a range of study materials, including free study materials, NCERT warming-up sessions, daily news analysis sessions, post-test discussions, subject-specific revision sessions, and past question paper analysis sessions to help our students prepare thoroughly for the UPSC exam.

Our comprehensive Prelims and Mains test series is designed to help our students practice and assess their knowledge and skills. Our test series simulate the actual UPSC exam and provide our students with valuable feedback and insights.

We offer both recorded video classes and online and offline coaching options to suit the diverse needs of our students. Our innovative teaching methodologies and modern teaching tools make the learning process more engaging and effective.

We are proud to be recognized as the best Civil Service coaching institute in Calicut, Kerala. We are ready to help students to achieve their dream of cracking the UPSC exam and becoming successful civil servants.

Join us today and experience the best coaching and guidance available for cracking the UPSC exam. At Summit IAS Academy, we are committed to helping our students realize their potential and achieve their goals.</h5>
        </div>
        <div class="col-lg-6 col-md-12 hide-about-image">
          <div class="container-one-sub">
            <img class="about-one-back-img" src="{{url('/assets/images/ellipse.png')}}" alt="">
            <img class="about-one-image" src="{{url('/assets/images/about_1.jpeg')}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="about mtp-2">
  <div class="container-main">
    <div class="container-one container-about">
      <div class="row">
        <div class="col-lg-6 col-md-12 hide-about-image">
          <div class="container-one-sub">
            <img class="about-one-back-img" src="{{url('/assets/images/ellipse.png')}}" alt="">
            <img class="about-one-image" src="{{url('/assets/images/about_2.jpg')}}" alt="">
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <h3>OUR VISION</h3>
          <h5>At Summit IAS Academy, our vision is to become the best Civil Service coaching institute in  Kerala and to help our students achieve their dream of cracking the UPSC exam and becoming successful IAS, IPS, IFS, or KAS officers. Our focus is on providing personalized coaching and mentorship to each of our students, along with the best possible infrastructure and facilities, including state-of-the-art classrooms and study materials. We aim to be the go-to destination for anyone seeking the best UPSC coaching in Kozhikode, Kerala. We strive to provide the best possible learning experience for our students, with expert faculty members who have a deep understanding of the UPSC syllabus and exam pattern. Our innovative teaching methodologies, modern teaching tools, and comprehensive coaching programs ensure that our students are well-prepared to crack the UPSC exam with ease. Our fee structure is designed to be affordable and accessible so that anyone who is passionate about pursuing a career in the Civil Service can avail of our coaching services. We believe in providing the best value for money to our students, and our fee structure reflects this commitment. In conclusion, at Summit IAS Academy, we are committed to becoming the best Civil Service coaching institute in Calicut, Kerala, and providing the best possible coaching and guidance to our students. Join us today and take the first step towards realizing your dream of becoming a successful civil servant!</h5>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="about mtp-2">
  <div class="container-main">
    <div class="container-one container-about">
      <h1 class="heading-one gallery-heading white">Gallery</h1>
      <div class="row">
        @if(count($gallery) > 0)
          @foreach($gallery as $key => $value)
            <div class="col-md-3 col-sm-6 col-xs-12  mb-1">
              <a class="gallery-images" href="{{url($value->image)}}" target="_blank">
                <img class="gallery-image" src="{{url($value->image)}}" alt="{{$value->name}}" style="height: 100%;">
              </a>
            </div>
          @endforeach
        @endif
        <div class="col-md-12">
          <div class="mt-3 mb-1">&emsp;</div>
        </div>
        <a class="explore-gallery-btn" href="{{url('/gallery')}}">Explore Summit life</a>
      </div>
      
    </div> 
  </div> 
</section>


@endsection