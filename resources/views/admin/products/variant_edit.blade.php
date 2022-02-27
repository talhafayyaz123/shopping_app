@extends('layouts.master')
@section('content')
    <style>
        .discount_fields {
            display: none;
        }
    </style>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Edit Product Variant</h3>
                    <h3 class="pull-right">Product Sku: {!! $variant->product->sku !!}</h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <strong>Whoops!</strong>Something went wrong.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form method="post" action="{{route('update_variant',[$variant->id])}}" enctype="multipart/form-data">
                <input type="hidden" value="{!! $variant->id !!}" id="variant_id" name="variant_id">
                <input type="hidden" value="{!! $variant->product->id !!}" id="product_id" name="product_id">
                @csrf
                <div class="row" >
                    <div class="col-md-4">
                        <div class="form-group"><label>Color</label>
                            <select class="form-control" name="color_id" id="color_id">
                                <option value="">Choose Color</option>
                                @foreach($colors as $color)
                                    <option value="{!! $color->id !!}"
                                            @if($variant->color_id == $color->id) selected @endif>
                                        {!! $color->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group"><label>Size</label>
                                <select class="form-control" name="size_id[]" id="size_id" multiple="">
                                    <option value="">Choose Size</option>
                                    @foreach($sizes as $size)
                                        <option value="{!! $size->id !!}"
                                                @if(in_array($size->id, $variant_sizes)) selected @endif>{!! $size->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Selling Price</label>
                            <input type="number" class="form-control" name="selling_price" id="selling_price"
                                   value="{{$variant->price}}" placeholder="Selling Price"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="quantity"
                                   placeholder="Enter Quantity" value="{!! $variant->quantity !!}"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Alert Quantity</label>
                            <input type="number" name="alert_quantity" class="form-control"
                                   id="alert_quantity" placeholder="Enter Alert Quantity"
                                   value="{!! $variant->alert_quantity !!}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Purchase Date</label>
                            <input type="date" name="purchase_date"
                                   class="form-control purchase_date"
                                   placeholder="Select date" value="{!! $variant->purchase_date !!}"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group"><label>Purchase Price</label>
                            <input type="number" class="form-control" name="purchase_price"
                                   id="purchase_price"
                                   placeholder="Purchase Price" value="{!! $variant->purchase_price !!}"></div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Height</label>
                            <input type="number" class="form-control"
                                   id="height" name="height"
                                   placeholder="Product height in inches" value="{{$variant->height}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Length</label>
                            <input type="number" class="form-control" id="length" name="length"
                                   value="{{$variant->length}}" placeholder="Product Length in inches">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="number" class="form-control" id="weight" name="weight_1"
                                   placeholder="Product Weight in inches" value="{!! $variant->weight !!}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="m-checkbox">
                                <input type="checkbox" name="is_active"
                                       id="is_active" checked="" @if($variant->is_active ==1 ) checked @endif> Active
                                <span></span></label></div>
                    </div>
                    <div class="col-md-1">
                        <label class="m-checkbox">
                            <input type="checkbox" name="is_new_arrival"
                                   id="is_new_arrival" @if($variant->is_new_arrival == 1 ) checked @endif>New Arrival
                            <span></span></label>
                    </div>
                    <div class="col-md-1">
                        <label class="m-checkbox">
                            <input type="checkbox" name="is_featured"
                                   id="is_featured" @if($variant->is_featured == 1 ) checked @endif>Featured
                            <span></span></label>
                    </div>
                    <div class="col-md-2">
                        <label class="m-checkbox">
                            <input type="checkbox" name="is_discounted"
                                   onclick="show_disount_price()"
                                   class="is_discounted" id="is_discounted"
                                   @if($variant->is_discounted ==1 ) checked @endif>Discount
                            <span></span></label></div>
                    @if($variant->is_discounted ==1 )
                        <div class="col-md-3" id="discount_price_div">
                            <input type="number" name="discount_price"
                                   class="form-control discount_price"
                                   id="discount_price"
                                   placeholder="Enter Discount Price" value="{!! $variant->discount_price !!}">
                        </div>
                        <div class="col-md-3" id="discount_date_div">
                            <input type="date" name="discount_valid_till"
                                   class="form-control discount_valid_till"
                                   id="discount_valid_till"
                                   placeholder="YYYY-mm-dd" value="{!! $variant->discount_valid_till !!}">
                        </div>
                    @else
                        <div class="col-md-3 discount_fields" id="discount_price_div">
                            <input type="number" name="discount_price"
                                   class="form-control discount_price"
                                   id="discount_price"
                                   placeholder="Enter Discount Price">
                        </div>
                            <div class="col-md-3 discount_fields" id="discount_date_div">
                            <input type="date" name="discount_valid_till"
                                   class="form-control discount_valid_till"
                                   id="discount_valid_till"
                                   placeholder="YYYY-mm-dd">
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="input-images"></div>
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

    <script src="{{asset('assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js')}}"
            type="text/javascript"></script>
    <script type="text/javascript">
        var product_id = $('#variant_id').val();
        let preloaded;
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: '{{url('get_images')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {id: product_id},
                success: function (result) {
                    $('.input-images').imageUploader({
                        preloaded: result.data,
                        imagesInputName: 'photos',
                        preloadedInputName: 'old'
                    });
                }
            });
        });

        function show_disount_price() {
            if ($('.is_discounted').is(':checked')) {
                $('.discount_fields').show();
            } else {
                $('.discount_fields').hide();
            }
        }
    </script>
@endpush
