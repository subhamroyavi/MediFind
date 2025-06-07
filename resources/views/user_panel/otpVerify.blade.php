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

            <form id="otpForm" method="post">
                @csrf
                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

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
                <p>Didn't receive code? <a href="#" id="resendOtp">Resend OTP</a></p>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js-content')
<script>
    $(document).ready(function() {
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

            $.ajax({
                url: "{{ route('send.otp') }}",
                method: "POST",
                data: {
                    email: $('input[name="email"]').val()
                },
                success: function(response) {
                    alert('New OTP sent successfully');
                },
                error: function(xhr) {
                    alert('Error resending OTP');
                }
            });
        });
    });
</script>
@endsection