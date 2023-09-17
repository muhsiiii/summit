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
        <select class="form-control" style="width: 100%;" name="cat_id" id="cat_id">
          <option value="All">All Category</option>
          @if(count($category) > 0)
            @foreach($category as $key => $value)
              <option value="{{$key}}" @if($key == $cat_id) selected @endif >{{$value}}</option>
            @endforeach
          @endif
        </select>
      </div>

			<div class="col-sm-2 mb-10">
				<select id="status" class="form-control select2bs4" style="width:100%;">
					<option value="All">All Status</option>
					<option value="Active" @if($status == 'Active') selected @endif >Active</option>
					<option value="Suspended" @if($status == 'Suspended') selected @endif >Suspended</option>
					<option value="Deleted" @if($status == 'Deleted') selected @endif >Deleted</option>
				</select>
			</div>

			<div class="col-sm-3 mb-10">
				<input type="text" class="form-control" id="search" placeholder="Search Course Name" value="{{$search}}">
			</div>

			<div class="col-sm-1 mb-10">
				<select id="limit" class="form-control">
					<option value="10" @if($limit == '10') selected @endif >10</option>
					<option value="25" @if($limit == '25') selected @endif >25</option>
					<option value="50" @if($limit == '50') selected @endif >50</option>
					<option value="100" @if($limit == '100') selected @endif >100</option>
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
						<h3 class="card-title">Courses List</h3>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap table-bordered table-extra" id="rtable" style="font-size: 14px !important;">
							<thead>
								<tr>
									<th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Category</th>
									<th>Duration</th>
									<th>Amount</th>
                  <th>No of Subjects</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@if(count($courses) > 0)
								@foreach($courses as $key => $value)
								<tr>
									<td align="center">{{$value->id}}</td>
                  <td align="center">
                    @if($value->image != '')
                      <img src="{{url($value->image)}}" style="max-height:50px; max-width: 50px;">
                    @else 
                      <img src="{{url('/assets/images/image-not-found.jpg')}}" style="max-height:45px; max-width: 45px;">
                    @endif
                  </td>
                  <td>{{$value->name}}</td>
                  <td>{{$category[$value->cat_id] ?? $value->cat_id}}</td>
                  <td>{{$value->duration}} Month</td>
                  <td align=""><del>₹{{$value->amount}}</del> &nbsp; ₹{{$value->offer_amount}}</td>
                  <?php $count = App\Http\Controllers\AdminCourseController::countSubjects($value->id); ?>
                  <td align="center">{{$count ?? 0}}</td>
                  <td align="center">
                    <select id="status" class="form-control" onchange="setStatus(this.value, '{{$value->id}}')" style="max-width:140px; min-width: 120px;">
                      <option value="Active" @if($value->status == 'Active') selected @endif >Active</option>
                      <option value="Suspended" @if($value->status == 'Suspended') selected @endif >Suspended</option>
                      <option value="Deleted" @if($value->status == 'Deleted') selected @endif >Deleted</option>
                    </select>
                  </td>
									<td align="left">
                    <div class="row">
                    	<div class="col-sm-4" align="right">
    										<a href="{{url('/admin/courses/'.$value->id.'/highlights')}}" class="btn btn-info" title=" Course Highlights" style="color: white; font-size:15px; font-weight: 600; margin:2px;">
    											<i class="fa fa-list" style="font-size:16px"></i> Highlights
    										</a>
                      </div>
                      <div class="col-sm-4" align="center">
    										<a href="{{url('/admin/courses/'.$value->id)}}" class="btn btn-warning" title="Edit Course" style="color: white; font-size:15px; font-weight: 600; margin:2px;">
    											<i class="fa fa-edit" style="font-size:16px"></i> Edit
    										</a>
                      </div>
                      <div class="col-sm-4" align="left">
                        <form action="{{url('/admin/courses/delete/'.$value->id)}}" method="POST" role="form" id="delform{{$value->id}}">
                          {!! csrf_field() !!}
                          <button type="button" class="btn btn-danger" title="Delete Category" data-toggle="modal" data-target="#modal-delete" onclick="mkeDelModal('{{$value->id}}','{{$value->name}}');" @if($count > 0) disabled @endif >
                            <i class="fa fa-trash" style="font-size:16px" aria-hidden="true"></i> <b>Delete</b>
                          </button>
                        </form>
                      </div>
                    </div>
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
						@if(count($courses) > 0)
						{{$courses->appends(['cat_id' => $cat_id, 'cat_name' => $cat_name, 'status' => $status, 'search' => $search, 'limit' => $limit])->links()}}
						@endif
					</div>
				</div>
				<!-- /.card -->
			</div>
		</div>
								
                     
		<!-- Add new user link -->
		<a href="{{url('/admin/courses/create')}}" title="Add New Course">
			<i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
		</a>
	</div>

  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="deltitle">Delete</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Are You Sure ?</h5>
          <p>If you Delete this unit, All Details associated with it may be Effected.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" onclick="delCategory()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="delId">

	<!-- /.content-wrapper -->

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
				url: "{{url('/api/change/status/course')}}",
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
			var cat_name = $("#cat_name option:selected").text();
			var url = '{{url('/admin/courses')}}?cat_id=' + $('#cat_id').val() + '&status=' + $('#status').val() + '&search=' + $('#search').val() + '&limit=' + $('#limit').val() + '&cat_name=' + cat_name;
			window.location.href = url;
		});

		$(function () {
			$('.select2bs4, #cat_id').select2({
				theme: 'bootstrap4'
			});
		});

    function mkeDelModal(id, name) {
      $('#deltitle').html('Delete ' + name);
      $('#delId').val(id);
    }

    function delCategory() {
      $('#delform'+$('#delId').val()).submit();
    }
	</script>
</div>
@endsection
