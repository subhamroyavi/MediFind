@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-xl-12">
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
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">

                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-outline-primary waves-effect waves-light">
                        <i class="fa-solid fa-plus me-2"></i>Add New User
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
                                <th scope="col">Doctor ID</th>
                                <th scope="col">Doctor</th>
                                <th scope="col" style="width: 20%;">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Specialist</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Home</th>
                                <th scope="col">Organization</th>
                                <th scope="col" style="width: 8%;">Status</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($doctors as $doctor)
                            <tr>
                                <td>
                                    <p class="fw-medium mb-0">{{ $doctor->doctor_id }}</p>
                                </td>
                                <td><img src="{{ asset('storage/' . $doctor->image) }}" alt="{{$doctor->first_name}}"
                                        class="avatar-xs rounded-circle me-2">
                                    <a href="#javascript: void(0);"
                                        class="text-body align-middle fw-medium">{{ $doctor->first_name .' '. $doctor->last_name }}</a>
                                </td>
                                <td>{{ $doctor->email }}</td>
                                <td>{{ $doctor->phone }}</td>
                                <td>{{ $doctor->specialization }}</td>
                                <td>{{ $doctor->experience_years }}Years</td>
                                <td>{{ $doctor->home_town }}</td>
                                <td>{{ $doctor->organization_type }}</td>
                                <td><span class="badge {{ $doctor->status == 1 ? 'badge-soft-success' : 'badge-soft-danger' }}  p-2">{{ $doctor->status == 1 ? 'Active' : 'Deactive' }}</span></td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical align-middle font-size-16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item view-doctor-btn" data-id="{{ $doctor->id }}">
                                                    <i class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    View
                                                </button>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.doctors.edit', ['id' => $doctor->doctor_id]) }}" class="dropdown-item edit-doctor-btn">
                                                    <i class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>Edit
                                                </a>
                                            </li>

                                            <li class="dropdown-divider"></li>
                                            <li>

                                                <a href="{{ route('admin.doctors.destroy', ['id' => $doctor->doctor_id]) }}" class="dropdown-item edit-doctor-btn">
                                                    <i class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
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
                Showing <b>{{ $doctors->firstItem() }}</b> to
                <b>{{ $doctors->lastItem() }}</b> of
                <b>{{ $doctors->total() }}</b> results
            </p>
        </div>
        <div class="col-sm-auto ms-auto">
            <nav aria-label="...">
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    <li class="page-item {{ $doctors->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $doctors->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $doctors->onFirstPage() ? 'true' : 'false' }}">
                            Previous
                        </a>
                    </li>

                    {{-- Pagination Elements --}}
                    @foreach ($doctors->getUrlRange(1, $doctors->lastPage()) as $page => $url)
                    <li class="page-item {{ $doctors->currentPage() == $page ? 'active' : '' }}" aria-current="{{ $doctors->currentPage() == $page ? 'page' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    <li class="page-item {{ !$doctors->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $doctors->nextPageUrl() }}" aria-disabled="{{ !$doctors->hasMorePages() ? 'true' : 'false' }}">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>


@endsection