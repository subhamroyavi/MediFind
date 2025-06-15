@extends('layouts.app')

@section('main-content')

<!-- Main Content -->
<main class="section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h2>Create Your Account</h2>
                <p>Join MediFind to save your favorite providers and access personalized recommendations.</p>
            </div>

            <form action="{{ route('send.otp') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="user_status" value="User">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror"
                        name="first_name" value="{{ old('first_name') }}">
                    @error('first_name')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror"
                        name="last_name" value="{{ old('last_name') }}">
                    @error('last_name')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="signupEmail">Email Address</label>
                    <input type="email" id="signupEmail" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}">
                    @error('email')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone no.</label>
                    <input type="tel" id="phone" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" value="{{ old('phone') }}">
                    @error('phone')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    @php
                    $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
                    @endphp

                    <label for="bloodType">Blood Type</label>
                    <select id="bloodType" class="form-control @error('bloodType') is-invalid @enderror" name="bloodType">
                        <option value="">Select blood type</option>
                        @foreach ($bloodGroups as $group)
                        <option value="{{ $group }}" @selected(old('bloodType')==$group )>{{ $group }}</option>
                        @endforeach
                    </select>

                    @error('bloodType')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="upload-avatar">
                        <div>
                            <label for="avatarUpload">Profile Photo</label>
                            <input type="file" id="avatarUpload" name="image" accept="image/*" style="display: none;"
                                class="@error('image') is-invalid @enderror">
                            <button type="button" class="btn btn-secondary"
                                onclick="document.getElementById('avatarUpload').click()">Choose Image</button>
                        </div>
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Preview" class="avatar-preview"
                            id="avatarPreview">
                        @error('image')
                        <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="signupPassword">Password</label>
                    <input type="password" id="signupPassword" class="form-control @error('password') is-invalid @enderror"
                        name="password">
                    <small style="color: var(--gray-text);">At least 8 characters with a number and special character</small>
                    @error('password')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="signupConfirm">Confirm Password</label>
                    <input type="password" id="signupConfirm" class="form-control" name="password_confirmation">
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin: 1rem 0;">
                    <div>
                        <input type="checkbox" id="rememberMe" name="check" required>
                        <label for="rememberMe">I agree to the <a href="" style="color: var(--primary-color);">Terms of
                                Service</a> and <a href="#" style="color: var(--primary-color);">Privacy
                                Policy</a></label>
                        @error('check')
                        <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" style="width: 100%; padding: 0.75rem;">
                    Create Account
                </button>
            </form>

            <div class="divider">
                <span>or sign up with</span>
            </div>

            <div class="social-login">
                <button class="social-btn facebook">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button class="social-btn google">
                    <i class="fab fa-google"></i>
                </button>
            </div>

            <div class="form-footer">
                <p>Already have an account? <a href="{{ route('login') }}" style="color: var(--primary-color);">Log in</a></p>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js-content')
<script>
    // Avatar Upload Preview
    document.getElementById('avatarUpload').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatarPreview').src = event.target.result;
                document.getElementById('profileAvatar').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection