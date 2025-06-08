@extends('layouts.app')

@section('main-content')

<!-- Main Content -->
<main class="section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h2>Welcome Back</h2>
                <p>Login to your MediFind account to access your saved providers and more.</p>
            </div>

            <form >
                <div class="form-group">
                    <label for="loginEmail">Email Address</label>
                    <input type="email" id="loginEmail" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" class="form-control" name="password">
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin: 1rem 0;">
                    <div>
                        <input type="checkbox" id="rememberMe">
                        <label for="rememberMe">Remember me</label>
                    </div>
                    <a href="forgot-password.html" style="color: var(--primary-color); font-size: 0.9rem;">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem;">Login</button>
            </form>

            <div class="divider">
                <span>or login with</span>
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
                <p>Don't have an account? <a href="signup.html" style="color: var(--primary-color);">Sign up</a></p>
            </div>
        </div>
    </div>
</main>


@endsection