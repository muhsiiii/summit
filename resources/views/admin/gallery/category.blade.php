@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
	@include('admin.layouts.navbar')
	@include('admin.layouts.sidebar')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		@include('admin.layouts.content-header')
		<div class="row m-20">
			<div class="col-sm-3">
				<input type="text" id="search" placeholder="Search Category..." value="{{ $search }}" class="form-control">
			</div>

			<div class="col-sm-1">
				<input type="button" id="searchBtn" class="btn btn-primary" value="Search">
			</div>
		</div>

		<div class="row m-20">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Gallery Category List</h3>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap table-bordered table-extra">
							<thead>
							<tr>
                <th>Display Order</th>
								<th>Name</th>
                <th>No of Images</th>
								<th>Actions</th>
							</tr>
							</thead>
							<tbody>
								@if(count($categories) > 0)
									@foreach($categories as $key => $value)
                  <?php $no++; ?>
									<tr>
                    <td align="center">{{$value->disp_order}}</td>
										<td>{{$value->name}}</td>
                    <?php $count = App\Http\Controllers\AdminGalleryCategoryController::countGallery($value->id); ?>
                    <td align="center">{{$count}}</td>
										<td align="center">
											<div class="row">
												<div class="col-sm-6" align="right">
													<a href="" class="btn btn-sm btn-warning" title="Edit Category" data-toggle="modal" data-target="#modal-add" onclick="mkeEditForm('{{$value->id}}','{{$value->name}}', '{{$value->disp_order}}', '{{$value->keyword}}', '{{$value->content}}')" style="color: white;">
														<i class="fa fa-edit" style="font-size:16px"></i> <b>Edit</b>
													</a>
												</div>
												<div class="col-sm-6" align="left">
													<form action="{{url('/admin/gallery/category/delete/'.$value->id)}}" method="POST" role="form" id="delform{{$value->id}}">
														{!! csrf_field() !!}
														<button type="button" class="btn btn-sm btn-danger" title="Delete Category" data-toggle="modal" data-target="#modal-delete" onclick="mkeDelModal('{{$value->id}}','{{$value->name}}');" @if($count > 0) disabled @endif >
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
										<td colspan="7" align="center">No Results Found!</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix ">
						@if(count($categories) > 0)
							{{$categories->appends( array("search" => $search))->links()}}
						@endif
					</div>
				</div>
				<!-- /.card -->
			</div>
		</div>
		<!-- Add new Banner link -->
		<a href="" data-toggle="modal" data-target="#modal-add" title="Add New Category" onclick="mkeAddForm();">
			<i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
		</a>
	</div>
	<!-- /.content-wrapper -->

	<!-- banner add model -->
	<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      	<form action="{{url('/admin/gallery/category/create')}}" method="POST" id="addform" role="form" enctype="multipart/form-data">
      		{!! csrf_field() !!}
					<input type="hidden" name="id" id="id" value="">

	        <div class="modal-header">
	          <h4 class="modal-title" id="bannerHeading">Add New Category</h4>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
	        	
						<div class="card-body">
							<div class="form-group row">
								<label for="name" class="col-sm-3 col-form-label text-right">Name<span class="text-danger">*</span> :</label>
								<div class="col-sm-7">
									<input class="form-control" placeholder="Enter Category Name" name="name" type="text" value="" id="name">
									<span class="invalid-feedback">Please enter Category Name.</span>
								</div>
							</div>

							<div class="form-group row">
								<label for="disporder" class="col-sm-3 col-form-label text-right">Display Order<span class="text-danger">*</span> :</label>
								<div class="col-sm-7">
									<input class="form-control" name="disp_order" type="number" min="1" value="1" id="disporder">
								</div>
							</div>

              <div class="form-group row">
                <label for="keyword" class="col-sm-3 col-form-label text-right">Keywords:</label>
                <div class="col-sm-7">
                  <textarea class="form-control" id="keyword" name="keyword" placeholder="Enter SEO Keywords" rows="4"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="content" class="col-sm-3 col-form-label text-right">Content:</label>
                <div class="col-sm-7">
                  <textarea class="form-control" id="content" name="content" placeholder="Enter SEO Content" rows="4"></textarea>
                </div>
              </div>
            </div>
					
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
          <p>If you Delete this Category, All Courses associated with it may be Effected.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" onclick="delCategory()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="delId">
  <input type="hidden" id="adddisporder" value="<?php echo $disporder ?? '1'; ?>">
	
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
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });

	$('#searchBtn').click(function() {
		var url = '{{url('/admin/gallery/category')}}?search=' + $('#search').val();
		window.location.href = url;
	});

	$(function () {
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

  var _URL = window.URL || window.webkitURL;
  $('#image').change(function (e) {
    readURL(this);
    $('#image-error').addClass('hide');
    $('#showImage').removeClass('hide');
    var file, img;
    if ((file = this.files[0])) {
      img = new Image();
      img.onload = function () {
        $('#image').removeClass('is-invalid');
        $('#showImage').removeClass('hide');
        $('#helpImage').html('').addClass('hide');
      };
      img.src = _URL.createObjectURL(file);
    }
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  function mkeAddForm() {
    $('#addform').attr('action', '{{url('/admin/gallery/category/create')}}');
    $('#name,#id,#keyword,#content').val('');
    $('#bannerHeading').html('Add New Category');
    $('#name').removeClass('is-invalid');
    $('#disporder').val($('#adddisporder').val());
  }

  function mkeEditForm(id, name, disporder, keyword, content) {
    $('#name').removeClass('is-invalid');
    $('#addform').attr('action', '{{url('/admin/gallery/category/update')}}');
    $('#bannerHeading').html('Update Category');
    $('#id').val(id);
    $('#name').val(name);
    $('#keyword').val(keyword);
    $('#content').val(content);
    $('#disporder').val(disporder);
  }


  function validate() {
    var error = 0;
    if($('#name').val() == '') {
      $('#name').addClass('is-invalid');
      error = 1;
    } else {
      $('#name').removeClass('is-invalid');
    }

    if($('#backcolor').val() == '') {
      $('#backcolor').addClass('is-invalid');
      error = 1;
    } else {
      $('#backcolor').removeClass('is-invalid');
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