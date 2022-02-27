@extends('layouts.master')
@section('content')
    <style>
    </style>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Create Product
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name ssss</label>
                            <input type="text" name="name" class="form-control" placeholder="Product Name" required>
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
                            <textarea class="form-control" name="description" required id="description" placeholder="Description" rows="5" cols="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" id="category_id" required>
                                <option value="">Choose Category</option>
                                @foreach($categories as $key => $categroy)
                                    <option value="{!! $categroy->id !!}">{!! $categroy->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type='number' name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Alert Quantity</label>
                            <input type='number' name="alert_quantity" class="form-control" id="alert_quantity" placeholder="Enter Alert Quantity"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Color</label>
                            <select class="form-control" name="color_id" id="color_id" required>
                                <option value="">Choose Color</option>
                            @foreach($colors as $key => $color)
                                <option value="{!! $color->id !!}">{!! $color->name !!}</option>
                            @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Size</label>
                                <select class="form-control" name="size_id" id="size_id" required>
                                    <option value="">Choose Size</option>
                                    @foreach($sizes as $key =>$size)
                                        <option value="{!!$size->id !!}">{!!$size->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Vendor</label>
                                <select class="form-control" name="vendor_id" id="vendor_id" >
                                    <option value="">Choose Vendor</option>
                                    @foreach($vendors as $key =>$vendor)
                                        <option value="{!!$vendor->id !!}">{!!$vendor->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Purchase Date</label>
                            <input type='text' name="purchase_date" class="form-control purchase_date" id="m_datepicker_1" readonly placeholder="Select date"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Purchase Price</label>
                            <input type='number' class="form-control" name="purchase_price" id="purchase_price" placeholder="Purchase Price"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Selling Price</label>
                            <input type='number' class="form-control" name="selling_price" id="selling_price" placeholder="Selling Price"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Length</label>
                            <input type='number' class="form-control" id="length" name="length" placeholder="Product Length in inches"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Width</label>
                            <input type='number' class="form-control" id="width" name="width" placeholder="Product Width in inches"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Height</label>
                            <input type='number' class="form-control" id="height" name="height" placeholder="Product height in inches"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Weight</label>
                            <input type='number' class="form-control" id="weight" name="height" placeholder="Product Weight in inches"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="m-checkbox">
                                <input type="checkbox" name="is_active" id="is_active" checked>
                                Active
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="m-checkbox">
                            <input type="checkbox" name="is_new_arrival" id="is_new_arrival">
                            New Arrival
                            <span></span>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <label class="m-checkbox">
                            <input type="checkbox" name="is_discounted" id="is_discounted">
                            Discount
                            <span></span>
                        </label>
                    </div>
                    <div class="col-md-3" id="discount_price_div">
                        <input type='number' name="discount_price" class="form-control" id="discount_price" readonly placeholder="Enter Discount Price"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="input-images"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Create Product
                </button>
            </form>
        </div>

    </div>

@endsection
@push('javascript_section')
    <!--begin::Page Resources -->
    <script src="{{asset('assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $('.input-images').imageUploader();
    </script>
@endpush
