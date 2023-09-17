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

      <div class="col-sm-1">
        <input type="button" id="searchBtn" class="btn btn-primary" value="Search">
      </div>
    </div>

    <div class="row m-20">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Courses of User - {{$username}}</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-bordered table-extra">
              <thead>
              <tr>
                <th>#</th>
                <th>Course</th>
                <th>From</th>
                <th>To</th>
                <th>Duration</th>
                <th>Amount</th>
                <th>Details</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                @if(count($usercourses) > 0)
                  @foreach($usercourses as $key => $value)
                  <?php $no++; ?>
                  <tr>
                    <td align="center">{{$no}}</td>
                    <td>
                      {{$courses[$value->course_id]}} ({{App\Http\Controllers\AdminCourseController::getCourseCategory($value->course_id)}})
                    </td>
                    <td>{{ \Carbon\Carbon::parse($value->from_date)->format('d-M-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($value->to_date)->format('d-M-Y') }}</td>
                    <td>{{$value->duration}} Month</td>
                    <td align="right">₹ {{$value->amount}}</td>
                    <td align="left">{{$value->details}}</td>
                    <td align="center">
                      <a href="{{url('/admin/users/assign/'.$id.'/delete/'.$value->id)}}" class="btn btn-sm btn-danger" title="Delete User Courses" style="color:white;">
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
            @if(count($usercourses) > 0)
              {{$usercourses->appends( array("course_id" => $course_id, "limit" => $limit ))->links()}}
            @endif
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Add new Banner link -->
    <a href="{{url('/admin/users/assign/'.$id.'/create')}}" title="Assign New Course">
      <i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->
  
  @include('admin.layouts.footer')
</div>
@include('admin.layouts.js')
@include('admin.layouts.messages')
<script>
  $('#searchBtn').click(function() {
    var url = '{{url('/admin/users/assign/'.$id)}}?course_id=' + $('#course_id').val() + '&slimit=' + $('#slimit').val();
    window.location.href = url;
  });

  $(function () {
    $('#course_id').select2({
      theme: 'bootstrap4'
    })
  });
</script>
@endsection