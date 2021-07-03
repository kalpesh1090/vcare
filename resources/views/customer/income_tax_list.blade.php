@extends('layout.layout')
@section('content')

				<!-- Page header -->
				<div class="page-header page-header-light">

					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
								<span class="breadcrumb-item active">File Income Tax Return list

</span>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<!-- <div class="d-flex justify-content-center">
                            <a class="btn btn-info text-right pull-right float-right btn-xm"  href="{{url('create-itr')}}" style="padding: 4px 10px;">File ITR</a>
						</div> -->

						
					</div>
				</div>
				<!-- /page header -->

				<!-- Content area -->
				<div class="content">

					<!-- Form validation -->
					<div class="card">
					<form id="search_form" action="">

						<div class="card-body">
							<div class="row" style="padding-bottom:10px;">
                                <div class="col-lg-3">
                                    <input type="text" name="itr_name" class="form-control" placeholder="ITR Name">
                                    
                                </div>
								

								<div class="col-lg-3">
									<input type="text" name="pan_number" class="form-control" placeholder="Pan Number">
									
								</div>
                                <div class="col-lg-3">
                                    <input type="text" name="aadhaar_number" class="form-control" placeholder="Aadhaar Number">
                                    
                                </div>
								
								<div class="col-lg-3">
									<button type="button" id="search" class="btn btn-primary">Search</button>
								</div>	
							</div>
                        
                            
							</form>
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-info  pull-right float-right "  href="{{url('create-itr')}}" >File ITR</a>
                                </div>
                            </div>    
                            
                            
							<table id="return_tbl" class="table mt-3" style="width:100%">
                                <thead>
                                    <tr>
                                        <th >Sr No.#</th>
                                        <th>Name</th>
                                        <th>Father Name</th>
                                        <th>Pan Number</th>
                                        <th>Submited Date</th>
                                        <!-- <th>Upload</th> -->
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
    background-color: #d6ddff1f;
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
                url: base_url + '/getreturndata',
                data: function(params) {
                    params.aadhaar_number = $('[name="aadhaar_number"]').val();
                    params.pan_number = $('[name="pan_number"]').val();
                    params.itr_name = $('[name="itr_name"]').val();
                }
            },
            columns: [
			    {
                    "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
				{
                    "data": "full_name"
                    //  orderable: false
                },
                
                {
                    "data": "father_name"
                    //  orderable: false
                },
                {
                    "data": "pan_number"
                    //  orderable: false
                },
				{"data": 1,
                "render": function (data, type, row) {

                    var result = moment(row.created_at).format('D MMM YYYY');
                    return result;
                }
            },
			
		
			
				{"data": 4,
                "render": function (data, type, row) {
                    var out='';
                   
                    if(row.current_status == '0'){
                        out += '<a href="javascript:;" class="btn btn-danger btn-sm">Incomplete</a>';    
                    }else if(row.current_status == '1'){
                        out +='&nbsp<a href="{{route("subscription")}}/'+row.id+'" class="btn btn-success btn-sm">Pay Now</a>'
                    }else if(row.current_status == '2'){
                        out +='&nbsp<a href="#" class="btn btn-success btn-sm">Paid</a>'
                    }                   

                    
                    return out;
                }
            },
				{"data": 5, "searchable": false, "orderable": false,
                "render": function (data, type, row) {
                    var id = row.id;
                    var out = '';
                    out += '<a title="Edit" href="' + base_url + '/Income-Tax-Return/' + id + '/edit" class="text-info "><i class="icon-pencil7"></i></a>&nbsp;';
                    if(row.current_status != '2'){
                    out += '<a title="Delete" class="text-danger delete_btn"  href="' + base_url + '/Income-Tax-Return/delete/' + id + '"><i class="icon-trash"></i></a>';
                    }
                    out += '&nbsp;<a title="View" href="' + base_url + '/Income-Tax-Return/view/' + id + '" class="text-info "><i class="icon-zoomin3"></i></a>&nbsp;';

                    return out;
                }
            },
            ]
        });

        $('#return_tbl').on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var r = confirm('are_you_sure_to_delete');
            if (r == false) {
                return false;
            }

            var href = $(this).attr('href');
            $.get(href, function(data) {

                // $('#return_tbl').DataTable().ajax.reload();
            });
            $('#return_tbl').DataTable().ajax.reload();

        });

        $( ".dataTables_filter" ).wrap( "<div class='filterSearch' style='display:none;'></div>" );

        // $( ".table-striped" ).wrap( "<div class='new-Tblover' style='overflow:auto'></div>" );

    });
</script>
@endsection