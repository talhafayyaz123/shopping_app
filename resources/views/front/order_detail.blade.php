@extends('layouts.front_master')
@section('content')

    <!-- Start of Main -->
    <main class="main wishlist-page">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Order Detail</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav mb-10">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('/home')}}">Home</a></li>
                    <li>Order Detail</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <h3 class="wishlist-title">Products</h3>
                <table class="shop-table wishlist-table">
                    <thead>
                    <tr>
                        <th class="product-name"><span>Product</span></th>
                        <th></th>
                        <th>Sku</th>
                        <th class="product-price"><span>Price</span></th>
                        <th class="product-stock-status"><span>Quantity</span></th>
                        <th class="wishlist-action">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($order_meta as $item)


                    <tr>
                        <td class="product-thumbnail">
                            <div class="p-relative">

                                  @php
              foreach($item->product->variants as $key=> $var)
                {

             if($var->id==$item->variant_id){
            $image=$item->product->variants[$key]->image->first()->image;

             @endphp

                                <a>
                                    <figure>
                                        <img src="{!! asset('assets/uploads/products/'.$item->product->variants[$key]->image->first()->image) !!}" alt="product" width="300"
                                             height="338">
                                    </figure>
                                </a>
                     @php
                               }


                  }
                @endphp
                            </div>
                        </td>
                        <td class="product-name">
                            <a href="">
                                {{ $item->product->name }}
                            </a>
                        </td>
                        <td class="product-name">
                            <a href="">
                                {{$item->variant->sku }}
                            </a>
                        </td>
                        <td class="product-price"><ins class="new-price">$

                           @if($item->discount_price==0)
                            {{  $item->product_price }}
                            @else
                            {{  $item->discount_price }}
                            @endif
                        </ins></td>
                        <td class="product-price"><ins class="new-price">${{ $item->product_qty }}</ins></td>
                        <td class="wishlist-action">
                            <div class="d-lg-flex">

                       @if($status=='Delivered')

                          @if(!isset($item->reviews))


                      <a href="{{  route('productDetail',[$item->product->id, 'review' => 1, 'variant' => $item->variant_id])  }}"
                         class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Review</a>
                        @endif

                      @endif
                            </div>
                        </td>
                    </tr>

               @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>

@endsection
