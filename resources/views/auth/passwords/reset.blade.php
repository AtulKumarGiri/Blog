@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="auth-card p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h2 class="auth-title">Reset Password</h2>
                        <p class="auth-subtitle">
                            Enter your email and new password to reset your account.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ $email ?? old('email') }}"
                                   class="form-control auth-input @error('email') is-invalid @enderror"
                                   required autofocus>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control auth-input @error('password') is-invalid @enderror"
                                   required>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control auth-input"
                                   required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn primary-btn">
                                Reset Password
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection