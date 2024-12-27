<div class="table-responsive" id="searchResults">
    <table class="table table-bordered">
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
                <td>{{$user->ph_no}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->c_address}}</td>
                <td>{{$user->c_village}}</td>
                <td>{{$user->v_address}}</td>
                <td>{{$user->v_village}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="pagination_links">
        {{ $users->links('pagination::bootstrap-5') }}
    </div> 
</div>