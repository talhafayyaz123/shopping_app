@extends('layouts.front_master')
@section('content')
    <!-- Start of Main -->
    <main class="main cart">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="active"><a href="{{url('cart')}}">Shopping Cart</a></li>
                    {{--                    <li><a href="checkout.html">Checkout</a></li>--}}
                    {{--                    <li><a href="order.html">Order Complete</a></li>--}}
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <form method="post" action="{{url('orderPlace')}}" enctype="multipart/form-data">
                   
                    @csrf
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-8 pr-lg-4 mb-6">
                            <table class="shop-table cart-table">
                                <thead>
                                <tr>
                                    <th class="product-name"><span>Product</span></th>
                                    <th></th>
                                    <th class="product-price"><span>Price</span></th>
                                    <th class="product-quantity"><span>Quantity</span></th>
                                    <th class="product-subtotal"><span>Subtotal</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sub_total=0;
                                @endphp
                                @if(count(wishlistItems()) >0 )
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


                                             $sub_total+=$item->price*$local_qty;
                                    @endphp


                                    <input type="hidden" name="variant_discount_{{$item->variant_id}}[]"
                                           id='variant_discount_{{$item->variant_id}}' value="{{$item->is_discounted}}">

                                    <input type="hidden" name="variant_discount_price_{{$item->variant_id}}[]"
                                           id='variant_discount_price_{{$item->variant_id}}'
                                           value="{{$item->discount_price}}">


                                    <input type="hidden" name="checkout_product_id[]" id='checkout_product_id'
                                           value="{{$item->product_id}}">
                                    <input type="hidden" name="checkout_varient_id[]" id='checkout_varient_id'
                                           value="{{$item->variant_id}}">
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{!!  route('productDetail',[$item->product_id]) !!}">
                                                    <figure>
                                                        <img src="{{ asset('assets/uploads/products/'.$image->image) }}"
                                                             alt="product"
                                                             width="300" height="338">
                                                    </figure>
                                                </a>

                                            </div>
                                        </td>

                                        <td class="product-name">
                                            <a href="{!!  route('productDetail',[$item->product_id]) !!}">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        @php
                                            if($item->is_discounted == 1){
                                                $price = $item->price - $item->discount_price;
                                            }else{
                                                $price = $item->price;
                                            }
                                        @endphp
                                        <td class="product-price"><span class="amount">{{$price}}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group">

                                                <input
                                                    oninput="check_qty(this.value, {{ $item->price }}, {{ $item->quantity }},{{$item->variant_id}} )"
                                                    name="quantity_{{$item->variant_id}}[]"
                                                    id='quantity_{{$item->variant_id}}' class="form-control"
                                                    type="number" min="1" max="{{$item->quantity}}"
                                                    value="{{$local_qty }}">

                                                <!--  <button class="quantity-plus w-icon-plus"></button>
                                                 <button class="quantity-minus w-icon-minus"></button> -->
                                                <span style="color:red; display: none;"
                                                      class="max_limit_{{$item->variant_id}}">Maximum limit is 12</span>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            @php
                                                if($item->is_discounted == 1){
                                                    $price = $item->price - $item->discount_price;
                                                }else{
                                                    $price = $item->price;
                                                }
                                            @endphp
                                            <span class="amount"
                                                  id='variant_sub_total_{{$item->variant_id}}'>{{ $price * $local_qty }}</span>
                                            <input type="hidden" name="variant_sub_total_hidden_{{$item->variant_id}}[]"
                                                   id='variant_sub_total_hidden_{{$item->variant_id}}'
                                                   value="{{$item->price * $local_qty}}">
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                  <tr>
                                    <td>No Items Found<td>
                                <tr>

                             @endif 
                                </tbody>
                            </table>

                            @if(Auth::check())
                                <div class="cart-action mb-6">
                                    <a href="{!! url('home') !!}"
                                       class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                            class="w-icon-long-arrow-left"></i>Continue Shopping</a>

                                   @if(count(wishlistItems()) >0 )
                                    <a  href="{!! url('clear_cart') !!}" class="btn btn-rounded btn-default btn-clear clear_cart"
                                            name="clear_cart" value="Clear Cart">Clear Cart
                                    </a>
                                    @endif
                                    <!--  <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart" value="Update Cart">Update Cart</button> -->
                                </div>
                            @else

                                 <div class="cart-action mb-6">
                                    

                                   @if(count(wishlistItems()) >0 )
                                    <a  href="{!! url('clear_cart') !!}" class="btn btn-rounded btn-default btn-clear clear_cart"
                                            name="clear_cart" value="Clear Cart">Clear Cart
                                    </a>
                                    @endif
                                   
                                </div>

                            @endif



                            @if(Auth::check())
                            <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
                            <input type="text" class="form-control mb-4" onchange="chek_coupon_validity()" name="coupon_price" id='coupon_price'
                                   placeholder="Enter coupon code here..."/>
                            <!--   <button class="btn btn-dark btn-outline btn-rounded">Apply Coupon</button> -->
                             <span id="validation_errors" class="error invalid-feedback" style="display: none"></span>
                            <span id="success_mesage" style="display: none;color:green"></span>
                            @endif
          
                        </div>
                        <div class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar">
                                <div class="cart-summary mb-4">
                                    <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Subtotal</label>
                                        <span id='cart_sub_total'>{{$sub_total}}</span>
                                        <input type="hidden" name="cart_sub_total_hidden" id='cart_sub_total_hidden'
                                               value="{{$sub_total}}">
                                    </div>

                                    <hr class="divider">

                                    <ul class="shipping-methods mb-2">
                                        <li>
                                            <label
                                                class="shipping-title text-dark font-weight-bold">Shipping</label>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="free-shipping" class="custom-control-input"
                                                       name="shipping">
                                                <label for="free-shipping"
                                                       class="custom-control-label color-dark">Free
                                                    Shipping</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="local-pickup" class="custom-control-input"
                                                       name="shipping">
                                                <label for="local-pickup"
                                                       class="custom-control-label color-dark">Local
                                                    Pickup</label>
                                            </div>
                                        </li>
                                        <li>
                                            <!--      <div class="custom-radio">
                                                     <input type="radio" id="flat-rate" class="custom-control-input"
                                                            name="shipping">
                                                     <label for="flat-rate" class="custom-control-label color-dark">Flat
                                                         rate:
                                                         $5.00</label>
                                                 </div>
                                             </li> -->
                                    </ul>

                                    @if(Auth::check())
                                        <div class="shipping-calculator">
                                            <p class="shipping-destination lh-1">Shipping to
                                                <br><strong>{{$address->address ?? '' }}</strong>.</p>

                                            @if(isset($address->country))

                                                <div class="form-group">
                                                    <div class="select-box">
                                                        <select name="country" class="form-control form-control-md">
                                                            <option value="{{$address->country}}"
                                                                    selected="selected">{{$address->country}}
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <div class="select-box">
                                                    <input type="text" class="form-control form-control-md"
                                                           value="{{$address->address ?? ''}}" id='address'
                                                           name="address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-md" type="text"
                                                       name="city" id='city' value="{{$address->city ?? ''}}"
                                                       placeholder="Town / City">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-md" type="text"
                                                       name="zip" placeholder="ZIP" value="{{$address->zip ?? ''}}">
                                            </div>
                                            <!--  <button  class="btn btn-dark btn-outline btn-rounded">Update
                                                 Totals</button>
                                      -->
                                        </div>
                                    @endif

                                    <hr class="divider mb-6">
                                <!-- <div class="order-total d-flex justify-content-between align-items-center">
                                    <label>Total</label>
                                    <span class="ls-50">{{$sub_total}}</span>
                                 </div> -->

                                    @if(count(wishlistItems()) >0 )
                                        @if(Auth::check())

                                            @if(isset($address))

                                                <button
                                                    class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                                    Proceed to checkout<i class="w-icon-long-arrow-right"></i></button>

                                            @else

                                                <h5 class="text-danger">Please Add Atleat One Delivery Address For
                                                    Checkout</h5>


                                            @endif


                                        @else

                                            <a href="{!! url('/login-popup') !!}"
                                               class="d-lg-show login sign-in btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                                Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>


                                        @endif
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->
@endsection


@push('javascript_section')
    <script>
    
        function chek_coupon_validity(){
       
             var coupon_code=$('#coupon_price').val();
                       if(coupon_code !=''){
             $.ajax({
                       url: '{{url('check_coupon_validity')}}/' + coupon_code,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'get',
                        success: function (response) {
                     
                            if (response.status == 200) { 
                      
                                $('#success_mesage').text('Coupon Exists.')
                                $('#success_mesage').show()
                                $('#validation_errors').hide()
                        
                            }
                            if (response.status == 422) {
                                $('#validation_errors').text(response.message)
                                $('#validation_errors').show()
                                $('#success_mesage').hide()
                               
                                return false;
                            }
                        }
                    });           
                       }
             

        }
 
        function check_qty(val, price, quantity, variant_id) {
            if (val != '') {

                var sub_total = price * val;
                var cart_sub_total_hidden = $('#cart_sub_total_hidden').val();
                var cart_sub_total = cart_sub_total_hidden - $('#variant_sub_total_hidden_' + variant_id).val();

                $('#cart_sub_total_hidden').val(cart_sub_total + sub_total);
                $('#cart_sub_total').text('$' + (cart_sub_total + sub_total));


                $('#variant_sub_total_' + variant_id).text('$' + sub_total);
                $('#variant_sub_total_hidden_' + variant_id).val(sub_total);


                $('#quantity_' + variant_id).val(val);

                if (val > quantity) {
                    $('#quantity_' + variant_id).val(quantity);
                    $('.max_limit_' + variant_id).show();
                    $('.max_limit_' + variant_id).text('Maximum limit is ' + quantity);
                    $('#variant_sub_total_' + variant_id).text('$' + price * quantity);
                    $('#variant_sub_total_hidden_' + variant_id).val(price * quantity);

                    $('#cart_sub_total_hidden').val(cart_sub_total + (price * quantity));
                    $('#cart_sub_total').text('$' + (cart_sub_total + (price * quantity)));


                } else {
                    $('.max_limit_' + variant_id).hide();

                }
            }
        }

    </script>
@endpush
