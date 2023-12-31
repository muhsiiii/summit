<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><?php echo $Header ?? 'DashBoard'; ?></h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					@if(isset($Header) && $Header != 'Dashboard')
						<li class="breadcrumb-item"><a href="/admin">DashBoard</a></li>
					@else
						<li class="breadcrumb-item">DashBoard</li>
					@endif
					@if(isset($Header) && isset($SubHeader) && $Header != 'Dashboard')
						<li class="breadcrumb-item active">
							<a href="{{url('/admin')}}/{{ strtolower($Header) }}">{{$Header}}</a>
						</li>
					@elseif(isset($Header) && $Header != 'Dashboard')
						<li class="breadcrumb-item active">{{$Header}}</li>
					@endif
					@if(isset($SubHeader))
						<li class="breadcrumb-item active">{{$SubHeader}}</li>
					@endif
				</ol>
		</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->