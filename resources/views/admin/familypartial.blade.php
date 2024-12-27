@foreach ($users as $members)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $members->first_name }}</td>
        <td>{{ $members->father_name }}</td>
        <td>{{ $members->last_name }}</td>
        <td>{{ $members->ph_no }}</td>
        <td>{{ $members->email }}</td>
        <td>{{ $members->gender }}</td>
        <td>{{ $members->c_village }}</td>
        <td>{{ $members->v_address }}</td>
        <td>{{ $members->v_village }}</td>
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
        <td>
            <a href="{{ route('delete.members', $members->id) }}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
        </td>
        <td>
            <a href="{{route('member.view', $members->id)}}" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-eye"></i></a>
        </td>
    </tr>
@endforeach
