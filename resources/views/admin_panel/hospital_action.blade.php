@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <a href="{{ route('admin.hospital') }}">hospital / </a>
                    @isset($hospital->hospital_id)
                    Edit Hospital /
                    <a href="#javascript: void(0);" class="text-body align-middle fw-medium">{{ $hospital->hospital_name }}</a>
                    @else
                    Hospital Registration Form
                    @endisset
                </h4>

                <form action="{{ isset($hospital->hospital_id) ? route('admin.hospital.update', $hospital->hospital_id) : route('admin.hospital.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($hospital->hospital_id)
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
                                    <a class="nav-link" data-bs-toggle="tab" href="#facilities-info" role="tab">
                                        <span>2. Facilities</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#services-info" role="tab">
                                        <span>3. Services</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#contact-info" role="tab">
                                        <span>4. Contact Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#opening-hours" role="tab">
                                        <span>5. Opening Hours</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#location-info" role="tab">
                                        <span>6. Location</span>
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
                                        <label class="form-label" for="hospital_name">Hospital Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('hospital_name') is-invalid @enderror"
                                            id="hospital_name" name="hospital_name"
                                            value="{{ old('hospital_name', $hospital->hospital_name ?? '') }}">
                                        @error('hospital_name')
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
                                            <option value="government" {{ old('organization_type', $hospital->organization_type ?? '') == 'government' ? 'selected' : '' }}>Government</option>
                                            <option value="private" {{ old('organization_type', $hospital->organization_type ?? '') == 'private' ? 'selected' : '' }}>Private</option>
                                            <option value="public" {{ old('organization_type', $hospital->organization_type ?? '') == 'public' ? 'selected' : '' }}>Public</option>
                                        </select>
                                        @error('organization_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description" rows="3">{{ old('description', $hospital->description ?? '') }}</textarea>
                                        @error('description')
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
                                        @if(isset($hospital->image))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/'.$hospital->image) }}" width="100" alt="Current Image">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="status">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" name="status"
                                                value="1"
                                                {{ old('status', $hospital->status ?? 0) == 1 ? 'checked' : '' }}>

                                        </div>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('facilities-info')">Next: Facilities</button>
                                </div>
                            </div>
                        </div>

                        <!-- Facilities Information Tab -->
                        <div class="tab-pane" id="facilities-info" role="tabpanel">
                            <div id="facilities-container">
                                @if(isset($hospital->facilities) && count($hospital->facilities) > 0)
                                @foreach($hospital->facilities as $index => $facility)
                                <div class="facility-entry mb-4 border p-3">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="facilities[{{ $index }}][description]">Facility Description</label>
                                                <textarea class="form-control @error('facilities.'.$index.'.description') is-invalid @enderror"
                                                    name="facilities[{{ $index }}][description]" rows="2">{{ old('facilities.'.$index.'.description', $facility->description) }}</textarea>
                                                @error('facilities.'.$index.'.description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="facilities[{{ $index }}][facility_id]" value="{{ $facility->facility_id }}">
                                    <button type="button" class="btn btn-sm btn-danger remove-facility">Remove</button>
                                </div>
                                @endforeach
                                @else
                                <div class="facility-entry mb-4 border p-3">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="facilities[0][description]">Facility Description</label>
                                                <textarea class="form-control @error('facilities.0.description') is-invalid @enderror"
                                                    name="facilities[0][description]" rows="2">{{ old('facilities.0.description') }}</textarea>
                                                @error('facilities.0.description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-facility">Remove</button>
                                </div>
                                @endif
                            </div>
                            <button type="button" id="add-facility" class="btn btn-sm btn-primary mb-3">Add Facility</button>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('basic-info')">Previous: Basic Info</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('services-info')">Next: Services</button>
                                </div>
                            </div>
                        </div>

                        <!-- Services Information Tab -->
                        <div class="tab-pane" id="services-info" role="tabpanel">
                            <div id="services-container">
                                @if(isset($hospital->services) && count($hospital->services) > 0)
                                @foreach($hospital->services as $index => $service)
                                <div class="service-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="services[{{ $index }}][service_name]">Service Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('services.'.$index.'.service_name') is-invalid @enderror"
                                                    name="services[{{ $index }}][service_name]"
                                                    value="{{ old('services.'.$index.'.service_name', $service->service_name) }}">
                                                @error('services.'.$index.'.service_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="services[{{ $index }}][service_id]" value="{{ $service->service_id }}">
                                    <button type="button" class="btn btn-sm btn-danger remove-service">Remove</button>
                                </div>
                                @endforeach
                                @else
                                <div class="service-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="services[0][service_name]">Service Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('services.0.service_name') is-invalid @enderror"
                                                    name="services[0][service_name]"
                                                    value="{{ old('services.0.service_name') }}">
                                                @error('services.0.service_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-danger remove-service">Remove</button>
                                </div>
                                @endif
                            </div>
                            <button type="button" id="add-service" class="btn btn-sm btn-primary mb-3">Add Service</button>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('facilities-info')">Previous: Facilities</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('contact-info')">Next: Contact Info</button>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Tab -->
                        <div class="tab-pane" id="contact-info" role="tabpanel">
                            <div id="contacts-container">
                                @if(isset($hospital->contacts) && count($hospital->contacts) > 0)
                                @foreach($hospital->contacts as $index => $contact)
                                <div class="contact-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="contacts[{{ $index }}][contact_type]">Contact Type <span class="text-danger">*</span></label>
                                                <select class="form-select @error('contacts.'.$index.'.contact_type') is-invalid @enderror"
                                                    name="contacts[{{ $index }}][contact_type]">
                                                    <option value="phone" {{ old('contacts.'.$index.'.contact_type', $contact->contact_type) == 'phone' ? 'selected' : '' }}>Phone</option>
                                                    <option value="email" {{ old('contacts.'.$index.'.contact_type', $contact->contact_type) == 'email' ? 'selected' : '' }}>Email</option>
                                                    <option value="fax" {{ old('contacts.'.$index.'.contact_type', $contact->contact_type) == 'fax' ? 'selected' : '' }}>Fax</option>
                                                    <option value="other" {{ old('contacts.'.$index.'.contact_type', $contact->contact_type) == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('contacts.'.$index.'.contact_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="contacts[{{ $index }}][value]">Value <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('contacts.'.$index.'.value') is-invalid @enderror"
                                                    name="contacts[{{ $index }}][value]"
                                                    value="{{ old('contacts.'.$index.'.value', $contact->value) }}">
                                                @error('contacts.'.$index.'.value')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="contacts[{{ $index }}][is_primary]">Primary</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="contacts[{{ $index }}][is_primary]"
                                                        value="1" {{ old('contacts.'.$index.'.is_primary', $contact->is_primary) ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="contacts[{{ $index }}][contact_id]" value="{{ $contact->contact_id }}">
                                    <button type="button" class="btn btn-sm btn-danger remove-contact">Remove</button>
                                </div>
                                @endforeach
                                @else
                                <div class="contact-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="contacts[0][contact_type]">Contact Type <span class="text-danger">*</span></label>
                                                <select class="form-select @error('contacts.0.contact_type') is-invalid @enderror"
                                                    name="contacts[0][contact_type]">
                                                    <option value="phone" {{ old('contacts.0.contact_type') == 'phone' ? 'selected' : '' }}>Phone</option>
                                                    <option value="email" {{ old('contacts.0.contact_type') == 'email' ? 'selected' : '' }}>Email</option>
                                                    <option value="fax" {{ old('contacts.0.contact_type') == 'fax' ? 'selected' : '' }}>Fax</option>
                                                    <option value="other" {{ old('contacts.0.contact_type') == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('contacts.0.contact_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="contacts[0][value]">Value <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('contacts.0.value') is-invalid @enderror"
                                                    name="contacts[0][value]"
                                                    value="{{ old('contacts.0.value') }}">
                                                @error('contacts.0.value')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="contacts[0][is_primary]">Primary</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="contacts[0][is_primary]"
                                                        value="1" {{ old('contacts.0.is_primary') ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-contact">Remove</button>
                                </div>
                                @endif
                            </div>
                            <button type="button" id="add-contact" class="btn btn-sm btn-primary mb-3">Add Contact</button>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="website_link">Website Link</label>
                                        <input type="url" class="form-control @error('website_link') is-invalid @enderror"
                                            id="website_link" name="website_link"
                                            value="{{ old('website_link', $hospital->website_link ?? '') }}">
                                        @error('website_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('services-info')">Previous: Services</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-primary" onclick="switchTab('opening-hours')">Next: Opening Hours</button>
                                </div>
                            </div>
                        </div>

                        <!-- Opening Hours Tab -->
                        <div class="tab-pane" id="opening-hours" role="tabpanel">
                            <div id="opening-hours-container">
                                @if(isset($hospital->openingDays) && count($hospital->openingDays) > 0)
                                @foreach($hospital->openingDays as $index => $day)
                                <div class="opening-day-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="opening_days[{{ $index }}][day]">Day <span class="text-danger">*</span></label>
                                                <select class="form-select @error('opening_days.'.$index.'.day') is-invalid @enderror"
                                                    name="opening_days[{{ $index }}][day]">
                                                    <option value="Monday" {{ old('opening_days.'.$index.'.day', $day->day) == 'Monday' ? 'selected' : '' }}>Monday</option>
                                                    <option value="Tuesday" {{ old('opening_days.'.$index.'.day', $day->day) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                                    <option value="Wednesday" {{ old('opening_days.'.$index.'.day', $day->day) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                                    <option value="Thursday" {{ old('opening_days.'.$index.'.day', $day->day) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                                    <option value="Friday" {{ old('opening_days.'.$index.'.day', $day->day) == 'Friday' ? 'selected' : '' }}>Friday</option>
                                                    <option value="Saturday" {{ old('opening_days.'.$index.'.day', $day->day) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                                    <option value="Sunday" {{ old('opening_days.'.$index.'.day', $day->day) == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                                </select>
                                                @error('opening_days.'.$index.'.day')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="opening_days[{{ $index }}][opening_time]">Opening Time</label>
                                                <input type="time" class="form-control @error('opening_days.'.$index.'.opening_time') is-invalid @enderror"
                                                    name="opening_days[{{ $index }}][opening_time]"
                                                    value="{{ old('opening_days.'.$index.'.opening_time', $day->opening_time) }}">
                                                @error('opening_days.'.$index.'.opening_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="opening_days[{{ $index }}][closing_time]">Closing Time</label>
                                                <input type="time" class="form-control @error('opening_days.'.$index.'.closing_time') is-invalid @enderror"
                                                    name="opening_days[{{ $index }}][closing_time]"
                                                    value="{{ old('opening_days.'.$index.'.closing_time', $day->closing_time) }}">
                                                @error('opening_days.'.$index.'.closing_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="opening_days[{{ $index }}][status]">Open</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="opening_days[{{ $index }}][status]"
                                                        value="1" {{ old('opening_days.'.$index.'.status', $day->status) ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-danger remove-opening-day">Remove</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="opening_days[{{ $index }}][opening_day_id]" value="{{ $day->opening_day_id }}">
                                </div>
                                @endforeach
                                @else
                                <div class="opening-day-entry mb-4 border p-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="opening_days[0][day]">Day <span class="text-danger">*</span></label>
                                                <select class="form-select @error('opening_days.0.day') is-invalid @enderror"
                                                    name="opening_days[0][day]">
                                                    <option value="Monday" {{ old('opening_days.0.day') == 'Monday' ? 'selected' : '' }}>Monday</option>
                                                    <option value="Tuesday" {{ old('opening_days.0.day') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                                    <option value="Wednesday" {{ old('opening_days.0.day') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                                    <option value="Thursday" {{ old('opening_days.0.day') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                                    <option value="Friday" {{ old('opening_days.0.day') == 'Friday' ? 'selected' : '' }}>Friday</option>
                                                    <option value="Saturday" {{ old('opening_days.0.day') == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                                    <option value="Sunday" {{ old('opening_days.0.day') == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                                </select>
                                                @error('opening_days.0.day')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="opening_days[0][opening_time]">Opening Time</label>
                                                <input type="time" class="form-control @error('opening_days.0.opening_time') is-invalid @enderror"
                                                    name="opening_days[0][opening_time]"
                                                    value="{{ old('opening_days.0.opening_time') }}">
                                                @error('opening_days.0.opening_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="opening_days[0][closing_time]">Closing Time</label>
                                                <input type="time" class="form-control @error('opening_days.0.closing_time') is-invalid @enderror"
                                                    name="opening_days[0][closing_time]"
                                                    value="{{ old('opening_days.0.closing_time') }}">
                                                @error('opening_days.0.closing_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="opening_days[0][status]">Open</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="opening_days[0][status]"
                                                        value="1" {{ old('opening_days.0.status') ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-danger remove-opening-day">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <button type="button" id="add-opening-day" class="btn btn-sm btn-primary mb-3">Add Opening Day</button>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('contact-info')">Previous: Contact Info</button>
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
                                            value="{{ old('address_line1', $hospital->location->address_line1 ?? '') }}">
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
                                            value="{{ old('address_line2', $hospital->location->address_line2 ?? '') }}">
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
                                            value="{{ old('city', $hospital->location->city ?? '') }}">
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
                                            value="{{ old('district', $hospital->location->district ?? '') }}">
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
                                            value="{{ old('state', $hospital->location->state ?? '') }}">
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
                                            value="{{ old('pincode', $hospital->location->pincode ?? '') }}">
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
                                            value="{{ old('country', $hospital->location->country ?? '') }}">
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
                                            value="{{ old('google_maps_link', $hospital->location->google_maps_link ?? '') }}">
                                        @error('google_maps_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden fields for location relationship -->
                            @if(isset($hospital->location))
                            <input type="hidden" name="location_id" value="{{ $hospital->location->location_id }}">
                            @endif
                            <input type="hidden" name="entity_type" value="hospital">
                            <input type="hidden" name="entity_id" value="{{ $hospital->hospital_id ?? '' }}">

                            <div class="row mt-4">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" onclick="switchTab('opening-hours')">Previous: Opening Hours</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-success">
                                        @isset($hospital->hospital_id)
                                        Update Hospital
                                        @else
                                        Register Hospital
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
        // Toggle day fields when day is enabled/disabled
        document.querySelectorAll('.day-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const dayFields = this.closest('.card').querySelector('.day-fields');
                if (this.checked) {
                    dayFields.style.display = 'block';
                } else {
                    dayFields.style.display = 'none';
                }
            });
        });

        // Initialize facility index
        let facilityIndex = document.querySelectorAll('.facility-entry').length;

        // Add facility entry
        document.getElementById('add-facility').addEventListener('click', function() {
            let container = document.getElementById('facilities-container');
            let template = container.querySelector('.facility-entry:last-child').cloneNode(true);
            let newEntry = document.createElement('div');
            newEntry.className = 'facility-entry mb-4 border p-3';

            // Get the current highest index
            let currentHighestIndex = 0;
            container.querySelectorAll('.facility-entry').forEach(entry => {
                const inputs = entry.querySelectorAll('[name^="facilities["]');
                if (inputs.length > 0) {
                    const matches = inputs[0].name.match(/facilities\[(\d+)\]/);
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
            let html = template.innerHTML.replace(/facilities\[\d+\]/g, `facilities[${newIndex}]`);
            newEntry.innerHTML = html;

            // Clear all input values
            newEntry.querySelectorAll('input').forEach(input => {
                if (input.type !== 'hidden' && !input.name.includes('[id]')) {
                    input.value = '';
                }
            });

            // Clear textarea values
            newEntry.querySelectorAll('textarea').forEach(textarea => {
                textarea.value = '';
            });

            // Add to container
            container.appendChild(newEntry);
        });

        // Initialize service index
        let serviceIndex = document.querySelectorAll('.service-entry').length;

        // Add service entry
        document.getElementById('add-service').addEventListener('click', function() {
            let container = document.getElementById('services-container');
            let template = container.querySelector('.service-entry:last-child').cloneNode(true);
            let newEntry = document.createElement('div');
            newEntry.className = 'service-entry mb-4 border p-3';

            // Get the current highest index
            let currentHighestIndex = 0;
            container.querySelectorAll('.service-entry').forEach(entry => {
                const inputs = entry.querySelectorAll('[name^="services["]');
                if (inputs.length > 0) {
                    const matches = inputs[0].name.match(/services\[(\d+)\]/);
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
            let html = template.innerHTML.replace(/services\[\d+\]/g, `services[${newIndex}]`);
            newEntry.innerHTML = html;

            // Clear all input values
            newEntry.querySelectorAll('input').forEach(input => {
                if (input.type !== 'hidden' && !input.name.includes('[id]')) {
                    input.value = '';
                }
            });

            // Clear textarea values
            newEntry.querySelectorAll('textarea').forEach(textarea => {
                textarea.value = '';
            });

            // Add to container
            container.appendChild(newEntry);
        });

        // Initialize contact index
        let contactIndex = document.querySelectorAll('.contact-entry').length;

        // Add contact entry
        document.getElementById('add-contact').addEventListener('click', function() {
            let container = document.getElementById('contacts-container');
            let template = container.querySelector('.contact-entry:last-child').cloneNode(true);
            let newEntry = document.createElement('div');
            newEntry.className = 'contact-entry mb-4 border p-3';

            // Get the current highest index
            let currentHighestIndex = 0;
            container.querySelectorAll('.contact-entry').forEach(entry => {
                const inputs = entry.querySelectorAll('[name^="contacts["]');
                if (inputs.length > 0) {
                    const matches = inputs[0].name.match(/contacts\[(\d+)\]/);
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
            let html = template.innerHTML.replace(/contacts\[\d+\]/g, `contacts[${newIndex}]`);
            newEntry.innerHTML = html;

            // Clear all input values
            newEntry.querySelectorAll('input').forEach(input => {
                if (input.type !== 'hidden' && !input.name.includes('[id]')) {
                    input.value = '';
                }
            });

            // Reset select to first option
            newEntry.querySelector('select').selectedIndex = 0;

            // Uncheck primary checkbox
            newEntry.querySelector('input[type="checkbox"]').checked = false;

            // Add to container
            container.appendChild(newEntry);
        });

        //openning enrty
        // Initialize opening day index
        let openingDayIndex = document.querySelectorAll('.opening-day-entry').length;

        // Add opening day entry
        document.getElementById('add-opening-day').addEventListener('click', function() {
            let container = document.getElementById('opening-hours-container');
            let template = container.querySelector('.opening-day-entry:last-child').cloneNode(true);
            let newEntry = document.createElement('div');
            newEntry.className = 'opening-day-entry mb-4 border p-3';

            // Get the current highest index
            let currentHighestIndex = 0;
            container.querySelectorAll('.opening-day-entry').forEach(entry => {
                const inputs = entry.querySelectorAll('[name^="opening_days["]');
                if (inputs.length > 0) {
                    const matches = inputs[0].name.match(/opening_days\[(\d+)\]/);
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
            let html = template.innerHTML.replace(/opening_days\[\d+\]/g, `opening_days[${newIndex}]`);
            newEntry.innerHTML = html;

            // Clear all input values
            newEntry.querySelectorAll('input').forEach(input => {
                if (input.type !== 'hidden' && !input.name.includes('[opening_day_id]')) {
                    input.value = '';
                    if (input.type === 'checkbox') {
                        input.checked = false;
                    }
                }
            });

            // Reset select to first option
            newEntry.querySelector('select').selectedIndex = 0;

            // Add to container
            container.appendChild(newEntry);
        });

        // Remove opening day entry
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-opening-day')) {
                e.target.closest('.opening-day-entry').remove();
            }
        });

        // Delegated event listeners for remove buttons
        document.addEventListener('click', function(e) {
            // Facility remove
            if (e.target.classList.contains('remove-facility')) {
                let container = document.getElementById('facilities-container');
                if (container.querySelectorAll('.facility-entry').length > 1) {
                    e.target.closest('.facility-entry').remove();
                } else {
                    alert('You need at least one facility entry.');
                }
            }

            // Service remove
            if (e.target.classList.contains('remove-service')) {
                let container = document.getElementById('services-container');
                if (container.querySelectorAll('.service-entry').length > 1) {
                    e.target.closest('.service-entry').remove();
                } else {
                    alert('You need at least one service entry.');
                }
            }

            // Contact remove
            if (e.target.classList.contains('remove-contact')) {
                let container = document.getElementById('contacts-container');
                if (container.querySelectorAll('.contact-entry').length > 1) {
                    e.target.closest('.contact-entry').remove();
                } else {
                    alert('You need at least one contact entry.');
                }
            }
        });
    });
</script>
@endsection