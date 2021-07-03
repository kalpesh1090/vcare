
@extends('layout.layout')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">

	<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Update Financial Year </span>
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
							<label>Name<span class="text-danger">*</span></label>
							<input type="text"  value="{{$financial_year->year}}" class="form-control" name="year" placeholder="Name">
                            <span  class="year text-danger"></span>

						</div>
            <input type="text" hidden name="id" value="{{$financial_year->id}}">
        
						<div class="col-lg-6">
							<label>Status<span class="text-danger">*</span></label>
                            <select name="status" class="custom-select" >
                                 
                                 <option {{($financial_year->status=1)? 'selected="selected"' : ''}}  value="1">Active</option>
                                 <option {{($financial_year->status=2)? 'selected="selected"' : ''}}   value="2">Inactive</option>
                                                        
                             </select>		
                             <span  class="status text-danger"></span>
				
                         </div>
					</div>
				</div>




                <div class="text-right">

                    <a href="{{url('financial_year')}}" id="createBtn" class="btn btn-danger">Cancel</a>
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
   jQuery(function($) {
    $(document).on('click', '#createBtn', function(e) {
        $('.text-danger').html('');
      e.preventDefault();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: "{{ route('financial_year.post_update') }}",
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
    if(k=="year"){
        $('year').html(v);
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
          window.location.replace('{{ route("financial_year.index")}}');

        }
      });
    });
  });
</script>
@endsection
