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
          <h3 class="card-title">Update News</h3>
        </div>
        <form method="POST" action="{{url('/admin/affairs/'.$affairs->id)}}" accept-charset="UTF-8" role="form" id="addForm" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">

              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading" class="form-label text-right">Heading<span class="text-danger">*</span> :</label>
                  <textarea class="form-control" id="heading" name="heading" rows="2" placeholder="Enter Affairs Heading">{{$affairs->heading}}</textarea>
                  <div class="invalid-feedback">Affairs Heading Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="keyword" class="form-label text-right">Keywords :</label>
                  <textarea class="form-control" id="keyword" name="keyword" rows="3" placeholder="Enter Page Keywords">{{$affairs->keyword}}</textarea>
                  <div class="invalid-feedback">Keywords Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="content" class="form-label text-right">Content :</label>
                  <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter Page Content">{{$affairs->content}}</textarea>
                  <div class="invalid-feedback">Page Content Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group ">
                  <label for="desc" class="form-label text-right">Affairs Content<span class="text-danger">*</span> :</label>
                  <textarea class="form-control" id="desc" name="desc" rows="4" placeholder="Enter Affairs Content">{{$affairs->desc}}</textarea>
                  <div class="invalid-feedback">Affairs Content Required.</div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="image" class="form-label text-right">Affairs Banner Image<span class="text-danger">*</span> :</label>
                <div class="form-group row">
                  <div class="col-md-10 col-8">
                    <div class="input-group">
                      <div class="custom-file">
                        <input class="custom-file-input" id="image" name="image" type="file">
                        <input id="imageOld" name="imageOld" type="hidden" value="{{$affairs->image}}">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                    </div>
                    <span class="error hide text-danger" id="helpImage">Affairs Image Required.</span>
                  </div>

                  <div class="col-md-2 col-4">
                    <button type="button" class="btn btn-secondary btn-tooltip float-left" data-toggle="tooltip" data-placement="top" title="Image with 2:1 Aspet Raio Required. ie Image with Resolution 3000px x 1500px, 2000px x 1000px ..etc.">
                      <i class="fa fa-info" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <img id="showImage"  class="img-thumbnail <?php if($affairs->image == '') echo 'hide'; ?>" src="{{url($affairs->image)}}" width="100%" height="auto" style="min-width:140px; max-width:300px;">
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-default" href="{{url('/admin/affairs')}}">Back</a>&emsp;
            <button type="button" id="addBtn" class="btn btn-primary float-right"> Save </button>
          </div>
          <input name="_method" type="hidden" value="PUT">
        </form>
      </div>
    </div>
  </div>
</div>
@include('admin.layouts.footer')
@include('admin.layouts.js')
<script>
  $('#desc').summernote();

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

    if($('#heading').val() == ''){
     $('#heading').addClass('is-invalid');
     error = 1;
     $('#heading').focus();
   } else {
     $('#heading').removeClass('is-invalid');
   }

   if($('#article_content').val() == ''){
    $('#article_content').addClass('is-invalid');
    error = 1;
    $('#article_content').focus();
  } else {
    $('#article_content').removeClass('is-invalid');
  }

  if(error == 0) {
   $('#addForm').submit();
  }
});
</script>
@endsection

