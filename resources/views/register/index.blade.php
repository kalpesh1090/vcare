@extends('layout.layout')
@section('content')

				<!-- Page header -->
				<div class="page-header page-header-light">

					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
								<span class="breadcrumb-item active">Users List

</span>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<div class="d-flex justify-content-center">
                            <a class="btn btn-info text-right pull-right float-right btn-xm"  href="{{url('user_registration/get_create')}}" style="padding: 4px 10px;">Add</a>
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
                                        <th>Email</th>
                                        <th>Mobile</th>
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
var status='';
var user_id='';
        $("#search").on('click',function(){
            // alert("hi");
            $('#return_tbl').DataTable().ajax.reload();

        })
        $('#return_tbl').on('click', '.status', function(e) {
            // alert("hii");
            e.preventDefault();
             status = $(this).attr('data-id');
             user_id = $(this).attr('data-user_id');
             

            if(status==1){
                var r = confirm('Are You sure  to verify Email');

            }
            if(status==2){
                var r = confirm('Are You sure to Active');

            }
            if(status==3){
                var r = confirm('Are You sure to Inactive');

            }

            if (r == false) {
                return false;
            }
            $('#return_tbl').DataTable().ajax.reload();
            
        }
    );
        $('#return_tbl').DataTable({
            
            processing: true,
            serverSide: true,
            sDom : 'RfrtlipB',
            ajax: {
                type: 'GET',
                url: base_url + '/user_registration/list',
                data: function(params) {
                    params.aadhaar_number = $('[name="aadhaar_number"]').val();
                    params.pan_number = $('[name="pan_number"]').val();
                    params.itr_name = $('[name="itr_name"]').val();
                    params.status = status;
                    params.user_id = user_id;
                }
            },
            columns: [
			    {
                    "data": "id"
                    //  orderable: false

                },
				{
                    "data": "full_name"
                    //  orderable: false
                },
                {
                    "data": "email"
                    //  orderable: false
                },
                {
                    "data": "mobile"
                    //  orderable: false
                },
                
                {"data": 5,
                "render": function (data, type, row) {
                    var out='';
                    if(row.status == '0'){
                        out += '<a data-id="1" data-user_id="'+row.id+'" href="#" id="status" class="status btn btn-danger btn-sm">Verify Email</a>';    
                    }else if(row.status == '1'){
                        out +='&nbsp<a data-id="2" data-user_id="'+row.id+'" id="status" href="#" class="status btn btn-success btn-sm">Inactive</a>'
                    }else if(row.status == '2'){
                        out +='&nbsp<a data-id="3" data-user_id="'+row.id+'" href="#" id="status" class="status btn btn-success btn-sm">Active</a>'
                    } 


                    return out;
                }

            },
               
			
			
		
			
				
				{"data": 6, "searchable": false, "orderable": false,
                "render": function (data, type, row) {
                    var id = row.id;
                    var out = '';
                    out += '<a title="Edit" href="' + base_url + '/user_registration/get_update/' + id + '" class="text-info "><i class="icon-pencil7"></i></a>&nbsp;';
                    out += '<a title="Delete" class="text-danger delete_btn"  href="' + base_url + '/user_registration/delete/' + id + '"><i class="icon-trash"></i></a>';
                    out += '&nbsp;<a title="View" href="' + base_url + '/user_registration/delete/' + id +'" class="text-info "><i class="icon-zoomin3"></i></a>&nbsp;';
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
            $('#return_tbl').DataTable().ajax.reload();            });

        });

        // $( ".dataTables_filter" ).wrap( "<div class='filterSearch' style='display:none;'></div>" );

        // $( ".table-striped" ).wrap( "<div class='new-Tblover' style='overflow:auto'></div>" );

    });
</script>
@endsection