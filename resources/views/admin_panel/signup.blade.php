@extends('layouts.admin.login-header')

@section('login-content')
<div class="col-lg-6">
    <div class="p-lg-5 p-4">
        <div>
            <div class="text-center mt-1">
                <h4 class="font-size-18">Register account</h4>
                <p class="text-muted">Get your free Admin account now.</p>
            </div>

            <div class="auth-input"> <!-- Changed from form to div -->
                <div class="mb-2">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name">
                    <span class="error-message" id="first_name_error" style="color: red"></span>
                </div>
                <div class="mb-2">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name">
                    <span class="error-message" id="last_name_error" style="color: red"></span>
                </div>
                <div class="mb-2">
                    <label for="useremail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter email">
                    <span class="error-message" id="email_error" style="color: red"></span>
                </div>

                <div class="mb-2">
                    <label for="phone" class="form-label">Phone No</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone">
                    <span class="error-message" id="phone_error" style="color: red"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password-input">Password</label>
                    <input type="password" class="form-control" id="password-input" name="password" placeholder="Enter password">
                    <span class="error-message" id="password_error" style="color: red"></span>
                </div>

                <div>
                    <p class="mb-0">By registering you agree to the Tocly <a href="#" class="text-primary">Terms of Use</a></p>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary w-100" id="register-btn" type="button">Register</button>
                </div>

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
            <p class="mb-0">Already have an account ? <a href="{{ route('admin.login') }}" class="fw-medium text-primary"> Login</a> </p>
        </div>
    </div>
</div>
@endsection


@section('js-content')

<script>
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
                url: "{{ route('admin.create') }}",
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
</script>
@endsection