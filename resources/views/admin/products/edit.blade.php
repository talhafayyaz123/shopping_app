@extends('layouts.master')
@section('content')
    <style>
    </style>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Edit Product</h3>
                    <h3 class="pull-right">Product Sku: {!! $product->sku !!}</h3>
                </div>
            </div>
        </div>
        @php
            $category_id = $first_child = $second_child = 0;
                 if($product->category_id != ''){
                    $category_id =  $product->category_id;
                }
                if($product->first_child_category != ''){
                    $first_child =  $product->first_child_category;
                }
                if($product->second_child_category != ''){
                    $second_child =  $product->second_child_category;
                }
        @endphp
        <div class="m-portlet__body">
            <form method="post" action="{{route('products.update',[$product->id])}}" enctype="multipart/form-data">
                <input type="hidden" value="{!! $product->id !!}" id="product_id" name="product_id">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Product Name" value="{!! $product->name !!}" required>
                        </div>
                    </div>

                    {{--                    <div class="col-md-4">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <label>Sku</label>--}}
                    {{--                            <input name="sku" required class="form-control" id="sku" value="" readonly>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" required id="description" placeholder="Description" rows="5" cols="5">
                                {!! trim($product->description)!!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" id="category_id" onchange="get_category()">
                                <option value="">Choose Category</option>
                                @foreach(getParentCategories() as $key => $category)
                                    <option value="{!! $category->id !!}" @if($category_id == $category->id) selected @endif>{!! $category->name !!}</option>

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

                                @foreach($categories as $category)
                                    <option value="{!! $category->id !!}" @if($first_child == $category->id) selected @endif>{!! $category->name !!}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 second_child_category">
                        <div class="form-group">
                            <label>Sub Child Category</label>
                            <select class="form-control" name="second_child_category_id" id="second_child_category_id">
                                <option value="">Sub Child Category</option>
                                @foreach($categories as $category)
                                    <option value="{!! $category->id !!}" @if($second_child == $category->id) selected @endif>{!! $category->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </form>
        </div>

    </div>

@endsection
@push('javascript_section')
    <!--begin::Page Resources -->

    <script src="{{asset('assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        /*var product_id = $('#product_id').val();
        let preloaded;
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: '{{url('get_images')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{id:product_id},
                success: function (result) {
                    $('.input-images').imageUploader({
                        preloaded: result.data,
                        imagesInputName: 'photos',
                        preloadedInputName: 'old'
                    });
                }
            });
        });*/

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
                            $('.first_child_category').show();
                        }

                    }
                });

            } else {
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
                            $('.second_child_category').show();
                        }

                    }
                });

            } else {
                $('.second_child_category').hide();
            }
        }
    </script>
@endpush
