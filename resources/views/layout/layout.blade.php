<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Vasudhaiva Accountants</title>
        <link rel="shortcut icon" href="{{url('../favicon.png')}}" />
        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link href="{!! asset('global_assets/css/icons/icomoon/styles.min.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('assets/datepicker/datepicker3.css') !!}" rel="stylesheet" type="text/css">


        <link href="{!! asset('assets/css/all.min.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('global_assets/css/icons/icomoon/styles.min.css') !!}" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
        <!-- Core JS files -->
        <script src="{!! asset('global_assets/js/main/jquery.min.js') !!}"></script>

        <script src="{!! asset('global_assets/js/main/bootstrap.bundle.min.js') !!}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="{!! asset('global_assets/js/plugins/visualization/d3/d3.min.js') !!}"></script>
        <script src="{!! asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js') !!}"></script>
        <script src="{!! asset('global_assets/js/plugins/ui/moment/moment.min.js') !!}"></script>
        <script src="{!! asset('global_assets/js/plugins/pickers/daterangepicker.js') !!}"></script>
        <script src="{!! asset('assets/js/app.js') !!}"></script>
        <script src="{!! asset('assets/datepicker/bootstrap-datepicker.js') !!}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
        <script>
var base_url = '<?php echo url('') ?>';
        </script>
        <style>
            .validation-valid-label {
                color: #25b372;
                display: none !important;
            }
            .nav-sidebar .nav-item:not(.nav-item-header):first-child {
                padding-top: 0rem;
            }

            .ajs-message{
                color: #fff;
            }
            .ajs-error{
                color: #fff;
            } 
            .ajs-visible{
                color: #fff;
            }
            .bg-indigo {
                background-color: #47a5f1!important;
            }
            .sidebar-light .nav-sidebar>.nav-item>.nav-link.active {
                background-color: #dff1ff;
                color: #333;
            }

            .sidebar-user-material {
                background: url(assets/images/logo.jpg) center center no-repeat; 
                background-size: cover;

            }
            .icon-resize{
                font-size: 20px !important;
            }
        </style>

        @yield('header-scripts')
        <!-- /theme JS files -->

    </head>

    <body>

        <!-- Main navbar -->
        @include('layout.navbar')
        <!-- /main navbar -->


        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            @include('layout.sidebar')
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Inner content -->
                <div class="content-inner">
                    @yield('content')
                    <!-- Footer -->
                    @include('layout.footer')
                    <!-- /footer -->

                </div>
                <!-- /inner content -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </body>
    @yield('footer-scripts')

    <script>
        alertify.set('notifier', 'position', 'top-right');
        deferred = "http://somewhere.com", { email: 'kapesj@CRant.com', message: 'message' };
    </script>

    @if (session('error'))
    <script type="text/javascript">
        alertify.set('notifier', 'position', 'top-right');
        var notification = alertify.notify('{{ session("error") }}', 'error', 6);</script>
    @endif
    @if (session('success'))
    <script type="text/javascript">
        alertify.set('notifier', 'position', 'top-right');
        var notification = alertify.notify('{{ session("success") }}', 'success', 6);</script>

    @endif

</html>
<script type="text/javascript">
           
        </script>
