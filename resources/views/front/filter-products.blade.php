   @if(count($products) > 0)
   <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2" id="products_content_div">

       @foreach($products as $key => $product)
       <div class="product-wrap">
           <div class="product text-center">
               <figure class="product-media">
                   <a href="{!! route('productDetail',[$product->id]) !!}">
                       <img src="{{asset('assets/uploads/products/'.$product->variants[0]->image->first()->image)}}" alt="Product" width="300" height="338" />
                   </a>
                   <div class="product-action-horizontal">
                       <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                       <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>
                       <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a>
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
                       <a href="{!! route('productDetail',[$product->id]) !!}" class="rating-reviews">(3 reviews)</a>
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
           <i class="w-icon-times-circle"></i>Oh snap!
       </h4> No Product Exists against this category.
   </div>
   @endif