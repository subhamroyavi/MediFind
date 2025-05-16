@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-xl-12">
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
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">
                    <a href="{{ route('admin.ambulance.createBlade') }}" class="btn btn-outline-primary waves-effect waves-light">
                        <i class="fa-solid fa-plus me-2"></i>Add New Ambulance
                    </a>
                </h4>
                
                <div>
                    <div class="dropdown">
                        <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="fw-semibold">Sort By:</span>
                            <span class="text-muted">Yearly<i class="fa-solid fa-chevron-down"></i></span>
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
                                <th scope="col">Driver</th>
                                <th scope="col">Contact Info</th>
                                <th scope="col">License</th>
                                <th scope="col">Vehicle Details</th>
                                <th scope="col">Service Type</th>
                                <th scope="col">Organization</th>
                                <th scope="col">Location</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ambulances as $ambulance)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $ambulance->image) }}" alt="{{$ambulance->first_name}}"
                                            class="avatar-xs rounded-circle me-2">
                                        <div>
                                            <h6 class="mb-0">{{ $ambulance->first_name .' '. $ambulance->last_name }}</h6>
                                            <small class="text-muted">ID: {{ $ambulance->ambulance_id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="d-block">{{ $ambulance->email }}</span>
                                        <small class="text-muted">{{ $ambulance->phone }}</small>
                                    </div>
                                </td>
                                <td>
                                    {{ $ambulance->license_number ?? 'N/A' }}
                                </td>
                                <td>
                                    <div>
                                        <span class="d-block">{{ $ambulance->vehicle_number }}</span>
                                        <small class="text-muted">{{ $ambulance->vehicle_model }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $ambulance->service_type }}</span>
                                </td>
                                <td>
                                    {{ ucfirst($ambulance->organization_type) }}
                                </td>
                                <td>
                                    <small class="text-muted">{{ $ambulance->city }}, {{ $ambulance->state }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $ambulance->status == 1 ? 'badge-soft-success' : 'badge-soft-danger' }} p-2">
                                        {{ $ambulance->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical align-middle font-size-16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item view-ambulance-btn" data-id="{{ $ambulance->id }}">
                                                    <i class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    View
                                                </button>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.ambulance.edit', ['id' => $ambulance->ambulance_id]) }}" class="dropdown-item edit-ambulance-btn">
                                                    <i class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>Edit
                                                </a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a href="{{ route('admin.ambulance.destroy', ['id' => $ambulance->ambulance_id]) }}" class="dropdown-item text-danger">
                                                    <i class="mdi mdi-trash-can-outline font-size-16 align-middle me-2"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="col-sm-auto ms-auto">
    <div class="row align-items-center mb-4 gy-3">
        <div class="col-md-5">
            <p class="mb-0 text-muted">
                Showing <b>{{ $ambulances->firstItem() }}</b> to
                <b>{{ $ambulances->lastItem() }}</b> of
                <b>{{ $ambulances->total() }}</b> results
            </p>
        </div>
        <div class="col-sm-auto ms-auto">
            <nav aria-label="...">
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    <li class="page-item {{ $ambulances->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $ambulances->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $ambulances->onFirstPage() ? 'true' : 'false' }}">
                            Previous
                        </a>
                    </li>

                    {{-- Pagination Elements --}}
                    @foreach ($ambulances->getUrlRange(1, $ambulances->lastPage()) as $page => $url)
                    <li class="page-item {{ $ambulances->currentPage() == $page ? 'active' : '' }}" aria-current="{{ $ambulances->currentPage() == $page ? 'page' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    <li class="page-item {{ !$ambulances->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $ambulances->nextPageUrl() }}" aria-disabled="{{ !$ambulances->hasMorePages() ? 'true' : 'false' }}">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection