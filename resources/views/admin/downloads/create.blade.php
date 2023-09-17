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
          <h3 class="card-title">Create New Folder</h3>
        </div>

        <form method="POST" action="{{url('/admin/downloads/create')}}" accept-charset="UTF-8" role="form" id="addForm" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-label text-right">Folder Name<span class="text-danger">*</span> :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Folder Name">
                  <div class="invalid-feedback">Folder Name Required.</div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-label text-right">Folder Child Contains<span class="text-danger">*</span> :</label>
                  <select class="form-control" id="type" name="type">
                    <option value="Folders">Folders</option>
                    <option value="Files">Files</option>
                  </select>
                  <div class="invalid-feedback">Folder Child Type Required.</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="desc" class="form-label text-right">Folder Description<span class="text-danger">*</span> :</label>
                  <textarea class="form-control" id="desc" name="desc" rows="2" placeholder="Enter Folder Small description"></textarea>
                  <div class="invalid-feedback">Folder Description Required.</div>
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

            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-default" href="{{url('/admin/downloads')}}">Back</a>&emsp;
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

