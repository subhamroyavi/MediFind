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
                                    @isset($hospital->hospital_id)
                                    Edit hospital
                                    @else
                                    <a href="">hospital /</a> Add New hospital
                                    @endisset
                                </h4>

                                <form action="{{ isset($hospital->hospital_id) ? route('admin.hospital.update', $hospital->hospital_id) : route('admin.hospital.store') }}"
                                    method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    

                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Hospital Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hospital_name') is-invalid @enderror"
                                                    name="hospital_name" value="{{ old('hospital_name', $hospital->hospital_name ?? '') }}">
                                                @error('hospital_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="organization_type" class="form-label">Organization Type <span class="text-danger">*</span></label>
                                                <select class="form-select @error('organization_type') is-invalid @enderror"
                                                    name="organization_type">
                                                    <option value="">Select Organization Type</option>
                                                    <option value="government" {{ old('organization_type', $hospital->organization_type ?? '') == 'government' ? 'selected' : '' }}>Government</option>
                                                    <option value="private" {{ old('organization_type', $hospital->organization_type ?? '') == 'private' ? 'selected' : '' }}>Private</option>
                                                    <option value="public" {{ old('organization_type', $hospital->organization_type ?? '') == 'public' ? 'selected' : '' }}>Public</option>
                                                </select>
                                                @error('organization_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                                <input type="description" class="form-control @error('description') is-invalid @enderror"
                                                    name="description" value="{{ old('description', $hospital->description ?? '') }}">
                                                @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                                    <option value="1" {{ old('status', $hospital->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ old('status', $hospital->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            
                                        </div>

                                        <!-- Bottom Row -->
                                                                               <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Profile Image</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                                                @if($errors->has('image'))
                                                <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                                @endif
                                                @isset($hospital->image) <!-- Changed from $hospital->image to $hospital->image -->
                                                <div class="mt-2">
                                                    <image src="{{ asset('storage/' . $hospital->image) }}" alt="Current Image" width="100" class="image-thumbnail">
                                                        <p class="text-muted small mt-1">Current Image</p>
                                                </div>
                                                @endisset
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <a href="{{ route('admin.hospitals') }}" class="btn btn-secondary">Cancel</a>
                                                <button type="submit" class="btn btn-primary">
                                                    @isset($hospital->hospital_id)
                                                    Update hospital
                                                    @else
                                                    Save hospital
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