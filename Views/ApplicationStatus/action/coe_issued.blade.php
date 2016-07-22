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
				<h1 class="margin-down">Application - <small>COE Issued</small></h1>
				

				 @include('Tenant::ApplicationStatus/partial/navbar')

				<div class="box box-primary margin-up">
					<h1 class="margin-from-left">{{ $applications->fullname}}</h1>
					<div class="box-body">
						{!! Form::model($applications,[
							'class'=>'form-horizontal',
							'files'=>true,
							'method'=>'POST',
							'route'=>['applications.action.update.coe.issued',$applications->course_application_id]
							])!!}

					<div class="form-group col-md-12">
						{{ Form::label('total_tuition_fee', 'Total Fee', ['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-8">
						{{ Form::text('total_tuition_fee', '' ,['class'=>'form-control col-md-12','placeholder'=>'total fee'])}}	
						</div>
					</div>

					<div class="form-group col-md-12">
						{{ Form::label('intake_date', 'Intake Date',['class'=>'form-label col-md-3 text-right'])}}
						<div class="col-md-8">
							{{ Form::select('intake_date', 
									['$applications->intake_id' => $applications->intake_date]
							) }}
						</div>
					</div>

					

					<div class="form-group col-md-12">
						{{ Form::label('finish_date', 'Finish Date',['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-8">
							{{ Form::text('finish_date', '',['class'=>'form-control col-md-12', 'placeholder'=>'yyyy-mm-dd'])}}	
						</div>
					</div>

					<div class="form-group col-md-12">
						{{ Form::label('upload_offer_letter', 'Upload Offer Letter', ['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-8">
						{{ Form::file('upload_offer_letter')}}	
						</div>
					</div>

					<div class="form-group col-md-12">
						{{ Form::label('student_id', 'Student Id', ['class'=>'col-md-3 form-label text-right'])}}
						<div class="col-md-8">
						{{ Form::text('student_id', '',['class'=>'form-control col-md-12','placeholder'=>'student id'])}}	
						</div>
					</div>

					<div class="form-group col-md-12">
						<div class="col-md-9 col-md-offset-2">
						{{ Form::submit('Submit',['class'=>'btn btn-primary pull-right'])}}
						{{ Form::submit('Submit & Continue to Invoice',['class'=>'btn btn-success pull-left'])}}
						</div>
					</div>

				{!! Form::close()!!}
					</div>
				</div>
				
			</div>
		</div>
	</div>
@stop




