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
            <a class="navbar-brand" href="#"><i class="fas fa-tree"></i> Family Tree Admin</a>
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
                            Sign In
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-5">
  <div class="card">
    <div class="card-header text-center" style="background-color: powderblue;">
      <h3 class="fw-bold mt-2"> Registration </h3>
    </div>
    <div class="card-body p-4">
      <!-- Progress Tracker -->
      <div class="progress mb-4">
        <div class="progress-bar" id="progressBar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <!-- Step Content -->
      <form id="multiStepForm">
        <!-- Step 1 -->
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
                        <input type="radio" name="elder" value="yes"> Yes
                    </label>
                    <label>
                        <input type="radio" name="elder" value="no"> No
                    </label>
                </div>
            </div>

            <!-- Field for "Yes" -->
            <div id="yesField" class="conditional-field">
                <div class="mb-3">
                    <label for="elderDetailsYes" class="form-label"><h6>Your Mobile No.</h6></label>
                    <input type="text" id="elderDetailsYes" class="form-control" placeholder="Mobile Number">
                </div>
            
                <div class="mb-3">
                    <label for="elderDetailsYes" class="form-label"><h6>Password</h6></label>
                    <input type="password" id="elderDetailsYes" class="form-control" placeholder="Password">
                </div>
            </div>

            <!-- Field for "No" -->
            <div id="noField" class="conditional-field">
                <div class="mb-3">
                    <label for="elderDetailsNo" class="form-label"><h6>Elder's Mobile No.</h6></label>
                    <input type="text" id="elderDetailsNo" class="form-control" placeholder="Elser's Mobile Number">
                </div>

                <div class="mb-3">
                    <label for="elderDetailsNo" class="form-label"><h6>Your Mobile No.</h6></label>
                    <input type="text" id="elderDetailsNo" class="form-control" placeholder="Mobile Number">
                </div>
            
                <div class="mb-3">
                    <label for="elderDetailsNo" class="form-label"><h6>Password</h6></label>
                    <input type="password" id="elderDetailsNo" class="form-control" placeholder="Password">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">Next</button>
            </div>
          </div>
        </div>
        <!-- Step 2 -->
        <div class="step">
          <div class="step-header">
            <div class="step-circle">2</div>
            <h5 class="fw-bold">Personal Details</h5>
          </div>
          <div class="row">
            <div class="mb-3">
                <label for="yourname" class="form-label"><h6>Your Name</h6></label>
                <input type="text" class="form-control" id="yourname" placeholder="Enter Your Name">
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fathername" class="form-label"><h6>Father's Name</h6></label>
                    <input type="text" class="form-control" id="fathername" placeholder="Enter Father's Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="mothername" class="form-label"><h6>Mother's Name</h6></label>
                    <input type="text" class="form-control" id="mothername" placeholder="Enter Mother's Name">
                </div>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label"><h6>Surname</h6></label>
                <input type="text" class="form-control" id="surname" value="Godhani">
            </div>
            <div class="col-md-6 mt-2">
                <label for="marital_status"><h6>Marital Status</h6></label>
                <div class="mb-3">
                    <label class="mr-3">
                        <input type="radio" name="marital_status" value="married"> Married
                    </label>
                    <label class="mr-3">
                        <input type="radio" name="marital_status" value="engaged"> Engaged
                    </label>
                    <label class="mr-3">
                        <input type="radio" name="marital_status" value="unmarried"> Unmarried
                    </label>
                    <label class="mr-3">
                        <input type="radio" name="marital_status" value="window/divorcee"> Widow/ Divorcee
                    </label>
                </div>
            </div>
            <div class="col-md-12" id="spouse-name-field" style="display: none;">
                <div class="mb-3">
                    <label for="spousename" class="form-label"><h6>Husband/ Wife Name</h6></label>
                    <input type="text" class="form-control" id="spousename" placeholder="Enter Spouse Name">
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="email" class="form-label"><h6>Email</h6></label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email">
                </div>
            </div>
            <div class="col-md-6">
                <label for="gender"><h6>Gender</h6></label>
                <div class="mb-3">
                    <label class="mr-2">
                        <input type="radio" name="gender" value="male"> Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="female"> Female
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="dob" class="form-label"><h6>Date of Birth</h6></label>
                    <input type="date" class="form-control" id="dob">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="age" class="form-label"><h6>Age</h6></label>
                    <input type="text" class="form-control" id="age" placeholder="Enter Age">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="bloodGroup" class="form-label"><h6>Blood Group</h6></label>
                    <select class="form-control" id="bloodGroup">
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
                  </div>
                  
            </div>
          </div>
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-secondary" id="prevBtn" onclick="changeStep(-1)">Previous</button>
            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">Next</button>
          </div>
        </div>
        <!-- Step 3 -->
        <div class="step">
            <div class="step-header">
              <div class="step-circle">3</div>
              <h5 class="fw-bold">Resident</h5>
            </div>
            <div class="row">
              <h5>Current Address :</h5>
              <div class="mb-3">
                  <label for="currentaddress" class="form-label"><h6>Address</h6></label>
                  <input type="text" class="form-control" id="currentaddress" placeholder="Enter Your Address(Current)">
              </div>
              <div class="col-md-4">
                  <div class="mb-3">
                      <label for="district" class="form-label"><h6>District</h6></label>
                      <select name="district" id="district" class="form-control">
                        <option value="" disabled>-- Select District --</option>
                        {{-- @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ isset($events) && $events->organizer == $user->id ? 'selected' : '' }}>
                                {{ $user->first_name }}
                            </option>
                        @endforeach --}}
                    </select>
                  </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                    <label for="taluka" class="form-label"><h6>Taluka</h6></label>
                    <select name="taluka" id="taluka" class="form-control">
                        <option value="" disabled>-- Select Taluka --</option>
                        
                    </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                    <label for="village" class="form-label"><h6>Village</h6></label>
                    <select name="village" id="village" class="form-control">
                        <option value="" disabled>-- Select Village --</option>
                        
                    </select>
                </div>
              </div>
              <h5>Village Address :</h5>
              <div class="mb-3">
                  <label for="currentaddress" class="form-label"><h6>Address</h6></label>
                  <input type="text" class="form-control" id="currentaddress" placeholder="Enter Address(Village)">
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                    <label for="district" class="form-label"><h6>District</h6></label>
                    <select name="district" id="district" class="form-control">
                      <option value="" disabled>-- Select District --</option>
                      
                    </select>
                </div>
              </div>
            <div class="col-md-4">
              <div class="mb-3">
                  <label for="taluka" class="form-label"><h6>Taluka</h6></label>
                  <select name="taluka" id="taluka" class="form-control">
                      <option value="" disabled>-- Select Taluka --</option>
                      
                  </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                  <label for="village" class="form-label"><h6>Village</h6></label>
                  <select name="village" id="village" class="form-control">
                      <option value="" disabled>-- Select Village --</option>
                      
                  </select>
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
              <div class="step-circle">4</div>
              <h5 class="fw-bold">Profession</h5>
            </div>
            <div class="row">
              <div class="col-md-12">
                  <div class="mb-3">
                      <label for="education" class="form-label"><h6>Education</h6></label>
                      <select name="education" id="education" class="form-control">
                        <option value="" disabled>-- Select Education --</option>
                        
                      </select>
                  </div>
              </div>
              <div class="col-md-12 mt-2">
                <label for="profession"><h6>What are You Doing Now?</h6></label>
                <div class="mb-3">
                    <label class="mr-3">
                        <input type="radio" name="profession" value="job"> Job
                    </label>
                    <label class="mr-3">
                        <input type="radio" name="profession" value="business"> Business
                    </label>
                    <label class="mr-3">
                        <input type="radio" name="profession" value="findingjob"> Finding Jobs
                    </label>
                    <label class="mr-3">
                        <input type="radio" name="profession" value="student"> Student
                    </label>
                </div>
                <div class="mb-3" id="company-name" style="display: none;">
                    <label for="company">Company Name</label>
                    <select name="companyname" id="companyname" class="form-control">
                        <option value="" disabled>-- Select Company Name --</option>
                        
                    </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="mb-3">
                    <label for="businesscategory" class="form-label"><h6>Business Category</h6></label>
                    <select name="education" id="education" class="form-control">
                        <option value="" disabled>-- Select Education --</option>
                        
                    </select>
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
    const yesField = document.getElementById('yesField');
    const noField = document.getElementById('noField');
    const radios = document.querySelectorAll('input[name="elder"]');

    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.value === 'yes') {
                yesField.style.display = 'block';
                noField.style.display = 'none';
            } else if (radio.value === 'no') {
                noField.style.display = 'block';
                yesField.style.display = 'none';
            }
        });
    });
</script>

<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.step');
    const progressBar = document.getElementById('progressBar');

    function changeStep(step) {
        steps[currentStep].classList.remove('active-step');
        currentStep += step;
        if (currentStep < 0) currentStep = 0;
        if (currentStep >= steps.length) currentStep = steps.length - 1;
        steps[currentStep].classList.add('active-step');
        updateProgressBar();
    }

    function updateProgressBar() {
        const progress = ((currentStep + 1) / steps.length) * 100;
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute('aria-valuenow', progress);
    }
</script>
</body>
</html>
