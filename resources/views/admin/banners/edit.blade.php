@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Edit Banner</h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form method="post" enctype="multipart/form-data" action="{{route('banners.update',[$banner->id])}}" id="category_edit_form">
                @csrf
                @method('PATCH')
                <input type="hidden" value="{!! $banner->id !!}" id="banner_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{!! $banner->name !!}" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="input-images-edit"></div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary" id="update">
                    Update
                </button>
            </form>
        </div>

    </div>

@endsection
@push('javascript_section')
    <!--begin::Page Resources -->
    <script type="text/javascript">

        $(function () {
            $('.input-images-edit').empty();
            var banner_id = $('#banner_id').val();
            $.ajax({
                type: "GET",
                url: '{{url('banner_images')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{id:banner_id},
                success: function (result) {
                    $('.input-images-edit').imageUploader({
                        preloaded: result.data,
                        imagesInputName: 'images',
                        preloadedInputName: 'old'
                    });
                }
            });
        });
    </script>
@endpush
