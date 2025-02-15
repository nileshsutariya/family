<div class="table-responsive" id="searchResults">
    <table class="table table-bordered">
        <thead class="text-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Father Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone No.</th>
                <th>Gender</th>
                <th>Current Address</th>
                <th>Village</th>
                <th>Village Address</th>
                <th>Village</th>
                <th colspan="2"> Action </th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($users as $user)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->father_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->ph_no}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->c_address}}</td>
                <td>{{$user->c_village}}</td>
                <td>{{$user->v_address}}</td>
                <td>{{$user->v_village}}</td>
                <td>
                    <a href="{{route('edit.members', $user->id)}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                </td>
                <td>
                    <a href="{{route('delete.members', $user->id)}}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="pagination_links">
        {{ $users->links('pagination::bootstrap-5') }}
    </div> 
</div>