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
    </section>

    <section class="content clearfix">
    	<div class="col-md-8">
    		<div class="row">
	        
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
		                        <th>Client Name</th>
		                        <th>Phone No</th>
		                        <th>Email</th>		                        
		                        <th>Actions</th>
		                    </tr>
		                    </thead>
		                    <tr>		                        
		                        <td>Jenish Maskey</td>
		                        <td>0430807730</td>
		                        <td>jenisjack_1@hotmail.com</td>
		                        
		                        <td>
		                        	<div class="box-tools pull-right">
				                        <a class="btn btn-primary" href=""><i class="fa fa-eye"></i></a>
				                    </div>
				                    <div class="box-tools pull-right">
				                        <a class="btn btn-primary" href=""><i class="fa fa-remove"></i></a>
				                    </div>
	                			</td>
		                    </tr>
		                </table>
		            </div>
	            </div>
	        </div>

	        <div class="row">
		            <div class="box box-primary">
		                <div class="box-header ui-sortable-handle">
		                    <h3 class="box-title">Application List</h3>
		                </div>
		                <div class="box-body">
			                <div id="chart">
						      <ul id="numbers">
						        <li><span>&nbsp;</span></li>
						        <li><span>28</span></li>
						        <li><span>24</span></li>
						        <li><span>20</span></li>
						        <li><span>16</span></li>
						        <li><span>12</span></li>
						        <li><span>8</span></li>
						        <li><span>4</span></li>
						        <li><span>0</span></li>
						      </ul>
						      <ul id="bars">
						        <li><div data-applications="26" class="bar"></div><span>Enquiry</span></li>
						        <li><div data-applications="25" class="bar"></div><span>Offer Processing</span></li>
						        <li><div data-applications="30" class="bar"></div><span>Offer Received</span></li>
						        <li><div data-applications="16" class="bar"></div><span>Coe Processing</span></li>
						        <li><div data-applications="0" class="bar"></div><span>Coe Received</span></li>
						        <li><div data-applications="12" class="bar"></div><span>Course Started</span></li>
						        <li><div data-applications="2" class="bar"></div><span>Course Completed</span></li>
						      </ul>

						    </div>
			            </div>
			            <br>
		            </div>    
		    </div>

		    <div class="row">        	
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
		
	</section>		
</div>


<link rel="stylesheet" type="text/css" href="{{ URL::asset('/local/public/css/chart.css') }}" />
        
    <script src="{{ URL::asset('/local/public/js/chart.js') }}"></script>
     <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


@stop
