@extends('layouts.master')
@section('content')
    <style>
    </style>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Edit Category</h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form method="post" enctype="multipart/form-data" action="{{route('categories.update',[$category->id])}}" id="category_edit_form">
                @csrf
                @method('PATCH')
                <input type="hidden" value="{!! $category->id !!}" id="category_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{!! $category->name !!}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select name="parent_id" class="form-control" id="parent_id_edit">
                                <option value="">Choose Parent Category</option>
                                @foreach($categories as $key => $cat)
                                    <option value="{!! $cat->id !!}" @if($cat->id == $category->parent_id) selected @endif>{!! $cat->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="short_description" class="form-control" required id="short_description">
                                {!! trim($category->short_description) !!}
                            </textarea>
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
            var category_id = $('#category_id').val();
            $.ajax({
                type: "GET",
                url: '{{url('category_images')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{id:category_id},
                success: function (result) {
                    $('.input-images-edit').imageUploader({
                        preloaded: result.data,
                        imagesInputName: 'images',
                        preloadedInputName: 'old'
                    });
                    $('#edit_category_popup').modal('show');
                }
            });
        });
    </script>
@endpush
