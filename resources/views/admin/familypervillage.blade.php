@include('layouts.header')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($elders as $user)
                <div class="col-md-6">
                    <a href="{{route('family.info')}}">
                        <div class="card m-2">
                            <div class="card-body">
                                <div class="row">
                                    {{-- <div class="col-md-1">
                                        <i class="fa-solid fa-location-dot fa-2x"></i>
                                    </div> --}}
                                    <div class="col-6 mb-2 ml-1">
                                        <strong>Village : </strong>{{$user->v_village}}
                                    </div>
                                    <div class="col text-end align-items-center mb-2">
                                        <i class="fas fa-users me-2 ml-3" style="font-size: 20px; color: #5b5b5b;"></i>
                                        <span class="text-muted">10</span>
                                    </div>
                                    <div class="row">
                                        {{-- <div class="col-md-1">
                                        </div> --}}
                                        <div class="col-7">
                                            <strong>Taluka : </strong>{{$user->v_taluka}}
                                        </div>
                                        <div class="col">
                                            <strong>District : </strong>{{$user->v_district}}                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@include('layouts.footer')