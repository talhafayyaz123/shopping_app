<!-- Start of Header -->
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">Welcome to Wolmart Store message or remove it!</p>
            </div>
            <div class="header-right">
                <!-- End of DropDown Menu -->

                <!-- End of Dropdown Menu -->
                <a href="{{url('contact-us')}}" class="d-lg-show">Contact Us</a>
                @if(Auth::check())
                    <a href="{!! url('profile') !!}" class="d-lg-show">My Account</a>
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="d-lg-show">Logout</button>
                </form>
                @endif
            @guest
                <a href="{{url('login-popup')}}" class="d-lg-show login sign-in"><i
                        class="w-icon-account"></i>Sign In</a>
                <span class="delimiter d-lg-show">/</span>
                <a href="{{url('login-popup')}}" class="ml-0 d-lg-show login register">Register</a>
                @endguest
            </div>
        </div>
    </div>
    <!-- End of Header Top -->
    @section('middle_header')
        @include('front.includes.middle_header')
    @show
    @section('left_sidebar')
        @include('front.includes.left_sidebar')
    @show
</header>
<!-- End of Header -->
