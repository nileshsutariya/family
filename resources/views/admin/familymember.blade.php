@include('layouts.header')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($familyMembers as $member)
            <div class="col-md-6">
                <div class="card m-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-2 ml-1">
                                <h5>{{$member->first_name}} {{$member->father_name}} {{$member->last_name}}</h5>
                            </div>
                            <div class="col-2"></div>
                            <div class="col text-center align-items-center mb-2">
                                @if ($member->gender === 'female')
                                    <a href="tel:{{$member->ph_no}}" style="pointer-events: none">
                                        <i class="bi bi-telephone-fill fa-2x mr-2 h-100 d-inline-block" style="color: #b0b0b0; width: 50px; background-color: #e0f7fa;"></i>
                                    </a>
                                    <a href="https://wa.me/{{$member->ph_no}}" style="pointer-events: none">
                                        <i class="bi bi-whatsapp fa-2x h-100 d-inline-block" style="color: #b0b0b0; width: 50px; background-color: #d4edda;"></i>
                                    </a>
                                @else
                                    <a href="tel:{{$member->ph_no}}">
                                        <i class="bi bi-telephone-fill fa-2x mr-2 h-100 d-inline-block" style="color: #ffffff; width: 50px; background-color: #007bff;"></i>
                                    </a>
                                    <a href="https://wa.me/{{$member->ph_no}}">
                                        <i class="bi bi-whatsapp fa-2x h-100 d-inline-block" style="color: #ffffff; width: 50px; background-color: #25d366;"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                @if($member->gender === 'female')
                                    <h6>{{ substr($member->ph_no, 0, 1) . str_repeat('*', 8) . substr($member->ph_no, -1) }}</h6>
                                @else
                                    {{$member->ph_no}}    
                                @endif
                                </div>
                                <div class="col">
                                    <h6><strong>Village : </strong>{{$member->v_village}}</h6>                                   
                                </div>
                                {{-- <h6><strong>Gender : </strong>{{$member->gender}}</h6>                                    --}}
                                {{-- <h6><strong>Email :    </strong>{{$member->email}}</h6>      --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@include('layouts.footer')