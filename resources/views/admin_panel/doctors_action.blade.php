@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <a href="{{ route('admin.doctors.index') }}">Doctors / </a>
                    @isset($doctor->doctor_id)
                    Edit Doctor
                    @else
                    Doctor Registration Form
                    @endisset
                </h4>

                <form action="{{ isset($doctor->doctor_id) ? route('admin.doctor.update', $doctor->doctor_id) : route('admin.doctors.store') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @isset($doctor->doctor_id)
                    @method('PUT')
                    @endisset

                    <div class="row mb-4">
                        <div class="col-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#basic-info" role="tab">
                                        <span>1. Basic Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#professional-info" role="tab">
                                        <span>2. Professional Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#education-info" role="tab">
                                        <span>3. Education</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#experience-info" role="tab">
                                        <span>4. Experience</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#location-info" role="tab">
                                        <span>5. Location</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">
                        <!-- Basic Information Tab -->
                        <div class="tab-pane active" id="basic-info" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            id="first_name" name="first_name"
                                            value="{{ old('first_name', $doctor->first_name ?? '') }}">
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
                                            value="{{ old('last_name', $doctor->last_name ?? '') }}">
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
                                        @if(isset($doctor->image))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/'.$doctor->image) }}" width="100" alt="Current Image">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone"
                                            value="{{ old('phone', $doctor->phone ?? '') }}">
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
                                            value="{{ old('email', $doctor->email ?? '') }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="small_description">Description About Doctor</label>
                                        <input type="text" class="form-control @error('small_description') is-invalid @enderror"
                                            id="small_description" name="small_description"
                                            value="{{ old('small_description', $doctor->small_description ?? '') }}">
                                        @error('small_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('professional-info')">Next: Professional Info</button>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information Tab -->
                        <div class="tab-pane" id="professional-info" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="specialization">Specialization <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('specialization') is-invalid @enderror"
                                            id="specialization" name="specialization"
                                            value="{{ old('specialization', $doctor->specialization ?? '') }}">
                                        @error('specialization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="organization_type">Organization Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('organization_type') is-invalid @enderror"
                                            id="organization_type" name="organization_type">
                                            <option value="">Select Organization Type</option>
                                            <option value="government" {{ old('organization_type', $doctor->organization_type ?? '') == 'government' ? 'selected' : '' }}>Government</option>
                                            <option value="private" {{ old('organization_type', $doctor->organization_type ?? '') == 'private' ? 'selected' : '' }}>Private</option>
                                            <option value="public" {{ old('organization_type', $doctor->organization_type ?? '') == 'public' ? 'selected' : '' }}>Public</option>
                                        </select>
                                        @error('organization_type')
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
                                            <option value="1" {{ old('status', $doctor->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $doctor->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('basic-info')">Previous: Basic Info</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('education-info')">Next: Education</button>
                                </div>
                            </div>
                        </div>

                        <!-- Education Information Tab -->
                        <div class="tab-pane" id="education-info" role="tabpanel">
                            <div id="education-container">
                                @if(isset($doctor->educations) && count($doctor->educations) > 0)
                                @foreach($doctor->educations as $index => $education)
                                <div class="education-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="educations[{{ $index }}][course_name]">Course Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('educations.'.$index.'.course_name') is-invalid @enderror"
                                                    name="educations[{{ $index }}][course_name]"
                                                    value="{{ old('educations.'.$index.'.course_name', $education->course_name) }}">
                                                @error('educations.'.$index.'.course_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="educations[{{ $index }}][university]">University <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('educations.'.$index.'.university') is-invalid @enderror"
                                                    name="educations[{{ $index }}][university]"
                                                    value="{{ old('educations.'.$index.'.university', $education->university) }}">
                                                @error('educations.'.$index.'.university')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="educations[{{ $index }}][year]">Completion Year <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('educations.'.$index.'.year') is-invalid @enderror"
                                                    name="educations[{{ $index }}][year]" 
                                                    placeholder="YYYY"
                                                    value="{{ old('educations.'.$index.'.year', $education->year) }}">
                                                @error('educations.'.$index.'.year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="educations[{{ $index }}][country]">Country</label>
                                                <input type="text" class="form-control @error('educations.'.$index.'.country') is-invalid @enderror"
                                                    name="educations[{{ $index }}][country]"
                                                    value="{{ old('educations.'.$index.'.country', $education->country) }}">
                                                @error('educations.'.$index.'.country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="educations[{{ $index }}][id]" value="{{ $education->id }}">
                                    <button type="button" class="btn btn-sm btn-danger remove-education">Remove</button>
                                </div>
                                @endforeach
                                @else
                                <div class="education-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="educations[0][course_name]">Course Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('educations.0.course_name') is-invalid @enderror"
                                                    name="educations[0][course_name]"
                                                    value="{{ old('educations.0.course_name') }}">
                                                @error('educations.0.course_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="educations[0][university]">University <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('educations.0.university') is-invalid @enderror"
                                                    name="educations[0][university]"
                                                    value="{{ old('educations.0.university') }}">
                                                @error('educations.0.university')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="educations[0][year]">Completion Year <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('educations.0.year') is-invalid @enderror"
                                                    name="educations[0][year]" 
                                                    placeholder="YYYY"
                                                    value="{{ old('educations.0.year') }}">
                                                @error('educations.0.year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="educations[0][country]">Country</label>
                                                <input type="text" class="form-control @error('educations.0.country') is-invalid @enderror"
                                                    name="educations[0][country]"
                                                    value="{{ old('educations.0.country') }}">
                                                @error('educations.0.country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-education">Remove</button>
                                </div>
                                @endif
                            </div>
                            <button type="button" id="add-education" class="btn btn-sm btn-primary mb-3">Add Education</button>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('professional-info')">Previous: Professional Info</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('experience-info')">Next: Experience</button>
                                </div>
                            </div>
                        </div>

                        <!-- Experience Information Tab -->
                        <div class="tab-pane" id="experience-info" role="tabpanel">
                            <div id="experience-container">
                                @if(isset($doctor->experiences) && count($doctor->experiences) > 0)
                                @foreach($doctor->experiences as $index => $experience)
                                <div class="experience-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="experiences[{{ $index }}][position]">Position <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('experiences.'.$index.'.position') is-invalid @enderror"
                                                    name="experiences[{{ $index }}][position]"
                                                    value="{{ old('experiences.'.$index.'.position', $experience->position) }}">
                                                @error('experiences.'.$index.'.position')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="hospital_select">Hospital</label>
                                                <input type="text" class="form-control new-hospital-input @error('new_hospital_name') is-invalid @enderror"
                                                    id="new_hospital_name_0" name="experiences[0][new_hospital_name]"
                                                    placeholder="Enter new hospital name" value="{{ old('experiences.0.new_hospital_name') }}">
                                                @error('experiences.0.new_hospital_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="experiences[{{ $index }}][start_year]">Start Year</label>
                                                <input type="text" class="form-control @error('experiences.'.$index.'.start_year') is-invalid @enderror"
                                                    name="experiences[{{ $index }}][start_year]" 
                                                    placeholder="YYYY"
                                                    value="{{ old('experiences.'.$index.'.start_year', $experience->start_year) }}">
                                                @error('experiences.'.$index.'.start_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="experiences[{{ $index }}][end_year]">End Year</label>
                                                <input type="text" class="form-control @error('experiences.'.$index.'.end_year') is-invalid @enderror"
                                                    name="experiences[{{ $index }}][end_year]" 
                                                    placeholder="YYYY"
                                                    value="{{ old('experiences.'.$index.'.end_year', $experience->end_year) }}">
                                                @error('experiences.'.$index.'.end_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="experiences[{{ $index }}][status]">Status</label>
                                                <select class="form-select @error('experiences.'.$index.'.status') is-invalid @enderror"
                                                    name="experiences[{{ $index }}][status]">
                                                    <option value="1" {{ old('experiences.'.$index.'.status', $experience->status) == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ old('experiences.'.$index.'.status', $experience->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('experiences.'.$index.'.status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="experiences[{{ $index }}][id]" value="{{ $experience->id }}">
                                    <button type="button" class="btn btn-sm btn-danger remove-experience">Remove</button>
                                </div>
                                @endforeach
                                @else
                                <div class="experience-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="experiences[0][position]">Position <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('experiences.0.position') is-invalid @enderror"
                                                    name="experiences[0][position]"
                                                    value="{{ old('experiences.0.position') }}">
                                                @error('experiences.0.position')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="hospital_select">Hospital</label>
                                                <input type="text" class="form-control new-hospital-input @error('new_hospital_name') is-invalid @enderror"
                                                    id="new_hospital_name_0" name="experiences[0][new_hospital_name]"
                                                    placeholder="Enter new hospital name" value="{{ old('experiences.0.new_hospital_name') }}">
                                                @error('experiences.0.new_hospital_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="experiences[0][start_year]">Start Year</label>
                                                <input type="text" class="form-control @error('experiences.0.start_year') is-invalid @enderror"
                                                    name="experiences[0][start_year]" 
                                                    placeholder="YYYY"
                                                    value="{{ old('experiences.0.start_year') }}">
                                                @error('experiences.0.start_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="experiences[0][end_year]">End Year</label>
                                                <input type="text" class="form-control @error('experiences.0.end_year') is-invalid @enderror"
                                                    name="experiences[0][end_year]" 
                                                    placeholder="YYYY"
                                                    value="{{ old('experiences.0.end_year') }}">
                                                @error('experiences.0.end_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="experiences[0][status]">Status</label>
                                                <select class="form-select @error('experiences.0.status') is-invalid @enderror"
                                                    name="experiences[0][status]">
                                                    <option value="1" {{ old('experiences.0.status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ old('experiences.0.status') == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('experiences.0.status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-experience">Remove</button>
                                </div>
                                @endif
                            </div>
                            <button type="button" id="add-experience" class="btn btn-sm btn-primary mb-3">Add Experience</button>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('education-info')">Previous: Education</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('location-info')">Next: Location</button>
                                </div>
                            </div>
                        </div>

                        <!-- Location Information Tab -->
                        <div class="tab-pane" id="location-info" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="address_line1">Address Line 1 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('address_line1') is-invalid @enderror"
                                            id="address_line1" name="address_line1"
                                            value="{{ old('address_line1', $doctor->location->address_line1 ?? '') }}">
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
                                            value="{{ old('address_line2', $doctor->location->address_line2 ?? '') }}">
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
                                            value="{{ old('city', $doctor->location->city ?? '') }}">
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
                                            value="{{ old('district', $doctor->location->district ?? '') }}">
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
                                            value="{{ old('state', $doctor->location->state ?? '') }}">
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
                                            value="{{ old('pincode', $doctor->location->pincode ?? '') }}">
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
                                            value="{{ old('country', $doctor->location->country ?? '') }}">
                                        @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="google_maps_link">Google Maps Link</label>
                                        <input type="url" class="form-control @error('google_maps_link') is-invalid @enderror"
                                            id="google_maps_link" name="google_maps_link"
                                            value="{{ old('google_maps_link', $doctor->location->google_maps_link ?? '') }}">
                                        @error('google_maps_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden fields for location relationship -->
                            @if(isset($doctor->location))
                            <input type="hidden" name="location_id" value="{{ $doctor->location->location_id }}">
                            @endif
                            <input type="hidden" name="entity_type" value="doctor">
                            <input type="hidden" name="entity_id" value="{{ $doctor->doctor_id ?? '' }}">

                            <div class="row mt-4">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('experience-info')">Previous: Experience</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-success">
                                        @isset($doctor->doctor_id)
                                        Update Doctor
                                        @else
                                        Register Doctor
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize education index
        let educationIndex = document.querySelectorAll('.education-entry').length;
        
        // Add education entry
        document.getElementById('add-education').addEventListener('click', function() {
            let container = document.getElementById('education-container');
            let template = container.querySelector('.education-entry:last-child').cloneNode(true);
            let newEntry = document.createElement('div');
            newEntry.className = 'education-entry mb-4 border p-3';
            
            // Get the current highest index
            let currentHighestIndex = 0;
            container.querySelectorAll('.education-entry').forEach(entry => {
                const inputs = entry.querySelectorAll('[name^="educations["]');
                if (inputs.length > 0) {
                    const matches = inputs[0].name.match(/educations\[(\d+)\]/);
                    if (matches && matches[1]) {
                        const index = parseInt(matches[1]);
                        if (index > currentHighestIndex) {
                            currentHighestIndex = index;
                        }
                    }
                }
            });
            
            const newIndex = currentHighestIndex + 1;
            
            // Replace all indices with the new index
            let html = template.innerHTML.replace(/educations\[\d+\]/g, `educations[${newIndex}]`);
            newEntry.innerHTML = html;

            // Clear all input values
            newEntry.querySelectorAll('input').forEach(input => {
                if (input.type !== 'hidden' && !input.name.includes('[id]')) {
                    input.value = '';
                }
            });

            // Add to container
            container.appendChild(newEntry);
        });

        // Initialize experience index
        let experienceIndex = document.querySelectorAll('.experience-entry').length;

        // Add experience entry
        document.getElementById('add-experience').addEventListener('click', function() {
            let container = document.getElementById('experience-container');
            let template = container.querySelector('.experience-entry:last-child').cloneNode(true);
            let newEntry = document.createElement('div');
            newEntry.className = 'experience-entry mb-4 border p-3';
            
            // Get the current highest index
            let currentHighestIndex = 0;
            container.querySelectorAll('.experience-entry').forEach(entry => {
                const inputs = entry.querySelectorAll('[name^="experiences["]');
                if (inputs.length > 0) {
                    const matches = inputs[0].name.match(/experiences\[(\d+)\]/);
                    if (matches && matches[1]) {
                        const index = parseInt(matches[1]);
                        if (index > currentHighestIndex) {
                            currentHighestIndex = index;
                        }
                    }
                }
            });
            
            const newIndex = currentHighestIndex + 1;
            
            // Replace all indices with the new index
            let html = template.innerHTML.replace(/experiences\[\d+\]/g, `experiences[${newIndex}]`);
            html = html.replace(/new_hospital_name_\d+/g, `new_hospital_name_${newIndex}`);
            newEntry.innerHTML = html;

            // Clear all input values
            newEntry.querySelectorAll('input').forEach(input => {
                if (input.type !== 'hidden' && !input.name.includes('[id]')) {
                    input.value = '';
                }
            });

            // Reset select to first option
            newEntry.querySelector('select').selectedIndex = 0;

            // Add to container
            container.appendChild(newEntry);
        });

        // Delegated event listeners for remove buttons
        document.addEventListener('click', function(e) {
            // Education remove
            if (e.target.classList.contains('remove-education')) {
                let container = document.getElementById('education-container');
                if (container.querySelectorAll('.education-entry').length > 1) {
                    e.target.closest('.education-entry').remove();
                } else {
                    alert('You need at least one education entry.');
                }
            }

            // Experience remove
            if (e.target.classList.contains('remove-experience')) {
                let container = document.getElementById('experience-container');
                if (container.querySelectorAll('.experience-entry').length > 1) {
                    e.target.closest('.experience-entry').remove();
                } else {
                    alert('You need at least one experience entry.');
                }
            }
        });

        // Validate year inputs to only allow numbers
        document.addEventListener('input', function(e) {
            if (e.target.name && (e.target.name.includes('[year]') || 
                                 e.target.name.includes('[start_year]') || 
                                 e.target.name.includes('[end_year]'))) {
                // Remove any non-digit characters
                e.target.value = e.target.value.replace(/\D/g, '');
                
                // Limit to 4 digits
                if (e.target.value.length > 4) {
                    e.target.value = e.target.value.slice(0, 4);
                }
            }
        });
    });
</script>
@endsection