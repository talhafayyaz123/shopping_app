<!-- Start of Footer -->
<footer class="footer appear-animate" data-animation-options="{ 'name': 'fadeIn'}">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <div class="widget-body">
                            <p class="widget-about-title">Got Question? Call us 24/7</p>
                            <a href="tel:18005707777" class="widget-about-call">1-800-570-7777</a>
                            <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                & coupons ster now toon.
                            </p>

                            <div class="social-icons social-icons-colored">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                {{--                                <a href="#" class="social-icon social-youtube w-icon-youtube"></a>--}}
                                {{--                                <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title">Company</h3>
                        <ul class="widget-body">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Team Member</a></li>
                            <li><a href="#">Career</a></li>
                            <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                            <li><a href="#">Affilate</a></li>
                            {{--                            <li><a href="#">Order History</a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="widget-body">
                            <li><a href="{{url('track')}}">Track My Order</a></li>
                            <li><a href="{{url('cart')}}">View Cart</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="{!! url('wishlist') !!}">My Wishlist</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="widget-body">
                            <li><a href="#">Payment Methods</a></li>
                            {{--                            <li><a href="#">Money-back guarantee!</a></li>--}}
                            {{--                            <li><a href="#">Product Returns</a></li>--}}
                            {{--                            <li><a href="#">Support Center</a></li>--}}
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Term and Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle">
            <div class="widget widget-category" >
                @foreach(categories_with_products() as $key => $cat)
                <div class="category-box" style="width: 800px">
                    <h6 class="category-name">{{$cat->name}}</h6>
                    @foreach($cat->childCategory as $c => $child)
                        <a href="#">{{$child->name}}</a>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-left">
            <p class="copyright">Copyright © 2021 Wolmart Store. All Rights Reserved.</p>
        </div>
        <div class="footer-right">
            <span class="payment-label mr-lg-8">We're using safe payment for</span>
            <figure class="payment">
                <img src="{{asset('assets/front/images/payment.png')}}" alt="payment" width="159" height="25"/>
            </figure>
        </div>
    </div>
    </div>
</footer>
<!-- End of Footer -->
