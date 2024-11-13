@include('layouts.header')
<body>
    <div class="container-fluid mt-4">
        <h3 class="text-center mb-4">All Members</h3>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead class="text-dark">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($users as $data)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$data->first_name}}</td>
                        <td>{{$data->middle_name}}</td>
                        <td>{{$data->last_name}}</td>
                        <td>
                            @php
                                $emailParts = explode('@', $data->email);
                                $maskedEmail = str_repeat('*', strlen($emailParts[0]) - 1) . substr($emailParts[0], -1) . '@' . $emailParts[1];
                            @endphp
                            {{ $maskedEmail }}
                        </td>                        
                        <td>{{$data->address}}</td>
                        <td>{{ substr($data->phone_no, 0, 1) . str_repeat('*', 8) . substr($data->phone_no, -1) }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary me-1 edit-btn" 
                                href="{{route('user.edit', $data->id)}}"
                                data-id="{{ $data->id }}" 
                                data-first_name="{{ $data->first_name }}" 
                                data-middle_name="{{ $data->middle_name }}"
                                data-last_name="{{ $data->last_name }}" 
                                data-email="{{ $data->email }}"
                                data-address="{{ $data->address }}"
                                data-phone_no="{{ $data->phone_no }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#editUserModal">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-danger" href="{{ route('user.delete', $data->id) }}">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-image: linear-gradient(to right, lavender, white);">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="editId" name="id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="middle name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="phone_no" class="form-label">Phone No</label>
                                    <input type="phone_no" class="form-control" id="phone_no" name="phone_no">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const modal = document.getElementById('editUserModal');
                modal.querySelector('#editId').value = this.getAttribute('data-id');
                modal.querySelector('#first_name').value = this.getAttribute('data-first_name');
                modal.querySelector('#middle_name').value = this.getAttribute('data-middle_name');
                modal.querySelector('#last_name').value = this.getAttribute('data-last_name');
                modal.querySelector('#email').value = this.getAttribute('data-email');
                modal.querySelector('#address').value = this.getAttribute('data-address'); 
                modal.querySelector('#phone_no').value = this.getAttribute('data-phone_no');
                modal.querySelector('form').action = "{{ url('user/update') }}";
                
            });
        });
    </script>
    

    </div>
    </div>
</body>
</html>