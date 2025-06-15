@extends('layouts.admin_app')

@section('main-content')
<div class="row">
    <div class="col-12">

        <!-- Hospitals Table Header Card -->
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">Users Table</h4>

                <!-- Add New User Button -->
                <div class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <h4 class="card-title mb-0 flex-grow-1">
                            <a href="" class="btn btn-outline-primary waves-effect waves-light">
                                <i class="fa-solid fa-plus me-2"></i>Add New user
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

                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Contact Details</th>
                                <th>User Info</th>
                                <th>Pincode</th>
                                <th>Profile Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="{{ $user->status ? 'table-success' : 'table-danger' }} p-2">
                                <td>{{ $user->id }}</td>
                                <td><img src="{{ asset('storage/' . $user->image) }}" alt="{{$user->first_name}}"
                                        class="avatar-xs rounded-circle me-2">
                                    <a href=""
                                        class="text-body align-middle fw-medium">{{ $user->first_name .' '. $user->last_name }}</a>
                                </td>
                                <td>{{ $user->phone }} <br> {{ $user->email }} </td>
                                <td>Blood Group : {{ $user->bloodType }} <br>DOB : {{ $user->dob }} </td>
                                <td>{{ $user->address }}</td>
                                <td style="color: green;">{{ $user->user_status == 'User' ? 'User' : ($user->user_status == 'Admin' ? 'Admin' : 'Post-Creator') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="javascript:void(0);"
                                            class="btn btn-sm btn-primary disabled-link" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <span type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#userModal{{ $user->id }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </span>
                                        <a href="{{ route('admin.users.destroy', $user->id) }}"
                                            class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                            <!-- Modal for each user -->
                            <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content p-4">
                                        <div class="modal-header">
                                            <h5 class="modal-title">User Status - {{ $user->first_name .' '. $user->last_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.users-status.update', $user->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select" name="status">
                                                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

<!-- <script>
    function updateUserStatus(userId) {
        const status = document.getElementById(`user-status-${userId}`).value;

        // Here you would typically make an AJAX call to update the user status
        fetch(`/users/${userId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close the modal and optionally refresh the page or update the UI
                    bootstrap.Modal.getInstance(document.getElementById(`user${userId}`)).hide();
                    location.reload(); // or update the UI dynamically
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script> -->

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
                    [0, 'desc']
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