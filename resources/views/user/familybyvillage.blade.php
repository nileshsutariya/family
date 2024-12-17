@include('layouts.userheader')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Village Members</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">FamilybyVillage</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid d-flex justify-content-end align-items-end">
    <div class="input-group mb-2" style="width: 300px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 7px;">
        <input type="text" id="search" class="form-control" placeholder="Search here..." style="border: none; padding: 15px; border-top-left-radius: 7px; border-bottom-left-radius: 7px;">
        <button class="btn btn-primary" id="searchBtn" type="button" style="border-top-right-radius: 7px; border-bottom-right-radius: 7px;">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>
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
            </tr>
        </thead>
        <tbody id="searchResults">
            @php
                $i = 1;
            @endphp
            @foreach ($users as $value)         
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->first_name}}</td>
                    <td>{{$value->father_name}}</td>
                    <td>{{$value->last_name}}</td>
                    <td>
                        @if($value->gender === 'female')
                            {{ substr($value->ph_no, 0, 1) . str_repeat('*', 8) . substr($value->ph_no, -1) }}
                        @else
                            {{$value->ph_no}}    
                        @endif
                    </td>            
                    <td>
                        @if($value->gender === 'female')
                            @php
                                $emailParts = explode('@', $value->email);
                                $maskedEmail = str_repeat('*', strlen($emailParts[0]) - 1) . substr($emailParts[0], -1) . '@' . $emailParts[1];
                            @endphp
                            {{ $maskedEmail }}
                        @else
                            {{$value->email}}
                        @endif
                    </td>  
                    <td>{{$value->gender}}</td>
                    <td>{{$value->c_address}}</td>
                    <td>{{$value->c_village}}</td>
                    <td>{{$value->v_address}}</td>
                    <td>{{$value->v_village}}</td>   
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div>
        {{ $users->links('pagination::bootstrap-5') }}
    </div>  --}}
</div>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            let searchQuery = $(this).val();

            $.ajax({
                url: "{{ route('members.village') }}", 
                type: "GET",
                data: { search: searchQuery },
                success: function(data) {
                    if (data.html) {
                        $('#searchResults').html(data.html);
                    } else {
                        $('#searchResults').html('<tr><td colspan="11" class="text-center">No results found</td></tr>');
                    }
                    $('#pagination_links').html(data.pagination || '');
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + error);
                }
            });
        });
    });

</script>
@include('layouts.footer')