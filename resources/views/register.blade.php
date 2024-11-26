<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      background: #f7f9fc;
      font-family: 'Poppins', sans-serif;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .progress-bar {
      background: linear-gradient(to right, #00c6ff, powderblue);
      transition: width 0.5s ease;
    }
    .step {
      display: none;
      animation: fadeIn 0.5s ease-in-out;
    }
    .active-step {
      display: block;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    .step-header {
      text-align: center;
    }
    .step-header .step-circle {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #007bff;
      color: #fff;
      line-height: 40px;
      font-size: 18px;
      margin: 0 auto 10px;
    }
    .btn-primary {
      background: linear-gradient(to right, #007bff, #00c6ff);
      border: none;
    }
    .btn-primary:hover {
      background: linear-gradient(to right, #0056b3, #0083c3);
    }
    /* Hide the conditional fields by default */
    .conditional-field {
      display: none;
    }
  </style>
</head>
<body>
    <nav class="navbar content navbar-expand-lg navbar-light bg-light">
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
    <div class="container mt-3 mb-3">
        <div class="card">
            <div class="card-header text-center" style="background-color: powderblue; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h3 class="fw-bold mt-2"> Registration </h3>
            </div>
            <div class="card-body p-4">
                <div class="progress mb-4">
                    <div class="progress-bar" id="progressBar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="multiStepForm" action="{{route('store')}}" method="POST">
                    @csrf
                    <div class="step active-step">
                        <div class="step-header">
                            <div class="step-circle">1</div>
                            <h5 class="fw-bold">Personal Information</h5>
                        </div>
                        <div class = "row">
                            <div class="col-md-12 mb-2 text-center">
                                <label for="" class="mt-3"><h6>Are You an Elder?</h6></label>
                                <div>
                                    <label class="mr-2">
                                        <input type="radio" name="elder" value="yes" class="elder-radio"
                                        {{-- @if(old('elder') == 'yes') checked @endif --}}
                                        > Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="elder" value="no" class="elder-radio"
                                        {{-- @if(old('elder') == 'no') checked @endif --}}
                                        > No
                                    </label>
                                </div>
                                @error('elder')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div id="noField" class="conditional-field" style="display: none;">
                                <div class="mb-3">
                                    <label for="elder_ph_no" class="form-label">
                                        <h6>Elder's Mobile No.</h6>
                                    </label>
                                    <input type="text" name="elder_ph_no" id="elder_ph_no" class="form-control" placeholder="Elder's Mobile Number" value="{{old('elder_ph_no')}}">
                                </div>
                                @error('elder_ph_no')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ph_no" class="form-label">
                                    <h6>Your Mobile No.</h6>
                                </label>
                                <input type="text" name="ph_no" id="ph_no" class="form-control" placeholder="Mobile Number" value="{{old('ph_no')}}">
                                @error('ph_no')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <h6>Password</h6>
                                </label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                                @error('password')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-header">
                            <div class="step-circle">2</div>
                            <h5 class="fw-bold">Personal Details</h5>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="yourname" class="form-label"><h6>Your Name</h6></label>
                                <input type="text" name="first_name" class="form-control" id="yourname" placeholder="Enter Your Name" value="{{old('first_name')}}">
                                @error('first_name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fathername" class="form-label"><h6>Father's Name</h6></label>
                                    <input type="text" name="father_name" class="form-control" id="fathername" placeholder="Enter Father's Name" value="{{old('father_name')}}">
                                    @error('father_name')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mothername" class="form-label"><h6>Mother's Name</h6></label>
                                    <input type="text" name="mother_name" class="form-control" id="mothername" placeholder="Enter Mother's Name" value="{{old('mother_name')}}">
                                    @error('mother_name')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label"><h6>Surname</h6></label>
                                <input type="text" name="last_name" class="form-control" id="surname" value="Godhani">
                                @error('last_name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="marital_status"><h6>Marital Status</h6></label>
                                <div class="">
                                    <label class="mr-3">
                                        <input type="radio" name="marital_status" value="married"
                                        @if(old('marital_status') == 'married') checked @endif> Married
                                    </label>
                                    <label class="mr-3">
                                        <input type="radio" name="marital_status" value="engaged"
                                        @if(old('marital_status') == 'engaged') checked @endif> Engaged
                                    </label>
                                    <label class="mr-3">
                                        <input type="radio" name="marital_status" value="unmarried"
                                        @if(old('marital_status') == 'unmarried') checked @endif> Unmarried
                                    </label>
                                    <label class="mr-3">
                                        <input type="radio" name="marital_status" value="widow/divorcee"
                                        @if(old('marital_status') == 'widow/divorcee') checked @endif> Widow/ Divorcee
                                    </label>
                                </div>
                                @error('marital_status')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12" id="spouse-name-field" style="display: none;">
                                <div class="mb-3">
                                    <label for="spousename" class="form-label"><h6>Husband/ Wife Name</h6></label>
                                    <input type="text" name="spouse_name" class="form-control" id="spousename" placeholder="Enter Spouse Name">
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-4 mt-3">
                                    <label for="email" class="form-label"><h6>Email</h6></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="gender"><h6>Gender</h6></label>
                                <div class="">
                                    <label class="mr-2">
                                        <input type="radio" name="gender" value="male"
                                        @if(old('gender') == 'male') checked @endif> Male
                                    </label>
                                    <label>
                                        <input type="radio" name="gender" value="female"
                                        @if(old('gender') == 'female') checked @endif> Female
                                    </label>
                                </div>
                                @error('gender')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dob" class="form-label"><h6>Date of Birth</h6></label>
                                    <input type="date" name="date_of_birth" class="form-control" id="dob" value="{{old('date_of_birth')}}">
                                    @error('date_of_birth')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="bloodGroup" class="form-label"><h6>Blood Group</h6></label>
                                    <select name="blood_group" class="form-control" id="bloodGroup">
                                        <option value="" disabled selected>--Select Blood Group--</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                    @error('blood_group')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" id="prevBtn" onclick="changeStep(-1)">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">Next</button>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-header">
                            <div class="step-circle">3</div>
                            <h5 class="fw-bold">Resident</h5>
                        </div>
                        <div class="row">
                            <h5>Current Address :</h5>
                            <div class="mb-3">
                                <label for="currentaddress" class="form-label"><h6>Address</h6></label>
                                <input type="text" name="c_address" class="form-control" id="currentaddress" placeholder="Enter Your Address(Current)" value="{{old('c_address')}}">
                                @error('c_address')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="district" class="form-label"><h6>District</h6></label>
                                    <select name="c_district" id="district" class="form-control mt-1">
                                        <option value="" selected disabled>-- Select District --</option>
                                        @foreach ($district as $districts)
                                            <option value="{{$districts->district}}"
                                                @if(old('c_district') == $districts->district) selected @endif>
                                                {{ $districts->district }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('c_district')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="taluka" class="form-label"><h6>Taluka</h6></label>
                                    <select name="c_taluka" id="taluka" class="form-control mt-1">
                                        <option value="" selected disabled>-- Select Taluka --</option>
                                        @foreach ($taluka as $talukas)
                                            <option value="{{$talukas->taluka}}"
                                                @if(old('c_taluka') == $talukas->taluka) selected @endif>
                                                {{$talukas->taluka}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('c_taluka')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="village" class="form-label"><h6>Village</h6></label>
                                    <select name="c_village" id="village" class="form-control mt-1">
                                        <option value="" selected disabled>-- Select Village --</option>
                                        @foreach ($village as $villages)
                                            <option value="{{$villages->village}}"
                                                @if(old('c_village') == $villages->village) selected @endif>
                                                {{$villages->village}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('c_village')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <h5 class="mt-3">Village Address :</h5>
                            <div class="mb-3">
                                <label for="villageaddress" class="form-label"><h6>Address</h6></label>
                                <input type="text" name="v_address" class="form-control" id="villageaddress" placeholder="Enter Address(Village)" value="{{old('v_address')}}">
                                @error('v_address')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="district" class="form-label"><h6>District</h6></label>
                                    <select name="v_district" id="district" class="form-control mt-1">
                                        <option value="" selected disabled>-- Select District --</option>
                                        @foreach ($district as $districts)
                                            <option value="{{$districts->district}}"
                                                @if(old('v_district') == $districts->district) selected @endif>
                                                {{ $districts->district }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('v_district')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="taluka" class="form-label"><h6>Taluka</h6></label>
                                    <select name="v_taluka" id="taluka" class="form-control mt-1">
                                        <option value="" selected disabled>-- Select Taluka --</option>
                                        @foreach ($taluka as $talukas)
                                            <option value="{{$talukas->taluka}}"
                                                @if(old('v_taluka') == $talukas->taluka) selected @endif>
                                                {{$talukas->taluka}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('v_taluka')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="village" class="form-label"><h6>Village</h6></label>
                                    <select name="v_village" id="village" class="form-control mt-1">
                                        <option value="" selected disabled>-- Select Village --</option>
                                        @foreach ($village as $villages)
                                            <option value="{{$villages->village}}"
                                                @if(old('v_village') == $villages->village) selected @endif>
                                                {{$villages->village}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('v_village')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" id="prevBtn" onclick="changeStep(-1)">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">Next</button>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-header">
                            <div class="step-circle">4</div>
                            <h5 class="fw-bold">Profession</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="education" class="form-label"><h6>Education</h6></label>
                                    <select name="education" id="education" class="form-control mt-1">
                                        <option value="" selected disabled>-- Select Education --</option>
                                        @foreach ($education as $edu)
                                            <option value="{{$edu->education}}"
                                                @if(old('education') == $edu->education) selected @endif>
                                                {{$edu->education}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="profession"><h6>What are You Doing Now?</h6></label>
                                <div class="">
                                    <label class="mr-3">
                                        <input type="radio" name="profession" value="job"
                                        @if(old('profession') == 'job') checked @endif> Job
                                    </label>
                                    <label class="mr-3">
                                        <input type="radio" name="profession" value="business"
                                        @if(old('profession') == 'business') checked @endif> Business
                                    </label>
                                    <label class="mr-3">
                                        <input type="radio" name="profession" value="findingjob"
                                        @if(old('profession') == 'findingjob') checked @endif> Finding Jobs
                                    </label>
                                    <label class="mr-3">
                                        <input type="radio" name="profession" value="student"
                                        @if(old('profession') == 'student') checked @endif> Student
                                    </label>
                                </div>
                                @error('profession')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                                <div class="mb-3" id="company-name" style="display: none;">
                                    <label for="company">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" id="companyname" placeholder="Enter Company Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 mt-3">
                                    <label for="businesscategory" class="form-label"><h6>Business Category</h6></label>
                                    <input type="text" name="business_category" class="form-control" id="business_category" placeholder="Enter Business Category">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" id="prevBtn" onclick="changeStep(-1)">Previous</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="marital_status"]').on('change', function() {
                if ($(this).val() === 'married') {
                    $('#spouse-name-field').show();
                } else {
                    $('#spouse-name-field').hide();
                }
            });
        });

        $(document).ready(function() {
            $('input[name="profession"]').on('change', function() {
                const selectedValue = $(this).val();
                if (selectedValue === 'job' || selectedValue === 'business') {
                    $('#company-name').show();
                } else {
                    $('#company-name').hide();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const elderRadios = document.querySelectorAll('.elder-radio');
            const noField = document.getElementById('noField');

            elderRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value === 'no') {
                        noField.style.display = 'block'; 
                    } else {
                        noField.style.display = 'none'; 
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const spouseField = document.getElementById('spouse-name-field');
            const maritalRadios = document.getElementsByName('marital_status');

            document.querySelectorAll('input[name="marital_status"]').forEach((radio) => {
                radio.addEventListener('change', () => {
                    document.getElementById('spouse-name-field').style.display = 
                        radio.value === 'married' ? 'block' : 'none';
                });
            });
        });
    </script>
    <script>
        function changeStep(step) {
            const steps = document.querySelectorAll('.step');
            const progressBar = document.getElementById('progressBar');
            let currentStepIndex = Array.from(steps).findIndex(step => step.classList.contains('active-step'));

            steps[currentStepIndex].classList.remove('active-step');
            currentStepIndex += step;

            if (currentStepIndex < 0 || currentStepIndex >= steps.length) return;

            steps[currentStepIndex].classList.add('active-step');
            progressBar.style.width = `${((currentStepIndex + 1) / steps.length) * 100}%`;
        }
    </script>
</body>
</html>
