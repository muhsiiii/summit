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
          <h3 class="card-title">Assign Course for User - {{$username}}</h3>
        </div>
        <!-- form start -->
        <form action="{{url('/admin/users/assign/'.$id.'/save')}}" id="addForm" method="POST" role="form">
          @csrf
          <div class="card-body">

            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label text-right">Course<span class="text-danger">*</span> :</label>
              <div class="col-sm-6">
                <select class="form-control" style="width: 100%;" name="course_id" id="course_id">
                  <option value="">Select Course</option>
                </select>
                <div id="name-span" class="invalid-feedback">Course Required.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="from_date" class="col-sm-3 col-form-label text-right">Validity From<span class="text-danger">*</span> :</label>
              <div class="col-sm-6">
                <div class="input-group date" id="from" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#from" name="from_date" id="from_date" placeholder="Select From Date">
                  <div class="input-group-append" data-target="#from" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                  <div class="invalid-feedback">Validity From Required.</div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="to_date" class="col-sm-3 col-form-label text-right">Validity To<span class="text-danger">*</span> :</label>
              <div class="col-sm-6">
                <div class="input-group date" id="to" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#to" name="to_date" id="to_date" placeholder="Select To Date">
                  <div class="input-group-append" data-target="#to" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                  <div class="invalid-feedback">Validity To Required.</div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="duration" class="col-sm-3 col-form-label text-right">Duration<span class="text-danger">*</span> :</label>
              <div class="col-sm-6">
                <select id="duration" class="form-control" name="duration" >
                  <option value="">Select Duration</option>
                  @for($i = 1; $i <= 36; $i++)
                  <option value="{{$i}}">{{$i}} Month</option>
                  @endfor
                </select>
                <div class="invalid-feedback">Duration Required.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="amount" class="col-sm-3 col-form-label text-right">Amount<span class="text-danger">*</span> :</label>
              <div class="col-sm-6">
                <input class="form-control" placeholder="Enter Amount" name="amount" type="text" value="" id="amount">
                <div class="invalid-feedback">Amount Required.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="details" class="col-sm-3 col-form-label text-right">Payment Details :</label>
              <div class="col-sm-6">
                <input class="form-control" placeholder="Enter Payment Details" name="details" type="text" value="" id="details">
                <div class="invalid-feedback">Payment Details Required.</div>
              </div>
            </div>

          </div>

          <div class="card-footer">
            <a class="btn btn-default offset-sm-3" href="{{url('/admin/users')}}">Back</a>&emsp;
            <button type="button" id="addBtn" class="btn btn-primary"> Save </button>
          </div>
          <!-- /.card-body -->
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
<input type="hidden" id="phone-valid" value="0">
<input type="hidden" id="device-valid" value="0">
<!-- /.content-wrapper -->
@include('admin.layouts.footer')
@include('admin.layouts.js')
<script>
  $('#from,#to').datetimepicker({
    format: 'L'
  });

  $(function () {
    $('#status').select2({
      theme: 'bootstrap4'
    });
  });

  $('#duration').select2({
    theme: 'bootstrap4',
    placeholder: "Select Duration",
  });

  $('#course_id').select2({
    theme: 'bootstrap4',
    placeholder: "Select Course",
    ajax: {
      url: '{{url('/api/search/course')}}',
      data: function (params) {
        params.id = {{$authuser->id ?? '0'}}
        return params;
      },
      dataType: 'json',
    }
  });

  $('#course_id').on('select2:selecting', function(e) {
    $('#from_date').val(e.params.args.data.fdate);
    $('#to_date').val(e.params.args.data.tdate);
    $('#duration').val(e.params.args.data.duration);
    $('#amount').val(e.params.args.data.amount);
    $('#duration').trigger('change');
  });


  $('#addBtn').click(function() {
    var error = 0

    if($('#course_id').val() == '' || $('#course_id').val() == null){
      $('#course_id').addClass('is-invalid');
      error = 1;
    } else {
      $('#course_id').removeClass('is-invalid');
    }

    if($('#from_date').val() == ''){
      $('#from_date').addClass('is-invalid');
      error = 1;
    } else {
      $('#from_date').removeClass('is-invalid');
    }

    if($('#to_date').val() == ''){
      $('#to_date').addClass('is-invalid');
      error = 1;
    } else {
      $('#to_date').removeClass('is-invalid');
    }

    if($('#duration').val() == ''){
      $('#duration').addClass('is-invalid');
      error = 1;
    } else {
      $('#duration').removeClass('is-invalid');
    }

    if($('#amount').val() == ''){
      $('#amount').addClass('is-invalid');
      error = 1;
    } else {
      $('#amount').removeClass('is-invalid');
    }

    if(error == 0) {
      $('#addForm').submit();
    }
  });
</script>
@endsection

