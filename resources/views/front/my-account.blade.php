@extends('layouts.front_master')
@section('content')
    <!-- Start of Main -->
    <main class="main">

        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">My Account</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{!! url('home') !!}">Home</a></li>
                    <li>My account</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content pt-2">

            <div class="container">

                <div class="tab tab-vertical row gutter-lg">
                    <ul class="nav nav-tabs mb-6" role="tablist">
                        <li class="nav-item">
                            <a href="#account-dashboard" class="nav-link active">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-orders" class="nav-link">Orders</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="#account-downloads" class="nav-link">Downloads</a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a href="#account-addresses" class="nav-link">Addresses</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-details" class="nav-link">Account details</a>
                        </li>
                        <li class="link-item">
                            <a href="#user_coupons" class="nav-link">Coupons</a>
                        </li>
                        <li class="link-item">
                            <a href="{!! url('wishlist') !!}" style="padding-left: 0px;">Wishlist</a>
                        </li>

                        <li class="link-item">
                            <form method="post" action="{{route('logout')}}">
                                @csrf
                            <a href="#" class="logout_btn" style="padding-left: 0px;">Logout</a>
                            </form>
                        </li>
                    </ul>

                    <div class="tab-content mb-6">
                        <div class="tab-pane active in" id="account-dashboard">
                            <p class="greeting">
                                Hello
                                <span class="text-dark font-weight-bold">{!! auth()->user()->f_name !!}</span>
                            </p>

                            <p class="mb-4">
                                From your account dashboard you can view your <a href="#account-orders"
                                                                                 class="text-primary link-to-tab">recent orders</a>,
                                manage your <a href="#account-addresses" class="text-primary link-to-tab">shipping
                                    and billing
                                    addresses</a>, and
                                <a href="#account-details" class="text-primary link-to-tab">edit your password and
                                    account details.</a>
                            </p>

                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-orders" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-orders">
                                                    <i class="w-icon-orders"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Orders</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-addresses" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-address">
                                                    <i class="w-icon-map-marker"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Addresses</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-details" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-account">
                                                    <i class="w-icon-user"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Account Details</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-wishlist">
                                                    <i class="w-icon-heart"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Wishlist</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-logout">
                                                    <i class="w-icon-logout"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0 logout_btn">Logout</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane mb-4" id="account-orders">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                </div>
                            </div>

                            <table class="shop-table account-orders-table mb-6">
                                <thead>
                                <tr>
                                    <th class="order-id">Order</th>
{{--                                    <th class="order-id">Product Sku / Variant Sku</th>--}}
                                    <th class="order-date">Date</th>
                                    <th class="order-status">Status</th>
                                    <th class="order-total">Total</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $key=>$order)
                                <tr>
                                    <td class="order-id">{{$order->id}}</td>
{{--                                    <td class="order-id">{{$order->order_detail->variant->sku}} </td>--}}
                                    <td class="order-date">{{ $order->order_date_time }}</td>
                                    <td class="order-status">{{ $order->status }}</td>
                                    <td class="order-total">
                                        <span class="order-price">${{ $order->discount_price }}</span>
                                        for<span class="order-quantity"> {{ count($order->order_detail)   }}</span> items                                    </td>
                                    <td class="order-action">
                                        <a href="{{ route('order_detail',[$order->id,$order->status])  }}"
                                           class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                    </td>
                                </tr>
                               @endforeach
                                </tbody>
                            </table>

                            <a href="{{url('home')}}" class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                        <div class="tab-pane mb-4" id="user_coupons">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">User Coupons</h4>
                                </div>
                            </div>

                            <table class="shop-table user-coupons-table mb-6">
                                <thead>
                                <tr>
                                    <th class="order-id">#</th>
                                    <th class="order-id">Coupon</th>
                                    <th class="order-date">Expire Date</th>
                                    <th class="order-date">Type</th>
                                    <th class="order-status">Value</th>
                                    <th class="order-actions">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->coupons as $key =>$co)
                                <tr>
{{--                                    {!! dd($co->couponDetail->coupon_type->name) !!}--}}
                                    <td class="order-id">{{++$key}}</td>
                                    <td class="order-date">{{ $co->couponDetail->code }}</td>
                                    <td class="order-date">{{ date('Y-m-d',strtotime($co->couponDetail->expiry_date))}}</td>
                                    <td class="order-status">{{$co->couponDetail->coupon_type != null ? $co->couponDetail->coupon_type->name : ''}}</td>
                                    <td class="order-status">{{ $co->couponDetail->amount }}</td>
                                    <td class="order-status">{{ $co->couponDetail->is_active == 1 ? 'Active' : 'InActive'  }}</td>
                                </tr>
                               @endforeach
                                </tbody>
                            </table>

                            <a href="{{url('home')}}" class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="tab-pane" id="account-downloads">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-downloads mr-2">
                                        <i class="w-icon-download"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title ls-normal">Downloads</h4>
                                </div>
                            </div>
                            <p class="mb-4">No downloads available yet.</p>
                            <a href="#" class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="tab-pane mb-4" id="account-addresses">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-map-marker">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
                                </div>

                            </div>

                          <div class="user_adress_table">
                            @if( count($adddress) <5)
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{!! url('/add-address') !!}" class="login sign-in btn btn-dark btn-rounded btn-sm mb-4">Add</a>
                                </div>
                            </div>
                            @endif

                            <div class="alert alert-success user_adress_popup" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong></strong>
                        </div>

                         
                                
                       <table class="shop-table account-orders-table mb-6">
                                <thead>
                                <tr>
                                    <th class="order-id">Address</th>
                                    <th class="order-date">Country</th>
                                    <th class="order-status">City</th>
                                    <th class="order-total">Zip</th>
                                    <th class="order-total">Status</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($adddress)>0)
                                   @foreach($adddress as $address)
                                <tr>
                                    <td class="order-id">{{ $address->address }}</td>
                                    <td class="order-date">{{ $address->country }}</td>
                                    <td class="order-status">{{ $address->city }}</td>
                                    <td class="order-status">{{ $address->zip }}</td>
                                    <td class="order-status">{{ $address->status }}</td>
                                    <!-- <td class="order-action">
                                    <a href="#"
                                           class="btn btn-outline btn-default btn-block btn-sm btn-rounded">Edit</a>
                                    </td> -->

                                    <td class="order-action">

                                    <a  onclick="change_address_status({{$address->id}},'{{$address->status}}')"
                                           class="btn btn-outline btn-default btn-block btn-sm btn-rounded">
                                      @if($address->status=='Active')

                                      Inactive
                                       @else
                                        Active
                                       @endif

                                   </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                 <tr>
                                     <td class="order-id">No Address Found.</td>
                                 </tr>

                                @endif
                                </tbody>
                            </table>

                        </div>

                        </div>

                        <div class="tab-pane" id="account-details">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-account mr-2">
                                        <i class="w-icon-user"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                                </div>
                            </div>
                            <form class="form account-details-form" action="{!! route('update_profile') !!}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">First name *</label>
                                            <input type="text" id="f_name" name="f_name" placeholder="John"
                                                   class="form-control form-control-md" value="{!! auth()->user()->getOriginal('f_name'); !!}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last name *</label>
                                            <input type="text" id="l_name" name="l_name" placeholder="Doe"
                                                   class="form-control form-control-md" value="{!! auth()->user()->l_name !!}">
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="form-group mb-3">--}}
{{--                                    <label for="display-name">Display name *</label>--}}
{{--                                    <input type="text" id="display-name" name="display_name" placeholder="John Doe"--}}
{{--                                           class="form-control form-control-md mb-0">--}}
{{--                                    <p>This will be how your name will be displayed in the account section and in reviews</p>--}}
{{--                                </div>--}}

                                <div class="form-group mb-6">
                                    <label for="email_1">Email address *</label>
                                    <input type="email" id="email" name="email"
                                           class="form-control form-control-md" readonly value="{!! auth()->user()->email !!}">
                                </div>

                                <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                                <div class="form-group">
                                    <label class="text-dark" for="cur-password">Current Password leave blank to leave unchanged</label>
                                    <input type="password" class="form-control form-control-md"
                                           id="cur-password" name="old_password">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark" for="new-password">New Password leave blank to leave unchanged</label>
                                    <input type="password" class="form-control form-control-md"
                                           id="new-password" name="password">
                                </div>
                                <div class="form-group mb-10">
                                    <label class="text-dark" for="conf-password">Confirm Password</label>
                                    <input type="password" class="form-control form-control-md"
                                           id="conf-password" name="password_confirmation ">
                                </div>
                                <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->

@endsection
@push('javascript_section')
    <script src="{{asset('assets/front/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script>
        $('.logout_btn').click(function (e) {
            e.preventDefault();
            var form = $(this).closest('form');
            form.submit();
        })
    </script>
@endpush



@push('javascript_section')
    <script>

        function change_address_status(address_id,status){
             $.ajax({
                       url: '{{url('change_address_status')}}/' + address_id + '/' + status,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'get',
                        success: function (response) {
                        
                            if (response.status == 200) {
                
                               $('.user_adress_table').html(response.html);
                               
                               $('.user_adress_popup').css('display','block');
                               
                                $('.user_adress_popup strong').html('Success! Address Status has been changed successfully.');
                               setTimeout(function(){                                 
                                $('.user_adress_popup').css('display','none'); 
                            }, 4000);

                        
                            }
                            if (response.status == 422) {
                                $('#validation_errors').text(response.message)
                                $('#validation_errors').show()
                                $('.user_adress_popup').css('display','none');
                               $('.user_adress_popup strong').html('');
                               
                                return false;
                            }
                        }
                    });
        }
   $(document).on('click', '#new_address_btn', function (e) {
            // $(document).ready(function () {
            $('#new_address_form').validate({
                rules: {
                    address: {
                        required: true
                    },
                    city: {
                        required: true
                    },zip: {
                        required: true
                    },
                    country: {
                        required: true
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    console.log(form);
                    console.log($(form).serialize());
                      
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (response) {
                        
                            if (response.status == 200) {
                              $('.mfp-close').click();
                               $('.user_adress_table').html(response.html);
                               
                               $('.user_adress_popup').css('display','block');
                               
                                $('.user_adress_popup strong').html('Success! Address Has Been Added.');
                               setTimeout(function(){                                 
                                $('.user_adress_popup').css('display','none'); 
                            }, 4000);

                        
                            }
                            if (response.status == 422) {
                                $('#validation_errors').text(response.message)
                                $('#validation_errors').show()
                                $('.user_adress_popup').css('display','none');
                               $('.user_adress_popup strong').html('');
                               
                                return false;
                            }
                        }
                    });
                }
            });
        });
   

    </script>
@endpush