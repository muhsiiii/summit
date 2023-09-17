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
					<h3 class="card-title">Add New Topper</h3>
				</div>

        <form method="POST" action="{{url('/admin/toppers')}}" accept-charset="UTF-8" role="form" id="addForm" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-label text-right">Name<span class="text-danger">*</span> :</label>
                  <input class="form-control" placeholder="Enter Topper Name" name="name" type="text" value="" id="name">
                  <div class="invalid-feedback">Topper Name Required.</div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="disp_order" class="form-label text-right">Display Order<span class="text-danger">*</span> :</label>
                  <input class="form-control" placeholder="Enter Display Order" name="disp_order" type="number" value="" id="disp_order">
                  <div class="invalid-feedback">Display Order Required.</div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="rank" class="form-label text-right">Rank<span class="text-danger">*</span> :</label>
                  <input class="form-control" placeholder="Enter Display Order" name="rank" type="number" value="" id="rank">
                  <div class="invalid-feedback">Display Order Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading" class="form-label text-right">Heading :</label>
                  <input class="form-control" placeholder="Enter Topper Heading" name="heading" type="text" value="" id="heading">
                  <div class="invalid-feedback">Topper Heading Required.</div>
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
                        <input type="hidden" id="setImage" name="setImage" value="0">
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
            <a class="btn btn-default " href="{{url('/admin/toppers')}}">Back</a>&emsp;
            <button type="button" id="addBtn" class="btn btn-primary float-right"> Save </button>
          </div>
          <input type="hidden" name="myimagename" id="myimagename" value="{{$myimagename}}">
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

  var url = '{{url('/uploads/toppers/')}}';
  $('#image').ijaboCropTool({
    preview : '.image-previewer',
    setRatio:1,
    allowedExtensions: ['jpg', 'jpeg','png','webp'],
    buttonsText:['CROP','QUIT'],
    buttonsColor:['#30bf7d','#ee5155', -15],
    processUrl:'{{ route("toppersImages") }}',
    withCSRF:['_token','{{ csrf_token() }}'],
    fileName: '{{$myimagename}}',
    onSuccess:function(message, element, status){
      var myimagename = $('#myimagename').val();
      myimagename = url + '/' + myimagename + '_image.jpg';

      $('#showImage').attr('src', myimagename);
      $('#showImage').removeClass('hide');
      $('#setImage').val('1');
    },
    onError:function(message, element, status){
      alert(message);
      toastr.error('Something Went Wrong!. Check your Image Size and Image Format before upload.');
      $('#showImage').addClass('hide');
      $('#setImage').val('0');
    }
  });

  // var _URL = window.URL || window.webkitURL;
  // $('#image').change(function (e) {
  //   readURL(this);
  //   $('#image-error').addClass('hide');
  //   $('#showImage').removeClass('hide');
  //   var file, img;
  //   if ((file = this.files[0])) {
  //     img = new Image();
  //     img.onload = function () {
  //       $('#image').removeClass('is-invalid');
  //       $('#showImage').removeClass('hide');
  //       $('#helpImage').html('').addClass('hide');
  //     };
  //     img.src = _URL.createObjectURL(file);
  //   }
  // });

  // function readURL(input) {
  //   if (input.files && input.files[0]) {
  //     var reader = new FileReader();
  //     reader.onload = function (e) {
  //       $('#showImage').attr('src', e.target.result);
  //     }
  //     reader.readAsDataURL(input.files[0]);
  //   }
  // }


  $('#addBtn').click(function() {
    var error = 0;

    if($('#disp_order').val() == '' || $('#disp_order').val() == null){
      $('#disp_order').addClass('is-invalid');
      error = 1;
      $('#disp_order').focus();
    } else {
      $('#disp_order').removeClass('is-invalid');
    }

    if($('#name').val() == ''){
       $('#name').addClass('is-invalid');
       error = 1;
       $('#name').focus();
     } else {
       $('#name').removeClass('is-invalid');
     }

    if($('#rank').val() == ''){
      $('#rank').addClass('is-invalid');
      error = 1;
      $('#rank').focus();
    } else {
      $('#rank').removeClass('is-invalid');
    }

    if(error == 0) {
     $('#addForm').submit();
    }
  });
</script>
@endsection

