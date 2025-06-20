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

                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Doctor</th>
                                <th>Contact Details</th>
                                <th>Specialist</th>
                                <th>locations</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                            <tr class="{{ $doctor->status ? 'table-success' : 'table-danger' }} p-2">
                                <td>{{ $doctor->doctor_id }}</td>
                                <td><img src="{{ asset('storage/' . $doctor->image) }}" alt="{{$doctor->first_name}}"
                                        class="avatar-xs rounded-circle me-2">
                                    <a href=""
                                        class="text-body align-middle fw-medium">{{ $doctor->first_name .' '. $doctor->last_name }}</a>
                                </td>
                                <td>{{ $doctor->phone }} <br> {{ $doctor->email }} </td>
                                <td>{{ $doctor->organization_type == 'government' ? 'Govt.' : ($doctor->organization_type == 'private' ? 'Pvt.' : 'Public') }} {{ $doctor->specialization }}</td>
                                <td><span class="text-body align-middle fw-medium" type="button" data-bs-toggle="modal" data-bs-target=".locations_details{{ $doctor->doctor_id }}">{{ $doctor->locations ? $doctor->locations->city : 'N/A' }}, <br>{{ $doctor->locations ? $doctor->locations->state : 'N/A' }} </span>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.doctors.edit', ['id' => $doctor->doctor_id]) }}"
                                            class="btn btn-sm btn-primary" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.doctors.edit', ['id' => $doctor->doctor_id]) }}"
                                            class="btn btn-sm btn-success" title="Edit">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.doctors.destroy', ['id' => $doctor->doctor_id]) }}"
                                            class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                            <!-- locations Details Modal  -->
                            <div class="modal fade locations_details{{ $doctor->doctor_id }}" id="" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myExtraLargeModalLabel"><img src="{{ asset('storage/' . $doctor->image) }}" alt="{{$doctor->first_name}}"
                                                    class="avatar-xs rounded-circle me-2">
                                                <a href="#javascript: void(0);"
                                                    class="text-body align-middle fw-medium">{{ $doctor->first_name .' '. $doctor->last_name }}</a> locations Details
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- locations Information Tab -->
                                            <!-- Address Information Tab -->
                                            <div class="tab-pane" id="address-info" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="address_line1">Address Line 1 <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ optional($doctor->locations)->address_line1 ?? '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="address_line2">Address Line 2</label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ optional($doctor->locations)->address_line2 ?? '' }}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" readonly

                                                                value="{{ optional($doctor->locations)->city ?? '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="district">District <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ optional($doctor->locations)->district ?? '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="state">State <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ optional($doctor->locations)->state ?? '' }}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="pincode">Pincode <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ optional($doctor->locations)->pincode ?? '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ optional($doctor->locations)->country ?? 'India' }}">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="pincode">Google Maps Link <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pincode" readonly
                                                                value="{{ optional($doctor->locations)->google_maps_link ?? '' }}">
                                                        </div>

                                                        <!-- Additional locations information can go here -->

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card h-100">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Street View Panoramas</h4>
                                                                <p class="card-title-desc">locations on Google Maps</p>

                                                                <div id="panorama" class="gmaps-panaroma" style="height: 300px;">
                                                                    @if($doctor->locations && $doctor->locations->google_maps_link)
                                                                    <iframe
                                                                        src="{{ $doctor->locations->google_maps_link  }}"
                                                                        width="100%"
                                                                        height="100%"
                                                                        style="border:0;"
                                                                        allowfullscreen=""
                                                                        loading="lazy"
                                                                        referrerpolicy="no-referrer-when-downgrade">
                                                                    </iframe>
                                                                    @else
                                                                    <div class="text-center py-4">
                                                                        <i class="fas fa-map-marker-alt fa-3x text-muted"></i>
                                                                        <p class="mt-2">No locations data available</p>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

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