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
					<h3 class="card-title">Add New Course</h3>
				</div>

        <form method="POST" action="{{url('/admin/courses')}}" accept-charset="UTF-8" role="form" id="addForm" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group" >
                  <label for="cat_id" class="form-label text-right">Category<span class="text-danger">*</span> :</label>
                  <select class="form-control" style="width: 100%;" name="cat_id" id="cat_id"></select>
                  <div class="invalid-feedback">Course Category Required.</div>
                </div>
              </div>

              <div class="col-md-8">
                <div class="form-group">
                  <label for="name" class="form-label text-right">Course Name<span class="text-danger">*</span> :</label>
                  <input class="form-control" placeholder="Enter Course Name" name="name" type="text" value="" id="name">
                  <div class="invalid-feedback">Course Name Required.</div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="service_type" class="form-label text-right">Duration<span class="text-danger">*</span> :</label>
                  <select id="duration" class="form-control" name="duration" >
                    <option value="">Select Course Duration</option>
                    @for($i = 1; $i <= 36; $i++)
                      <option value="{{$i}}">{{$i}} Month</option>
                    @endfor
                  </select>
                  <div class="invalid-feedback">Course Duration Required.</div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="amount" class="form-label text-right">Amount<span class="text-danger">*</span> :</label>
                  <input class="form-control" placeholder="Enter Course Price" min="0" id="amount" name="amount" type="number" value="">
                  <div class="invalid-feedback">Course Amount Required.</div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group row">
                  <label for="offer_amount" class="form-label text-right">Offer Amount<span class="text-danger">*</span> :</label>
                  <input class="form-control" placeholder="Enter Course Offer price" min="0" id="offer_amount" name="offer_amount" type="number" value="">
                  <div class="invalid-feedback">Course Amount Required.</div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group ">
                  <label for="name" class="form-label text-right">Status :</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="status" id="status">
                    <option value="">Select Status</option>
                    <option value="Active" selected>Active</option>
                    <option value="Suspended" >Suspended</option>
                    <option value="Deleted" >Deleted</option>
                  </select>
                  <div class="invalid-feedback">Course Status Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="keyword" class="form-label text-right">Keywords :</label>
                  <textarea class="form-control" id="keyword" name="keyword" rows="3" placeholder="Enter Page Keywords"></textarea>
                  <div class="invalid-feedback">Keywords Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="content" class="form-label text-right">Content :</label>
                  <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter Page Content"></textarea>
                  <div class="invalid-feedback">Page Content Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group ">
                  <label for="overview" class="form-label text-right">Overview :</label>
                  <textarea class="form-control" id="overview" name="overview" rows="4" placeholder="Enter Course Overview"></textarea>
                  <div class="invalid-feedback">Course Overview Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group ">
                  <label for="desc" class="form-label text-right">Description :</label>
                  <textarea class="form-control" id="desc" name="desc" rows="4" placeholder="Enter Course Description"></textarea>
                  <div class="invalid-feedback">Course Description Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group ">
                  <label for="highlight" class="form-label text-right">Highlight :</label>
                  <textarea class="form-control" id="highlight" name="highlight" rows="4" placeholder="Enter Course Highlight"></textarea>
                  <div class="invalid-feedback">Course Highlight Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group ">
                  <label for="notes" class="form-label text-right">Notes :</label>
                  <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Enter Course Notes"></textarea>
                  <div class="invalid-feedback">Course Notes Required.</div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="image" class="form-label text-right">Course Image<span class="text-danger">*</span> :</label>
                <div class="form-group row">
                  <div class="col-md-10 col-8">
                    <div class="input-group">
                      <div class="custom-file">
                        <input class="custom-file-input" id="image" name="image" type="file">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                    </div>
                    <span class="error hide text-danger" id="helpImage">Course Image Required.</span>
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
            <a class="btn btn-default " href="{{url('/admin/courses')}}">Back</a>&emsp;
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
  // $('#desc').summernote();
  $('#highlight').summernote();
  $('#notes').summernote();
  $('#overview').summernote();

	$('#cat_id').select2({
		theme: 'bootstrap4',
		placeholder: "Select Course Category",
		ajax: {
			url: '{{url('/api/search/category')}}',
			data: function (params) {
        params.id = {{$authuser->id ?? '0'}}
				return params;
			},
			dataType: 'json',
		}
	});

  $('#duration').select2({
    theme: 'bootstrap4',
    placeholder: "Select Course Duration"
  });

  $('#status').select2({
    theme: 'bootstrap4',
    placeholder: "Select Course Status",
  });

  $('#cat_id, #duration, #status').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Search Something here...');
  });

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
    var error = 0

    if($('#cat_id').val() == '' || $('#cat_id').val() == null){
      $('#cat_id').addClass('is-invalid');
      error = 1;
      $('#cat_id').focus();
    } else {
      $('#cat_id').removeClass('is-invalid');
    }

    if($('#name').val() == ''){
     $('#name').addClass('is-invalid');
     error = 1;
     $('#name').focus();
   } else {
     $('#name').removeClass('is-invalid');
   }

   if($('#duration').val() == ''){
    $('#duration').addClass('is-invalid');
    error = 1;
    $('#cat_id').focus();
  } else {
    $('#duration').removeClass('is-invalid');
  }

  if($('#amount').val() == ''){
    $('#amount').addClass('is-invalid');
    error = 1;
    $('#cat_id').focus();
  } else {
    $('#amount').removeClass('is-invalid');
  }

  if($('#offer_amount').val() == ''){
    $('#offer_amount').addClass('is-invalid');
    error = 1;
    $('#cat_id').focus();
  } else {
    $('#offer_amount').removeClass('is-invalid');
  }

  if($('#status').val() == ''){
    $('#status').addClass('is-invalid');
    error = 1;
    $('#cat_id').focus();
  } else {
    $('#status').removeClass('is-invalid');
  }  

  if(error == 0) {
   $('#addForm').submit();
  }
});
</script>
@endsection

