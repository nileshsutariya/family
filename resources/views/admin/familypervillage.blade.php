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
<section class="content py-4">
    <div class="container-fluid">
        <div class="row">
            @foreach ($v_villages as $user)
                <div class="col-md-6 col-lg-6">
                    <div class="card card-outline card-secondary shadow h-80">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="fas fa-home me-2"></i>
                                <strong>Village:</strong> {{ $user->v_village }}
                            </h5>
                            <p class="mb-2 text-end">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <strong>Taluka:</strong> {{ $user->v_taluka }}
                            </p>
                            <p class="mb-3 text-end">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                <strong>District:</strong> {{ $user->v_district }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-users me-2"></i>
                                    {{ $user->village_user_count }} members
                                </span>
                                <a href="{{ route('family.members', ['village' => $user->v_village, 'district' => $user->v_district, 'taluka' => $user->v_taluka]) }}" class="btn btn-outline-secondary btn-sm text-decoration-none">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($c_villages as $user)
                <div class="col-md-6 col-lg-6">
                    <div class="card card-outline card-secondary shadow h-80">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="fas fa-home me-2"></i>
                                <strong>Village:</strong> {{ $user->c_village }}
                            </h5>
                            <p class="mb-2 text-end">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <strong>Taluka:</strong> {{ $user->c_taluka }}
                            </p>
                            <p class="mb-3 text-end">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                <strong>District:</strong> {{ $user->c_district }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-users me-2"></i>
                                    {{ $user->c_village_user_count }} members
                                </span>
                                <a href="{{ route('family.members', ['village' => $user->c_village, 'district' => $user->c_district, 'taluka' => $user->c_taluka]) }}" class="btn btn-outline-secondary btn-sm text-decoration-none">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('layouts.footer')