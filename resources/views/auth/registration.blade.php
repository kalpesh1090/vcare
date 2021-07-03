@extends('auth.layout')
@section('content')
<div class="content d-flex justify-content-center align-items-center">

					<!-- Registration form -->
                    <form action="{{ route('register.post') }}" class="flex-fill form-validate-jquery" method="POST">
                          @csrf
					
						<div class="row">
							<div class="col-lg-6 offset-lg-3">
								<div class="card mb-0">
									<div class="card-body">
										<div class="text-center mb-3">
											<img  src="{{url('global_assets/images/logo-light.png')}}" style="width: 220px;">
											
											<h4 class="text-primary class="mb-0 mt-2"">Vcare: Employee First Program</h4>   
											
											
											<h5 class="mb-0 mt-3">Create account</h5>
											<span class="d-block text-muted">All fields are required</span>
										</div>
                                        <div class="row">
                                        <div class="col-lg-6">
										<div class="form-group form-group-feedback form-group-feedback-right">
											<input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required placeholder="First Name">
											<div class="form-control-feedback">
												<i class="icon-user-plus text-muted"></i>
											</div>
										</div>
                                        </div>
                                        <div class="col-lg-6">
												<div class="form-group form-group-feedback form-group-feedback-right">
													<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"  required placeholder="Last name">
													<div class="form-control-feedback">
														<i class="icon-user-plus text-muted"></i>
													</div>
												</div>
											</div>
                                            </div>
										<div class="row">


                                            <div class="col-lg-6">
												<div class="form-group form-group-feedback form-group-feedback-right">
													<input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Your email">
													<div class="form-control-feedback">
														<i class="icon-mention text-muted"></i>
													</div>
												</div>
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
											</div>

											<div class="col-lg-6">
												<div class="form-group form-group-feedback form-group-feedback-right">
													<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required placeholder="Mobile Number">
													<div class="form-control-feedback">
														<i class="icon-mobile text-muted"></i>
													</div>
												</div>
                                                @if ($errors->has('mobile'))
                                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                @endif
											</div>
										</div>

										<div class="row">
											<div class="col-lg-6">
												<div class="form-group form-group-feedback form-group-feedback-right">
													<input type="password" name="password" id="password" class="form-control" required placeholder="Create password">
													<div class="form-control-feedback">
														<i class="icon-lock text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group form-group-feedback form-group-feedback-right">
													<input type="password" name="repeat_password" class="form-control" required placeholder="Repeat password">
													<div class="form-control-feedback">
														<i class="icon-lock text-muted"></i>
													</div>
												</div>
											</div>
										</div>


										<div class="form-group mb-0">

											<label class="custom-control custom-checkbox">
												<input type="checkbox" name="terms_service" value="Yes" id="terms_service" class="custom-control-input" required>
												<span class="custom-control-label">Accept <a href="#" data-toggle="modal" data-target="#exampleModalCenter">&nbsp;terms of service</a></span>
											</label>
										</div>


										<!-- Button trigger modal -->
									

									<!-- Modal -->
									<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Terms of service</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										The content of this document is only for your general information and use is not intended to address any particular requirements. The content & our services does not constitute any form of advice recommendation or arrangement & is not intended to be relied upon by you in making or refraining from making any specific decision. Appropriate independent advice should be obtained before making any such decision. When addressed to our clients, any opinions or advice contained in any document or any attachments/inserts or otherwise in any form are subject to the terms and conditions expressed in the governing terms of business and the advise or opinions is of the individual sending the doc/ mail and not of the organisation, for which the organization is not liable as the organisation is on a complete non-advisory mode & only provides operational assistance to execute your instructions. Opinions, conclusions & other info in this document & any attachments, which do not relate to the official business of the firm are neither given nor endorsed by it. E-mail communications, data & info given to us can’t be guaranteed to be secure or error free, as information could be intercepted, corrupted, amended, lost, destroyed, arrive late or incomplete or contain viruses. We do not accept liability for any such matters or their consequences. Anyone who communicates with us is taken to accept the risks in doing so. Subject to applicable law, we may monitor, review and retain documents, info, e-communications travelling through its networks/systems & offices. The laws of the country of each sender/recipient may impact the handling of communication & docs and communication & documents may be archived, supervised and produced in countries other than the country in which you are located. This message cannot be guaranteed to be secure or error-free. By messaging or engaging or working or associating with us in any manner whatsoever, you consent to the above.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											
										</div>
										</div>
									</div>
									</div>
									</div>

									<div class="card-footer bg-transparent ">
										<a href="{{url('/')}}" type="submit" class="btn btn-danger text-left" >Back to Login</a>
										<button type="submit" class="btn btn-teal btn-labeled btn-labeled-right float-right"><b><i class="icon-plus3"></i></b> Create account</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!-- /registration form -->

				</div>
@endsection
