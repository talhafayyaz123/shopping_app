<form method="post" action="{{route('users.update',[$user->id])}}" enctype="multipart/form-data" id="update_user_form">
    @csrf
    @method('patch')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Frist Name</label>
                <input type="text" name="f_name" class="form-control" value="{!! $user->f_name !!}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="l_name" class="form-control"  value="{!! $user->f_name !!}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Contact No</label>
                <input type="text" name="phone_no"  value="{!! $user->phone_no !!}" class="form-control"  required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Email</label>
                <input type="email"  name="email" class="form-control"  value="{!! $user->email !!}" required readonly>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control" id="gender">
                    <option value="male" @if($user->gender == 'male') selected @endif>Male</option>
                    <option value="female" @if($user->gender == 'female') selected @endif>female</option>
                    <option value="other" @if($user->gender == 'other') selected @endif>Other</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Roles</label>
                <select name="role_id" class="form-control" id="gender" required>
                    <option value="">Choose Role</option>
                    @foreach($roles as $key => $role)
                        <option value="{!! $role->id !!}" @if(count($user->roles) > 0 && $user->roles[0]->id == $role->id) selected @endif>{!! $role->name !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Coupons</label>
                <select name="role_id" class="form-control" id="gender" required>
                    <option value="">Choose Coupon</option>
                    @foreach($coupons as $key => $coupon)
                        <option value="{!! $coupon->id !!}" @if($coupon->id == $user_coupon->coupon_id) selected @endif>{!! $coupon->code !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" id="update_user_btn">
        Update User
    </button>
</form>
