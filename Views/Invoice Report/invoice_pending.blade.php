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

        
        @include('Tenant::Invoice Report/partial/messages')
        
        <h1>Invoice Report - <small>Invoice List</small></h1>

        @include('Tenant::Invoice Report/partial/navbar')
        
        <section>
          <div class="box box-primary">
            <div class="box-body">
              <section>
                <table class="table table-striped table-bordered table-condensed" id="invoice_report_table">
                  <thead>
                    <tr class="text-nowrap">
                      <th>Invoice Id</th>
                      <th>Date</th>
                      <th>Client Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Invoice Amount</th>
                      <th>Total gst</th>
                     
                      <th>Outstanding Amount</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    @foreach($invoice_reports as $invoice_report) 
                    <?php
                      $outstanding_amount=$invoice_report->invoice_amount +$invoice_report->total_gst- $invoice_report->total_paid;
                      ?>
                      @if(($outstanding_amount) > 0)
                       
                             
                          <tr>
                            <td>{{ $invoice_report->invoice_id }}</td>
                            <td>{{ $invoice_report->invoice_date }}</td>
                            <td>{{ $invoice_report->fullname }}</td>
                            <td>{{ $invoice_report->number }}</td>
                            <td>{{ $invoice_report->email }}</td>
                            <td>{{ $invoice_report->invoice_amount }}</td>
                            <td>{{ $invoice_report->total_gst }}</td>
                            <td>{{ $outstanding_amount }}</td>
                          </tr>
                       @endif
                        <tr>
                          <td>
                            <a href="#" title="Add Payment"><i class=" btn btn-primary btn-sm glyphicon glyphicon-shopping-cart" data-toggle="tooltip" data-placement="top" title="Add Payment"></i></a>
                            <a href="#" title="Print Invoice"><i class="processing btn btn-primary btn-sm glyphicon glyphicon-print" data-toggle="tooltip" data-placement="top" title="Print Invoice"></i></a>
                            <a href="#" title="View Invoice"><i class="processing btn btn-primary btn-sm glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="View Invoice"></i></a>
                            <a href="#" title="Email Invoice"><i class="processing btn btn-primary btn-sm glyphicon glyphicon-send" data-toggle="tooltip" data-placement="top" title="Email Invoice"></i></a>
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
          $('#invoice_report_table').DataTable({
            "columns": 
            [
                {data: 'invoice_id', name: 'invoice_id'},
                {data: 'invoice_date', name: 'invoice_date'},
                {data: 'fullname', name: 'fullname'},
                {data: 'number', name: 'number'},
                {data: 'email', name: 'email'},
                {data: 'invoice_amount', name: 'invoice_amount'},
                {data: 'total_gst', name: 'total_gst'},
                {data: 'outstanding_amount', name: 'outstanding_amount'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            order: [ [0, 'desc'] ]
          });
        });
</script>
@stop
                      
                            
                

      

              


              
        
