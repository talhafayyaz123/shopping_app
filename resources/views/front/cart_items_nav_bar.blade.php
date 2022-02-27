<div class="cart-overlay"></div>
<a href="#" class="cart-toggle label-down link">
    <i class="w-icon-cart">

        <span class="cart-count">{{  count(wishlistItems()) }}   </span>
    </i>
    <span class="cart-label">Cart</span>
</a>
<div class="dropdown-box">
    <div class="cart-header">
        <span>Shopping Cart</span>
        <a href="#" class="btn-close">
{{--            <i class="w-icon-long-arrow-right"></i>--}}
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
                    <a href="#" class="product-name">{{ $item->name }}</a>
                    <div class="price-box">
                        <span class="product-quantity">{{ $local_qty  }}</span>
                        <span class="product-price">${{$item->price}}</span>
                    </div>
                </div>
                <figure class="product-media">
                    <a href="#">
                        <img src="{{ asset('assets/uploads/products/'.$image->image) }}" alt="product" height="84"
                             width="94"/>
                    </a>
                </figure>
                <button onclick="remove_cart_variant('<?php echo $item->variant_id ?>')" class="btn btn-link btn-close">
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
            <a href="{{url('cart')}}" class="btn btn-primary  btn-rounded">Checkout</a>
        @endif
    </div>
</div>
<!-- End of Dropdown Box -->
