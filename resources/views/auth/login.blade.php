@extends('layouts.auth')

@section('content')

<div class="container-fluid">
    <div class="container auth-container p-0">

        <header>
            <a class="navbar-brand" href="{{ url('/') }}">&lt;/&gt; MyBlog</a>
        </header>

        <div class="row g-0">

            <!-- LEFT -->
            <div class="col-lg-6 left-side d-flex flex-column justify-content-center">

                <h1>Welcome Back!</h1>
                <p>Log in to your account</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope left-icon"></i>
                            <input type="email" name="email"
                                class="form-control"
                                placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label mb-0">Password</label>

                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>

                        <div class="input-wrapper mt-2">
                            <i class="bi bi-lock left-icon"></i>

                            <input type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required>

                            <span class="right-icon" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>


                    <button type="submit" class="btn-login mb-3">
                        Log In
                    </button>

                    <hr>

                    <div class="bottom-text text-center">
                        Don’t have an account?
                        <a href="{{ route('register') }}">Sign Up</a>
                    </div>

                </form>
            </div>

            <!-- RIGHT -->
            <div class="col-lg-6 right-side">
                <img src="{{ asset('assets/images/login.png') }}" alt="Login Illustration">
            </div>

        </div>
    </div>
</div>

@endsection
