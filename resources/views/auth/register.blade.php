@extends('layouts.auth')

@section('content')

<div class="container-fluid">
    <div class="container auth-container p-0">

        <header>
            <a class="navbar-brand" href="{{ url('/') }}">&lt;/&gt; MyBlog</a>
        </header>

        <div class="row g-0">

            <!-- LEFT SIDE (Form) -->
            <div class="col-lg-6 left-side d-flex flex-column justify-content-center">

                <h1>Create Account</h1>
                <p>Join our blog community and start sharing your ideas</p>

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
                            <div class="text-danger small mt-1">{{ $message }}</div>
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
                            <div class="text-danger small mt-1">{{ $message }}</div>
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

                            <span class="right-icon" onclick="togglePassword('password','toggleIcon1')">
                                <i class="bi bi-eye" id="toggleIcon1"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
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

                            <span class="right-icon" onclick="togglePassword('confirmPassword','toggleIcon2')">
                                <i class="bi bi-eye" id="toggleIcon2"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-login mb-3">
                        Sign Up
                    </button>

                    <hr>

                    <div class="bottom-text text-center">
                        Already have an account?
                        <a href="{{ route('login') }}">Login</a>
                    </div>

                </form>
            </div>

            <!-- RIGHT SIDE (Illustration) -->
            <div class="col-lg-6 right-side">
                <img src="{{ asset('assets/images/register.png') }}" alt="Register Illustration">
            </div>

        </div>
    </div>
</div>

@endsection
