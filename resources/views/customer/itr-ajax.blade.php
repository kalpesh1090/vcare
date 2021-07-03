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
        width: 25%;
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
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle  btn-primary"  disabled="disabled"

                           style="">1</a>
                        <p>PERSONAL INFORMATION</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button"  class="btn btn-default btn-circle" 
                           >2</a>
                        <p>ADDRESS</p>
                    </div>
                    <!--   <div class="stepwizard-step">
                          <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                          <p>INCOME</p>
                      </div> -->

                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" 
                           >3</a>
                        <p>INCOME</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle "
                           >4</a>
                        <p>Document Upload</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="first_form" role="form">

        @csrf           
        <div class="setup-content" id="step-1" >
            <input   type="hidden" id="id_3" name="id" value="" >
            <input   type="hidden" id="member_id" name="member_id" value="{{$editData->id}}" >

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
                        <input type="text" name="pan_number" class="form-control" required placeholder="Permanent Account Number" value="{{$editData->pan_number}}">
                        <span  class="pan_number text-danger"></span>

                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-lg-6">
                    <div class="form-group">
                        <label>ITR Financial Year <span class="text-danger">*</span></label>
                        <select name="itr_financial_year" class="custom-select" required>

                            <option value="{{$financial_years->id}}">{{$financial_years->year}}</option>

                        </select>
                        <span  class="itr_financial_year text-danger"></span>


                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control" required placeholder="As per PAN CARD" value="{{$editData->first_name}}">
                        <span  class="first_name text-danger"></span>

                    </div>
                </div>
               
            </div>

            <div class="row">
            <div class="col-lg-6">
                    <div class="form-group">
                        <label>Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" class="form-control" required placeholder="As per PAN CARD" value="{{$editData->last_name}}">
                        <span  class="last_name text-danger"></span>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Father's Name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" class="form-control" required placeholder="Father's Name" value="{{$editData->father_name}}">
                        <span  class="father_name text-danger"></span>

                    </div>
                </div>
               

            </div>
            <div class="row">
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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Relationship <span class="text-danger">*</span></label>
                        <select id="relationship" name="relationship" class="custom-select" required>
                            <option value="">Choose relationship</option> 
                            @foreach ($relationship as $r )
                            <option  {{ ($editData->relationship == $r->id) ? 'selected="selected"' : ''}} value="{{$r->id}}">{{$r->name}}</option>
                            @endforeach     
                        </select>
                        <span  class="relationship text-danger"></span>

                    </div>
                </div>
                <div class="col-lg-6" id="other"<?php
                if ($editData->relationship == 17) {
                    
                } else {
                    echo 'style="display: none"';
                }
                ?>  >
                    <div class="form-group">
                        <label>Other relationship <span class="text-danger">*</span></label>
                        <input type="text" name="other_relation" class="form-control" required placeholder="Other relationship" value="{{$editData->relationship_other}}">
                        <span  class="relationship text-danger"></span>

                    </div>
                </div>

            </div>
            <input type="hidden" name="validation" value="1" >

            <div class="row col-md-12">
                <button id="first_form_button" class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </form>
    <form id="second_form" action="">
        @csrf           

        <div class="setup-content" id="step-2" >
            <input type="hidden" id="id" class="insert_id" name="id" value="" >

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
                            <option value="Individual" {{ ($editData->status == "Individual") ? 'selected="selected"' : ''}}>Individual</option>
                            <option value="Individual" {{ ($editData->status == "HUF") ? 'selected="selected"' : ''}}>HUF</option>
                            <option value="Individual" {{ ($editData->status == "Company") ? 'selected="selected"' : ''}}>Company</option>
                            <option value="Individual" {{ ($editData->status == "Firm") ? 'selected="selected"' : ''}}>Firm</option>
                            <option value="Individual" {{ ($editData->status == "AOP and BOI") ? 'selected="selected"' : ''}}>AOP and BOI</option>
                            <option value="Individual" {{ ($editData->status == "Local Authority") ? 'selected="selected"' : ''}}>Local Authority</option>
                            <option value="Individual" {{ ($editData->status == "Artificial Juridical Person") ? 'selected="selected"' : ''}}>Artificial Juridical Person</option>
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
                        <input type="text" name="email_address" required class="form-control"  placeholder="Email Address (ensure correct email id for ITR communication)" value="{{$editData->email_address}}">
                        <span  class="email_address text-danger"></span>

                    </div>
                </div>
            </div> 
            <input type="hidden" name="validation" value="2" >

            <div class="row col-md-12">
                <button id="second_form_button" class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>                             
        </div>

    </form>
    <form id="last_form" action="">
        @csrf           
        <div class="setup-content" id="step-3" >
            <input type="hidden"  id="id_1" name="id_1" value="">
            <div class="row">

                <label class="col-form-label col-lg-8">Do you have income from salary?
                    <span class="text-danger">*</span></label>
                <div class="col-lg-4">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="income_from_salary" {{ ($editData->income_from_salary == "Yes") ? 'checked' : ''}} value="Yes" required>
                        <span class="custom-control-label">Yes</span>
                    </label>

                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="income_from_salary" {{ ($editData->income_from_salary == "No") ? 'checked' : ''}}  value="No">

                        <span class="custom-control-label">No</span>
                    </label>
                </div>
            </div>

            <div class="row">

                <label class="col-form-label col-lg-8">Do you have income from house property?
                    <span class="text-danger">*</span></label>
                <div class="col-lg-4">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="income_from_house" {{ ($editData->income_from_house == "Yes") ? 'checked' : ''}} value="Yes" required>
                        <span class="custom-control-label">Yes</span>
                    </label>

                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="income_from_house" {{ ($editData->income_from_house == "No") ? 'checked' : ''}}  value="No">
                        <span class="custom-control-label">No</span>
                    </label>
                </div>
            </div>
            <div class="row">

                <label class="col-form-label col-lg-8">Do you have share transactions accounting to any capital gain?
                    <span class="text-danger">*</span></label>
                <div class="col-lg-4">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="share_transactions" {{ ($editData->share_transactions == "Yes") ? 'checked' : ''}} value="Yes" required>
                        <span class="custom-control-label">Yes</span>
                    </label>

                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="share_transactions" {{ ($editData->share_transactions == "No") ? 'checked' : ''}} value="No">
                        <span class="custom-control-label">No</span>
                    </label>
                </div>
            </div>
            <div class="row">

                <label class="col-form-label col-lg-8">Do you have income from consultancy or profession?
                    <span class="text-danger">*</span></label>
                <div class="col-lg-4">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="income_from_consultancy" {{ ($editData->income_from_consultancy == "Yes") ? 'checked' : ''}} value="Yes" required>
                        <span class="custom-control-label">Yes</span>
                    </label>

                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="income_from_consultancy" {{ ($editData->income_from_consultancy == "No") ? 'checked' : ''}}  value="No">
                        <span class="custom-control-label">No</span>
                    </label>
                </div>
            </div>
            <div class="row">

                <label class="col-form-label col-lg-8">  Were you a Director in a company in previous year?
                    <span class="text-danger">*</span></label>
                <div class="col-lg-4">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="director_in_company" {{ ($editData->director_in_company == "Yes") ? 'checked' : ''}}  value="Yes" required>
                        <span class="custom-control-label">Yes</span>
                    </label>

                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="director_in_company" {{ ($editData->director_in_company == "No") ? 'checked' : ''}}  value="No">
                        <span class="custom-control-label">No</span>
                    </label>
                </div>
            </div>

            <input type="hidden" name="validation" value="3" >
            <div class="row col-md-12">
                <button id="last_form_button" class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>  
        </div>

    </form>
    <form id="document_upload" ma class="document-validate-jquery" action="{{url('/upload_doc')}}">
        @csrf           
        <div class="setup-content" id="step-4" >

            <div class="documentList" id="documentList"></div>
            <fieldset class="mb-3">
                <input type="hidden" name="income_tax_returns_id" id="user_id" value="" required class="form-control">


                <!-- /basic text input -->
                <div class="input_fields_wrap">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3">
                                <!--input type="text" name="document_name[]" required class="form-control"  placeholder="Document Name"-->

                                <select name="document_name[]" class="custom-select" required>
                                    <option value="">Choose ITR Document Type</option> 
                                    @foreach ($documentTypes as $documentTypes )
                                    <option value="{{$documentTypes->id}}">{{$documentTypes->name}}</option>
                                    @endforeach    
                                </select>

                            </div>
                            <div class="col-lg-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input required" name="document_file[]">
                                    <label class="custom-file-label" for="customFile">Please attach Document </label>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="d-flex  align-items-left">
                                    <div id="document_loading" style="display:none">
                                        <i class="icon-spinner2 spinner mr-2"></i>
                                    </div>
                                    <button type="submit" class="btn btn-primary ml-3">
                                        Upload  </button>

                                        <div class="paynow" id="paynow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php /* <div class="d-flex align-items-center">
                  <button type="button" class="btn btn-light ml-3 add_field_button"><i class="icon-file-plus ml-2"></i> Add</button>
                  </div>
                  <?php */ ?>
            </fieldset>
        </div>

    </form>


</div>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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


        //
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



        $(document).on('change', "#country", function () {
            $.get('{{route("Income-Tax-Return.create.get_state")}}', {
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
            $.get('{{route("Income-Tax-Return.create.get_city")}}', {
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
        $(document).on('click', '#first_form_button', function (e) {
            e.preventDefault();



            // $('[name="mobile"]').val(($('[name="mobile"]').val()).replace(/ /g, ''));
            var fd = new FormData($('#first_form')[0]);
            $('.text-danger').html('');

            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url'],select"),
                    isValid = true;


            $.ajax({
                url: "{{route('Income-Tax-Return.store')}}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function ()
                {
                    $('#createBtn').attr('disabled', true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (error) {

                    var error = error.responseJSON;
                    $.each(error.errors, function (k, v) {

                        if (k == "itr_financial_year") {
                            $('.itr_financial_year').html(v);
                        }
                        if (k == "pan_number") {
                            $('.pan_number').html(v);   
                        }
                        if (k == "status") {
                            $('.status').html(v);
                        }
                        if (k == "first_name") {
                            $('.first_name').html(v);
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
                    });

                },
                success: function (data)
                {


                    // history.pushState(null, '', 'create/'); 

                    $('#id').val(data.form_id);
                    $('#id_3').val(data.form_id);

                    $('#createBtn').attr('disabled', false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');


                    nextStepWizard.removeAttr('disabled').trigger('click');


                }
            });
        });
        $(document).on('click', '#second_form_button', function (e) {
            e.preventDefault();
            // $('[name="mobile"]').val(($('[name="mobile"]').val()).replace(/ /g, ''));
            var fd = new FormData($('#second_form')[0]);

            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url'],select"),
                    isValid = true;

            // var id=$("#id").val();
            $('.text-danger').html('');
            $.ajax({

                url: "{{route('Income-Tax-Return.store')}}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function ()
                {
                    $('#createBtn').attr('disabled', true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (error) {

                    var error = error.responseJSON;
                    $.each(error.errors, function (k, v) {
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
                      
                        if (k == "resident_status") {
                            $('.resident_status').html(v);
                        }
                        if (k == "resident_status_details") {
                            $('.resident_status_details').html(v);
                        }
                        if (k == "aadhaar_number") {
                            $('.aadhaar_number').html(v);
                        }
                        if (k == "email_address") {
                            $('.email_address').html(v);
                        }
                    });

                },
                success: function (data)
                {
                    $('#createBtn').attr('disabled', false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    $('#id_1').val(data.form_id);
                    nextStepWizard.removeAttr('disabled').trigger('click');



                }
            });
        });
        $(document).on('click', '#last_form_button', function (e) {
            e.preventDefault();

// alert("hi");
            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url'],select"),
                    isValid = true;

            // $('[name="mobile"]').val(($('[name="mobile"]').val()).replace(/ /g, ''));
            var fd = new FormData($('#last_form')[0]);
            // var id=$("#id").val();

            $.ajax({

                url: "{{route('Income-Tax-Return.store')}}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function ()
                {
                    $('#createBtn').attr('disabled', true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    console.log(exception);
                },
                success: function (data)
                {
                    $('#createBtn').attr('disabled', false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    //window.location.replace('{{ asset("/Income-Tax-Return")}}');
                    $('#user_id').val(data.form_id);
                    nextStepWizard.removeAttr('disabled').trigger('click');


                    $('#paynow').html('<a href="{{route("subscription")}}'+data.form_id+'"  class="btn btn-danger ml-3" >Payment to procced</a>');

                }
            });
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


            $('div.setup-panel div a.btn-primary').trigger('click');
        });
        // var navListItems = $('div.setup-panel div a'),
        //         allWells = $('.setup-content'),
        //         allNextBtn = $('.nextBtn');

        // allWells.hide();





    });

</script>    