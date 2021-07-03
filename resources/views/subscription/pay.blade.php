
@extends('layout.layout')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">

	<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Payment Detail</span>
			</div>

			<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
		</div>

		
	</div>
</div>
<div class="content">

	<!-- Form inputs -->
	<div class="card">
		

		<div class="card-body">

			
			
			<form action="{{route('payment')}}" method="post">
            @csrf

            <input type="text" name="user" value="{{$user->id}}" hidden>
            <input type="text" name="plan" value="{{$plan->id}}" hidden>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label>Party Name</label>
							<input type="text"  value="{{$name}}" class="form-control" name="party_name" placeholder="Party Name">
						</div>
						<div class="col-lg-6">
							<label>Email ID</label>
							<input  type="text" value="{{$user->email_address}}" class="form-control" name="email" placeholder="Email ID">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-lg-4">
							<label>Address	</label>
							<input  type="text" value="{{$user->street}}" class="form-control" name="adddress" placeholder="Address">
						</div>
						<div class="col-lg-4">
							<label>State</label>
							<!-- <input  type="text" value="{{$user->state}}" name="state" class="form-control" placeholder="State"> -->
							<select id="state" name="state" class="custom-select" required>
                                <option value="">Choose State</option> 
                                @foreach ($states as $state )
                                <option {{ ($user->state == $state->id ) ? 'selected="selected"' : ''}} value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach     
                            </select> 
						</div>

						<div class="col-lg-4">
							<label>City	</label>
							<!-- <input  type="text" value="{{$user->city}}" name="city" class="form-control" placeholder="City	"> -->
							 <select id="city" name="city" class="custom-select" required>
                                <option value="">Choose District</option> 
                                @foreach ($districts as $district )
                                <option {{ ($user->city == $district->id ) ? 'selected="selected"' : ''}} value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach     
                            </select>     
						</div>
						
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-lg-4">
							<label>Mobile Number</label>
							<input  type="text" value="{{$user->mobile}}" name="mobile" class="form-control" placeholder="Mobile Number">
							
							                		</div>
						<div class="col-lg-4">
							<label>Business Name</label>
							<input type="text" value="" name="business_name" class="form-control" placeholder="Business Name">
						</div>
						<div class="col-lg-4">
							<label>GST Number</label>
							<input type="text" value="" name="gst_number" class="form-control" placeholder="GST Number">
						</div>
					</div>
				</div>

				<div class="form-group alert alert-success text-right  pt-1 pb-1">
					<span class="pul-right text-right col-md-12">Plan Name : {{$plan->name}}|{{number_format($plan->amount,2)}}</span> 
					
				</div>	
                <div class="text-right">
                	<!-- <button type="submit" class="pay_amount btn btn-primary">Procced</button> -->
                	
                </div>
			</form>
			@if(Session::has('amount'))
					<div class="container tex-center">
								<form action="{{route('pay')}}" method="POST">
					            <script
					    src="https://checkout.razorpay.com/v1/checkout.js"
					    data-key="{{env('RAZORPAY_KEY')}}"
					    data-amount="{{Session::get('amount')}}" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
					    data-currency="INR"// You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
					    data-buttontext="Pay with Razorpay"
					    data-name="{{$name}}"
					    data-order_id="{{Session::get('order_id')}}"
					    data-description=""
					    data-prefill.name="{{$name}}"
					    data-prefill.email="{{$plan->email_address}}"
					    data-theme.color="#2196F3"
					>
					</script>
					<input type="hidden" value="" custom="Hidden Element" name="hidden">
					</form>
					</div>
					@endif

		</div>
	</div>
	<!-- /form inputs -->
</div>

@endsection
@section('header-scripts')
	<style>
		.razorpay-payment-button {
		    padding: 10px;
		    background-color: #2196f3;
		    border: 1px #2196f3;
		    color: #fff;
		    border-radius: 5px;
		}
	</style>	
@endsection
