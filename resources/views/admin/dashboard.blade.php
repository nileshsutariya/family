@include('layouts.header')
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mt-4">
              <div class="card card-outline card-warning shadow">
                  <div class="card-header bg-warning">
                      <h5>Upcoming Events</h5> 
                  </div>
                  <div class="card-body">
                      {{$upcoming}}
                  </div>
              </div>
            </div>
            <div class="col-md-3 mt-4">
                <div class="card card-outline card-success shadow">
                    <div class="card-header bg-info">
                        <h5>Ongoing Events</h5> 
                    </div>
                    <div class="card-body">
                        {{$ongoing}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-4">
                <div class="card card-outline card-primary shadow">
                    <div class="card-header bg-success text-white">
                        <h5>Completed Events</h5> 
                    </div>
                    <div class="card-body">
                      {{$completed}}
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-4">
                <div class="card card-outline card-danger shadow">
                    <div class="card-header bg-danger">
                        <h5>Cancelled Events</h5> 
                    </div>
                    <div class="card-body">
                        {{$cancelled}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-4">
                <div class="card card-outline card-warning shadow">
                    <div class="card-header bg-secondary text-white">
                        <h5>Total Members</h5> 
                    </div>
                    <div class="card-body">
                        {{$members}}
                    </div>
                </div>
            </div>
        </div>           
    </div>
</section>


    </div>
    </div>
</body>
</html>

    {{-- @include('layouts.footer') --}}