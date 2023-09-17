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
        <form method="POST" action="{{url('/admin/settings/general')}}" accept-charset="UTF-8" role="form" id="addForm">
          @csrf
          <div class="card-body">

            <div class="form-group row">
              <label for="marquee" class="form-label">Article Marquee:</label>
              <input class="form-control" name="marquee"  id="marquee" placeholder="Enter Marquee" value="{{$settings->marquee ?? ''}}" />
            </div>

            <div class="form-group row">
              <label for="why_submit" class="form-label">Why Summit IAS ?:</label>
              <textarea class="form-control" name="why_submit"  id="why_submit" placeholder="Enter Why Summit IAS Description" rows="5">{{$settings->why_submit ?? ''}}</textarea>
            </div>

            <div class="form-group row">
              <label for="footer_desc" class="form-label">Footer Description:</label>
              <textarea class="form-control" name="footer_desc"  id="footer_desc" placeholder="Enter Footer Description" rows="2">{{$settings->footer_desc ?? ''}}</textarea>
            </div>

            <div class="form-group row">
              <label for="footer_about" class="form-label">Footer AboutUs:</label>
              <textarea class="form-control" name="footer_about"  id="footer_about" placeholder="Enter About Us" rows="3">{{$settings->footer_about ?? ''}}</textarea>
            </div>


            <div class="row">
              <div class="col-md-6">
                <label for="footer_mobile" class="form-label">Footer Mobile Number :</label>
                <input class="form-control" placeholder="Enter Footer Mobile Number" name="footer_mobile" type="text" id="footer_mobile" value="{{$settings->footer_mobile ?? ''}}">
              </div>
              <div class="col-md-6">
                <label for="footer_email" class="form-label">Footer Email Address :</label>
                <input class="form-control" placeholder="Enter Footer Email Address" name="footer_email" type="text" id="footer_email" value="{{$settings->footer_email ?? ''}}">
              </div>
            </div>

            <div class="form-group row">
              <label for="footer_address" class="form-label">Footer Address:</label>
              <textarea class="form-control" name="footer_address"  id="footer_address" placeholder="Enter Footer Address" rows="4">{{$settings->footer_address ?? ''}}</textarea>
            </div>

            <div class="form-group row">
              <label for="google_play" class="form-label">Google Play Store Link:</label>
              <textarea class="form-control" name="google_play"  id="google_play" placeholder="Enter Play Store Link" rows="1">{{$settings->google_play ?? ''}}</textarea>
            </div>

            <div class="form-group row">
              <label for="app_store" class="form-label">App Store Link:</label>
              <textarea class="form-control" name="app_store"  id="app_store" placeholder="Enter App Store Link" rows="1">{{$settings->app_store ?? ''}}</textarea>
            </div>

            <div class="form-group row">
              <label for="facebook_link" class="form-label">Facebook Link:</label>
              <textarea class="form-control" name="facebook_link"  id="facebook_link" placeholder="Enter Facebook Link" rows="1">{{$settings->facebook_link ?? ''}}</textarea>
            </div>

            <div class="form-group row">
              <label for="whatsapp_number" class="form-label">Whatsapp Link:</label>
              <textarea class="form-control" name="whatsapp_number"  id="whatsapp_number" placeholder="Enter Whatsapp Link" rows="1">{{$settings->whatsapp_number ?? ''}}</textarea>
            </div>

            <div class="form-group row">
              <label for="instagram_link" class="form-label">Instagram Link:</label>
              <textarea class="form-control" name="instagram_link"  id="instagram_link" placeholder="Enter Instagram Link" rows="1">{{$settings->instagram_link ?? ''}}</textarea>
            </div>
            <div class="form-group row">
              <label for="telegram_link" class="form-label">Telegram Link:</label>
              <textarea class="form-control" name="telegram_link"  id="telegram_link" placeholder="Enter Telegram Link" rows="1">{{$settings->telegram_link ?? ''}}</textarea>
            </div>
          </div>

          <div class="card-footer">
            <a class="btn btn-default" href="{{url('/admin/settings/general')}}">Back</a>&emsp;
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

