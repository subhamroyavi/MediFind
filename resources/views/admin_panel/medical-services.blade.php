@extends('layouts.admin_app')

@section('main-content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1"><a href="{{ route('admin.services') }}">Services Table</a></h4>
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
                    <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#serviceFormModal">
                        <i class="fa-solid fa-plus me-2"></i>{{ isset($editService) ? 'Edit' : 'Add New' }} Service
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
                                <th scope="col">Service ID</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Updated Date</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $service->service_id }}</td>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->created_at }}</td>
                                <td>{{ $service->updated_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical align-middle font-size-16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="">
                                                    <i class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.services.edit', $service->service_id) }}">
                                                    <i class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    Edit
                                                </a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.services.destroy', $service->service_id) }}" method="get">
                                                    @csrf
                                                    
                                                    <button type="submit" class="dropdown-item remove-item-btn">
                                                        <i class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                        Delete
                                                    </button>
                                                </form>
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
                Showing <b>{{ $services->firstItem() }}</b> to
                <b>{{ $services->lastItem() }}</b> of
                <b>{{ $services->total() }}</b> results
            </p>
        </div>
        <div class="col-sm-auto ms-auto">
            <nav aria-label="...">
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    <li class="page-item {{ $services->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $services->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $services->onFirstPage() ? 'true' : 'false' }}">
                            Previous
                        </a>
                    </li>

                    {{-- Pagination Elements --}}
                    @foreach ($services->getUrlRange(1, $services->lastPage()) as $page => $url)
                    <li class="page-item {{ $services->currentPage() == $page ? 'active' : '' }}" aria-current="{{ $services->currentPage() == $page ? 'page' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    <li class="page-item {{ !$services->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $services->nextPageUrl() }}" aria-disabled="{{ !$services->hasMorePages() ? 'true' : 'false' }}">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Service Form Modal (Combined Create/Edit) -->
<div class="modal fade" id="serviceFormModal" tabindex="-1" aria-labelledby="serviceFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceFormModalLabel">
                    {{ isset($editService) ? 'Edit Service' : 'Add New Service' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ isset($editService) ? route('admin.services.update', $editService->service_id) : route('admin.services.create') }}" method="{{ isset($editService) ? 'post' : 'get' }}">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="service_name" name="service_name"
                            value="{{ $editService->service_name ?? old('service_name') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($editService) ? 'Update' : 'Save' }} Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(isset($editService))
@push('scripts')
<script>
    $(document).ready(function() {
        $('#serviceFormModal').modal('show');
    });
</script>
@endpush
@endif
@endsection