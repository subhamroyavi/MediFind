@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">Hospital Table</h4>

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
                    <a href="{{ route('admin.hospital.create') }}" class="btn btn-outline-primary waves-effect waves-light">
                        <i class="fa-solid fa-plus me-2"></i>Add New Hospital
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
                                <th scope="col">Hospital ID</th>
                                <th scope="col" style="width: 20%;">Hospital</th>
                                <th scope="col" style="width: 20%;">Description</th>
                                <th scope="col">Organization</th>
                                <th scope="col" style="width: 8%;">Status</th>
                                <th scope="col" style="width: 12%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($hospitals as $hospital)
                            <tr>
                                <td>
                                    <p class="fw-medium mb-0">{{ $hospital->hospital_id }}</p>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $hospital->image) }}" alt="{{$hospital->first_name}}"
                                        class="avatar-xs rounded-circle me-2">
                                    <a href="#javascript: void(0);"
                                        class="text-body align-middle fw-medium">{{ $hospital->hospital_name }}</a>
                                </td>

                                <td>
                                    <div class="description-container" style="max-width: 300px;">
                                        <div class="short-description">
                                            {{ Str::limit($hospital->description, 10, '...') }}
                                            @if(strlen($hospital->description) > 10)
                                                <a href="#" class="read-more-link text-primary" style="font-size: 12px;" 
                                                   data-bs-toggle="modal" data-bs-target="#descriptionModal"
                                                   data-description="{{ $hospital->description }}"
                                                   data-title="{{ $hospital->hospital_name }} Description">
                                                    Read more
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                
                                <td>{{ $hospital->organization_type }}</td>
                                <td>
                                    <span class="badge {{ $hospital->status == 1 ? 'badge-soft-success' : 'badge-soft-danger' }}  p-2">
                                        {{ $hospital->status == 1 ? 'Active' : 'Deactive' }}
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
                                                <button class="dropdown-item view-hospital-btn" data-id="{{ $hospital->id }}">
                                                    <i class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                    View
                                                </button>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.hospital.edit', ['id' => $hospital->hospital_id]) }}" class="dropdown-item edit-hospital-btn">
                                                    <i class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>Edit
                                                </a>
                                            </li>

                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a href="{{ route('admin.hospital.destroy', ['id' => $hospital->hospital_id]) }}" class="dropdown-item edit-hospital-btn">
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

<!-- Description Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Hospital Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDescriptionContent">
                <!-- Description content will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="col-sm-auto ms-auto">
    <div class="row align-items-center mb-4 gy-3">
        <div class="col-md-5">
            <p class="mb-0 text-muted">
                Showing <b>{{ $hospitals->firstItem() }}</b> to
                <b>{{ $hospitals->lastItem() }}</b> of
                <b>{{ $hospitals->total() }}</b> results
            </p>
        </div>
        <div class="col-sm-auto ms-auto">
            <nav aria-label="...">
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    <li class="page-item {{ $hospitals->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $hospitals->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $hospitals->onFirstPage() ? 'true' : 'false' }}">
                            Previous
                        </a>
                    </li>

                    {{-- Pagination Elements --}}
                    @foreach ($hospitals->getUrlRange(1, $hospitals->lastPage()) as $page => $url)
                    <li class="page-item {{ $hospitals->currentPage() == $page ? 'active' : '' }}" aria-current="{{ $hospitals->currentPage() == $page ? 'page' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    <li class="page-item {{ !$hospitals->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $hospitals->nextPageUrl() }}" aria-disabled="{{ !$hospitals->hasMorePages() ? 'true' : 'false' }}">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection

@section('js-content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // Handle the description modal
        $('#descriptionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var description = button.data('description');
            var title = button.data('title');
            
            var modal = $(this);
            modal.find('.modal-title').text(title);
            modal.find('.modal-body').html(description);
        });
    });
</script>
@endsection