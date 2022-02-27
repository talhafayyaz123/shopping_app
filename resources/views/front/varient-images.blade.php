   <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">


@foreach($product_varient->image as $i => $image)

<figure class="product-image">
    <img src="{!! asset('assets/uploads/products/'.$image->image) !!}"
         data-zoom-image="{!! asset('assets/uploads/products/'.$image->image) !!}"
         alt="" width="800" height="900">
</figure>
@endforeach
 </div> 
 <div class="product-thumbs-wrap">
<div class="product-thumbs row cols-4 gutter-sm">
    <div class="product-thumb active">
        <img src="{!! asset('assets/uploads/products/'.$product_varient->image->first()->image) !!}"
             alt="Product Thumb sdfds" width="800" height="900">
    </div>
    @foreach($product_varient->image as $i => $image)

        @if($i > 0)
            <div class="product-thumb">
            <img src="{!! asset('assets/uploads/products/'.$image->image) !!}"
                 alt="Product Thumb" width="800" height="900">
            </div>
        @endif
    @endforeach
</div>
<button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
<button class="thumb-down disabled"><i
        class="w-icon-angle-right"></i></button>
</div>