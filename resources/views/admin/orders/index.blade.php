@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        All Orders
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
            <table class="table table-bordered data-table orders-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Variant</th>
                    <th>Order Price</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="edit_order_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Change Order Status
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="status-drop">
                                        <option value="pending">Pending</option>
                                        <option value="Dispatched">Dispatched</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
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
        $(function () {
            var table = $('.orders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orders') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'customer', name: 'customer'},
                    {data: 'product', name: 'product'},
                    {data: 'variant', name: 'variant'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function editOrder(e) {
            var id = e.id;
            url = "changeOrderStatus";
            editUrl = url + '/' + id;
            $.ajax({
                type: "GET",
                url: editUrl,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    if(result.status == 200){
                        console.log($('#status-drop').length);
                        $('#status-drop').val(result.data.status).attr('selected', true).change();;
                        $('#update').attr('data-info', e.id);
                        $('#edit_order_popup').modal('show');
                    }else{
                        toastr.error(result.message);
                        $('#edit_order_popup').modal('hide');
                    }
                }
            });
        }
        $('#update').click(function (e) {
            var id = $(this).data('info');
            var url = '{{route('updateStatus')}}'
            $.ajax({
                type: "get",
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { status:$('#status-drop').val(),'id':id },
                success: function (result) {
                    if(result.status == 200){
                        toastr.success(result.message);
                        $('#edit_order_popup').modal('hide');
                        $('#'+id).parents('tr').find('td').eq(5).text(result.data.status)
                    }else{
                        toastr.error(result.message);
                        $('#edit_color_popup').modal('hide');
                    }
                }
            });
        });
        function deleteColor(e) {
            $('#delete_inner_btn').attr('data-info', e.id);
            $('#myModal').modal('show');
        }
        $('#delete_inner_btn').click(function (e) {
            var id = $(this).data('info');
            $.ajax({
                type: "DELETE",
                url: 'colors/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    "id": id,
                    "method": "DELETE",
                },
                success: function (result) {
                    if(result.status == 200){
                        toastr.success(result.message);
                        $('#myModal').modal('hide');
                        $('#'+id).parents('tr').remove();
                    }else{
                        toastr.error(result.message);
                        $('#myModal').modal('hide');
                    }
                }
            });
        })
    </script>
@endpush
