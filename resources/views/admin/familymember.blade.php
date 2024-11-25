@include('layouts.header')
<section class="content">
    <div class="container-fluid">
        <a href="{{route('family.village')}}" class="btn btn-primary ml-3 mt-2">            
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
        <div class="row">
            {{-- @foreach ($users as $member) --}}
                {{-- <div class="col-md-6">
                    <div class="card m-3 shadow" style="border: 1px solid #ddd; border-radius: 10px;">
                        <div class="card-body" style="padding: 20px; display: flex; align-items: center; justify-content: space-between;">
                            <div class="left-section" style="flex: 1;">
                                <h5 style="margin: 0; font-weight: bold;">{{$member->first_name}} {{$member->father_name}} {{$member->last_name}}</h5>
                                @if($member->gender === 'female')
                                    <strong>Mo. </strong>{{ substr($member->ph_no, 0, 1) . str_repeat('*', 8) . substr($member->ph_no, -1) }}
                                @else
                                    <strong>Mo. </strong>{{$member->ph_no}}    
                                @endif
                                <p style="margin: 0; color: #555;"><strong>Village: </strong>{{$member->v_village}}</p>
                            </div>
                            
                            <div class="right-section" style="display: flex; align-items: center; gap: 10px;">
                                @if ($member->gender === 'female')
                                    <a href="tel:{{$member->ph_no}}" style="pointer-events: none;">
                                        <i class="bi bi-telephone-fill fa-2x" style="color: #fff; width: 50px; background-color: #b0c4de; border-radius: 30%; padding: 12px; text-align: center;"></i>
                                    </a>
                                    <a href="https://wa.me/{{$member->ph_no}}" style="pointer-events: none;">
                                        <i class="bi bi-whatsapp fa-2x" style="color: #fff; width: 50px; background-color: #d4edda; border-radius: 30%; padding: 12px; text-align: center;"></i>
                                    </a>
                                @else
                                    <a href="tel:{{$member->ph_no}}">
                                        <i class="bi bi-telephone-fill fa-2x" style="color: #fff; width: 50px; background-color: #007bff; border-radius: 30%; padding: 12px; text-align: center;"></i>
                                    </a>
                                    <a href="https://wa.me/{{$member->ph_no}}">
                                        <i class="bi bi-whatsapp fa-2x" style="color: #fff; width: 50px; background-color: #25d366; border-radius: 30%; padding: 12px; text-align: center;"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="table-responsive mt-2">
                    <table class="table custom-table">
                        <thead class="text-dark">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Father Name</th>
                                <th>Mother Name</th>
                                <th>Last Name</th>
                                <th>Phone No</th>
                                <th>Village</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="event_table_body">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($users as $members)         
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$members->first_name}}</td>
                                    <td>{{$members->father_name}}</td>
                                    <td>{{$members->mother_name}}</td>
                                    <td>{{$members->last_name}}</td>
                                    <td>
                                        @if($members->gender === 'female')
                                            {{ substr($members->ph_no, 0, 1) . str_repeat('*', 8) . substr($members->ph_no, -1) }}
                                        @else
                                            {{$members->ph_no}}    
                                        @endif
                                    </td>                                
                                    <td>{{$members->v_village}}</td>
                                    <td>
                                        @if ($members->gender === 'female')
                                        <span class="btn btn-secondary btn-sm disabled">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <span class="btn btn-success btn-sm disabled">
                                            <i class="bi bi-whatsapp"></i>
                                        </span>
                                    @else
                                        <a href="tel:{{ $members->ph_no }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-telephone-fill"></i>
                                        </a>
                                        <a href="https://wa.me/{{ $members->ph_no }}" class="btn btn-success btn-sm">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- @endforeach --}}
        </div>
    </div>
</section>
@include('layouts.footer')
