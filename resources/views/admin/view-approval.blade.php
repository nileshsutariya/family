@include('layouts.header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="ml-2">User Pending Approval</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Approval</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<a href="{{route('user-approval')}}" class="btn btn-primary ml-4 mt-2"> 
    <i class="bi bi-arrow-left me-1"></i> Back
</a>
<section class="content">
    <div class="row">
        <form class="form-container" enctype="multipart/form-data" action="" method="POST" id="profileForm" style="padding: 20px;">
            @csrf
            <div class="form-group">
                <div class="row">
                    <input type="hidden" id="view-id" value="{{$users->id}}">
                    <div class="col-md-3">
                        <label for="firstname">First Name</label>
                        <input type="text" name="first_name" class="form-control first_name" id="first_name" aria-describeby="usernameHelp" value="{{ $users->first_name }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="fathername">Father Name</label>
                        <input type="text" name="father_name" class="form-control father_name" id="father_name" aria-describeby="usernameHelp" value="{{ $users->father_name }}" readonly>
                    </div>
                    <div class="col-md-3"> 
                        <label for="mothername">Mother Name</label>
                        <input type="text" name="mother_name" class="form-control mother_name" id="mother_name" aria-describeby="usernameHelp" value="{{$users->mother_name}}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="last_name" class="form-control last_name" id="last_name" aria-describeby="usernameHelp" value="{{$users->last_name}}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="phno" class="mt-2">Phone No.</label>
                        <input type="text" name="ph_no" class="form-control ph_no" id="ph_no" aria-describeby="usernameHelp" value="{{$users->ph_no}}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="dob" class="mt-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control date_of_birth" id="date_of_birth" aria-describeby="usernameHelp" value="{{$users->date_of_birth}}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="bloodgroup" class="mt-2">Blood Group</label>
                        <input type="text" name="blood_group" class="form-control" id="blood_group" aria-describeby="usernameHelp" value="{{$users->blood_group}}" readonly>
                        
                    </div>
                    <div class="col-md-3">
                        <label for="gender" class="mt-2">Gender</label>
                        <div>
                          <label class="mr-2">
                            <input type="radio" name="gender" value="male" id="gender" class="gender"
                            @if($users->gender == 'male') checked @endif> Male
                          </label>
                          <label>
                            <input type="radio" name="gender" value="female" id="gender" class="gender"
                             @if($users->gender == 'female') checked @endif> Female
                          </label>
                        </div>
                    </div>    
                    <div class="col-md-12">
                        <label for="marital_status" class="mt-2">Marital Status</label>
                        <div>
                            <label class="mr-3" class="mt-2">
                                <input type="radio" name="marital_status" value="married" id="marital_status" class="marital_status"
                                @if($users->marital_status == 'married') checked @endif> Married
                            </label>
                            <label class="mr-3">
                                <input type="radio" name="marital_status" value="engaged" id="marital_status" class="marital_status"
                                @if($users->marital_status == 'engaged') checked @endif> Engaged
                            </label>
                            <label class="mr-3">
                                <input type="radio" name="marital_status" value="unmarried" id="marital_status" class="marital_status"
                                @if($users->marital_status == 'unmarried') checked @endif> Unmarried
                            </label>
                            <label class="mr-3">
                                <input type="radio" name="marital_status" value="widow/divorcee" id="marital_status" class="marital_status"
                                @if($users->marital_status == 'widow/divorcee') checked @endif> Widow/Divorcee
                            </label>
                        </div>
                    </div>    
                    <div class="col-md-12" id="spouse-name-field" style="display: none;">
                        <div class="mb-3 mt-2">
                            <label for="spousename" class="form-label">Husband/Wife Name</label>
                            <input type="text" name="spouse_name" class="form-control spouse_name" id="spouse_name" placeholder="Enter Spouse Name" value="{{ old('spouse_name', $users->spouse_name) }}" readonly>   
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="mt-2">Email</label>
                        <input type="email" name="email" class="form-control email" id="email" aria-describeby="usernameHelp" value="{{$users->email}}" readonly>
                    </div>
                    <h5 class="mt-2">Current Address</h5>
                    <div class="col-md-3">
                        <label for="c_address">Address</label>
                        <input type="text" name="c_address" class="form-control c_address" id="c_address" aria-describeby="usernameHelp" value="{{$users->c_address}}" readonly>
                    </div>
                    <div class="col-md-3"> 
                        <label for="c_district">District</label>
                        <input type="text" name="c_district" class="form-control" id="c_district" placeholder="Enter District" value="{{$users->c_district}}" readonly>
                                              
                    </div>
                    <div class="col-md-3"> 
                        <label for="c_taluka">Taluka</label>
                        <input type="text" name="c_taluka" class="form-control" id="c_taluka" placeholder="Enter Taluka" value="{{$users->c_taluka}}" readonly>
                                            
                    </div>
                    <div class="col-md-3">
                        <label for="c_village">Village</label>
                        <input type="text" name="c_village" class="form-control" id="c_village" placeholder="Enter Village" value="{{$users->c_village}}" readonly>
                                            
                    </div>
                    <h5 class="mt-2">Village Address</h5>
                    <div class="col-md-3">
                        <label for="v_address">Address</label>
                        <input type="text" name="v_address" class="form-control v_address" id="v_address" aria-describeby="usernameHelp" value="{{$users->v_address}}" readonly>
                    </div>
                    <div class="col-md-3"> 
                        <label for="v_district">District</label>
                        <input type="text" name="v_district" class="form-control" id="v_district" placeholder="Enter District" value="{{$users->v_district}}" readonly>
                                            
                    </div>
                    <div class="col-md-3"> 
                        <label for="v_taluka">Taluka</label>
                        <input type="text" name="v_taluka" class="form-control" id="v_taluka" placeholder="Enter Taluka" value="{{$users->v_taluka}}" readonly>
                                            
                    </div>
                    <div class="col-md-3">
                        <label for="v_village">Village</label>
                        <input type="text" name="v_village" class="form-control" id="v_village" placeholder="Enter Village" value="{{$users->v_village}}" readonly>
                                                     
                    </div>
                    <div class="col-md-12">
                        <label for="education" class="mt-2">Education</label>
                        <input type="text" name="education" class="form-control" id="education" placeholder="Enter Education" value="{{$users->education}}" readonly>
                                                           
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="col-md-12" class="mt-2">Profession</label>
                        <div>
                            <label class="mr-3">
                                <input type="radio" name="profession" value="job" id="profession" class="profession"
                                @if($users->profession == 'job') checked @endif> Job
                            </label>
                            <label class="mr-3">
                                <input type="radio" name="profession" value="business" id="profession" class="profession"
                                @if($users->profession == 'business') checked @endif> Business
                            </label>
                            <label class="mr-3">
                                <input type="radio" name="profession" value="findingjob" id="profession" class="profession"
                                @if($users->profession == 'findingjob') checked @endif> Finding Jobs
                            </label>
                            <label class="mr-3">
                                <input type="radio" name="profession" value="student" id="profession" class="profession"
                                @if($users->profession == 'student') checked @endif> Student
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12" id="company-name" style="display: none;">
                        <div>
                            <label for="companyname" class="mt-2">Company Name</label>
                            <input type="text" name="company_name" class="form-control company_name" id="company_name" aria-describeby="usernameHelp" value="{{old('company_name', $users->company_name)}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="businesscategory" class="mt-1">Business Category</label>
                        <input type="text" name="business_category" class="form-control" id="business_category" placeholder="Enter Business Category" value="{{$users->business_category}}" readonly>                                    
                    </div>                                                   

                    <div class="col-md-12">
                        <label for="profile_photo" class="mt-1">Profile Photo</label>
                        {{-- <div>
                            <img src="{{ asset('profile/' . $users->profile_photo) }}" id="profile_photo" class="profile_photo" alt="{{ $users->profile_photo }}" style="width: 150px; cursor: pointer; height: auto;" onclick="showImage('{{ asset('profile/' . $users->profile_photo) }}')">
                        </div> --}}
                        <div>
                            <span id="profile_photo" style="cursor: pointer; color: rgb(0, 150, 250);" onclick="showImage('{{ asset('profile/' . $users->profile_photo) }}')">
                                {{ basename($users->profile_photo) }}
                            </span>
                        </div>                        
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img id="modalImage" src="" alt="Large Image" class="img-fluid" style="height: 300px; width: 400px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="document_type" class="mt-1">Document Type</label>
                        <input type="text" class="form-control document_type" id="document_type" value="{{$users->document_type}}" readonly>    
                    </div>
                    <div class="col-md-6">
                        <label for="document_upload" class="mt-1">Document</label>
                        {{-- <div>
                            <img src="{{ asset('documents/' . $users->document_upload) }}"  alt="{{ $users->document_upload }}" id="document_upload" class="document_upload" style="width: 150px; cursor: pointer;" onclick="showImage('{{ asset('documents/' . $users->document_upload) }}')">
                        </div> --}}
                        <div>
                            <span id="document_upload" style="cursor: pointer; color: rgb(0, 150, 250); " onclick="showImage('{{ asset('documents/' . $users->document_upload) }}')">
                                {{ basename($users->document_upload) }}
                            </span>
                        </div>                    
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img id="modalImage" src="" alt="Large Image" class="img-fluid" style="height: 250px; width: 400px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mt-4 d-flex justify-content-center justify-content-md-end">
                            <a href="{{ route('user.approve', $users->id) }}" class="btn btn-success btn-sm">Approve</a>
                        </div>
                        <div class="col-12 col-md-6 mt-4 d-flex justify-content-center justify-content-md-start">
                            <a href="{{ route('user.disapprove', $users->id) }}" class="btn btn-danger btn-sm">Disapprove</a>
                        </div>
                    </div>                    
                   
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    function showImage(imageSrc) {
        var modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        $('#imageModal').modal('show');
    }
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
    #document_upload:hover {
        text-decoration: underline;
    }
    #profile_photo:hover {
        text-decoration: underline;
    }
</style>

