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

        /* Custom table styling */
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

        /* Button styling */
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
        <style>
        .weekdays {
            font-weight: bold;
            text-align: center;
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #dee2e6;
        }
        .event-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .event-card h5 {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .event-card .time {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
          <a class="navbar-brand" href="#"><i class="fas fa-tree"></i> Family Tree </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('user.dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('view.user.event')}}"><i class="fas fa-calendar-alt"></i> View Events </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('profile')}}">
                      <i class="fa-solid fa-user"></i> Profile
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
