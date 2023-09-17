@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin.layouts.content-header')



  </div>
</div>
<!-- /.content-wrapper -->
@include('admin.layouts.footer')
@include('admin.layouts.js')
@include('admin.layouts.messages')

<style>
</style>

@endsection

