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
            th{
                width: 500px;
    background-color: white;
            }
        </style>


        <div class="card-body">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 20px;">
                <table id="w0" class="table table-striped table-bordered detail-view">
                              <tbody>
                                  <tr>
                                      <th>PAN Number</th>
                                      <td>{{$Income_tax_return->pan_number}}</td>

                                  </tr>
                                  <tr>
                                      <th>ITR Financial Year</th>
                                      <td>{{$Income_tax_return->year}}</td>

                                  </tr>
                                  <tr>
                                      <th>First Name</th>
                                      <td>{{$Income_tax_return->first_name}}</td>

                                  </tr>
                                  <tr>
                                      <th>Last Name </th>
                                                                           <td>{{$Income_tax_return->last_name}}</td>


                                  </tr>
                                  <tr>
                                      <th>Father's Name</th>
                                                                           <td>{{$Income_tax_return->father_name}}</td>


                                  </tr>
                                  <tr>
                                      <th>Gender</th>
                                                                           <td>@if($Income_tax_return->sex==1) Male @else Female @endif</td>


                                  </tr>
                                  <tr>
                                      <th>Relationship</th>
                                                                           <td>{{$Income_tax_return->relationship_nama}}</td>


                                  </tr>
                                  <tr>
                                      <th>Flat/Door/Block No*</th>
                                                                           <td>{{$Income_tax_return->block_no}}</td>


                                  </tr>
                                  <tr>
                                      <th>Name of Premises/Building/Village</th>
                                                                           <td>{{$Income_tax_return->name_of_Premises}}</td>


                                  </tr>
                                  <tr>
                                      <th>Road/Street/Post Office</th>
                                                                           <td>{{$Income_tax_return->street}}</td>


                                  </tr>
                                  <tr>
                                      <th>Area/ Locality</th>
                                                                           <td>{{$Income_tax_return->locality}}</td>


                                  </tr>
                                  <tr>
                                      <th>Pin</th>
                                                                           <td>{{$Income_tax_return->pin}}</td>


                                  </tr>
                                  <tr>
                                      <th>Country</th>
                                                                           <td>{{$Income_tax_return->country_name}}</td>


                                  </tr>
                                  <tr>
                                      <th>State</th>
                                                                           <td>{{$Income_tax_return->state_name}}</td>


                                  </tr>
                                  <tr>
                                      <th>Town/ City/ District</th>
                                                                           <td>{{$Income_tax_return->district_name}}</td>


                                  </tr>
                                  <tr>
                                      <th>Mobile</th>
                                                                           <td>{{$Income_tax_return->mobile}}</td>


                                  </tr>
                                  
                                  <tr>
                                      <th>Resident Status</th>
                                                                           <td>{{$Income_tax_return->resident_status}}</td>


                                  </tr>
                                  <tr>
                                      <th>Aadhaar Number (UID)</th>
                                                                           <td>{{$Income_tax_return->aadhaar_number}}</td>


                                  </tr>
                                  <tr>
                                      <th>Email Address (ensure correct email id for ITR communication)</th>
                                                                           <td>{{$Income_tax_return->email_address}}</td>


                                  </tr>
                                  <tr>
                                      <th>Do you have income from salary?</th>
                                                                           <td>{{$Income_tax_return->income_from_salary}}</td>


                                  </tr>
                                  <tr>
                                      <th>Do you have income from house property?</th>
                                                                           <td>{{$Income_tax_return->income_from_house}}</td>


                                  </tr>
                                  <tr>
                                      <th>Do you have share transactions accounting to any capital gain?</th>
                                                                           <td>{{$Income_tax_return->share_transactions}}</td>


                                  </tr>
                                  <tr>
                                      <th>Do you have income from consultancy or profession? </th>
                                                                           <td>{{$Income_tax_return->income_from_consultancy}}</td>


                                  </tr>
                                  <tr>
                                      <th>Were you a Director in a company in previous year?</th>
                                                                           <td>{{$Income_tax_return->director_in_company}}</td>


                                  </tr>
                                


                              </tbody>
                          </table>
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















<script>
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



        // var navListItems = $('div.setup-panel div a'),
        //         allWells = $('.setup-content'),
        //         allNextBtn = $('.nextBtn');

        // allWells.hide();

        // navListItems.click(function (e) {
        //     e.preventDefault();
        //     var $target = $($(this).attr('href')),
        //             $item = $(this);

        //     if (!$item.hasClass('disabled')) {
        //         navListItems.removeClass('btn-primary').addClass('btn-default');
        //         $item.addClass('btn-primary');
        //         allWells.hide();
        //         $target.show();
        //         $target.find('input:eq(0)').focus();
        //     }
        // });

        // allNextBtn.click(function(){
        //     var curStep = $(this).closest(".setup-content"),
        //         curStepBtn = curStep.attr("id"),
        //         nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        //         curInputs = curStep.find("input[type='text'],input[type='url']"),
        //         isValid = true;

        //     $(".form-group").removeClass("has-error");
        //     for(var i=0; i<curInputs.length; i++){
        //         if (!curInputs[i].validity.valid){
        //             isValid = false;
        //             $(curInputs[i]).closest(".form-group").addClass("has-error");
        //         }
        //     }

        //     if (isValid)
        //         nextStepWizard.removeAttr('disabled').trigger('click');
        // });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });

</script>
@endsection