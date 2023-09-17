<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		{{config('app.name', '')}}
		@if(isset($contentHeader)) | {{$contentHeader}}@endif
		@if(isset($contentSubHeader)) - {{$contentSubHeader}}@endif
	</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicons -->
  <link href="{{url('assets/images/favicon.png')}}" type="image/png" rel="icon" alt="summit-ias-logo">
  <link href="{{url('assets/images/favicon.png')}}" type="image/png" rel="apple-touch-icon">

	<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
	<!-- Ionicons -->
	<!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
	<!-- Bootstrap Color Picker -->
  	<link rel="stylesheet" href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
	<!-- summernote -->
	<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Toastr -->
	<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
	<!-- custom css -->
  <link rel="stylesheet" href="{{asset('assets/css/adminstyle.css')}}">
  <!-- ijaboCropTool css -->
  <link rel="stylesheet" href="{{ asset('/crop-tool/ijaboCropTool.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

@yield('adminheader')

</body>
</html>