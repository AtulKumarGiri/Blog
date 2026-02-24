@extends('layouts.auth')

@section('content')

<div class="auth-wrapper d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-10">
                <div class="auth-card shadow-lg">

                    <div class="row g-0">

                        <!-- LEFT SIDE (FORM) -->
                        <div class="col-lg-6 left-side p-5 d-flex flex-column justify-content-center">

                            <div class="mb-4">
                                <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
                                    &lt;/&gt; MyBlog
                                </a>
                            </div>

                            <h2 class="fw-bold mb-2">Create Account 🚀</h2>
                            <p class="text-muted mb-4">
                                Join our blog community and start sharing ideas
                            </p>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-person left-icon"></i>
                                        <input type="text"
                                               name="name"
                                               value="{{ old('name') }}"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Enter your full name"
                                               required>
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

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
                                    <label class="form-label">Password</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-lock left-icon"></i>
                                        <input type="password"
                                               name="password"
                                               id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Enter password"
                                               required>

                                        <span class="right-icon"
                                              onclick="togglePassword('password','toggleIcon1')">
                                            <i class="bi bi-eye" id="toggleIcon1"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-4">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-lock left-icon"></i>
                                        <input type="password"
                                               name="password_confirmation"
                                               id="confirmPassword"
                                               class="form-control"
                                               placeholder="Confirm password"
                                               required>

                                        <span class="right-icon"
                                              onclick="togglePassword('confirmPassword','toggleIcon2')">
                                            <i class="bi bi-eye" id="toggleIcon2"></i>
                                        </span>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="btn btn-primary w-100 btn-login">
                                    Sign Up
                                </button>

                                <div class="text-center mt-4">
                                    Already have an account?
                                    <a href="{{ route('login') }}" class="auth-link">
                                        Login
                                    </a>
                                </div>

                            </form>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-lg-6 right-side d-none d-lg-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/images/register.png') }}"
                                 class="img-fluid"
                                 alt="Register Illustration">
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection