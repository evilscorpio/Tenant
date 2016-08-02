
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
                                        <span class="time"><i
                                                    class="fa fa-clock-o"></i> {{get_datetime_diff($timeline->created_at)}}</span>
                    {!! $timeline->message !!}
                </div>
            </li>
        @endforeach
    @endforeach
    <li>
        <i class="fa fa-clock-o bg-gray"></i>
    </li>
</ul>