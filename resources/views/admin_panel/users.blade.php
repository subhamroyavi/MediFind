@extends('layouts.admin_app')

@section('main-content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">Users Management</h4>

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
                                <th scope="col">User ID</th>
                                <th scope="col">User Name</th>
                                <th scope="col" style="width: 20%;">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Create Date</th>
                                <th scope="col">Update Date</th>
                                <th scope="col" style="width: 8%;">Status</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $key => $user)
                            <tr>
                                <td>
                                    <p class="fw-medium mb-0">{{$user->id}}</p>
                                </td>
                                <td>
                                    <img src="{{ asset($user->image ? 'storage/'.$user->image : 'assets/images/users/avatar-1.jpg') }}"
                                        alt="User Image" class="avatar-xs rounded-circle me-2">
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                        class="text-body align-middle fw-medium">{{ $user->first_name . ' ' . $user->last_name }}</a>
                                </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone ?? 'N/A'}}</td>
                                <td>{{ $user->created_at->format('M d, Y h:i A') }}</td>
                                <td>{{$user->updated_at->format('M d, Y h:i A') }}</td>

                                <td>
                                    <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="badge {{ $user->status ? 'badge-soft-success' : 'badge-soft-danger' }} p-2 border-0" style="cursor: pointer;">
                                            {{ $user->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.users.show', $user->id) }}">
                                                    <i class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    View
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.users.update', $user->id) }}">
                                                    <i class="fa-solid fa-pen-to-square font-size-16 align-middle me-2 text-muted"></i>
                                                    Edit
                                                </a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item remove-item-btn" onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No users found</td>
                            </tr>
                            @endforelse
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
                Showing <b>{{ $users->firstItem() }}</b> to
                <b>{{ $users->lastItem() }}</b> of
                <b>{{ $users->total() }}</b> results
            </p>
        </div>
        <div class="col-sm-auto ms-auto">
            <nav aria-label="...">
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $users->onFirstPage() ? 'true' : 'false' }}">
                            Previous
                        </a>
                    </li>

                    {{-- Pagination Elements --}}
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                    <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}" aria-current="{{ $users->currentPage() == $page ? 'page' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-disabled="{{ !$users->hasMorePages() ? 'true' : 'false' }}">
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

<!-- Status Toggle Confirmation -->
<div class="modal fade" id="statusToggleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Status Change</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to change this user's status?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="statusToggleForm" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Status toggle confirmation
        const statusToggleForms = document.querySelectorAll('form[action*="toggle-status"]');

        statusToggleForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show confirmation modal
                const modal = new bootstrap.Modal(document.getElementById('statusToggleModal'));
                modal.show();

                // Set up the form in the modal to submit the original form
                const confirmForm = document.getElementById('statusToggleForm');
                confirmForm.action = form.action;

                confirmForm.addEventListener('submit', function() {
                    form.submit();
                });
            });
        });

        // Simple form validation for add user modal
        const addUserForm = document.querySelector('#addUserModal form');
        if (addUserForm) {
            addUserForm.addEventListener('submit', function(e) {
                const password = document.getElementById('password');
                const confirmPassword = document.getElementById('password_confirmation');

                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    confirmPassword.focus();
                }
            });
        }
    });
</script>
@endsection