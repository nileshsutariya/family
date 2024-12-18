@include('layouts.header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="ml-2">All Members</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">AllMembers</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="container-fluid d-flex justify-content-end align-items-end">
        <div class="input-group mb-2" style="width: 300px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 7px;">
            <input type="text" id="search" class="form-control" placeholder="Search here..." style="border: none; padding: 15px; border-top-left-radius: 4px; border-bottom-left-radius: 4px;">
            {{-- <button class="btn btn-primary" type="button" style="border-top-right-radius: 7px; border-bottom-right-radius: 7px;">
                Search
            </button> --}}
            <button class="btn btn-primary" id="searchBtn" type="button" style="border-top-right-radius: 4px; border-bottom-right-radius: 4px;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

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
</div>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            let searchQuery = $(this).val();

            $.ajax({
                url: "{{ route('all.users') }}",
                type: "GET",
                data: { search: searchQuery },
                success: function(data) {
                    $('#searchResults').html(data.html);
                    $('#pagination_links').html(data.pagination);
                },
                error: function() {
                    console.error('Error fetching search results.');
                }
            });
        });

        $(document).on('click', '#pagination_links a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href') + '&search=' + $('#search').val();  // Include search query in URL

            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    $('#searchResults').html(data.html);
                    $('#pagination_links').html(data.pagination);
                },
                error: function() {
                    console.error('Error fetching paginated results.');
                }
            });
        });
    });
</script>

@include('layouts.footer')
