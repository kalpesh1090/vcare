@extends('layout.layout')
@section('content')
<!-- Page header -->
<div class="page-header page-header-light">

	<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Update Profile</span>
			</div>

			<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
		</div>

		
	</div>
</div>
<div class="content">

	<!-- Form inputs -->
	<div class="card">
		

		<div class="card-body">
			
		<form action="{{ route('post_edit_profile') }}" class="flex-fill form-validate-jquery" method="POST">
                          @csrf	
						  			<fieldset class="mb-3">
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Eamil</label>
						<div class="col-lg-4">
							<input type="text" class="form-control" value="{{$user->email}}" disabled >
						</div>
					</div>
					<input type="text" name="id" value="{{$user->id}}" hidden>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">First Name</label>
						<div class="col-lg-4">
							<input type="text" name="name" class="form-control" placeholder="First Name" value="{{$user->name}}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Last Name</label>
						<div class="col-lg-4">
							<input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{$user->last_name}}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Mobile Number</label>
						<div class="col-lg-4">
							<input type="text" name="mobile" class="form-control" placeholder="mobile Number" value="{{$user->mobile}}">
						</div>
					</div>
					<div class="form-group row">
						
						<div class="offset-md-2 col-lg-4">
							<input type="submit" class="btn btn-primary" value="Update" >
						</div>
					</div>

					
				</fieldset>

			</form>
		</div>
	</div>
	<!-- /form inputs -->

</div>
					<!-- /dashboard content -->
@endsection
@section('header-scripts')
<!-- dashboard -->
<script src="{!! asset('global_assets/js/demo_pages/dashboard.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/streamgraph.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/sparklines.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/lines.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/areas.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/donuts.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/bars.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/heatmaps.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/pies.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/bullets.js') !!}"></script>

  @endsection
