<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  
  <title>Family</title>
  <style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        border-color: #007bff; 
    }
    
  </style>
  
  <style>
    body {
        background-color: #f8f9fa;
    }
    .profile-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        margin: 20px auto;
        max-width: 400px;
    }
    .profile-card .social-icons i {
        margin: 0 5px;
        color: #6c757d;
    }
    .profile-card .stats {
        border-top: 1px solid #e9ecef;
        margin-top: 20px;
        padding-top: 20px;
    }
    .profile-card .stats .stat {
        flex: 1;
        text-align: center;
    }
    .profile-card .stats .stat:not(:last-child) {
        border-right: 1px solid #e9ecef;
    }
  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light position-sticky top-0">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link d-flex align-items-center" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="ml-1 d-md-inline">{{ Auth::guard('admin')->user()->first_name }}</span>
              {{-- <img src="{{ asset('profile/' . Auth::guard('admin')->user()->profile_photo) }}" alt="User Image" 
                class="img-circle elevation-2 ml-2" 
                style="width: 30px; height: 30px;"> --}}
                {{-- <i class="fas fa-caret-down ml-1"></i> --}}
                <img src="{{ 
                  Auth::guard('admin')->user()->profile_photo 
                        ? asset('profile/' . Auth::guard('admin')->user()->profile_photo) 
                        : asset('profile/profile (3).jpg') 
                    }}" alt="User Image" class="img-circle elevation-2 ml-2" style="width: 30px; height: 30px;">
              
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="min-width: 200px;">
                <a href="{{ route('admin.profile') }}" class="dropdown-item d-flex align-items-center">
                    <i class="fas fa-user mr-2"></i>
                    <span>My Profile</span>
                </a>
                <a href="{{route('add.admin')}}" class="dropdown-item d-flex align-items-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    <span>Add Admin</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item d-flex align-items-center"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="" class="brand-link text-center ">
        <span class="brand-text font-weight-light "><h4>Family</h4></span>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="ul">
            <li class="nav-item">
              <a href="{{route('admin.dashboard')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('view.events')}}" class="nav-link">
                <i class="nav-icon fa-solid fa-calendar-days"></i>
                <p>Events</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('family.village')}}" class="nav-link">
                <i class="nav-icon fa-solid fa-people-roof"></i>
                <p>Family Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('user-approval')}}" class="nav-link ">
                <i class="nav-icon bi bi-person-fill-gear mr-2"></i>
                <p>Users Approval</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('all.users')}}" class="nav-link ">
                <i class="nav-icon fa-solid fa-users"></i>
                <p>All Members</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    
    <script>           
      $(function(){
        var current = location.pathname;
        
        $('#ul li a').each(function(){
          var a = $(this);
          if(a.attr('href').indexOf(current) !== -1){
              a.addClass('active');
          }
        });
      });
    </script>
                   
    <div class="content-wrapper">

      @if (session('store'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-right",
                iconColor: 'green',
                customClass: {
                    popup: 'colored-toast'
                },
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true 
            });
            Toast.fire("Message", "{{ Session::get('store') }}", 'success', {
                icon: 'success',
            });
        </script>
      @endif

      @if (session('update'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-right",
                iconColor: 'green',
                customClass: {
                    popup: 'colored-toast'
                },
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true 
            });
            Toast.fire("Message", "{{ Session::get('update') }}", 'success', {
                icon: 'success',
            });
        </script>
      @endif

      @if (session('delete'))
        <script>
          const Toast = Swal.mixin({
              toast: true,
              position: "top-right",
              iconColor: 'green',
              customClass: {
                  popup: 'colored-toast'
              },
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true 
          });
          Toast.fire("Message", "{{ Session::get('delete') }}", 'success', {
              icon: 'success',
          });
        </script>
      @endif