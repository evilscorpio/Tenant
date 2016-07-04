<?php $current = Request::segment(4); ?>
<div class="container">
    <div class="row">
        <div class="client-navbar" style="display: none;">
            <div class="col-sm-12 col-md-2">
                <div class="container">
                    <img src="https://scontent-lax3-1.xx.fbcdn.net/v/t1.0-9/1936510_10207216981375364_4596889339024157957_n.jpg?oh=f3031e9add8769ca489e5865a54b6bc4&oe=57B0E02E"
                         class="img-rounded" alt="Cinque Terre" width="150" height="150">
                </div>
            </div>
            <div class="col-sm-12 col-md-10">
                <div class="row">

                    <h4>{{$client->first_name}} {{$client->middle_name}} <b>{{$client->last_name}}</b></h4>

                    <p>University of Western Sydney</p>

                    <p>
                        Graduate Diploma of Professional Accounting
                    </p>
                </div>
                <div class="container-fluid">
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href={{url("tenant/clients/$application->client_id")}}>Dashboard</a></li>
                            <li><a href={{url("tenant/clients/$application->client_id/personal_details")}}>Personal
                                    Details</a></li>
                            <li class="active"><a href={{url("tenant/clients/$application->client_id/applications")}}>College
                                    Application</a></li>
                            <li><a href={{url("tenant/clients/$application->client_id/accounts")}}>Accounts</a></li>
                            <li><a href={{url("tenant/clients/$application->client_id/document")}}>Documents</a></li>
                            <li><a href={{url("tenant/clients/$application->client_id/notes")}}>Notes</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{--<span class="btn btn-success btn-small btn-flat menu-toggle"><i class="fa fa-bars"></i> Toggle Client Menu</span>--}}
    </div>
    <div class="row">
        {{--<div class="menu-opener">
            <span class="menu-opener-inner"></span>
        </div>--}}
    </div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{--<a class="navbar-brand visible-xs" href="#">AMS</a>--}}
                <a class="navbar-brand menu-toggle" href="#"><i class="fa fa-user"></i> Show Client Menu</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{($current == 'show')? 'active' : ''}}"><a href="{{route('tenant.application.show', $application->application_id)}}">Dashboard</a></li>
                    <li><a href="#">Application Details</a></li>
                    <li class="{{($current == 'college')? 'active' : ''}}"><a href="{{route('tenant.application.college', $application->application_id)}}">College Accounts</a></li>
                    <li class="{{($current == 'students')? 'active' : ''}}"><a href="{{route('tenant.application.students', $application->application_id)}}">Students Accounts</a></li>
                    <li class="{{($current == 'subagents')? 'active' : ''}}"><a href="{{route('tenant.application.subagents', $application->application_id)}}">Sub Agent Accounts</a></li>
                    <li><a href="{{url("tenant/clients/$client->client_id/innerdocument")}}">Documents</a></li>
                    <li><a href="{{url("tenant/clients/$client->client_id/innernotes")}}">Notes</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->

        </div>
        <!--/.container-fluid -->
    </nav>

    @if(isset($stats))
        <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Invoice Amount</span>
                    <span class="info-box-number">${{ $stats['invoice_amount'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Paid Amount</span>
                    <span class="info-box-number">${{ $stats['total_paid'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Due Amount</span>
                    <span class="info-box-number">${{ $stats['due_amount'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    @endif
    @include('flash::message')
</div>

<script class="cssdeck" type="text/javascript">
    /*$(".menu-opener").click(function () {
        $(".menu-opener").toggleClass("active");
        $(".client-navbar, .menu-opener-inner").slideToggle();
    });*/

    $(".menu-toggle").click(function () {
        $(".client-navbar").slideToggle();
    });
</script>