@extends('layouts.admin_app')

@section('main-content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"><a href="{{route('admin.hospitals')}}">Hospitals / </a>Hospital Registration Form</h4>

                <div id="basic-pills-wizard" class="twitter-bs-wizard">
                    
                    <ul class="twitter-bs-wizard-nav">
                        <li class="nav-item ">
                            <a href="#basic-info" class="nav-link" data-toggle="tab">
                                <span class="step-number">01. Basic Information</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="#facility-info" class="nav-link" data-toggle="tab">
                                <span class="step-number">02. Facility Details</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="#staff-info" class="nav-link" data-toggle="tab">
                                <span class="step-number">03. Staff Information</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#confirmation" class="nav-link" data-toggle="tab">
                                <span class="step-number">04. Confirmation</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#confirmation" class="nav-link" data-toggle="tab">
                                <span class="step-number">04. Confirmation</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#confirmation" class="nav-link" data-toggle="tab">
                                <span class="step-number">04. Confirmation</span>
                            </a>
                        </li>
                    </ul>


                    <div class="tab-content twitter-bs-wizard-tab-content">
                        <div class="tab-pane" id="basic-info">
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="hospital-name">Hospital Name</label>
                                            <input type="text" class="form-control" id="hospital-name" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="hospital-type">Hospital Type</label>
                                            <select class="form-select" id="hospital-type" required>
                                                <option value="">Select Type</option>
                                                <option value="general">General Hospital</option>
                                                <option value="specialty">Specialty Hospital</option>
                                                <option value="teaching">Teaching Hospital</option>
                                                <option value="clinic">Clinic</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone-number">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone-number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="address">Address</label>
                                            <textarea id="address" class="form-control" rows="2" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="city">City</label>
                                            <input type="text" class="form-control" id="city" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="postal-code">Postal Code</label>
                                            <input type="text" class="form-control" id="postal-code" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="facility-info">
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="beds">Number of Beds</label>
                                            <input type="number" class="form-control" id="beds" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="operation-theaters">Operation Theaters</label>
                                            <input type="number" class="form-control" id="operation-theaters" min="0" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Specialties Available</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="cardiology">
                                                <label class="form-check-label" for="cardiology">Cardiology</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="neurology">
                                                <label class="form-check-label" for="neurology">Neurology</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="orthopedics">
                                                <label class="form-check-label" for="orthopedics">Orthopedics</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="pediatrics">
                                                <label class="form-check-label" for="pediatrics">Pediatrics</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="facilities">Other Facilities</label>
                                            <textarea id="facilities" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="licence-number">Licence Number</label>
                                            <input type="text" class="form-control" id="licence-number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="licence-expiry">Licence Expiry Date</label>
                                            <input type="date" class="form-control" id="licence-expiry" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="staff-info">
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="doctors">Number of Doctors</label>
                                            <input type="number" class="form-control" id="doctors" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="nurses">Number of Nurses</label>
                                            <input type="number" class="form-control" id="nurses" min="0" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="administrative-staff">Administrative Staff</label>
                                            <input type="number" class="form-control" id="administrative-staff" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="support-staff">Support Staff</label>
                                            <input type="number" class="form-control" id="support-staff" min="0" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="director-name">Medical Director Name</label>
                                            <input type="text" class="form-control" id="director-name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="director-qualifications">Director Qualifications</label>
                                            <textarea id="director-qualifications" class="form-control" rows="2" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="confirmation">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                        </div>
                                        <div>
                                            <h5>Registration Complete</h5>
                                            <p class="text-muted">Thank you for registering your hospital. Your information will be reviewed and you'll receive a confirmation email shortly.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                        <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                        <li class="next"><a href="javascript: void(0);">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection