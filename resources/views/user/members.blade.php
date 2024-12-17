@include('layouts.userheader')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Family Members</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Family</li>
                </ol>
            </div>
        </div>
    </div>
</section>
{{-- <div class="container-fluid"> --}}
    {{-- <div class="card"> --}}
        {{-- <div class="card-body"> --}}
            <div class="table-responsive">
                <table class="table custom-table table-bordered">
                    <thead class="text-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Last Name</th>
                            <th>Phone No.</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Current Address</th>
                            <th>Village</th>
                            <th>Village Address</th>
                            <th>Village</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="event_table_body">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($members as $value)         
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$value->first_name}}</td>
                                <td>{{$value->father_name}}</td>
                                <td>{{$value->last_name}}</td>
                                <td>{{$value->ph_no}}</td> 
                                <td>{{$value->email}}</td>
                                <td>{{$value->gender}}</td>
                                <td>{{$value->c_address}}</td>
                                <td>{{$value->c_village}}</td>
                                <td>{{$value->v_address}}</td>
                                <td>{{$value->v_village}}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('user.edit', $value->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-outline-danger" href="{{ route('user.delete', $value->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $members->links('pagination::bootstrap-5') }}
                </div> 
            </div>
        {{-- </div> --}}
    {{-- </div> --}}
{{-- </div> --}}
@include('layouts.footer')
