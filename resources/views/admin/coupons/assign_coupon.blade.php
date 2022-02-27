@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Assign Coupons to Customers
                    </h3>
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
            <div class="row" style="display: block !important;">
                <form method="post" action="{{route('searchCustomer')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Search Customer <small>(Search by registered email)</small></label>
                                <input type="email" name="email" class="form-control" required placeholder="Search Customer Email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label></label>
                                <br>
                                <button type="submit" class="btn btn-primary" style="margin-top: 5px">
                                    Search
                                </button>
                            </div>

                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </form>
            </div>
            <!--begin: Datatable -->
            @if(isset($customer))
                <h4>Customer Detail</h4>
            <table class="table table-bordered data-table" id="customer_detail_table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>No of Assigned Coupons</th>
                </tr>
                </thead>
                <tbody id="customer_detail_table_body">
                    <tr>
                        <td>{{$customer->f_name}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{count($customer->coupons)}}</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <h4>Coupons Details</h4>
            <table class="table table-bordered data-table" id="customer_assigned_coupons">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Coupon Code</th>
                    <th>Discount Amount</th>
                    <th>Minimum Order Amount</th>
                    <th>Minimum Order Quantity</th>
                    <th>Coupon Expiry date</th>
                    <th>Assigned Expiry date</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody id="cusomter_assign_coupn_table_body">
{{--                {!! dd($customer->coupons) !!}--}}
                    @foreach($customer->coupons as $key => $coupon)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$coupon->couponDetail->code}}</td>
                            <td>{{$coupon->couponDetail->amount}}</td>
                            <td>{{$coupon->couponDetail->minimum_amount}}</td>
                            <td>{{$coupon->couponDetail->quantity}}</td>
                            <td>{{showDate($coupon->couponDetail->expired_date)}}</td>
                            <td>{{showDate($coupon->coupon_expiray_date)}}</td>
                            <td>{!! $coupon->is_active == 1 ? '<p style="color:green"><b>Active</b></p>' : "<p style='color:red'><b>Used</b></p>" !!}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                <a href="javascript:void(0)" class="btn btn-primary"
                   title="Assign more" onclick="assignMoreCoupon({{$customer->id}})">
                    <i class="fa fa-plus-square"></i> Assign More Coupons</a>
        @endif
            <!--end: Datatable -->
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="assign_coupon_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Assign Coupon
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
                    </button>
                </div>
                <div class="modal-body" id="assign_coupon_modal_body">
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection

@push('javascript_section')
    <script type="text/javascript">
        function assignMoreCoupon(customer_id) {
            $.ajax({
                type: "GET",
                url: '{{route('getRemainingCouponsToAssign')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    "customer_id": customer_id,
                },
                success: function (result) {
                    if(result.status == 200){
                        $('#assign_coupon_modal').modal('show');
                        $('#assign_coupon_modal_body').empty();
                        $('#assign_coupon_modal_body').append(result.data);
                    }else{
                        toastr.error(result.message);
                        $('#assign_coupon_modal').modal('hide');
                    }
                }
            });
        }
        $(document).on('click','#assign_coupons_btn',function () {
            if($('#assign_coupon_form').find(':checkbox:checked').length < 1){
                toastr.error('Please select at least one coupon');
                return false;
            }
            var form_data = $('#assign_coupon_form').serialize();
            var url = $('#assign_coupon_form').attr('action');
            $.ajax({
                type: 'post',
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: form_data,
                success: function (result) {
                    if(result.status){
                        $('#assign_coupon_modal').modal('hide');
                        toastr.success(result.message);
                    }else{
                        toastr.error(result.message);
                        $('#assign_coupon_modal').modal('hide');
                    }
                }
            });
        })
    </script>
@endpush
