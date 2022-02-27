@extends('layouts.master')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                       All Bookings
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Phone</th>
                    <th>Service Name</th>
                    <th>Booking Start Date Time</th>
                    <th>Booking End Date Time</th>
                    <th>Service Image</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
@endsection

@push('javascript_section')
    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('bookings') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'c_name', name: 'c_name'},
                    {data: 'c_email', name: 'c_email'},
                    {data: 'c_phone', name: 'c_phone'},
                    {data: 's_name', name: 's_name'},
                    {data: 's_start_date_time', name: 's_start_date_time'},
                    {data: 's_end_date_time', name: 's_end_date_time'},
                    {data: 's_image', name: 's_image',render:function(data,type,full,meta){
                            return "<img src=\"" + data + "\" height=\"50\"/>";
                        }},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
