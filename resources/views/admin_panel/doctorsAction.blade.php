@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-0">
                <h4 class="card-title mb-0 flex-grow-1">Doctors Management</h4>

                <!-- Search Form -->
                <form class="app-search d-none d-lg-block" method="GET" action="{{ route('admin.doctors.index') }}">
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
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Add New Doctor</h4>

                                <form action="{{ route('admin.doctors.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                                    name="first_name" value="{{ old('first_name') }}" >
                                                @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" >
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="experience_years" class="form-label">Experience (Years)</label>
                                                <input type="number" class="form-control @error('experience_years') is-invalid @enderror"
                                                    name="experience_years" value="{{ old('experience_years') }}">
                                                @error('experience_years')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                    name="last_name" value="{{ old('last_name') }}" >
                                                @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" value="{{ old('phone') }}">
                                                @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="home_town" class="form-label">Home Town</label>
                                                <input type="text" class="form-control @error('home_town') is-invalid @enderror"
                                                    name="home_town" value="{{ old('home_town') }}">
                                                @error('home_town')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Bottom Row -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="organization_type" class="form-label">Organization Type <span class="text-danger">*</span></label>
                                                <select class="form-select @error('organization_type') is-invalid @enderror"
                                                    name="organization_type" >
                                                    <option value="">Select Organization Type</option>
                                                    <option value="government" {{ old('organization_type') == 'government' ? 'selected' : '' }}>Government</option>
                                                    <option value="private" {{ old('organization_type') == 'private' ? 'selected' : '' }}>Private</option>
                                                    <option value="public" {{ old('organization_type') == 'public' ? 'selected' : '' }}>Public</option>
                                                </select>
                                                @error('organization_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Profile Image</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                    name="image" accept="image/*">
                                                @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Save Doctor</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection