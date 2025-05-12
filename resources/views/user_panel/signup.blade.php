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

                <form>
                    <div class="form-group">
                        <label for="signupName">Full Name</label>
                        <input type="text" id="signupName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="signupEmail">Email Address</label>
                        <input type="email" id="signupEmail" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="signupPassword">Password</label>
                        <input type="password" id="signupPassword" class="form-control" required>
                        <small style="color: var(--gray-text);">At least 8 characters with a number and special
                            character</small>
                    </div>
                    <div class="form-group">
                        <label for="signupConfirm">Confirm Password</label>
                        <input type="password" id="signupConfirm" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin: 1rem 0;">
                        <input type="checkbox" id="agreeTerms" required>
                        <label for="agreeTerms">I agree to the <a href="#" style="color: var(--primary-color);">Terms of
                                Service</a> and <a href="#" style="color: var(--primary-color);">Privacy
                                Policy</a></label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem;">Create
                        Account</button>
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
                    <p>Already have an account? <a href="login.html" style="color: var(--primary-color);">Log in</a></p>
                </div>
            </div>
        </div>
    </main>

@endsection