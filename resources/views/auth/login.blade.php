@extends('layouts.app')

@section('title', 'Login')

@section('styles')
<style>
    /* Add any additional styles here that are relevant from welcome.blade.php */
    .btn-social {
        background-color: white;
        border: 1px solid #e0e0e0;
        padding: 0.75rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        text-decoration: none;
        color: #333;
        transition: all 0.2s ease;
    }
    .btn-social:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #333;
        text-decoration: none;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .login-divider {
        text-align: center;
        margin: 1.5rem 0;
        position: relative;
    }
    .login-divider:before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background-color: #e0e0e0;
    }
    .login-divider span {
        position: relative;
        background-color: white;
        padding: 0 15px;
        color: #757575;
    }
</style>
@endsection

@section('content')
<!-- Login Container -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Masuk ke BuzzWire</h3>
                </div>
                <div class="card-body p-5">
                    <div class="auth-welcome">
                        Selamat datang kembali! Silakan masuk ke akun Anda.
                    </div>
                    <form class="auth-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <div class="position-relative">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                                <i class="fas fa-envelope input-icon"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="position-relative">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="loginPassword" placeholder="Masukkan kata sandi Anda" required>
                                <i class="fas fa-lock input-icon"></i>
                                <button type="button" class="password-toggle" onclick="togglePassword('loginPassword')">
                                    <i class="fas fa-eye" id="loginPasswordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="remember-section">
                            <div class="remember-me">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-auth">Masuk</button>
                    </form>
                    <div class="auth-switch">
                        Belum punya akun? <a href="#" class="auth-link" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Daftar sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection