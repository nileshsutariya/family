@include('layouts.userheader')
<section id="loading">
    <div id="loading-content"></div>
</section>
<section class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
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
            <div class="col-md-3">
                <fieldset class="profile-card">
                    <legend>
                        <div class="profile-image">
                            @php
                                $firstName = ucfirst(Auth::guard('web')->user()->first_name ?? '');
                                $lastName = ucfirst(Auth::guard('web')->user()->last_name ?? '');
                                $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                                
                                $profilePhoto = Auth::guard('web')->user()->profile_photo
                                    ? asset('profile/' . Auth::guard('web')->user()->profile_photo)
                                    : Avatar::create($initials)
                                        ->setDimension(90, 90)
                                        ->setFontSize(35)
                                        // ->setBackground('#E4E6EB')
                                        // ->setForeground('#333')
                                        ->toSvg();
                            @endphp
                            <div class="position-relative">
                                <img 
                                    src="{{ Auth::guard('web')->user()->profile_photo ? asset('profile/' . Auth::guard('web')->user()->profile_photo) : 'data:image/svg+xml;base64,' . base64_encode($profilePhoto) }}" 
                                    alt="User Profile"
                                    class="rounded-circle"
                                    style="width: 90px; height: 90px; object-fit: cover; border: 2px solid #ccc;"
                                    id="profile-photo-img">
                                <div class="edit-icon" onclick="document.getElementById('profilePhotoInput').click();">
                                    <i class="fa-solid fa-pencil"></i>
                                </div>
                            </div>
                            <input type="file" id="profilePhotoInput" style="display: none;" />
                        </div>
                    </legend>
                    @if($users->profile_photo !== null)
                        <div style="text-align: center; margin-top: 10px;">
                            <a href="javascript:void(0);" 
                                onclick="removeProfilePhoto()" 
                                style="font-size: 12px;">Remove Profile Photo</a>
                        </div>
                        <form id="removeProfilePhotoForm" method="POST" action="{{ route('profile.photo.remove') }}" style="display: none;">
                            @csrf
                        </form>
                    @endif
                    <div class="text-center mt-2">
                        <h3 style="font-size: 18px; font-weight: bold; color: #2f3542;">
                            {{ $firstName }} 
                            {{-- {{ Auth::guard('web')->user()->father_name ?? '' }}  --}}
                            {{ $lastName }}
                        </h3>
                        <p class="text-muted" style="font-size: 14px; margin: 0;">Member</p>
                    </div>
                </fieldset>    
            </div>
            <div class="col-md-9 mb-3">
                <div class="card shadow" style="border-radius: 10px;">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger text-dark" style=" background: rgba(228, 75, 75, 0.2); border:none;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-container" action="{{route('profile.update')}}" method="POST" style="padding: 20px;">
                        @csrf 
                        <div class="form-group">
                            <div class="row">
                            <input type="hidden" value="{{$users->id}}">
                                <div class="col-md-3">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->first_name}}">
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
                                    <label for="phno" class="mt-2">Phone No.</label>
                                    <input type="text" name="ph_no" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->ph_no}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="dob" class="mt-2">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->date_of_birth}}">
                                </div>
                                <div class="col-md-3">
                                <label for="bloodgroup" class="mt-2">Blood Group</label>
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
                                <label for="gender" class="mt-2">Gender</label>
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
                                <label for="marital_status" class="mt-2">Marital Status</label>
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
                                <div class="col-md-12">
                                    <label for="email" class="mt-2">Email</label>
                                    <input type="email" name="email" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->email}}">
                                </div>      
                                <h5 class="mt-2">Current Address</h5>
                                <div class="col-md-3">
                                    <label for="c_address">Address</label>
                                    <input type="text" name="c_address" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->c_address}}">
                                </div>
                                <div class="col-md-3"> 
                                    <label for="c_district">District</label>
                                    <select class="form-control select2" name="c_district" id="c_district" style="width: 100%;">
                                        <option value="" disabled selected>-- District --</option>
                                        @foreach($cDistricts as $district)
                                            <option value="{{ $district->id }}"
                                            {{ isset($users->c_district) && $users->c_district == $district->district ? 'selected' : '' }}
                                            {{ old('c_district') == $district->id ? 'selected' : '' }}
                                            >
                                                {{ $district->district }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('c_district')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3"> 
                                    <label for="c_taluka">Taluka</label>
                                    <select class="form-control select2" name="c_taluka" id="c_taluka" style="width: 100%;">
                                        <option value="" disabled selected>-- Taluka --</option>
                                        @foreach($cTalukas as $taluka)
                                            <option value="{{ $taluka->id }}"
                                            {{ old('c_taluka') == $taluka->id ? 'selected' : '' }}
                                            {{ isset($users->c_taluka) && $users->c_taluka == $taluka->taluka ? 'selected' : '' }}
                                            >
                                                {{ $taluka->taluka }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('c_taluka')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="c_village">Village</label>
                                    <select class="form-control select2" name="c_village" id="c_village" style="width: 100%;">
                                        <option value="" disabled selected>-- Village --</option>
                                        @foreach($cVillages as $village)
                                            <option value="{{ $village->id }}" 
                                            {{ old('c_village') == $village->id ? 'selected' : '' }}
                                            {{ isset($users->c_village) && $users->c_village == $village->village ? 'selected' : '' }}
                                            >
                                                {{ $village->village }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('c_village')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <h5 class="mt-2">Village Address</h5>
                                <div class="col-md-3">
                                    <label for="v_address">Address</label>
                                    <input type="text" name="v_address" class="form-control" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->v_address}}">
                                </div>
                                <div class="col-md-3"> 
                                    <label for="v_district">District</label>
                                    <select class="form-control select2" name="v_district" id="v_district" style="width: 100%;">
                                        <option value="" disabled selected>-- District --</option>
                                        @foreach($vDistricts as $district)
                                            <option value="{{ $district->id }}"
                                            {{ isset($users->v_district) && $users->v_district == $district->district ? 'selected' : '' }}
                                            {{ old('v_district') == $district->id ? 'selected' : '' }}
                                            >
                                                {{ $district->district }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('v_district')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3"> 
                                    <label for="v_taluka">Taluka</label>
                                    <select class="form-control select2" name="v_taluka" id="v_taluka" style="width: 100%;">
                                        <option value="" disabled selected>-- Taluka --</option>
                                        @foreach($vTalukas as $taluka)
                                            <option value="{{ $taluka->id }}"
                                            {{ old('v_taluka') == $taluka->id ? 'selected' : '' }}
                                            {{ isset($users->v_taluka) && $users->v_taluka == $taluka->taluka ? 'selected' : '' }}
                                            >
                                                {{ $taluka->taluka }}
                                            </option>xz
                                        @endforeach
                                    </select>
                                    @error('v_taluka')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="v_village">Village</label>
                                    <select class="form-control select2" name="v_village" id="v_village" style="width: 100%;">
                                        <option value="" disabled selected>-- Village --</option>
                                        @foreach($vVillages as $village)
                                            <option value="{{ $village->id }}" 
                                                {{ old('v_village') == $village->id ? 'selected' : '' }}
                                                {{ isset($users->v_village) && $users->v_village == $village->village ? 'selected' : '' }}>
                                                {{ $village->village }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('v_village')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror 
                                </div>
                                <div class="col-md-12">
                                    <label for="education" class="mt-2">Education</label>
                                    <input type="text" name="education" class="form-control" id="education" placeholder="Enter Education" value="{{$users->education}}">
                                    <div id="education-suggestions" class="list-group mt-2" style="display: none;"></div>
                                </div>
                                <div class="">
                                    <label for="col-md-12" class="mt-2">Profession</label>
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
                        <button type="submit" class="btn btn-primary btn-block mt-4">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function removeProfilePhoto() {
        document.getElementById('removeProfilePhotoForm').submit();
    }
</script>

<script>
    $(document).ready(function () {
        $('#profilePhotoInput').on('change', function () {
            var fileData = $(this).prop('files')[0]; 
            var formData = new FormData(); 
            formData.append('profile_photo', fileData); 
            formData.append('_token', '{{ csrf_token() }}'); 
    
            $.ajax({
                url: '{{ route("user.updateProfilePhoto") }}', 
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
        $('#c_district').on('change', function() {
            let districtId = $(this).val();  

            if (districtId) {
                $.ajax({
                    url: '{{ route('taluka.suggestions') }}',  
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                    },
                    data: {
                        district: districtId, 
                    },
                    success: function(response) {
                        $('#c_taluka').html('<option value="">-- Taluka --</option>');
                        response.forEach(function(taluka) {  
                            $('#c_taluka').append('<option value="' + taluka.id + '">' + taluka.taluka + '</option>');
                        });
                    },
                    error: function() {
                        alert('An error occurred while fetching the talukas.');
                    },
                });
            } else {
                $('#c_taluka').html('<option value="">-- Taluka --</option>');
                $('#c_village').html('<option value="">-- Village --</option>');
            }
        });

        $('#c_taluka').on('change', function() {
            let talukaId = $(this).val();  

            if (talukaId) {
                $.ajax({
                    url: '{{ route('village.suggestions') }}',  
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                    },
                    data: {
                        taluka: talukaId,  
                    },
                    success: function(response) {
                        $('#c_village').html('<option value="">-- Village --</option>');
                        response.forEach(function(village) {
                            $('#c_village').append('<option value="' + village.id + '">' + village.village + '</option>');
                        });
                    },
                    error: function() {
                        alert('An error occurred while fetching the villages.');
                    },
                });
            } else {
                $('#c_village').html('<option value="">-- Village --</option>');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#v_district').on('change', function() {
            let districtId = $(this).val();  

            if (districtId) {
                $.ajax({
                    url: '{{ route('taluka.suggestions') }}',  
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                    },
                    data: {
                        district: districtId, 
                    },
                    success: function(response) {
                        $('#v_taluka').html('<option value="">-- Taluka --</option>');
                        response.forEach(function(taluka) {  
                            $('#v_taluka').append('<option value="' + taluka.id + '">' + taluka.taluka + '</option>');
                        });
                    },
                    error: function() {
                        alert('An error occurred while fetching the talukas.');
                    },
                });
            } else {
                $('#v_taluka').html('<option value="">-- Taluka --</option>');
                $('#v_village').html('<option value="">-- Village --</option>');
            }
        });

        $('#v_taluka').on('change', function() {
            let talukaId = $(this).val();  

            if (talukaId) {
                $.ajax({
                    url: '{{ route('village.suggestions') }}',  
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                    },
                    data: {
                        taluka: talukaId,  
                    },
                    success: function(response) {
                        $('#v_village').html('<option value="">-- Village --</option>');
                        response.forEach(function(village) {
                            $('#v_village').append('<option value="' + village.id + '">' + village.village + '</option>');
                        });
                    },
                    error: function() {
                        alert('An error occurred while fetching the villages.');
                    },
                });
            } else {
                $('#v_village').html('<option value="">-- Village --</option>');
            }
        });
    });
</script>

<script>
    function fetchSuggestions({ inputId, suggestionsId, url }) {
        const inputSelector = `#${inputId}`;
        const suggestionsSelector = `#${suggestionsId}`;

        $(inputSelector).on('keyup', function () {
            const query = $(this).val().trim();
            if (query.length > 0) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: { query: query },
                    success: function (data) {
                        let suggestionsHtml = '';
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                suggestionsHtml += `<li class="list-group-item suggestion-item">${item}</li>`;
                            });
                        } else {
                            suggestionsHtml = `<li class="list-group-item text-muted">No results found</li>`;
                        }
                        $(suggestionsSelector).html(suggestionsHtml).show();
                    },
                    error: function (xhr) {
                        console.error(`Error fetching suggestions for ${inputId}`, xhr.responseText);
                        $(suggestionsSelector).html('<li class="list-group-item text-danger">Error loading suggestions</li>').show();
                    }
                });
            } else {
                $(suggestionsSelector).hide();
            }
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest(`${inputSelector}, ${suggestionsSelector}`).length) {
                $(suggestionsSelector).hide();
            }
        });

        $(document).on('click', `${suggestionsSelector} .suggestion-item`, function () {
            const selectedText = $(this).text();
            $(inputSelector).val(selectedText);
            $(suggestionsSelector).hide();
        });
    }

    fetchSuggestions({ inputId: 'companyname', suggestionsId: 'company-suggestions', url: '{{ route("company.suggestions") }}' });
    fetchSuggestions({ inputId: 'business_category', suggestionsId: 'business-category-suggestions', url: '{{ route("business.category.suggestions") }}' });
    fetchSuggestions({ inputId: 'education', suggestionsId: 'education-suggestions', url: '{{ route("education.suggestions") }}' });
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

@include('layouts.footer')
<style>

    fieldset {
        border: none;
        border-radius: 10px;
        padding: 20px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* width: 200px; */
    }

    legend {
        font-size: 16px;
        color: #2f3542;
    }

    .profile-image {
        display: flex;
        justify-content: center;
        position: relative;
    }

    .edit-icon {
        position: absolute;
        bottom: 0;
        right: 5px;
        background-color: white;
        color: black;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        border: 2px solid rgb(201, 194, 194);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .edit-icon:hover {
        background-color: rgb(192, 183, 183);
    }

    .text-center h3 {
        margin: 0;
        font-size: 18px;
    }

    .text-center p {
        margin: 5px 0 0;
        font-size: 14px;
    }
</style>
