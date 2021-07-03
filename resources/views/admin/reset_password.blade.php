@extends('layout.layout')
@section('content')
<!-- Page header -->
<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Change Password</span>
			</div>

			<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<div class="content">

    <!-- Form inputs -->
    <div class="card">
        

        <div class="card-body">
            
        <!-- <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p> -->
                        <form action="{{ route('reset_password.post') }}" class="flex-fill form-validate-jquery" method="POST">
                          @csrf


                          @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <fieldset class="mb-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Current Password : </label>
                                <div class="col-lg-4">
                                    <input type="password" min="0" class="form-control" name="previous_password" placeholder="Current Password">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="bad" class="col-sm-2 control-label">New password : <i class="has-error"></i></label>
                                <div class="col-sm-4">
                                    <input type="password" min="0" class="form-control" name="new_password" placeholder="New Password">

                                </div>
                            </div>
                                <div class="row form-group">
                                <label for="bath" class="col-sm-2 control-label">Conform Password : <i class="has-error"></i></label>
                                <div class="col-sm-4">
                                    <input type="password" min="0" class="form-control" name="conform_password" placeholder="Conform Password">
                                </div>
                            </div>
                            <div class="form-group row">
                        
                                <div class="offset-md-2 col-lg-4">
                                    
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                        </fieldset>    
                            

                    </div>
                    <!-- <div class="box-footer">
                        <div class="col-sm-offset-1 col-sm-6">
                        
                        </div>
                    </div> -->
                </div>
                </form>
        </div>
    </div>
    <!-- /form inputs -->


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
