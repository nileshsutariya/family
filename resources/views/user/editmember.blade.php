@include('layouts.userheader')
<section class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Detail</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Detail</li>
              </ol>
          </div>
      </div>
  </div>
</section>
<a href="{{route('family.user')}}" class="btn btn-sm btn-primary ml-4 mb-3"> 
  <i class="bi bi-arrow-left me-1"></i> Back
</a>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card shadow" style="border-radius: 10px;">
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-dngaer text-dark" style="background: rgba(228, 75, 75, 0.2); border:none;">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form class="form-container" action="{{route('user.update')}}" method="POST" style="padding: 20px;">
              @csrf 
              <div class="form-group">
                <div class="row">
                  <input type="hidden" name="id" value="{{$users->id}}">
                  <div class="col-md-3">
                    <label for="firstname">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->first_name}}">
                    @error('first_name')
                      <span class="text-danger">
                          {{ $message }}
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-3"> 
                    <label for="fathername">Father Name</label>
                    <input type="text" name="father_name" class="form-control" id="Inputuser2" aria-describeby="usernameHelp" value="{{$users->father_name}}">
                    
                  </div>
                  <div class="col-md-3"> 
                    <label for="mothername">Mother Name</label>
                    <input type="text" name="mother_name" class="form-control" id="Inputuser2" aria-describeby="usernameHelp" value="{{$users->mother_name}}">
                   
                  </div>
                  <div class="col-md-3">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="Inputuser3" aria-describeby="usernameHelp" value="{{$users->last_name}}">
                    
                  </div>
                  <div class="col-md-3">
                    <label for="phno" class="mt-3">Phone No.</label>
                    <input type="text" name="ph_no" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->ph_no}}">
                    
                  </div>
                  <div class="col-md-3">
                    <label for="dob" class="mt-3">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->date_of_birth}}">
                    
                  </div>
                  <div class="col-md-3">
                    <label for="bloodgroup" class="mt-3">Blood Group</label>
                    <select name="blood_group" class="form-control" id="bloodGroup">
                      <option value="" disabled {{ old('blood_group') == '' ? 'selected' : '' }}>--Select Blood Group--</option>
                      <option value="A+" @if($users->blood_group == 'A+') selected @endif>A+</option>
                      <option value="A-" @if($users->blood_group == 'A-') selected @endif>A-</option>
                      <option value="B+" @if($users->blood_group == 'B+') selected @endif>B+</option>
                      <option value="B-" @if($users->blood_group == 'B-') selected @endif>B-</option>
                      <option value="O+" @if($users->blood_group == 'O+') selected @endif>O+</option>
                      <option value="O-" @if($users->blood_group == 'O-') selected @endif>O-</option>
                      <option value="AB+" @if($users->blood_group == 'AB+') selected @endif>AB+</option>
                      <option value="AB-" @if($users->blood_group == 'AB-') selected @endif>AB-</option>
                    </select>
                    
                  </div>
                  <div class="col-md-3">
                    <label for="gender" class="mt-3">Gender</label>
                    <div>
                      <label class="mr-2">
                        <input type="radio" name="gender" value="male"
                        @if($users->gender == 'male') checked @endif> Male
                      </label>
                      <label>
                        <input type="radio" name="gender" value="female"       
                         @if($users->gender == 'female') checked @endif> Female
                      </label>
                    </div>
                    
                  </div>   
                  <div class="col-md-12">
                    <label for="marital_status" class="mt-3">Marital Status</label>
                    <div>
                      <label class="mr-3">
                        <input type="radio" name="marital_status" value="married"
                        @if($users->marital_status == 'married') checked @endif> Married
                      </label>
                      <label class="mr-3">
                          <input type="radio" name="marital_status" value="engaged"
                          @if($users->marital_status == 'engaged') checked @endif> Engaged
                      </label>
                      <label class="mr-3">
                          <input type="radio" name="marital_status" value="unmarried"
                          @if($users->marital_status == 'unmarried') checked @endif> Unmarried
                      </label>
                      <label class="mr-3">
                          <input type="radio" name="marital_status" value="widow/divorcee"
                          @if($users->marital_status == 'widow/divorcee') checked @endif> Widow/Divorcee
                      </label>
                    </div>
                  </div>    
                  <div class="col-md-12" id="spouse-name-field" style="display: none;">
                    <div class="mb-3 mt-2">
                        <label for="spousename" class="form-label">Husband/Wife Name</label>
                        <input type="text" name="spouse_name" class="form-control" id="spousename" placeholder="Enter Spouse Name" value="{{$users->spouse_name}}">
                        
                    </div>
                  </div>
                  <div class="col-md-12" class="mt-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->email}}">
                  </div>      
                  <h5 class="mt-3">Current Address</h5>
                  <div class="col-md-3">
                    <label for="c_address">Address</label>
                    <input type="text" name="c_address" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->c_address}}">
                    
                  </div>
                  <div class="col-md-3"> 
                    <label for="c_district">District</label>
                    <input type="text" name="c_district" class="form-control" id="c_district" placeholder="Enter District" value="{{$users->c_district}}">
                    <ul id="c_district_suggestions" class="list-group mt-2"></ul>
                    @error('c_district')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                  </div>
                  <div class="col-md-3"> 
                    <label for="c_taluka">Taluka</label>
                    <input type="text" name="c_taluka" class="form-control" id="c_taluka" placeholder="Enter Taluka" value="{{$users->c_taluka}}">
                    <ul id="c_taluka_suggestions" class="list-group mt-2"></ul>
                    @error('c_taluka')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                  </div>
                  <div class="col-md-3">
                    <label for="c_village">Village</label>
                    <input type="text" name="c_village" class="form-control" id="c_village" placeholder="Enter Village" value="{{$users->c_village}}">
                    <ul id="c_village_suggestions" class="list-group mt-2"></ul>
                    @error('c_village')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                  </div>
                  <h5 class="mt-3">Village Address</h5>
                  <div class="col-md-3">
                    <label for="v_address">Address</label>
                    <input type="text" name="v_address" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->v_address}}">
                    @error('v_address')
                      <span class="text-danger">
                          {{ $message }}
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-3"> 
                    <label for="v_district">District</label>
                    <input type="text" name="v_district" class="form-control" id="v_district" placeholder="Enter District" value="{{$users->v_district}}">
                    <ul id="v_district_suggestions" class="list-group mt-2"></ul>
                    @error('v_district')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                  </div>
                  <div class="col-md-3"> 
                    <label for="v_taluka">Taluka</label>
                    <input type="text" name="v_taluka" class="form-control" id="v_taluka" placeholder="Enter Taluka" value="{{$users->v_taluka}}">
                    <ul id="v_taluka_suggestions" class="list-group mt-2"></ul>
                    @error('v_taluka')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                  </div>
                  <div class="col-md-3">
                    <label for="v_village">Village</label>
                    <input type="text" name="v_village" class="form-control" id="v_village" placeholder="Enter Village" value="{{$users->v_village}}">
                    <ul id="v_village_suggestions" class="list-group mt-2"></ul>
                    @error('v_village')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror   
                  </div>
                  <div class="col-md-12">
                    <label for="education" class="mt-3">Education</label>
                    <input type="text" name="education" class="form-control" id="education" placeholder="Enter Education" value="{{$users->education}}">
                    <div id="education-suggestions" class="list-group mt-2" style="display: none;"></div>
                  </div>
                  <div class="">
                    <label for="col-md-12" class="mt-3">Profession</label>
                    <div>
                      <label class="mr-3">
                          <input type="radio" name="profession" value="job"
                          @if($users->profession == 'job') checked @endif> Job
                      </label>
                      <label class="mr-3">
                          <input type="radio" name="profession" value="business"
                          @if($users->profession == 'business') checked @endif> Business
                      </label>
                      <label class="mr-3">
                          <input type="radio" name="profession" value="findingjob"
                          @if($users->profession == 'findingjob') checked @endif> Finding Jobs
                      </label>
                      <label class="mr-3">
                          <input type="radio" name="profession" value="student"
                          @if($users->profession == 'student') checked @endif> Student
                      </label>
                    </div>
                    
                  </div>
                  <div class="col-md-12" id="company-name" style="display: none;">
                    <div>
                      <label for="companyname">Company Name</label>
                      <input type="text" name="company_name" class="form-control" id="companyname" placeholder="Enter Company Name" value="{{$users->company_name}}">
                      <ul id="company-suggestions" class="list-group mt-2"></ul>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="businesscategory" class="mt-2 ml-1">Business Category</label>
                    <input type="text" name="business_category" class="form-control" id="business_category" placeholder="Enter Business Category" value="{{$users->business_category}}">
                      <div id="business-category-suggestions" class="list-group mt-2">
                    </div>
                  </div>
              </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block mt-2">Save Changes</button>
            </form>                              

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                  url: "{{ route('business.category.suggestions') }}", 
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
@include('layouts.footer')