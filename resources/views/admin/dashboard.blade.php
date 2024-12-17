@include('layouts.header')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mt-3">
              <div class="card shadow">
                  <div class="card-header bg-warning">
                      <h5>Upcoming Events</h5> 
                  </div>
                  <div class="card-body">
                      {{$upcoming}}
                  </div>
              </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card shadow">
                    <div class="card-header bg-info">
                        <h5>Ongoing Events</h5> 
                    </div>
                    <div class="card-body">
                        {{$ongoing}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5>Completed Events</h5> 
                    </div>
                    <div class="card-body">
                      {{$completed}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card shadow">
                    <div class="card-header bg-danger">
                        <h5>Cancelled Events</h5> 
                    </div>
                    <div class="card-body">
                        {{$cancelled}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card shadow">
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
@include('layouts.footer')