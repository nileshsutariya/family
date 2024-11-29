@include('layouts.header')
<section class="content">
    <div class="container-fluid">
        <a href="{{route('family.village')}}" class="btn btn-primary ml-2 mt-2">            
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
        <div class="row">
            <div class="table-responsive mt-2">
                <table class="table custom-table table-bordered">
                    <thead class="text-dark">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Last Name</th>
                            <th>Phone No</th>
                            <th>Current Village</th>
                            <th>Current District</th>
                            <th>Current Taluka</th>
                            <th>Village</th>
                            <th>District</th>
                            <th>Taluka</th>
                            <th colspan="2">Actions</th>
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
                                <td>{{$members->c_village}}</td>                
                                <td>{{$members->c_district}}</td>                
                                <td>{{$members->c_taluka}}</td>                
                                <td>{{$members->v_village}}</td>
                                <td>{{$members->v_district}}</td>
                                <td>{{$members->v_taluka}}</td>
                                <td>
                                    @if ($members->gender === 'female')
                                        <span class="btn btn-secondary btn-sm disabled">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                    @else
                                        <a href="tel:{{ $members->ph_no }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-telephone-fill"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if ($members->gender === 'female')
                                        <span class="btn btn-success btn-sm disabled">
                                            <i class="bi bi-whatsapp"></i>
                                        </span>
                                    @else
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
        </div>
    </div>
</section>
@include('layouts.footer')
