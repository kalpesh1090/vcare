@extends('auth.layout')
@section('content')
<div class="content d-flex justify-content-center align-items-center">

					<!-- Login form -->
					
                    <form class="login-form form-validate-jquery" action="{{ route('login.post') }}" method="POST">
                    @csrf
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<img  src="{{url('global_assets/images/logo-light.png')}}" style="width: 220px;">
									
									
									
									<h4 class="text-primary class="mb-0 mt-2"">Vcare: Employee First Program</h4>   
									
									<h5 class="mb-0 mt-0">Login to your account</h5>
									<span class="d-block text-muted">Enter your credentials below</span>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="text" name="email" required autofocus  class="form-control" placeholder="Email">
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
                                    @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="password" class="form-control" name="password" required placeholder="Password">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
                                    @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
								</div>	

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Sign in</button>

								</div>

								<a href="{{url('/registration')}}" class="btn btn-danger btn-block">
									Register
								</a>

								<div class="text-center mt-3">
									<a href="{{route('forgot_password')}}">Forgot password?</a>
								</div>
							</div>
						</div>
					</form>
					<!-- /login form -->

				</div>
@endsection