<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title> Registration </title>

</head>
<body style="background: #fff; padding-top: 20px;">
  <section class="container-fluid">
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-4">
        <form class="form-container" action="{{route('store')}}" method="POST" style="background: #dfdbdb; border-radius: 10px; padding: 40px;">
          @csrf
          <div class="form-group">
            <h4 class="text-center font-weight-bold mb-3"> Register </h4>
            
            <input type="text" name="first_name" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" placeholder="First Name">
            <input type="text" name="middle_name" class="form-control mb-3" id="Inputuser2" aria-describeby="usernameHelp" placeholder="Middle Name">
            <input type="text" name="last_name" class="form-control mb-3" id="Inputuser3" aria-describeby="usernameHelp" placeholder="Last Name">
            <input type="email" name="email" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Email">
            <input type="password" name="password" class="form-control mb-3" id="InputPassword1" placeholder="Password">
            <input type="password" name="confirmpassword" class="form-control mb-3" id="InputPassword1" placeholder="Confirm Password">
            <textarea type="text" class="form-control mb-3" id="address" name="address" placeholder="Address"></textarea>
            <input type="text" name="phone_no" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Phone Number">
            <input type="date" name="date_of_birth" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Date of Birth">
            <label>
                <input type="radio" name="gender" value="male"> Male
            </label>
            <label>
                <input type="radio" name="gender" value="female"> Female
            </label>
          </div>
          <button type="Sign up" class="btn btn-primary btn-block mt-2">Sign Up</button>
          <div class="form-footer text-center mt-2">
            <p> Already have an account? <a href="{{route('loginform')}}">Sign In</a></p>
          </div>
        </form>
      </section>
    </section>
  </section>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
