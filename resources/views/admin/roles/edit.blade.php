@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Create Roles
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form method="post" action="{{route('roles.update',[$role->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{!! $role->name !!}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Guard</label>
                            <input type="text" name="price_min" class="form-control" value="web" readonly required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <th><input type="checkbox" name="select_all_permissions" id="checkAll" class="permission_checkbox"></th>
                        <th>Module Name</th>
                        <th>Permission Name</th>
                        </thead>
                        <tbody>
                        @foreach($permissions as $key => $permisson)
                            @php
                                $roles_permissions = $role->permissions->pluck('id')->toArray();
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" name="permission_id[]" value="{!! $permisson->id !!}"
                                           class="permission_checkbox" id="select_permission-{!! $permisson->id !!}"
                                    @if(in_array($permisson->id,$roles_permissions)) checked @endif>
                                </td>
                                <td>{{--{!! $permisson->module->name !!}--}}</td>
                                <td>{!! $permisson->name !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">
                   Update
                </button>
            </form>
        </div>

    </div>

@endsection
@push('javascript_section')
    <script type="text/javascript">
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
