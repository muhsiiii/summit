@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin.layouts.content-header')
    <div class="row m-20">
      <div class="col-sm-4 mb-10">
        <select class="form-control" style="width: 100%;" name="subject_id" id="subject_id">
          <option value="All">All Subjects</option>
          @if(count($subjects) > 0)
            @foreach($subjects as $key => $value)
              <option value="{{$key}}" @if($key == $subject_id) selected @endif >
                {{$value}} - 
                {{App\Http\Controllers\AdminSubjectsController::getSubjectCourse($key)}}
                <?php $course_id = App\Http\Controllers\AdminSubjectsController::getSubjectCourseID($key); ?>
                ({{App\Http\Controllers\AdminCourseController::getCourseCategory($course_id)}})
              </option>
            @endforeach
          @endif
        </select>
      </div>

      <div class="col-sm-3">
        <input type="text" id="search" placeholder="Search Topics Name" value="{{ $search }}" class="form-control">
      </div>

      <div class="col-sm-1">
        <input type="button" id="searchBtn" class="btn btn-primary" value="Search">
      </div>
    </div>

    <div class="row m-20">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Topics List</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-bordered table-extra">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Subject</th>
                <th>No of Content</th>
                <th style="max-width:180px; min-width:160px;">Actions</th>
              </tr>
              </thead>
              <tbody>
                @if(count($topics) > 0)
                  @foreach($topics as $key => $value)
                  <tr>
                    <td align="center">{{$value->id}}</td>
                    <td>{{$value->name}}</td>
                    <td>
                      {{$subjects[$value->subject_id]}} - 
                      {{App\Http\Controllers\AdminSubjectsController::getSubjectCourse($value->subject_id)}}
                      <?php $course_id = App\Http\Controllers\AdminSubjectsController::getSubjectCourseID($value->subject_id); ?>
                      ({{App\Http\Controllers\AdminCourseController::getCourseCategory($course_id)}})
                    </td>
                    <?php $count = App\Http\Controllers\AdminTopicsController::countContent($value->id); ?>
                    <td align="center">{{$count}}</td>
                    <td align="center" style="max-width:180px; min-width:160px;">
                      <div class="row">
                        <div class="col-sm-4" align="center">
                          <a href="{{url('/admin/topics/contents/'.$value->id)}}" class="btn btn-sm btn-info" title="Topics Contents"  style="color:white;">
                            <i class="fa fa-bookmark" style="font-size:16px"></i><b> Contents</b>
                          </a>
                        </div>
                        <div class="col-sm-4" align="center">
                          <a href="#" class="btn btn-sm btn-warning" title="Edit Topics" data-toggle="modal" data-target="#modal-add" onclick="mkeEditForm('{{$value->id}}', '{{$value->subject_id}}','{{$value->name}}')" style="color:white;">
                            <i class="fa fa-edit" style="font-size:16px"></i><b> Edit</b>
                          </a>
                        </div>
                        <div class="col-sm-4" align="center">
                          <form action="{{url('/admin/topics/delete/'.$value->id)}}" method="POST" role="form" id="delform{{$value->id}}">
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
            @if(count($topics) > 0)
              {{$topics->appends( array("subject_id" => $subject_id, "subject_name" => $subject_name, "search" => $search, "limit" => $limit ))->links()}}
            @endif
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Add new Banner link -->
    <a href="" data-toggle="modal" data-target="#modal-add" title="Add New Topic" onclick="mkeAddForm();">
      <i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <!-- banner add model -->
  <div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{url('/admin/topics/create')}}" method="POST" id="addform" role="form" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id="id" value="">

          <div class="modal-header">
            <h4 class="modal-title" id="bannerHeading">Add New Topic</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="card-body">

              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">Subject<span class="text-danger">*</span> :</label>
                <div class="col-sm-7">
                  <select class="form-control" style="width: 100%;" name="subject_id" id="subjectid">
                    <option value="">All Subjects</option>
                    @if(count($subjects) > 0)
                      @foreach($subjects as $key => $value)
                        <option value="{{$key}}" >
                          {{$value}} - 
                          {{App\Http\Controllers\AdminSubjectsController::getSubjectCourse($key)}}
                          <?php $course_id = App\Http\Controllers\AdminSubjectsController::getSubjectCourseID($key); ?>
                          ({{App\Http\Controllers\AdminCourseController::getCourseCategory($course_id)}})
                        </option>
                      @endforeach
                    @endif
                  </select>
                  <div class="invalid-feedback">Please select Subjects.</div>
                </div>
                <div class="col-sm-3">
                  <a class="btn btn-link extra btn-block" href="/admin/subjects?c=1" target="_blank">Add New Subjects</a>
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">Name<span class="text-danger">*</span> :</label>
                <div class="col-sm-7">
                  <input class="form-control" placeholder="Enter Topic Name" name="name" type="text" value="" id="name">
                  <span class="invalid-feedback">Please enter Topic Name.</span>
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
          <p>If you Delete this Topic, All Content associated with it may be Effected.</p>
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
    var subject_name = $("#subject_id option:selected").text();
    var url = '{{url('/admin/topics')}}?subject_id=' + $('#subject_id').val() + '&search=' + $('#search').val() + '&slimit=' + $('#slimit').val() + '&subject_name=' + subject_name;
    window.location.href = url;
  });

  $(function () {
    $('.select2bs4, #subject_id, #subjectid').select2({
      theme: 'bootstrap4'
    })

    $('[data-toggle="tooltip"]').tooltip()
  });

  function validate() {
    var error = 0;
    if($('#name').val() == '') {
      $('#name').addClass('is-invalid');
      error = 1;
    } else {
      $('#name').removeClass('is-invalid');
    }

    if($('#subjectid').val() == '' || $('#subjectid').val() == null) {
      $('#subjectid').addClass('is-invalid');
      error = 1;
    } else {
      $('#subjectid').removeClass('is-invalid');
    }

    if(error == 0) {
      $('#addform').submit();
    }
  }

  function mkeAddForm() {
    $('#addform').attr('action', '{{url('/admin/topics/create')}}');
    $('#name,#id').val('');
    $('#bannerHeading').html('Add New Topics');
    $('#name').removeClass('is-invalid');
  }

  function mkeEditForm(id, subjectid, name) {
    $('#name').removeClass('is-invalid');
    $('#addform').attr('action', '{{url('/admin/topics/update')}}');
    $('#bannerHeading').html('Update Topics');
    $('#id').val(id);
    $('#name').val(name);
    $('#subjectid').val(subjectid);
    $('#subjectid').trigger('change');
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