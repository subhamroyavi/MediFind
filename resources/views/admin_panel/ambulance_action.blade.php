@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <a href="{{ route('admin.ambulance.index') }}">Ambulances / </a>
                    @isset($ambulance->ambulance_id)
                    Edit Ambulance
                    @else
                    Ambulance Registration Form
                    @endisset
                </h4>


                <form action="{{ isset($ambulance->ambulance_id) ? route('admin.ambulance.update', $ambulance->ambulance_id) : route('admin.ambulance.store') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                  

                    <div class="row mb-4">
                        <div class="col-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#basic-info" role="tab">
                                        <span>1. Driver Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#vehicle-info" role="tab">
                                        <span>2. Vehicle Details</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#address-info" role="tab">
                                        <span>3. Address Details</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">
                        <!-- Driver Information Tab -->
                        <div class="tab-pane active" id="basic-info" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            id="first_name" name="first_name"
                                            value="{{ old('first_name', $ambulance->first_name ?? '') }}">
                                        @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            id="last_name" name="last_name"
                                            value="{{ old('last_name', $ambulance->last_name ?? '') }}">
                                        @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="image">Profile Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            name="image" accept="image/*">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($ambulance->image))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/'.$ambulance->image) }}" width="100" alt="Current Image">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone"
                                            value="{{ old('phone', $ambulance->phone ?? '') }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ old('email', $ambulance->email ?? '') }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="license_number">Driver's License Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('license_number') is-invalid @enderror"
                                            id="license_number" name="license_number"
                                            value="{{ old('license_number', $ambulance->license_number ?? '') }}">
                                        @error('license_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('vehicle-info')">Next: Vehicle Details</button>
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle Information Tab -->
                        <div class="tab-pane" id="vehicle-info" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="vehicle_number">Vehicle Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('vehicle_number') is-invalid @enderror"
                                            id="vehicle_number" name="vehicle_number"
                                            value="{{ old('vehicle_number', $ambulance->vehicle_number ?? '') }}">
                                        @error('vehicle_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="vehicle_model">Vehicle Model <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('vehicle_model') is-invalid @enderror"
                                            id="vehicle_model" name="vehicle_model"
                                            value="{{ old('vehicle_model', $ambulance->vehicle_model ?? '') }}">
                                        @error('vehicle_model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="organization_type">Organization Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('organization_type') is-invalid @enderror"
                                            id="organization_type" name="organization_type">
                                            <option value="">Select Vehicle Type</option>
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
                                        <label class="form-label" for="service_type">Service Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('service_type') is-invalid @enderror"
                                            id="service_type" name="service_type">
                                            <option value="">Select Service Type</option>
                                            <option value="BLS" {{ old('service_type', $ambulance->service_type ?? '') == 'BLS' ? 'selected' : '' }}>BLS</option>
                                            <option value="ALS" {{ old('service_type', $ambulance->service_type ?? '') == 'ALS' ? 'selected' : '' }}>ALS</option>
                                            <option value="ICU" {{ old('service_type', $ambulance->service_type ?? '') == 'ICU' ? 'selected' : '' }}>ICU</option>
                                        </select>

                                        @error('service_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror"
                                            name="status">
                                            <option value="1" {{ old('status', $ambulance->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $ambulance->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="insurance_number">Insurance Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('insurance_number') is-invalid @enderror"
                                            id="insurance_number" name="insurance_number"
                                            value="{{ old('insurance_number', $ambulance->insurance_number ?? '') }}">
                                        @error('insurance_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('basic-info')">Previous: Driver Info</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('address-info')">Next: Address Details</button>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information Tab -->
                        <div class="tab-pane" id="address-info" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="address_line1">Address Line 1 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('address_line1') is-invalid @enderror"
                                            id="address_line1" name="address_line1"
                                            value="{{ old('address_line1', $ambulance->location->address_line1 ?? '') }}">
                                        @error('address_line1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="address_line2">Address Line 2</label>
                                        <input type="text" class="form-control @error('address_line2') is-invalid @enderror"
                                            id="address_line2" name="address_line2"
                                            value="{{ old('address_line2', $ambulance->location->address_line2 ?? '') }}">
                                        @error('address_line2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            id="city" name="city"
                                            value="{{ old('city', $ambulance->location->city ?? '') }}">
                                        @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="district">District <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('district') is-invalid @enderror"
                                            id="district" name="district"
                                            value="{{ old('district', $ambulance->location->district ?? '') }}">
                                        @error('district')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="state">State <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror"
                                            id="state" name="state"
                                            value="{{ old('state', $ambulance->location->state ?? '') }}">
                                        @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="pincode">Pincode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pincode') is-invalid @enderror"
                                            id="pincode" name="pincode"
                                            value="{{ old('pincode', $ambulance->location->pincode ?? '') }}">
                                        @error('pincode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror"
                                            id="country" name="country"
                                            value="{{ old('country', $ambulance->location->country ?? 'India') }}">
                                        @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="pincode">Google Maps Link <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('google_maps_link') is-invalid @enderror"
                                            id="google_maps_link" name="google_maps_link"
                                            value="{{ old('google_maps_link', $ambulance->location->google_maps_link ?? '') }}">
                                        @error('google_maps_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('vehicle-info')">Previous: Vehicle Details</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-success">
                                        @isset($ambulance->ambulance_id)
                                        Update Ambulance
                                        @else
                                        Register Ambulance
                                        @endisset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-content')
<script>
    // Simple tab switching function
    function switchTab(tabId) {
        // Hide all tabs
        document.querySelectorAll('.tab-pane').forEach(tab => {
            tab.classList.remove('active', 'show');
        });

        // Show selected tab
        document.getElementById(tabId).classList.add('active', 'show');

        // Update nav-tabs active state
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + tabId) {
                link.classList.add('active');
            }
        });
    }
</script>
@endsection