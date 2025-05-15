@extends('layouts.admin_app')

@section('main-content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">
                                    @isset($ambulance->ambulance_id)
                                    Edit ambulance
                                    @else
                                    <a href="">Ambulance /</a> Add New ambulance
                                    @endisset
                                </h4>

                                <form action="{{ isset($ambulance->ambulance_id) ? route('admin.ambulance.update', $ambulance->ambulance_id) : route('admin.ambulance.store') }}"
                                    method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    

                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                                    name="first_name" value="{{ old('first_name', $ambulance->first_name ?? '') }}">
                                                @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email', $ambulance->email ?? '') }}">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="vehicle_number" class="form-label">Vehicle Number</label>
                                                <input type="text" class="form-control @error('vehicle_number') is-invalid @enderror"
                                                    name="vehicle_number" value="{{ old('vehicle_number', $ambulance->vehicle_number ?? '') }}">
                                                @error('vehicle_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                    name="last_name" value="{{ old('last_name', $ambulance->last_name ?? '') }}">
                                                @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" value="{{ old('phone', $ambulance->phone ?? '') }}">
                                                @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="service_type" class="form-label">Service Type<span class="text-danger">*</span></label>
                                                <select class="form-select @error('service_type') is-invalid @enderror"
                                                    name="service_type">
                                                    <option value="">Select Organization Type</option>
                                                    <option value="BLS" {{ old('service_type', $ambulance->service_type ?? '') == 'BLS' ? 'selected' : '' }}>BLS</option>
                                                    <option value="ALS" {{ old('service_type', $ambulance->service_type ?? '') == 'ALS' ? 'selected' : '' }}>ALS</option>
                                                    <option value="ICU" {{ old('service_type', $ambulance->service_type ?? '') == 'ICU' ? 'selected' : '' }}>ICU</option>
                                                    <option value="other" {{ old('service_type', $ambulance->service_type ?? '') == 'other' ? 'selected' : '' }}>Others</option>
                                                </select>
                                                @error('service_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Bottom Row -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="organization_type" class="form-label">Organization Type <span class="text-danger">*</span></label>
                                                <select class="form-select @error('organization_type') is-invalid @enderror"
                                                    name="organization_type">
                                                    <option value="">Select Organization Type</option>
                                                    <option value="government" {{ old('organization_type', $ambulance->organization_type ?? '') == 'government' ? 'selected' : '' }}>Government</option>
                                                    <option value="private" {{ old('organization_type', $ambulance->organization_type ?? '') == 'private' ? 'selected' : '' }}>Private</option>
                                                    <option value="public" {{ old('organization_type', $ambulance->organization_type ?? '') == 'public' ? 'selected' : '' }}>Public</option>
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
                                                    <option value="1" {{ old('status', $ambulance->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ old('status', $ambulance->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Profile Image</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                                                @if($errors->has('image'))
                                                <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                                @endif
                                                @isset($ambulance->image) <!-- Changed from $ambulance->image to $ambulance->image -->
                                                <div class="mt-2">
                                                    <image src="{{ asset('storage/' . $ambulance->image) }}" alt="Current Image" width="100" class="image-thumbnail">
                                                        <p class="text-muted small mt-1">Current Image</p>
                                                </div>
                                                @endisset
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <a href="{{ route('admin.ambulance.index') }}" class="btn btn-secondary">Cancel</a>
                                                <button type="submit" class="btn btn-primary">
                                                    @isset($ambulance->ambulance_id)
                                                    Update ambulance
                                                    @else
                                                    Save ambulance
                                                    @endisset
                                                </button>
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