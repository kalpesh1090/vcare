
@extends('layout.layout')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">

	<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Add Document Type </span>
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
							<label>Name<span class="text-danger">*</span></label>
							<input type="text"  value="" class="form-control" name="name" placeholder="Document Type Name">
                  <span  class="name text-danger"></span>

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
				</div>




                <div class="text-right">
                	<a href="{{url('document_type')}}" id="createBtn" class="btn btn-danger">Cancel</a>
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
        
        url: "{{ route('document_type.post_create') }}",
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
            if(k=="name"){
                $('.name').html(v);
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
          window.location.replace('{{ route("document_type.index")}}');

        }
      });
    });
  });
</script>
@endsection
