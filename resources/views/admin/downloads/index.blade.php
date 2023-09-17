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

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="folder">
              @if($value->type == 'Folders')
              <a href="{{url('/admin/downloads/'.$value->id)}}">
              @else
              <a href="{{url('/admin/downloads/files/'.$value->id)}}">
              @endif
                <i class="fas fa-folder folder-icon"></i>
                <h5 class="folder-name mb-0">{{$value->name}}</h5>
                <?php $count = App\Http\Controllers\AdminDownloadsController::countFolders($value->id); ?>
                <p class="folder-sub-folders mb-0" style="font-size:13px;">Child Folder Type: <b>{{$value->type}}</b></p> 
                <p class="folder-sub-folders mb-2" style="font-size:13px;">Total Child {{$value->type}}: <b>{{$count}}</b></p> 
              </a>
              <a href="{{url('/admin/downloads/show/'.$value->id)}}" class="btn btn-sm btn-warning white">
                <b><i class="fas fa-edit"></i> Edit</b>
              </a>
              <a href="{{url('/admin/downloads/delete/'.$value->id)}}" class="btn btn-sm btn-danger white @if($count > 0) disabled @endif " @if($count > 0) disabled @endif >
                <b><i class="fas fa-trash"></i> Delete</b>
              </a>
            </div>
          </div>

        @endforeach
      @endif
    </div>

    <a href="{{url('/admin/downloads/create')}}" title="Create New Folder">
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

