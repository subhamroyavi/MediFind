@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-xl-12">
        <!-- Search and Add New Section -->
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">Ambulance Table</h4>

                <!-- Search Form -->
                <form class="app-search d-none d-lg-block" method="GET" action="{{ url()->current() }}">
                    <div class="position-relative">
                        <input type="text" class="form-control" name="search" placeholder="Search..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-link position-absolute end-0 top-0 text-muted">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <div class="flex-grow-1">
                    <a href="{{ route('admin.ambulance.create') }}" class="btn btn-outline-primary waves-effect waves-light">
                        <i class="fa-solid fa-plus me-2"></i>Add New Ambulance
                    </a>
                </div>

                <!-- Sort Dropdown -->
                <div>
                    <div class="dropdown">
                        <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="fw-semibold">Sort By:</span>
                            <span class="text-muted">Yearly<i class="fa-solid fa-chevron-down ms-1"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Yearly</a>
                            <a class="dropdown-item" href="#">Monthly</a>
                            <a class="dropdown-item" href="#">Weekly</a>
                            <a class="dropdown-item" href="#">Today</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-hover table-nowrap align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="text-muted text-uppercase">
                                <th scope="col">ID</th>
                                <th scope="col" style="width: 20%;">Ambulance</th>
                                <th scope="col" style="width: 20%;">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Vehicle No.</th>
                                <th scope="col" style="width: 20%;">Location</th>
                                <th scope="col">Organization</th>
                                <th scope="col" style="width: 8%;">Status</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ambulances as $ambulance)
                            <tr>
                                <td>
                                    <p class="fw-medium mb-0">{{ $ambulance->ambulance_id }}</p>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $ambulance->image) }}" alt="{{ $ambulance->first_name }}"
                                        class="avatar-xs rounded-circle me-2">
                                    <a href="#" class="text-body align-middle fw-medium">
                                        {{ $ambulance->first_name . ' ' . $ambulance->last_name }}
                                    </a>
                                </td>
                                <td>{{ $ambulance->email }}</td>
                                <td>{{ $ambulance->phone }}</td>
                                <td><span class="badge bg-info" type="button" data-bs-toggle="modal" data-bs-target=".vechicle_details{{ $ambulance->ambulance_id }}">{{ $ambulance->vehicle_number }}</span></td>
                                <td><span class="badge bg-info" type="button" data-bs-toggle="modal" data-bs-target=".location_details{{ $ambulance->ambulance_id }}">{{ $ambulance->location ? $ambulance->location->city . ', ' . $ambulance->location->state : 'N/A' }}</span>

                                </td>
                                <td>{{ ucfirst($ambulance->organization_type) }}</td>
                                <td>
                                    <span class="badge {{ $ambulance->status ? 'badge-soft-success' : 'badge-soft-danger' }} p-2">
                                        {{ $ambulance->status ? 'Active' : 'Inactive' }}
                                    </span>
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
                                            <h5 class="modal-title" id="myExtraLargeModalLabel">Location Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- location Information Tab -->
                                            <!-- Address Information Tab -->
                                            <div class="tab-pane" id="address-info" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="address_line1">Address Line 1 <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ $ambulance->location->address_line1 }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="address_line2">Address Line 2</label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ $ambulance->location->address_line2 }}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" readonly

                                                                value="{{ $ambulance->location->city }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="district">District <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $ambulance->location->district }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="state">State <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{ $ambulance->location->state }}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="pincode">Pincode <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                readonly
                                                                value="{{  $ambulance->location->pincode  }}">

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
                                                                        src="{{ $ambulance->location->google_maps_link  }}"
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
                            @empty
                            <tr>
                                <td colspan="10" class="text-center py-4">No ambulances found</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="row align-items-center mt-3 gy-3">
            <div class="col-md-5">
                <p class="mb-0 text-muted">
                    Showing <b>{{ $ambulances->firstItem() }}</b> to
                    <b>{{ $ambulances->lastItem() }}</b> of
                    <b>{{ $ambulances->total() }}</b> results
                </p>
            </div>
            <div class="col-md-7">
                <nav aria-label="Page navigation" class="d-flex justify-content-end">
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        <li class="page-item {{ $ambulances->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $ambulances->previousPageUrl() }}"
                                aria-label="Previous" {{ $ambulances->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Pagination Elements --}}
                        @foreach ($ambulances->getUrlRange(1, $ambulances->lastPage()) as $page => $url)
                        @if($page == $ambulances->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        <li class="page-item {{ !$ambulances->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $ambulances->nextPageUrl() }}"
                                aria-label="Next" {{ !$ambulances->hasMorePages() ? 'aria-disabled=true' : '' }}>
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection