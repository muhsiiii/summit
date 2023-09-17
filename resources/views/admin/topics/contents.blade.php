@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin.layouts.content-header')
    <div class="row m-20">
      <div class="col-sm-2 mb-10">
        <select class="form-control" style="width: 100%;" name="types" id="types">
          <option value="All">All Types</option>
          <option value="Video" @if($types == 'Video') selected @endif >Video</option>
          <option value="Notes" @if($types == 'Notes') selected @endif >Notes</option>
          <!-- <option value="Questions" @if($types == 'Questions') selected @endif >Questions</option> -->
          <!-- <option value="Audio" @if($types == 'Audio') selected @endif >Audio</option> -->
        </select>
      </div>

      <div class="col-sm-3">
        <input type="text" id="search" placeholder="Search Something here..." value="{{ $search }}" class="form-control">
      </div>

      <div class="col-sm-1">
        <input type="button" id="searchBtn" class="btn btn-primary" value="Search">
      </div>
    </div>

    <div class="row m-20">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Contents for Topics - {{$topicname}}</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-bordered table-extra">
              <thead>
              <tr>
                <th width="">#</th>
                <th width="20%">Type</th>
                <th width="20%">Title</th>
                <th width="20%">Video/Documents</th>
                <th width="">Actions</th>
              </tr>
              </thead>
              <tbody>
                @if(count($topicContents) > 0)
                  @foreach($topicContents as $key => $value)
                  <?php $no++; ?>
                  <tr>
                    <td align="center">{{$no}}</td>
                    <td>{{$value->type}}</td>
                    <td>{{$value->name}}</td>
                    <td>
                      @if($value->type == 'Notes')
                        <a href="{{$value->url}}" target="_blank">{{$value->url}}</a>
                      @else
                        {{$value->url}}
                      @endif
                    </td>
                    <td align="center">
 <!--                      <a href="#" class="btn btn-sm btn-warning" title="Edit Topic Content" data-toggle="modal" data-target="#modal-add" onclick="mkeEditForm('{{$value->id}}', '{{$value->topic_id}}','{{$value->type}}','{{$value->url}}','{{$value->name}}')" style="color:white;">
                        <i class="fa fa-edit" style="font-size:16px"></i><b> Edit</b>
                      </a>&emsp; -->
                      <a href="{{url('/admin/topics/contents/'.$id.'/delete/'.$value->id)}}" class="btn btn-sm btn-danger" title="Delete Topics Content" style="color:white;">
                        <i class="fa fa-trash" style="font-size:16px"></i><b> Delete</b>
                      </a>
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
            @if(count($topicContents) > 0)
              {{$topicContents->appends( array("types" => $types, "search" => $search, "limit" => $limit ))->links()}}
            @endif
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Add new Banner link -->
    <a href="{{url('/admin/topics/contents/'.$id.'/create')}}" title="Add New Topic Content" onclick="mkeAddForm();">
      <i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <!-- banner add model -->
  <div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{url('/admin/topics/contents/'.$id.'/create')}}" method="POST" id="addform" role="form"  enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="tid" id="tid" value="{{$id}}">

          <div class="modal-header">
            <h4 class="modal-title" id="bannerHeading">Add New Topic</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="card-body">

              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label text-right">Type:</label>
                <div class="col-sm-6">
                  <select class="form-control" style="width: 100%;" name="type" id="type">
                    <option value="">Select Topic Type</option>
                    <option value="Video" @if($types == 'Video') selected @endif >Video</option>
                    <option value="Notes" @if($types == 'Notes') selected @endif >Notes</option>
                  </select>
                  <div class="invalid-feedback">Please select Content Type.</div>
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label text-right">Title:</label>
                <div class="col-sm-6">
                  <input class="form-control" placeholder="Enter Content Title" name="name" type="text" value="" id="name">
                  <span class="invalid-feedback">Please enter Title.</span>
                </div>
              </div>

              <div class="form-group row">
                <label for="video" class="col-sm-3 col-form-label text-right">URL:</label>
                <div class="col-sm-6">
                  <input placeholder="Enter Content URL" name="video" type="file" value="" id="video">
                  <span class="invalid-feedback">Please enter Content URL.</span>
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
  
  @include('admin.layouts.footer')
</div>
@include('admin.layouts.js')
@include('admin.layouts.messages')
<script>
  $('#searchBtn').click(function() {
    var url = '{{url('/admin/topics/contents/'.$id)}}?types=' + $('#types').val() + '&search=' + $('#search').val() + '&slimit=' + $('#slimit').val();
    window.location.href = url;
  });

  $(function () {
    $('#types, #type').select2({
      theme: 'bootstrap4'
    })
  });

  function validate() {
    var error = 0;
    if($('#type').val() == '') {
      $('#type').addClass('is-invalid');
      error = 1;
    } else {
      $('#type').removeClass('is-invalid');
    }

    if($('#video').val() == '' || $('#video').val() == null) {
      $('#video').addClass('is-invalid');
      error = 1;
    } else {
      $('#video').removeClass('is-invalid');
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

  function mkeAddForm() {
    $('#addform').attr('action', '{{url('/admin/topics/contents/'.$id.'/create')}}');
    $('#type,#id,#video').val('');
    $('#bannerHeading').html('Add New Topics Content');
    $('#url').removeClass('is-invalid');
    $('#name').val('');
  }

  function mkeEditForm(id, topic_id, type, url, name) {
    $('#name').removeClass('is-invalid');
    $('#addform').attr('action', '{{url('/admin/topics/contents/'.$id.'/update')}}');
    $('#bannerHeading').html('Update Topics Content');
    $('#id').val(id);
    $('#type').val(type);
    $('#url').val(url);
    $('#topic_id').val(topic_id);
    $('#type').trigger('change');
    $('#name').val(name);
  }

</script>
@if(isset($_GET['c']) && $_GET['c'] == '1')
<script>
  $('#modal-add').modal('show');
</script>
@endif
@endsection