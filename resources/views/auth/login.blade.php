@extends('layouts.auth')

@section('content')

<div class="auth-wrapper d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-10">
                <div class="auth-card shadow-lg">

                    <div class="row g-0">

                        <!-- LEFT SIDE -->
                        <div class="col-lg-6 left-side p-5 d-flex flex-column justify-content-center">

                            <div class="mb-4">
                                <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
                                    &lt;/&gt; MyBlog
                                </a>
                            </div>

                            <h2 class="mb-2 fw-bold">Welcome Back 👋</h2>
                            <p class="text-muted mb-4">Log in to continue to your account</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-envelope left-icon"></i>
                                        <input type="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Enter your email"
                                               required>
                                    </div>

                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label">Password</label>

                                        @if (Route::has('password.request'))
                                            <a class="forgot-link"
                                               href="{{ route('password.request') }}">
                                                Forgot Password?
                                            </a>
                                        @endif
                                    </div>

                                    <div class="input-wrapper">
                                        <i class="bi bi-lock left-icon"></i>

                                        <input type="password"
                                               name="password"
                                               id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Enter your password"
                                               required>

                                        <span class="right-icon" onclick="togglePassword()">
                                            <i class="bi bi-eye" id="toggleIcon"></i>
                                        </span>
                                    </div>

                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="remember"
                                           id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-login">
                                    Log In
                                </button>

                                <div class="text-center mt-4">
                                    Don’t have an account?
                                    <a href="{{ route('register') }}" class="auth-link">
                                        Sign Up
                                    </a>
                                </div>

                            </form>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-lg-6 right-side d-none d-lg-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/images/login.png') }}"
                                 class="img-fluid"
                                 alt="Login Illustration">
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection