@extends('layouts.master')
@section('content')
    <style>
        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            /*opacity: 1 !important;
     filter: alpha(opacity=100) !important;*/
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

        #discount_price {
            display: none;
        }
        #discount_valid_till{
            display: none;
        }
        .btn.btn-default{
            background: black;
            border-color: black;
            color: white;
        }
        .btn.btn-default:hover{
            background: black;
            border-color: black;
            color: white;
        }
        .has-error .form-control {
            border-color: #a94442;
            -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
            box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        }
    </style>
    <div class="container">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Product Detail (1)</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Product Variant Detail (2)</p>
                </div>
            </div>
        </div>
        <form method="post" action="{{url('storeProduct')}}" enctype="multipart/form-data" id="add_product_variant">
            @csrf
            <div class="row setup-content" id="step-1">
                {{--                <div class="row">--}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" required="required" class="form-control" placeholder="Product Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" required="required" name="description" id="description" placeholder="Description"
                                  rows="5" cols="5"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id" required="required" id="category_id" onchange="get_category()">
                            <option value="">Choose Category</option>
                            @foreach(getParentCategories() as $key => $category)
                                <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 first_child_category">
                    <div class="form-group">
                        <label>First Category</label>
                        <select class="form-control" name="child_category_id" id="child_category_id"
                                onchange="get_child_category()">
                            <option value="">Sub Category</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4 second_child_category">
                    <div class="form-group">
                        <label>Sub Child Category</label>
                        <select class="form-control" name="second_child_category_id" id="second_child_category_id">
                            <option value="">Sub Child Category</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Vendor</label>
                            <select class="form-control" name="vendor_id" id="vendor_id">
                                <option value="">Choose Vendor</option>
                                @foreach($vendors as $key =>$vendor)
                                    <option value="{!!$vendor->id !!}">{!!$vendor->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>

                {{--                </div>--}}
            </div>
            {{--            Step 2--}}
            <div class=" setup-content" id="step-2">
                <input type="hidden" name="total_product" id="total_product" value="{{$total_product_count}}">

                <div class="row" id="addedRows">

                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="add-section">
                            <a href="javascript:void(0)" onclick="add_more_product()" class="btn btn-sm btn-primary"><i
                                    class="fa fa-plus-circle"></i>
                                Add More </a>
                            <a href="javascript:void(0)" class="red btn btn-sm btn-danger" onclick="remove_product()"><i
                                    class="fa fa-minus-circle"></i> Remove </a>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-lg pull-right finish_btn" type="submit">Finish!</button>

            </div>
        </form>
    </div>
@endsection
@push('javascript_section')

    <!--begin::Page Resources -->
    <script src="{{asset('assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js')}}"
            type="text/javascript"></script>

    <script type="text/javascript">
        var total_product = {{$total_product_count}};
        count = 1;
        $(document).on('click', '.remCF', function () {
            $(this).parent().parent().parent().remove();
        });

        function removeRow(removeNum) {
            jQuery('#rowCount' + removeNum).remove();
        }


        function checkPurchasePrice(e){
            var id = e.id;
            console.log()
           var price  = $('#'+id).val();
           if(!Number.isInteger(price)){
               $('#'+id).css('border-color','red');
               toastr.error('Please add valid purhcase price it always positive integer');
               return false
           }
        }
        function checkSellingPrice(e){
            var id = e.id;
            console.log()
           var price  = $('#'+id).val();
           if(!Number.isInteger(price)){
               $('#'+id).css('border-color','red');
               toastr.error('Please add valid selling price it always positive integer');
               return false
           }
        }


        $(document).ready(function () {
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
                finish_btn = $('.finish_btn');
            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function () {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url'],select,textarea"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }
                if($('.first_child_category:hidden').length == 1)
                {
                    $('.first_child_category .form-group').removeClass('has-error')
                }else{
                    if($('#child_category_id').val() == ''){
                        $('.first_child_category .form-group').addClass('has-error')
                    }
                }
                if($('.second_child_category:hidden').length == 1)
                {
                    $('.second_child_category .form-group').removeClass('has-error')
                }else{
                    if($('#child_category_id').val() == ''){
                        $('.second_child_category .form-group').addClass('has-error')
                    }
                }
                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });
            finish_btn.click(function (e) {
                e.preventDefault();
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                curInputs = curStep.find("input[type='text'],input[type='url'],input[type='number'],input[type='file'],input[type='date'],select,textarea"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }
                if (isValid)
                        $('#add_product_variant').submit();
            })

            $('div.setup-panel div a.btn-primary').trigger('click');
        });


        $(document).ready(function () {

            add_more_product();
        });

        // Add more functionality
        function add_more_product() {
            total_product++;
            count++;
            var recRow = '<div class="row" id="add_data_' + total_product + '">' +
                            '<div class="col-md-3">' +
                                '<div class="form-group">' +
                                    '<label>Color</label>' +
                                    '<select class="form-control" name="color_id_' + total_product + '" id="color_id" required="required">' +
                                        '<option value="">Choose Color</option>' +
                                        '@foreach($colors as $key => $color)' +
                                        '+<option value="{!! $color->id !!}">{!! $color->name !!}</option>' +
                                        '@endforeach' +
                                    '</select>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                        '<div class="form-group">'+
                                            '<label>Size</label>'+
                                            '<select class="form-control" name="size_id_' + total_product + '[]" id="size_id" multiple required="required">' +
                                                '<option value="">Choose Size</option>'+
                                                @foreach($sizes as $key =>$size)
                                                    '<option value="{!!$size->id !!}">{!!$size->name !!}</option>'+
                                                @endforeach
                                            '</select>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                    '<label>Length</label>'+
                                    '<input type="number" class="form-control" id="length" name="length_' + total_product + '" placeholder="Product Length in inches"/>' +
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                    '<label>Height</label>' +
                                    '<input type="number" class="form-control" id="height" name="height_' + total_product + '" placeholder="Product height in inches"/>' +
                                '</div>' +
                            '</div>'+
                             '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                    '<label>Select Multilpe Images</label>'+
                                    '<input class="form-control" type="file" id="files" name="images_' + total_product + '[]" multiple required="required"/>' +
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                    '<label>Weight</label>'+
                                    '<input type="number" class="form-control" id="weight" name="weight_' + total_product + '" placeholder="Product Weight in inches"/>' +
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                    '<label>Quantity</label>'+
                                    '<input type="number" name="quantity_' + total_product + '" onfocusout="checkQuantity(this)" class="form-control" id="quantity-'+total_product+'" placeholder="Enter Quantity" required="required"/>' +
                                '</div>' +
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<div class="form-group">' +
                                    '<label>Alert Quantity</label>' +
                                    '<input type="number" name="alert_quantity_' + total_product + '" onfocusout="checkQuantity(this)" class="form-control" id="alert_quantity-'+total_product+'" placeholder="Enter Alert Quantity" required="required"/>' +
                                '</div>' +
                            '</div>'+
                            '<div class="col-md-3">' +
                                '<div class="form-group">' +
                                    '<label>Purchase Price</label>' +
                                    '<input type="number" min="0" onfocusout="checkPurchasePrice(this)" class="form-control" name="purchase_price_'+ total_product+'" id="purchase_price-'+total_product+'" placeholder="Purchase Price" required="required"/>' +
                                '</div>' +
                            '</div>'


            var abc =
                '<div class="col-md-3">'+
                '<div class="form-group">'+
                '<label>Selling Price</label>'+
                '<input type="number" class="form-control" onfocusout="checkSellingPrice(this)" name="selling_price_' + total_product + '" id="selling_price-'+total_product+'" min="0" placeholder="Selling Price" required="required"/>' +
                '</div>'+
                '</div>';
            var abc2 ='<div class="col-md-3">' +
                    '<div class="form-group">' +
                            '<label>Purchase Date</label>' +
                            '<input type="date" name="purchase_date_'+total_product+'" class="form-control purchase_date" id="m_datepicker_1" placeholder="Select date" required="required"/>' +
                        '</div>' +
                    '</div>' +
                '<div class="col-md-1">' +
                    '<div class="form-group">' +
                        '<label class="m-checkbox">' +
                        '<input type="checkbox" name="is_active" id="is_active" checked> Active <span></span>' +
                        '</label>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-1">' +
                    '<label class="m-checkbox">' +
                    '<input type="checkbox" name="is_new_arrival-'+total_product+'" id="is_new_arrival">New Arrival <span></span>' +
                    '</label>' +
                '</div>' +
                '<div class="col-md-1">' +
                    '<label class="m-checkbox">'+
                    '<input type="checkbox" name="is_featured[]" class="is_featured-' + total_product + '" id="is_featured">Featured <span></span>' +
                    '</label>' +
                '</div>' +
                '<div class="col-md-1">' +
                    '<label class="m-checkbox">'+
                    '<input type="checkbox" name="is_discounted[]" onclick="show_disount_price('+total_product+')" class="is_discounted-' + total_product + '" id="is_discounted">Discount <span></span>' +
                    '</label>' +
                '</div>' +
                '<div class="col-md-3 discount_fields-'+total_product+'" id="discount_price_div">' +
                    '<input type="number" name="discount_price[]" class="form-control discount_price-'+total_product+'" id="discount_price" placeholder="Enter Discount Price"/>' +
                '</div>' +
                '<div class="col-md-3 discount_fields-'+total_product+'" id="discount_date_div">' +
                 '<input type="date" name="discount_valid_till[]" class="form-control discount_valid_till-'+total_product+'" id="discount_valid_till" placeholder="YYYY-mm-dd">' +
                '</div>' +
                '<hr>' +
                '<div class="clearfix"></div>';

            var html = recRow+''+abc+''+abc2;

            $('#total_product').val(total_product);
            $('#addedRows').append(html);


        }

        function remove_product() {
            if (total_product > 1) {
                $('#add_data_' + total_product).fadeOut(300, function () {
                    $(this).remove();
                });
                total_product--;
                $('#total_product').val(total_product);
            }
        }

        // end

        $('.first_child_category').hide();
        $('.second_child_category').hide();

        function get_category() {
            var category_id;
            category_id = $('#category_id').val();
            if (category_id != '' && category_id > 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '<?=route("getFirstcategory")?>',
                    dataType: "JSON",
                    data: {category_id: category_id},
                    success: function (data) {
                        if (data.length > 0) {
                            $('#child_category_id').html('<option value="">Sub Category</option>');
                            $('#second_child_category_id').html('<option value="">Sub Child Category</option>');
                            $.each(data, function (k, v) {
                                console.log(v);

                                $('#child_category_id').append('<option   value="' + v['id'] + '">' + v['name'] + '</option>');

                            });
                            $('#child_category_id').attr("required",true);
                            $('.first_child_category').show();
                        }else{
                            $('#child_category_id').removeAttr('required')
                            $('.first_child_category').hide();
                        }

                    }
                });

            } else {
                $('#child_category_id').removeAttr('required');
                $('.first_child_category').hide();
                $('.second_child_category').hide();
            }

        }

        function get_child_category() {
            var child_category_id;
            child_category_id = $('#child_category_id').val();
            if (child_category_id != '') {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '<?=route("getSecondChildCategory")?>',
                    dataType: "JSON",
                    data: {child_category_id: child_category_id},
                    success: function (data) {
                        if (data.length > 0) {
                            $('#second_child_category_id').html('<option value="">Sub Child Category</option>');
                            $.each(data, function (k, v) {
                                console.log(v);
                                $('#second_child_category_id').append('<option   value="' + v['id'] + '">' + v['name'] + '</option>');
                            });
                            $('#second_child_category_id').attr("required",true)
                            $('.second_child_category').show();
                        }else{
                            $('#second_child_category_id').removeAttr('required')
                            $('.second_child_category').hide();
                        }

                    }
                });

            } else {
                $('#second_child_category_id').removeAttr('required')
                $('.second_child_category').hide();
            }
        }

        function show_disount_price(count) {
            if($('.is_discounted-'+count).is(':checked')){
                $('.discount_price-'+count).show();
                $('.discount_valid_till-'+count).show();
            }else{
                $('.discount_price-'+count).hide();
                $('.discount_valid_till-'+count).hide();
            }
        }
        function checkQuantity(e){
            console.log(total_product)
            var id = e.id;
            var quantity  = parseInt($('#quantity-'+total_product).val());
            var alert_quantity = parseInt($('#alert_quantity-'+total_product).val());
            console.log(quantity);
            console.log(alert_quantity);
            console.log(quantity < alert_quantity)
            if(quantity < alert_quantity){
                toastr.error('Alert Quantity should less than Qauntity');
                $('#alert_quantity-'+total_product).val('');
                return false;
            }
            if(quantity != '' && !Number.isInteger(quantity)){
                $('#quantity-'+total_product).css('border-color','red');
                toastr.error('Please add valid Quantity. It always positive integer');
                return false
            }
            if(alert_quantity != '' && !Number.isInteger(alert_quantity)){
                $('#alert_quantity-'+total_product).css('border-color','red');
                toastr.error('Please add valid Alert Quantity. It always positive integer');
                return false
            }
        }
    </script>
@endpush
