<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#sign-in" class="nav-link active">Sign In</a>
            </li>
            <li class="nav-item">
                <a href="#sign-up" class="nav-link">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="sign-in">
                <span id="validation_errors" class="error invalid-feedback" style="display: none"></span>
                <form id="sign_in_form" method="post" action="{{route('login')}}">
                    @csrf
                <div class="form-group">
                    <label>Username or email address *</label>
                    <input type="text" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group mb-0">
                    <label>Password *</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-checkbox d-flex align-items-center justify-content-between">
                    <input type="checkbox" class="custom-checkbox" id="remember" name="remember" >
                    <label for="remember">Remember me</label>
                    <a href="#">Last your password?</a>
                </div>
                <button type="submit" class="btn btn-primary" id="sign_in_btn">Sign In</button>
                </form>
            </div>
            <div class="tab-pane" id="sign-up">
                <form id="sign_up_form" method="post" action="{{route('register')}}">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="f_name" id="f_name" >
                    </div>
                    <div class="form-group">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" name="l_name" id="l_name" >
                    </div>
                    <div class="form-group">
                        <label>Your Email address:</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone No:</label>
                        <input type="text" class="form-control" name="phone_no" id="phone_no" required>
                    </div>
                    <div class="form-group">
                        <label>Gender:</label>
                        <select class="form-control" name="gender" id="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label>Password *</label>
                        <input type="text" class="form-control" name="password" id="password" required>
                    </div>
                    <p>Your personal data will be used to support your experience
                        throughout this website, to manage access to your account,
                        and for other purposes described in our <a href="#" class="text-primary">privacy policy</a>.</p>
                    {{--                <a href="#" class="d-block mb-5 text-primary">Signup as a vendor?</a>--}}
                    <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                        <input type="checkbox" class="custom-checkbox" id="agree" name="agree" required="">
                        <label for="agree" class="font-size-md">I agree to the <a  href="#" class="text-primary font-size-md">privacy policy</a></label>
                    </div>
                    <button type="submit" class="btn btn-primary" id="sign_up_submit_btn">Sign Up</button>
                </form>
            </div>
        </div>
        <p class="text-center">Sign in with social account</p>
        <div class="social-icons social-icon-border-color d-flex justify-content-center">
            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
            <a href="#" class="social-icon social-google fab fa-google"></a>
        </div>
    </div>
</div>
