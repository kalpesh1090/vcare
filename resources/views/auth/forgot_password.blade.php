@extends('auth.layout')
@section('content')
<div class="content d-flex justify-content-center align-items-center">
					<!-- Login form -->
                    <form action="{{ route('forgot_password.post') }}" class="login-form form-validate-jquery" method="POST">
                    @csrf
											<div class="card mb-0">
												<div class="card-body">
													<div class="text-center mb-3">
														<img  src="{{url('global_assets/images/logo-light.png')}}" style="width: 220px;">
														
														<h5 class="mb-0 mt-3">Find Your Account</h5>
																<span class="d-block text-muted">Please enter your email address for link</span>
													</div>

														<div class="form-group form-group-feedback form-group-feedback-right">
														<input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Your email">
															<div class="form-control-feedback">
																<i class="icon-mention text-muted"></i>
															</div>
														</div>
                              @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                              @endif

													
														<div class="form-group">
															<button type="submit"  class="btn btn-success btn-block"> Forgot</button>
														</div>
		
														<a href="{{url('/')}}" type="submit" class="btn btn-danger btn-block" >Back to Login</a>
												
												</div>
											</div>
					</form>
					<!-- /login form -->

				</div>
@endsection