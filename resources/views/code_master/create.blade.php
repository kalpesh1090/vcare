
@extends('layout.layout')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">

	<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Add Promo Code</span>
			</div>

			<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
		</div>


	</div>
</div>
<div class="content">

	<!-- Form inputs -->
	<div class="card">


		<div class="card-body">

			<form >
            

      <meta name="csrf-token" content="{{ csrf_token() }}">


				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label>Promo Code<span class="text-danger">*</span></label>
							<input name="promo_code" style="color: black; font-size: larger;" type="text"   value="{{$promo_code}}" class="form-control" name="promo_code" placeholder="Promo Code">
                  <span  class="promo_code text-danger"></span>

						</div>
					
                <div class="col-lg-6">
                <label>Company Name<span class="text-danger">*</span></label>
							<input type="text"  value="" class="form-control" name="company_name" placeholder="Company Name">
                  <span  class="company_name text-danger"></span>
				
                </div>
                
					</div>
          <div class="row">
          <div class="col-lg-6">
                <label>start Date<span class="text-danger">*</span></label>
							<input type="text" readOnly  value="" class="date form-control" name="start_date" placeholder="Start Date">
                  <span  class="start_date text-danger"></span>
				
                </div>  
          <div class="col-lg-6">
                <label>End Date<span class="text-danger">*</span></label>
							<input type="text" readOnly   value="" class="date form-control" name="end_date" placeholder="End Date">
                  <span  class="end_date text-danger"></span>
				
                </div>
						<div class="col-lg-6">
						
                  <label>Status<span class="text-danger">*</span></label>
                            <select name="status" class="custom-select" >
                                 
                                 <option value="1">Active</option>
                                 <option value="2">Inactive</option>
                                                        
                             </select>		
                             <span  class="status text-danger"></span>
						</div>
					
             
					</div>

                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <h4>Create Plans</h4>
                        </div>
                    </div>
                    <div class="row " style="background: #e5e5e5;padding: 12px;font-size: 16px;">
                        <div class="col-md-7">Place Title</div>
                        <div class="col-md-2">Standard Amount</div>
                        <div class="col-md-2">Discount Amount</div>
                    </div>
                    <div class="row no-data" style="padding: 12px;font-size: 16px;text-align: center;">
                        <div class="col-md-12">data not found.</div>
                    </div>
                    <div class="add_more"></div>


                    <div class="row" style="padding: 12px;font-size: 16px;">
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="plne_title" placeholder="Plan Title">
                            <span class="plne_title_error text-danger"></span>
                        </div>
                        <div class="col-md-2"><input type="text" class="form-control" id="standard_amount"  placeholder="Standard Amount">
                            <span class="standard_amount_error text-danger"></span>
                        </div>
                        <div class="col-md-2"><input type="text" class="form-control" id="discount_amount" placeholder="Discount Amount">
                            <span class="discount_amount_error text-danger"></span>
                        </div>
                        <div class="col-md-2"><button type="button" class="btn btn-danger" id="add_plan">Add</button></div>
                    </div>

    
				</div>




                <div class="text-right">
                  <a href="{{url('master_code')}}" id="createBtn" class="btn btn-danger">Cancel</a>
                	<button type="button" id="createBtn" class="btn btn-primary">save</button>

                </div>
			</form>


		</div>
	</div>
	<!-- /form inputs -->
</div>

@endsection
@section('footer-scripts')

<script type="text/javascript">
$('.date').datepicker({
        autoclose: true
    })
  jQuery(function($) {
    
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

    $(document).on('click', '#createBtn', function(e) {
        $('.text-danger').html('');
      e.preventDefault();
      $.ajax({
        
        url: "{{ route('master_code.post_create') }}",
        data: new FormData($('form')[0]),
        processData: false,
        contentType: false,
        dataType: 'json',
        type: 'POST',
                 cache: false,
        beforeSend: function() {
          $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
        },
        error: function(error){

        var error=error.responseJSON;

        $.each(error.errors,function(k,v){
            console.log(k)
            if(k=="promo_code"){
                $('.promo_code').html(v);
            }
            if(k=="start_date"){
                $('.start_date').html(v);
            }
            if(k=="end_date"){
                $('.end_date').html(v);
            }
            if(k=="company_name"){
                $('.company_name').html(v);
            }
            if(k=="status"){
                $('.status').html(v);
            }        
        });                           

},
        success: function(data) {
          
          alertify.set('notifier', 'position', 'top-right');
            var notification = alertify.notify(data.message, 'success', 6);
          $('#createBtn').attr('disabled', false);
          $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
          window.location.replace('{{ route("master_code.index")}}');

        }
      });
    });
  });
  






    $('#add_plan').click(function(){

        $('.plne_title_error').html('');
        $('.standard_amount_error').html('');
        $('.discount_amount_error').html('');
        
        var plne_title=$('#plne_title').val();
        var standard_amount=$('#standard_amount').val();
        var discount_amount=$('#discount_amount').val();
        var errors=true;
        if(plne_title == ''){
            errors=false;
            $('.plne_title_error').html('This field required');
        }

        if(standard_amount == ''){
            errors=false;
            $('.standard_amount_error').html('This field required');
        }
        if (isNaN($('#standard_amount').val())) {
            errors=false;
            $('.standard_amount_error').html('Allow only number.');
        }
        
        if(discount_amount == ''){
            errors=false;
            $('.discount_amount_error').html('This field required');
        }
        if (isNaN($('#discount_amount').val())) {
            errors=false;
            $('.discount_amount_error').html('Allow only number.');
        }
        if(errors){
            $( ".no-data" ).remove();
            var html ='<div class="row" style="padding: 12px;font-size: 16px;"><div class="col-md-7">'+plne_title+'</div><div class="col-md-2">'+standard_amount+'</div><div class="col-md-2">'+discount_amount+'</div><input type="hidden" value="'+plne_title+'" name="plan_titles[]"><input type="hidden" value="'+standard_amount+'" name="standard_amount[]"><input type="hidden" value="'+discount_amount+'" name="discount_amount[]"></div>';

            $('.add_more').append(html);
            $('#plne_title').val('');
            $('#standard_amount').val('');
            $('#discount_amount').val('');
        }

    });
  </script>

@endsection
