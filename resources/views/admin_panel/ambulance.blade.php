@extends('layouts.admin_app')

@section('main-content')
<div class="row">
    <div class="col-12">

        <!-- Hospitals Table Header Card -->
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">ambulances Table</h4>

                <!-- Add New User Button -->
                <div class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <h4 class="card-title mb-0 flex-grow-1">
                            <a href="{{ route('admin.ambulance.create') }}" class="btn btn-outline-primary waves-effect waves-light">
                                <i class="fa-solid fa-plus me-2"></i>Add New ambulance
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
                   <!-- table dt-responsive nowrap w-100 -->
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th scope="col" style="width: 20%;">ambulance</th>
                                <th scope="col" style="width: 20%;">Contact Details</th>
                                <th scope="col">Vehicle Details.</th>
                                <th scope="col" style="width: 20%;">Location</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($ambulances as $ambulance)
                            <tr class="{{ $ambulance->status ? 'table-success' : 'table-danger' }} p-2">
                                <td>
                                    <p class="fw-medium mb-0">{{ $ambulance->ambulance_id }}</p>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $ambulance->image) }}" alt="{{ $ambulance->first_name }}"
                                        class="avatar-xs rounded-circle me-2">
                                    <a href="" class="text-body align-middle fw-medium">
                                        {{ $ambulance->first_name . ' ' . $ambulance->last_name }}
                                    </a>
                                </td>
                                <td>{{ $ambulance->phone }} <br> {{ $ambulance->email }}</td>
                                <td><span class="text-body align-middle fw-medium" type="button" data-bs-toggle="modal" data-bs-target=".vechicle_details{{ $ambulance->ambulance_id }}">{{ $ambulance->organization_type == 'government' ? 'Govt.' : ($ambulance->organization_type == 'private' ? 'Pvt.' : 'Public') }} <br> {{ $ambulance->vehicle_number }}</span></td>
                                <td><span class="text-body align-middle fw-medium" type="button" data-bs-toggle="modal" data-bs-target=".location_details{{ $ambulance->ambulance_id }}">{{ $ambulance->location ? $ambulance->location->city : 'N/A' }}, <br> {{ $ambulance->location ? $ambulance->location->state : 'N/A' }}</span>

                                </td>
                              
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.ambulance.edit', $ambulance->ambulance_id) }}"
                                            class="btn btn-sm btn-primary" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.ambulance.edit', $ambulance->ambulance_id) }}"
                                            class="btn btn-sm btn-success" title="Edit">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.ambulance.destroy', $ambulance->ambulance_id) }}"
                                            class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>

                            <!-- Vehicle Details Modal  -->
                            <div class="modal fade vechicle_details{{ $ambulance->ambulance_id }}" id="" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myExtraLargeModalLabel">Vehicle Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Vehicle Information Tab -->
                                            <div class="tab-pane" id="vehicle-info" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="vehicle_number">Vehicle Number <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="vehicle_number" readonly
                                                                value="{{ $ambulance->vehicle_number }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="vehicle_model">Vehicle Model <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="vehicle_model" readonly
                                                                value="{{ $ambulance->vehicle_model }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="organization_type">Organization Type <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="organization_type" readonly
                                                                value="{{ ucfirst($ambulance->organization_type) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="service_type" readonly
                                                                value="{{ ucfirst($ambulance->service_type) }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $ambulance->status ? 'Active' : 'Inactive' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="insurance_number">Insurance Number <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="insurance_number" readonly
                                                                value="{{ $ambulance->insurance_number }}">
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

                            <!-- Location Details Modal  -->
                            <div class="modal fade location_details{{ $ambulance->ambulance_id }}" id="" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myExtraLargeModalLabel"><img src="{{ asset('storage/' . $ambulance->image) }}" alt="{{$ambulance->first_name}}"
                                                    class="avatar-xs rounded-circle me-2">
                                                <a href="#javascript: void(0);"
                                                    class="text-body align-middle fw-medium">{{ $ambulance->first_name .' '. $ambulance->last_name }}</a> Location Details
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Address Information Tab -->
                                            <div class="tab-pane" id="address-info" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="address_line1">Address Line 1 <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ $ambulance->location->address_line1 ?? '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="address_line2">Address Line 2</label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ $ambulance->location->address_line2 ?? '' }}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" readonly

                                                                value="{{ $ambulance->location->city ?? '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="district">District <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $ambulance->location->district ?? '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="state">State <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ $ambulance->location->state ?? '' }}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="pincode">Pincode <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{  $ambulance->location->pincode  ?? '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ old('country', $ambulance->location->country ?? 'India') }}">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="pincode">Google Maps Link <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pincode" readonly
                                                                value="{{ $ambulance->location->google_maps_link ?? 'N/A' }}">
                                                        </div>

                                                        <!-- Additional location information can go here -->

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card h-100">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Street View Panoramas</h4>
                                                                <p class="card-title-desc">Location on Google Maps</p>

                                                                <div id="panorama" class="gmaps-panaroma" style="height: 300px;">
                                                                    @if($ambulance->location && $ambulance->location->google_maps_link)
                                                                    <iframe
                                                                        src="{{ $ambulance->location->google_maps_link  ?? '' }}"
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
                                                                        <p class="mt-2">No location data available</p>
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