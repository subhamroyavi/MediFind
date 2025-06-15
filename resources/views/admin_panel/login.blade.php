@extends('layouts.admin.login-header')

@section('login-content')
<div class="col-lg-6">
    <div class="p-lg-5 p-4">
        <div>
            <div class="text-center mt-1">
                <h4 class="font-size-18">Welcome Back !</h4>
                <p class="text-muted">Sign in to continue to Tocly.</p>
            </div>

            <form action="" id="loginForm">
                <div class="mb-2">
                    <label for="useremail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="useremail" placeholder="Enter email address">
                    <span class="error-message" id="email_error" style="color: red"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password-input">Password</label>
                    <input type="password" name="password" class="form-control" id="password-input" placeholder="Enter password">
                    <span class="error-message" id="password_error" style="color: red"></span>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary w-100" type="submit" id="loginBtn">Sign In</button>
                </div>
            </form>
        </div>
        <div class="mt-4 text-center">
            <p class="mb-0">Don't have an account ? <a href="{{ route('admin.signup') }}" class="fw-medium text-primary"> Register </a></p>
        </div>
    </div>
</div>
@endsection

@section('js-content')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        const loginBtn = $('#loginBtn'); 
        loginBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Signing In...');

        // Clear old errors
        $('.error-message').text('');
        $('.form-control').removeClass('is-invalid');

        $.ajax({
            url: "{{ route('admin.login-check') }}",
            method: "POST",
            data: {
                email: $('input[name="email"]').val(),
                password: $('input[name="password"]').val(),
            },
            success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    
                    window.location.href = "{{ route('admin.dashboard') }}";
                }
            },
            error: function(xhr) {
                loginBtn.prop('disabled', false).text('Sign In');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $(`input[name="${field}"]`).addClass('is-invalid');
                        $(`#${field}_error`).text(errors[field][0]);
                    }
                } else {
                    alert(xhr.responseJSON?.message || 'Login failed. Please try again.');
                }
            }
        });
    });
</script>

@endsection