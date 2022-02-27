@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        General Settings
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
            <!--begin: Datatable -->
            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Site Title</th>
                    <th>Date format</th>
                    <th>Product Alert Quantity</th>
                    <th>Currency</th>
                    <th>Sign Up Discount</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>1</td>
                        <td>{!! $settings->site_title !!}</td>
                        <td>{!! $settings->date_format !!}</td>
                        <td>{!! $settings->products_alert_quantity !!}</td>
                        <td>{!! $settings->currency !!}</td>
                        <td>{!! $settings->sign_up_discount !!}</td>
                        <td>
                            <a href="javascript:void(0)" class="edit btn btn-primary btn-sm edit_button" id="{!! $settings->id !!}" onclick="editSettingsData(this)"><i class="flaticon-edit-1"></i></a>
                        </td>
                    </tr>

                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="edit_color_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Edit Settings
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Site Title</label>
                                    <input type="text" name="site_title" class="form-control" id="site_title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date Format</label>
                                    <input type="text" name="date_format" class="form-control" id="date_format" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Currency</label>
                                    <input type="text" name="currency" class="form-control" id="currency" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Prodcut Alert qunatity</label>
                                    <input type="text" name="products_alert_quantity" class="form-control" id="products_alert_quantity" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sign Up Discount <small>(Its for all users on their first order)</small></label>
                                    <input type="text" value="" id="sign_up_discount" name="sign_up_discount" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="update">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
    <!--begin::Modal-->
    <div id="myModal" class="modal fade">
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
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete_inner_btn">Delete</button>
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
            url = "general-settings";
            editUrl = url + '/' + id + '/edit';
            $.ajax({
                type: "GET",
                url: editUrl,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    if(result.status == 200){
                        $('#site_title').val(result.data.site_title)
                        $('#currency').val(result.data.currency)
                        $('#date_format').val(result.data.date_format)
                        $('#products_alert_quantity').val(result.data.products_alert_quantity)
                        $('#sign_up_discount').val(result.data.sign_up_discount)
                        $('#update').attr('data-info', e.id);
                        $('#edit_color_popup').modal('show');
                    }else{
                        toastr.error(result.message);
                        $('#edit_color_popup').modal('hide');
                    }
                }
            });
        }
        $('#update').click(function (e) {
            var id = $(this).data('info');
            var url = 'general-settings/'+id
            $.ajax({
                type: "post",
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    site_title: $('#site_title').val(),
                    currency:$('#currency').val(),
                    date_format: $('#date_format').val(),
                    products_alert_quantity:$('#products_alert_quantity').val(),
                    sign_up_discount:$('#sign_up_discount').val(),
                    _method:"PATCH"
                },
                success: function (result) {
                    if(result.status == 200){
                        toastr.success(result.message);
                        $('#edit_color_popup').modal('hide');
                        $('#'+id).parents('tr').find('td').eq(1).text(result.data.name)
                    }else{
                        toastr.error(result.message);
                        $('#edit_color_popup').modal('hide');
                    }
                }
            });
        });
    </script>
@endpush
