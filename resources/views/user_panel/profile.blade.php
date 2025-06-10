@extends('layouts.app')

@section('main-content')

<!-- Main Content -->
<main class="section">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html">Home</a>
            <span>/</span>
            <a href="profile.html">My Profile</a>
        </div>
        @php
        $user = Auth::user();
        @endphp
        <div class="profile-header">
            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Photo" class="profile-avatar" id="profileAvatar">
            <div>
                <h1 id="profileName">{{ $user->first_name.' '.$user->last_name }}</h1>
                <p>Member since <span id="memberSince"></span></p>
                <div class="profile-actions">
                    <button class="btn btn-primary" id="editProfileBtn">Edit Profile</button>
                    <button class="btn btn-secondary" id="cancelEditBtn" style="display: none;">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="profile-section">
            <h2>Personal Information</h2>

            <div id="personalInfoView">
                <div class="profile-details">
                    <div class="detail-item">
                        <label>Full Name</label>
                        <div class="value" id="viewFullName">{{ $user->first_name.' '.$user->last_name }}</div>
                        <label>Blood Type : {{ $user->bloodType ?? 'Not specified' }}</label>

                    </div>
                    <div class="detail-item">
                        <label>Date of Birth</label>
                        <div class="value" id="viewDob">{{ $user->dob ?? Null }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Gender</label>
                        <div class="value" id="viewGender">{{ $user->gender ?? 'Not specified' }}</div>

                    </div>
                    <div class="detail-item">
                        <label>Email</label>
                        <div class="value" id="viewEmail">{{ $user->email }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Phone</label>
                        <div class="value" id="viewPhone">{{ $user->phone ?? 'Not specified' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Address</label>
                        <div class="value" id="viewAddress">
                            @if($user->address)
                            {{ $user->address }}<br>

                            @else
                            Not specified
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <form class="edit-form" id="personalInfoForm" style="display: none;" action="{{ route('profile-update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="form-control" value="{{ $user->dob ?? Null }}">

                        <label for="dob">Blood Groub</label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        @php
                        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
                        @endphp
                        <label for="bloodType">Blood Group</label>
                        <select id="bloodType" name="bloodType" class="form-control">
                            <option value="">Select</option>
                            @foreach ($bloodGroups as $group)
                            <option value="{{ $group }}" {{ $user->bloodType == $group ? 'selected' : '' }}>{{ $group }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ $user->address }}" placeholder="Street address">
                </div>
                <!-- <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control" value="{{ $user->city ?? null }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" class="form-control" value="{{ $user->state ?? null}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="postal_code">ZIP</label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{ $user->postal_code ?? null }}">
                    </div>
                </div> -->
                <div class="upload-avatar">
                    <div>
                        <label for="avatarUpload">Profile Photo</label>
                        <input type="file" id="avatarUpload" name="image" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('avatarUpload').click()">Choose Image</button>
                    </div>
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Preview" class="avatar-preview" id="avatarPreview">
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" id="cancelPersonalEdit">Cancel</button>
                </div>
            </form>
        </div>



        <!-- Account Settings Section -->
        @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div style="color: red;">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="profile-section">
            <h2>Account Settings</h2>
            <div id="accountSettingsView">
                <div class="profile-details">
                    <div class="detail-item">
                        <label>Password</label>
                        <div class="value">********</div>

                    </div>
                    <div class="detail-item">
                        <label>Account Status</label>
                        <div class="value" style="color: green;">{{ $user->status ? 'Active' : 'Deactive'}}</div>
                    </div>
                    <div class="detail-item">
                        <label>Two-Factor Authentication</label>
                        <div class="value"></div>
                    </div>
                </div>

                <div class="profile-actions" style="margin-top: 2rem;">
                    <button class="btn btn-secondary" id="changePasswordBtn">Change Password</button>
                    <!-- <button class="btn btn-secondary" id="enable2FABtn"> 2FA</button> -->
                    <button class="btn btn-danger" id="deleteAccountBtn"><a href="{{ route('logout') }}">Logout</a></button>
                </div>
            </div>
            <form class="edit-form" id="changePasswordForm" style="display: none;" action="{{ route('change-password') }}" method="POST">
                @csrf
                <input type="hidden" id="currentPassword" name="email" value="{{ $user->email }}">

                <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" id="currentPassword" name="current_password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" id="confirmPassword" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                    <button type="button" class="btn btn-secondary" id="cancelPasswordChange">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</main>


@endsection

@section('js-content')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/mobile.menu.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editProfileBtn = document.getElementById('editProfileBtn');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const personalInfoForm = document.getElementById('personalInfoForm');
        const personalInfoView = document.getElementById('personalInfoView');
        const cancelPersonalEdit = document.getElementById('cancelPersonalEdit');

        const changePasswordBtn = document.getElementById('changePasswordBtn');
        const cancelPasswordChange = document.getElementById('cancelPasswordChange');
        const changePasswordForm = document.getElementById('changePasswordForm');
        const accountSettingsView = document.getElementById('accountSettingsView');

        const avatarUpload = document.getElementById('avatarUpload');
        const avatarPreview = document.getElementById('avatarPreview');

        // Format and display "Member Since" from server-created date
        const memberSince = document.getElementById('memberSince');
        const createdAt = "{{ $user->created_at }}";
        if (memberSince && createdAt) {
            const date = new Date(createdAt);
            const formatted = date.toLocaleDateString('en-IN', {
                year: 'numeric',
                month: 'long'
            });
            memberSince.innerText = formatted;
        }

        // Show form and hide view for profile edit
        editProfileBtn?.addEventListener('click', () => {
            personalInfoForm.style.display = 'block';
            personalInfoView.style.display = 'none';
            editProfileBtn.style.display = 'none';
            cancelEditBtn.style.display = 'inline-block';
        });

        // Cancel profile edit
        cancelEditBtn?.addEventListener('click', () => {
            personalInfoForm.style.display = 'none';
            personalInfoView.style.display = 'block';
            editProfileBtn.style.display = 'inline-block';
            cancelEditBtn.style.display = 'none';
        });

        cancelPersonalEdit?.addEventListener('click', () => {
            personalInfoForm.style.display = 'none';
            personalInfoView.style.display = 'block';
            editProfileBtn.style.display = 'inline-block';
            cancelEditBtn.style.display = 'none';
        });

        // Password form toggle
        changePasswordBtn?.addEventListener('click', () => {
            changePasswordForm.style.display = 'block';
            accountSettingsView.style.display = 'none';
        });

        cancelPasswordChange?.addEventListener('click', () => {
            changePasswordForm.style.display = 'none';
            accountSettingsView.style.display = 'block';
        });

        // Image preview
        avatarUpload?.addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection