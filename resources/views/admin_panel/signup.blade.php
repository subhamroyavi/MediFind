@extends('layouts.admin.login-header')

@section('login-content')
<div class="col-lg-6">
    <div class="p-lg-5 p-4">
        <div>
            <div class="text-center mt-1">
                <h4 class="font-size-18">Register account</h4>
                <p class="text-muted">Get your free Admin account now.</p>
            </div>
            <form action="{{ route('admin.sendOTP') }}" method="post" enctype="multipart/form-data" id="registrationForm">
                @csrf
                <div class="auth-input">
                    <!-- Name Fields -->
                    <input type="hidden" name="user_status" value="Admin">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                id="first_name" name="first_name"
                                value="{{ old('first_name') }}"
                                placeholder="Enter your first name">
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                id="last_name" name="last_name"
                                value="{{ old('last_name') }}"
                                placeholder="Enter your last name">
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email and Phone -->
                    <div class="mb-3">
                        <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="useremail" name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Enter phone number">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Blood Type -->
                    <div class="mb-3">
                        <label for="bloodType" class="form-label">Blood Type <span class="text-danger">*</span></label>
                        <select id="bloodType" class="form-select @error('bloodType') is-invalid @enderror"
                            name="bloodType">
                            <option value="">Select blood type</option>
                            @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $group)
                            <option value="{{ $group }}" @selected(old('bloodType')==$group)>{{ $group }}</option>
                            @endforeach
                        </select>
                        @error('bloodType')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profile Image -->
                    <div class="mb-3">
                        <label class="form-label">Profile Image</label>
                        <div class="upload-avatar d-flex align-items-center gap-3">
                            <div class="avatar-preview-container position-relative">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg"
                                    alt="Profile Preview"
                                    class="avatar-preview rounded-circle"
                                    id="avatarPreview"
                                    width="100"
                                    height="100">
                                <div class="position-absolute bottom-0 end-0">
                                    <button type="button"
                                        class="btn btn-sm btn-primary rounded-circle p-2"
                                        onclick="document.getElementById('avatarUpload').click()"
                                        title="Change photo">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="file"
                                id="avatarUpload"
                                name="image"
                                accept="image/*"
                                style="display: none;"
                                class="@error('image') is-invalid @enderror"
                                onchange="previewImage(this)">
                            @error('image')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Fields -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" value="{{ old('password') }}"
                                placeholder="Enter password">
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="form-text">Minimum 8 characters with at least one number and one letter</div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control"
                                id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                placeholder="Confirm password">
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="form-check mb-4">
                        <input class="form-check-input @error('check') is-invalid @enderror"
                            type="checkbox" id="rememberMe" name="check">
                        <label class="form-check-label" for="rememberMe">
                            I agree to the <a href="#" class="text-primary text-decoration-underline">Terms of Use</a>
                            and <a href="#" class="text-primary text-decoration-underline">Privacy Policy</a>
                        </label>
                        @error('check')
                        <div class="invalid-feedback">You must accept the terms and conditions</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg" type="submit" id="register-btn">
                            Register Now
                        </button>
                    </div>
                </div>
            </form>
            <div class="mt-4 pt-2 text-center">
                <div class="signin-other-title">
                    <h5 class="font-size-14 mb-4 title">Sign In with</h5>
                </div>
                <div class="pt-2 hstack gap-2 justify-content-center">
                    <button type="button" class="btn btn-primary btn-sm"><i class="ri-facebook-fill font-size-16"></i></button>
                    <button type="button" class="btn btn-danger btn-sm"><i class="ri-google-fill font-size-16"></i></button>
                    <button type="button" class="btn btn-dark btn-sm"><i class="ri-github-fill font-size-16"></i></button>
                    <button type="button" class="btn btn-info btn-sm"><i class="ri-twitter-fill font-size-16"></i></button>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4 text-center">
        <p class="mb-0">Already have an account ? <a href="" class="fw-medium text-primary"> Login</a> </p>
    </div>
</div>
</div>
@endsection


@section('js-content')
<script>
    // Image preview function
    function previewImage(input) {
        const preview = document.getElementById('avatarPreview');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    // Password visibility toggle
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });

    // Form validation
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match!');
        }

        // Add additional validation logic here if needed
    });
</script>
<style>
    .avatar-preview-container {
        width: 100px;
        height: 100px;
    }

    .avatar-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 2px solid #dee2e6;
    }

    .toggle-password {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
<!-- <script>
    $(document).ready(function() {

        // Clear error messages when user starts typing
        $('input').on('input', function() {
            $('#' + this.id + '_error').text('');
        });

        $('#register-btn').on('click', function() {
            // Clear previous error messages
            $('.error-message').text('');

            var formData = {
                first_name: $('#first_name').val().trim(),
                last_name: $('#last_name').val().trim(),
                email: $('#useremail').val().trim(),
                phone: $('#phone').val().trim(),
                password: $('#password-input').val().trim(),
                status: '1',
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('send.otp') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            // Convert field name to match the error span ID
                            var errorField = key + '_error';
                            $('#' + errorField).text(value[0]);
                        });
                    } else {
                        alert('Registration failed! Please try again.');
                    }
                }
            });
        });
    });
</script> -->
@endsection