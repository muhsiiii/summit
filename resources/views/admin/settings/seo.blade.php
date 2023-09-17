@extends('admin.layouts.header')

@section('adminheader')
@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  @include('admin.layouts.content-header')
  <div class="row m-10">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">General Settings</h3>
        </div>
        <form method="POST" action="{{url('/admin/settings/seo')}}" accept-charset="UTF-8" role="form" id="addForm">
          @csrf
          <div class="card-body">

            <div class="form-group row">
              <label for="home_keyword" class="form-label">Home Page Keywords:</label>
              <textarea class="form-control" name="home_keyword"  id="home_keyword" placeholder="Enter Home Page Keywords" rows="3">{{$settings->home_keyword ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="home_content" class="form-label">Home Page Content:</label>
              <textarea class="form-control" name="home_content"  id="home_content" placeholder="Enter Home Page Content" rows="3">{{$settings->home_content ?? ''}}</textarea> 
            </div>


            <div class="form-group row">
              <label for="about_keyword" class="form-label">About Us Page Keywords:</label>
              <textarea class="form-control" name="about_keyword"  id="about_keyword" placeholder="Enter About Us Page Keywords" rows="3">{{$settings->about_keyword ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="about_content" class="form-label">About Us Page Content:</label>
              <textarea class="form-control" name="about_content"  id="about_content" placeholder="Enter About Us Page Content" rows="3">{{$settings->about_content ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="about_desc" class="form-label">About Us Page Sub-Heading:</label>
              <textarea class="form-control" name="about_desc"  id="about_desc" placeholder="Enter About Us Page Sub-Heading" rows="2">{{$settings->about_desc ?? ''}}</textarea> 
            </div>


            <div class="form-group row">
              <label for="courses_keyword" class="form-label">Courses Page Keywords:</label>
              <textarea class="form-control" name="courses_keyword"  id="courses_keyword" placeholder="Enter Courses Page Keywords" rows="3">{{$settings->courses_keyword ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="courses_content" class="form-label">Courses Page Content:</label>
              <textarea class="form-control" name="courses_content"  id="courses_content" placeholder="Enter Courses Page Content" rows="3">{{$settings->courses_content ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="courses_desc" class="form-label">Courses Page Sub-Heading:</label>
              <textarea class="form-control" name="courses_desc"  id="courses_desc" placeholder="Enter Courses Page Sub-Heading" rows="2">{{$settings->courses_desc ?? ''}}</textarea> 
            </div>


            <div class="form-group row">
              <label for="downloads_keyword" class="form-label">Downloads Page Keywords:</label>
              <textarea class="form-control" name="downloads_keyword"  id="downloads_keyword" placeholder="Enter Downloads Page Keywords" rows="3">{{$settings->downloads_keyword ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="downloads_content" class="form-label">Downloads Page Content:</label>
              <textarea class="form-control" name="downloads_content"  id="downloads_content" placeholder="Enter Downloads Page Content" rows="3">{{$settings->downloads_content ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="downloads_desc" class="form-label">Downloads Page Sub-Heading:</label>
              <textarea class="form-control" name="downloads_desc"  id="downloads_desc" placeholder="Enter Downloads Page Sub-Heading" rows="2">{{$settings->downloads_desc ?? ''}}</textarea> 
            </div>


            <div class="form-group row">
              <label for="quiz_keyword" class="form-label">Quiz Page Keywords:</label>
              <textarea class="form-control" name="quiz_keyword"  id="quiz_keyword" placeholder="Enter Quiz Page Keywords" rows="3">{{$settings->quiz_keyword ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="quiz_content" class="form-label">Quiz Page Content:</label>
              <textarea class="form-control" name="quiz_content"  id="quiz_content" placeholder="Enter Quiz Page Content" rows="3">{{$settings->quiz_content ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="quiz_desc" class="form-label">Quiz Page Sub-Heading:</label>
              <textarea class="form-control" name="quiz_desc"  id="quiz_desc" placeholder="Enter Quiz Page Sub-Heading" rows="2">{{$settings->quiz_desc ?? ''}}</textarea> 
            </div>


            <div class="form-group row">
              <label for="toppers_keyword" class="form-label">Toppers Page Keywords:</label>
              <textarea class="form-control" name="toppers_keyword"  id="toppers_keyword" placeholder="Enter Toppers Page Keywords" rows="3">{{$settings->toppers_keyword ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="toppers_content" class="form-label">Toppers Page Content:</label>
              <textarea class="form-control" name="toppers_content"  id="toppers_content" placeholder="Enter Toppers Page Content" rows="3">{{$settings->toppers_content ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="toppers_desc" class="form-label">Toppers Page Sub-Heading:</label>
              <textarea class="form-control" name="toppers_desc"  id="toppers_desc" placeholder="Enter Toppers Page Sub-Heading" rows="2">{{$settings->toppers_desc ?? ''}}</textarea> 
            </div>


            <div class="form-group row">
              <label for="gallery_keyword" class="form-label">Gallery Page Keywords:</label>
              <textarea class="form-control" name="gallery_keyword"  id="gallery_keyword" placeholder="Enter Gallery Page Keywords" rows="3">{{$settings->gallery_keyword ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="gallery_content" class="form-label">Gallery Page Content:</label>
              <textarea class="form-control" name="gallery_content"  id="gallery_content" placeholder="Enter Gallery Page Content" rows="3">{{$settings->gallery_content ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="gallery_desc" class="form-label">Gallery Page Sub-Heading:</label>
              <textarea class="form-control" name="gallery_desc"  id="gallery_desc" placeholder="Enter Gallery Page Sub-Heading" rows="2">{{$settings->gallery_desc ?? ''}}</textarea> 
            </div>


            <div class="form-group row">
              <label for="contact_keyword" class="form-label">Contact Us Page Keywords:</label>
              <textarea class="form-control" name="contact_keyword"  id="contact_keyword" placeholder="Enter Contact Us Page Keywords" rows="3">{{$settings->contact_keyword ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="contact_content" class="form-label">Contact Us Page Content:</label>
              <textarea class="form-control" name="contact_content"  id="contact_content" placeholder="Enter Contact Us Page Content" rows="3">{{$settings->contact_content ?? ''}}</textarea> 
            </div>

            <div class="form-group row">
              <label for="contact_desc" class="form-label">Contact Us Page Sub-Heading:</label>
              <textarea class="form-control" name="contact_desc"  id="contact_desc" placeholder="Enter Contact Us Page Sub-Heading" rows="2">{{$settings->contact_desc ?? ''}}</textarea> 
            </div>

          </div>

          <div class="card-footer">
            <a class="btn btn-default" href="{{url('/admin/settings/seo')}}">Back</a>&emsp;
            <button type="submit" id="addBtn" class="btn btn-primary float-right"> Save </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@include('admin.layouts.footer')
@include('admin.layouts.js')
@endsection

