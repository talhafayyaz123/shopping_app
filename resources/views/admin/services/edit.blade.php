@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Services
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <p><strong>Opps Something went wrong</strong></p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <form method="post" action="{{route('services.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">
                        Choose Category:
                    </label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Choose</option>
                        @foreach($categories as $key => $category)
                            <option value="{{$category->id}}" @if($category->id == $service->category_id) selected @endif>{!! $category->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">
                        Description:
                    </label>
                    <textarea name="short_description" class="form-control" rows="5" cols="5">{!! $service->short_description !!}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required value="{!! $service->name !!}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Min Price</label>
                            <input type="text" name="price_min" class="form-control" required value="{!! $service->price_min !!}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Max Price</label>
                            <input type="text" name="price_max" class="form-control" required value="{!! $service->price_max !!}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label> Old Image</label>
                        <img src="{!! $service->image->image !!}" alt="previous_image" width="200px" height="200px">
                    </div>

                    <label for="message-text" class="form-control-label">
                        Choose Picture:
                    </label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection

