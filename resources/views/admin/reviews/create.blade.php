@extends('admin.layouts.header')

@section('adminheader')

@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')
<div class="content-wrapper">
	@include('admin.layouts.content-header')
	<div class="row m-10">
		<div class="col-12">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Add New Review</h3>
				</div>

        <form method="POST" action="{{url('/admin/reviews')}}" accept-charset="UTF-8" role="form" id="addForm" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-label text-right">Name<span class="text-danger">*</span> :</label>
                  <input class="form-control" placeholder="Enter Reviewer Name" name="name" type="text" value="" id="name">
                  <div class="invalid-feedback">Reviewer Name Required.</div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="date" class="form-label text-right">Date<span class="text-danger">*</span> :</label>
                  <input class="form-control" placeholder="Enter Review Date" name="date" type="date" value="" id="date">
                  <div class="invalid-feedback">Review Date Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading" class="form-label text-right">Heading :</label>
                  <input class="form-control" placeholder="Enter Review Heading" name="heading" type="text" value="" id="heading">
                  <div class="invalid-feedback">Review Heading Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="message" class="form-label text-right">Message<span class="text-danger">*</span> :</label>
                  <textarea class="form-control" placeholder="Enter Review Message" name="message" rows="3" value="" id="message"></textarea>
                  <div class="invalid-feedback">Review Message Required.</div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="image" class="form-label text-right">Image<span class="text-danger">*</span> :</label>
                <div class="form-group row">
                  <div class="col-md-10 col-8">
                    <div class="input-group">
                      <div class="custom-file">
                        <input class="custom-file-input" id="image" name="image" type="file">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                    </div>
                    <span class="error hide text-danger" id="helpImage">Image Required.</span>
                  </div>

                  <div class="col-md-2 col-4">
                    <button type="button" class="btn btn-secondary btn-tooltip float-left" data-toggle="tooltip" data-placement="top" title="Image with 1:1 Aspet Raio Required. ie Image with Resolution 300 x 300px, 250 x 250px ..etc.">
                      <i class="fa fa-info" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <img id="showImage" class="img-thumbnail hide" width="100%" height="auto" style="max-width:300px;">
              </div>
            </div>

          </div>
          <div class="card-footer">
            <a class="btn btn-default " href="{{url('/admin/reviews')}}">Back</a>&emsp;
            <button type="button" id="addBtn" class="btn btn-primary float-right"> Save </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->
@include('admin.layouts.footer')
@include('admin.layouts.js')
<script>

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });

  var _URL = window.URL || window.webkitURL;
  $('#image').change(function (e) {
    readURL(this);
    $('#image-error').addClass('hide');
    $('#showImage').removeClass('hide');
    var file, img;
    if ((file = this.files[0])) {
      img = new Image();
      img.onload = function () {
        $('#image').removeClass('is-invalid');
        $('#showImage').removeClass('hide');
        $('#helpImage').html('').addClass('hide');
      };
      img.src = _URL.createObjectURL(file);
    }
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }


  $('#addBtn').click(function() {
    var error = 0;

    if($('#date').val() == '' || $('#date').val() == null){
      $('#date').addClass('is-invalid');
      error = 1;
      $('#date').focus();
    } else {
      $('#date').removeClass('is-invalid');
    }

    if($('#name').val() == ''){
       $('#name').addClass('is-invalid');
       error = 1;
       $('#name').focus();
     } else {
       $('#name').removeClass('is-invalid');
     }

    if($('#message').val() == ''){
      $('#message').addClass('is-invalid');
      error = 1;
      $('#message').focus();
    } else {
      $('#message').removeClass('is-invalid');
    }

    if(error == 0) {
     $('#addForm').submit();
    }
  });
</script>
@endsection

