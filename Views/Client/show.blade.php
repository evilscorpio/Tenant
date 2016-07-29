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
        <div class="col-md-3">


            <div class="row">
                <!-- About Me Box -->
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

                        <p class="text-muted">{{ $client->referred_by }}</p>


                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="row">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reminders</h3>

                        <a href="{{url("tenant/clients/$client->client_id/notes")}}"
                           class="btn btn-success pull-right btn-sm"><i class="fa fa-plus"></i> Add New</a>


                    </div>
                    <!-- Recent Payments -->
                    <div class="box-body">
                        @foreach($remainders as $key => $remainder)
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ $remainder->description }}</strong>

                            <p class="text-muted">{{ format_date($remainder->reminder_date) }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- /.box -->
        </div>

        <div class="col-md-9">
            <div class="box">

                <div class="box-body">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div>

                            <div class="col-sm-10">
                                <input class="form-control input-sm" type="text" placeholder="Type a Comment">
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-primary btn-sm">Submit</a>
                            </div>
                            <div>&nbsp;</div>

                        </div>
                        <!-- /.post -->
                    </div>

                    {{-- The actual timeline --}}
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        @foreach($timelines as $key => $grouped_timeline)
                            <li class="time-label">
                                <span class="bg-red">
                                  {{ readable_date($key) }}
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            @foreach($grouped_timeline as $timeline)
                            <li>
                                <i class="fa {{$timeline->image}}"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{get_datetime_diff($timeline->created_at)}}</span>
                                    {!! $timeline->message !!}
                                </div>
                            </li>
                            @endforeach
                        @endforeach
                    </ul>

                    {{-- End Actual timeline --}}

                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-envelope bg-blue"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">Read more</a>
                                    <a class="btn btn-danger btn-xs">Delete</a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-user bg-aqua"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend
                                    request
                                </h3>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-camera bg-purple"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
                <!-- /.post -->
            </div>
        </div>
    </div>
    <!-- /.col -->


@stop
