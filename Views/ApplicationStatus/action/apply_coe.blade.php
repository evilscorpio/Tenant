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
			@if(count($errors)>0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $error)
  						<strong>Error: </strong>
  						<ul>
  						<li>{{ $error }}</li>
  						</ul>
						@endforeach
					</div>
				@endif
				<h1 class="margin-down">Application - <small>Apply COE</small></h1>
				
				 @include('Tenant::ApplicationStatus/partial/navbar')
				
				<div class="box box-primary">
					<div class="box-body">
						{!! Form::model($applications,[
							'class'=>'form-horizontal',
							'method'=>'POST',
							'route'=>['applications.update.applied.coe', $applications->course_application_id ]
						])!!}	
						
							<div class="form-group col-md-12">
								{!! Form::label('total_fee', 'Total Fee',['class'=>'col-md-4 form-label text-right'])!!}
								<div class="col-md-8">
									<p>{{ $applications->tuition_fee }}</p>	
								</div>
							</div>

							<div class="form-group col-md-12">
								{!! Form::label('intake_date', 'Intake Date',['class'=>'col-md-4 form-label text-right'])!!}
								<div class="col-md-8">
								<p>{{ $applications->intake_date }}</p>	
								</div>
							</div>

							<div class="form-group col-md-12">
								{!! Form::label('student_id', 'Student Id',['class'=>'col-md-4 form-label text-right'])!!}
								<div class="col-md-8">
								<p>{{ $applications->student_id }}</p>	
								</div>
							</div>

							<div class="form-group col-md-12">
								{!! Form::label('fee_paid_for_coe', 'Fee Paid for COE', ['class'=>'col-md-4 form-label text-right'])!!}
								<div class="col-md-8">
								{!! Form::text('fee_paid_for_coe', '' , ['class'=>'col-md-10']) !!}	
								</div>
							</div>

							<div class="form-group col-md-12">
								<div class="col-md-9 col-md-offset-4"><br>
								<a href="">View Offer Letter</a><br>
								{!! Form::submit('Cancel',['class'=>'btn btn-primary']) !!}
								</div>
							</div>

						{!! Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
					 




