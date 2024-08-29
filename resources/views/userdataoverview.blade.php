
@extends('layouts.app')
@section('content')  
<section class="content-header mt-5">
    <h1 class="pull-left" style="margin-bottom: 15px">User Data Overview</h1>
</section>
<div class="content">
    <div class="clearfix"></div>
    
     @include('flash::message')

     <div class="clearfix"></div>
       <div class="box box-primary">
          <div class="box-body">
                @section('css')
                    @include('layouts.datatables_css')
                @endsection
                      <div class="table-responsive display responsive ">
                         <table id="user-data-table" class="table table-striped table-hover dt-responsive display nowrap"> 
                                <thead>
                                     <tr>
                                        <!-- <th>#</th> -->
                                        <th>Resource Type</th>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Mobile Number</th>
                                        <th>Birth Date</th>
                                        <th>Gender</th>
                                        <th>Personal Address</th>
                                        <th>Institution Address</th>
                                        <th>Summary</th>
                                        <th>Student Enrolement Number</th>
                                        <th>School / College / university</th>
                                        <th>Preferred Segment</th>
                                        <th>Class</th>
                                        <th>Resource Catalogue</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
            </div>
         </div>
    </div>
    @section('scripts')
        @include('layouts.datatables_js')
    @endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $('#user-data-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('user.data.overview') }}', // Use the named route here
                    type: 'GET', // Ensure the correct HTTP method
                    dataSrc: function(json) {
                        console.log(json); // Log the raw response data to inspect it
                        return json.data; // Ensure that `json.data` contains the data array
                    }
                },
                columns: [{
                        data: 'resource_type',
                        name: 'resource_type'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email_address',
                        name: 'email_address'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'birth_date',
                        name: 'birth_date'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'personal_address',
                        name: 'personal_address'
                    },
                    {
                        data: 'institution_address',
                        name: 'institution_address'
                    },

                    {
                        data: 'summary',
                        name: 'summary'
                    },

                    {
                        data: 'student_enrollment',
                        name: 'student_enrollment'
                    },

                    {
                        data: 'school_college_university_name',
                        name: 'school_college_university_name'
                    },

                    {
                        data: 'preferred_segment',
                        name: 'preferred_segment'
                    },

                    {
                        data: 'class',
                        name: 'class'
                    },  

                    {
                        data: 'resource_catalogue',
                        name: 'resource_catalogue'
                    },  

                ]
            });
        });
    </script>
@endsection