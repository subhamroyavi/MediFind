@extends('layouts.app')

@section('main-content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<main class="section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h2>Welcome Back</h2>
                <p>Login to your MediFind account to access your saved providers and more.</p>
            </div>

            <form id="loginForm" method="POST">
                @csrf

                {{-- Email Section --}}
                <div class="form-group" id="emailSection">
                    <label for="loginEmail">Email Address</label>
                    <input type="email" id="loginEmail" class="form-control" name="email" required>
                    @error('email')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                    <button type="button" id="sendOtpBtn" class="btn btn-primary mt-2" style="width: 100%; padding: 0.75rem;">Send OTP</button>
                </div>

                {{-- OTP Section --}}
                <div class="form-group" id="otpSection" style="display: none;">
                    <label for="otp">Enter OTP</label>
                    <input type="text" id="otp" class="form-control" name="otp">
                    @error('otp')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                    <button type="button" id="verifyOtpBtn" class="btn btn-secondary mt-2" style="width: 100%; padding: 0.75rem;">Verify OTP</button>
                </div>

                {{-- Password Reset Section --}}
                <div id="passwordSection" style="display: none;">
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="password" class="form-control">
                        @error('password')
                        <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                        <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success" style="width: 100%; padding: 0.75rem;">Reset Password</button>
                </div>

            </form>
        </div>
    </div>
</main>

@endsection

@section('js-content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Step 1: Send OTP
        $('#sendOtpBtn').on('click', function() {
            const email = $('#loginEmail').val();

            if (!email) {
                alert('Please enter your email.');
                return;
            }

            $.ajax({
                url: "{{ route('forgot-email-sendOTP') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email
                },
                success: function(response) {
                    alert('OTP sent to your email.');
                    $('#otpSection').show();
                    $('#emailSection input, #sendOtpBtn').prop('disabled', true);
                },
                error: function(xhr) {
                    alert('Failed to send OTP. Please try again.');
                }
            });
        });

        // Step 2: Verify OTP
        $('#verifyOtpBtn').on('click', function() {
            const otp = $('#otp').val();
            const email = $('#loginEmail').val();

            if (!otp) {
                alert('Please enter the OTP.');
                return;
            }

            $.ajax({
                url: "{{ route('forgot-email-verifyOTP') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email,
                    otp: otp
                },
                success: function(response) {
                    alert('OTP verified successfully.');
                    $('#otpSection').hide();
                    $('#passwordSection').show();
                },
                error: function(xhr) {
                    alert('Invalid OTP. Please try again.');
                }
            });
        });

        // Step 3: Submit new password
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            const email = $('#loginEmail').val();
            const password = $('#newPassword').val();
            const password_confirmation = $('#confirmPassword').val();

            $.ajax({
                url: "{{ route('forgot-email-resetPassword') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation
                },
                success: function(response) {
                    alert('Password reset successful. Redirecting...');
                    window.location.href = '{{ route("login") }}';
                },
                error: function(xhr) {
                    alert('Password reset failed. Make sure your passwords match.');
                }
            });
        });
    });
</script>
@endsection