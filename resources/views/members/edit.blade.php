@extends('layout.layout')
@section('content')

<!-- Page header -->
<div class="page-header page-header-light">

    <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item active">Member list
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
                width: 50%;
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

                        </div>
                    </div>
                </div>
            </div>
            <form id="tex_form" role="form">  
                @csrf
                <div class="setup-content" id="step-1">

                <div class="row">
                <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                    <select id="status" name="status" class="custom-select" required>
                                    <option value="">Choose Status</option> 
                                    @foreach ($statuses as $status )
                                    <option name="status"{{ ($editData['status'] == $status->status_code) ? 'selected="selected"' : ''}} value="{{$status->status_code}}" id="">{{$status->status_name}}</option>
                                    @endforeach     
                                </select>
                                <span  class="status text-danger"></span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>PAN Number <span class="text-danger">*</span></label>
                                <input type="text" name="pan_number" class="form-control" required placeholder="Permanent Account Number" value="{{$editData['pan_number']}}">
                                <span  class="pan_number text-danger"></span>

                            </div>
                        </div>
                      

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control" required placeholder="As per PAN CARD" value="{{$editData->first_name}}">
                                <span  class="first_name text-danger"></span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" required placeholder="As per PAN CARD" value="{{$editData->last_name}}">
                                <span  class="last_name text-danger"></span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Father's Name <span class="text-danger">*</span></label>
                                <input type="text" name="father_name" class="form-control" required placeholder="Father's Name" value="{{$editData->father_name}}">
                                <span  class="father_name text-danger"></span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Gender <span class="text-danger"></span></label>
                                <select name="sex" id="" class="form-control">
                                    <option value="">--Select--</option>
                                    <option  {{ ($editData->sex == "1") ? 'selected="selected"' : ''}} value="1">Male</option>
                                    <option  {{ ($editData->sex == "0") ? 'selected="selected"' : ''}} value="0">Female</option>
                                </select>
                                <span  class="sex text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Relationship <span class="text-danger">*</span></label>
                                <select id="relationship" name="relationship" class="custom-select" required>
                                    <option value="">Choose relationship</option> 
                                    @foreach ($relationship as $r )
                                    <option  {{ ($editData['relationship'] == $r->id) ? 'selected="selected"' : ''}} value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach     
                                </select>
                                <span  class="relationship text-danger"></span>

                            </div>
                        </div>
                      
                        <div class="col-lg-6" id="other"<?php
                        if ($editData['relationship_other'] == 17) {
                            
                        } else {
                            echo 'style="display: none"';
                        }
                        ?>  >
                            <div class="form-group">
                                <label>Other relationship <span class="text-danger">*</span></label>
                                <input type="text" name="other_relation" class="form-control" required placeholder="Other relationship" value="{{$editData['relationship_other']}}">
                                <span  class="relationship text-danger"></span>

                            </div>
                        </div>

                    </div>
                    <input hidden name="validation" value="" type="text">
                    <div class="row col-md-12">
                        <button id="first"  class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                    </div>
                </div>
                <!-- </form> -->
                <div class="setup-content" id="step-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Flat/Door/Block No<span class="text-danger">*</span></label>
                                <input type="text" name="block_no" class="form-control" required placeholder="Flat/Door/Block No" value="{{$editData->block_no}}" >
                                <span  class="block_no text-danger"></span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name of Premises/Building/Village </label>
                                <input type="text" name="name_of_Premises" class="form-control"  placeholder="Name of Premises/Building/Village" value="{{$editData->name_of_Premises}}">
                                <span  class="name_of_Premises text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Road/Street/Post Office  <span class="text-danger">*</span></label>
                                <input type="text" name="street" class="form-control"  placeholder="Road/Street/Post Office" value="{{$editData->street}}" >
                                <span  class="street text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Area/ Locality</label>
                                <input type="text" name="locality" required class="form-control"  placeholder="Area/ Locality"value="{{$editData->locality}}" >
                                <span  class="locality text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pin</label>
                                <input type="text" name="pin" required class="form-control"  placeholder="Pin" value="{{$editData->pin}}">
                                <span  class="pin text-danger"></span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select id="country" name="country" class="custom-select" required>
                                    <option value="">Choose Country</option> 
                                    @foreach ($countries as $country )
                                    <option {{ ($editData->country == $country->id ) ? 'selected="selected"' : ''}} value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach     
                                </select>    
                                <span  class="country text-danger"></span>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>State <span class="text-danger">*</span></label>
                                <select id="state" name="state" class="custom-select" required>
                                    <option value="">Choose State</option> 
                                    @foreach ($states as $state )
                                    <option {{ ($editData->state == $state->id ) ? 'selected="selected"' : ''}} value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach     
                                </select> 
                                <span  class="state text-danger"></span>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Town/ City/ District  <span class="text-danger">*</span></label>
                                <select id="city" name="city" class="custom-select" required>
                                    <option value="">Choose District</option> 
                                    @foreach ($districts as $district )
                                    <option {{ ($editData->city == $district->id ) ? 'selected="selected"' : ''}} value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach     
                                </select>                         
                                <span  class="city text-danger"></span>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mobile <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" required class="form-control"  placeholder="Mobile" value="{{$editData->mobile}}">
                                <span  class="mobile text-danger"></span>

                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="">Choose an option</option> 
                                    <option value="Individual" {{ ($editData['status'] == "Individual") ? 'selected="selected"' : ''}}>Individual</option>
                                    <option value="Individual" {{ ($editData['status'] == "HUF") ? 'selected="selected"' : ''}}>HUF</option>
                                    <option value="Individual" {{ ($editData['status'] == "Company") ? 'selected="selected"' : ''}}>Company</option>
                                    <option value="Individual" {{ ($editData['status'] == "Firm") ? 'selected="selected"' : ''}}>Firm</option>
                                    <option value="Individual" {{ ($editData['status'] == "AOP and BOI") ? 'selected="selected"' : ''}}>AOP and BOI</option>
                                    <option value="Individual" {{ ($editData['status'] == "Local Authority") ? 'selected="selected"' : ''}}>Local Authority</option>
                                    <option value="Individual" {{ ($editData['status'] == "Artificial Juridical Person") ? 'selected="selected"' : ''}}>Artificial Juridical Person</option>
                                </select>
                                <span  class="status text-danger"></span>

                            </div>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resident Status <span class="text-danger">*</span></label>
                                <select name="resident_status" class="form-control" required>
                                    <option value="">Choose an option</option> 
                                    <option {{ ($editData->resident_status == "Resident") ? 'selected="selected"' : ''}} value="Resident">Resident</option>
                                    <option {{ ($editData->resident_status == "Non-Resident") ? 'selected="selected"' : ''}} value="Non-Resident">Non-Resident</option>
                                    <option {{ ($editData->resident_status == "Not Ordinarly Resident") ? 'selected="selected"' : ''}} value="Not Ordinarly Resident">Not Ordinarly Resident</option>
                                </select>
                                <span  class="resident_status text-danger"></span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Aadhaar Number (UID) <span class="text-danger">*</span></label>
                                <input type="text" name="aadhaar_number" required class="form-control"  placeholder="Aadhaar Number (UID)" value="{{$editData->aadhaar_number}}">
                                <span  class="aadhaar_number text-danger"></span>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email Address (ensure correct email id for ITR communication) </label>
                                <input type="text" name="email_id" required class="form-control"  placeholder="Email Address (ensure correct email id for ITR communication)" value="{{$editData->email_address}}">
                                <span  class="email_id text-danger"></span>

                            </div>
                        </div>
                    </div> 
                    <div class="row col-md-12">
                        <button id="second" class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                    </div>                             
                </div>
        </div>
    </div>     
</div>
<!-- /form validation -->

</div>
@endsection     
@section('header-scripts')
<script>
    let boxes = Array.from(document.getElementsByClassName('setup-content'));
    function selectBox(id) {
        boxes.foreach(b => {
            b.classList.toggle('selected', b.id === id);
        });
    }
    boxes.forEach(b => {
        let id = b.id;
        b.addEventListener('click', e => {
            history.pushState({id}, `Selected: ${id}`, `./selected=${id}`)
            selectBox(id);
        });
    });
    window.addEventListener('popstate', e => {
        if (e.state !== null)
            selectBox(e.state.id);

    });
</script>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
    jQuery(function ($) {
        $(document).on('change', "#country", function () {
            $.get('{{route("members.create.get_state")}}', {
                country_id: $("#country").val(),
            },
                    function (data) {
                        var formoption = "<option value=''>Choose State </option>";
                        $.each(data.states, function (k, v) {
                            // console.log(v.name);
                            formoption += "<option value='" + v.id + "'>" + v.name + "</option>";

                        });
                        $('#state').append(formoption);

                    });
            $('#state').empty();

        })
        $(document).on('change', "#state", function () {
            $.get('{{route("members.create.get_city")}}', {
                state_id: $("#state").val(),
            },
                    function (data) {
                        var formoption = "<option value=''>Choose District </option>";
                        $.each(data.cities, function (k, v) {
                            console.log(v.name);
                            formoption += "<option value='" + v.id + "'>" + v.name + "</option>";

                        });
                        $('#city').append(formoption);

                    });
            $('#city').empty();

        })

        $(document).on('click', '#first', function (e) {
            $('[name="validation"]').val("1");
        })
        $(document).on('click', '#second', function (e) {
            $('[name="validation"]').val("2");
        })
        $(document).on('click', '.nextBtn', function (e) {
            e.preventDefault();
            var fd = new FormData($('#tex_form')[0]);
            $('.text-danger').html('');



            $.ajax({
                url: "{{ route('members.update', ['id' => $editData->id]) }}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function ()
                {
                    $('#updateBtn').attr('disabled', true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (error) {
                    var error = error.responseJSON;
                    // console.log(error); 
                    $.each(error.errors, function (k, v) {
                        if (k == "itr_financial_year") {
                            $('.itr_financial_year').html(v);
                        }
                     
                        if (k == "first_name") {
                            $('.first_name').html(v);
                        }
                        if (k == "pan_number") {
                            $('.pan_number').html(v);
                        }
                        if (k == "last_name") {
                            $('.last_name').html(v);
                        }
                        if (k == "father_name") {
                            $('.father_name').html(v);
                        }
                        if (k == "sex") {
                            $('.sex').html(v);
                        }
                        if (k == "block_no") {
                            $('.block_no').html(v);
                        }
                        if (k == "locality") {
                            $('.locality').html(v);
                        }
                        if (k == "name_of_Premises") {
                            $('.name_of_Premises').html(v);
                        }
                        if (k == "street") {
                            $('.street').html(v);
                        }
                        if (k == "city") {
                            $('.city').html(v);
                        }
                        if (k == "pin") {
                            $('.pin').html(v);
                        }
                        if (k == "state") {
                            $('.state').html(v);
                        }
                        if (k == "country") {
                            $('.country').html(v);
                        }
                        if (k == "mobile") {
                            $('.mobile').html(v);
                        }
                        if (k == "status") {
                            $('.status').html(v);
                        }
                        if (k == "resident_status") {
                            $('.resident_status').html(v);
                        }
                        if (k == "resident_status_details") {
                            $('.resident_status_details').html(v);
                        }
                        if (k == "aadhaar_number") {
                            $('.aadhaar_number').html(v);
                        }
                        if (k == "email_id") {
                            $('.email_id').html(v);
                        }
                    });




                },
                success: function (data)
                {
                    if (data.success == true) {
                        var notification = alertify.notify('Data updated successfully.', 'success', 6);
                    }

                    $('#updateBtn').attr('disabled', false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    if ($('[name="validation"]').val() == "2") {
                        window.location.replace('{{ route("members.index")}}');
                    }
                    // window.location.replace('{{ route("members.index")}}');

                }
            });
        });
    });
</script>











<script>




    $(document).ready(function () {






        var edit_id = '<?php echo isset($editData->id) ? $editData->id : ""; ?>';
        if (edit_id != "") {
            getDocList(edit_id);
        }

        $('#document_upload').submit(function (e) {

            e.preventDefault();
            let formData = new FormData($(this)[0]);


            $('#document_loading').show();
            $.ajax({
                url: $(this).attr('action'), // le nom du fichier indiqué dans le formulaire
                type: 'post',
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                success: function (data) {
                    if (data.success) {
                        getDocList($('#user_id').val());
                        $('#document_loading').hide();
                        pnotify_success();

                    }
                }
            });

        })


        function getDocList(return_id) {
            //alert(return_id);
            $.ajax({
                url: '<?php echo url("getDocList"); ?>', // le nom du fichier indiqué dans le formulaire
                type: 'post',
                data: {id: return_id},
                success: function (data) {
                    $('#documentList').html(data);
                }
            });
        }



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

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });

    $(document).ready(function () {

        $("#relationship").change(function () {
            //alert($('select[name=relationship]').val())
            var relationship = $('select[name=relationship]').val();
            if (relationship == 17) {
                $('#other').show()
            } else {
                $('#other').hide()
            }
        });


    });
</script>
@endsection