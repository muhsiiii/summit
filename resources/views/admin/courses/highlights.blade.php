@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
	@include('admin.layouts.navbar')
	@include('admin.layouts.sidebar')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		@include('admin.layouts.content-header')

		<div class="row m-20">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Course Highlights for {{$course->name}}</h3>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap table-bordered table-extra">
							<thead>
							<tr>
								<th>#</th>
                <th>Course</th>
								<th>Heading</th>
								<th>Actions</th>
							</tr>
							</thead>
							<tbody>
								@if(count($highlights) > 0)
									@foreach($highlights as $key => $value)
									<tr>
										<td align="center">{{$value->disp_order}}</td>
                    <td>
                      {{$courses[$value->course_id]}} ({{App\Http\Controllers\AdminCourseController::getCourseCategory($value->course_id)}})
                    </td>
										<td>{{$value->heading}}</td>
										<td align="center">
<!-- 											<div class="row">
												<div class="col-sm-6" align="right">
													<a href="" class="btn btn-sm btn-warning" title="Edit Category" data-toggle="modal" data-target="#modal-add" onclick="mkeEditForm({{$value->id}}, {{$value->course_id}}, {{$value->disp_order}}, '{!! $value->heading !!}', '{!! $value->desc !!}')" style="color: white;">
														<i class="fa fa-edit" style="font-size:16px"></i> <b>Edit</b>
													</a>
												</div>
												<div class="col-sm-6" align="left"> -->
													<form action="{{url('/admin/courses/'.$id.'/highlights/delete/'.$value->id)}}" method="POST" role="form" id="delform{{$value->id}}">
														{!! csrf_field() !!}
														<button type="button" class="btn btn-sm btn-danger" title="Delete Category" data-toggle="modal" data-target="#modal-delete" onclick="mkeDelModal('{{$value->id}}','Highlight');">
															<i class="fa fa-trash" style="font-size:16px" aria-hidden="true"></i> <b>Delete</b>
														</button>
													</form>
												<!-- </div> -->
											<!-- </div> -->
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
				</div>
			</div>
		</div>
		<a href="" data-toggle="modal" data-target="#modal-add" title="Add New Highlight" onclick="mkeAddForm();">
			<i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
		</a>
	</div>


	<!-- banner add model -->
	<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      	<form action="{{url('/admin/courses/'.$id.'/highlights/create')}}" method="POST" id="addform" role="form" enctype="multipart/form-data">
      		{!! csrf_field() !!}
					<input type="hidden" name="id" id="id" value="">

	        <div class="modal-header">
	          <h4 class="modal-title" id="bannerHeading">Course Highlights </h4>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
	        	
						<div class="card-body">

              <div class="form-group row">
                <label for="course_id" class="col-sm-3 col-form-label text-right">Course :</label>
                <div class="col-sm-7">
                  <select class="form-control" style="width: 100%;" name="course_id" id="courseid" readonly>
                    @if(count($courses) > 0)
                      @foreach($courses as $key => $value)
	                      @if($key == $id)
	                        <option value="{{$key}}" >
	                          {{$value}}
	                          ({{App\Http\Controllers\AdminCourseController::getCourseCategory($key)}})
	                        </option>
	                      @endif
                      @endforeach
                    @endif
                  </select>
                  <div class="invalid-feedback">Please select Course.</div>
                </div>
              </div>

							<div class="form-group row">
								<label for="disp_order" class="col-sm-3 col-form-label text-right">Display Order*:</label>
								<div class="col-sm-7">
									<input class="form-control" name="disp_order" type="number" min="1" value="1" id="disp_order">
								</div>
							</div>

							<div class="form-group row">
								<label for="heading" class="col-sm-3 col-form-label text-right">Heading*:</label>
								<div class="col-sm-7">
									<textarea class="form-control" id="heading" name="heading" placeholder="Enter Highlight Heading" rows="2"></textarea>
									<span class="invalid-feedback">Please Highlight Heading.</span>
								</div>
							</div>

							<div class="form-group row">
								<label for="desc" class="col-sm-3 col-form-label text-right">Description*:</label>
								<div class="col-sm-7">
									<textarea class="form-control" id="desc" name="desc" placeholder="Enter Highlight Description" rows="5"></textarea>
									<span class="invalid-feedback">Please Highlight Description.</span>
								</div>
							</div>
						</div>
						<!-- /.card-body -->
					
	        </div>
	        <div class="modal-footer justify-content-between">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	          <input class="btn btn-primary offset-sm-2" type="button" onclick="validate();" value="Save">
	        </div>
	      </form>
      </div>
    </div>
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
          <p>Do you really want to delete This?.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" onclick="delCategory()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="delId">
  <input type="hidden" id="adddisporder" value="<?php echo $disp_order ?? '1'; ?>">
	
	@include('admin.layouts.footer')
</div>
@include('admin.layouts.js')
@include('admin.layouts.messages')
<style>
  .table-extra td {
    padding: 0.4rem!important;
  }
</style>
<script>
  function mkeAddForm() {
    $('#addform').attr('action', '{{url('/admin/courses/'.$id.'/highlights/create')}}');
    $('#heading,#id,#desc').val('');
    $('#bannerHeading').html('Course Highlights ');
    $('#heading').removeClass('is-invalid');
    $('#disp_order').val($('#adddisporder').val());
  }

  function mkeEditForm(id, course_id, disp_order, heading, desc) {
    $('#heading').removeClass('is-invalid');
    $('#addform').attr('action', '{{url('/admin/courses/'.$id.'/highlights/update')}}');
    $('#bannerHeading').html('Update Course Highlights ');
    $('#id').val(id);
    $('#heading').val(heading);
    $('#desc').val(desc);
    $('#disp_order').val(disp_order);
    $('#course_id').val(course_id);
  }


  function validate() {
    var error = 0;
    if($('#heading').val() == '') {
      $('#heading').addClass('is-invalid');
      error = 1;
    } else {
      $('#heading').removeClass('is-invalid');
    }

    if($('#desc').val() == '') {
      $('#desc').addClass('is-invalid');
      error = 1;
    } else {
      $('#desc').removeClass('is-invalid');
    }

    if(error == 0) {
      $('#addform').submit();
    }
  }

  function mkeDelModal(id, name) {
    $('#deltitle').html('Delete ' + name);
    $('#delId').val(id);
  }

  function delCategory() {
    $('#delform'+$('#delId').val()).submit();
  }
</script>
@if(isset($_GET['o']) && $_GET['o'] == '1')
<script>
	$('#modal-add').modal('show');
</script>
@endif
@endsection