@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">Ambulance Table
                </h4>

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

                    <a href="{{ route('admin.ambulance.create') }}" class="btn btn-outline-primary waves-effect waves-light">
                        <i class="fa-solid fa-plus me-2"></i>Add New Ambulamce
                    </a>
                </h4>
                <!-- App Search-->

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
                                <th scope="col">Ambulance ID</th>
                                <th scope="col" style="width: 20%;">ambulance</th>
                                <th scope="col" style="width: 20%;">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Vehicle Number</th>

                                <th scope="col">Service Type</th>
                                <th scope="col">Organization</th>
                                <th scope="col" style="width: 8%;">Status</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ambulances as $ambulance)

                            <tr>
                                <td>
                                    <p class="fw-medium mb-0">{{ $ambulance->ambulance_id }}</p>
                                </td>
                                <td><img src="{{ asset('storage/' . $ambulance->image) }}" alt="{{$ambulance->first_name}}"
                                        class="avatar-xs rounded-circle me-2">
                                    <a href="#javascript: void(0);"
                                        class="text-body align-middle fw-medium">{{ $ambulance->first_name .' '. $ambulance->last_name }}</a>
                                </td>
                                <td>{{ $ambulance->email }}</td>
                                <td>{{ $ambulance->phone }}</td>
                                <td>{{ $ambulance->vehicle_number }}</td>
                                <td>{{ $ambulance->service_type }}</td>
                                <td>{{ $ambulance->organization_type }}</td>
                                <td><span class="badge {{ $ambulance->status == 1 ? 'badge-soft-success' : 'badge-soft-danger' }}  p-2">{{ $ambulance->status == 1 ? 'Active' : 'Deactive' }}</span></td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('admin.ambulance.edit', ['id' => $ambulance->ambulance_id]) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.ambulance.edit', ['id' => $ambulance->ambulance_id]) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                                        <a href="{{ route('admin.ambulance.destroy', ['id' => $ambulance->ambulance_id]) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
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