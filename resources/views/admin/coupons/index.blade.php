@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                       Coupons
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
            <div class="row align-items-center">
                <div class="col-xl-4 order-1 order-xl-2 ">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#coupon_modal">
                            <span>
                                <i class="la la-cart-plus"></i>
                                <span>Add New</span>
                            </span>
                    </button>
                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                </div>
            </div>
            <!--begin: Datatable -->
            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>code</th>
                    <th>type</th>
                    <th>amount</th>
                    <th>quantity</th>
                    <th>expired date</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coupons as $key => $coupon)
                    <tr>
                        <td>{!! ++$key !!}</td>
                        <td>{!! $coupon->code !!}</td>
                        <td>{!! $coupon->type !!}</td>
                        <td>{!! $coupon->amount !!}</td>
                        <td>{!! $coupon->quantity !!}</td>
                        <td>{!! $coupon->expired_date !!}</td>
                        <td>
                            <a href="javascript:void(0)" class="edit btn btn-primary btn-sm edit_button" id="{!! $coupon->id !!}" onclick="editSettingsData(this)"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" class="edit btn btn-danger btn-sm delete_btn" id="{!! $coupon->id !!}" onclick="deleteCoupon(this)"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <!--begin::Modal-->
    <!--begin::Modal-->
    <div class="modal fade" id="coupon_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        New Coupon
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('coupons.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select type="text" name="type" class="form-control" required>
                                        <option value="">Choose Type</option>
                                        @foreach($types as $type)
                                            <option value="{!! $type->id !!}">{!! $type->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount %</label>
                                    <input type="text" name="amount" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Minimum Amount of order
                                        <br> <small>(Optional if coupon is on quantity)</small></label>
                                    <input type="text" name="minimum_amount" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity of order</label>
                                    <br><small>(Optional if Amount Entered)</small>
                                    <input type="text" name="quantity" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expired</label>
                                    <input type="date" name="expired_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->


    <div class="modal fade" id="coupon_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Edit Coupon
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
                    </button>
                </div>
                <div class="modal-body" id="edit_coupon_modal_body">
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
    <!--begin::Modal-->
    <div id="coupon_delete_modal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to In Active this Coupon?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete_inner_btn">In Active</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection

@push('javascript_section')
    <script type="text/javascript">
        function editSettingsData(e) {
            var id = e.id;
            url = "coupons";
            editUrl = url + '/' + id + '/edit';
            $.ajax({
                type: "GET",
                url: editUrl,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    if(result.status){
                        $('#coupon_edit_modal').modal('show');
                        $('#edit_coupon_modal_body').empty();
                        $('#edit_coupon_modal_body').append(result.data);
                    }else{
                        toastr.error(result.message);
                        $('#coupon_edit_modal').modal('hide');
                    }
                }
            });
        }


        function deleteCoupon(e) {
            $('#delete_inner_btn').attr('data-info', e.id);
            $('#coupon_delete_modal').modal('show');
        }

        $('#delete_inner_btn').click(function (e) {
            var id = $(this).data('info');
            $.ajax({
                type: "DELETE",
                url: 'coupons/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    "id": id,
                    "method": "DELETE",
                },
                success: function (result) {
                    if(result.status == 200){
                        toastr.success(result.message);
                        $('#coupon_delete_modal').modal('hide');
                        $('#'+id).parents('tr').remove();
                    }else{
                        toastr.error(result.message);
                        $('#coupon_delete_modal').modal('hide');
                    }
                }
            });
        })
    </script>
@endpush
