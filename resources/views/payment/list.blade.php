@extends('layout.layout')
@section('content')

<!-- Page header -->
<div class="page-header page-header-light">

    <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item active">Payment list

                </span>
            </div>

            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
        </div>

        


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

        <table id="return_tbl" class="table mt-3" style="width:100%">
            <thead>
                <tr>
                    <th >Sr No.#</th>
                    <th>Invoice Date</th>
                    <th>Invoice Number</th>
                    <th>Name</th>
                    <th>Pan Number</th>
                    <th>Financial Year</th>
                    <th>Total Amount</th>
                    <th>Status</th>                          
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
$(function () {

    $("#search").on('click', function () {
        // alert("hi");
        $('#return_tbl').DataTable().ajax.reload();

    })

    $('#return_tbl').DataTable({

        processing: true,
        serverSide: true,
        sDom: 'RfrtlipB',
        ajax: {
            type: 'GET',
            url: base_url + '/getpaymentdata',
            data: function (params) {
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
            {"data": 1,
                "render": function (data, type, row) {

                }
            },
            {

                "data": 2,
                "render": function (data, type, row) {

                    var result = 'Vcare#' + row.payment_id;
                    return result;
                }

            },
            {
                "data": "full_name"
                        //  orderable: false
            },
            {
                "data": "pan_number"
                        //  orderable: false
            },

            {
                "data": "year"
                        //  orderable: false
            },
            {"data": 6,
                "render": function (data, type, row) {

                    var result = row.paid_amount;
                    return result;
                }
            },

            {"data": 6,
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

            }

        ]
    });

    $('#admins-table').on('click', '.delete_btn', function (e) {
        e.preventDefault();
        var r = confirm('are_you_sure_to_delete');
        if (r == false) {
            return false;
        }
        var href = $(this).attr('href');
        $.get(href, function (data) {
            $('#admins-table').DataTable().ajax.reload();
        });
    });

    $(".dataTables_filter").wrap("<div class='filterSearch' style='display:none;'></div>");

    // $( ".table-striped" ).wrap( "<div class='new-Tblover' style='overflow:auto'></div>" );

});
</script>
@endsection