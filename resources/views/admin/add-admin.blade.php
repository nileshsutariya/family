@include('layouts.header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="ml-2">Add Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">AddAdmin</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ml-1">
                    <div class="card-body p-4">
                        <form class="p-2" id="multiStepForm" action="{{route('add.admin.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="step active-step">
                                <div class = "row">
                                    {{-- <div class="col-md-12">
                                        <label for="" class="mt-3"><h6>Are You an Elder?</h6></label>
                                        <div>
                                            <label class="mr-2">
                                                <input type="radio" name="elder" value="yes" class="elder-radio"
                                                @if(old('elder') == 'yes') checked @endif
                                                > Yes
                                            </label>
                                            <label>
                                                <input type="radio" name="elder" value="no" class="elder-radio"
                                                @if(old('elder') == 'no') checked @endif
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
                                        <div class="mt-3">
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
                                    </div> --}}
                                    <div class="mt-3">
                                        <label for="ph_no" class="form-label">
                                            <h6>Mobile No.</h6>
                                        </label>
                                        <input type="text" name="ph_no" id="ph_no" class="form-control" placeholder="Your Mobile Number" value="{{old('ph_no')}}">
                                        @error('ph_no')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3 mb-3">
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
                                </div>
                            </div>
                            <div class="step">
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
                                    <div class="col-md-12 mb-3">
                                        <label for="surname" class="form-label"><h6>Surname</h6></label>
                                        <input type="text" name="last_name" class="form-control" id="surname" value="Godhani">
                                        @error('last_name')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-2">
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
                                                @if(old('marital_status') == 'widow/divorcee') checked @endif> Widow/Divorcee
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
                                            <input type="text" name="spouse_name" class="form-control" id="spousename" placeholder="Enter Spouse Name" value="{{old('spouse_name')}}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-4 mt-3">
                                            <label for="email" class="form-label"><h6>Email</h6></label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email')}}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="bloodGroup" class="form-label"><h6>Blood Group</h6></label>
                                            <select name="blood_group" class="form-control" id="bloodGroup">
                                                <option value="" disabled {{ old('blood_group') == '' ? 'selected' : '' }}>-- Select Blood Group  --</option>
                                                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                                <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                                <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                                <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                                                <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                            </select>
                                            @error('blood_group')
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
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
                                        <div class="form-group">
                                            <label class="form-label">District</label>
                                            <select class="form-control select2" name="c_district" id="c_district" style="width: 100%;">
                                                <option value="" disabled selected>-- District --</option>
                                                @foreach($districts as $value)
                                                    <option value="{{ $value->id }}" {{ old('c_district') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->district }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Taluka</label>
                                            <select class="form-control select2" name="c_taluka" id="c_taluka" style="width: 100%;">
                                                <option value="" disabled selected>-- Taluka --</option>
                                                @foreach($talukas as $value)
                                                    <option value="{{ $value->id }}" {{ old('c_taluka') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->taluka }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Village</label>
                                            <select class="form-control select2" name="c_village" id="c_village" style="width: 100%;">
                                                <option value="" disabled selected>-- Village --</option>
                                                @foreach($villages as $value)
                                                    <option value="{{ $value->id }}" {{ old('c_village') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->village }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                        <div class="mb-3">
                                            <label for="v_district" class="form-label"><h6>District</h6></label>
                                            <select class="form-control select2" name="v_district" id="v_district" style="width: 100%;">
                                                <option value="" disabled selected>-- District --</option>
                                                @foreach($districts as $value)
                                                    <option value="{{ $value->id }}" {{ old('v_district') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->district }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('v_district')
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="v_taluka" class="form-label"><h6>Taluka</h6></label>
                                            <select class="form-control select2" name="v_taluka" id="v_taluka" style="width: 100%;">
                                                <option value="" disabled selected>-- Taluka --</option>
                                                @foreach($talukas as $value)
                                                    <option value="{{ $value->id }}" {{ old('v_taluka') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->taluka }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('v_taluka')
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="v_village" class="form-label"><h6>Village</h6></label>
                                            <select class="form-control select2" name="v_village" id="v_village" style="width: 100%;">
                                                <option value="" disabled selected>-- Village --</option>
                                                @foreach($villages as $value)
                                                    <option value="{{ $value->id }}" {{ old('v_village') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->village }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('v_village')
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="education" class="form-label"><h6>Education</h6></label>
                                            <input type="text" name="education" class="form-control" id="education" placeholder="Enter Education" value="{{old('education')}}">
                                            <div id="education-suggestions" class="list-group mt-2" style="display: none;"></div>
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
                                        <div class="mb-3 mt-2" id="company-name" style="display: none;">
                                            <label for="company">Company Name</label>
                                            <input type="text" name="company_name" class="form-control" id="companyname" placeholder="Enter Company Name" value="{{old('company_name')}}">
                                            <ul id="company-suggestions" class="list-group mt-2"></ul>
                                            @error('company_name')
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3 mt-3">
                                            <label for="businesscategory" class="form-label"><h6>Business Category</h6></label>
                                            <input type="text" name="business_category" class="form-control" id="business_category" placeholder="Enter Business Category" value="{{old('business_category')}}">
                                            <div id="business-category-suggestions" class="list-group mt-2">
                                            @error('business_category')
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mt-2">
                                        <label for="profile" class="form-label">Profile Photo</label>
                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                    
                                    </div> --}}
                                    {{-- <div class="col-md-12 mt-2">
                                        <label for="document" class="form-label"><h6>Document</h6></label>
                                        <select name="document" class="form-control" id="document">
                                            <option value="" disabled selected>--  Select Document  --</option>
                                            <option value="aadharcard">Aadhar Card</option>
                                            <option value="pancard">Pan Card</option>
                                            <option value="licence">Driving Licence</option>
                                            <option value="voterid">Voter Idcard</option>
                                        </select>
                                        @error('document')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="documentupload" class="form-label"><h6>Upload Document</h6></label>
                                        <input type="file" class="form-control" id="document_upload" name="document_upload">
                                        @error('document_upload')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div> --}}
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-primary ml-1 btn-block float-end">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
    $(document).ready(function () {
        function toggleCompanyNameField() {
            const selectedValue = $('input[name="profession"]:checked').val();
            if (selectedValue === 'job' || selectedValue === 'business') {
                $('#company-name').show();
            } else {
                $('#company-name').hide();
            }
        }

        $('input[name="profession"]').on('change', toggleCompanyNameField);

        toggleCompanyNameField();
    });
</script>

<script>
    $(document).ready(function () {
        function toggleNoField() {
            const selectedValue = $('input[name="elder"]:checked').val();
            if (selectedValue === 'no') {
                $('#noField').show();
            } else {
                $('#noField').hide();
            }
        }

        $('input[name="elder"]').on('change', toggleNoField);

        toggleNoField();
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

@include('layouts.footer')