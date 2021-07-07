<div class="sidebar sidebar-light sidebar-main sidebar-expand-lg">

			<!-- Sidebar content -->
			<div class="sidebar-content">


				<!-- User menu -->
				<div class="sidebar-section">
					<div class="sidebar-user-material">
						<div class="sidebar-section-body">
							
							<div class="text-center">
								<!-- <h6 class="mb-0 text-white text-shadow-dark mt-3">{{Auth::user()->name}}</h6>
								<span class="font-size-sm text-white text-shadow-dark">{{Auth::user()->email}}</span> -->
								<h6 class="mb-0 text-white text-shadow-dark mt-3">&nbsp;</h6>
								<span class="font-size-sm text-white text-shadow-dark">&nbsp;</span></span>
							</div>
						</div>
						
					</div>

					
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="sidebar-section">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						
						<li class="nav-item">
							<a href="{{url('/dashboard')}}" class="nav-link active">
								<i class="icon-home4 icon-resize"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						@if (Auth::user()->user_type == '1' || Auth::user()->user_type == '2')

						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-grid icon-resize"></i> <span>Master</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item">
									<a href="{{route('country.index')}}" class="nav-link">
										<i class="icon-list-unordered"></i>
										<span>Country</span>
										<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
									</a>
								</li>
								<li class="nav-item">
									<a href="{{route('state.index')}}" class="nav-link">
										<i class="icon-list-unordered"></i>
										<span>State</span>
										<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
									</a>
								</li><li class="nav-item">
									<a href="{{route('district.index')}}" class="nav-link">
										<i class="icon-list-unordered"></i>
										<span>District</span>
										<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
									</a>
								</li><li class="nav-item">
								<a href="{{route('document_type.index')}}" class="nav-link">
										<i class="icon-list-unordered"></i>
										<span>Document Type</span>
										<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
									</a>
								</li><li class="nav-item">
								<a href="{{route('financial_year.index')}}" class="nav-link">
										<i class="icon-list-unordered"></i>
										<span>Financial Year </span>
										<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
									</a>
								</li><li class="nav-item">
								<a href="{{route('plan.index')}}" class="nav-link">
										<i class="icon-list-unordered"></i>
										<span>Subscription</span>
										<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
									</a>
								</li>
								<li class="nav-item">
									<a href="{{url('/master_code')}}" class="nav-link">
										<i class="icon-credit-card icon-resize" ></i>
										<span>Promo Code Master</span>
										<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
									</a>
								</li>
								<li class="nav-item">
									<a href="{{url('/user_registration')}}" class="nav-link">
										<i class="icon-credit-card icon-resize" ></i>
										<span>Users</span>
										<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
									</a>
								</li>
								
							</ul>
						</li>							    
						@endif
@if (Auth::user()->user_type == '3')

						<li class="nav-item">
							<a href="{{url('/members')}}" class="nav-link">
								<i class="icon-user-plus icon-resize"></i>
								<span>Members</span>
								<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{url('/Income-Tax-Return')}}" class="nav-link">
								<i class="icon-file-text2 icon-resize"></i>
								<span>File Income Tax Return</span>
								<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('/payment-list')}}" class="nav-link">
								<i class="icon-credit-card icon-resize" ></i>
								<span>Payments</span>
								<!--<span class="badge badge-primary align-self-center ml-auto">3.0</span> -->
							</a>
						</li>
						@endif
						
					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>