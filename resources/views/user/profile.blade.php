@include('layouts.userheader')
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
      <div class="col-md-12 mb-3">
        <div class="card shadow" style="border-radius: 10px;">
          {{-- <div class="card-header" style="background-color: powderblue; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h3 class="card-title mt-1 ml-2">Profile</h3>
          </div> --}}
          <div class="card-body">

            <form class="form-container" action="{{route('profile.update')}}" method="POST" style="padding: 20px;">
              @csrf 
              <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                      <label for="firstname">First Name</label>
                      <input type="text" name="first_name" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->first_name}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="fathername">Father Name</label>
                      <input type="text" name="father_name" class="form-control mb-3" id="Inputuser2" aria-describeby="usernameHelp" value="{{$users->father_name}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="mothername">Mother Name</label>
                      <input type="text" name="mother_name" class="form-control mb-3" id="Inputuser2" aria-describeby="usernameHelp" value="{{$users->mother_name}}">
                    </div>
                    <div class="col-md-3">
                      <label for="lastname">Last Name</label>
                      <input type="text" name="last_name" class="form-control mb-3" id="Inputuser3" aria-describeby="usernameHelp" value="{{$users->last_name}}">
                    </div>
                    <div class="col-md-3">
                      <label for="phno">Phone No.</label>
                      <input type="text" name="ph_no" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->ph_no}}">
                    </div>
                    <div class="col-md-3">
                      <label for="dob">Date of Birth</label>
                      <input type="date" name="date_of_birth" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->date_of_birth}}">
                    </div>
                    <div class="col-md-3">
                      <label for="bloodgroup">Blood Group</label>
                      <input type="text" name="blood_group" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->blood_group}}">
                    </div>
                    <div class="col-md-3">
                      <label for="gender">Gender</label>
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
                    <div class="col-md-6">
                      <label for="marital_status">Marital Status</label>
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
                            @if($users->marital_status == 'widow/divorcee') checked @endif> Widow/ Divorcee
                        </label>
                      </div>
                    </div>    
                    <div class="col-md-6">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->email}}">
                    </div>      
                    <h5>Current Address</h5>
                    <div class="col-md-3">
                      <label for="c_address">Address</label>
                      <input type="text" name="c_address" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->c_address}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="c_district">District</label>
                      <input type="text" name="c_district" class="form-control mb-3" id="Inputuser2" aria-describeby="usernameHelp" value="{{$users->c_district}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="c_taluka">Taluka</label>
                      <input type="text" name="c_taluka" class="form-control mb-3" id="Inputuser2" aria-describeby="usernameHelp" value="{{$users->c_taluka}}">
                    </div>
                    <div class="col-md-3">
                      <label for="c_village">Village</label>
                      <input type="text" name="c_village" class="form-control mb-3" id="Inputuser3" aria-describeby="usernameHelp" value="{{$users->c_village}}">
                    </div>
                    <h5>Village Address</h5>
                    <div class="col-md-3">
                      <label for="v_address">Address</label>
                      <input type="text" name="v_address" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->v_address}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="v_district">District</label>
                      <input type="text" name="v_district" class="form-control mb-3" id="Inputuser2" aria-describeby="usernameHelp" value="{{$users->v_district}}">
                    </div>
                    <div class="col-md-3"> 
                      <label for="v_taluka">Taluka</label>
                      <input type="text" name="v_taluka" class="form-control mb-3" id="Inputuser2" aria-describeby="usernameHelp" value="{{$users->v_taluka}}">
                    </div>
                    <div class="col-md-3">
                      <label for="v_village">Village</label>
                      <input type="text" name="v_village" class="form-control mb-3" id="Inputuser3" aria-describeby="usernameHelp" value="{{$users->v_village}}">
                    </div>
                    <div class="col-md-6">
                      <label for="education">Education</label>
                      <input type="text" name="education" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->education}}">
                    </div>
                    <div class="col-md-6">
                      <label for="profession">Profession</label>
                      <input type="text" name="profession" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->profession}}">
                    </div>
                    <div class="col-md-6">
                      <label for="companyname">Company Name</label>
                      <input type="text" name="company_name" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->company_name}}">
                    </div>
                    <div class="col-md-6">
                      <label for="businesscategory">Business Category</label>
                      <input type="text" name="business_category" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" value="{{$users->business_category}}">
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
@include('layouts.footer')