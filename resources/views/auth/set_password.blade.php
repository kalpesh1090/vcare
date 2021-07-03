@extends('auth.layout')
@section('content')
<div class="content d-flex justify-content-center align-items-center">
					<!-- Login form -->
                    <form action="{{ route('post_link_forgot_password') }}" class="login-form form-validate-jquery" method="POST">
                          @csrf	
                    @csrf
											<div class="card mb-0">
												<div class="card-body">
													<div class="text-center mb-3">
														<img  src="{{url('global_assets/images/logo-light.png')}}" style="width: 220px;">
														
														<h5 class="mb-0 mt-3">Set your password</h5>
														<span class="d-block text-muted">Please choose a valid password</span>
													</div>
													                                        <input type="text" name="id" value="{{$user_id}}" hidden>

														<div class="form-group form-group-feedback form-group-feedback-right">
															<input type="password" name="password" id="password" class="form-control" required placeholder="Create password">
															<div class="form-control-feedback">
																<i class="icon-lock text-muted"></i>
															</div>
														</div>

														<div class="form-group form-group-feedback form-group-feedback-right">
															<input type="password" name="repeat_password" class="form-control" required placeholder="Repeat password">
															<div class="form-control-feedback">
																<i class="icon-lock text-muted"></i>
															</div>
														</div>
                            

													
														<div class="form-group">
															<button type="submit"  class="btn btn-success btn-block"> Reset Password</button>
														</div>

														<a href="{{url('/')}}" type="submit" class="btn btn-danger btn-block" >Back to Login</a>
												
												</div>
											</div>
					</form>
					<!-- /login form -->

				</div>
@endsection