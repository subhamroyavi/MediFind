@extends('layouts.admin.login-header')

@section('login-content')
<div class="col-lg-6">
    <div class="p-lg-5 p-4">
        <div>
            <div class="text-center mt-1">
                <h4 class="font-size-18">Welcome Back !</h4>
                <p class="text-muted">Sign in to continue to Tocly.</p>
            </div>

            <form id="loginForm">
                <div class="mb-2">
                    <label for="useremail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="useremail" placeholder="Enter email address">
                    <span class="error-message" id="email_error" style="color: red"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password-input">Password</label>
                    <input type="password" class="form-control" id="password-input" placeholder="Enter password">
                    <span class="error-message" id="password_error" style="color: red"></span>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary w-100" type="submit" id="loginBtn">Sign In</button>
                </div>
            </form>
        </div>
        <div class="mt-4 text-center">
            <p class="mb-0">Don't have an account ? <a href="{{route('admin.signup')}}" class="fw-medium text-primary"> Register </a></p>
        </div>
    </div>
</div>
@endsection

@section('js-content')
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            $('.error-message').text('');

            let email = $('#useremail').val().trim();
            let password = $('#password-input').val().trim();

            // Client-side validation
            if (!email) {
                $('#email_error').text('Email is required');
                return;
            }

            if (!password) {
                $('#password_error').text('Password is required');
                return;
            }

            // Add loading state
            $('#loginBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Processing...');

            $.ajax({
                url: "{{ route('admin.login-check') }}",
                method: 'POST',
                dataType: 'json',
                data: {
                    email: email,
                    password: password,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect || "{{ route('admin.dashboard') }}";
                    } else {
                        $('#password_error').text(response.message || 'Authentication failed');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            $('#' + field + '_error').text(errors[field][0]);
                        }
                    } else {
                        $('#password_error').text('Server error. Please try again later.');
                        console.error('Error:', xhr.responseText);
                    }
                },
                complete: function() {
                    $('#loginBtn').prop('disabled', false).text('Sign In');
                }
            });
        });
    });
</script>
@endsection