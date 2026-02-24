@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="auth-card p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h2 class="auth-title">Forgot Password</h2>
                        <p class="auth-subtitle">
                            Enter your email address and we'll send you a reset link.
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control auth-input @error('email') is-invalid @enderror"
                                   required autofocus>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn primary-btn">
                                Send Reset Link
                            </button>
                        </div>

                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="auth-link">
                            ← Back to Login
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection