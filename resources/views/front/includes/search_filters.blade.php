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
                  $search=request()->query('p_name');
                @endphp


            <input  name="search" value="{{$search}}" type="hidden" id='search_vaue'>

                

                <div class="widget-body">

                     <label class="form-check"> 
                        <input style="padding: 1rem 8px 1rem 1.2rem !important;"
                         class="form-check-input size_filter" id='price_limit' name="price_limit" value="0-500" type="radio">

                     &nbsp; <span class="form-check-label">
                    <span class="float-right badge badge-light round"></span> PKR 0.00 - PKR 500.00
                    </span>
                    </label>

                     <br>
                     <label class="form-check"> 
                        <input style="padding: 1rem 8px 1rem 1.2rem !important;"
                         class="form-check-input size_filter" id='price_limit' name="price_limit" value="500-1000" type="radio">

                     &nbsp; <span class="form-check-label">
                    <span class="float-right badge badge-light round"></span> PKR 500.00 - PKR 1000.00
                    </span>
                    </label>


                    <br>
                     <label class="form-check"> 
                        <input style="padding: 1rem 8px 1rem 1.2rem !important;"
                         class="form-check-input size_filter" id='price_limit' name="price_limit" value="1000-1500" type="radio">

                     &nbsp; <span class="form-check-label">
                    <span class="float-right badge badge-light round"></span> PKR 1000.00 - PKR 1500.00
                    </span>
                    </label>

                    <br>
                     <label class="form-check"> 
                        <input style="padding: 1rem 8px 1rem 1.2rem !important;"
                         class="form-check-input size_filter" name="price_limit" id='price_limit' value="1500-2000" type="radio">

                     &nbsp; <span class="form-check-label">
                    <span class="float-right badge badge-light round"></span> PKR 1500.00 - PKR 2000.00
                    </span>
                    </label>


                 <br>
                     <label class="form-check"> 
                        <input style="padding: 1rem 8px 1rem 1.2rem !important;"
                         class="form-check-input size_filter" id='price_limit' name="price_limit" value="2000" type="radio">

                     &nbsp; <span class="form-check-label">
                    <span class="float-right badge badge-light round"></span>PKR 2000.00+
                    </span>
                    </label>
 
                                 <br>
                   
                    <div class="price-range">
                        <input type="number" id='min_price' name="min_price" class="min_price text-center"
                               placeholder="$min"><span class="delimiter">-</span>
                    <input type="number" id='max_price' name="max_price" class="max_price text-center" placeholder="$max">

                    </div>
                </div>
            </div>
            <!-- End of Collapsible Widget -->

            <!-- Start of Collapsible Widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title"><label>Size</label></h3>
                <ul class="widget-body filter-items item-check mt-1">

                    <div id="price_filter_form">
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
                    </div>
                </ul>
            </div>
            <!-- End of Collapsible Widget -->

       

            <!-- Start of Collapsible Widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title"><label>Color</label></h3>
                <ul class="widget-body filter-items item-check mt-1">

                    <div id="color_filter_form">
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

                    </div>

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


    function products_filter() {


    var sizes = count_size();

    if(sizes.length == 0){
        sizes=0;
    }else{
        sizes=sizes.join('-');
    }

    var colors = count_color();

     if(colors.length == 0){
        colors=0;
    }else{
        colors=colors.join('-');
    }

    var search = $('#search_vaue').val();
  

   var min_price=$('#min_price').val();
   if(min_price==''){
    min_price=0;
   }

   var max_price=$('#max_price').val();
    if(max_price==''){
    max_price=0;
   }

    var min_max=min_price+'-'+max_price;


    if($("input[type='radio']#price_limit").is(':checked')) {
   var price_limit=$('input[name="price_limit"]:checked').val();

    }else{
    var price_limit=0;
    }
    
 
  

    var ajax_parameters = search+'/'+colors+'/'+sizes+'/'+min_max+'/'+price_limit;

                 $.ajax({
                type: "GET",
                url: '{{url('product_search_filter')}}/' + ajax_parameters,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    $('.filtered_products').html(result.html);
                    window.scrollTo({top: 0, behavior: 'smooth'});


                }
            });


    }

</script>