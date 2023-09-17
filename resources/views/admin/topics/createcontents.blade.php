@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin.layouts.content-header')
  <div class="row m-10">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add New Topic Content</h3>
        </div>
          <form action="{{url('/admin/topics/contents/'.$id.'/store')}}" method="POST" id="addform" role="form"  enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="tid" id="tid" value="{{$id}}">
            
            <div class="card-body">
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label text-right">Type:</label>
                <div class="col-sm-6">
                  <select class="form-control" style="width: 100%;" name="type" id="type">
                    <option value="Video" selected >Video</option>
                    <option value="Notes" >Notes</option>
                  </select>
                  <div class="invalid-feedback">Please select Content Type.</div>
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label text-right">Title<span class="text-danger">*</span> :</label>
                <div class="col-sm-6">
                  <input class="form-control" placeholder="Enter Content Title" name="name" type="text" value="" id="name">
                  <span class="invalid-feedback">Please enter Title.</span>
                </div>
              </div>

              <div class="form-group row">
                <label for="file" class="col-sm-3 col-form-label text-right">File<span class="text-danger">*</span> :</label>
                <div class="col-sm-6">
                  <input placeholder="Enter Content File" name="file" type="file" value="" id="file">
                  <span class="invalid-feedback">Please upload File.</span>
                </div>
              </div>
            </div>
          <div class="card-footer">
            <a class="btn btn-default offset-sm-3" href="{{url('/admin/topics/contents/'.$id)}}">Back</a>&emsp;
            <button type="button" id="addBtn" class="btn btn-primary" onclick="validate();"> Save </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@include('admin.layouts.footer')
</div>
@include('admin.layouts.js')
@include('admin.layouts.messages')
<script>

$('input[type=file]').change(function () {
    console.log(this.files[0]);
});


  function validate() {
    var error = 0;
    if($('#type').val() == '') {
      $('#type').addClass('is-invalid');
      error = 1;
    } else {
      $('#type').removeClass('is-invalid');
    }

    if($('#file').val() == '' || $('#file').val() == null) {
      $('#file').addClass('is-invalid');
      error = 1;
    } else {
      $('#file').removeClass('is-invalid');
    }

    if($('#name').val() == '' || $('#name').val() == null) {
      $('#name').addClass('is-invalid');
      error = 1;
    } else {
      $('#name').removeClass('is-invalid');
    }

    if(error == 0) {
      $('#addform').submit();
    }
  }

</script>
@if(isset($_GET['c']) && $_GET['c'] == '1')
<script>
  $('#modal-add').modal('show');
</script>
@endif
@endsection