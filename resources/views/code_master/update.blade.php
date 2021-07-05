
@extends('layout.layout')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">

	<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Update Subscription </span>
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
            
@csrf

<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label>Promo Code<span class="text-danger">*</span></label>
							<input name="promo_code" style="color: black; font-size: larger;" type="text"   value="{{$code_master->code_name}}" class="form-control" name="promo_code" placeholder="Promo Code">
                  <span  class="promo_code text-danger"></span>

						</div>
            <input type="number" class="" name="id" value="{{$code_master->id}}" hidden>

                <div class="col-lg-6">
                <label>Company Name<span class="text-danger">*</span></label>
							<input type="text"  value="{{$code_master->company_name}}" class="form-control" name="company_name" placeholder="Company Name">
                  <span  class="company_name text-danger"></span>
				
                </div>
                
					</div>
          <div class="row">
          <div class="col-lg-6">
                <label>start Date<span class="text-danger">*</span></label>
							<input type="text"  value="{{\Carbon\Carbon::parse($code_master->start_date)->format('d/m/Y')}}" class="date form-control" name="start_date" placeholder="Start Date">
                  <span  class="start_date text-danger"></span>
				
                </div>  
          <div class="col-lg-6">
                <label>End Date<span class="text-danger">*</span></label>
							<input type="text"   value="{{\Carbon\Carbon::parse($code_master->end_date)->format('d/m/Y')}}" class="date form-control" name="end_date" placeholder="End Date">
                  <span  class="end_date text-danger"></span>
				
                </div>
						<div class="col-lg-6">
						
                  <label>Status<span class="text-danger">*</span></label>
                            <select name="status" class="custom-select" >
                                 
                            <option {{($code_master->status==1)? 'selected="selected"' : ''}}  value="1">Active</option>
                                 <option{{($code_master->status==2)? 'selected="selected"' : ''}} value="2">Inactive</option>
                                                            
                             </select>		
                             <span  class="status text-danger"></span>
						</div>
					
             
					</div>
				</div>





                <div class="text-right">
                                        <a href="{{url('master_code')}}" id="createBtn" class="btn btn-danger">Cancel</a>
                	<button type="button" id="createBtn" class="btn btn-primary">Submit</button>

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
    $(document).on('click', '#createBtn', function(e) {
        $('.text-danger').html('');
      e.preventDefault();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: "{{ route('master_code.post_update') }}",
        data:  new FormData($('form')[0]),
        processData: false,
        contentType: false,
          encode  : true,

        dataType: 'json',
        type: 'POST',
        beforeSend: function() {
        },
        error: function(error){

var error=error.responseJSON;
$.each(error.errors,function(k,v){
    console.log(k)
    if(k=="name"){
        $('.name').html(v);
    }
    if(k=="amount"){
        $('.amount').html(v);
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
</script>
@endsection
