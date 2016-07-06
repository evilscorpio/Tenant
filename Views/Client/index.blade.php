@extends('layouts.tenant')
@section('title', 'All Clients')
@section('breadcrumb')
    @parent
    <li><a href="{{url('client')}}" title="All Clients"><i class="fa fa-dashboard"></i> Clients</a></li>
@stop
@section('content')
    <div class="col-xs-12">
        @include('flash::message')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Clients</h3>
                <a href="{{route('tenant.client.create')}}" class="btn btn-primary btn-flat pull-right">Add New Client</a>
            </div>
            <div class="box-body">
                <table id="clients" class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Client Name</th>
                        <th>Phone No</th>
                        <th>Email</th>
                        <th>Added By</th>
                        <th>Actions</th>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            oTable = $('#clients').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": appUrl + "/tenant/client/data",
                "columns": [
                    {data: 'client_id', name: 'client_id'},
                    {data: 'fullname', name: 'fullname'},
                    {data: 'number', name: 'number'},
                    {data: 'email', name: 'email'},
                    {data: 'added_by', name: 'added_by'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                order: [ [0, 'desc'] ]
            });
        });
    </script>
@stop
