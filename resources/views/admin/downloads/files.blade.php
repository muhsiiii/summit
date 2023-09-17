@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin.layouts.content-header')

    <div class="row m-10">
      @if(count($downloads) > 0)
        @foreach($downloads as $key => $value)

          <div class="col-md-2 col-sm-4 col-xs-6">
            <div class="folder">
              @if($value->file_type == 'PDF')
              <a href="{{url($value->file_url)}}" target="_blank">
              @else
              <a href="{{$value->file_url}}" target="_blank">
              @endif
                @if($value->file_type == 'URL')
                <i class="fas fa-file-download folder-icon"></i>
                @else
                <i class="fas fa-file-pdf folder-icon"></i>
                @endif
                <h5 class="folder-name mb-2">{{$value->name}}</h5>
              </a>
              <a href="{{url('/admin/downloads/files/delete/'.$id.'/'.$value->id)}}" class="btn btn-sm btn-danger white" style="width:160px;">
                <b><i class="fas fa-trash"></i> &nbsp; Delete</b>
              </a>
            </div>
          </div>

        @endforeach
      @endif
    </div>

    @if($parentParentID > 0)
    <a href="{{url('/admin/downloads/'.$parentParentID)}}" title="Back to Folder">
      <i class="fa fa-arrow-alt-circle-left fa-back" aria-hidden="true"></i>
    </a>
    @else
    <a href="{{url('/admin/downloads')}}" title="Back to Folder">
      <i class="fa fa-arrow-alt-circle-left fa-back" aria-hidden="true"></i>
    </a>
    @endif

    <a href="{{url('/admin/downloads/files/create/'.$id)}}" title="Create New File">
      <i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
    </a>

  </div>
</div>
<!-- /.content-wrapper -->
@include('admin.layouts.footer')
@include('admin.layouts.js')
@include('admin.layouts.messages')

<style>
</style>

@endsection

