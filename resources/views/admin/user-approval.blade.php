@include('layouts.header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="ml-2">User Pending Approval</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Approval</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
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
                        <th>Current Village</th>
                        <th>Village</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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
                            <td>{{$members->v_village}}</td>
                            <td><a href="{{route('view.approval', $members->id)}}" 
                                class="btn btn-warning btn-sm view-btn" id="view-btn">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@include('layouts.footer')
