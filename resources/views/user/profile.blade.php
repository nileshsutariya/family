@include('layouts.userheader')
  
<section class="content mt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card card-outline card-secondary shadow" style="border-radius: 10px;">
          <div class="card-header" style="background-color: powderblue; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h3 class="card-title mt-1 ml-2">Profile</h3>
          </div>
          <div class="card-body">

            <form class="form-container" action="{{route('profile.update')}}" method="POST" style="padding: 20px;">
              @csrf 
              <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                      <label for="firstname">First Name</label>
                      <input type="text" name="first_name" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" placeholder="First Name" value="{{$users->first_name}}">
                    </div>
                    <div class="col-md-4"> 
                      <label for="middlename">Middle Name</label>
                      <input type="text" name="middle_name" class="form-control mb-3" id="Inputuser2" aria-describeby="usernameHelp" placeholder="Middle Name" value="{{$users->middle_name}}">
                    </div>
                    <div class="col-md-4">
                      <label for="lastname">Last Name</label>
                      <input type="text" name="last_name" class="form-control mb-3" id="Inputuser3" aria-describeby="usernameHelp" placeholder="Last Name" value="{{$users->last_name}}">
                    </div>
                    <div class="col-md-6">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Email" value="{{$users->email}}">
                    </div>
                    <div class="col-md-6">
                      <label for="phno">Phone No.</label>
                      <input type="text" name="phone_no" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Phone Number" value="{{$users->phone_no}}">
                    </div>
                    <div class="col-md-12">
                      <label for="address">Address</label>
                      <textarea type="text" class="form-control mb-3" id="address" name="address" placeholder="Address">{{$users->address}}</textarea>
                    </div>
                    <div class="col-md-6">
                      <label for="dob">Date of Birth</label>
                      <input type="date" name="date_of_birth" class="form-control mb-3" id="Inputuser1" aria-describeby="usernameHelp" placeholder="Date of Birth" value="{{$users->date_of_birth}}">
                    </div>
                    <div class="col-md-6">
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
</body>
</html>
