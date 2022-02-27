<div class="header-middle">
    <div class="container">
        <div class="header-left mr-md-4">
            <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
            </a>
            <a href="{!! url('home') !!}" class="logo ml-lg-0">
                <img src="{{asset('assets/front/images/logo.png')}}" alt="logo" width="144" height="45" />
            </a>
            <form method="get" action="{{route('productNameFilter')}}" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
{{--                <div class="select-box">--}}
{{--                    <select id="category" name="category">--}}
{{--                        <option value="">All Categories</option>--}}
{{--                        @foreach(getParentCategories() as $key => $cateroy)--}}
{{--                            <option value="{!! $cateroy->id !!}">{!! $cateroy->name !!}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <input type="text" class="form-control" name="p_name" id="search"
                       placeholder="Search in..." required />
                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                </button>
            </form>
        </div>
        <div class="header-right ml-4">
            @if(auth()->check())
            <a class="wishlist label-down link d-xs-show" href="{{url('wishlist')}}">
                <i class="w-icon-heart"></i>
                <span class="wishlist-label d-lg-show">Wishlist</span>
            </a>
            @endif
            <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2 cart_items_nav_bar">
                <div class="cart-overlay"></div>
                <a href="#" class="cart-toggle label-down link">
                    <i class="w-icon-cart">
                        <span class="cart-count">{{  count(wishlistItems()) }}   </span>
                    </i>
                    <span class="cart-label">Cart</span>
                </a>
                <div class="dropdown-box">
                    <div class="cart-header">
                        <i class="w-icon-long-arrow-right"></i>
                        <span>Shopping Cart</span>
                        <a href="#" class="btn-close">
                        </a>
                    </div>
                    <div class="">

                        @php

                         $sub_total=0;
                        @endphp

                        @foreach(wishlistItems() as $key=>$item)

                         @php
                 $image = \App\Models\Image::where('model_id',$item->variant_id)
                                            ->where('model_type','App\Models\ProductVariant')->first();



                   $data=(json_decode(Cookie::get('cart'),true));

                foreach ($data as $key => $value) {

                    if($value['variant_id']==$item->variant_id){

                    $local_qty=$value['local_qty'];
                    }
                }


            $sub_total+=$item->price * $local_qty;
                @endphp
                        <div class="product product-cart">
                            <div class="product-detail">
                                <a href="{!!  route('productDetail',[$item->product_id]) !!}" class="product-name">{{ $item->name }}</a>
                                <div class="price-box">
                                    <span class="product-quantity">{{ $local_qty  }}</span>
                                    <span class="product-price">${{$item->price}}</span>
                                </div>
                            </div>
                            <figure class="product-media">
                                <a href="{!!  route('productDetail',[$item->product_id]) !!}">
                                    <img src="{{ asset('assets/uploads/products/'.$image->image) }}" alt="product" height="84"
                                         width="94" />
                                </a>
                            </figure>
                            <button  onclick="remove_cart_variant('<?php echo $item->variant_id ?>')" class="btn btn-link btn-close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                      @endforeach

                    </div>

                    <div class="cart-total">
                        <label>Subtotal:</label>
                        <span class="price">${{$sub_total}}</span>
                    </div>

                    <div class="cart-action">
                        <a href="{{url('cart')}}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                        @if(auth()->check())
                           <!--  <a href="{{url('cart')}}" class="btn btn-primary  btn-rounded">Checkout</a> -->
                        @endif
                    </div>
                </div>
                <!-- End of Dropdown Box -->
            </div>
        </div>
    </div>
</div>
<!-- End of Header Middle -->
<script>


function remove_cart_variant(variant_id){
   $.ajax({
                type: "GET",
                url: '{{url('remove-cart-item')}}/'+variant_id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {



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
