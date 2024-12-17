@include('layouts.userheader')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="ml-2">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</section>    
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mt-2">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h5>Upcoming Events</h5> 
                </div>
                <div class="card-body">
                    {{$upcoming}}
                </div>
            </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="card shadow">
                    <div class="card-header bg-info">
                        <h5>Ongoing Events</h5> 
                    </div>
                    <div class="card-body">
                        {{$ongoing}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5>Completed Events</h5> 
                    </div>
                    <div class="card-body">
                        {{$completed}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="card shadow">
                    <div class="card-header bg-danger">
                        <h5>Cancelled Events</h5> 
                    </div>
                    <div class="card-body">
                        {{$cancelled}}
                    </div>
                </div>
            </div>
        </div>           
    </div>
</section>
@include('layouts.footer')