@extends('layouts.front_master')
@section('content')
    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/vendor/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/vendor/animate/animate.min.css')}}">
    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/demo1.min.css')}}">
    <style>
        .intro-slide .slide-image {
            position: initial;
            width: 100%;
        }
        .product-media img .product_home_page_image{
            height: 300px !important;
        }
    </style>
    <!-- Start of Main-->
    <main class="main">
        <section class="intro-section">
            <div class="owl-carousel owl-theme owl-nav-inner owl-dot-inner owl-nav-lg animation-slider gutter-no row cols-1"
                 data-owl-options="{
                    'nav': true,
                    'dots': true,
                    'items': 1,
                    'responsive': {
                        '400': {
                            'nav': true,
                            'dots': false
                        }
                    }
                }">
                @foreach($sliders as $key => $slider)
                    <div class="banner banner-fixed intro-slide intro-slide1"
                         style="background-image: url({{asset('assets/front/images/demos/demo1/sliders/slide-1.jpg')}}); background-color: #ebeef2;">
                        <div class="container">
                            <figure class="slide-image skrollable slide-animate">
                                <img src="{{asset('assets/uploads/banners/'.$slider->image->first()->image)}}"
                                     alt="Banner"
                                     data-bottom-top="transform: translateY(10vh);"
                                     data-top-bottom="transform: translateY(-10vh);">
                            </figure>
                        </div>
                        <!-- End of .banner-content -->
                    </div>
            @endforeach
            <!-- End of .container -->
            </div>
            <!-- End of .intro-slide1 -->
            </div>
            <!-- End of .owl-carousel -->
        </section>
        <!-- End of .intro-section -->

        <div class="container">
            <div class="owl-carousel owl-theme row cols-md-4 cols-sm-3 cols-1icon-box-wrapper appear-animate br-sm mt-6 mb-6"
                 data-owl-options="{
                    'nav': false,
                    'dots': false,
                    'loop': false,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '576': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        },
                        '992': {
                            'items': 3
                        },
                        '1200': {
                            'items': 4
                        }
                    }
                }">
                <div class="icon-box icon-box-side icon-box-primary">
                        <span class="icon-box-icon icon-shipping">
                            <i class="w-icon-truck"></i>
                        </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
                        <p class="text-default">For all orders over $99</p>
                    </div>
                </div>
                <div class="icon-box icon-box-side icon-box-primary">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                        <p class="text-default">We ensure secure payment</p>
                    </div>
                </div>
                <div class="icon-box icon-box-side icon-box-primary icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
                        <p class="text-default">Any back within 30 days</p>
                    </div>
                </div>
                <div class="icon-box icon-box-side icon-box-primary icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                        <p class="text-default">Call or email us 24/7</p>
                    </div>
                </div>
            </div>
            <!-- End of Iocn Box Wrapper -->
            @if(isset($middle_banner[0]))

                <div class="row category-banner-wrapper appear-animate pt-6 pb-8">
                    <div class="col-md-6 mb-4">
                        <div class="banner banner-fixed br-xs">
                            <figure>
                                <img src="{{asset('assets/uploads/banners/'.$middle_banner[0]->image->first()->image)}}"
                                     alt="Product Banner"
                                     width="610" height="160" style="background-color: #ecedec;"/>
                            </figure>
                            @if($latest_product)
                                <div class="banner-content y-50 mt-0">
                                    <h5 class="banner-subtitle font-weight-normal text-dark">Get up to <span
                                                class="text-secondary font-weight-bolder text-uppercase ls-25">20% Off</span>
                                    </h5>

                                    <h3 class="banner-title text-uppercase">{!! $latest_product->category ? $latest_product->category->name : '' !!}
                                        <br><span
                                                class="font-weight-normal                       text-capitalize">{!! $latest_product->name !!}</span>
                                    </h3>
                                    <div class="banner-price-info font-weight-normal">Starting at <span
                                                class="text-secondary font-weight-bolder">{!! $latest_new_arrival->selling_price !!}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(isset($middle_banner[1]))

                        <div class="col-md-6 mb-4">
                            <div class="banner banner-fixed br-xs">
                                <figure>
                                    <img src="{{asset('assets/uploads/banners/'.$middle_banner[1]->image->first()->image)}}"
                                         alt="Category Banner"
                                         width="610" height="160" style="background-color: #636363;"/>
                                </figure>
                                <div class="banner-content y-50 mt-0">
                                    <h5 class="banner-subtitle font-weight-normal text-capitalize">Latest New
                                        Arrivals</h5>
                                    <h3 class="banner-title text-white text-uppercase">{!! $latest_new_arrival->category ? $latest_new_arrival->category->name : '' !!}
                                        <br><span
                                                class="font-weight-normal text-capitalize">{!! $latest_new_arrival->name !!}</span>
                                    </h3>
                                    <div class="banner-price-info text-white font-weight-normal text-capitalize">Only
                                        From
                                        <span class="text-secondary font-weight-bolder">{!! $latest_new_arrival->selling_price !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
        @endif
        <!-- End of Category Banner Wrapper -->

            <div class="row deals-wrapper appear-animate mb-8">
                <div class="col-lg-9 mb-4">
                    <div class="single-product h-100 br-sm">
                        <h4 class="title-sm title-underline font-weight-bolder ls-normal">Deals Hot Of The Day</h4>
                        <div class="owl-carousel owl-theme owl-nav-top owl-nav-lg row cols-1 gutter-no"
                             data-owl-options="{
                                'nav': true,
                                'dots': false,
                                'margin': 20,
                                'items': 1
                            }">
                            @if(isset($flash_deals) && count($flash_deals) > 0)
                            @foreach($flash_deals as $key => $deal)
                            @if(count($deal->image) > 0)
                                <div class="product product-single row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical mb-0">
                                    <div
                                            class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                        <figure class="product-image">
                                            <img src="{{asset('assets/uploads/products/'.$deal->image[0]->image)}}"
                                                 data-zoom-image="{{asset('assets/uploads/products/'.$deal->image[0]->image)}}"
                                                 alt="Product Image" width="800" height="900">
                                        </figure>
                                    </div>
{{--                                        @foreach($deal->image as $image_index => $image)--}}
                                    <div class="product-thumbs-wrap">
                                        <div class="product-thumbs">
                                            <div class="product-thumb active">
                                                <img src="{{asset('assets/uploads/products/'.$deal->image[0]->image)}}"
                                                     alt="Product thumb" width="60" height="68"/>
                                            </div>
                                        </div>
                                    </div>
{{--                                        @endforeach--}}

{{--                                        @foreach($deal->image as $image_index => $image)--}}
{{--                                            @if($image_index > 0)--}}
{{--                                            <div class="product-thumbs-wrap">--}}
{{--                                                <div class="product-thumbs">--}}
{{--                                                    <div class="product-thumb">--}}
{{--                                                        <img src="{{asset('assets/uploads/products/'.$image->image)}}"--}}
{{--                                                             alt="Product thumb" width="60" height="68"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
                                    <div class="product-label-group">
                                        @php
                                            $discount_difference = $deal->price - $deal->discount_price;
                                            $percentage = round(($discount_difference / $deal->price) * 100)
                                        @endphp
                                        <label class="product-label label-discount">{!! $percentage !!} % Off</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-details scrollable">
                                    <h2 class="product-title mb-1"><a href="#">{!! $deal->product->name !!}</a></h2>

                                    <hr class="product-divider">

                                    <div class="product-price">
                                        <s>{!! $deal->price !!}</s>
                                        <ins class="new-price ls-50">

                                            {!! $discount_difference !!}
                                        </ins>
                                    </div>

                                    <div class="product-countdown-container flex-wrap">
                                        <label class="mr-2 text-default">Offer Ends In:</label>
                                        <div class="product-countdown countdown-compact"
                                             data-until="{{date('Y, m, d', strtotime($deal->discount_valid_till))}}" data-compact="true">
                                            629 days, 11: 59: 52
                                        </div>
                                    </div>

                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 80%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="#" class="rating-reviews">(3 Reviews)</a>
                                    </div>

                                    <div class="product-form product-variation-form product-size-swatch mb-3">
                                        <label class="mb-1">Size:</label>
                                        <div class="flex-wrap d-flex align-items-center product-variations">
                                            @foreach($deal->variantSize as $key => $s)
                                                <a href="#" class="size custom_sizes-{!! $key !!}-{!! $s->id !!}">
                                                    {!! $s->size->name !!}</a>
                                            @endforeach
                                        </div>
                                        <a href="#" class="product-variation-clean">Clean All</a>
                                    </div>

                                    <div class="product-variation-price">
                                        <input type="hidden" class="cart_price_to_show" value="{!! $discount_difference !!}">                                      <span></span>
                                    </div>

                                    <div class="product-form pt-4">
                                        <div class="product-qty-form mb-2 mr-2">
                                            <input type="hidden" value="{{$deal->quantity}}" id='varient_qty'>
                                            <input type="hidden" value="{{$deal->id}}" name='selected_varient_id' id='selected_varient_id'>
                                            <div class="input-group">
                                                <input class="quantity form-control" type="number" min="1"
                                                       oninput="check_qty(this.value)">
                                                <button class="quantity-plus w-icon-plus"></button>
                                                <button class="quantity-minus w-icon-minus"></button>
                                            </div>
                                        </div>
                                        @if(!empty($cart))
                                            @php
                                                $key = array_search($deal->id, array_column($cart,'variant_id'))
                                            @endphp
                                            @if( FALSE !== $key )
                                                <a href="{{url('cart')}}" id='checkout_{{$deal->id}}'
                                                   class="btn btn-dark checkout_cart">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <span>Checkout</span>
                                                </a>
                                            @else
                                                <button onclick="add_to_cart()" class="btn btn-primary btn-cart add_cart"
                                                        id='cart_{{$deal->id}}'>
                                                    <i class="w-icon-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                            @endif
                                        @else
                                            <button onclick="add_to_cart()" class="btn btn-primary btn-cart add_cart"
                                                    id='cart_{{$deal->id}}'>
                                                <i class="w-icon-cart"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endif
                        @endforeach
                            @endif
                            <!-- End of Product Single -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="widget widget-products widget-products-bordered h-100">
                        <div class="widget-body br-sm h-100">
                            <h4 class="title-sm title-underline font-weight-bolder ls-normal mb-2">Top 10 Best
                                Seller</h4>
                            <div class="owl-carousel owl-theme owl-nav-top row cols-lg-1 cols-md-3"
                                 data-owl-options="{
                                    'nav': true,
                                    'dots': false,
                                    'margin': 20,
                                    'responsive': {
                                        '0': {
                                            'items': 1
                                        },
                                        '576': {
                                            'items': 2
                                        },
                                        '768': {
                                            'items': 3
                                        },
                                        '992': {
                                            'items': 1
                                        }
                                    }
                                }">
                                @foreach($top_ten_sellers as $key => $top_ten)
                                    @if($key <= 2)
                                        @if(isset($top_ten->product->variants[$key]))
                                            <div class="product-widget-wrap">
                                                <div class="product product-widget bb-no">
                                                    <figure class="product-media">
                                                        <a href="{{route('productDetail',[$top_ten->product->id])}}">
                                                            <img src="{{asset('assets/uploads/products/'.$top_ten->product->variants[$key]->image[$key]->image)}}"
                                                                 alt="Product"
                                                                 width="105" height="118"/>
                                                        </a>
                                                    </figure>
                                                    <div class="product-details">
                                                        <h4 class="product-name">
                                                            <a href="{{route('productDetail',[$top_ten->product->id])}}">
                                                                {{$top_ten->product->product}} {{$top_ten->product->sku}}</a>
                                                        </h4>
                                                        <div class="product-price">
                                                            <ins class="new-price">{{$top_ten->product->variants[$key]->price}}</ins>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($key > 2 && $key <= 5 )
                                        @if(isset($top_ten->product->variants[$key]))
                                            <div class="product-widget-wrap">
                                                <div class="product product-widget bb-no">
                                                    <figure class="product-media">
                                                        <a href="{{route('productDetail',[$top_ten->product->id])}}">
                                                            <img src="{{asset('assets/uploads/products/'.$top_ten->product->variants[$key]->image[0]->image)}}"
                                                                 alt="Product"
                                                                 width="105" height="118"/>
                                                        </a>
                                                    </figure>
                                                    <div class="product-details">
                                                        <h4 class="product-name">
                                                            <a href="{{route('productDetail',[$top_ten->product->id])}}">{{$top_ten->product->product}} {{$top_ten->product->sku}}</a>
                                                        </h4>
                                                        <div class="product-price">
                                                            <ins class="new-price">{{$top_ten->product->variants[$key]->price}}</ins>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($key > 5 && $key <= 8)
                                        @if(isset($top_ten->product->variants[$key]))
                                            <div class="product-widget-wrap">
                                            <div class="product product-widget bb-no">
                                                <figure class="product-media">
                                                    <a href="{{route('productDetail',[$top_ten->product->id])}}">
                                                        <img src="{{asset('assets/uploads/products/'.$top_ten->product->variants[$key]->image[0]->image)}}"
                                                             alt="Product"
                                                             width="105" height="118"/>
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="{{route('productDetail',[$top_ten->product->id])}}">{{$top_ten->product->product}} {{$top_ten->product->sku}}</a>
                                                    </h4>
                                                    <div class="product-price">
                                                        <ins class="new-price">{{$top_ten->product->variants[0]->price}}</ins>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Deals Wrapper -->
        </div>

        <section class="category-section top-category bg-grey pt-10 pb-10 appear-animate">
            <div class="container pb-2">
                <h2 class="title justify-content-center pt-1 ls-normal mb-5">Top Categories Of The Month</h2>
                <div class="owl-carousel owl-theme row cols-lg-6 cols-md-5 cols-sm-3 cols-2" data-owl-options="{
                        'nav': false,
                        'dots': false,
                        'margin': 20,
                        'responsive': {
                            '0': {
                                'items': 2
                            },
                            '576': {
                                'items': 3
                            },
                            '768': {
                                'items': 5
                            },
                            '992': {
                                'items': 6
                            }
                        }
                    }">
                    @if(count($top_categories) > 0)
                        @foreach($top_categories as $key => $category)
                            @if(isset($category->image[$key]))
                                <div class="category category-classic category-absolute overlay-zoom br-xs">

                                    <a href="{!! route('getProducts',[$category->name]) !!}" class="category-media">
                                        <img src="{{asset('assets/uploads/categories/'.$category->image[$key]->image)}}"
                                             alt="Category" width="130"
                                             height="130">
                                    </a>
                                    <div class="category-content">
                                        <h4 class="category-name">{!! $category->name !!}</h4>
                                        <a href="{!! route('getProducts',[$category->name]) !!}"
                                           class="btn btn-primary btn-link btn-underline">Shop
                                            Now</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <!-- End of .category-section top-category -->

        <div class="container">
            <h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">Popular Departments
            </h2>
            <div class="tab tab-nav-boxed tab-nav-outline appear-animate">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-1">New arrivals</a>
                    </li>
                    {{--                <li class="nav-item mr-2 mb-2">--}}
                    {{--                    <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-2">Best seller</a>--}}
                    {{--                </li>--}}
                    {{--                <li class="nav-item mr-2 mb-2">--}}
                    {{--                    <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-3">Most popular</a>--}}
                    {{--                </li>--}}
                    <li class="nav-item mr-0 mb-2">
                        <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-4">Featured</a>
                    </li>
                </ul>
            </div>
            <!-- End of Tab -->
            <div class="tab-content product-wrapper appear-animate">
                <div class="tab-pane active pt-4" id="tab1-1">
                    <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">

                        @foreach($new_arrivals as $key => $new_pr)
                            @php
                                $count = 1;

                            @endphp

                            <div class="product-wrap">
                                <div class="product text-center">

{{--                                    @if(isset($new_pr->variants[0]->image[$key]))--}}
                                        <figure class="product-media">
                                        <a href="{!! route('productDetail',[$new_pr->id]) !!}">

{{--                                            @if(isset($new_pf->variant[0]))--}}
                                                <img src="{{asset('assets/uploads/products/'.$new_pr->variants[$key]->image[$key]->image)}}" class="product_home_page_image" alt="Product" style="height: 300px !important;" />
                                                <img src="{{asset('assets/uploads/products/'.$new_pr->variants[$key]->image[$key]->image)}}"  class="product_home_page_image" style="height: 300px !important;"  alt="Product"/>
{{--                                            @else--}}
{{--                                                <img src="{{asset('assets/uploads/products/default.png')}}"--}}
{{--                                                     alt="Product"--}}
{{--                                                     width="216" height="243"/>--}}
{{--                                            @endif--}}

                                              </a>
                                            
                                        <div class="product-action-vertical">
                                            
                                            
                                                    @php
                                                        if(!empty($cart))  {

                                                $index_key = array_search($new_pr->variants[$key]->id, array_column($cart, 'variant_id'));

                                                    if ( FALSE !== $index_key ) { @endphp
                            <a href="{{url('cart')}}" class="btn-product-icon checkout_cart" id='checkout_{{$new_pr->variants[$key]->id}}' title="Checkout"><i class="fas fa-shopping-cart"></i></a>
                                                @php   }else{ @endphp

                                <a  onclick="add_items_to_cart({{$new_pr->variants[$key]->id}})" id='cart_{{$new_pr->variants[$key]->id}}' class="btn-product-icon btn-cart w-icon-cart add-cart" title="Add to cart"></a>

                                                @php  }



                                                        }else{ @endphp

                                <a  onclick="add_items_to_cart({{$new_pr->variants[$key]->id}})" id='cart_{{$new_pr->variants[$key]->id}}' class="btn-product-icon btn-cart w-icon-cart add-cart" title="Add to cart"></a>
                                                        @php }


                                                        @endphp

                                <a style="display: none;" href="{{url('cart')}}" class="btn-product-icon checkout_cart" id='checkout_{{$new_pr->variants[$key]->id}}' title="Checkout"><i class="fas fa-shopping-cart"></i></a>





                                     @if(Auth::check())


                                        @if($new_pr->variants[$key]->wishlistItems->isEmpty())


                                        <a href="#" onclick="update_wishlist({{ $new_pr->id }},{{ $new_pr->variants[$key]->id }})" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>

                                        @else

                                        @foreach($new_pr->variants[$key]->wishlistItems as $i => $item)

                                        @if($item->user_id== auth()->user()->id )


                                        <a href="#" onclick="update_wishlist({{ $new_pr->id }},{{ $new_pr->variants[$key]->id }})" class="btn-product-icon btn-wishlist w-icon-heart-full" title="Wishlist"></a>


                                        @else

                                        <a href="#" onclick="update_wishlist({{ $new_pr->id }},{{ $new_pr->variants[$key]->id }})" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>


                                        @endif


                                        @endforeach


                                        @endif

                                        @else
                                        <a href="{!! url('/login-popup') !!}" class="d-lg-show login sign-in btn-product-icon w-icon-heart"><span></span></a>
                                        @endif






                                            <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                               title="Quickview"></a>
                                        </div>
                                    </figure>
{{--                                    @endif--}}
                                </div>
                            </div>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane pt-4" id="tab1-4">
                    <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">

                        @foreach($featured_products as $featured_index => $featured)
                       
                        <div class="product-wrap">
                            <div class="product text-center">
                                @if(isset($featured->image[$featured_index]))
                                <figure class="product-media">
                                    <a href="{{route('productDetail',[$featured->product->id])}}">
                                        <img src="{{asset('assets/uploads/products/'.$featured->image[$featured_index]->image)}}" alt="featured_product_1"
                                             width="300" height="338"/>
                                        <img src="{{asset('assets/uploads/products/'.$featured->image[$featured_index]->image)}}" alt="featured_product_2"
                                             width="300" height="338"/>
                                    </a>
                                    <div class="product-action-vertical">


                                       
                                            
                                                    @php
                                                        if(!empty($cart))  {

                                                $index_key = array_search($featured->id, array_column($cart, 'variant_id'));

                                                    if ( FALSE !== $index_key ) { @endphp
                            <a href="{{url('cart')}}" class="btn-product-icon checkout_cart" id='checkout_{{$featured->id}}' title="Checkout"><i class="fas fa-shopping-cart"></i></a>
                                                @php   }else{ @endphp

                                <a  onclick="add_items_to_cart({{$featured->id}})" id='cart_{{$featured->id}}' class="btn-product-icon btn-cart w-icon-cart add-cart" title="Add to cart"></a>

                                                @php  }



                                                        }else{ @endphp

                                <a  onclick="add_items_to_cart({{$featured->id}})" id='cart_{{$featured->id}}' class="btn-product-icon btn-cart w-icon-cart add-cart" title="Add to cart"></a>
                                                        @php }


                                                        @endphp

                                <a style="display: none;" href="{{url('cart')}}" class="btn-product-icon checkout_cart" id='checkout_{{$featured->id}}' title="Checkout"><i class="fas fa-shopping-cart"></i></a>



                               


                                     @if(Auth::check())


                                        @if($featured->wishlistItems->isEmpty())


                                        <a href="#" onclick="update_wishlist({{ $featured->product->id }},{{  $featured->id }})" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>

                                        @else

                                        @foreach($featured->wishlistItems as $i => $item)

                                        @if($item->user_id== auth()->user()->id )


                                        <a href="#" onclick="update_wishlist({{ $featured->product->id }},{{ $featured->id }})" class="btn-product-icon btn-wishlist w-icon-heart-full" title="Wishlist"></a>


                                        @else

                                        <a href="#" onclick="update_wishlist({{ $featured->product->id }},{{ $featured->id }})" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>


                                        @endif


                                        @endforeach


                                        @endif

                                        @else
                                        <a href="{!! url('/login-popup') !!}" class="d-lg-show login sign-in btn-product-icon w-icon-heart"><span></span></a>
                                        @endif




                                        <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                           title="Quickview"></a>
                                    </div>
                                </figure>
                                @endif
                                <div class="product-details">
                                    <h4 class="product-name"><a href="{{route('productDetail',[$featured->product->id])}}">{!! $featured->product->name !!}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="{{route('productDetail',[$featured->product->id])}}" class="rating-reviews">(8 reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">{!! $featured->price !!}</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- End of Tab Pane -->
            </div>
            <!-- End of Tab Content -->

            <div class="row category-cosmetic-lifestyle appear-animate mb-5">
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed category-banner-1 br-xs">
                        <figure>
                            <img src="{{asset('assets/front/images/demos/demo1/categories/3-1.jpg')}}"
                                 alt="Category Banner"
                                 width="610" height="200" style="background-color: #3B4B48;"/>
                        </figure>
                        <div class="banner-content y-50 pt-1">
                            <h5 class="banner-subtitle font-weight-bold text-uppercase">Natural Process</h5>
                            <h3 class="banner-title font-weight-bolder text-capitalize text-white">Cosmetic
                                Makeup<br>Professional</h3>
{{--                            <a href="{!! route('getProducts',[$category->name]) !!}"--}}
{{--                               class="btn btn-white btn-link btn-underline btn-icon-right">Shop Now<i--}}
{{--                                        class="w-icon-long-arrow-right"></i></a>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed category-banner-2 br-xs">
                        <figure>
                            <img src="assets/front/images/demos/demo1/categories/3-2.jpg" alt="Category Banner"
                                 width="610" height="200" style="background-color: #E5E5E5;"/>
                        </figure>
                        <div class="banner-content y-50 pt-1">
                            <h5 class="banner-subtitle font-weight-bold text-uppercase">Trending Now</h5>
                            <h3 class="banner-title font-weight-bolder text-capitalize">Women's
                                Lifestyle<br>Collection</h3>
{{--                            <a href="{!! route('getProducts',[$category->name]) !!}"--}}
{{--                               class="btn btn-dark btn-link btn-underline btn-icon-right">Shop Now<i--}}
{{--                                        class="w-icon-long-arrow-right"></i></a>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Category Cosmetic Lifestyle -->
            @foreach($category_products as $key => $cat_p)
                <div class="product-wrapper-1 appear-animate mb-5">
                    <div class="title-link-wrapper pb-1 mb-4">
                        <h2 class="title ls-normal mb-0">{!! $cat_p->name !!}</h2>
                        <a href="{!! route('getProducts',[$cat_p->name]) !!}"
                           class="font-size-normal font-weight-bold ls-25 mb-0">More
                            Products<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 mb-4">
                            <div class="banner h-100 br-sm" style="background-image: url(assets/front/images/demos/demo1/banners/2.jpg);
                                background-color: #ebeced;">
                                <div class="banner-content content-top">
                                    <h5 class="banner-subtitle font-weight-normal mb-2">Weekend Sale</h5>
                                    <hr class="banner-divider bg-dark mb-2">
                                    <h3 class="banner-title font-weight-bolder ls-25 text-uppercase">
                                        New Arrivals<br> <span
                                                class="font-weight-normal text-capitalize">Collection</span>
                                    </h3>
                                    <a href="{!! route('getProducts',[$cat_p->name]) !!}"
                                       class="btn btn-dark btn-outline btn-rounded btn-sm">shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- End of Banner -->
                        <div class="col-lg-9 col-sm-8">
                            <div class="owl-carousel owl-theme row cols-xl-4 cols-lg-3 cols-2" data-owl-options="{
                                'nav': false,
                                'dots': true,
                                'margin': 20,
                                'responsive': {
                                    '0': {
                                        'items': 2
                                    },
                                    '576': {
                                        'items': 2
                                    },
                                    '992': {
                                        'items': 3
                                    },
                                    '1200': {
                                        'items': 4
                                    }
                                }
                            }">
                                @foreach($cat_p->products as $p_index => $product)
                                    {{--@php
                                        $image = \App\Models\Image::where('model_id',$product->variants->first()->id)
                                                 ->where('model_type','App\Models\ProductVariant')->first();
                                    @endphp--}}
                                    <div class="product-col">
                                        <div class="product-wrap product text-center">
                                            <figure class="product-media">
                                            
                                                @if(isset($product->variants[0]) &&$product->variants[0]->image->first())
                                                    <a href="#">
                                                        <img src="{{asset('assets/uploads/products/'.$product->variants[0]->image->first()->image)}}"
                                                             alt="Product"
                                                             width="216" height="243"/>
                                                    </a>
                                                @else
                                                    <a href="#">
                                                        <img src="{{asset('assets/uploads/products/default.png')}}"
                                                             alt="Product"
                                                             width="216" height="243"/>
                                                    </a>
                                                @endif
                                                   

                                                <div class="product-action-vertical">
                                                    

                                                     

                                             

                                                    @php
                                                        if(!empty($cart))  {
                                                $key = array_search($product->variants[0]->id, array_column($cart, 'variant_id'));

                                                    if ( FALSE !== $key ) { @endphp
                            <a href="{{url('cart')}}" class="btn-product-icon checkout_cart" id='checkout_{{$product->variants[0]->id}}' title="Checkout"><i class="fas fa-shopping-cart"></i></a>
                                                @php   }else{ @endphp

                                <a  onclick="add_items_to_cart({{$product->variants[0]->id}})" id='cart_{{$product->variants[0]->id}}' class="btn-product-icon btn-cart w-icon-cart add-cart" title="Add to cart"></a>

                                                @php  }



                                                        }else{ @endphp

                                <a  onclick="add_items_to_cart({{$product->variants[0]->id}})" id='cart_{{$product->variants[0]->id}}' class="btn-product-icon btn-cart w-icon-cart add-cart" title="Add to cart"></a>
                                                        @php }


                                                        @endphp

                                <a style="display: none;" href="{{url('cart')}}" class="btn-product-icon checkout_cart" id='checkout_{{$product->variants[0]->id}}' title="Checkout"><i class="fas fa-shopping-cart"></i></a>






                                        @if(Auth::check())


                                        @if($product->variants[0]->wishlistItems->isEmpty())


                                        <a href="#" onclick="update_wishlist({{ $product->id }},{{ $product->variants[0]->id }})" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>

                                        @else

                                        @foreach($product->variants[0]->wishlistItems as $i => $item)

                                        @if($item->user_id== auth()->user()->id )


                                        <a href="#" onclick="update_wishlist({{ $product->id }},{{ $product->variants[0]->id }})" class="btn-product-icon btn-wishlist w-icon-heart-full" title="Wishlist"></a>


                                        @else

                                        <a href="#" onclick="update_wishlist({{ $product->id }},{{ $product->variants[0]->id }})" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>


                                        @endif


                                        @endforeach


                                        @endif

                                        @else
                                        <a href="{!! url('/login-popup') !!}" class="d-lg-show login sign-in btn-product-icon w-icon-heart"><span></span></a>
                                        @endif






                                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                       title="Quickview"></a>
                                                </div>

                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name"><a
                                                            href="{{route('productDetail',[$product->id])}}">{!! $product->name !!}</a>
                                                </h4>
                                                @php

                                                $rating_star='0%';
                                               $avg= (int) get_vairant_reviews($product->variants[0]->id)['avg_rating'];

                                                if($avg==1){
                                                $rating_star='20%';
                                            }else if($avg==2){
                                                 $rating_star='40%';
                                            }else if($avg==3){
                                                 $rating_star='60%';
                                            }else if($avg==4){
                                                 $rating_star='80%';
                                            }elseif($avg==5){
                                                 $rating_star='100%';
                                            }

                                                @endphp
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: {{$rating_star}};"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">({{  get_vairant_reviews($product->variants[0]->id)['total_reviews'] }}
                                                        reviews)</a>
                                                </div>
                                                <div class="product-price">
                                                    <ins class="new-price">{!! $product->price !!}</ins>
                                                    {{--                                            <del class="old-price">$25.68</del>--}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Product Wrapper 1 -->
                @if($key == 0)
                    <div class="banner banner-fashion appear-animate br-sm mb-9" style="background-image: url(assets/front/images/demos/demo1/banners/4.jpg);
                    background-color: #383839;">
                        <div class="banner-content align-items-center">
                            <div class="content-left d-flex align-items-center mb-3">
                                <div class="banner-price-info font-weight-bolder text-secondary text-uppercase lh-1 ls-25">
                                    25
                                    <sup class="font-weight-bold">%</sup><sub class="font-weight-bold ls-25">Off</sub>
                                </div>
                                <hr class="banner-divider bg-white mt-0 mb-0 mr-8">
                            </div>
                            <div class="content-right d-flex align-items-center flex-1 flex-wrap">
                                <div class="banner-info mb-0 mr-auto pr-4 mb-3">
                                    <h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25">For
                                        Today's
                                        Fashion</h3>
                                    <p class="text-white mb-0">Use code
                                        <span
                                                class="text-dark bg-white font-weight-bold ls-50 pl-1 pr-1 d-inline-block">Black
                                        <strong>12345</strong></span> to get best offer.</p>
                                </div>
                                <a href="{!! route('getProducts',[$cat_p->name]) !!}"
                                   class="btn btn-white btn-outline btn-rounded btn-icon-right mb-3">Shop Now<i
                                            class="w-icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
            <!-- End of Banner Fashion -->
            @endforeach
            {{--<h2 class="title title-underline mb-4 ls-normal appear-animate">Your Recent Views</h2>
            <div class="owl-carousel owl-theme owl-shadow-carousel appear-animate row cols-xl-8 cols-lg-6 cols-md-4 cols-2 pb-2 mb-10"
                 data-owl-options="{
                    'nav': false,
                    'dots': true,
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '576': {
                            'items': 3
                        },
                        '768': {
                            'items': 5
                        },
                        '992': {
                            'items': 6
                        },
                        '1200': {
                            'items': 8,
                            'dots': false
                        }
                    }
                }">
                <div class="product-wrap mb-0">
                    <div class="product text-center product-absolute">
                        <figure class="product-media">
                            <a href="product-defaproduct-default.html">
                                <img src="assets/front/images/demos/demo1/products/7-1.jpg" alt="Category image"
                                     width="130" height="146" style="background-color: #fff"/>
                            </a>
                        </figure>
                        <h4 class="product-name">
                            <a href="product-default.html">Women's Fashion Handbag</a>
                        </h4>
                    </div>
                </div>
                <!-- End of Product Wrap -->
                <div class="product-wrap mb-0">
                    <div class="product text-center product-absolute">
                        <figure class="product-media">
                            <a href="product-defaproduct-default.html">
                                <img src="assets/front/images/demos/demo1/products/7-2.jpg" alt="Category image"
                                     width="130" height="146" style="background-color: #fff"/>
                            </a>
                        </figure>
                        <h4 class="product-name">
                            <a href="product-default.html">Electric Frying Pan</a>
                        </h4>
                    </div>
                </div>
                <!-- End of Product Wrap -->
                <div class="product-wrap mb-0">
                    <div class="product text-center product-absolute">
                        <figure class="product-media">
                            <a href="product-defaproduct-default.html">
                                <img src="assets/front/images/demos/demo1/products/7-3.jpg" alt="Category image"
                                     width="130" height="146" style="background-color: #fff"/>
                            </a>
                        </figure>
                        <h4 class="product-name">
                            <a href="product-default.html">Black Winter Skating</a>
                        </h4>
                    </div>
                </div>
                <!-- End of Product Wrap -->
                <div class="product-wrap mb-0">
                    <div class="product text-center product-absolute">
                        <figure class="product-media">
                            <a href="product-defaproduct-default.html">
                                <img src="assets/front/images/demos/demo1/products/7-4.jpg" alt="Category image"
                                     width="130" height="146" style="background-color: #fff"/>
                            </a>
                        </figure>
                        <h4 class="product-name">
                            <a href="product-default.html">HD Television</a>
                        </h4>
                    </div>
                </div>
                <!-- End of Product Wrap -->
                <div class="product-wrap mb-0">
                    <div class="product text-center product-absolute">
                        <figure class="product-media">
                            <a href="product-defaproduct-default.html">
                                <img src="assets/front/images/demos/demo1/products/7-5.jpg" alt="Category image"
                                     width="130" height="146" style="background-color: #fff"/>
                            </a>
                        </figure>
                        <h4 class="product-name">
                            <a href="product-default.html">Home Sofa</a>
                        </h4>
                    </div>
                </div>
                <!-- End of Product Wrap -->
                <div class="product-wrap mb-0">
                    <div class="product text-center product-absolute">
                        <figure class="product-media">
                            <a href="product-defaproduct-default.html">
                                <img src="assets/front/images/demos/demo1/products/7-6.jpg" alt="Category image"
                                     width="130" height="146" style="background-color: #fff"/>
                            </a>
                        </figure>
                        <h4 class="product-name">
                            <a href="product-default.html">USB Receipt</a>
                        </h4>
                    </div>
                </div>
                <!-- End of Product Wrap -->
                <div class="product-wrap mb-0">
                    <div class="product text-center product-absolute">
                        <figure class="product-media">
                            <a href="product-defaproduct-default.html">
                                <img src="{{asset('assets/front/images/demos/demo1/products/7-7.jpg')}}"
                                     alt="Category image"
                                     width="130" height="146" style="background-color: #fff"/>
                            </a>
                        </figure>
                        <h4 class="product-name">
                            <a href="product-default.html">Electric Rice-Cooker</a>
                        </h4>
                    </div>
                </div>
                <!-- End of Product Wrap -->
                <div class="product-wrap mb-0">
                    <div class="product text-center product-absolute">
                        <figure class="product-media">
                            <a href="product-defaproduct-default.html">
                                <img src="{{asset('assets/front/images/demos/demo1/products/7-8.jpg')}}"
                                     alt="Category image"
                                     width="130" height="146" style="background-color: #fff"/>
                            </a>
                        </figure>
                        <h4 class="product-name">
                            <a href="product-default.html">Table Lamp</a>
                        </h4>
                    </div>
                </div>
                <!-- End of Product Wrap -->
            </div>--}}
            <!-- End of Reviewed Producs -->
        </div>
        <!--End of Catainer -->
    </main>
    <!-- End of Main -->
@stop
@push('javascript_section')
    <script>
        $(document).on('click', '#sign_up_submit_btn', function (e) {
            // $(document).ready(function () {
            $('#sign_up_form').validate({
                rules: {
                    f_name: {
                        required: true
                    },
                    l_name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone_no: {
                        required: true,
                        digits: true

                    },
                    gender: {
                        required: true,
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (response) {
                            // $('#answers').html(response);
                            console.log(response);
                            setTimeout(function () {
                                window.location.href = response.redirct_url;
                            }, 3000)
                        }
                    });
                }
            });
        });
        $(document).on('click', '#sign_in_btn', function (e) {
            // $(document).ready(function () {
            $('#sign_in_form').validate({
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    console.log(form);
                    console.log($(form).serialize());
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (response) {
                            // $('#answers').html(response);
                            console.log(response);
                            if (response.status == 200) {
                                setTimeout(function () {
                                    window.location.href = response.redirect_url;
                                }, 3000)
                            }
                            if (response.status == 422) {
                                $('#validation_errors').text(response.message)
                                $('#validation_errors').show()
                                return false;
                            }
                        }
                    });
                }
            });
        });

          function add_items_to_cart(id){

        
        $.ajax({
                type: "GET",
                url: '{{url('product_cart_update')}}/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {

                 $('#cart_'+id).hide();
                 $('#checkout_'+id).show();

                   setTimeout(function(){

                  $.ajax({
                type: "GET",
                url: '{{url('get-cart-item')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {

                  if(result.success){

                        $('.cart_items_nav_bar').html(result.html);
                    }


                }
            });

          }, 1000);


                }
            });
  }
    </script>
@endpush
