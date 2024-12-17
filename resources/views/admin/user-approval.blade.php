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

{{-- <script>
    function showImage(imageSrc) {
        var modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        $('#imageModal').modal('show');
    }

    document.querySelectorAll('#view-btn').forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.getElementById('viewmodal');
            modal.querySelector('#view-id').value = this.getAttribute('data-id');
            modal.querySelector('#ph_no').value = this.getAttribute('data-ph_no');
            modal.querySelector('#first_name').value = this.getAttribute('data-first_name');
            modal.querySelector('#father_name').value = this.getAttribute('data-father_name');
            modal.querySelector('#mother_name').value = this.getAttribute('data-mother_name');
            modal.querySelector('#last_name').value = this.getAttribute('data-last_name');
            modal.querySelector('#marital_status').value = this.getAttribute('data-marital_status');
            modal.querySelector('#spouse_name').value = this.getAttribute('data-spouse_name');
            modal.querySelector('#email').value = this.getAttribute('data-email');
            modal.querySelector('#gender').value = this.getAttribute('data-gender');
            modal.querySelector('#date_of_birth').value = this.getAttribute('data-date_of_birth');
            modal.querySelector('#blood_group').value = this.getAttribute('data-blood_group');
            modal.querySelector('#c_address').value = this.getAttribute('data-c_address'); 
            modal.querySelector('#c_district').value = this.getAttribute('data-c_district'); 
            modal.querySelector('#c_taluka').value = this.getAttribute('data-c_taluka'); 
            modal.querySelector('#c_village').value = this.getAttribute('data-c_village'); 
            modal.querySelector('#v_address').value = this.getAttribute('data-v_address'); 
            modal.querySelector('#v_district').value = this.getAttribute('data-v_district'); 
            modal.querySelector('#v_taluka').value = this.getAttribute('data-v_taluka'); 
            modal.querySelector('#v_village').value = this.getAttribute('data-v_village'); 
            modal.querySelector('#education').value = this.getAttribute('data-education'); 
            modal.querySelector('#profession').value = this.getAttribute('data-profession'); 
            modal.querySelector('#company_name').value = this.getAttribute('data-company_name'); 
            modal.querySelector('#business_category').value = this.getAttribute('data-business_category'); 
            modal.querySelector('#document_type').value = this.getAttribute('data-document_type'); 
            modal.querySelector('#document_upload').src = "{{ asset('documents/') }}" + this.getAttribute('data-document_upload'); 
            modal.querySelector('#profile_photo').src = "{{ asset('profile/') }}" + this.getAttribute('data-profile_photo'); 
            
            const maritalStatus = this.getAttribute('data-marital_status');
            const gender = this.getAttribute('data-gender');
            
            const maritalStatusRadios = modal.querySelectorAll('input[name="marital_status"]');
            maritalStatusRadios.forEach(radio => {
                if (radio.value === maritalStatus) {
                    radio.checked = true;
                }
            });

            const genderRadios = modal.querySelectorAll('input[name="gender"]');
            genderRadios.forEach(radio => {
                if (radio.value === gender) {
                    radio.checked = true;
                }
            });

            const profession = this.getAttribute('data-profession');
            const professionRadios = modal.querySelectorAll('input[name="profession"]');
            professionRadios.forEach(radio => {
                if (radio.value === profession) {
                    radio.checked = true;
                }
            });
            
            modal.querySelector('form').action = "{{ url('/approval') }}";
        });
    });
</script>
<script>
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.getElementById('viewmodal');

            const profilePhoto = this.getAttribute('data-profile_photo');
            const profilePhotoElement = modal.querySelector('#profile_photo');
            profilePhotoElement.src = profilePhoto ? `{{ asset('profile/') }}/${profilePhoto}` : 'default_image_path';

            const documentUpload = this.getAttribute('data-document_upload');
            const documentUploadElement = modal.querySelector('#document_upload');
            documentUploadElement.src = documentUpload ? `{{ asset('documents/') }}/${documentUpload}` : 'default_image_path';
        });
    });
</script> --}}
@include('layouts.footer')
