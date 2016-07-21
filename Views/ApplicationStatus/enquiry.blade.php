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
        <h1>Application - <small>Enquiry</small></h1>
       
        @include('Tenant::ApplicationStatus/partial/navbar')
      
          
        <section>
          <div class="box box-primary">
            <div class="box-body">
              <section>
                <table class="table table-striped table-bordered table-condensed" id="application_table">
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
                    @foreach($applications as $application)         
                      <tr>
                        <td>{{ $application->course_application_id }}</td>
                        <td>{{ $application->fullname }}</td>
                        <td>{{ $application->number }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->company }}</td>
                        <td>{{ $application->name }}</td>
                        <td>{{ format_date($application->intake_date) }}</td>
                        <td>{{ $application->company }}</td>
                          <td>
                            <a href="{{ route('applications.apply.offer',[$application->course_application_id])}}" title="Apply Offer"><i class=" btn btn-primary btn-sm glyphicon glyphicon-education" data-toggle="tooltip" data-placement="top" title="Apply Offer"></i></a>
                            <a href="#" title="view"><i class="processing btn btn-primary btn-sm glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="View"></i></a>
                            <a href="#" title="edit"><i class="processing btn btn-primary btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                            <a href="{{ route('applications.cancel.application',[$application->course_application_id])}}" title="cancel/quarantine"><i class="processing btn btn-primary btn-sm glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Cancel/Quarantine"></i></a>
                          </td>
                      </tr>
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
          $('#application_table').DataTable({
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

      

              


              
        
