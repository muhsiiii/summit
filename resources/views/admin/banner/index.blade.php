@extends('admin.layouts.header')

@section('adminheader')
<div class="wrapper">
	@include('admin.layouts.navbar')
	@include('admin.layouts.sidebar')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		@include('admin.layouts.content-header')
		<div class="row m-20">
			<div class="col-12">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Banner Images</h3>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap table-bordered table-extra">
							<thead>
							<tr>
								<th width="">Image</th>
								<th width="">Title</th>
                <th width="">Description</th>
                <th width="">Button Text</th>
								<th width="">URL</th>
								<th width="">Actions</th>
							</tr>
							</thead>
							<tbody>
								@if(count($banners) > 0)
									@foreach($banners as $key => $value)
									<tr>
										<td align="center">
											<img src="{{asset($value->image)}}" width="auto" height="50px">
										</td>
										<td class="large-text">{{$value->title}}</td>
                    <td class="large-text">{{$value->desc}}</td>
                    <td class="large-text">{{$value->button_text}}</td>
										<td><a href="{{$value->url}}" target="_blank">{{$value->url}}</a></td>
										<td align="center">
											<div class="row">
												<div class="col-sm-6" align="right">
													<a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add" title="Edit Banner" onclick="mkeEditForm('{{$value->id}}','{{$value->image}}','{{$value->title}}','{{$value->url}}','{{$value->desc}}','{{$value->button_text}}')" style="color: white;">
														<i class="fa fa-edit" style="font-size:16px"></i><b> Edit</b>
													</a>
												</div>
												<div class="col-sm-6" align="left">
                          <form action="{{url('/admin/banners/delete/'.$value->id)}}" method="POST" role="form" id="delform{{$value->id}}">
                            {!! csrf_field() !!}
                            <button type="button" class="btn btn-sm btn-danger" title="Delete Category" data-toggle="modal" data-target="#modal-delete" onclick="mkeDelModal('{{$value->id}}','{{$value->title}}');">
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
										<td colspan="6" align="center">No Banners Found</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix ">
						@if(count($banners) > 0)
							{{$banners->links()}}
						@endif
					</div>
				</div>
				<!-- /.card -->
			</div>
		</div>
		<!-- Add new Banner link -->
		<a href="" data-toggle="modal" data-target="#modal-add" title="Add New Banner" onclick="mkeAddForm();">
			<i class="fa fa-plus-circle fa-add-new" aria-hidden="true"></i>
		</a>
	</div>
	<!-- /.content-wrapper -->

	<!-- banner add model -->
	<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      	<form action="{{url('/admin/banners/create')}}" method="POST" id="addform" role="form" enctype="multipart/form-data">
      		{!! csrf_field() !!}
					<input type="hidden" name="type" value="1">
					<input type="hidden" name="id" id="id" value="">
					<input type="hidden" name="imageOld" id="imageOld" value="">

	        <div class="modal-header">
	          <h4 class="modal-title" id="bannerHeading">Add New Banner Image</h4>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
	        	
						<div class="card-body">
							<div class="form-group row">
								<label for="name" class="col-sm-3 col-form-label text-right">Banner Title<span class="text-danger">*</span>: </label>
								<div class="col-sm-8">
									<input class="form-control" placeholder="Enter Banner Title" name="name" type="text" id="name">
									<span class="invalid-feedback">Banner Title Required.</span>
								</div>
							</div>

              <div class="form-group row">
                <label for="desc" class="col-sm-3 col-form-label text-right">Banner Description: </label>
                <div class="col-sm-8">
                  <textarea class="form-control" placeholder="Enter Banner Description" name="desc" id="desc" rows="3"></textarea>
                  <span class="invalid-feedback">Banner Description Required.</span>
                </div>
              </div>

              <div class="form-group row">
                <label for="button_text" class="col-sm-3 col-form-label text-right">Button Text<span class="text-danger">*</span>: </label>
                <div class="col-sm-8">
                  <input class="form-control" placeholder="Enter Banner Button text" name="button_text" type="text" value="" id="button_text">
                  <span class="invalid-feedback">Button Text Required.</span>
                </div>
              </div>

							<div class="form-group row">
								<label for="url" class="col-sm-3 col-form-label text-right">Redirect URL:</label>
								<div class="col-sm-8">
									<input class="form-control" placeholder="Enter Banner Redirect URL" name="url" type="text" id="url" value="{{url('/')}}/">
								</div>
							</div>

							<div class="form-group row">
								<label for="image" class="col-sm-3 col-form-label text-right">Banner Image<span class="text-danger">*</span>:</label>
								<div class="col-sm-8">
									<div class="input-group">
										<div class="custom-file">
											<input class="custom-file-input" id="image" name="image" type="file">
											<label class="custom-file-label" for="image">Choose file</label>
										</div>
									</div>
									<span class="error span-extra hide text-danger" id="helpImage"></span>
								</div>

								<div class="col-sm-1">
									<button type="button" class="btn btn-secondary btn-tooltip float-left" data-toggle="tooltip" data-placement="top" title="Image in Aspect Ratio of 2:1 Required. i.e Image with Resolution 800px x 400px, 1000px x 500px ..etc.">
										<i class="fa fa-info" aria-hidden="true"></i>
									</button>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8 offset-sm-3">
									<img id="showImage" class="img-thumbnail hide" width="50%" height="auto" style="min-width:140px;">
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
          <h3 class="modal-title" id="deltitle">Delete</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Are You Sure ?</h5>
          <p>Do you Really want to Delete this Banner Image.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" onclick="delCategory()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="delId">
	
	@include('admin.layouts.footer')
</div>
@include('admin.layouts.js')
@include('admin.layouts.messages')

<style>
  .error.invalid-feedback {
    padding-left: 10px;
  }
</style>
<script type="text/javascript">
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
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
        var res = this.width/this.height;
        if (res < 1.80 || res > 2.20) {
          $('#image').addClass('is-invalid').val('');
          $('#showImage').addClass('hide');
          $('#helpImage').html('Image in Aspect Ratio of 2:1 Required.').removeClass('hide');
        } else {
          $('#image').removeClass('is-invalid');
          $('#showImage').removeClass('hide');
          $('#helpImage').html('').addClass('hide');
        }
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

  function validate() {
    var error = 0;
    if($('#name').val() == '') {
      $('#name').addClass('is-invalid');
      $('#name').focus();
      error = 1;
    } else {
      $('#name').removeClass('is-invalid');
    }

    if($('#button_text').val() == '') {
      $('#button_text').addClass('is-invalid');
      $('#button_text').focus();
      error = 1;
    } else {
      $('#button_text').removeClass('is-invalid');
    }

    if($('#image').val() == '' && $('#imageOld').val() == '') {
      $('#image').focus();
      $('#image').addClass('is-invalid').val('');
      $('#showImage').addClass('hide');
      $('#helpImage').html('Image File Required.').removeClass('hide');
      error = 1;
    } else {
      $('#image').removeClass('is-invalid');
      $('#helpImage').html('').addClass('hide');
    }

    if(error == 0) {
      $('#addform').submit();
    }
  }

  function mkeAddForm() {
    $('#addform').attr('action', '{{url('/admin/banners/create')}}');
    $('#name,#id,#image,#imageOld,#desc,#button_text').val('');
    $('#showImage').attr('src', '');
    $('#showImage').addClass('hide');
    $('#bannerHeading').html('Add New Banner Image');
    $('#image').removeClass('is-invalid');
    $('#name,#button_text').removeClass('is-invalid');
    $('#helpImage').html('').addClass('hide');
  }

  function mkeEditForm(id, image, name, url, desc, button_text) {
    $('#image').removeClass('is-invalid');
    $('#name').removeClass('is-invalid');
    $('#helpImage').html('').addClass('hide');
    $('#addform').attr('action', '{{url('/admin/banners/update')}}');
    $('#bannerHeading').html('Update Banner Image');
    $('#id').val(id);
    $('#imageOld').val(image);
    $('#name').val(name);
    $('#desc').val(desc);
    $('#button_text').val(button_text);
    $('#url').val(url);
    $('#showImage').attr('src', image);
    $('#showImage, #hideStatus').removeClass('hide');
  }

  
  function mkeDelModal(id, name) {
    $('#deltitle').html('Delete ' + name);
    $('#delId').val(id);
  }

  function delCategory() {
    $('#delform'+$('#delId').val()).submit();
  }
</script>


@endsection