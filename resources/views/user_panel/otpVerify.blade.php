@extends('layouts.app')

@section('main-content')
<!-- Main Content -->
<main class="section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h2>OTP Verification</h2>
                <p>Enter the 6-digit code sent to your email.</p>
            </div>
            <form id="otpForm" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_status" value="{{ old('user_status', $userData['user_status'] ?? '') }}">
                <input type="hidden" name="email" value="{{ old('email', $userData['email'] ?? '') }}">
                <input type="hidden" name="first_name" value="{{ old('first_name', $userData['first_name'] ?? '') }}">
                <input type="hidden" name="last_name" value="{{ old('last_name', $userData['last_name'] ?? '') }}">
                <input type="hidden" name="phone" value="{{ old('phone', $userData['phone'] ?? '') }}">
                <input type="hidden" name="bloodType" value="{{ old('bloodType', $userData['bloodType'] ?? '') }}">
                <input type="hidden" name="image" value="{{ old('image', $userData['image'] ?? '') }}">
                <input type="hidden" name="password" value="{{ old('password', $userData['password'] ?? '') }}">
                <div class="form-group">
                    <label for="otp">OTP Code</label>
                    <input type="text" id="otp" class="form-control @error('otp') is-invalid @enderror"
                        name="otp" required maxlength="6" pattern="\d{6}">
                    @error('otp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem;">
                    Verify OTP
                </button>
            </form>

            <div class="text-center mt-3">
                <p>Didn't receive code?
                    <a href="#" id="resendOtp" style="display: none;">Resend OTP</a>
                    <span id="resendTimer">Resend OTP in <span id="countdown">60</span> seconds</span>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js-content')
<script>
    $(document).ready(function() {
        // Timer functionality
        let timeLeft = 60;
        const resendOtp = $('#resendOtp');
        const resendTimer = $('#resendTimer');
        const countdown = $('#countdown');

        // Initially hide resend link and show timer
        resendOtp.hide();
        resendTimer.show();

        // Start countdown
        const timer = setInterval(function() {
            timeLeft--;
            countdown.text(timeLeft);

            if (timeLeft <= 0) {
                clearInterval(timer);
                resendTimer.hide();
                resendOtp.show();
            }
        }, 1000);

        // Handle OTP form submission
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#otpForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('verify.otp') }}",
                method: "POST",
                data: {
                    email: $('input[name="email"]').val(),
                    first_name: $('input[name="first_name"]').val(),
                    last_name: $('input[name="last_name"]').val(),
                    phone: $('input[name="phone"]').val(),
                    bloodType: $('input[name="bloodType"]').val(),
                    image: $('input[name="image"]').val(),
                    password: $('input[name="password"]').val(),
                    user_status: $('input[name="user_status"]').val(),
                    otp: $('input[name="otp"]').val()
                },

                success: function(response) {
                    if (response.success) {
                        // Redirect on successful verification
                        window.location.href = "{{ route('login') }}";
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Show validation errors
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            alert(errors[field][0]);
                        }
                    }
                }
            });
        });

        // Handle OTP resend
        $('#resendOtp').on('click', function(e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append('email', $('input[name="email"]').val());
            formData.append('first_name', $('input[name="first_name"]').val());
            formData.append('last_name', $('input[name="last_name"]').val());
            formData.append('phone', $('input[name="phone"]').val());
            formData.append('bloodType', $('select[name="bloodType"]').val());
            formData.append('password', $('input[name="password"]').val());
            formData.append('password', $('input[name="password"]').val());
            formData.append('user_status', $('input[name="user_status"]').val());

            $.ajax({
                url: "{{ route('send.otp') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert('New OTP sent successfully');

                    // Reset timer
                    timeLeft = 60;
                    countdown.text(timeLeft);
                    resendOtp.hide();
                    resendTimer.show();

                    // Restart countdown
                    const newTimer = setInterval(function() {
                        timeLeft--;
                        countdown.text(timeLeft);

                        if (timeLeft <= 0) {
                            clearInterval(newTimer);
                            resendTimer.hide();
                            resendOtp.show();
                        }
                    }, 1000);
                },
                error: function(xhr) {
                    alert('Error resending OTP');
                }
            });
        });
    });
</script>
@endsection