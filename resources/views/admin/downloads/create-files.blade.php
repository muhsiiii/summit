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
          <h3 class="card-title">Create New File</h3>
        </div>

        <form method="POST" action="{{url('/admin/downloads/files/create/'.$id)}}" accept-charset="UTF-8" role="form" id="addForm" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-label text-right">File Name<span class="text-danger">*</span> :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter File Name">
                  <div class="invalid-feedback">File Name Required.</div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="file_type" class="form-label text-right">File Contains<span class="text-danger">*</span> :</label>
                  <select class="form-control" id="file_type" name="file_type" onChange="showFile()">
                    <option value="PDF">Upload PDF</option>
                    <option value="URL">Drive URL</option>
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="desc" class="form-label text-right">File Description<span class="text-danger">*</span> :</label>
                  <textarea class="form-control" id="desc" name="desc" rows="2" placeholder="Enter File Description"></textarea>
                  <div class="invalid-feedback">File Description Required.</div>
                </div>
              </div>

              <div class="col-md-12 hide" id="showURL">
                <div class="form-group">
                  <label for="file_url" class="form-label text-right">File URL<span class="text-danger">*</span> :</label>
                  <input type="text" class="form-control" id="file_url" name="file_url" placeholder="Enter File URL">
                  <div class="invalid-feedback">File URL Required.</div>
                </div>
              </div>

              <div class="col-md-6" id="showPDF">
                <div class="form-group">
                  <label for="file" class="form-label text-right">Upload File<span class="text-danger">*</span> :</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" name="file">
                    <label class="custom-file-label" for="file" id="customFile">Choose file</label>
                  </div>
                  <div class="invalid-feedback">File Required.</div>
                </div>
              </div>

            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-default" href="{{url('/admin/downloads/files/'.$id)}}">Back</a>&emsp;
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
  $('input[type=file]').change(function () {
    $('#customFile').html(this.files[0].name);
  });

  function showFile(){
    if($('#file_type').val() == 'URL') {
      $('#showURL').removeClass('hide');
      $('#showPDF').addClass('hide');
    } else {
      $('#showURL').addClass('hide');
      $('#showPDF').removeClass('hide');
    }
  }

  $('#addBtn').click(function() {
    var error = 0;

    if($('#name').val() == ''){
      error = 1;
      $('#name').addClass('is-invalid');
      $('#name').focus();
    } else {
      $('#name').removeClass('is-invalid');
    }

    if($('#desc').val() == ''){
      error = 1;
      $('#desc').addClass('is-invalid');
      $('#desc').focus();
    } else {
      $('#desc').removeClass('is-invalid');
    }

    if(error == 0) {
     $('#addForm').submit();
   }
  });
</script>
@endsection

