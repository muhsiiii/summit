@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin.layouts.content-header')
    <div class="row m-20">
      <div class="col-md-3 mb-10">
        <select class="form-control" style="width: 100%;" name="course_id" id="course_id">
          <option value="All">All Course</option>
          @if(count($courses) > 0)
            @foreach($courses as $key => $value)
              <option value="{{$key}}" @if($key == $course_id) selected @endif >
                {{$value}} 
                ({{App\Http\Controllers\AdminCourseController::getCourseCategory($key)}})
              </option>
            @endforeach
          @endif
        </select>
      </div>

      <div class="col-md-3">
        <input type="text" id="search" placeholder="Search Subject Name" value="{{ $search }}" class="form-control">
      </div>

      <div class="col-md-1">
        <input type="button" id="searchBtn" class="btn btn-primary" value="Search">
      </div>
    </div>

    <div class="row m-20">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Subjects List</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-bordered table-extra">
              <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Course</th>
                <th>No of Topics</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                @if(count($subjects) > 0)
                  @foreach($subjects as $key => $value)
                  <tr>
                    <td align="center">{{$value->id}}</td>
                    <td align="center">
                      @if($value->image != '')
                        <img src="{{url($value->image)}}" style="max-height:50px; max-width: 50px;">
                      @else 
                        <img src="{{url('/assets/images/image-not-found.jpg')}}" style="max-height:45px; max-width: 45px;">
                      @endif
                    </td>
                    <td>{{$value->name}}</td>
                    <td>
                      {{$courses[$value->course_id]}} ({{App\Http\Controllers\AdminCourseController::getCourseCategory($value->course_id)}})
                    </td>
                    <?php $count = App\Http\Controllers\AdminSubjectsController::countTopics($value->id); ?>
                    <td align="center">{{$count}}</td>
                    <td align="center">
                      <div class="row">
                        <div class="col-sm-6" align="right">
                          <a href="#" class="btn btn-sm btn-warning" title="Edit Subjects" data-toggle="modal" data-target="#modal-add" onclick="mkeEditForm('{{$value->id}}', '{{$value->course_id}}','{{url($value->image)}}','{{$value->name}}')" style="color:white;">
                            <i class="fa fa-edit" style="font-size:16px"></i><b> Edit</b>
                          </a>
                        </div>
                        <div class="col-sm-6" align="left">
                          <form action="{{url('/admin/subjects/delete/'.$value->id)}}" method="POST" role="form" id="delform{{$value->id}}">
                            {!! csrf_field() !!}
                            <button type="button" class="btn btn-sm btn-danger" title="Delete Category" data-toggle="modal" data-target="#modal-delete" onclick="mkeDelModal('{{$value->id}}','{{$value->name}}');" @if($count > 0) disabled @endif >
                              <i class="fa fa-trash" style="font-size:16px" aria-hidden="true"></i> <b>Delete</b>
                            </button>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>  
                  @endforeach
                @else
                  <tr>
                    <td colspan="7" align="center">No Results Found!</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix ">
            @if(count($subjects) > 0)
              {{$subjects->appends( array("course_id" => $course_id, "course_name" => $course_name, "search" => $search, "limit" => $limit ))->links()}}
            @endif
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Add new Banner link -->
    <a href="" data-toggle="modal" data-target="#modal-add" title="Add New Suject" onclick="mkeAddForm();">
      <i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <!-- banner add model -->
  <div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{url('/admin/subjects/create')}}" method="POST" id="addform" role="form" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="imageOld" id="imageOld" value="">

          <div class="modal-header">
            <h4 class="modal-title" id="bannerHeading">Add New Subject</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="card-body">

              <div class="form-group row">
                <label for="course_id" class="col-sm-3 col-form-label text-right">Course<span class="text-danger">*</span> :</label>
                <div class="col-sm-6">
                  <select class="form-control" style="width: 100%;" name="course_id" id="courseid">
                    <option value="">Select Course</option>
                    @if(count($courses) > 0)
                      @foreach($courses as $key => $value)
                        <option value="{{$key}}" >
                          {{$value}}
                          ({{App\Http\Controllers\AdminCourseController::getCourseCategory($key)}})
                        </option>
                      @endforeach
                    @endif
                  </select>
                  <div class="invalid-feedback">Please select Course.</div>
                </div>
                <div class="col-sm-3">
                  <a class="btn btn-link extra btn-block" href="/admin/courses/create" target="_blank">Add New Course</a>
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label text-right">Name<span class="text-danger">*</span> :</label>
                <div class="col-sm-6">
                  <input class="form-control" placeholder="Enter Subject Name" name="name" type="text" value="" id="name">
                  <span class="invalid-feedback">Please enter Subject Name.</span>
                </div>
              </div>

              <div class="form-group row">
                <label for="image" class="col-sm-3 col-form-label text-right">Image<span class="text-danger">*</span> :</label>
                <div class="col-sm-6">
                  <div class="input-group">
                    <div class="custom-file">
                      <input class="custom-file-input" id="image" name="image" type="file">
                      <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                  </div>
                  <span class="error span-extra hide text-danger" id="helpImage"></span>
                </div>

                <div class="col-sm-1">
                  <button type="button" class="btn btn-secondary btn-tooltip float-left" data-toggle="tooltip" data-placement="top" title="Image in the Aspect Ratio of 1:1 Required, ie Resolution 250*250px, 300*300px etc.">
                    <i class="fa fa-info" aria-hidden="true"></i>
                  </button>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4 offset-sm-3">
                  <img id="showImage" class="img-thumbnail hide" width="50%" height="auto" style="min-width:140px;">
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input class="btn btn-primary offset-sm-2" type="button" onclick="validate();" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="deltitle">Delete</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Are You Sure ?</h5>
          <p>If you Delete this Subject, All topic associated with it may be Effected.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" onclick="delCategory()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="delId">
  
  @include('admin.layouts.footer')
</div>
@include('admin.layouts.js')
@include('admin.layouts.messages')
<script>
  $('#searchBtn').click(function() {
    var course_name = $("#course_id option:selected").text();
    var url = '{{url('/admin/subjects')}}?course_id=' + $('#course_id').val() + '&search=' + $('#search').val() + '&slimit=' + $('#slimit').val() + '&course_name=' + course_name;
    window.location.href = url;
  });

  $(function () {
    $('.select2bs4, #course_id, #courseid').select2({
      theme: 'bootstrap4'
    })

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

  function validate() {
    var error = 0;
    if($('#name').val() == '') {
      $('#name').addClass('is-invalid');
      error = 1;
    } else {
      $('#name').removeClass('is-invalid');
    }

    if($('#courseid').val() == '' || $('#courseid').val() == null) {
      $('#courseid').addClass('is-invalid');
      error = 1;
    } else {
      $('#courseid').removeClass('is-invalid');
    }

    if(error == 0) {
      $('#addform').submit();
    }
  }

  function mkeAddForm() {
    $('#addform').attr('action', '{{url('/admin/subjects/create')}}');
    $('#name,#id,#image,#imageOld').val('');
    $('#showImage').attr('src', '');
    $('#showImage').addClass('hide');
    $('#bannerHeading').html('Add New Subject');
    $('#image').removeClass('is-invalid');
    $('#name').removeClass('is-invalid');
    $('#helpImage').html('').addClass('hide');
  }

  function mkeEditForm(id, courseid, image, name) {
    $('#image').removeClass('is-invalid');
    $('#name').removeClass('is-invalid');
    $('#helpImage').html('').addClass('hide');
    $('#addform').attr('action', '{{url('/admin/subjects/update')}}');
    $('#bannerHeading').html('Update Subject');
    $('#id').val(id);
    $('#imageOld').val(image);
    $('#name').val(name);
    $('#showImage').attr('src', image);
    $('#showImage').removeClass('hide');
    $('#courseid').val(courseid);
    $('#courseid').trigger('change');
  }

  function mkeDelModal(id, name) {
    $('#deltitle').html('Delete ' + name);
    $('#delId').val(id);
  }

  function delCategory() {
    $('#delform'+$('#delId').val()).submit();
  }
</script>
@if(isset($_GET['c']) && $_GET['c'] == '1')
<script>
  $('#modal-add').modal('show');
</script>
@endif
@endsection