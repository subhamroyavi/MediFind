@extends('layouts.admin_app')

@section('main-content')
<div class="row">
    <div class="col-12">

        <!-- Hospitals Table Header Card -->
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">Doctors Table</h4>

                <!-- Add New User Button -->
                <div class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <h4 class="card-title mb-0 flex-grow-1">
                            <a href="{{ route('admin.doctors.create') }}" class="btn btn-outline-primary waves-effect waves-light">
                                <i class="fa-solid fa-plus me-2"></i>Add New Doctor
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- Add wrapper div with horizontal scroll -->
                <div class="table-responsive" style="overflow-x: auto;">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Doctor</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Specialist</th>
                                <th>Organization</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{ $doctor->doctor_id }}</td>
                                <td><img src="{{ asset('storage/' . $doctor->image) }}" alt="{{$doctor->first_name}}"
                                        class="avatar-xs rounded-circle me-2">
                                    <a href="#javascript: void(0);"
                                        class="text-body align-middle fw-medium">{{ $doctor->first_name .' '. $doctor->last_name }}</a>
                                </td>
                                <td>{{ $doctor->phone }}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td>$320,800</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('js-content')
<style>
    /* Custom styling for the DataTable */
    .dataTables_wrapper {
        padding-top: 10px;
        position: relative;
    }

    /* Search box styling */
    .dataTables_filter {
        float: right;
        margin-bottom: 15px;
    }

    .dataTables_filter input {
        margin-left: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 5px 10px;
    }

    /* Pagination styling */
    .dataTables_paginate {
        float: right;
        margin-top: 15px;
    }

    .paginate_button {
        padding: 5px 10px;
        margin-left: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
    }

    .paginate_button.current {
        background: #727cf5;
        color: white;
        border-color: #727cf5;
    }

    .paginate_button:hover {
        background: #f1f1f1;
    }

    /* Scrollbar styling */
    .dataTables_scrollBody {
        overflow-x: auto !important;
    }

    .dataTables_scrollBody::-webkit-scrollbar {
        height: 8px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .dataTables_scrollBody::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Info text styling */
    .dataTables_info {
        padding-top: 15px;
        float: left;
    }

    /* Length menu styling */
    .dataTables_length {
        float: left;
        margin-bottom: 15px;
    }

    .dataTables_length select {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 5px;
    }
</style>


<script>
    $(document).ready(function() {
        // Initialize with error handling and default sorting
        initDataTable();

        function initDataTable() {
            var table = $('#datatable').DataTable({
                destroy: true, // Allows reinitialization
                retrieve: true, // Prevents errors if already initialized
                scrollX: true,
                responsive: true,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                pagingType: "simple_numbers",
                order: [
                    [4, 'desc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                pageLength: 10,
                order: [
                    [4, 'desc']
                ], // Sort by 5th column (Start date) in descending order
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });

            // Suppress DataTables warnings in console
            $.fn.dataTable.ext.errMode = 'none';

            return table;
        }
    });
</script>
@endsection