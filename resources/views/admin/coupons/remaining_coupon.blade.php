<form method="post" action="{{route('assignCouponToCustomer')}}" id="assign_coupon_form">
    @csrf
    <input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id}}">
    <table id="remaining_coupons_table" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Coupon Code</th>
            <th>Minimum Amount</th>
            <th>Coupon Amount %</th>
            <th>Minimum Order Quantity</th>
            <th>Expiray</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($remaining_coupons as $key => $coupon)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$coupon->code}}</td>
                <td>{{$coupon->minimum_amount}}</td>
                <td>{{$coupon->amount}}</td>
                <td>{{$coupon->quantity}}</td>
                <td>{{showDate($coupon->expired_date)}}</td>
                <td>
                    <input type="checkbox" class="checkbox coupon-{{$coupon->id}}" value="{{$coupon->id}}" name="coupon_id[{{$coupon->id}}]">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="form-group">
            <button type="button" class="btn btn-primary" id="assign_coupons_btn">Assign Coupons</button>
        </div>
    </div>
</form>

