@include('layouts.header')

<section class="content py-4">
    <div class="container-fluid">
        <div class="row">
            @foreach ($villages as $user)
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
                                <a href="{{ route('family.members', ['village' => $user->v_village]) }}" class="btn btn-outline-secondary btn-sm text-decoration-none">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <a href="{{ route('family.members', ['village' => $user->v_village]) }}" class="btn btn-outline-secondary btn-sm text-decoration-none">
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