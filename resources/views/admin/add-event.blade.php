@include('layouts.header')
<a href="{{route('view.events')}}" class="btn btn-primary ml-4 mt-2"> 
  <i class="bi bi-arrow-left me-1"></i> Back
</a>
<section class="content mt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card shadow" style="border-radius: 10px;">
          <div class="card-header" style="background-color: powderblue; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            @if($mode === 'edit')
              <h3 class="card-title mt-1 ml-2"><i class="bi bi-pencil-square mr-1"></i> Edit Event </h3>
            @else
              <h3 class="card-title mt-1 ml-2"><i class="fa-regular fa-calendar-plus mr-1"></i> Add Event </h3>
            @endif
          </div>
          <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger text-dark" style="background: rgba(228, 75, 75, 0.2); border: none;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($mode === 'edit')
            <form action="{{ route('event.update', ['id' => $events->id]) }}" method="post" enctype="multipart/form-data">
            @else
            <form class="form-container" action="{{route('event.store')}}" method="POST" enctype="multipart/form-data" style="padding: 20px;">
            @endif
              @csrf 
              <div class="form-group">
                <div class="row">
                    <div class="col-md-12 mt-2">
                      <label for="title">Title</label>
                      <input type="text" name="title" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{ isset($events) ? $events->title : old('title') }}">
                      
                    </div>
                    <div class="col-md-6 mt-3"> 
                      <label for="event_date">Event Date</label>
                      <input type="date" name="event_date" class="form-control" id="Inputuser2" aria-describeby="usernameHelp" value="{{ isset($events) ? $events->event_date : old('event_date') }}">
                      
                    </div>
                    <div class="col-md-6 mt-3">
                      <label for="event_time">Event Time</label>
                      <input type="time" name="event_time" class="form-control" id="Inputuser3" aria-describeby="usernameHelp" value="{{ isset($events) ? $events->event_time : old('event_time') }}">
                      
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="event_address">Address</label>
                      <textarea type="text" class="form-control" id="event_address" name="event_address">{{ isset($events) ? $events->address : old('event_address') }}</textarea>
                      
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="organizer" class="form-label">Organizer</label>
                      <select name="organizer" id="organizer" class="form-control mt-1">
                          <option value="" disabled {{ old('organizer') === null ? 'selected' : '' }}>-- Select Organizer --</option>
                          @foreach ($users as $user)
                              <option value="{{ $user->id }}"
                                  {{ isset($events) && $events->organizer == $user->id ? 'selected' : '' }}>
                                  {{ $user->first_name }}
                              </option>
                          @endforeach
                      </select>
                      
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="notes" class="form-label">Notes</label>
                      <textarea type="text" class="form-control" id="notes" name="notes">{{ isset($events) ? $events->notes : old('notes') }}</textarea>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="banner" class="form-label">Banner</label>
                        <input type="file" class="form-control" id="banner" name="banner">
                        @php
                            if (isset($events)) {
                                echo $id = str_replace('public/image/', '', $events->banner);
                            }
                        @endphp
                    </div>
                    <div class="col-md-6 mt-3">
                      <div class="form-group">
                          <label for="dropdown" class="form-label">Event Status </label>
                          <select id="event_status" class="form-control" name="event_status">
                              <option value="" disabled {{ !isset($events) && old('event_status') === null ? 'selected' : '' }}>-- Select an option --</option>
                              <option value="0" {{ isset($events) && $events->event_status == 0 ? 'selected' : (old('event_status') == '0' ? 'selected' : '') }}>Upcoming</option>
                              <option value="1" {{ isset($events) && $events->event_status == 1 ? 'selected' : (old('event_status') == '1' ? 'selected' : '') }}>Ongoing</option>
                              <option value="2" {{ isset($events) && $events->event_status == 2 ? 'selected' : (old('event_status') == '2' ? 'selected' : '') }}>Completed</option>
                              <option value="3" {{ isset($events) && $events->event_status == 3 ? 'selected' : (old('event_status') == '3' ? 'selected' : '') }}>Cancelled</option>
                          </select>
                      </div>
                    </div> 
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('layouts.footer')
