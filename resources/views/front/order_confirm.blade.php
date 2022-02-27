@extends('layouts.front_master')
@section('content')
<!-- Start of Main -->
<main class="main">
  
    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <!-- Start of Shop Banner -->
            <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs" style="background-image: url(assets/images/shop/banner1.jpg); background-color: #FFC74E;">
                <div class="banner-content">
                    <h4 class="banner-subtitle font-weight-bold text-white">Thank You.Your Order Has Been Placed Successfully.</h4>
                      <br><br>
                      <br>
                 <a href="{!! url('home') !!}"
                                       class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                            class="w-icon-long-arrow-left"></i>Continue Shopping</a>

                </div>
            </div>
            <!-- End of Shop Banner -->


        </div>
    </div>
    <!-- End of Page Content -->
</main>
<!-- End of Main -->
@endsection
