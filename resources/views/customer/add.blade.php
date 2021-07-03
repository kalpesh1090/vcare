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

						<div class="d-flex justify-content-center">
															<a class="btn btn-info text-right pull-right float-right btn-xm"  href="{{url('Income-Tax-Return/create')}}" style="padding: 4px 10px;">Add</a>
								
							</div>

						
					</div>
				</div>
				<!-- /page header -->

				<!-- Content area -->
				<div class="content">

					<!-- Form validation -->
					<div class="card">
                        <style type="text/css">
                           
                            .stepwizard-step p {
                                margin-top: 10px;

                            }

                            .stepwizard-row {
                                display: table-row;
                            }

                            .stepwizard {
                                display: table;
                                width: 100%;
                                position: relative;
                            }

                            .stepwizard-step button[disabled] {
                                opacity: 1 !important;
                                filter: alpha(opacity=100) !important;
                            }

                            .stepwizard-row:before {
                                top: 14px;
                                bottom: 0;
                                position: absolute;
                                content: " ";
                                width: 100%;
                                height: 1px;
                                background-color: #ccc;
                                z-order: 0;

                            }

                            .stepwizard-step {
                                display: table-cell;
                                text-align: center;
                                position: relative;
                                width: 33%;
                            }

                            .btn-circle {
                              width: 30px;
                              height: 30px;
                              text-align: center;
                              padding: 6px 0;
                              font-size: 12px;
                              line-height: 1.428571429;
                              border-radius: 15px;
                            }
                            .has-error .form-control {
                                border-color: #a94442;
                                -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
                                box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
                            }

                            .has-error label{
                                color: #a94442;

                            }   
                        </style>


                    <div class="card-body">    
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <div class="stepwizard">
                                    <div class="stepwizard-row setup-panel">
                                        <div class="stepwizard-step">
                                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                            <p>PERSONAL INFORMATION</p>
                                        </div>
                                        <div class="stepwizard-step">
                                            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                            <p>ADDRESS</p>
                                        </div>
                                        <div class="stepwizard-step">
                                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                            <p>INCOME</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form role="form">
                            <div class="setup-content" id="step-1">

                                <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>ITR Financial Year <span class="text-danger">*</span></label>
                                                <select name="styled_select" class="custom-select form-control" required>
                                                    <option value="">--Select--</option>     
                                                    <option value="FY20-21">FY20-21</option>
                                                    <option value="AY21-22">AY21-22</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PAN Number <span class="text-danger">*</span></label>
                                                <input type="text" name="pan_number" class="form-control" required placeholder="Permanent Account Number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input type="text" name="first_name" class="form-control" required placeholder="As per PAN CARD">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                <input type="text" name="last_name" class="form-control" required placeholder="As per PAN CARD">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Father's Name <span class="text-danger">*</span></label>
                                                <input type="text" name="father_name" class="form-control" required placeholder="Father's Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Gender <span class="text-danger"></span></label>
                                                
                                                <select name="" id="" class="form-control">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Male</option>
                                                    <option value="0">Female</option>


                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-md-12">
                                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                    </div>
                            </div>
                            
                            <div class="setup-content" id="step-2">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Flat/Door/Block No<span class="text-danger">*</span></label>
                                            <input type="text" name="block_no" class="form-control" required placeholder="Flat/Door/Block No">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Name of Premises/Building/Village </label>
                                            <input type="text" name="name_of_Premises" class="form-control"  placeholder="Name of Premises/Building/Village">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Road/Street/Post Office  <span class="text-danger">*</span></label>
                                            <input type="text" name="street" class="form-control"  placeholder="Road/Street/Post Office">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Area/ Locality</label>
                                            <input type="text" name="locality" required class="form-control"  placeholder="Area/ Locality">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Pin</label>
                                            <input type="text" name="pin" required class="form-control"  placeholder="Pin">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" name="country" required class="form-control"  placeholder="Country">
                                        </div>
                                    </div>
                                    
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>State <span class="text-danger">*</span></label>
                                            <input type="text" name="state" required class="form-control"  placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>District  <span class="text-danger">*</span></label>
                                            <input type="text" name="district" required class="form-control"  placeholder="">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Mobile <span class="text-danger">*</span></label>
                                            <input type="text" name="mobile" required class="form-control"  placeholder="Mobile">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                    <option value="">Choose an option</option> 
                                                    <option value="Individual">Individual</option>
                                                    
                                                </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Resident Status <span class="text-danger">*</span></label>
                                            <select name="resident_status" class="form-control" required>
                                                    <option value="">Choose an option</option> 
                                                    <option value="Resident">Resident</option>
                                                    <option value="Non-Resident">Non-Resident</option>
                                                    <option value="Not Ordinarly Resident">Not Ordinarly Resident</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Resident Status Details</label>
                                             <input type="text" name="resident_status_details" required class="form-control"  placeholder="Resident Status Details">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Aadhaar Number (UID) <span class="text-danger">*</span></label>
                                            <input type="text" name="state" required class="form-control"  placeholder="Aadhaar Number (UID)">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email Address (ensure correct email id for ITR communication) </label>
                                             <input type="text" name="email_id" required class="form-control"  placeholder="Email Address (ensure correct email id for ITR communication)">
                                        </div>
                                    </div>
                                </div> 
                                <div class="row col-md-12">
                                    

                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                </div>                             
                            </div>
                            <div class="setup-content" id="step-3">
                                <div class="row">

                                    <label class="col-form-label col-lg-8">Do you have income from salary?
<span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="income_from_salary" value="Yes" required>
                                            <span class="custom-control-label">Yes</span>
                                        </label>

                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="income_from_salary"  value="No">
                                            <span class="custom-control-label">No</span>
                                        </label>
                                    </div>
                                  </div>

                                  <div class="row">

                                    <label class="col-form-label col-lg-8">Do you have income from house property?
                                       <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="income_from_house" value="Yes" required>
                                            <span class="custom-control-label">Yes</span>
                                        </label>

                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="income_from_house"  value="No">
                                            <span class="custom-control-label">No</span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="row">

                                    <label class="col-form-label col-lg-8">Do you have share transactions accounting to any capital gain?
                                       <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="share_transactions" value="Yes" required>
                                            <span class="custom-control-label">Yes</span>
                                        </label>

                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="share_transactions"  value="No">
                                            <span class="custom-control-label">No</span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="row">

                                    <label class="col-form-label col-lg-8">Do you have income from consultancy or profession?
                                       <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="income_from_consultancy" value="Yes" required>
                                            <span class="custom-control-label">Yes</span>
                                        </label>

                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="income_from_consultancy"  value="No">
                                            <span class="custom-control-label">No</span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="row">

                                    <label class="col-form-label col-lg-8">  Were you a Director in a company in previous year?
                                       <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="director_in_company" value="Yes" required>
                                            <span class="custom-control-label">Yes</span>
                                        </label>

                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="director_in_company"  value="No">
                                            <span class="custom-control-label">No</span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="row col-md-12">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                </div>  
                            </div>

                        </form>


                    </div>





				

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
	}
	.btn-group-sm>.btn, .btn-sm {
    padding: 0px 5px;
    font-size: 12px;
    line-height: 21px;
    border-radius: .1875rem;
}

.table th {
    transition: background-color ease-in-out .15s;
    background-color: #e5e5e5;
    border-top: 1px solid #a6a1a1;
}
.table {
    border-bottom: 1px solid #a6a1a1;
}
</style>	
	<script src="{!! asset('global_assets/js/main/jquery.min.js') !!}"></script>
    <script src="{!! asset('global_assets/js/main/bootstrap.bundle.min.js') !!}"></script>
	<script src="{!! asset('global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
	<script src="{!! asset('global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>
	<script src="{!! asset('global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
	<script src="{!! asset('global_assets/js/plugins/uploaders/bs_custom_file_input.min.js') !!}"></script>
    <script src="{!! asset('global_assets/js/plugins/notifications/pnotify.min.js') !!}"></script>
    
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<!-- <script src="{!! asset('datatable/returnList.js') !!}"></script> -->
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
            ajax: {
                type: 'GET',
                url: base_url + '/getreturndata',
                data: function(params) {
                    params.sr_number = $('[name="sr_number"]').val();
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
                    "data": "id"
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
			{
                    "data": "full_name", 
                    //  orderable: false,
					 searchable:false
                },
		
			{"taregts": 4,
                "render": function (data, type, row) {

                   var out = '<a href="javascript:;" class="btn btn-info btn-sm"><i class="icon-plus2"></i></a>';

                   return out;
                }
            },
				{"data": 5,
                "render": function (data, type, row) {
                    var out='';
                    if(row.current_status == '0'){
                        out += '<a href="javascript:;" class="btn btn-danger btn-sm">Pending</a>';    
                    }else if(row.current_status == '1'){
                        out += '<a href="javascript:;" class="btn btn-danger btn-sm">Test</a>';    
                    }
                    out +='&nbsp<a href="{{route("subscription")}}/'+row.id+'" class="btn btn-success btn-sm">Pay</a>'
                    
                    return out;
                }
            },
				{"data": 6, "searchable": false, "orderable": false,
                "render": function (data, type, row) {
                    var id = row.id;
                    var out = '';
                    out += '<a title="Edit" href="' + base_url + '/Income-Tax-Return/' + id + '/edit" class="text-info "><i class="icon-pencil7"></i></a>&nbsp;';
                    out += '<a title="Delete" class="text-danger delete_btn" onclick="delete_record(' + id + ')" href="' + base_url + '/company/job/delete/' + id + '"><i class="icon-trash"></i></a>';
                    out += '&nbsp;<a title="View" href="' + base_url + '/company/job/view/' + id + '" class="text-info "><i class="icon-zoomin3"></i></a>&nbsp;';

                    return out;
                }
            },
            ]
        });

        $('#admins-table').on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var r = confirm('are_you_sure_to_delete');
            if (r == false) {
                return false;
            }
            var href = $(this).attr('href');
            $.get(href, function(data) {
                $('#admins-table').DataTable().ajax.reload();
            });
        });

        $( ".dataTables_filter" ).wrap( "<div class='filterSearch' style='display:none;'></div>" );

        // $( ".table-striped" ).wrap( "<div class='new-Tblover' style='overflow:auto'></div>" );

    });















    $(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],select"),
            isValid = true;

         $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
        });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
@endsection