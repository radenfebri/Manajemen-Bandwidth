@extends('layouts.master')

@section('title', 'Login')

@section('content')


<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ asset('template') }}/static/Mikrotik_Logo.svg" height="36" alt="" /></a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Login to your account</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email or Username</label>
                        <input type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" placeholder="Email or Username" autofocus />
                        @error('account')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-flat">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Your password" />
                        <span class="input-group-text">
                            <a href="" class="link-secondary" data-bs-toggle="tooltip" id="show-pass">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                            </a>
                        </span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <span class="form-label-description mb-2"><a href="{{ route('password.request') }}">Forgot Password?</a></span>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <span class="text-white" style="text-decoration: none">Sign in</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @if ($register == 1)
        <div class="text-center text-muted mt-3">
            Don't have an account?
            <a href="{{ route('register') }}" tabindex="-1">Sign up here</a>
        </div>
        @else
        
        @endif
    </div>
</div>

@endsection



