@extends('layouts.admin_app')

@section('main-content')


<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">Hospitals Table
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
                    <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fa-solid fa-plus me-2"></i>Add New User
                    </button>
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
                                <td><img src="assets/images/users/avatar-1.jpg" alt=""
                                        class="avatar-xs rounded-circle me-2">
                                    <a href="#javascript: void(0);"
                                        class="text-body align-middle fw-medium">{{ $doctor->first_name .' '. $doctor->last_name }}</a>
                                </td>
                                <td>{{ $doctor->email }}</td>
                                <td>{{ $doctor->phone }}</td>
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
                                                <button class="dropdown-item"
                                                    href="javascript:void(0);"><i
                                                        class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    View</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item"
                                                    href="javascript:void(0);"><i
                                                        class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    Edit</button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="javascript:void(0);"><i
                                                        class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    Download</a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn" href="#">
                                                    <i
                                                        class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    Delete
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="user_image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection