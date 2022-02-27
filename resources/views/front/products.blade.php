@extends('layouts.front_master')
@section('content')
<!-- Start of Main -->
<main class="main">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{url('/home')}}">Home</a></li>
                <li>Shop</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <!-- Start of Shop Banner -->
            <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs" style="background-image: url(assets/images/shop/banner1.jpg); background-color: #FFC74E;">
                <div class="banner-content">
                    <h4 class="banner-subtitle font-weight-bold">Collection</h4>
                    <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-normal">{!! $category_products->name !!}</h3>
                    {{-- <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Discover Now<i class="w-icon-long-arrow-right"></i></a>--}}
                </div>
            </div>
            <!-- End of Shop Banner -->


            <!-- Start of Shop Content -->
            <div class="shop-content row gutter-lg mb-10">
                <!-- Start of Sidebar, Shop Sidebar -->
                @include('front.includes.filters')
                <!-- End of Shop Sidebar -->

                <!-- Start of Shop Main Content -->
                <div class="main-content filtered_products">
                    <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2" id="products_content_div">
                        @foreach($products as $key => $product)

                        <input type="hidden" value="{{$product->variants[0]->id}}" name='selected_varient_id' id='selected_varient_id_{{$product->id}}'>

                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="{!! route('productDetail',[$product->id]) !!}">
                                        <img src="{{asset('assets/uploads/products/'.$product->variants[0]->image->first()->image)}}" alt="Product" width="300" height="338" />
                                    </a>
                                    <div class="product-action-horizontal">


                                                    @php
                                                        if(!empty($cart))  {
                                                $key = array_search($product->variants[0]->id, array_column($cart, 'variant_id'));

                                                    if ( FALSE !== $key ) { @endphp
                            <a href="{{url('cart')}}" class="btn-product-icon checkout_cart" id='checkout_{{$product->variants[0]->id}}' title="Checkout"><i class="fas fa-shopping-cart"></i></a>
                                                @php   }else{ @endphp

                                <a  onclick="add_to_cart({{$product->variants[0]->id}})" id='cart_{{$product->variants[0]->id}}' class="btn-product-icon btn-cart w-icon-cart add-cart" title="Add to cart"></a>

                                                @php  }



                                                        }else{ @endphp

                                <a  onclick="add_to_cart({{$product->variants[0]->id}})" id='cart_{{$product->variants[0]->id}}' class="btn-product-icon btn-cart w-icon-cart add-cart" title="Add to cart"></a>
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

                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="product-cat">
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
                                        <a href="{!! route('getProducts',[$name]) !!}">{!! $name !!}</a>
                                    </div>
                                    <h3 class="product-name">
                                        <a href="{!! route('productDetail',[$product->id]) !!}">{!! $product->name !!}</a>
                                    </h3>

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
                                        <a href="{!! route('productDetail',[$product->id]) !!}" class="rating-reviews">({{  get_vairant_reviews($product->variants[0]->id)['total_reviews'] }} reviews)</a>
                                    </div>
                                    <div class="product-pa-wrapper">
                                        <div class="product-price">
                                            {!! $product->selling_price !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <div class="toolbox toolbox-pagination justify-content-between">
                        <p class="showing-info mb-2 mb-sm-0">
                            Showing<span>1-12 of 60</span>Products
                        </p>
                        <ul class="pagination">
                            <li class="prev disabled">
                                <a href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <i class="w-icon-long-arrow-left"></i>Prev
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="next">
                                <a href="#" aria-label="Next">
                                    Next<i class="w-icon-long-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End of Shop Main Content -->
            </div>
            <!-- End of Shop Content -->
        </div>
    </div>
    <!-- End of Page Content -->
</main>
<!-- End of Main -->
@endsection
@push('javascript_section')
<script>
   


    function add_to_cart(id){


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
