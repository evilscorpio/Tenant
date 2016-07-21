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
				<h1 class="margin-down">{{ $applications->first_name }} - <small>Offer Letter Received</small></h1>
				

				@include('Tenant::application/partial/navbar')

				<div class="box box-primary margin-up">
					<div class="box-body">
						{!! Form::model($applications,[
							'class'=>'form-horizontal',
							'files'=>true,
							'method'=>'PUT',
							'route'=>['application.offer_letter.update',$applications->course_application_id]
							])!!}

					<div class="form-group">
						{{ Form::label('institute_name', 'Institute Name',['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-9">
						{{ $applications->company }}	
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('course_name', 'Course Name',['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-9">
						{{ $applications->name }}	
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('total_tuition_fee', 'Total Tution Fee', ['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-9">
						{{ Form::text('total_tuition_fee', $applications->tuition_fee,['class'=>'form-control col-md-12','placeholder'=>'total tution fee'])}}	
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('intake_date', 'Intake Date',['class'=>'form-label col-md-3 text-right'])}}
						<div class="col-md-9">
							{{ Form::select('intake_date', 
									['$applications->intake_id' => $applications->intake_date]
							) }}
							<br>
						<a href="">Add New Intake</a>
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('student_id', 'Student Id', ['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-9">
						{{ Form::text('student_id', '',['class'=>'form-control col-md-12','placeholder'=>'student id'])}}	
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('total_fee_for_coe', 'Total Fee For COE',['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-9">
							{{ Form::text('total_fee_for_coe', '',['class'=>'form-control col-md-12','placeholder'=>'COE fee'])}}	
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('upload_offer_letter', 'Upload Offer Letter', ['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-9">
						{{ Form::file('upload_offer_letter')}}	
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('notes', 'Notes', ['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-9">
						{{ Form::textarea('notes', '',['class'=>'form-control col-md-12','placeholder'=>'total fee', 'rows'=>3])}}	
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
						{{ Form::submit('Submit',['class'=>'btn btn-primary'])}}
						</div>
					</div>

				{!! Form::close()!!}
					</div>
				</div>
				
			</div>
		</div>
	</div>
@stop




