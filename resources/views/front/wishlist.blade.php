@extends('layouts.front_master')
@section('content')

    <!-- Start of Main -->
    <main class="main wishlist-page">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Wishlist</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav mb-10">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="demo1.html">Home</a></li>
                    <li>Wishlist</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <h3 class="wishlist-title">My wishlist</h3>
                <table class="shop-table wishlist-table">
                    <thead>
                    <tr>
                        <th class="product-name"><span>Product</span></th>
                        <th></th>
                        <th class="product-price"><span>Price</span></th>
                        <th class="product-stock-status"><span>Stock Status</span></th>
                        <th class="wishlist-action">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                         @if(count($user_wishlists) >0 )
                      @foreach($user_wishlists as $key=>$wishlist)
                 @php
                 $image = \App\Models\Image::where('model_id',$wishlist->variant_id)
                                            ->where('model_type','App\Models\ProductVariant')->first();
                @endphp                           
                    <tr>
                        <td class="product-thumbnail">
                            <div class="p-relative">
                                <a href="{!!  route('productDetail',[$wishlist->product_id]) !!}">
                                    <figure>
                                        <img src="{!! asset('assets/uploads/products/'.$image->image) !!}" alt="product" width="300"
                                             height="338">
                                    </figure>
                                </a>
                                <button type="submit" onclick="remove_variant('<?php echo $wishlist->id ?>','<?php echo $wishlist->variant_id ?>')" class="btn btn-close"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </td>
                        <td class="product-name">
                            <a href="{!!  route('productDetail',[$wishlist->product_id]) !!}">
                                {{$wishlist->name}}
                            </a>
                        </td>
                        <td class="product-price"><ins class="new-price">${{$wishlist->price}}</ins></td>
                        <td class="product-stock-status">
                            <span class="wishlist-in-stock">In Stock</span>
                        </td>
                        <td class="wishlist-action">
                            <div class="d-lg-flex">
                       
                         @php
                          if(!empty($cart))  {
                $key = array_search($wishlist->variant_id, array_column($cart, 'variant_id'));
                                
                     if ( FALSE !== $key ) { @endphp
                      <a href="{{url('cart')}}" class="btn btn-primary  btn-rounded" id='checkout_{{$wishlist->variant_id}}'>Checkout</a>
                  @php   }else{ @endphp

   <a  onclick="add_to_cart( {{$wishlist->variant_id}} )" id='cart_{{$wishlist->variant_id}}' class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                                    cart</a>
                     
                @php  }     



                          }else{ @endphp

 <a  onclick="add_to_cart( {{$wishlist->variant_id}} )" id='cart_{{$wishlist->variant_id}}' class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                                    cart</a>
                         @php }
                        
                          
                          @endphp

                      <a style="display: none;" href="{{url('cart')}}" class="btn btn-primary  btn-rounded" id='checkout_{{$wishlist->variant_id}}'>Checkout</a>



                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @else
                       <tr>
                        <td>No Items Found</td>
                       </tr>

                    @endif


                    </tbody>
                </table>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>


    
    <!-- Start of Quick View -->
<div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky mb-0">
                <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                    <figure class="product-image">
                        <img src="{{asset('assets/front/images/products/popup/1-440x494.jpg')}}"
                             data-zoom-image="{{asset('assets/front/images/products/popup/1-440x494.jpg')}}"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                    <figure class="product-image">
                        <img src="{{asset('assets/front/images/products/popup/2-440x494.jpg')}}"
                             data-zoom-image="{{asset('assets/front/images/products/popup/2-440x494.jpg')}}"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                    <figure class="product-image">
                        <img src="{{asset('assets/front/images/products/popup/3-440x494.jpg')}}"
                             data-zoom-image="{{asset('assets/front/images/products/popup/3-440x494.jpg')}}"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                </div>
                <div class="product-thumbs-wrap">
                    <div class="product-thumbs">
                        <div class="product-thumb active">
                            <img src="{{asset('assets/front/images/products/popup/1-103x116.jpg')}}" alt="Product Thumb" width="103"
                                 height="116">
                        </div>
                        <div class="product-thumb">
                            <img src="{{asset('assets/front/images/products/popup/2-103x116.jpg')}}" alt="Product Thumb" width="103"
                                 height="116">
                        </div>
                    </div>
                    <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                    <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">Electronics Black Wrist Watch</h2>
                <div class="product-bm-wrapper">
                    <figure class="brand">
                        <img src="{{asset('assets/front/images/products/brand/brand-1.jpg')}}" alt="Brand" width="102" height="48" />
                    </figure>
                    <div class="product-meta">
                        <div class="product-categories">
                            Category:
                            <span class="product-category"><a href="#">Electronics</a></span>
                        </div>
                        <div class="product-sku">
                            SKU: <span>MS46891340</span>
                        </div>
                    </div>
                </div>

                <hr class="product-divider">

                <div class="product-price">$40.00</div>

                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 80%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="#" class="rating-reviews">(3 Reviews)</a>
                </div>

                <div class="product-short-desc">
                    <ul class="list-type-check list-style-none">
                        <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                        <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                        <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                    </ul>
                </div>

                <hr class="product-divider">

                <div class="product-form product-variation-form product-color-swatch">
                    <label>Color:</label>
                    <div class="d-flex align-items-center product-variations">
                        <a href="#" class="color" style="background-color: #ffcc01"></a>
                        <a href="#" class="color" style="background-color: #ca6d00;"></a>
                        <a href="#" class="color" style="background-color: #1c93cb;"></a>
                        <a href="#" class="color" style="background-color: #ccc;"></a>
                        <a href="#" class="color" style="background-color: #333;"></a>
                    </div>
                </div>
                <div class="product-form product-variation-form product-size-swatch">
                    <label class="mb-1">Size:</label>
                    <div class="flex-wrap d-flex align-items-center product-variations">
                        <a href="#" class="size">Small</a>
                        <a href="#" class="size">Medium</a>
                        <a href="#" class="size">Large</a>
                        <a href="#" class="size">Extra Large</a>
                    </div>
                    <a href="#" class="product-variation-clean">Clean All</a>
                </div>

                <div class="product-variation-price">
                    <span></span>
                </div>

                <div class="product-form">
                    <div class="product-qty-form">
                        <div class="input-group">
                            <input class="quantity form-control" type="number" min="1" max="10000000">
                            <button class="quantity-plus w-icon-plus"></button>
                            <button class="quantity-minus w-icon-minus"></button>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-cart">
                        <i class="w-icon-cart"></i>
                        <span>Add to Cart</span>
                    </button>
                </div>

                <div class="social-links-wrapper">
                    <div class="social-links">
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                            <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                            <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                        </div>
                    </div>
                    <span class="divider d-xs-show"></span>
                    <div class="product-link-wrapper d-flex">
                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                        <a href="#"
                           class="btn-product-icon btn-compare btn-icon-left w-icon-compare"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Quick view -->

    <!-- End of Main -->
@endsection
@push('javascript_section')
    <script src="{{asset('assets/front/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script>

   function remove_variant(id,variant_id) {
       $.ajax({
                type: "GET",
                url: '{{url('remove-wishlist')}}/'+id+'/'+variant_id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    
                    if(result.status){
                       location.reload();

                    }
                }
            });
   }


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

 </script>>
@endpush