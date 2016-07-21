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

				<h1 class="margin-down">{{ $applications->first_name}} - <small>Apply Offer</small></h1>
				
				@include('Tenant::ApplicationStatus/partial/navbar')
				
				<div class="box box-primary margin-up">
					<div class="box-body">
						<div class="row">
							<div class="col-md-7 col-md-offset-1">
								{!! Form::model($applications, [
									'class'=>'form-horizontal',
									'method'=>'POST',
									'route'=>['applications.apply.update',$applications->course_application_id]
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
  								  {!! Form::label('total_tuition_fee', 'Total Tution Fee', ['class'=>'col-md-3 form-label text-right']) !!}
  								  <div class="col-md-9">
  								    {!! Form::text('total_tuition_fee', $applications->tuition_fee,['class'=>' rounded form-control col-md-12']) !!}	
  								  </div>
  				        </div>
							
                  <div class="form-group">
  								  {!! Form::label('intake_date', 'Intake Date', ['class'=>'col-md-3 form-label text-right']) !!}
  								  <div class="col-md-9">
                      {!! Form::select('intake_date', array('' => 'Select Intake Date') + $intakes) !!}
                       <br>
    								  <a href="#">add new intake</a>
  								  </div>
                  </div>

    							<div class="form-group">
    								<div class="col-md-9 col-md-offset-3">
    								{{ Form::submit('Apply Now',['class'=>'btn btn-primary'])}}
    								</div>
    							</div>
						    {!! Form::close()!!}
              </div>
              <div class="col-md-4">
						    <h3>Institutes Documents</h3>
						    <br>
						    <p><a href="">Undergraduate Application Form</a></p>
						    <p><a href="">Postgraduate Application Form</a></p>
		          </div>
				    </div>					
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

           

        
              
          
        
      
     
        


