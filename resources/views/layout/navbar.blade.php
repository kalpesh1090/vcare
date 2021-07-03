<div class="navbar navbar-expand-lg navbar-dark bg-indigo navbar-static">
		<div class="d-flex flex-1 d-lg-none">
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>

			<!-- <button data-target="#navbar-search" type="button" class="navbar-toggler" data-toggle="collapse">
				<i class="icon-search4"></i>
			</button> -->
		</div>
		<style>
			.navbar-brand img {
			    height: 22px;
			}

			.navbar-brand {
		    display: inline-block;
		    padding-top: 1.1rem;
		    padding-bottom: none; 
		    margin-right: 1.25rem;
		    font-size: 0;
		    line-height: inherit;
		    white-space: nowrap;
		}
		</style>		

		<div class="navbar-brand text-center text-lg-left">
			
			<a href="#" class="d-inline-block">
				<img src="{{url('assets/images/logo.png')}}"  class="d-none d-sm-block" alt="">
				<!-- <img src="../../../../global_assets/images/logo_light.png" class="d-none d-sm-block" alt=""> -->
				<img src="{{url('assets/images/logo.png')}}" class="d-sm-none" alt="">
			</a>
		</div>

		<div class="navbar-collapse collapse flex-lg-1 mx-lg-3 order-2 order-lg-1" id="navbar-search">
			<div class="navbar-search d-flex align-items-center py-2 py-lg-0">
				<!-- <div class="form-group-feedback form-group-feedback-left flex-grow-1">
					<input type="text" class="form-control" placeholder="Search">
					<div class="form-control-feedback">
						<i class="icon-search4 text-white opacity-50"></i>
					</div>
				</div> -->
			</div>
		</div>

		<div class="d-flex justify-content-end align-items-center flex-1 flex-lg-0 order-1 order-lg-2">
			<ul class="navbar-nav flex-row">
				<li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
					<a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
						<img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-pill mr-lg-2" height="34" alt="">
						<span class="d-none d-lg-inline-block">{{Auth::user()->name}} {{Auth::user()->last_name}}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{route('edit_profile')}}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
						<a href="{{route('reset_password')}}" class="dropdown-item"><i class="icon-user-plus"></i> Change Password</a>
						
						
						<div class="dropdown-divider"></div>
						
						<a href="{{url('logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>

			

<!-- 				<li class="nav-item">
					<a href="{{url('logout')}}" class="navbar-nav-link navbar-nav-link-toggler">
						<i class="icon-switch2"></i>
					</a>
				</li> -->
			</ul>
		</div>
	</div>