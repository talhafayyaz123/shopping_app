@extends('layouts.front_master')
@section('content')
    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Pgae Contetn -->
        <br><br>
        <div class="page-content mb-10 pb-2">
            <div class="container">
                <form class="vendor-search-form" method="get" action="{{route('trackOrder')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Enter Sku <small>(Get from your order list)</small></label>
                                <input type="text" class="form-control mr-4 bg-white" name="vendor_sku" id="vendor_sku" placeholder="Search Product by Sku" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Enter Registered Email</label>
                                <input type="email" class="form-control mr-4 bg-white" name="email" id="email" placeholder="email" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <br>
                                <label></label>
                                <button class="btn btn-primary btn-rounded" type="submit">Apply</button>
                            </div>
                        </div>
                    </div>


                </form>
                    <!-- End of Vendor Search Form -->
                <!-- End of Vendor Search Wrapper -->
            @if(isset($order_detail))
                @foreach($order_detail as $key => $delivery)
{{--                {!! dd($delivery->variant) !!}--}}
                <div class="store store-list mt-4">
                    <div class="store-header">
                        <a href="#">
                            <figure class="store-banner">
                                <img src="{{asset('assets/uploads/products/'.$delivery->variant->image->first()->image)}}" alt="Vendor" width="400" height="188" style="background-color: #5D5D5D">
                            </figure>
                        </a>
                    </div>
                    <!-- End of Store Header -->
                    <div class="store-content">
{{--                        <figure class="seller-brand">--}}
{{--                            <img src="assets/images/vendor/brand/2.jpg" alt="Brand" width="80" height="80">--}}
{{--                        </figure>--}}
                        <div class="seller-date">
                            <h4 class="store-title">
                                <a href="#">{{$delivery->product->name}} ({{$delivery->variant->sku}})</a>
                            </h4>
                            <div class="store-address">
                                Order Date, {{date('Y-M-D',strtotime($delivery->order->created_at))}}
                            </div>
                            <a href="#" class="btn btn-dark btn-link btn-underline btn-icon-right btn-visit">
                                Status<i class="w-icon-long-arrow-right" style="text-decoration: none !important;"></i>{{$delivery->order->status}}</a>
                        </div>
                    </div>
                    <!-- End of Store Content -->
                </div>
            @endforeach
            @endif
                <!-- End of Store List -->
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->
@endsection
@push('javascript_section')
@endpush
