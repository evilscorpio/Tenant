@extends('layouts.tenant')
@section('title', 'Client View')
@section('breadcrumb')
    @parent
    <li><a href="{{url('tenant/clients')}}" title="All Clients"><i class="fa fa-users"></i> Clients</a></li>
    <li>View</li>
@stop
@section('content')
<div class="container">
      
      <div class="row">
        @include('Tenant::Client/client_header') 
      </div>
      <div class="row">
<!-- About Me Box -->
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">General Information</h3>
            </div>
        
        <!-- /.box-header -->
            <div class="box-body">
                
                <strong><i class="fa fa-file-text-o margin-r-5"></i> Client ID</strong>
                <p class="text-muted">{{format_id($client->client_id, 'C')}}</p>
                
                <strong><i class="fa fa-calendar margin-r-5"></i> Created At</strong>
                <p class="text-muted">{{format_datetime($client->created_at)}}</p>
                
                <strong><i class="fa fa-calendar margin-r-5"></i> Created By</strong>
                <p class="text-muted">{{format_datetime($client->created_at)}}</p>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Due Amount</strong>
                <p class="text-muted">200</p>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Referred By</strong>
                <p class="text-muted">Echha Dangol</p>
                
                <strong><i class="fa fa-file-text-o margin-r-5"></i> Description</strong>
                <p class="text-muted">{{$client->description}}</p>
                
                
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="col-md-9">
            <div class="row">
            
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personal Details</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>First Name</th>
                                <td>{{$client->first_name}}</td>
                            </tr>
                            <tr>
                                <th>Middle Name</th>
                                <td>{{$client->middle_name}}</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>{{$client->last_name}}</td>
                            </tr>
                            <tr>
                                <th>DOB</th>
                                <td>{{format_date($client->dob)}}</td>
                            </tr>
                            <tr>
                                <th>Sex</th>
                                <td>{{$client->sex}}</td>
                            </tr>
                            
                            <tr>
                                <th>Passport No.</th>
                                <td>{{$client->passport_no}}</td>
                            </tr>
                            <tr>
                                <th style="width: 34%;">Phone No</th>
                                <td>{{$client->number}}</td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td><a href="mailto:{{$client->email}}"> {{$client->email}}</a></td>
                            </tr>
                            
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-map-marker"></i> Address Details</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th style="width: 34%;">Line 1</th>
                            <td>{{ $client->line1 }}</td>
                        </tr>
                        <tr>
                            <th>Line 2</th>
                            <td>{{ $client->line2 }}</td>
                        </tr>
                        <tr>
                            <th>Street</th>
                            <td>{{ $client->street }}</td>
                        </tr>
                        <tr>
                            <th>Suburb</th>
                            <td>{{ $client->suburb }}</td>
                        </tr>
                        <tr>
                            <th>Postcode</th>
                            <td>{{ $client->postcode }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $client->state }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ get_country($client->country_id) }}</td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>


    


    
@stop
