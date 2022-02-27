@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
{{--                        {!! dd($variants[0]->product->name) !!}--}}
                        Poduct Variant Listing ({!! $variants[0]->product->name.' => '. $variants[0]->product->sku !!})
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
                <div class="row align-items-center">
                    <div class="col-xl-4 order-1 order-xl-2 ">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_4">
                            <span>
                                <i class="la la-cart-plus"></i>
                                <span>Add New Variant</span>
                            </span>
                        </button>
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
            </div>
            <!--begin: Datatable -->
            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Sku</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($variants as $key => $variant)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{!! $variant->product->name !!}</td>
                        <td>{!! $variant->product->sku !!}</td>
                        <td>{!! $variant->color->name !!}</td>
                        <td>{!! $variant->price !!}</td>
                        <td>{!! $variant->quanitity !!}</td>
                        <td>
                            <a href="{{route('edit_variant',[$variant->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <a href="javascript::void(0)" onclick="deleteVariant(this)" id="{{$variant->id}}" class="btn btn-danger" ><i class="fa fa-trash "></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <!--begin::Modal-->
    <div id="delete_variant_modal" class="modal fade">
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

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sizes.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function editData(e) {
            var id = e.id;
            url = "sizes";
            editUrl = url + '/' + id + '/edit';
            $.ajax({
                type: "GET",
                url: editUrl,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    if(result.status == 200){
                        $('#c_name').val(result.data.name)
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
            var url = 'sizes/'+id
            $.ajax({
                type: "post",
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { name:$('#c_name').val(), _method:"PATCH" },
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

        function deleteVariant(e) {
            $('#delete_inner_btn').attr('data-info', e.id);
            $('#delete_variant_modal').modal('show');
        }

        $('#delete_inner_btn').click(function (e) {
            var id = $(this).data('info');
            $.ajax({
                type: "DELETE",
                url: '/products_variants_delete/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    "id": id,
                    "method": "DELETE",
                },
                success: function (result) {
                    if(result.status == 200){
                        toastr.success(result.message);
                        $('#delete_variant_modal').modal('hide');
                        $('#'+id).parents('tr').remove();
                    }else{
                        toastr.error(result.message);
                        $('#delete_variant_modal').modal('hide');
                    }
                }
            });
        })
    </script>
    <script type="text/javascript">
        var product_id = $('#product_id').val();
        let preloaded;
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: '{{url('get_images')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{id:product_id},
                success: function (result) {
                    $('.input-images').imageUploader({
                        preloaded: result.data,
                        imagesInputName: 'photos',
                        preloadedInputName: 'old'
                    });
                }
            });
        });

        function get_category() {
            var category_id;
            category_id = $('#category_id').val();
            if (category_id != '' && category_id > 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '<?=route("getFirstcategory")?>',
                    dataType: "JSON",
                    data: {category_id: category_id},
                    success: function (data) {
                        if (data.length > 0) {
                            $('#child_category_id').html('<option value="">Sub Category</option>');
                            $('#second_child_category_id').html('<option value="">Sub Child Category</option>');
                            $.each(data, function (k, v) {
                                console.log(v);

                                $('#child_category_id').append('<option   value="' + v['id'] + '">' + v['name'] + '</option>');

                            });
                            $('.first_child_category').show();
                        }

                    }
                });

            } else {
                $('.first_child_category').hide();
                $('.second_child_category').hide();
            }

        }

        function get_child_category() {
            var child_category_id;

            child_category_id = $('#child_category_id').val();


            if (child_category_id != '') {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '<?=route("getSecondChildCategory")?>',
                    dataType: "JSON",
                    data: {child_category_id: child_category_id},
                    success: function (data) {
                        if (data.length > 0) {
                            $('#second_child_category_id').html('<option value="">Sub Child Category</option>');
                            $.each(data, function (k, v) {
                                console.log(v);

                                $('#second_child_category_id').append('<option   value="' + v['id'] + '">' + v['name'] + '</option>');

                            });
                            $('.second_child_category').show();
                        }

                    }
                });

            } else {
                $('.second_child_category').hide();
            }
        }
    </script>
@endpush
