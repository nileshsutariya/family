@include('layouts.header')
<section class="content-header">
  <div class="container-fluid">
      <div class="row">
          <div class="col-sm-6">
              <h1 class="ml-2">Profile</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Profile</li>
              </ol>
          </div>
      </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mt-3">
          <div class="card text-center shadow-sm" style="border-radius: 10px; overflow: hidden;">
              <div class="card-body">
                <div class="profile-image mb-3 mt-3">
                    <img src="{{ 
                        Auth::guard('admin')->user()->profile_photo 
                            ? asset('profile/' . Auth::guard('admin')->user()->profile_photo) 
                            : asset('profile/profile (3).jpg') 
                    }}" 
                    alt="User Image" 
                    class="rounded-circle" 
                    style="width: 90px; height: 90px; object-fit: cover; border: 2px solid #ccc;" 
                    id="profile-photo-img">
                
                    <div>
                        <a href="javascript:void(0);" onclick="document.getElementById('profilePhotoInput').click();" style="font-size: 12px;">Change Profile Photo</a>
                        <input type="file" id="profilePhotoInput" style="display: none;" onchange="updateProfilePhoto(this)" />
                    </div>
                
                    <p class="card-text text-muted text-capitalize" style="font-size: 17px;">
                        {{ Auth::guard('admin')->user()->first_name ?? 'user@example.com' }}
                        {{-- {{ Auth::guard('admin')->user()->father_name ?? 'user' }}
                        {{ Auth::guard('admin')->user()->last_name ?? 'name' }} --}}
                    </p>
                </div>
                
                  {{-- <a href="#" class="btn btn-primary btn-sm" style="border-radius: 20px;">View Profile</a> --}}
              </div>
          </div>
      </div>
      <div class="col-md-9">
        <div class="card shadow mt-3" style="border-radius: 10px;">
          <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger text-dark" style=" background: rgba(228, 75, 75, 0.2); border:none">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-container" action="{{route('admin.profile.update')}}" method="POST" id="profileForm" style="padding: 20px;">
              @csrf
              <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                      <label for="firstname" class="mt-2">First Name</label>
                      <input type="text" name="first_name" class="form-control" id="first_name" aria-describeby="usernameHelp" value="{{$admin->first_name}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="fathername" class="mt-2">Father Name</label>
                      <input type="text" name="father_name" class="form-control" id="father_name" aria-describeby="usernameHelp" value="{{$admin->father_name}}">
                      {{-- <span class="text-danger error-father_name"></span> --}}
                      {{-- @error('father_name')
                          <span class="text-danger">
                              {{ $message }}
                          </span>
                      @enderror --}}
                    </div>
                    <div class="col-md-3"> 
                      <label for="mothername" class="mt-2">Mother Name</label>
                      <input type="text" name="mother_name" class="form-control" id="mother_name" aria-describeby="usernameHelp" value="{{$admin->mother_name}}">
                    </div>
                    <div class="col-md-3">
                      <label for="lastname" class="mt-2">Last Name</label>
                      <input type="text" name="last_name" class="form-control" id="last_name" aria-describeby="usernameHelp" value="{{$admin->last_name}}">
                    </div>
                    <div class="col-md-3">
                      <label for="phno" class="mt-2">Phone No.</label>
                      <input type="text" name="ph_no" class="form-control" id="ph_no" aria-describeby="usernameHelp" value="{{$admin->ph_no}}">
                    </div>
                    <div class="col-md-3">
                      <label for="dob" class="mt-2">Date of Birth</label>
                      <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" aria-describeby="usernameHelp" value="{{$admin->date_of_birth}}">
                    </div>
                    <div class="col-md-3">
                      <label for="bloodgroup" class="mt-2">Blood Group</label>
                      <select name="blood_group" class="form-control" id="blood_group">
                        <option value="" disabled {{ old('blood_group') == '' ? 'selected' : '' }}>--Select Blood Group--</option>
                        <option value="A+" @if($admin->blood_group == 'A+') selected @endif>A+</option>
                        <option value="A-" @if($admin->blood_group == 'A-') selected @endif>A-</option>
                        <option value="B+" @if($admin->blood_group == 'B+') selected @endif>B+</option>
                        <option value="B-" @if($admin->blood_group == 'B-') selected @endif>B-</option>
                        <option value="O+" @if($admin->blood_group == 'O+') selected @endif>O+</option>
                        <option value="O-" @if($admin->blood_group == 'O-') selected @endif>O-</option>
                        <option value="AB+" @if($admin->blood_group == 'AB+') selected @endif>AB+</option>
                        <option value="AB-" @if($admin->blood_group == 'AB-') selected @endif>AB-</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="gender" class="mt-2">Gender</label>
                      <div>
                        <label class="mr-2">
                          <input type="radio" name="gender" value="male" id="gender"
                          @if($admin->gender == 'male') checked @endif> Male
                        </label>
                        <label>
                          <input type="radio" name="gender" value="female" id="gender"   
                           @if($admin->gender == 'female') checked @endif> Female
                        </label>
                      </div>
                    </div>    
                    <div class="col-md-12">
                      <label for="marital_status" class="mt-2">Marital Status</label>
                      <div>
                        <label class="mr-3" class="mt-2">
                          <input type="radio" name="marital_status" value="married" id="marital_status"
                          @if($admin->marital_status == 'married') checked @endif> Married
                        </label>
                        <label class="mr-3">
                            <input type="radio" name="marital_status" value="engaged" id="marital_status"
                            @if($admin->marital_status == 'engaged') checked @endif> Engaged
                        </label>
                        <label class="mr-3">
                            <input type="radio" name="marital_status" value="unmarried" id="marital_status"
                            @if($admin->marital_status == 'unmarried') checked @endif> Unmarried
                        </label>
                        <label class="mr-3">
                            <input type="radio" name="marital_status" value="widow/divorcee" id="marital_status"
                            @if($admin->marital_status == 'widow/divorcee') checked @endif> Widow/Divorcee
                        </label>
                      </div>
                    </div>    
                    <div class="col-md-12" id="spouse-name-field" style="display: none;">
                      <div class="mb-3 mt-2">
                          <label for="spousename" class="form-label">Husband/Wife Name</label>
                          <input type="text" name="spouse_name" class="form-control" id="spouse_name" placeholder="Enter Spouse Name" value="{{ old('spouse_name', $admin->spouse_name) }}">   
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="email" class="mt-2">Email</label>
                      <input type="email" name="email" class="form-control" id="email" aria-describeby="usernameHelp" value="{{$admin->email}}">
                    </div>  
                    <h5 class="mt-2">Current Address</h5>
                    <div class="col-md-3">
                      <label for="c_address">Address</label>
                      <input type="text" name="c_address" class="form-control" id="c_address" aria-describeby="usernameHelp" value="{{$admin->c_address}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="c_district">District</label>
                      <input type="text" name="c_district" class="form-control" id="c_district" placeholder="Enter District" value="{{$admin->c_district}}">
                      <ul id="c_district_suggestions" class="list-group mt-2"></ul>
                      @error('c_district')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                      @enderror
                    </div>
                    <div class="col-md-3"> 
                      <label for="c_taluka">Taluka</label>
                      <input type="text" name="c_taluka" class="form-control" id="c_taluka" placeholder="Enter Taluka" value="{{$admin->c_taluka}}">
                      <ul id="c_taluka_suggestions" class="list-group mt-2"></ul>
                      @error('c_taluka')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                      @enderror
                    </div>
                    <div class="col-md-3">
                      <label for="c_village">Village</label>
                      <input type="text" name="c_village" class="form-control" id="c_village" placeholder="Enter Village" value="{{$admin->c_village}}">
                      <ul id="c_village_suggestions" class="list-group mt-2"></ul>
                      @error('c_village')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                      @enderror
                    </div>
                    <h5 class="mt-2">Village Address</h5>
                    <div class="col-md-3">
                      <label for="v_address">Address</label>
                      <input type="text" name="v_address" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$admin->v_address}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="v_district">District</label>
                      <input type="text" name="v_district" class="form-control" id="v_district" placeholder="Enter District" value="{{$admin->v_district}}">
                      <ul id="v_district_suggestions" class="list-group mt-2"></ul>
                      @error('v_district')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                      @enderror
                    </div>
                    <div class="col-md-3"> 
                      <label for="v_taluka">Taluka</label>
                      <input type="text" name="v_taluka" class="form-control" id="v_taluka" placeholder="Enter Taluka" value="{{$admin->v_taluka}}">
                      <ul id="v_taluka_suggestions" class="list-group mt-2"></ul>
                      @error('v_taluka')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                      @enderror
                    </div>
                    <div class="col-md-3">
                      <label for="v_village">Village</label>
                      <input type="text" name="v_village" class="form-control" id="v_village" placeholder="Enter Village" value="{{$admin->v_village}}">
                      <ul id="v_village_suggestions" class="list-group mt-2"></ul>
                      @error('v_village')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                      @enderror         
                    </div>
                    <div class="col-md-12">
                      <label for="education" class="mt-2">Education</label>
                      <input type="text" name="education" class="form-control" id="education" placeholder="Enter Education" value="{{$admin->education}}">
                      <div id="education-suggestions" class="list-group mt-2" style="display: none;"></div>
                    </div>
                    <div class="col-md-12 mb-2">
                      <label for="col-md-12" class="mt-2">Profession</label>
                      <div>
                        <label class="mr-3">
                            <input type="radio" name="profession" value="job" id="profession"
                            @if($admin->profession == 'job') checked @endif> Job
                        </label>
                        <label class="mr-3">
                            <input type="radio" name="profession" value="business" id="profession"
                            @if($admin->profession == 'business') checked @endif> Business
                        </label>
                        <label class="mr-3">
                            <input type="radio" name="profession" value="findingjob" id="profession"
                            @if($admin->profession == 'findingjob') checked @endif> Finding Jobs
                        </label>
                        <label class="mr-3">
                            <input type="radio" name="profession" value="student" id="profession"
                            @if($admin->profession == 'student') checked @endif> Student
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12" id="company-name" style="display: none;">
                      <div>
                        <label for="companyname" class="mt-2">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="companyname" placeholder="Enter Company Name" value="{{$admin->company_name}}">
                        <ul id="company-suggestions" class="list-group mt-2"></ul>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="businesscategory" class="mt-1">Business Category</label>
                      <input type="text" name="business_category" class="form-control" id="business_category" placeholder="Enter Business Category" value="{{$admin->business_category}}">
                      <div id="business-category-suggestions" class="list-group mt-2">
                    </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block mt-3" id="saveButton">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
  $(document).ready(function() {
      $('#profileForm').on('submit', function(e) {
          e.preventDefault();

          let formData = new FormData(this);

          $.ajax({
              url: $(this).attr('action'), 
              method: $(this).attr('method'),
              data: formData,
              processData: false,
              contentType: false,
              success: function(response) {
                  if (response.success) {
                      // alert('Profile updated successfully!');
                      location.reload();
                  } else {
                      // alert('Failed to update profile. Please try again.');
                  }
              },
              error: function(xhr) {
                $('span.text-danger').text('');

                  if (xhr.status === 422) {
                      var errors = xhr.responseJSON.errors;
                      $.each(errors, function(key, error) {
                          var errorClass = '.error-' + key.replace(/\./g, '_');
                          $(errorClass).text(error[0]);
                      });
                  }
                }
          });
      });
  });
</script> --}}

<script>
    $(document).ready(function () {
      $('#profilePhotoInput').on('change', function () {
          var fileData = $(this).prop('files')[0]; 
          var formData = new FormData(); 
          formData.append('profile_photo', fileData); 
          formData.append('_token', '{{ csrf_token() }}'); 
  
          $.ajax({
              url: '{{ route("updateProfilePhoto") }}', 
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function (response) {
                  if (response.success) {
                      $('.profile-image img').attr('src', response.image_url);
                  } 
              },
          });
      });
    });
</script>

<script>
  $(document).ready(function() {
      if ($('input[name="marital_status"]:checked').val() === 'married') {
          $('#spouse-name-field').show();
      } else {
          $('#spouse-name-field input').val(''); 
      }

      $('input[name="marital_status"]').on('change', function() {
          if ($(this).val() === 'married') {
              $('#spouse-name-field').show();
          } else {
              $('#spouse-name-field').hide();
              $('#spouse-name-field input').val(''); 
          }
      });

      if ($('input[name="profession"]:checked').val() === 'job' || $('input[name="profession"]:checked').val() === 'business') {
          $('#company-name').show();
      } else {
          $('#company-name input').val(''); 
      }

      $('input[name="profession"]').on('change', function() {
          const selectedValue = $(this).val();
          if (selectedValue === 'job' || selectedValue === 'business') {
              $('#company-name').show();
          } else {
              $('#company-name').hide();
              $('#company-name input').val(''); 
          }
      });

      $('form').on('submit', function() {
          if ($('#spouse-name-field').is(':hidden')) {
              $('#spouse-name-field input').val(null);
          }
          if ($('#company-name').is(':hidden')) {
              $('#company-name input').val(null);
          }
      });
  });
</script>

<script>
  $(document).ready(function () {
      $('#business_category').on('keyup', function () {
          let query = $(this).val().trim();

          if (query.length > 0) {
              $.ajax({
                  url: "{{ route('business.category.suggestions') }}", // Laravel route
                  method: "GET",
                  data: { query: query },
                  success: function (data) {
                      let suggestionsBox = $('#business-category-suggestions');
                      suggestionsBox.empty(); 

                      if (data.length > 0) {
                          data.forEach(function (item) {
                              suggestionsBox.append(`<a href="#" class="list-group-item list-group-item-action suggestion-item">${item}</a>`);
                          });
                      } else {
                          suggestionsBox.append(`<div class="list-group-item">No Result Found</div>`);
                      }
                      suggestionsBox.show();
                  },
                  error: function (xhr, status, error) {
                      console.error('Error:', error);
                      $('#business-category-suggestions').hide();
                  }
              });
          } else {
              $('#business-category-suggestions').hide();
          }
      });

      $(document).on('click', '.suggestion-item', function (e) {
          e.preventDefault();
          $('#business_category').val($(this).text());
          $('#business-category-suggestions').hide();
      });

      $(document).click(function (e) {
          if (!$(e.target).closest('#business_category, #business-category-suggestions').length) {
              $('#business-category-suggestions').hide();
          }
      });
  });

  $(document).ready(function () {
      $('#companyname').on('keyup', function () {
          let query = $(this).val();

          if (query.length > 0) {
              $.ajax({
                  url: "{{ route('company.suggestions') }}",
                  method: "GET",
                  data: { query: query },
                  success: function (data) {
                      let suggestionsBox = $('#company-suggestions');
                      suggestionsBox.empty(); 

                      if (data.length > 0) {
                          data.forEach(function (item) {
                              suggestionsBox.append(`<a href="#" class="list-group-item list-group-item-action suggestion-item">${item}</a>`);
                          });
                      } else {
                          suggestionsBox.append(`<div class="list-group-item">No Result Found</div>`);
                      }
                      suggestionsBox.show();
                  },
                  error: function () {
                      $('#company-suggestions').hide();
                  }
              });
          } else {
              $('#company-suggestions').hide(); 
          }
      });

      $(document).on('click', '.suggestion-item', function (e) {
          e.preventDefault();
          $('#companyname').val($(this).text());
          $('#company-suggestions').hide();
      });

      $(document).click(function (e) {
          if (!$(e.target).closest('#companyname, #company-suggestions').length) {
              $('#company-suggestions').hide();
          }
      });
  });


  $(document).ready(function () {
      $('#education').on('keyup', function () {
          let query = $(this).val().trim();

          if (query.length > 0) {
              $.ajax({
                  url: "{{ route('education.suggestions') }}",
                  method: "GET",
                  data: { query: query },
                  success: function (data) {
                      console.log("Suggestions received:", data);
                      let suggestionsBox = $('#education-suggestions');
                      suggestionsBox.empty(); 

                      if (data.length > 0) {
                          data.forEach(function (item) {
                              suggestionsBox.append(`<a href="#" class="list-group-item list-group-item-action suggestion-item">${item}</a>`);
                          });
                      } else {
                          suggestionsBox.append(`<div class="list-group-item">No Result Found</div>`);
                      }
                      suggestionsBox.show();
                  },
                  error: function (xhr, status, error) {
                      console.error('Error:', error);
                      $('#education-suggestions').hide();
                  }
              });
          } else {
              $('#education-suggestions').hide();
          }
      });

      $(document).on('click', '.suggestion-item', function (e) {
          e.preventDefault();
          $('#education').val($(this).text());
          $('#education-suggestions').hide();
      });

      $(document).click(function (e) {
          if (!$(e.target).closest('#education, #education-suggestions').length) {
              $('#education-suggestions').hide();
          }
      });
  });

  $(document).ready(function () {
      function fetchSuggestions(inputId, suggestionsId, url) {
          $(`#${inputId}`).on('keyup', function () {
              let query = $(this).val();
              if (query.length > 0) { 
                  $.ajax({
                      url: url,
                      type: 'GET',
                      data: { query: query },
                      success: function (data) {
                          let suggestions = '';
                          if (data.length > 0) {
                              data.forEach(function (item) {
                                  suggestions += `<li class="list-group-item suggestion-item">${item}</li>`;
                              });
                          } else {
                              suggestions = '<li class="list-group-item text-muted">No results found</li>';
                          }
                          $(`#${suggestionsId}`).html(suggestions).show();
                      }
                  });
              } else {
                  $(`#${suggestionsId}`).hide();
              }
          });

          $(document).on('click', `#${suggestionsId} .suggestion-item`, function () {
              $(`#${inputId}`).val($(this).text());
              $(`#${suggestionsId}`).hide();
          });

          $(document).click(function (e) {
              if (!$(e.target).closest(`#${inputId}, #${suggestionsId}`).length) {
                  $(`#${suggestionsId}`).hide();
              }
          });
      }

      fetchSuggestions('c_district', 'c_district_suggestions', '{{ route("district.suggestions") }}');
      fetchSuggestions('c_taluka', 'c_taluka_suggestions', '{{ route("taluka.suggestions") }}');
      fetchSuggestions('c_village', 'c_village_suggestions', '{{ route("village.suggestions") }}');
  });
</script>

<script>
  $(document).ready(function () {
      function fetchSuggestions(inputId, suggestionsId, url) {
          $(`#${inputId}`).on('keyup', function () {
              let query = $(this).val();
              if (query.length > 0) { 
                  $.ajax({
                      url: url,
                      type: 'GET',
                      data: { query: query },
                      success: function (data) {
                          let suggestions = '';
                          if (data.length > 0) {
                              data.forEach(function (item) {
                                  suggestions += `<li class="list-group-item suggestion-item">${item}</li>`;
                              });
                          } else {
                              suggestions = '<li class="list-group-item text-muted">No results found</li>';
                          }
                          $(`#${suggestionsId}`).html(suggestions).show();
                      }
                  });
              } else {
                  $(`#${suggestionsId}`).hide();
              }
          });

          $(document).on('click', `#${suggestionsId} .suggestion-item`, function () {
              $(`#${inputId}`).val($(this).text());
              $(`#${suggestionsId}`).hide();
          });

          $(document).click(function (e) {
              if (!$(e.target).closest(`#${inputId}, #${suggestionsId}`).length) {
                  $(`#${suggestionsId}`).hide();
              }
          });
      }

      fetchSuggestions('v_district', 'v_district_suggestions', '{{ route("district.suggestions") }}');
      fetchSuggestions('v_taluka', 'v_taluka_suggestions', '{{ route("taluka.suggestions") }}');
      fetchSuggestions('v_village', 'v_village_suggestions', '{{ route("village.suggestions") }}');
  });
</script>

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

{{-- <script>
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
</script> --}}

@include('layouts.footer')
