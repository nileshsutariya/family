<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Family Tree</title>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js" integrity="sha512-Y+cHVeYzi7pamIOGBwYHrynWWTKImI9G78i53+azDb1uPmU1Dz9/r2BLxGXWgOC7FhwAGsy3/9YpNYaoBy7Kzg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 600;
        }
        .card-header {
            font-weight: 500;
            font-size: 1.2rem;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .list-group-item h6 {
            font-weight: 500;
        }
        .footer-text {
            font-size: 0.9rem;
        }
        .container {
            max-width: 1000px;
        }

        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-table thead {
            background-color: powderblue;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: bold;
        }

        .custom-table thead th {
            padding: 15px;
        }

        .custom-table tbody tr {
            transition: background-color 0.3s ease;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .custom-table tbody tr:hover {
            background-color: #e9ecef;
        }

        .custom-table td {
            padding: 15px;
            border-top: 1px solid #dee2e6;
        }

        .custom-table td:first-child,
        .custom-table th:first-child {
            border-left: none;
        }

        .custom-table td:last-child,
        .custom-table th:last-child {
            border-right: none;
        }

        .btn-outline-primary, .btn-outline-danger {
            border-radius: 20px;
            padding: 6px 12px;
        }

        .btn-outline-primary:hover {
            color: #ffffff;
            background-color: #5f9ee0;
            border-color: #0056b3;
        }

        .btn-outline-danger:hover {
            color: #ffffff;
            background-color: #c82333;
            border-color: #c82333;
        }
  </style>
</head>
<body>

    <nav class="navbar content navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-tree"></i> Family Tree Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#addEventModal">
                            <i class="fas fa-plus-circle"></i> Add Event
                        </a>
                    </li>
                    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-image: linear-gradient(to right, lavender, white);">
                                <div class="modal-header">
                                    <div class="card-header">
                                        <i class="fas fa-calendar-plus"></i> Add New Event
                                    </div>                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('event.store')}}" id="formdata" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Event Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                                                <span class="text-danger error-title" id="title_error"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="event_date" class="form-label">Event Date</label>
                                                    <input type="date" class="form-control" id="event_date" name="event_date" value="{{old('event_date')}}">
                                                    <span class="text-danger error-event_date" id="event_date_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="event_time" class="form-label">Event Time</label>
                                                    <input type="time" class="form-control" id="event_time" name="event_time" value="{{old('event_time')}}">
                                                    <span class="text-danger error-event_time" id="event_time_error"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="event_adddress" class="form-label">Address</label>
                                                <textarea type="text" class="form-control" id="event_address" name="event_address">{{old('event_address')}}</textarea>
                                                <span class="text-danger error-event_address" id="event_address_error"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="organizer" class="form-label">Organizer</label>
                                                <select name="organizer" id="organizer" class="form-control mt-1">
                                                    <option value="">-- Select Organizer --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ old('organizer') == 1 ? 'selected' : '' }}>{{ $user->first_name ?? 'No First Name' }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error-organizer" id="organizer_error"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">Notes</label>
                                                <textarea type="text" class="form-control" id="notes" name="notes">{{old('notes')}}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="banner" class="form-label">Banner</label>
                                                    <input type="file" class="form-control" id="banner" name="banner" value="{{old('banner')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="dropdown" class="form-label">Event Status : </label>
                                                    <select id="event_status" class="form-control" name="event_status">
                                                        <option value="" disabled {{ old('event_status') === null ? 'selected' : '' }}> -- Select an option -- </option>
                                                        <option value="0" {{ old('event_status') === 0 ? 'selected' : '' }}>Upcoming</option>
                                                        <option value="1" {{ old('event_status') === 1 ? 'selected' : '' }}>Ongoing</option>
                                                        <option value="2" {{ old('event_status') === 2 ? 'selected' : '' }}>Completed</option>
                                                        <option value="3" {{ old('event_status') === 3 ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                    <span class="text-danger error-event_status" id="event_status_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add Event</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view.events')}}"><i class="fas fa-calendar-alt"></i> View Events </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view.members')}}">
                            <i class="fa-solid fa-users"></i> View Members
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

{{-- <script>
    $('#formdata').submit(function(event) {
            event.preventDefault();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    url: '{{ route('event.store') }}',
                    data: $('#formdata').serialize(),
                    
                    success: function(response) {
                        console.log('{{ route('event.store') }}');
                        console.log(response);
                        if (response.success) {
                            alert(response.success);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.error;
                            $.each(errors, function(key, value) {
                                var errorClass = '.error-' + key.replace(/\./g, '_');
                                console.log(errorClass)
                                $(errorClass).text(value[0]);
                                
                            });
                        }
                    }
               
                });
            });
</script> --}}


<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#formdata').on('submit', function (e) {
            e.preventDefault(); 
    
            $('.text-danger').text('');
    
            let formData = new FormData(this);
    
            $.ajax({
                url: "{{ route('event.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#addEventModal').modal('hide');
                    location.reload(); 
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.error;
                        $.each(errors, function(key, value) {
                            var errorClass = '.error-' + key.replace(/\./g, '_');
                            console.log(errorClass)
                            $(errorClass).text(value[0]);
                            
                        });
                    }
                }
            });
        });
    });
</script>
        