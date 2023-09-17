@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
	@include('admin.layouts.navbar')
	@include('admin.layouts.sidebar')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		@include('admin.layouts.content-header')
		<div class="row m-10">

			<div class="col-sm-2 mb-10">
				<select id="status" class="form-control select2bs4" style="width:100%;">
					<option value="All">All Status</option>
					<option value="Active" @if($status == 'Active') selected @endif >Active</option>
          <option value="Pending" @if($status == 'Pending') selected @endif >Pending</option>
					<option value="Suspended" @if($status == 'Suspended') selected @endif >Suspended</option>
					<option value="Deleted" @if($status == 'Deleted') selected @endif >Deleted</option>
				</select>
			</div>

			<div class="col-sm-3 mb-10">
				<input type="text" class="form-control" id="search" placeholder="Search Name or Mobile Number" value="{{ $search }}">
			</div>

			<div class="col-sm-1 mb-10">
				<select id="slimit" class="form-control">
					<option value="10" @if($slimit == '10') selected @endif >10</option>
					<option value="25" @if($slimit == '25') selected @endif >25</option>
					<option value="50" @if($slimit == '50') selected @endif >50</option>
					<option value="100" @if($slimit == '100') selected @endif >100</option>
				</select>
			</div>

			<div class="col-sm-1 mb-10">
				<input type="button" id="searchBtn" class="btn btn-primary" value="Search">
			</div>
		</div>

		<div class="row m-10">
			<div class="col-12">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Users List</h3>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap table-bordered table-extra" id="rtable" style="font-size: 14px !important;">
							<thead>
								<tr>
									<th>ID</th>
									<th>Basic Details</th>
									<th>Other Details</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@if(count($users) > 0)
								@foreach($users as $key => $value)
								<tr>
									<td align="center">{{$value->id}}</td>
                  <td>
                    Name : <b>{{$value->name}}</b><br>
                    Number : <b>{{$value->phone}}</b><br>
                    Email : <b>{{$value->email}}</b>
                  </td>
                  <td>
                    Device ID : <b>{{$value->device_id}}</b><br>
                    Created At : <b>{{ \Carbon\Carbon::parse($value->created_at)->format('y-m-d H:i') }}</b>
                  </td>
									<td align="center">
                    <select id="status" class="form-control" onchange="setStatus(this.value, '{{$value->id}}')" style="max-width:140px; min-width: 120px; height: auto;">
                      <option value="Active" @if($value->status == 'Active') selected @endif >Active</option>
                      <option value="Pending" @if($value->status == 'Pending') selected @endif >Pending</option>
                      <option value="Suspended" @if($value->status == 'Suspended') selected @endif >Suspended</option>
                      <option value="Deleted" @if($value->status == 'Deleted') selected @endif >Deleted</option>
                    </select>
                  </td>
                  <td>
										<a href="" title="Change Password" data-toggle="modal" data-target="#change-model" class="btn btn-sm btn-primary" onclick="$('#nuser_id').html($('<option>', { value : '{{$value->id}}' }).text('{{$value->name}}'));" style="font-size:15px; font-weight: 600; margin:2px;">
											<i class="fa fa-lock" style="font-size:16px"></i> Change Pass
										</a>

										<a href="{{url('/admin/users/'.$value->id)}}" class="btn btn-sm btn-warning" title="Edit Shop" style="color: white; font-size:15px; font-weight: 600; margin:2px;">
											<i class="fa fa-edit" style="font-size:16px"></i> Edit
										</a><br>

                    <a href="{{url('/admin/users/assign/'.$value->id)}}" class="btn btn-sm btn-info" title="Assign Course" style="color: white; font-size:15px; font-weight: 600; margin:2px;">
                      <i class="fa fa-book-reader" style="font-size:16px"></i> Assign Course
                    </a>
									</td>
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
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						@if(count($users) > 0)
						{{$users->appends(['status' => $status, 'search' => $search, 'slimit' => $slimit])->links()}}
						@endif
					</div>
				</div>
				<!-- /.card -->
			</div>
		</div>
		<!-- Add new user link -->
		<a href="{{url('/admin/users/create')}}" title="Add New User">
			<i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
		</a>
	</div>
	<!-- /.content-wrapper -->

	<div class="modal fade" id="change-model">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Change Password</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form action="{{url('/admin/users/change')}}" method="POST" role="form" id="addChangeForm">
						{{ csrf_field() }}
						<div class="form-group row">
							<label for="state" class="col-sm-3 col-form-label text-right">User :</label>
							<div class="col-sm-8">
								<select class="form-control select2bs4" style="width: 100%;" name="user_id" id="nuser_id"></select>
								<div class="invalid-feedback">Please select User.</div>
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label text-right">Password :</label>
							<div class="col-sm-8">
								<input type="text" name="password" id="npassword" class="form-control" placeholder="Enter New Password">
								<div class="invalid-feedback">Please enter Password.</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="addChangeBtn" class="btn btn-primary"> Change </button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>


	@include('admin.layouts.footer')
	@include('admin.layouts.js')
	@include('admin.layouts.messages')
	<style>
		.col-sm-3 {
			padding-right: 5px;
			padding-left: 5px;
		}
		.btn-group-sm>.btn, .btn-sm {
			padding: .125rem .4rem;
		}
	</style>
	<script type="text/javascript">   
		function setStatus(status, id) {
			$.ajax({
				type: "POST",
				url: "{{url('/api/users/status')}}",
				data : { status:status, id:id },
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.sts == '01') {
						toastr.success ('Status Updated');
					} else {
						toastr.error ('Something Went Wrong!');
					}
				}
			});
		}

		$('#searchBtn').click(function() {
			var shopname = $("#ssuser option:selected").text();
			var url = '{{url('/admin/users')}}?status=' + $('#status').val() + '&search=' + $('#search').val() + '&suser=' + $('#suser').val() + '&slimit=' + $('#slimit').val();
			window.location.href = url;
		});

		$(function () {
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			});
		});


		$('#addChangeBtn').click(function() {
			var error = 0
			if($('#nuser_id').val() == '' || $('#nuser_id').val() == undefined){
				$('#nuser_id').addClass('is-invalid');
				error = 1;
			} else {
				$('#nuser_id').removeClass('is-invalid');
			}

			if($('#npassword').val() == '' || $('#npassword').val() == '0'){
				$('#npassword').addClass('is-invalid');
				error = 1;
			} else {
				$('#npassword').removeClass('is-invalid');
			}

			if(error == 0) {
				$('#addChangeForm').submit();
			}
		});
	</script>
</div>
@endsection
