@include('layouts.header')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="ml-2">Family Information Per Village</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">FamilyPerVillage</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($v_villages as $user)
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <a href="{{ route('family.members', ['village' => $user->v_village, 'district' => $user->v_district, 'taluka' => $user->v_taluka]) }}">
                    <div class="card shadow-sm p-2 text-center hover-card">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <div class="circle">
                                <i class="fas fa-map-marker-alt" style="font-size: 24px;"></i>
                            </div>
                        </div>
                        <h5>Village : {{ $user->v_village }}</h5>
                        <div class="row mb-2">
                            <div class="col-6">
                                Taluka : <span class="text-muted">{{ $user->v_taluka }}</span>
                            </div>
                            <div class="col-6">
                                District : <span class="text-muted">{{ $user->v_district }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-2">
                            <div class="stat text-center">
                                <i class="fas fa-users"></i>
                                <p class="text-muted mb-1">Total Members</p>
                                <h5>{{ $user->village_user_count }}</h5>
                            </div>
                            <div class="stat text-center">
                                <i class="fas fa-user"></i>
                                <p class="text-muted mb-1">Family</p>
                                <h5>{{ $user->family_count }}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            {{-- @foreach ($c_villages as $user)
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <a href="{{ route('family.members', ['village' => $user->c_village, 'district' => $user->c_district, 'taluka' => $user->c_taluka]) }}">
                    <div class="card shadow-sm p-2 text-center hover-card">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <div class="circle">
                                <i class="fas fa-map-marker-alt" style="font-size: 24px;"></i>
                            </div>
                        </div>
                        <h5>Village : {{ $user->c_village }}</h5>
                        <div class="row mb-2">
                            <div class="col-6">
                                Taluka : <span class="text-muted">{{ $user->c_taluka }}</span>
                            </div>
                            <div class="col-6">
                                District : <span class="text-muted">{{ $user->c_district }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-2">
                            <div class="stat text-center">
                                <i class="fas fa-users"></i>
                                <p class="text-muted mb-1">Total Members</p>
                                <h5>{{ $user->c_village_user_count }}</h5>
                            </div>
                            <div class="stat text-center">
                                <i class="fas fa-user"></i>
                                <p class="text-muted mb-1">Family</p>
                                <h5>{{ $user->family_count }}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach --}}

        </div>
    </div>
</section>

@include('layouts.footer')


<style>
    body {
        background-color: #f8f9fa;
    }

    .circle {
        width: 50px;
        height: 50px;
        background-color: #e6f0ff;
        background-color: rgb(238, 235, 235);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        /* color: blue; */
        color: #000000;
    }

    .card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .stat {
        flex: 1;
    }

    .stat:not(:last-child) {
        border-right: 1px solid #e9ecef;
    }

</style>