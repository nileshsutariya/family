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
<div class="table-responsive">
    <table class="table custom-table table-bordered m-3">
        <thead class="text-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Mother Name</th>
                <th>Last Name</th>
                <th>Phone No.</th>
                <th>Marital Status</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Blood Group</th>
                <th>Current Address</th>
                <th>District</th>
                <th>Taluka</th>
                <th>Village</th>
                <th>Village Address</th>
                <th>District</th>
                <th>Taluka</th>
                <th>Village</th>
                <th>Education</th>
                <th>Profession</th>
                <th>Company Name</th>
                <th>Business Category</th>
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
                    <td>{{$value->mother_name}}</td>
                    <td>{{$value->last_name}}</td>
                    <td>{{$value->ph_no}}</td> 
                    <td>{{$value->marital_status}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->gender}}</td>
                    <td>{{$value->date_of_birth}}</td>
                    <td>{{$value->blood_group}}</td>
                    <td>{{$value->c_address}}</td>
                    <td>{{$value->c_district}}</td>
                    <td>{{$value->c_taluka}}</td>
                    <td>{{$value->c_village}}</td>
                    <td>{{$value->v_address}}</td>
                    <td>{{$value->v_district}}</td>
                    <td>{{$value->v_taluka}}</td>
                    <td>{{$value->v_village}}</td>
                    <td>{{$value->education}}</td>
                    <td>{{$value->profession}}</td>
                    <td>{{$value->company_name}}</td>
                    <td>{{$value->business_category}}</td>
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
@include('layouts.footer')
