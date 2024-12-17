@include('layouts.header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>All Events</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Events</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<a href="{{route('createevent')}}" class="btn btn-primary mr-3 mb-2 float-sm-right btn-sm"><i class="fas fa-plus mr-1"></i>Add Event</a>
{{-- <section class="content"> --}}
    <div class="container-fluid">
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
                        <th colspan="2">Actions</th>
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
                                    <a class="btn btn-sm btn-warning update-status" id="eventstatus" data-val="{{$event->id}}"> Upcoming </a>
                                @elseif($event->event_status == 1)
                                    <a class="btn btn-sm btn-info update-status" id="eventstatus" data-val="{{$event->id}}"> Ongoing </a>
                                @elseif($event->event_status == 2)
                                    <a class="btn btn-sm btn-success update-status" id="eventstatus" data-val="{{$event->id}}"> Completed </a>
                                @else
                                    <a class="btn btn-sm btn-danger update-status" id="eventstatus" data-val="{{$event->id}}"> Cancelled </a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('event.edit', $event->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-danger" href="{{ route('event.delete', $event->id) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pagination_links">
                {{ $events->links('pagination::bootstrap-5') }}
            </div> 
        </div>
    </div>
{{-- </section> --}}
<script type="text/javascript">
    $(document).on("click", "#eventstatus", function() {
        var id = $(this).attr("data-val");  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('eventstatus')}}", 
            data: { 'id': id },
            type: 'GET',
            success: function(data) {
                console.log(data);

                var statusButton = $('a#eventstatus[data-val="' + id + '"]');

                if (data.event_status == 0) {
                    statusButton.text('Upcoming').removeClass('btn-info btn-success btn-danger').addClass('btn-warning');
                } else if (data.event_status == 1) {
                    statusButton.text('Ongoing').removeClass('btn-warning btn-success btn-danger').addClass('btn-info');
                } else if (data.event_status == 2) {
                    statusButton.text('Completed').removeClass('btn-warning btn-info btn-danger').addClass('btn-success');
                } else {
                    statusButton.text('Cancelled').removeClass('btn-warning btn-info btn-success').addClass('btn-danger');
                }
            }
        });
    });
</script>
@include('layouts.footer')
