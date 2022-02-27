@extends('layouts.front_master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/vendor/animate/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/vendor/photoswipe/photoswipe.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/front/vendor/photoswipe/default-skin/default-skin.min.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css"/>

    <style>
        .owl-carousel .owl-next {
            top: -195px !important;
        }

        .owl-carousel .owl-prev {
            top: -195px !important;

        }

    </style>
    <!-- Start of Main -->
    <main class="main mb-10 pb-1">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav container">
            <ul class="breadcrumb bb-no">
                <li><a href="{!! url('/home') !!}">Home</a></li>
                <li>Products</li>
            </ul>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg">
                    <div class="main-content">
                        <div class="product product-single row">
                            <div class="col-md-6 mb-6">
                                <div class="product-gallery product-gallery-sticky">

                                    <div
                                        class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                        @foreach($product->variants[0]->image as $i => $image)
                                            <figure class="product-image">
                                                <img src="{!! asset('assets/uploads/products/'.$image->image) !!}"
                                                     data-zoom-image="{!! asset('assets/uploads/products/'.$image->image) !!}"
                                                     alt="{!! $product->name !!}" width="800" height="900">
                                            </figure>
                                        @endforeach
                                    </div>
                                    <div class="product-thumbs-wrap">
                                        <div class="product-thumbs row cols-4 gutter-sm">
                                            <div class="product-thumb active">
                                                <img
                                                    src="{!! asset('assets/uploads/products/'.$product->variants[0]->image->first()->image) !!}"
                                                    alt="Product Thumb sdfds" width="800" height="900">
                                            </div>
                                            @foreach($product->variants[0]->image as $i => $image)
                                                @if($i > 0)
                                                    <div class="product-thumb">
                                                        <img
                                                            src="{!! asset('assets/uploads/products/'.$image->image) !!}"
                                                            alt="Product Thumb" width="800" height="900">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                        <button class="thumb-down disabled"><i
                                                class="w-icon-angle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mb-md-6">
                                <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                    <h2 class="product-title">{!! $product->name !!}</h2>
                                    <div class="product-bm-wrapper">
                                        {{--                                        <figure class="brand">--}}
                                        {{--                                            <img src="assets/images/products/brand/brand-1.jpg" alt="Brand"--}}
                                        {{--                                                 width="102" height="48" />--}}
                                        {{--                                        </figure>--}}
                                        <div class="product-meta">
                                            <div class="product-categories">
                                                Category:
                                                @php
                                                    if($product->category){
                                                        $name = $product->category->name;
                                                    }
                                                    elseif($product->firstChildCategory){
                                                        $name = $product->firstChildCategory->name;
                                                    }elseif($product->secondChildCategory){
                                                        $name = $product->secondChildCategory->name;
                                                    }
                                                @endphp
                                                <span class="product-category"><a href="#">{!! $name !!}</a></span>
                                            </div>
                                            <div class="product-sku">
                                                SKU: <span>{!! $product->sku !!}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product-price">
                                        <ins class="new-price">{!! $product->selling_price !!}</ins>
                                    </div>

                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 80%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="#product-tab-reviews" class="rating-reviews scroll-to">(3
                                            Reviews)</a>
                                    </div>

                                    <div class="product-short-desc">
                                        <p>{!! $product->short_description !!}</p>
                                    </div>

                                    <div class="product-form product-variation-form product-color-swatch">
                                        <label>Color:</label>
                                        <div class="d-flex align-items-center product-variations">
                                            @foreach($product->variants as $key => $pv)
                                                <a class="color" style="background: {!! $pv->color->name !!}"
                                                   onclick="getColorSize({!! $pv->color->id !!},{!! $pv->id !!})"></a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="product-form product-variation-form product-size-swatch">
                                        <label class="mb-1">Quantity:</label>
                                        <div class="flex-wrap d-flex align-items-center">

                                            <a class="product_qty"
                                               style="font-size: 14px;">{{$product->variants[0]->quantity}}</a>

                                        </div>

                                    </div>
                                    <div class="product-form product-variation-form product-size-swatch">
                                        <label class="mb-1">Size:</label>
                                        <div class="flex-wrap d-flex align-items-center product-variations">

                                            @foreach($product->variants as $key => $s)
                                                @foreach($s->variantSize as $key => $a)
                                                    <a href="#"
                                                       class="size custom_sizes-{!! $key !!}-{!! $s->id !!}">{!! $a->size->name !!}</a>

                                                @endforeach

                                            @endforeach
                                        </div>
                                        <a href="#" class="product-variation-clean">Clean All</a>
                                    </div>


                                    <div class="product-variation-price">
                                        <input type="hidden" id="cart_price_to_show" value="">
                                        <span></span>
                                    </div>

                                    <input type="hidden" value="{{$product->variants[0]->quantity}}" id='varient_qty'>
                                    <input type="hidden" value="{{$product->variants[0]->id}}"
                                           name='selected_varient_id' id='selected_varient_id'>
                                    <div class="fix-bottom product-sticky-content sticky-content">
                                        <div class="product-form container">
                                            <div class="product-qty-form">
                                                <div class="input-group">
                                                    <input class="quantity form-control btn-cart" type="number"
                                                           oninput="check_qty(this.value)" >
                                                    <button class="quantity-plus w-icon-plus"></button>
                                                    <button class="quantity-minus w-icon-minus"></button>
                                                </div>
                                            </div>

                                            @php
                                                if(!empty($cart))  {
                                                    $key = array_search($product->variants[0]->id, array_column($cart, 'variant_id'));


                                                        if ( FALSE !== $key ) { @endphp
                                            <a href="{{url('cart')}}" id='checkout_{{$product->variants[0]->id}}'
                                               class="btn btn-dark checkout_cart">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span>Checkout</span>
                                            </a>

                                            @php   }else{ @endphp

                                            <button onclick="add_to_cart()" class="btn btn-primary btn-cart add_cart"
                                                    id='cart_{{$product->variants[0]->id}}'>
                                                <i class="w-icon-cart"></i>
                                                <span>Add to Cart</span>
                                            </button>

                                            @php  }
                                                        }else{ @endphp

                                            <button onclick="add_to_cart()" class="btn btn-primary btn-cart add_cart"
                                                    id='cart_{{$product->variants[0]->id}}'>
                                                <i class="w-icon-cart"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                            @php }


                                            @endphp

                                            <a href="{{url('cart')}}" style="display:none;"
                                               id='checkout_{{$product->variants[0]->id}}'
                                               class="btn btn-dark checkout_cart">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span>Checkout</span>
                                            </a>


                                            <button onclick="add_to_cart()" style="display:none;"
                                                    class="btn btn-primary btn-cart add_cart"
                                                    id='cart_{{$product->variants[0]->id}}'>
                                                <i class="w-icon-cart"></i>
                                                <span>Add to Cart</span>
                                            </button>


                                        </div>
                                    </div>

                                    <div class="social-links-wrapper">
                                        <span class="divider d-xs-show"></span>
                                        <div class="product-link-wrapper d-flex">
                                            @if(Auth::check())



                                                @if($product->variants[0]->wishlistItems->isEmpty())

                                                    <a class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>

                                                @else

                                                    @foreach($product->variants[0]->wishlistItems as $i => $item)

                                                        @if($item->user_id== auth()->user()->id )

                                                            <a class="btn-product-icon btn-wishlist w-icon-heart-full"><span></span></a>

                                                        @else
                                                            <a class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>


                                                        @endif


                                                    @endforeach


                                                @endif



                                            @else
                                                <a href="{!! url('/login-popup') !!}"
                                                   class="d-lg-show login sign-in btn-product-icon w-icon-heart"><span></span></a>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--     <div class="frequently-bought-together mt-5">
                                 <h2 class="title title-underline">Frequently Bought Together</h2>
                                 <div class="bought-together-products row mt-8 pb-4">
                                     <div class="product product-wrap text-center">
                                         <figure class="product-media">
                                             <img src="assets/images/products/default/bought-1.jpg" alt="Product"
                                                  width="138" height="138" />
                                             <div class="product-checkbox">
                                                 <input type="checkbox" class="custom-checkbox" id="product_check1"
                                                        name="product_check1">
                                                 <label></label>
                                             </div>
                                         </figure>
                                         <div class="product-details">
                                             <h4 class="product-name">
                                                 <a href="#">Electronics Black Wrist Watch</a>
                                             </h4>
                                             <div class="product-price">$40.00</div>
                                         </div>
                                     </div>
                                     <div class="product product-wrap text-center">
                                         <figure class="product-media">
                                             <img src="assets/images/products/default/bought-2.jpg" alt="Product"
                                                  width="138" height="138" />
                                             <div class="product-checkbox">
                                                 <input type="checkbox" class="custom-checkbox" id="product_check2"
                                                        name="product_check2">
                                                 <label></label>
                                             </div>
                                         </figure>
                                         <div class="product-details">
                                             <h4 class="product-name">
                                                 <a href="#">Apple Laptop</a>
                                             </h4>
                                             <div class="product-price">$1,800.00</div>
                                         </div>
                                     </div>
                                     <div class="product product-wrap text-center">
                                         <figure class="product-media">
                                             <img src="assets/images/products/default/bought-3.jpg" alt="Product"
                                                  width="138" height="138" />
                                             <div class="product-checkbox">
                                                 <input type="checkbox" class="custom-checkbox" id="product_check3"
                                                        name="product_check3">
                                                 <label></label>
                                             </div>
                                         </figure>
                                         <div class="product-details">
                                             <h4 class="product-name">
                                                 <a href="#">White Lenovo Headphone</a>
                                             </h4>
                                             <div class="product-price">$34.00</div>
                                         </div>
                                     </div>
                                     <div class="product-button">
                                         <div class="bought-price font-weight-bolder text-primary ls-50">$1,874.00</div>
                                         <div class="bought-count">For 3 items</div>
                                         <a href="cart.html" class="btn btn-dark btn-rounded">Add All To Cart</a>
                                     </div>
                                 </div>
                             </div>--}}
                        <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a href="#product-tab-description" class="nav-link active">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#product-tab-specification" class="nav-link">Specification</a>
                                </li>
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a href="#product-tab-vendor" class="nav-link">Vendor Info</a>--}}
                                {{--                                </li>--}}
                                <li class="nav-item">
                                    <a href="#product-tab-reviews" class="nav-link">Customer Reviews
                                        (<?php echo count($reviews) ?>)</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="product-tab-description">
                                    <div class="row mb-4">
                                        <div class="col-md-6 mb-5">
                                            <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                            <p class="mb-4">
                                                {!! $product->description !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row cols-md-3">
                                        <div class="mb-3">
                                            <h5 class="sub-title font-weight-bold"><span class="mr-3">1.</span>Free
                                                Shipping &amp; Return</h5>
                                            <p class="detail pl-5">We offer free shipping for products on orders
                                                above 50$ and offer free delivery for all orders in US.</p>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="sub-title font-weight-bold"><span>2.</span>Free and Easy
                                                Returns</h5>
                                            <p class="detail pl-5">We guarantee our products and you could get back
                                                all of your money anytime you want in 30 days.</p>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="sub-title font-weight-bold"><span>3.</span>Special Financing
                                            </h5>
                                            <p class="detail pl-5">Get 20%-50% off items over 50$ for a month or
                                                over 250$ for a year with our special credit card.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="product-tab-specification">
                                    <ul class="list-none">
                                        <li>
                                            <label>Model</label>
                                            <p>Skysuite 320</p>
                                        </li>
                                        <li>
                                            <label>Color</label>
                                            @foreach($product->variants as $key => $v)
                                                <p>{!! $v->color->name !!}</p>
                                            @endforeach
                                        </li>
                                        <li>
                                            <label>Size</label>
                                            @foreach($product->variants as $key => $s)
                                                @foreach($s->variantSize as $key => $a)
                                                    <p>{!! $a->size->name !!}</p>
                                                @endforeach
                                            @endforeach
                                        </li>
                                        <li>
                                            <label>Guarantee Time</label>
                                            <p>N/A</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane product-tab-reviews" id="product-tab-reviews">

                                    @php
                                        $avg=0;
                                        $rating_star='0%';
                                        $avg_rating=0;
                                        $total_variant_reviews=0;
                                         $total_comments=0;
                                        $percentage=0;

                                         foreach($reviews as $review){
                                     if($review->variant_id ==$product->variants[0]->id)
                                     {

                                      $avg_rating+= $review->rating;
                                      $total_variant_reviews++;

                                     }

                                 }

                                  $total_comments=$total_variant_reviews;

                                  if($total_comments!=0){
                                 $percentage=(($avg_rating/$total_comments));

                                  $percentage=($percentage/$avg_rating)*100;
                                  $percentage=number_format($percentage,2);
                                 $avg=number_format($avg_rating/$total_comments,2);
                                    $avg=(int)$avg;
                                    if($avg==1){
                                         $rating_star='20%';
                                     }else if($avg==2){
                                          $rating_star='40%';
                                     }else if($avg==3){
                                          $rating_star='60%';
                                     }else if($avg==4){
                                          $rating_star='80%';
                                     }else{
                                          $rating_star='100%';
                                     }
                                  }


                                    @endphp
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-lg-5 mb-4">
                                            <div class="ratings-wrapper">
                                                <div class="avg-rating-container">
                                                    <h4 class="avg-mark font-weight-bolder ls-50">
                                                        @if($total_comments!=0)

                                                            {{ number_format($avg_rating/$total_comments,2) }}
                                                        @else
                                                            0
                                                        @endif

                                                    </h4>
                                                    <div class="avg-rating">
                                                        <p class="text-dark mb-1">Average Rating</p>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings"
                                                                      style="width: {{ $rating_star  }};"></span>


                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <a class="rating-reviews">({{$total_variant_reviews}}
                                                                Reviews)</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="ratings-value d-flex align-items-center text-dark ls-25">
                                                        <span
                                                            class="text-dark font-weight-bold">
                                                </div>
                                                <div class="ratings-list">
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings"
                                                                  style="width: {{ $rating_star}};"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <div class="progress-bar progress-bar-sm ">
                                                            <span></span>
                                                        </div>
                                                        <div class="progress-value">
                                                            <mark>{{$rating_star}}</mark>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        @if(Auth::check())
                                            <div class="col-xl-8 col-lg-7 mb-4 customer_reviews" style="display:none;">
                                                <div class="review-form-wrapper">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                        Review</h3>
                                                    <p class="mb-3">Your email address will not be published. Required
                                                        fields are marked *</p>
                                                    <form action="" method="POST" class="review-form">
                                                        {{ csrf_field() }}
                                                        <div class="rating-form">
                                                            <label for="rating">Your Rating of This Product:</label>

                                                            <input id="star-rating-id" name="star_rating" class="rating"
                                                                   value="0" data-min="0" data-max="5" data-step="1"
                                                                   data-size="xs" required="">


                                                        </div>
                                                        <textarea cols="30" rows="6"
                                                                  placeholder="Write Your Review Here..."
                                                                  class="form-control"
                                                                  id="remarks" name="remarks" required></textarea>

                                                        <div class="form-group" style="display:none;">
                                                            <input type="checkbox" class="custom-checkbox"
                                                                   id="save-checkbox">
                                                            <label for="save-checkbox">Save my name, email, and website
                                                                in this browser for the next time I comment.</label>
                                                        </div>
                                                        <button type="button" onclick="saveRating()"
                                                                class="btn btn-dark">Submit
                                                            Review
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                        <ul class="nav nav-tabs" role="tablist" style="display:none;">
                                            <li class="nav-item">
                                                <a href="#show-all" class="nav-link active">Show All</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#helpful-positive" class="nav-link">Most Helpful
                                                    Positive</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#helpful-negative" class="nav-link">Most Helpful
                                                    Negative</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#highest-rating" class="nav-link">Highest Rating</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#lowest-rating" class="nav-link">Lowest Rating</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="show-all">

                                                <ul class="comments list-style-none">
                                                    @foreach($reviews as $review)

                                                        @if($review->variant_id ==$product->variants[0]->id)

                                                            @php

                                                                if($review->rating==1){
                                                                    $rating_width='20%';
                                                                }else if($review->rating==2){
                                                                     $rating_width='40%';
                                                                }else if($review->rating==3){
                                                                     $rating_width='60%';
                                                                }else if($review->rating==4){
                                                                     $rating_width='80%';
                                                                }else{
                                                                     $rating_width='100%';
                                                                }

                                                            @endphp

                                                            <li class="comment">
                                                                <div class="comment-body">

                                                                    <div class="comment-content">
                                                                        <h4 class="comment-author">
                                                                            <a>{{ $review->customer->f_name }} {{ $review->customer->l_name }}</a>

                                                                            <span
                                                                                class="comment-date">{{ \Carbon\Carbon::parse($review->created_at)->format('d-M-Y')}}</span>
                                                                        </h4>
                                                                        <div class="ratings-container comment-rating">
                                                                            <div class="ratings-full">
                                                                            <span class="ratings"
                                                                                  style="width: {!! $rating_width !!};"></span>
                                                                                <span
                                                                                    class="tooltiptext tooltip-top"></span>
                                                                            </div>
                                                                        </div>
                                                                        <p>{{ $review->remarks }}</p>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->
@endsection
@push('javascript_section')
    <script src="{{asset('assets/front/vendor/photoswipe/photoswipe.js')}}"></script>
    <script src="{{asset('assets/front/vendor/photoswipe/photoswipe-ui-default.js')}}"></script>
    <script>

        $("#star-rating-id").rating();

        function saveRating() {

            var variant_id = $('#selected_varient_id').val();
            var product_id =<?php echo $product_id;  ?>;

            $.ajax({
                url: "/save-rating/" + product_id + '/' + variant_id,
                type: "POST",
                data:
                    $('.review-form').serialize(),

                success: function (response) {

                    window.location.href = "<?php echo URL::to('product-detail/' . $product_id); ?>"
                },
                error: function (response) {
                },
            });


        }

        $(document).ready(function () {


            const params = new URLSearchParams(window.location.search)
            if (params.has('review')) {

                if ($('#selected_varient_id').val() == params.get('variant')) {
                    $('.customer_reviews').show();
                }
            }

            $('.quantity-plus').click(function () {

                var val = $(this).prev().val();

                if (val > Number($('#varient_qty').val())) {
                    $(this).prev().val($('#varient_qty').val());

                }

            });


            $('.quantity-minus').click(function () {
                var selectedInput = $(this).next('input');

            });


            $('.btn-wishlist').click(function () {
                var variant_id = $('#selected_varient_id').val();
                var product_id = '<?php echo $product_id;  ?>';
                $.ajax({
                    type: "GET",
                    url: '{{url('product_wishlist_update')}}/' + product_id + '/' + variant_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (result) {
                    }
                });


            });


        });


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

        function getColorSize(color_id, variant_id) {

            $('#selected_varient_id').val(variant_id);
            $('.add_cart').attr("id", "cart_" + variant_id);
            $('.checkout_cart').attr("id", "checkout_" + variant_id);
            const params = new URLSearchParams(window.location.search)

            $.ajax({
                type: "GET",
                url: '{{url('get-color-sizes')}}/' + color_id + '/' + variant_id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    // console.log(result.data);
                    if (result.status) {
                        var cls = 'custom_sizes';
                        $('.size').hide();
                        if (result.wishlist_found == 1) {
                            $('.btn-product-icon').addClass('w-icon-heart-full');
                            $('.btn-product-icon').removeClass('w-icon-heart')
                        } else {
                            $('.btn-product-icon').addClass('w-icon-heart');
                            $('.btn-product-icon').removeClass('w-icon-heart-full');

                        }
                        if (result.cart_found == 1) {
                            $('#cart_' + variant_id).hide();
                            $('#checkout_' + variant_id).show();
                        } else {
                            $('#cart_' + variant_id).show();
                            $('#checkout_' + variant_id).hide();

                        }


                        $.each(result.data, function (index, value) {
                            $('.custom_sizes-' + index + '-' + variant_id).css('display', 'block');
                            $('.custom_sizes-' + index + '-' + variant_id).text(value.name);
                            $('#varient_qty').val(result.qty);
                            $('.product_qty').text(result.qty);
                        });

                        $('#cart_price_to_show').val(result.variant_price);
                        $('.product-gallery-sticky').html(result.html);
                        $('.product-tab-reviews').html(result.review_html);

                         if (params.has('review')) {
                            if (variant_id == params.get('variant')) {
                                $('.customer_reviews').show();
                            } else {
                               $('.customer_reviews').hide();

                            }
                        }

                         $("#star-rating-id").rating();
                        $('.owl-carousel').owlCarousel(
                            {
                                center: true,
                                items: 1,
                                loop: true,
                                margin: 40,
                                nav: true,
                                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"]

                            }
                        )


                    }
                }
            });





        }
    </script>
@endpush
