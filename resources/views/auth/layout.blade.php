<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="{!! asset('theme/vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

    <title>Vasudhaiva Accountants</title>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{!! asset('global_assets/css/icons/icomoon/styles.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('assets/css/all.min.css') !!}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{!! asset('assets/css/alertify.min.css') !!}"/>
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{!! asset('global_assets/js/main/jquery.min.js') !!}"></script>
    <script src="{!! asset('global_assets/js/main/bootstrap.bundle.min.js') !!}"></script>
	<script src="{!! asset('global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
	<script src="{!! asset('global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>
	<script src="{!! asset('global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
	<script src="{!! asset('global_assets/js/plugins/uploaders/bs_custom_file_input.min.js') !!}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	
    <script src="{!! asset('assets/js/app.js') !!}"></script>
    
	<script src="{!! asset('global_assets/js/demo_pages/form_validation.js') !!}"></script>
	<script src="{!! asset('assets/js/alertify.min.js') !!}"></script>
	

	<!-- /theme JS files -->

    <style>
    	.validation-valid-label {
		    color: #25b372;
		    display: none !important;
		}
    </style>	

    </head>
    <body class="antialiased">
    	<!-- Main navbar -->
	@include('auth.header')
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
                @yield('content')
				
				<!-- /content area -->


				<!-- Footer -->
                @include('auth.footer')
				
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


    </body>
    @if (session('error'))
        <script type="text/javascript">
        alertify.set('notifier', 'position', 'top-right');
        var notification = alertify.notify('{{ session("error") }}', 'error', 6);
        </script>
        @endif
        @if (session('success'))
        <script type="text/javascript">
            alertify.set('notifier', 'position', 'top-right');
            var notification = alertify.notify('{{ session("success") }}', 'success', 6);
        </script>

        @endif
        @if (session('status'))
        <script type="text/javascript">
            alertify.set('notifier', 'position', 'top-right');
            var notification = alertify.notify(' {{ session('status') }}', 'success', 6);
            
        </script>


        @endif
    </html>