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
            <h3 class="card-title">Get in Touch Form Fill Details</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-bordered table-extra" id="rtable" style="font-size: 14px !important;">
              <thead>
                <tr>
                  <th>Basic Details</th>
                  <th>Message Heading</th>
                  <th>Message Content</th>
                </tr>
              </thead>
              <tbody>
                @if(count($contactus) > 0)
                @foreach($contactus as $key => $value)
                <tr>
                  <td>
                    <b>Name:</b> {{$value->name}} <br />
                    <b>Phone:</b> {{$value->phone}} <br />
                    <b>Email:</b> {{$value->email}} <br />
                    <b>Created At:</b> {{ \Carbon\Carbon::parse($value->created_at)->format('M-d-Y H:i a') }}
                  </td>
                  <td style="word-break: break-all; white-space: break-spaces;">{{$value->heading}}</td>
                  <td style="word-break: break-all; white-space: break-spaces;">{{$value->content}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="11" align="center">No Results Found!</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
            @if(count($contactus) > 0)
            {{$contactus->links()}}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- /.content-wrapper -->

  @include('admin.layouts.footer')
  @include('admin.layouts.js')
  @include('admin.layouts.messages')
</div>
@endsection
