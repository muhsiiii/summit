@extends('layouts.header')
@section('header')


<section class="section-head"  style="background-image: url('{{url('/assets/images/contactus-back.png')}}');">
  <div class="head-content">
    <div class="container-main">
      <h2>Contact Us</h2>

    </div>
  </div>
</section>


<section class="contact-us">
	<div class="container-main contact-bg">
		<h3>Email</h3>
		<h2>Send a Message</h2>
		<form action="{{url('/contactus')}}" method="POST" class="contact-form">
			@csrf
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="inputt-div">
						<input type="text" class="form-control rounded border mb-3 form-input" id="name" name="name" placeholder="Name" required >
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="inputt-div">
						<input type="email" class="form-control rounded border mb-3 form-input" id="email" name="email"  placeholder="Email" required>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="inputt-div">
						<input type="number" class="form-control rounded border mb-3 form-input" id="phone" name="phone" placeholder="Mobile" required>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="inputt-div">
						<input type="text" class="form-control rounded border mb-3 form-input" id="heading" name="heading"  placeholder="Subject" required>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<textarea id="message" class="form-control rounded border mb-3 form-input form-text-area"  id="content" name="content"  rows="5" cols="30" placeholder="Message" required></textarea>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<button type="submit">Submit</button>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="contact">
	<div class="container-main">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="contact-box">
					<img src="{{url('assets/images/location.png')}}" alt="">
					<h3>Address</h3>
					<h5>SUMMIT IAS Academy, Fourth floor, Shafeer complex, Kannur Road, Kozhikode- 673001.</h5>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="contact-box">
						<img src="{{url('assets/images/Vector (1).png')}}" alt="">
						<h3>Working hours</h3>
						<h5>9 AM - 6 PM</h5>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="contact-box">
						<img src="{{url('assets/images/Vector (2).png')}}" alt="">
						<h3>Contact</h3>
						<h5><a href="#">Phone : +91 9188 669 488</a></h5>
						<h5><a href="#">Mail : summitias@gmail.com</a></h5>
						<h5><a href="#">support : info@summitias.in</a></h5>
					</div>
				</div>
			</div>
			<div class="social-media">

				<a href="#"><i class="ri-facebook-box-fill"></i></a>
				<a href="#"><i class="ri-telegram-fill"></i></a>
				<a href="#"><i class="ri-instagram-fill"></i></a>
				<a href="#"><i class="ri-whatsapp-fill"></i></a>
			</div>
		</div>
	</section>


@endsection
