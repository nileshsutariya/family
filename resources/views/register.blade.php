<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title> Registration </title>

</head>
<body style="background: #e1ecf1; padding-top: 20px;">
    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-7">
                <form class="form-container shadow" action="{{route('store')}}" method="POST" style="background: #ffffff; border-radius: 15px; padding: 40px;">
                @csrf 
                    <div class="form-group">
                        <h2 class="text-center font-weight-bold mb-4"> Register </h2>
                        {{-- <div class="text-center mb-4"></div> --}}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="firstname" class="mt-3"><h6>First Name</h6></label>
                                <input type="text" name="first_name" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" placeholder="First Name" value="{{old('first_name')}}">
                                @error('first_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4"> 
                                <label for="middlename" class="mt-3"><h6>Middle Name</h6></label>
                                <input type="text" name="middle_name" class="form-control" id="Inputuser2" aria-describeby="usernameHelp" placeholder="Middle Name" value="{{old('middle_name')}}">
                                @error('middle_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="lastname" class="mt-3"><h6>Last Name</h6></label>
                                <input type="text" name="last_name" class="form-control" id="Inputuser3" aria-describeby="usernameHelp" placeholder="Last Name" value="{{old('last_name')}}">
                                @error('last_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="email" class="mt-3"><h6>Email</h6></label>
                                <input type="email" name="email" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="phno" class="mt-3"><h6>Phone No.</h6></label>
                                <input type="text" name="phone_no" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Phone Number" value="{{old('phone_no')}}">
                                @error('phone_no')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="address" class="mt-3"><h6>Address</h6></label>
                                <textarea type="text" class="form-control" id="address" name="address" placeholder="Address">{{old('address')}}</textarea>
                                @error('address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="dob" class="mt-3"><h6>Date of Birth</h6></label>
                                <input type="date" name="date_of_birth" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Date of Birth" value="{{old('date_of_birth')}}">
                                @error('date_of_birth')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="gender" class="mt-3"><h6>Gender</h6></label>
                                <div>
                                    <label class="mr-2">
                                        <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male
                                    </label>
                                    <label>
                                        <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female
                                    </label>
                                </div>
                                @error('gender')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="password" class="mt-3"><h6>Password</h6></label>
                                <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password">
                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="confirmpassword" class="mt-3"><h6>Confirm Password</h6></label>
                                <input type="password" name="confirmpassword" class="form-control" id="InputPassword1" placeholder="Confirm Password">
                                @error('confirmpassword')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="Sign up" class="btn btn-primary btn-block mt-4">Sign Up</button>
                    <div class="form-footer text-center mt-2">
                        <p> Already have an account? <a href="{{route('login')}}" style="text-decoration: none;">Sign In</a></p>
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