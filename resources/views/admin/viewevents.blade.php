@include('layouts.header')
<body>
<section class="content">
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
                        <th>Actions</th>
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
                                    <button class="btn btn-sm btn-warning update-status" id="event_status" data-val="{{$event->id}}"> Upcoming </button>
                                @elseif($event->event_status == 1)
                                    <button class="btn btn-sm btn-info update-status" id="event_status" data-val="{{$event->id}}"> Ongoing </button>
                                @elseif($event->event_status == 2)
                                    <button class="btn btn-sm btn-success update-status" id="event_status" data-val="{{$event->id}}"> Completed </button>
                                @else
                                    <button class="btn btn-sm btn-danger update-status" id="event_status" data-val="{{$event->id}}"> Cancelled </button>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-1 edit-btn" 
                                    data-id="{{ $event->id }}" 
                                    data-title="{{ $event->title }}" 
                                    data-date="{{ $event->event_date }}"
                                    data-time="{{ $event->event_time }}" 
                                    data-address="{{ $event->address }}"
                                    data-organizer="{{ $event->organizer }}"
                                    {{-- data-organizer-id="{{ $event->organizer_id }}" --}}
                                    {{-- data-organizer-name="{{ $event->organizer_name }}" --}}
                                    data-notes="{{ $event->notes }}"
                                    data-status="{{ $event->event_status }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editEventModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a class="btn btn-sm btn-outline-danger" href="{{ route('event.delete', $event->id) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-image: linear-gradient(to right, lavender, white);">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm" action="{{ route('event.update', '') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editId" name="id">
                        {{-- <p>Organizer ID: {{ $event->organizer }}</p> --}}

                        <div class="row">
                            <div class="mb-3">
                                <label for="title" class="form-label">Event Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="event_date" class="form-label">Event Date</label>
                                    <input type="date" class="form-control" id="event_date" name="event_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="event_time" class="form-label">Event Time</label>
                                    <input type="time" class="form-control" id="event_time" name="event_time">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="event_address" class="form-label">Address</label>
                                <textarea class="form-control" id="event_address" name="event_address"></textarea>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="organizer" class="form-label">Organizer</label>
                                <select name="organizer" id="organizer" class="form-control mt-1">
                                    <option value="" disabled {{ $event->organizer ? '' : 'selected' }}>-- Select Organizer --</option>
                                    @foreach ($user as $users)
                                        <option value="{{ $users->id }}" 
                                            {{ $event->organizer == $users->id ? 'selected' : '' }}>
                                            {{ $users->first_name ?? 'No First Name' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="mb-3">
                                <label for="organizer" class="form-label">Organizer</label>
                                <select name="organizer" id="organizer" class="form-control mt-1">
                                    <option value="" disabled {{ is_null($event->organizer) ? 'selected' : '' }}>-- Select Organizer --</option>
                                    @foreach ($users as $user)  
                                        <option value="{{ $user->id }}" 
                                            {{ isset($event) && $event->organizer == $user->id ? 'selected' : '' }}>
                                            {{ $user->first_name ?? 'No First Name' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <p>Organizer: {{ $event->organizer }}</p>
                            
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="banner" class="form-label">Banner</label>
                                    <input type="file" class="form-control" id="banner" name="banner">
                                    <img id="currentBanner" src="" alt="Banner Image">
                                    @php
                                        if (isset($events)) {
                                            echo $id = str_replace('public/image/', '', $event->banner);
                                        }
                                    @endphp
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="dropdown" class="form-label">Event Status : </label>
                                    <select id="event_status" class="form-control" name="event_status">
                                        <option value="" disabled selected> -- Select an option -- </option>
                                        <option value="0">Upcoming</option>
                                        <option value="1">Ongoing</option>
                                        <option value="2">Completed</option>
                                        <option value="3">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", "#event_status", function() {
                var id=$(this).attr("data-val");  
                console.log(id);

                $.ajax ({     
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('eventstatus')}}", 
                    data: {
                        'id':id,
                    },
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('#event_table_body').html($(data).find('#event_table_body').html());
                    }
                });
            });
        });
    </script>

    {{-- @include('layouts.footer') --}}

    <script>
        const organizers = @json($user->pluck('first_name', 'id'));
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const modal = document.getElementById('editEventModal');
                modal.querySelector('#editId').value = this.getAttribute('data-id');
                modal.querySelector('#title').value = this.getAttribute('data-title');
                modal.querySelector('#event_date').value = this.getAttribute('data-date');
                modal.querySelector('#event_time').value = this.getAttribute('data-time');
                modal.querySelector('#event_address').value = this.getAttribute('data-address');
                modal.querySelector('#organizer').value = this.getAttribute('data-organizer-name'); 
                modal.querySelector('#notes').value = this.getAttribute('data-notes');
                modal.querySelector('#event_status').value = this.getAttribute('data-status');
                modal.querySelector('form').action = "{{ url('event/update') }}/" + this.getAttribute('data-id');
                
                const organizerId = this.getAttribute('data-organizer-id');
                modal.querySelector('#organizer').value = organizerId;

                if (organizers[organizerId]) {
                    modal.querySelector('#organizer').textContent = organizers[organizerId];
                }
                
                const bannerUrl = this.getAttribute('data-banner');
                if (bannerUrl) {
                    const bannerName = bannerUrl.split('/').pop(); 
                    modal.querySelector('#currentBanner').src = bannerUrl;
                    modal.querySelector('#currentBanner').style.display = 'block'; 
                    console.log('Banner Image Name: ', bannerName); 
                } else {
                    modal.querySelector('#currentBanner').style.display = 'none'; 
                }
            });
        });
    </script>

</section>

    </div>
    </div>
</body>
</html>
