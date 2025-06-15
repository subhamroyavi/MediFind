@extends('layouts.admin.login-header')

@section('login-content')
<div class="col-lg-6">
    <div class="p-lg-5 p-4">
        <div class="text-center mt-1">
            <h4 class="font-size-18">OTP Verification</h4>
            <p class="text-muted">Please enter the OTP sent to your registered email/phone</p>
        </div>

        <form action="{{ route('verify.otp') }}" method="get" id="otpForm">
            @csrf
            <input type="hidden" name="user_status" value="{{ old('user_status', $userData['user_status'] ?? '') }}">
            <input type="hidden" name="email" value="{{ old('email', $userData['email'] ?? '') }}">
            <input type="hidden" name="first_name" value="{{ old('first_name', $userData['first_name'] ?? '') }}">
            <input type="hidden" name="last_name" value="{{ old('last_name', $userData['last_name'] ?? '') }}">
            <input type="hidden" name="phone" value="{{ old('phone', $userData['phone'] ?? '') }}">
            <input type="hidden" name="bloodType" value="{{ old('bloodType', $userData['bloodType'] ?? '') }}">
            <input type="hidden" name="image" value="{{ old('image', $userData['image'] ?? '') }}">
            <input type="hidden" name="password" value="{{ old('password', $userData['password'] ?? '') }}">

            <div class="mb-4">
                <label for="otp" class="form-label">OTP <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('otp') is-invalid @enderror"
                    id="otp" name="otp"
                    value="{{ old('otp') }}"
                    placeholder="Enter 6-digit OTP"
                    maxlength="6"
                    pattern="\d{6}"
                    required>
                @error('otp')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid mb-3">
                <button class="btn btn-primary btn-lg" type="submit" id="verifyBtn">
                    Verify & Complete Registration
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <p class="mb-1">Didn't receive code?</p>
            <a href="#" id="resendOtp" class="btn btn-link p-0" style="display: none;">Resend OTP</a>
            <span id="resendTimer" class="text-muted small">Resend OTP in <span id="countdown">60</span> seconds</span>
        </div>
    </div>
</div>
@endsection

@section('js-content')
<script>
    $(document).ready(function() {
        // Timer functionality
        let timeLeft = 60;
        const resendOtp = $('#resendOtp');
        const resendTimer = $('#resendTimer');
        const countdown = $('#countdown');
        const verifyBtn = $('#verifyBtn');

        // Start countdown
        const startTimer = () => {
            const timer = setInterval(() => {
                timeLeft--;
                countdown.text(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    resendTimer.hide();
                    resendOtp.show();
                }
            }, 1000);
        };
        startTimer();

        // OTP input validation
        $('#otp').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 6) {
                verifyBtn.prop('disabled', false);
            } else {
                verifyBtn.prop('disabled', true);
            }
        });

        // Handle OTP form submission
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle OTP form submission
        $('#otpForm').on('submit', function(e) {
            e.preventDefault();
            verifyBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...');

            $.ajax({
                url: "{{ route('admin-OTPVerify') }}",
                method: "POST",
                // data: $(this).serialize(),
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
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        alert(response.message || 'Verification successful!');
                        window.location.href = "{{ route('admin.login-page') }}";
                    }
                },
                error: function(xhr) {
                    verifyBtn.prop('disabled', false).text('Verify & Complete Registration');
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}`).next('.invalid-feedback').text(errors[field][0]);
                        }
                    } else {
                        alert(xhr.responseJSON.message || 'Verification failed. Please try again.');
                    }
                }
            });
        });

        // Handle OTP resend
        $('#resendOtp').on('click', function(e) {
            e.preventDefault();
            $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...');

            $.ajax({
                url: "{{ route('send.otp') }}",
                method: "POST",
                data: {
                    email: $('input[name="email"]').val(),
                    phone: $('input[name="phone"]').val()
                },
                success: function(response) {
                    $('#resendOtp').prop('disabled', false).text('Resend OTP');
                    alert(response.message || 'New OTP sent successfully');

                    // Reset timer
                    timeLeft = 60;
                    countdown.text(timeLeft);
                    resendOtp.hide();
                    resendTimer.show();
                    startTimer();
                },
                error: function(xhr) {
                    $('#resendOtp').prop('disabled', false).text('Resend OTP');
                    alert(xhr.responseJSON.message || 'Error resending OTP');
                }
            });
        });
    });
</script>
@endsection