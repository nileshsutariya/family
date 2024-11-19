@include('layouts.userheader')
    <div class="container-fluid mt-4">
        <h3 class="text-center mb-4">All Events</h3>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead class="text-dark">
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Organizer</th>
                        <th>Notes</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="event_table_body">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($events as $event)         
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$event->title}}</td>
                            <td>{{$event->event_date}}</td>
                            <td>{{$event->event_time}}</td>
                            <td>{{$event->address}}</td>
                            <td>{{$event->organizer}}</td> 
                            <td>{{$event->notes}}</td>
                            <td class="event_status">
                                @if($event->event_status == 0)
                                    <button class="btn btn-sm text-warning fw-bold update-status" id="event_status" data-val="{{$event->id}}"> Upcoming </button>
                                @elseif($event->event_status == 1)
                                    <button class="btn btn-sm text-info fw-bold update-status" id="event_status" data-val="{{$event->id}}"> Ongoing </button>
                                @elseif($event->event_status == 2)
                                    <button class="btn btn-sm text-success fw-bold update-status" id="event_status" data-val="{{$event->id}}"> Completed </button>
                                @else
                                    <button class="btn btn-sm text-danger fw-bold update-status" id="event_status" data-val="{{$event->id}}"> Cancelled </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    </div>
    </div>
</body>
</html>
