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
                <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs"
                     style="background-image: url(assets/images/shop/banner1.jpg); background-color: #FFC74E;">
                    <div class="banner-content">
                        <h4 class="banner-subtitle font-weight-bold">Collection</h4>
                        <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-normal">
                            {!! count($products) > 0 ? $products[0]->category->name : '' !!}</h3>
                    </div>
                </div>
                <!-- End of Shop Banner -->
                <!-- Start of Shop Content -->
                <div class="shop-content row gutter-lg mb-10">
                    <!-- Start of Sidebar, Shop Sidebar -->
                @include('front.includes.filters')
                <!-- End of Shop Sidebar -->

                    <!-- Start of Shop Main Content -->
                    <div class="main-content filtered_products" >
                        @if(count($products) > 0)
                        <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2" id="products_content_div">

                                @foreach($products as $key => $product)
                                    <div class="product-wrap">
                                        <div class="product text-center">
                                            <figure class="product-media">
                                                <a href="{!! route('productDetail',[$product->id]) !!}">
                                                    <img
                                                        src="{{asset('assets/uploads/products/'.$product->variants[0]->image->first()->image)}}"
                                                        alt="Product" width="300"
                                                        height="338"/>
                                                </a>
                                                <div class="product-action-horizontal">
                                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                       title="Add to cart"></a>
                                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                       title="Wishlist"></a>
                                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                       title="Quick View"></a>
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <div class="product-cat">
                                                    <a href="{!! route('getProducts',[$product->category->name]) !!}">{!! $product->category->name !!}</a>
                                                </div>
                                                <h3 class="product-name">
                                                    <a href="{!! route('productDetail',[$product->id]) !!}">{!! $product->name !!}</a>
                                                </h3>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="{!! route('productDetail',[$product->id]) !!}"
                                                       class="rating-reviews">(3 reviews)</a>
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
                        @else
                            <div class="alert alert-icon alert-error alert-bg alert-inline">
                                <h4 class="alert-title">
                                    <i class="w-icon-times-circle"></i>Oh snap!</h4> No Product Exists against this category.
                            </div>
                        @endif
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
<script src="{{asset('js/filters.js')}}"></script>
