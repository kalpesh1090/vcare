@extends('layout.layout')
@section('content')
<!-- Page header -->
<div class="page-header page-header-light">

					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
								<span class="breadcrumb-item active">Dashboard</span>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

				
					</div>
				</div>
				<!-- /page header -->
				<div class="content">
					<!-- Main charts -->
					
					<!-- /main charts -->


					<!-- Dashboard content -->
					<div class="row">
						<div class="col-xl-12">

							<!-- Marketing campaigns -->
					


							<!-- Quick stats boxes -->
							<div class="row">

							
							<div class="col-lg-3">

										<!-- Members online -->
										<div class="card bg-teal text-white">
											<div class="card-body">
												<div class="d-flex">
													<h3 class="font-weight-semibold mb-0">{{$memberCount->total}}</h3>
													<!-- <span class="badge badge-dark badge-pill align-self-center ml-auto">+53,6%</span> -->
							                	</div>
							                	
							                	<div>
													Total Members
													<!-- <div class="font-size-sm opacity-75">489 avg</div> -->
												</div>
											</div>

											<div class="container-fluid">
												<div id="members-online"></div>
											</div>
										</div>
										<!-- /members online -->

									</div>
									

								<div class="col-lg-3">

									<!-- Current server load -->
									<div class="card bg-pink text-white">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="font-weight-semibold mb-0">
												<?php
													$pending =isset($reserves[0]['total']) ? $reserves[0]['total'] :"0"; 
													$pay =isset($reserves[1]['total']) ? $reserves[1]['total'] :"0"; 
													$paid =isset($reserves[2]['total']) ? $reserves[2]['total'] :"0"; 
													echo $pending+$pay+$paid;
												?>

											</h3>
						                	</div>
						                	
						                	<div>
												Total File Income Tax Return
											</div>
										</div>

										<div id="server-load"></div>
									</div>
									<!-- /current server load -->

								</div>

								<div class="col-lg-3">

									<!-- Today's revenue -->
									<div class="card bg-primary text-white">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="font-weight-semibold mb-0">{{$paid}}</h3>
						                	</div>
						                	
						                	<div>
												Payments
											</div>
										</div>

										<div id="today-revenue"></div>
									</div>
									<!-- /today's revenue -->

								</div>
								<div class="col-lg-3">

									<!-- Today's revenue -->
									<div class="card bg-danger text-white">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="font-weight-semibold mb-0">{{$pay}}</h3>
						                	</div>
						                	
						                	<div>
												Pending Payments
											</div>
										</div>

										<div id="today-revenue"></div>
									</div>
									<!-- /today's revenue -->

								</div>
								
							</div>
							<!-- /quick stats boxes -->




							<!-- Latest posts -->
						

						</div>

						
					</div>
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