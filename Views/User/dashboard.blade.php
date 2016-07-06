@extends('layouts.tenant')
@section('title', 'Client View')
@section('breadcrumb')
    @parent
    <li><i class="fa fa-users"></i> Clients</a></li>
    <li>View</li>
@stop
@section('content')

<div class="container">
    <section class="content-header">
        <h1>Dashboard</h1>
        <ol class="breadcrumb">
                            <li><a href="http://expertfinance.thinkingnepal.com" data-push="true"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                    </ol>
    </section>

    <section class="content clearfix">
    	<div class="row">
	        <div class="col-md-2">
	            <div class="box box-primary">
	                <div class="box-header ui-sortable-handle">
	                    <h3 class="box-title">New Application</h3>
	                </div>
	                <div class="box-body">
		                12 
		            </div>
	            </div>
	        </div>

	        <div class="col-md-2">
	            <div class="box box-primary">
	                <div class="box-header ui-sortable-handle">
	                    <h3 class="box-title">Offer Letter Processing</h3>
	                </div>
	                <div class="box-body">
		                12 
		            </div>
	            </div>
	        </div>

	        <div class="col-md-2">
	            <div class="box box-primary">
	                <div class="box-header ui-sortable-handle">
	                    <h3 class="box-title">Offer Letter Received</h3>
	                </div>
	                <div class="box-body">
		                12 
		            </div>
	            </div>
	        </div>

	        <div class="col-md-2">
	            <div class="box box-primary">
	                <div class="box-header ui-sortable-handle">
	                    <h3 class="box-title">Coe Processing</h3>
	                </div>
	                <div class="box-body">
		                12 
		            </div>
	            </div>
	        </div>

	        <div class="col-md-2">
	            <div class="box box-primary">
	                <div class="box-header ui-sortable-handle">
	                    <h3 class="box-title">Coe Received</h3>
	                </div>
	                <div class="box-body">
		                12 
		            </div>
	            </div>
	        </div>


	        <div class="col-md-2">
	            <div class="box box-primary">
	                <div class="box-header ui-sortable-handle">
	                    <h3 class="box-title">Course Completed</h3>
	                </div>
	                <div class="box-body">
		                12 
		            </div>
	            </div>
	        </div>



	    </div>
    	<div class="row">
	        <div class="col-md-12">
	            <div class="box box-primary">
	                <div class="box-header ui-sortable-handle">
	                    <h3 class="box-title">Active Clients</h3>

	                    <div class="box-tools pull-right">
	                        <a class="btn btn-primary" href="http://expertfinance.thinkingnepal.com/system/lead/add"><i class="fa fa-plus"></i> Add Client</a>
	                    </div>
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
		                    <tr>
		                        <td>C1001</td>
		                        <td>Jenish Maskey</td>
		                        <td>0430807730</td>
		                        <td>jenisjack_1@hotmail.com</td>
		                        <td>Krita Maharjan</td>
		                        <td>Actions</td>

		                    </tr>

		                </table>
		            </div>
	            </div>
	        </div>

	    </div>
        <div class="row">
        	<div class="col-md-8">
	            <div class="box box-primary">
				    <div class="box-header ui-sortable-handle">
				        <i class="ion ion-clipboard"></i>

				        <h3 class="box-title">To Do List</h3>

				         <div class="box-tools pull-right">
	                        <a class="btn btn-primary" href="http://expertfinance.thinkingnepal.com/system/lead/add"><i class="fa fa-plus"></i> Add Reminders</a>
	                    </div>  
				        

				        <div class="box-tools pull-right task-pagination">
				            
				        </div>
				        <!-- /.box-header -->
				        <div class="box-body">
				                        <ul class="todo-list ui-sortable">
				                                    <li>
				                        <label>
				                            <!-- checkbox -->
				                            <input type="checkbox" value="" name="" class="complete" id="196">
				                            <span class="text">please email me customer passport</span>
				                            <!-- Emphasis label -->
				                            <small class="label label-info"><i
				                                        class="fa fa-clock-o"></i> 3 weeks ago</small>
				                        </label>
				                        <!-- General tools such as edit or delete-->
				                        <div class="tools">
				                            <a href="http://expertfinance.thinkingnepal.com/system/task/view/196"> <i class="fa fa-eye"></i></a>
				                        </div>
				                    </li>
				                                    <li>
				                        <label>
				                            <!-- checkbox -->
				                            <input type="checkbox" value="" name="" class="complete" id="188">
				                            <span class="text">hello there</span>
				                            <!-- Emphasis label -->
				                            <small class="label label-info"><i
				                                        class="fa fa-clock-o"></i> 1 month ago</small>
				                        </label>
				                        <!-- General tools such as edit or delete-->
				                        <div class="tools">
				                            <a href="http://expertfinance.thinkingnepal.com/system/task/view/188"> <i class="fa fa-eye"></i></a>
				                        </div>
				                    </li>
				                                    <li>
				                        <label>
				                            <!-- checkbox -->
				                            <input type="checkbox" value="" name="" class="complete" id="187">
				                            <span class="text">give me some feedback</span>
				                            <!-- Emphasis label -->
				                            <small class="label label-info"><i
				                                        class="fa fa-clock-o"></i> 1 month ago</small>
				                        </label>
				                        <!-- General tools such as edit or delete-->
				                        <div class="tools">
				                            <a href="http://expertfinance.thinkingnepal.com/system/task/view/187"> <i class="fa fa-eye"></i></a>
				                        </div>
				                    </li>
				                            </ul>
				                    </div>
				        <!-- /.box-body -->
				        
				    </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-primary">
	                <div class="box-header ui-sortable-handle">
	                    <h3 class="box-title">Outstanding Payments</h3>
	                </div>
	                <div class="box-body">
		                <table id="clients" class="table table-bordered table-striped dataTable">
		                    <tr>   
		                        <td>Jenish Maskey</td>
		                        <th>$1000</th>
		                        <th>
		                        	<a data-toggle="tooltip" title="View Client Account" class="btn btn-action-box" href =""><i class="fa fa-eye"></i></a>
		                        </th>
		                    </tr>
		                    <tr>  
		                        <td>Jenish Maskey</td>
		                        <th>$1000</th>
		                        <th>
		                        	<a data-toggle="tooltip" title="View Client Account" class="btn btn-action-box" href =""><i class="fa fa-eye"></i></a>
		                        </th>
		                    </tr>

		                </table>
		            </div>
	            </div>
			</div>
		</div>
		

		</div>
	</section>
</div>


@stop
