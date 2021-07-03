@extends('layout.layout')
@section('content')

				<!-- Page header -->
				<div class="page-header page-header-light">

					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
								<span class="breadcrumb-item active">State List

</span>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<div class="d-flex justify-content-center">
                            <a class="btn btn-info text-right pull-right float-right btn-xm"  href="{{url('state/get_create')}}" style="padding: 4px 10px;">Add</a>
						</div>

						
					</div>
				</div>
				<!-- /page header -->

				<!-- Content area -->
				<div class="content">

					<!-- Form validation -->
					<div class="card">
                    <div class="card-body">
							<table id="return_tbl" class="table mt-3" style="width:100%">
                                <thead>
                                    <tr>
                                        <th >Sr No.#</th>
                                        <th>Name</th>
                                        <th>Country Name</th>
                                        <th>Status</th>                          
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>     
					</div>
					<!-- /form validation -->

				</div>
@endsection  
@section('header-scripts')
<style>

	.dataTables_length {
	    float: left;
	    display: inline-block;
	    margin: 0 0 0rem 0rem;
        width: 30% !important;
	}
	.btn-group-sm>.btn, .btn-sm {
    padding: 0px 5px;
    font-size: 12px;
    line-height: 21px;
    border-radius: .1875rem;
}

.table th {
    transition: background-color ease-in-out .15s;
    background-color: #3f51b51f;
    border-top: 1px solid #a6a1a1;
}
.table {
    border-bottom: 1px solid #a6a1a1;
    margin-bottom: 5px;
}
</style>	
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection    

@section('footer-scripts')  
<script type="text/javascript">
    $(function() {

        $("#search").on('click',function(){
            // alert("hi");
            $('#return_tbl').DataTable().ajax.reload();

        })

        $('#return_tbl').DataTable({
            
            processing: true,
            serverSide: true,
            sDom : 'RfrtlipB',
            ajax: {
                type: 'GET',
                url: base_url + '/state/list',
                data: function(params) {
                    params.aadhaar_number = $('[name="aadhaar_number"]').val();
                    params.pan_number = $('[name="pan_number"]').val();
                    params.itr_name = $('[name="itr_name"]').val();
                }
            },
            columns: [
			    {
                    "data": "id"
                    //  orderable: false

                },
				{
                    "data": "name"
                    //  orderable: false
                },
                {
                    "data": "country_name"
                    //  orderable: false
                },
                
                {
                    "data": "status",
                    "mRender": function(data, type, row) {
                        if (data==1) {
                            return "Active";
                            
                        } else
                            return "Inactive";
                    },
                    //  orderable: false
                },
               
			
			
		
			
				
				{"data": 6, "searchable": false, "orderable": false,
                "render": function (data, type, row) {
                    var id = row.id;
                    var out = '';
                    out += '<a title="Edit" href="' + base_url + '/state/get_update/' + id + '" class="text-info "><i class="icon-pencil7"></i></a>&nbsp;';
                    out += '<a title="Delete" class="text-danger delete_btn"  href="' + base_url + '/state/delete/' + id + '"><i class="icon-trash"></i></a>';
                    out += '&nbsp;<a title="View" href="' + base_url + '/state/delete/' + id + '" class="text-info "><i class="icon-zoomin3"></i></a>&nbsp;';

                    return out;
                }
            },
            ]
        });

        $('#return_tbl').on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var r = confirm('Are You sure to delete');
            if (r == false) {
                return false;
            }

            var href = $(this).attr('href');
            $.get(href, function(data) {
                alertify.set('notifier', 'position', 'top-right');
            var notification = alertify.notify("data deleted successfully", 'success', 6);
            $('#return_tbl').DataTable().ajax.reload();
            });

        });

        // $( ".dataTables_filter" ).wrap( "<div class='filterSearch' style='display:none;'></div>" );

        // $( ".table-striped" ).wrap( "<div class='new-Tblover' style='overflow:auto'></div>" );

    });
</script>
@endsection