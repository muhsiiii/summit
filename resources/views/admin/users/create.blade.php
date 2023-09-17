@extends('admin.layouts.header')

@section('adminheader')
@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	@include('admin.layouts.content-header')
	<div class="row m-10">
		<div class="col-12">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Add New User</h3>
				</div>
        <form method="POST" action="{{url('/admin/users')}}" accept-charset="UTF-8" role="form" id="addForm">
          @csrf
          <div class="card-body">

            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label text-right">Name<span class="text-danger">*</span> :</label>
              <div class="col-sm-6">
                <input class="form-control" placeholder="Enter User Name" name="name" type="text" value="" id="name">
                <div id="name-span" class="invalid-feedback">User Name Required.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="phone" class="col-sm-3 col-form-label text-right">Phone Number<span class="text-danger">*</span> :</label>
              <div class="col-sm-6">
                <input class="form-control" placeholder="Enter Phone Number" name="phone" type="text" value="" id="phone">
                <div id="phone-span" class="invalid-feedback">Phone Number Required.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label text-right">Email Address<span class="text-danger">*</span> :</label>
              <div class="col-sm-6">
                <input class="form-control" placeholder="Enter Email Address" name="email" type="email" value="" id="email">
                <div id="email-span" class="invalid-feedback">Email Address Required.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="device_id" class="col-sm-3 col-form-label text-right">Device ID :</label>
              <div class="col-sm-6">
                <input class="form-control" placeholder="Enter Device ID" name="device_id" type="text" value="" id="device_id">
                <div id="device_id-span" class="invalid-feedback">Device ID Required.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="status" class="col-sm-3 col-form-label text-right">Status :</label>
              <div class="col-sm-6">
                <select class="form-control select2bs4" style="width: 100%;" name="status" id="status">
                  <option value="Active" selected>Active</option>
                  <option value="Pending">Pending</option>
                  <option value="Suspended">Suspended</option>
                  <option value="Deleted">Deleted</option>
                </select>
                <div class="invalid-feedback">Status Required.</div>
              </div>
            </div>

          </div>

          <div class="card-footer">
            <a class="btn btn-default offset-sm-3" href="{{url('/admin/users')}}">Back</a>&emsp;
            <button type="button" id="addBtn" class="btn btn-primary"> Save </button>
          </div>
          <!-- /.card-body -->
        </form>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="phone-valid" value="0">
<input type="hidden" id="device-valid" value="0">
@include('admin.layouts.footer')
@include('admin.layouts.js')
<script>
  $(function () {
    $('#status').select2({
      theme: 'bootstrap4'
    });
  });

  $('#phone').blur(function(){
    $.ajax({
     type: "POST",
     url: "{{url('/api/check/users/phone')}}?phone=" + $('#phone').val(),
     data: '',
     success: function(resp){
      var obj = JSON.parse(resp);
      if(obj.sts == '01' || obj.sts == 01) {
       $('#phone').addClass('is-invalid');
       $('#phone-span').html('Mobile Number Already Taken! Try Another.');
       $('#phone-valid').val(1);
     } else {
       $('#phone').removeClass('is-invalid');
       $('#phone-valid').val(0);
     }
   }
 });
  });

  $('#device_id').blur(function(){
    $.ajax({
      type: "POST",
      url: "{{url('/api/check/users/device')}}?device_id=" + $('#device_id').val(),
      data: '',
      success: function(resp){
        var obj = JSON.parse(resp);
        if(obj.sts == '01' || obj.sts == 01) {
          $('#device_id').addClass('is-invalid');
          $('#device_id-span').html('Device ID Already Exists! Try Another.');
          $('#device-valid').val(1);
        } else {
          $('#device_id').removeClass('is-invalid');
          $('#device-valid').val(0);
        }
      }
    });
  });

  $('#addBtn').click(function() {
    var error = 0

    if($('#name').val() == ''){
     $('#name').addClass('is-invalid');
     $('#name-span').html('User Name Required.');
     error = 1;
   } else {
     $('#name').removeClass('is-invalid');
   }

   if($('#email').val() == ''){
     $('#email').addClass('is-invalid');
     $('#email-span').html('Email Address Requied.');
     error = 1;
   } else {
     $('#email').removeClass('is-invalid');
   }

   if($('#phone').val() == ''){
     $('#phone').addClass('is-invalid');
     $('#phone-span').html('Phone Number Requied.');
     error = 1;
   } else if($('#phone').val() != '' && $('#phone').val().length != 10) {
     $('#phone').addClass('is-invalid');
     $('#phone-span').html('Enter 10 digit Number without country Code.');
     error = 1;
   } else {
     $('#phone').removeClass('is-invalid');
   }

   if($('#status').val() == ''){
     $('#status').addClass('is-invalid');
     error = 1;
   } else {
     $('#status').removeClass('is-invalid');
   }

   if($('#phone').val() != '' && $('#phone').val().length == 10 && $('#phone-valid').val() == 1) {
    $('#phone').addClass('is-invalid');
    $('#phone-span').html('Mobile Number Already Taken! Try Another.');
    $('#phone-valid').val(1);
    error = 1;
  } else if($('#phone').val() != '' && $('#phone').val().length == 10) {
    $('#phone').removeClass('is-invalid');
    $('#phone-valid').val(0);
  }

  if(error == 0) {
   $('#addForm').submit();
 }
});
</script>
@endsection

