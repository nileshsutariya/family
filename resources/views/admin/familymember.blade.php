@include('layouts.header')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('family.village')}}" class="btn btn-primary ml-2 mt-2">            
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{ route('members.search') }}" method="GET">
                    <div class="input-group justify-content-end">
                        <div class="form-outline" data-mdb-input-init>
                            <input type="search" name="query" id="search" class="form-control mt-2" placeholder="Search" value="{{ request()->query('query') }}" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive mt-2">
                <table class="table table-bordered">
                    <thead class="text-dark">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Father Name</th>
                            <th>Last Name</th>
                            <th>Phone No</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Current Village</th>
                            <th>Village Address</th>
                            <th>Village</th>
                            <th colspan="2" class="text-center">Contact</th>
                            <th colspan="3" class="text-center">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody id="event_table_body">
                        @if($users->isEmpty())
                            <tr>
                                <td colspan="12" class="text-center">No results found for "{{ request()->query('query') }}"</td>
                            </tr>
                        @else
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($users as $members)         
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$members->first_name}}</td>
                                <td>{{$members->father_name}}</td>
                                <td>{{$members->last_name}}</td>
                                <td>
                                    {{-- @if($members->gender === 'female')
                                        {{ substr($members->ph_no, 0, 1) . str_repeat('*', 8) . substr($members->ph_no, -1) }}
                                    @else --}}
                                        {{$members->ph_no}}    
                                    {{-- @endif --}}
                                </td>          
                                <td>{{$members->email}}</td>
                                <td>{{$members->gender}}</td>
                                <td>{{$members->c_village}}</td>
                                <td>{{$members->v_address}}</td>
                                <td>{{$members->v_village}}</td>
                                
                                <td>
                                    <a href="tel:{{ $members->ph_no }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-telephone-fill"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ $members->ph_no }}" class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </td>

                                {{-- <td>
                                    <a href="{{route('edit.members', $members->id)}}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                </td> --}}
                                <td>
                                    <a href="{{route('delete.members', $members->id)}}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('member.view', $members->id)}}" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();

            $.ajax({
                url: "{{ route('members.search') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    $('#event_table_body').html(data);
                }
            });
        });
    });
</script>

@include('layouts.footer')
