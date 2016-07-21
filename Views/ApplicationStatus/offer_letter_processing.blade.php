@extends('layouts.tenant')
@section('title', 'Application Enquiry')
@section('breadcrumb')
    @parent
    <li><a href="{{url('tenant/clients')}}" title="All Clients"><i class="fa fa-users"></i> Clients</a></li>
    <li>Notes</li>
@stop

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @if(Session::has('success'))
          <div class="alert alert-success">
            <strong>Success: </strong>{{ Session::get('success')}}
          </div>
        @endif
        <h1>Application - <small>Offer Letter Processing</small></h1>
       
        @include('Tenant::application/partial/navbar')
      
        @include('Tenant::application/partial/filter_search')
        
        <section>
          <div class="box box-primary">
            <div class="box-body">
              <section>
                <table class="table table-striped table-bordered table-condensed" id="offer_table">
                  <thead>
                    <tr class="text-nowrap">
                      <th>Id</th>
                      <th>Client Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>College Name</th>
                      <th>Course Name</th>
                      <th>Start date</th>
                      <th>Invoice To</th>
                      <th>Processing</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($applications as $application )
                      @if(($application->status_id) === 2)
                        <tr>
                          <td>{{ $application->course_application_id}}</td>
                          <td>{{ $application->fullname }}</td>
                          <td>{{ $application->number }}</td>
                          <td>{{ $application->email }}</td>
                          <td>{{ $application->company }}</td>
                          <td>{{ $application->name }}</td>
                          <td>{{ format_date($application->intake_date) }}</td>
                          <td>{{ $application->company }}</td>
                          <td>
                               <a href="{{ route('application.offer.received', [$application->course_application_id]) }}" title="Offer Received"><i class=" btn btn-primary btn-sm glyphicon glyphicon-education" data-toggle="tooltip" data-placement="top" title="Offer Received"></i></a>
                            <a href="#" title="view"><i class="processing btn btn-primary btn-sm glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="View"></i></a>
                            <a href="#" title="edit"><i class="processing btn btn-primary btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </section>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
<script type="text/javascript">
        $(document).ready(function () {
          $('#offer_table').DataTable({
            "columns": [
                {data: 'course_application_id', name: 'course_application_id'},
                {data: 'fullname', name: 'fullname'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'company', name: 'company'},
                {data: 'name', name: 'name'},
                {data: 'start_date', name: 'start_date'},
                {data: 'company', name: 'company'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            order: [ [0, 'desc'] ]
          });
        });
</script>
@stop