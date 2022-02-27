@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        All Permissions
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
                    <div class="alert alert-danger">
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_4" >
                            <span>
                                <i class="la la-cart-plus"></i>
                                <span>Add New</span>
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
                    <th>Name</th>
{{--                    <th>Module</th>--}}
{{--                    <th width="100px">Action</th>--}}
                </tr>
                </thead>
                <tbody>
                @if(count($permissions))
                @foreach($permissions as $key => $permission)
                    <tr>
                        <td>{!! ++$key !!}</td>
                        <td>{!! $permission->name !!}</td>
{{--                        <td>{!! $permission->module->name !!}</td>--}}
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td>No record found</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        New Permissions
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('permissions.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Choose Module</label>--}}
{{--                                    <select name="module_id" class="form-control" id="module_id">--}}
{{--                                      @foreach($modules as $key => $module)--}}
{{--                                          <option value="{!! $module->id !!}">{!! $module->name !!}</option>--}}
{{--                                      @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
@endsection

@push('javascript_section')
@endpush
