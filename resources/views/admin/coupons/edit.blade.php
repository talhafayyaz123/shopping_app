<form method="post" action="{{route('coupons.update',[$coupon->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Code</label>
                <input type="text" name="code" class="form-control" value="{!! $coupon->code !!}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Type</label>
                <select type="text" name="type" class="form-control" required>
                    <option value="">Choose Type</option>
                    @foreach($types as $type)
                        <option value="{!! $type->id !!}" @if($coupon->type == $type->id) selected @endif >{!! $type->name !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Amount OR %</label>
                <input type="text" name="amount" class="form-control" required value="{!! $coupon->amount !!}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Minimum Amount of order
                    <br> <small>(Optional if coupon is on quantity)</small></label>
                <input type="text" name="minimum_amount" class="form-control" value="{!! $coupon->minimum_amount !!}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Quantity of order</label>
                <br><small>(Optional if Amount Entered)</small>
                <input type="text" name="quantity" class="form-control" value="{!! $coupon->quantity !!}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Expired</label>
                <input type="date" name="expired_date" class="form-control" required value="{!! $coupon->expired_date !!}">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        Update
    </button>
</form>
