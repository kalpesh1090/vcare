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
    </div>
</div>
<!-- /page header -->
<div class="content">
    <!-- Form inputs -->
    <div class="card">
        <div class="card-body">
            <form action="{{ url('member-itr-data') }}" id="create_itr" class="flex-fill form-validate-jquery" method="POST">
                @csrf 
                <fieldset class="mb-3">
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <select name="member_id" id="member_id" class="custom-select" required>
                                <option value="">--Select Member--</option> 
                                @foreach ($memberList as $list )
                                <option  value="{{$list->id}}">{{$list->full_name}}</option>
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select name="itr_financial_year" id="itr_financial_year" class="custom-select" required>
                                <option value="">--Financial Year--</option> 
                                @foreach ($financial_years as $financial_years )
                                <option  value="{{$financial_years->id}}">{{$financial_years->year}}</option>
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <input type="submit" class="btn btn-primary" value="Submit" >
                        </div>
                    </div>
                </fieldset>

            </form>
        </div>

        <div class="all-step"></div>
    </div>
    <!-- /form inputs -->

</div>

</div>
@endsection  
@section('header-scripts')
@endsection    
@section('footer-scripts') 
<script>
    //
    $('#create_itr').submit(function (e) {


        e.preventDefault();
        let formData = new FormData($(this)[0]);


        var pageUrl = '?member_id=' + $('#member_id').val() + '&year_id=' + $('#itr_financial_year').val();
        window.history.pushState('', '', pageUrl);


        $('#document_loading').show();
        $.ajax({
            url: $(this).attr('action'), // le nom du fichier indiqué dans le formulaire
            type: 'post',
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            error: function (jqXHR, exception) {
                console.log(exception);
            },
            success: function (data) {

                $('.all-step').html(data);

            }
        });

    })
</script> 
@endsection