<aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
    <!-- Start of Sidebar Overlay -->
    <div class="sidebar-overlay"></div>
    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

    <!-- Start of Sidebar Content -->
    <div class="sidebar-content scrollable">
        <!-- Start of Sticky Sidebar -->
        <div class="sticky-sidebar">
            <div class="filter-actions">
                <label>Filter :</label>
                <a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
            </div>
            <!-- Start of Collapsible widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title"><label>All Categories</label></h3>
                <ul class="widget-body filter-items search-ul">
                    @foreach(allCategories() as $key => $category)
                        <li>
                            <a href="{!! route('getProducts',[$category->name]) !!}">{!! $category->name !!}</a>
                            
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- End of Collapsible Widget -->

            <!-- Start of Collapsible Widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title"><label>Price</label></h3>
                

                @php
                 $path=Request::path();
                  
                 if($path=='product_price_filter'){
                  $cat=request()->query('cat');
                 }elseif ($path=='product_category_filter'){
                $cat=request()->query('category_name');
                 }else{
                $cat=Request::segment(2);
                    
                 }

                @endphp
                <div class="widget-body">
                    <ul class="filter-items search-ul">
                        <li><a href="{!! url('product_price_filter').'?price_limit=0-500&cat='.$cat    !!}">PKR 0.00 - PKR 500.00</a>
                        </li>
                        <li><a href="{!! url('product_price_filter').'?price_limit=500-1000&cat='.$cat!!}">PKR 500.00 - PKR
                                1000.00</a></li>
                        <li><a href="{!! url('product_price_filter').'?price_limit=1000-1500&cat='.$cat!!}">PKR 1000.00 - PKR
                                1500.00</a></li>
                        <li><a href="{!! url('product_price_filter').'?price_limit=1500-2000&cat='.$cat!!}">PKR 1500.00 - PKR
                                2000.00</a></li>
                        <li><a href="{!! url('product_price_filter').'?price_limit=2000&cat='.$cat!!}">PKR 2000.00+</a></li>
                    </ul>
                    <form class="price-range" method="price" action="{!! url('product_price_filter') !!}">
                        <input type="number" name="min_price" class="min_price text-center"
                               placeholder="$min"><span class="delimiter">-</span><input
                                type="number" name="max_price" class="max_price text-center"
                                placeholder="$max">
                        <input type="hidden" value="{{$cat}}" name="cat">        
                        <button type="submit" class="btn btn-primary btn-rounded">Go</button>
                    </form>
                </div>
            </div>
            <!-- End of Collapsible Widget -->

            <!-- Start of Collapsible Widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title"><label>Size</label></h3>
                <ul class="widget-body filter-items item-check mt-1">

                    <form id="price_filter_form" action="{!! url('product_price_filter') !!}">
                        @foreach(allSizes() as $key => $size)

                            <br>
                            <label class="form-check">
                                <input style="padding: 1rem 8px 1rem 1.2rem !important;"
                                       class="form-check-input size_filter" name="sizes[]" value="{{ $size->id }}"
                                       type="checkbox">

                                &nbsp; <span class="form-check-label">
                    <span class="float-right badge badge-light round"></span> {{ $size->name }}
                                        </span>
                            </label>

                        @endforeach
                    </form>
                </ul>
            </div>
            <!-- End of Collapsible Widget -->

            <!-- Start of Collapsible Widget -->
        {{--<div class="widget widget-collapsible">
            <h3 class="widget-title"><label>Brand</label></h3>
            <ul class="widget-body filter-items item-check mt-1">
                <li><a href="#" >Elegant Auto Group</a></li>
                <li><a href="#">Green Grass</a></li>
                <li><a href="#">Node Js</a></li>
                <li><a href="#">NS8</a></li>
                <li><a href="#">Red</a></li>
                <li><a href="#">Skysuite Tech</a></li>
                <li><a href="#">Sterling</a></li>
            </ul>
        </div>--}}
        <!-- End of Collapsible Widget -->

            <!-- Start of Collapsible Widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title"><label>Color</label></h3>
                <ul class="widget-body filter-items item-check mt-1">

                    <form id="color_filter_form">
                        @foreach(allColors() as $color)

                            <br>
                            <label class="form-check">
                                <input style="padding: 1rem 8px 1rem 1.2rem !important;"
                                       class="form-check-input color_filter" name="sizes[]" value="{{ $color->id }}"
                                       type="checkbox">

                                &nbsp; <span class="form-check-label">
                    <span class="float-right badge badge-light round"></span> {{ $color->name }}
                                        </span>
                            </label>

                        @endforeach

                    </form>

                </ul>
                <button type="button" class="btn btn-primary btn-rounded" onclick="products_filter()">Serch</button>

            </div>
            <!-- End of Collapsible Widget -->
        </div>
        <!-- End of Sidebar Content -->
    </div>
    <!-- End of Sidebar Content -->
</aside>

<script>

    var url = window.location.pathname.split("/");
    var controller = url[1];

     var category='';
    if(typeof url[2] !='undefined'){
    category= url[2];
    }

    function count_size() {
        var sizes = [];
        $('input.size_filter[type=checkbox]').each(function () {

            if (this.checked) {

                sizes.push($(this).val());

            }

        });

        return sizes;
    }

    function count_color() {
        var colors = [];
        $('input.color_filter[type=checkbox]').each(function () {

            if (this.checked) {

                colors.push($(this).val());

            }

        });

        return colors;
    }


    function all_filter() {
        var sizes = count_size();

        var colors = count_color();
        var param_name = getSearchParameters()[0].split("=")[0];
        if (controller == 'product_price_filter' && (param_name != 'color' || param_name == 'size')) {
            var params = getSearchParameters()[1];


          if(getSearchParameters()[0].split("=")[0]=='price_limit'){
               var cat=getSearchParameters()[1].split("=")[1];
            }else{
               var cat=getSearchParameters()[2].split("=")[1];  
            }

         

            if (params) {
                var min_price = getSearchParameters()[0].split("=")[1];
                var max_price = getSearchParameters()[1].split("=")[1];


               
                  if(getSearchParameters()[0].split("=")[0]=='min_price'){
       
                  var ajax_parameters = 'price-range/' + min_price + '/' + max_price + '/' + sizes.join('-') + '/' + colors.join('-')+'?cat='+cat;
                

              }else{
                var range = min_price.split("-");

               if(typeof range[1] =='undefined'){


                var price_limit = getSearchParameters()[0].split("=")[1];

                var ajax_parameters = 'price/' + price_limit + '/0/' + sizes.join('-') + '/' + colors.join('-')+'?cat='+cat;


                 }else{
                 var ajax_parameters = 'price-range/' + range[0] + '/' + range[1] + '/' + sizes.join('-') + '/' + colors.join('-')+'?cat='+cat;
            
                 }
                
              }



            } else {
                var price_limit = getSearchParameters()[0].split("=")[1];

                var ajax_parameters = 'price/' + price_limit + '/0/' + sizes.join('-') + '/' + colors.join('-')+'?cat='+cat;

            }


            $.ajax({
                type: "GET",
                url: '{{url('product_size_color-filter')}}/' + ajax_parameters,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    $('.filtered_products').html(result.html);
                    window.scrollTo({top: 0, behavior: 'smooth'});


                }
            });


        }

    }

    function size_filter() {

        var sizes = count_size();

        var param_name = getSearchParameters()[0].split("=")[0];

        if (controller != 'product_price_filter') {
            if (sizes.length != 0) {

                let url = "<?php echo URL::to('product_price_filter'); ?>" + '?size=' + sizes.join('-')+'&cat='+category;
                window.location.href = url;

            }

        } else if (controller == 'product_price_filter' && (param_name == 'color' || param_name == 'size')) {

            if (sizes.length != 0) {

                let url = "<?php echo URL::to('product_price_filter'); ?>" + '?size=' + sizes.join('-')+'&cat='+getSearchParameters()[1].split("=")[1];
                window.location.href = url;

            }
        } else {
            var params = getSearchParameters()[1];
        
           if(getSearchParameters()[0].split("=")[0]=='price_limit'){
               var cat=getSearchParameters()[1].split("=")[1];
            }else{
               var cat=getSearchParameters()[2].split("=")[1];  
            }

            if (params) {
                var min_price = getSearchParameters()[0].split("=")[1];
                var max_price = getSearchParameters()[1].split("=")[1];

                 if(getSearchParameters()[0].split("=")[0]=='min_price'){
               var ajax_parameters = 'price-range/' + min_price + '/' + max_price + '/' + sizes.join('-')+'?cat='+cat;;

                 }else{
                var range = min_price.split("-");

                 if(typeof range[1] =='undefined'){
                
                 var price_limit = getSearchParameters()[0].split("=")[1];

                var ajax_parameters = 'price/' + price_limit + '/0/' + sizes.join('-')+'?cat='+cat;
                 
                }else{

                var ajax_parameters = 'price-range/' + range[0] + '/' + range[1] + '/' + sizes.join('-')+'?cat='+cat;;
   
                }
                
  
                 }
 
            } else {
                var price_limit = getSearchParameters()[0].split("=")[1];

                var ajax_parameters = 'price/' + price_limit + '/0/' + sizes.join('-')+'?cat='+cat;

            }


            $.ajax({
                type: "GET",
                url: '{{url('product_size-filter')}}/' + ajax_parameters,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    $('.filtered_products').html(result.html);
                    window.scrollTo({top: 0, behavior: 'smooth'});

                }
            });

        }


    }


    function getSearchParameters() {
        var prmstr = window.location.search.substr(1);
        var prmarr = prmstr.split("&");
        return prmarr;
        //   return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
    }


    function color_filter() {


        var colors = count_color();
        var param_name = getSearchParameters()[0].split("=")[0];
    
        if (controller != 'product_price_filter') {
            if (colors.length != 0) {
                let url = "<?php echo URL::to('product_price_filter'); ?>" + '?color=' + colors.join('-')+'&cat='+category;
                window.location.href = url;

            }


        } else if (controller == 'product_price_filter' && (param_name == 'color' || param_name == 'size')) {
        
            if (colors.length != 0) {
                let url = "<?php echo URL::to('product_price_filter'); ?>" + '?color=' + colors.join('-')+'&cat='+getSearchParameters()[1].split("=")[1];
                window.location.href = url;

            }
        } else {
            var params = getSearchParameters()[1];
                        
           
            if(getSearchParameters()[0].split("=")[0]=='price_limit'){
               var cat=getSearchParameters()[1].split("=")[1];
            }else{
               var cat=getSearchParameters()[2].split("=")[1];  
            }

            if (params) {

                var min_price = getSearchParameters()[0].split("=")[1];
                var max_price = getSearchParameters()[1].split("=")[1];

              if(getSearchParameters()[0].split("=")[0]=='min_price'){
       var ajax_parameters = 'price-range/' + min_price + '/' + max_price + '/' + colors.join('-')+'?cat='+cat;
                

              }else{
                var range = min_price.split("-");

               if(typeof range[1] =='undefined'){
    var price_limit = getSearchParameters()[0].split("=")[1];
                var ajax_parameters = 'price/' + price_limit + '/0/' + colors.join('-')+'?cat='+cat;

                 }else{
            var ajax_parameters = 'price-range/' + range[0] + '/' + range[1] + '/' + colors.join('-')+'?cat='+cat;

                 }
                
              }
                
            } else {

                var price_limit = getSearchParameters()[0].split("=")[1];
                var ajax_parameters = 'price/' + price_limit + '/0/' + colors.join('-')+'?cat='+cat;

            }

          

            $.ajax({
                type: "GET",
                url: '{{url('product_color-filter')}}/' + ajax_parameters,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    $('.filtered_products').html(result.html);
                    window.scrollTo({top: 0, behavior: 'smooth'});


                }
            });
        }


    }


    function products_filter() {


        var sizes = count_size();

        var colors = count_color();


        if (sizes.length > 0 && colors.length == 0) {
            size_filter();
        }

        if (sizes.length == 0 && colors.length > 0) {
            color_filter()
        }

        if (sizes.length > 0 && colors.length > 0) {
            all_filter();
        }


    }

</script>