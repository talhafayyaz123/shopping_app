<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Wolmart eCommmerce Marketplace HTML Template</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Wolmart eCommmerce Marketplace HTML Template">
    <meta name="author" content="D-THEMES">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('assets/front/images/icons/favicon.png')}}">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{{asset('assets/front/js/webfont.js')}}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="{{asset('assets/front/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{asset('assets/front/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{asset('assets/front/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{asset('assets/front/fonts/wolmart.ttf?png09e')}}" as="font" type="font/ttf" crossorigin="anonymous">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/vendor/fontawesome-free/css/all.min.css')}}">


    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/vendor/magnific-popup/magnific-popup.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front//vendor/owl-carousel/owl.carousel.min.css')}}">


    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/style.min.css')}}">
    <style type="text/css">
        .error{
            color:red;
        }
        .header-search.hs-round.hs-expanded .form-control {
            border-left: 2px solid !important;
        }
    </style>
</head>
<body  class="@if(Request::path() == 'profile') my-account @else home  @endif">
<input type="hidden" id="myurl" url="{!! url('/') !!}" />

<div class="page-wrapper">
    @section('top_header')
        @include('front.includes.top_header')
    @show
    @include('front.includes.flash-messages')
    @yield('content')
    @section('footer')
        @include('front.includes.footer')
    @show
</div>
@section('lower_content')
    @include('front.includes.below_footer_content')
@show
@section('script')
    <!-- Plugin JS File -->
    <script src="{{asset('assets/front/vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


    <script src="{{asset('assets/front/vendor/jquery.plugin/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('assets/front/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/front/vendor/zoom/jquery.zoom.js')}}"></script>
    <script src="{{asset('assets/front/vendor/jquery.countdown/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('assets/front/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/front/vendor/skrollr/skrollr.js')}}"></script>
    <script src="{{asset('assets/front/vendor/sticky/sticky.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/front/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script>
        var base_path = '{!! url('/') !!}';
        function check_qty(val) {
            if(val!=''){
                if(val > Number($('#varient_qty').val())){
                    $('.quantity').val($('#varient_qty').val());
                }
            }
        }

         function update_wishlist(product_id, variant_id) {

        $.ajax({
            type: "GET",
            url: '{{url('product_wishlist_update')}}/'+ product_id+'/'+variant_id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
            }
        });
    }

        function add_to_cart() {

            var id = $('#selected_varient_id').val();

            var quantity = $('.quantity').val();

            $.ajax({
                type: "GET",
                url: '{{url('product_cart_update')}}/' + id + '/' + quantity,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {

                    $('#cart_' + id).hide();
                    $('#checkout_' + id).show();

                    setTimeout(function () {

                        $.ajax({
                            type: "GET",
                            url: '{{url('get-cart-item')}}',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function (result) {

                                if (result.success) {

                                    $('.cart_items_nav_bar').html(result.html);
                                }


                            }
                        });

                    }, 1000);


                }
            });
        }
    </script>

@show
@stack('javascript_section')
</body>
