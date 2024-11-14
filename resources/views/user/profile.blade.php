@include('layouts.userheader')
  <section class="container-fluid">
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-8 mt-3 mb-3">
        <form class="form-container" action="{{route('profile.update')}}" method="POST" style="border:1px solid rgb(160, 156, 156); border-radius: 10px; padding: 40px;">
          @csrf 
          <div class="form-group">
            <h4 class="text-center font-weight-bold mb-4"> Profile </h4>
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
                       @if($users->gender == 'male') checked @endif > Male
                    </label>
                    <label>
                      <input type="radio" name="gender" value="female"       
                       @if($users->gender == 'female') checked @endif > Female
                    </label>
                  </div>
                </div>       
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block mt-2">Save Changes</button>
        </form>
      </section>
    </section>
  </section>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
