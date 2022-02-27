<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        QShopping's
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Web font -->
    <script src="https://cdn.bootcss.com/webfont/1.6.16/webfontloader.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <!--begin::Page Vendors -->
    <link href="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors -->
    <link href="{{asset('assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="{{asset('assets/demo/default/media/img/logo/favicon.ico')}}"/>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="{{asset('css/image-uploader.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/admincss.css')}}">

    <style>
        .btn-group-sm>.btn [class*=" la-"], .btn-group-sm>.btn [class^=la-], .btn-sm [class*=" la-"], .btn-sm [class^=la-] {
            font-size: 20px;
        }
        .modal-confirm {
            color: #636363;
            width: 400px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }
        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }
        .modal-confirm .modal-body {
            color: #999;
        }
        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }
        .modal-confirm .modal-footer a {
            color: #999;
        }
        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }
        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }
        .modal-confirm .btn, .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }
        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }
        .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }
        .modal-confirm .btn-danger {
            background: #f15e5e;
        }
        .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }
        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
</head>

@guest
    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-3" id="m_login" style="background-image: url({{asset('assets/app/media/img//bg/bg-2.jpg')}});">
            @yield('login_content')
        </div>
        </div>
    <!-- end::Scroll Top -->            <!-- begin::Quick Nav -->
    @section('scripts')
        <!-- begin::Quick Nav -->
        <!--begin::Base Scripts -->
        <script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
        <!--end::Base Scripts -->
        <!--begin::Page Snippets -->
        <script src="{{asset('assets/app/js/dashboard.js')}}" type="text/javascript"></script>
        <!--end::Page Snippets -->
    @show
        @stack('javascript_section')
    </body>
@else
    <!-- end::Head -->
    <!--begin::body-->
    <body
        class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

    {{--    including header filer--}}
    @section('header')
        @include('includes.header')
    @show

    <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        {{--        including sidebar file--}}
        @section('sidebar')
            @include('includes.sidebar')
        @show
        <!-- end left side bar -->
            <!-- BEGIN: Subheader -->
            {{--    @include('partials.notification')--}}
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                @section('sub_header')
                    @include('includes.sub_header')
                @show
                {{--        end subheader--}}
                <div class="m-content">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- end:: Body -->
        @section('footer')
            @include('includes.footer')
        @show
        {{--    footer ends--}}
    </div>
    <!-- end:: pgae -->
    <!-- begin::Scroll Top -->
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
         data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>

    <!-- end::Scroll Top -->            <!-- begin::Quick Nav -->
    @section('scripts')
        <!-- begin::Quick Nav -->
        <!--begin::Base Scripts -->
        <script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
        <!--end::Base Scripts -->
        <!--begin::Page Vendors -->
        <script src="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}"
                type="text/javascript"></script>
        <!--end::Page Vendors -->
        <!--begin::Page Snippets -->
        <script src="{{asset('assets/app/js/dashboard.js')}}" type="text/javascript"></script>
        <!--end::Page Snippets -->
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <!--begin::Page Resources -->
        <script src="{{asset('assets/demo/default/custom/components/forms/widgets/input-mask.js')}}" type="text/javascript"></script>
        <!--end::Page Resources -->
        <script type="text/javascript" src="{{asset('js/image-uploader.min.js')}}"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": 0,
                "extendedTimeOut": 0,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": false
            };

        </script>
    @show
    @stack('javascript_section')
    </body>
@endguest
</html>
