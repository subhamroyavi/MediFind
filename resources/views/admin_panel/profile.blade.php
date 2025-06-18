@extends('layouts.admin_app')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Profile Header Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Profile</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                    </a>
                </div>
            </div>

            <!-- Main Profile Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Alert Messages -->
                    <!-- Success & Error Alerts -->
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    @endif
                    @php
                    $adminUser = Auth::guard('admin')->user();

                    $formattedDob = $adminUser->dob ? date('d M Y', strtotime($adminUser->dob)) : 'Not specified';
                    @endphp

                    <!-- Profile Header -->
                    <div class="profile-header mb-4">
                        <div class="d-flex align-items-center">
                            <div class="me-4">
                                <img src="{{ asset('storage/' . $adminUser->image) }}"
                                    alt="Profile Photo"
                                    class="rounded-circle avatar-xl"
                                    onerror="this.src=''">
                            </div>
                            <div>
                                <h3 class="mb-1">{{ $adminUser->first_name.' '.$adminUser->last_name }}</h3>
                                <p class="text-muted mb-2">Member since {{ date('d M Y', strtotime($adminUser->created_at)) }}</p>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary" id="editProfileBtn">
                                        <i class="fas fa-edit me-1"></i> Edit Profile
                                    </button>
                                    <button class="btn btn-outline-secondary" id="cancelEditBtn" style="display: none;">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <!-- View Mode -->
                                    <div id="personalInfoView">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th width="30%">Full Name:</th>
                                                        <td id="viewFullName">{{ $adminUser->first_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Date of Birth:</th>
                                                        <td id="viewDob">{{ $adminUser->dob ? date('d M Y', strtotime($adminUser->dob)) : 'Not specified' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Gender:</th>
                                                        <td id="viewGender">{{ $adminUser->gender ?? 'Not specified' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Blood Type:</th>
                                                        <td>{{ $adminUser->bloodType ?? 'Not specified' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Edit Mode -->
                                    <form id="personalInfoForm" style="display: none;"
                                        action="{{ route('admin.profile.update') }}"
                                        method="post"
                                        enctype="multipart/form-data">
                                        @csrf


                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">First Name *</label>
                                                <input type="text" class="form-control" id="firstName"
                                                    name="first_name" value="{{ $adminUser->first_name }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label">Last Name *</label>
                                                <input type="text" class="form-control" id="lastName"
                                                    name="last_name" value="{{ $adminUser->last_name }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dob" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" id="dob"
                                                    name="dob" value="{{ $adminUser->dob }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select class="form-select" id="gender" name="gender">
                                                    <option value="">Select</option>
                                                    @foreach(['Male', 'Female', 'Other'] as $option)
                                                    <option value="{{ $option }}" {{ $adminUser->gender == $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="bloodType" class="form-label">Blood Type</label>
                                                <select class="form-select" id="bloodType" name="bloodType">
                                                    <option value="">Select</option>
                                                    @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $group)
                                                    <option value="{{ $group }}" {{ $adminUser->bloodType == $group ? 'selected' : '' }}>
                                                        {{ $group }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="avatarUpload" class="form-label">Profile Photo</label>
                                                <input type="file" class="form-control" id="avatarUpload"
                                                    name="image" accept="image/*">
                                                <small class="text-muted">Max 2MB (JPEG, PNG, JPG)</small>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i> Save Changes
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary" id="cancelPersonalEdit">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Contact Information</h5>
                                </div>
                                <div class="card-body">
                                    <!-- View Mode -->
                                    <div id="contactInfoView">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th width="30%">Email:</th>
                                                        <td id="viewEmail">{{ $adminUser->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone:</th>
                                                        <td id="viewPhone">{{ $adminUser->phone ?? 'Not specified' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address:</th>
                                                        <td id="viewAddress">{{ $adminUser->address ?? 'Not specified' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Edit Mode -->
                                    <form id="contactInfoForm" style="display: none;"
                                        action="{{ route('admin.profile.update') }}"
                                        method="post"
                                        class="needs-validation"
                                        novalidate>
                                        @csrf


                                        <div class="row g-3">
                                            <div class="col-md-12 mb-3">
                                                <label for="email" class="form-label">Email *</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ $adminUser->email }}" readonly
                                                        placeholder="example@domain.com">
                                                    <div class="invalid-feedback">
                                                        Please provide a valid email address.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    <input type="tel" class="form-control" id="phone"
                                                        name="phone" value="{{ $adminUser->phone }}"
                                                        placeholder="+1 (123) 456-7890">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="address" class="form-label">Pincode/Zip Code</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" class="form-control" id="address"
                                                        name="address" value="{{ $adminUser->address }}"
                                                        placeholder="e.g. 12345 or A1B 2C3">
                                                </div>
                                            </div>

                                            <div class="col-12 mt-4 d-flex justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary me-2" id="cancelContactEdit">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i> Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Account Settings Section -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Account Settings</h5>
                                </div>
                                <div class="card-body">
                                    <!-- View Mode -->
                                    <div id="accountSettingsView">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th width="30%">Password</th>
                                                        <td>********</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Account Status</th>
                                                        <td>
                                                            <span class="badge bg-{{ $adminUser->status ? 'success' : 'danger' }}">
                                                                {{ $adminUser->status ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Role</th>
                                                        <td>
                                                            <span class="badge bg-info">
                                                                {{ ucfirst($adminUser->user_status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-4 d-flex gap-2">
                                            <button class="btn btn-outline-primary" id="changePasswordBtn">
                                                <i class="fas fa-key me-1"></i> Change Password
                                            </button>
                                            <a href="{{ route('admin.logout') }}" class="btn btn-outline-danger">
                                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Change Password Form -->
                                    <form id="changePasswordForm" style="display: none;"
                                        action="{{ route('admin.change-password') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" id="currentPassword" name="email" value="{{ $adminUser->email }}">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="currentPassword" class="form-label">Current Password *</label>
                                                <input type="password" class="form-control" id="currentPassword"
                                                    name="current_password" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="newPassword" class="form-label">New Password *</label>
                                                <input type="password" class="form-control" id="newPassword"
                                                    name="password" required minlength="5">
                                                <small class="text-muted">Minimum 8 characters</small>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="confirmPassword" class="form-label">Confirm New Password *</label>
                                                <input type="password" class="form-control" id="confirmPassword"
                                                    name="password_confirmation" required>
                                            </div>
                                            <div class="col-12 mt-3 d-flex justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary" id="cancelPasswordChange">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i> Update Password
                                                </button>
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
</div>
@endsection

@section('js-content')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DOM Elements
        const editProfileBtn = document.getElementById('editProfileBtn');
        const cancelEditBtn = document.getElementById('cancelEditBtn');

        // Personal Info Elements
        const personalInfoView = document.getElementById('personalInfoView');
        const personalInfoForm = document.getElementById('personalInfoForm');
        const cancelPersonalEdit = document.getElementById('cancelPersonalEdit');

        // Contact Info Elements
        const contactInfoView = document.getElementById('contactInfoView');
        const contactInfoForm = document.getElementById('contactInfoForm');
        const cancelContactEdit = document.getElementById('cancelContactEdit');

        // Account Settings Elements
        const changePasswordBtn = document.getElementById('changePasswordBtn');
        const cancelPasswordChange = document.getElementById('cancelPasswordChange');
        const changePasswordForm = document.getElementById('changePasswordForm');
        const accountSettingsView = document.getElementById('accountSettingsView');

        // Toggle Edit Mode
        function toggleEditMode(showEdit) {
            if (showEdit) {
                personalInfoView.style.display = 'none';
                personalInfoForm.style.display = 'block';
                contactInfoView.style.display = 'none';
                contactInfoForm.style.display = 'block';
                editProfileBtn.style.display = 'none';
                cancelEditBtn.style.display = 'inline-block';
            } else {
                personalInfoView.style.display = 'block';
                personalInfoForm.style.display = 'none';
                contactInfoView.style.display = 'block';
                contactInfoForm.style.display = 'none';
                editProfileBtn.style.display = 'inline-block';
                cancelEditBtn.style.display = 'none';
                changePasswordForm.style.display = 'none';
                accountSettingsView.style.display = 'block';
            }
        }

        // Event Listeners
        editProfileBtn?.addEventListener('click', () => toggleEditMode(true));
        cancelEditBtn?.addEventListener('click', () => toggleEditMode(false));
        cancelPersonalEdit?.addEventListener('click', () => toggleEditMode(false));
        cancelContactEdit?.addEventListener('click', () => toggleEditMode(false));

        // Password Form Toggle
        changePasswordBtn?.addEventListener('click', () => {
            changePasswordForm.style.display = 'block';
            accountSettingsView.style.display = 'none';
        });

        cancelPasswordChange?.addEventListener('click', () => {
            changePasswordForm.style.display = 'none';
            accountSettingsView.style.display = 'block';
        });

        // Form Validation
        (function initFormValidation() {
            const forms = document.querySelectorAll('.needs-validation');

            forms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Auto-dismiss alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection