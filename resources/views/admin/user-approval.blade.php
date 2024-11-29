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
                <tbody id="event_table_body">
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
                            <td class="approve_status">
                                @if ($members->approve_status == "0")
                                    <a class="btn btn-danger btn-sm" id="approvestatus" data-val="{{$members->id}}">Pending</a>
                                @else
                                    <a class="btn btn-success btn-sm" id="approvestatus" data-val="{{$members->id}}">Approved</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).on("click", "#approvestatus", function() {
        var id = $(this).attr("data-val");  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('user-approval')}}", 
            data: { 'id': id },
            type: 'GET',
            success: function(data) {
                console.log(data);

                var statusButton = $('a#approvestatus[data-val="' + id + '"]');

                if (data.approve_status == "1") {
                    statusButton.text('Approved').removeClass('btn-danger').addClass('btn-success');
                } else {
                    statusButton.text('Pending').removeClass('btn-success').addClass('btn-danger');
                }
            }
        });
    });
</script>
@include('layouts.footer')
