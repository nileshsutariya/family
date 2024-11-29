<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title> Login </title>
</head>
<body>
  <nav class="navbar content navbar-expand-lg navbar-light bg-none">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="#"><i class="fas fa-tree"></i> Family Tree Admin</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}" >
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">
                        Sign Up
                    </a>
                </li>
            </ul>
        </div>
    </div>
  </nav>
  <section class="container-fluid">
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-4">
        <form class="form-container shadow" action="{{route('login-in')}}" method="POST" style="background: #ffffff; border-radius: 15px; padding: 40px;">
          @csrf
          <div class="form-group">
            <h2 class="text-center font-weight-bold mb-3"> Login </h2>

            <input type="text" name="ph_no" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Mobile No" value="{{old('ph_no')}}">
            @error('ph_no')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
            <input type="password" name="password" class="form-control mt-3" id="InputPassword1" placeholder="Password">
            @error('password')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
          </div>
          <button type="Sign in" class="btn btn-primary btn-block mt-2">Sign In</button>
          <div class="form-footer text-center mt-2">
            <p></p>
            {{-- <p> Don't have an account? <a href="{{route('register')}}">Sign Up</a></p> --}}
          </div>
        </form>
      </section>
    </section>
  </section>

      @if (session('message'))
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
            Toast.fire("Message", "{{ Session::get('message') }}", 'success', {
                icon: 'success',
            });
        </script>
      @endif

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>