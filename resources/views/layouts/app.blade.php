<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuzzWire News - @yield('title', 'Home')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Modal Styles untuk semua halaman -->
    <style>
        :root {
            --primary-color: #ffffff;
            --primary-dark: #e0e0e0;
            --secondary-color: #1a1a1a;
            --text-color: #ffffff;
            --text-muted: #b0b0b0;
            --border-color: #404040;
            --success-color: #4CAF50;
            --error-color: #f44336;
            --bg-dark: #1a1a1a;
            --bg-darker: #0f0f0f;
            --input-bg: #2a2a2a;
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
        }

        /* Modal Styles */
        .modal {
            backdrop-filter: blur(8px);
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.85);
        }

        .modal-dialog {
            margin: 2rem auto;
            max-width: 650px;
        }

        .modal-content {
            border: none;
            border-radius: 12px;
            background: var(--bg-dark);
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
        }

        .modal-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 2rem 3rem 1.5rem;
            text-align: center;
            position: relative;
        }

        .modal-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 0;
        }

        .btn-close {
            position: absolute;
            top: 1.5rem;
            right: 2rem;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .btn-close:hover {
            background: var(--border-color);
            color: var(--text-color);
        }

        .modal-body {
            padding: 2rem 3rem 3rem;
        }

        /* Form Styles */
        .auth-form {
            margin-top: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: block;
        }

        .form-control {
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: border-color 0.2s ease;
            background: var(--input-bg);
            color: var(--text-color);
            width: 100%;
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            background: var(--input-bg);
            color: var(--text-color);
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
        }

        /* Input Icons */
        .input-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
            pointer-events: none;
        }

        .form-control:focus + .input-icon {
            color: var(--primary-color);
        }

        /* Buttons */
        .btn-auth {
            background: var(--primary-color);
            color: var(--bg-dark);
            border: none;
            border-radius: 8px;
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.2s ease;
            text-transform: none;
        }

        .btn-auth:hover {
            background: var(--primary-dark);
            color: var(--bg-dark);
        }

        .btn-auth:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Form Check */
        .form-check {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding: 0;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 0.75rem;
            margin-top: 0.125rem;
            border: 1px solid var(--border-color);
            border-radius: 3px;
            background: var(--input-bg);
            transition: all 0.2s ease;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-check-label {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.4;
            flex: 1;
        }

        /* Links */
        .auth-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .auth-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .auth-switch {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            color: var(--text-muted);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        /* Invalid Feedback */
        .invalid-feedback {
            display: block;
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            padding-left: 0.25rem;
        }

        /* Form Text */
        .form-text {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 0.5rem;
            padding-left: 0.25rem;
        }

        /* Welcome Text */
        .auth-welcome {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Remember Section */
        .remember-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .forgot-password {
            margin-left: auto;
        }

        /* Loading State */
        .btn-auth.loading {
            position: relative;
            color: transparent;
        }

        .btn-auth.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 18px;
            height: 18px;
            border: 2px solid rgba(26, 26, 26, 0.3);
            border-top: 2px solid var(--bg-dark);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modal-dialog {
                margin: 1rem;
                max-width: none;
            }
            
            .modal-header {
                padding: 1.5rem 2rem 1rem;
            }
            
            .modal-body {
                padding: 1.5rem 2rem 2rem;
            }
            
            .modal-title {
                font-size: 1.5rem;
            }

            .remember-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .forgot-password {
                margin-left: 0;
                align-self: stretch;
                text-align: center;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Simple Clean Navbar -->
    <!-- Updated Navbar Section for layouts/app.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="/">BuzzWire</a>

        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <!-- Centered Search Box -->
            <div class="mx-auto">
                <form action="{{ route('articles.search') }}" method="GET" class="search-form">
                    <div class="input-group search-box">
                        <input 
                            type="text" 
                            name="q"
                            id="searchInput"
                            class="form-control search-input" 
                            placeholder="Search articles..."
                            value="{{ request('q') }}"
                        >
                        <button class="btn search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    
                    <!-- Search Suggestions -->
                    <div class="search-suggestions" id="searchSuggestions" style="display: none;">
                        <div class="suggestions-list"></div>
                    </div>
                </form>
            </div>

            <!-- User Menu Only (Remove Write Button) -->
            <div class="d-flex align-items-center ms-auto">
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center user-menu-button" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        @auth
                            <img src="{{ Auth::user()->profile_image_url }}" alt="{{ Auth::user()->name }}" class="user-avatar" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #f97316; border-radius: 50%; display: none; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 14px;">
                                {{ Auth::user()->initials }}
                            </div>
                            <span class="text-white ms-2">{{ Auth::user()->username }}</span>
                        @else
                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #ccc; border-radius: 50%;"></div>
                            <span class="text-white ms-2">Login</span>
                        @endauth
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @auth
                            <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person me-2"></i>Profile
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('articles.create') }}">
                                <i class="bi bi-plus-circle me-2"></i>Write Article
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">
                                <i class="bi bi-person-plus me-2"></i>Sign Up
                            </a></li>
                        @endauth
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>
    
    <!-- Include Categories Component -->
    @include('components.categories')
    
    <!-- Main Content -->
    <div class="content-container">
        @yield('content')
    </div>
    
    <!-- Simple Clean Footer -->
    <!-- Updated Footer Section for layouts/app.blade.php -->
<footer class="simple-footer">
    <div class="container">
        <div class="row">
            <!-- Brand Section -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand">
                    <h3 class="brand-name">BuzzWire</h3>
                    <p class="brand-description">
                        Your trusted source for breaking news and compelling stories from around the world.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Categories - First Column -->
            <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                <div class="footer-section">
                    <h4 class="section-title">Categories</h4>
                    <ul class="footer-links">
                        @php
                            $footerCategories = App\Models\Category::orderBy('id', 'asc')->take(4)->get();
                        @endphp
                        @foreach($footerCategories as $category)
                            <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Categories - Second Column -->
            <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                <div class="footer-section">
                    <h4 class="section-title">More News</h4>
                    <ul class="footer-links">
                        @php
                            $moreCategories = App\Models\Category::orderBy('id', 'asc')->skip(4)->take(4)->get();
                        @endphp
                        @foreach($moreCategories as $category)
                            <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
                <div class="footer-section">
                    <h4 class="section-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('articles.index') }}">All Articles</a></li>
                        <li><a href="{{ route('trending') }}">Trending</a></li>
                        @auth
                            <li><a href="{{ route('articles.create') }}">Write</a></li>
                            <li><a href="{{ route('profile') }}">Profile</a></li>
                        @else
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; 2025 BuzzWire. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="#">Privacy</a>
                        <a href="#">Terms</a>
                        <a href="#">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@guest
<!-- Login Modal - Simple Dark Theme -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Masuk ke BuzzWire</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        
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
            <div class="forgot-password">
              <a href="#" class="auth-link">Lupa kata sandi?</a>
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

<!-- Sign Up Modal - Simple Dark Theme -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Daftar ke BuzzWire</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="auth-welcome">
          Bergabunglah dengan BuzzWire untuk mendapatkan berita terkini.
        </div>
        
        <form class="auth-form" method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-group">
            <label for="name" class="form-label">Nama Lengkap</label>
            <div class="position-relative">
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
              <i class="fas fa-user input-icon"></i>
            </div>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <div class="position-relative">
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Pilih username" required>
              <i class="fas fa-at input-icon"></i>
            </div>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <div class="position-relative">
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="signupEmail" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
              <i class="fas fa-envelope input-icon"></i>
            </div>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="password" class="form-label">Kata Sandi</label>
            <div class="position-relative">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="signupPassword" name="password" placeholder="Buat kata sandi" required>
              <i class="fas fa-lock input-icon"></i>
              <button type="button" class="password-toggle" onclick="togglePassword('signupPassword')">
                <i class="fas fa-eye" id="signupPasswordIcon"></i>
              </button>
            </div>
            <div class="form-text">Minimal 8 karakter</div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <div class="position-relative">
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
              <i class="fas fa-lock input-icon"></i>
              <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                <i class="fas fa-eye" id="password_confirmationIcon"></i>
              </button>
            </div>
          </div>
          
          <div class="form-check">
            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">
              Saya setuju dengan <a href="#" class="auth-link">Syarat dan Ketentuan</a> dan <a href="#" class="auth-link">Kebijakan Privasi</a>
            </label>
            @error('terms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <button type="submit" class="btn btn-auth">Daftar</button>
        </form>
        
        <div class="auth-switch">
          Sudah punya akun? <a href="#" class="auth-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Masuk</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endguest
    
    <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Simple Search Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchSuggestions = document.getElementById('searchSuggestions');
        let searchTimeout;

        if (searchInput && searchSuggestions) {
            const suggestionsContainer = searchSuggestions.querySelector('.suggestions-list');

            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length < 2) {
                    searchSuggestions.style.display = 'block';
            }
        }

        // Newsletter form
        const newsletterForm = document.querySelector('.newsletter-form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = this.querySelector('.newsletter-input').value;
                if (email) {
                    alert('Thank you for subscribing!');
                    this.querySelector('.newsletter-input').value = '';
                }
            });
        }

        // Modal Management Script
        // Function to ensure single backdrop exists
        function ensureModalBackdrop() {
            // Remove all existing backdrops first to prevent stacking
            const existingBackdrops = document.querySelectorAll('.modal-backdrop');
            existingBackdrops.forEach(backdrop => backdrop.remove());
            
            // Create single new backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            document.body.appendChild(backdrop);
            document.body.classList.add('modal-open');
        }

        // Function to switch modals properly
        function switchModal(hideModalId, showModalId) {
            const hideModal = bootstrap.Modal.getInstance(document.getElementById(hideModalId));
            
            if (hideModal) {
                // Temporarily disable backdrop removal for the hiding modal
                const originalBackdrop = hideModal._config.backdrop;
                hideModal._config.backdrop = false;
                hideModal.hide();
                
                setTimeout(() => {
                    // Restore original backdrop config
                    hideModal._config.backdrop = originalBackdrop;
                }, 100);
            }
            
            setTimeout(() => {
                // Ensure single backdrop exists
                ensureModalBackdrop();
                
                const showModal = new bootstrap.Modal(document.getElementById(showModalId), {
                    backdrop: false // Don't let Bootstrap manage backdrop since we're doing it manually
                });
                showModal.show();
            }, 100);
        }
        
        // Handle modal switches
        const loginLinks = document.querySelectorAll('a[data-bs-target="#loginModal"]');
        const signupLinks = document.querySelectorAll('a[data-bs-target="#signupModal"]');
        
        loginLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                switchModal('signupModal', 'loginModal');
            });
        });
        
        signupLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                switchModal('loginModal', 'signupModal');
            });
        });
        
        // Handle modals opening normally (not switching)
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function(e) {
                // Only manage backdrop for direct modal opens (not switches)
                if (!e.relatedTarget || !e.relatedTarget.closest('.modal')) {
                    setTimeout(() => {
                        ensureModalBackdrop();
                    }, 50);
                }
            });

            modal.addEventListener('hidden.bs.modal', function() {
                // Clean up only if no modal is currently visible
                setTimeout(() => {
                    const visibleModals = document.querySelectorAll('.modal.show');
                    if (visibleModals.length === 0) {
                        const backdrops = document.querySelectorAll('.modal-backdrop');
                        backdrops.forEach(backdrop => backdrop.remove());
                        document.body.classList.remove('modal-open');
                        document.body.style.removeProperty('overflow');
                        document.body.style.removeProperty('padding-right');
                    }
                }, 150);
            });
            
            // Add loading state
            const form = modal.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('.btn-auth');
                    if (submitBtn) {
                        submitBtn.classList.add('loading');
                        submitBtn.disabled = true;
                    }
                });
            }
        });

        // Close button functionality - complete cleanup
        const closeButtons = document.querySelectorAll('.btn-close');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('.modal');
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                    // Force complete cleanup
                    setTimeout(() => {
                        const backdrops = document.querySelectorAll('.modal-backdrop');
                        backdrops.forEach(backdrop => backdrop.remove());
                        document.body.classList.remove('modal-open');
                        document.body.style.removeProperty('overflow');
                        document.body.style.removeProperty('padding-right');
                    }, 200);
                }
            });
        });

        // ESC key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const visibleModal = document.querySelector('.modal.show');
                if (visibleModal) {
                    const modalInstance = bootstrap.Modal.getInstance(visibleModal);
                    if (modalInstance) {
                        modalInstance.hide();
                        setTimeout(() => {
                            const backdrops = document.querySelectorAll('.modal-backdrop');
                            backdrops.forEach(backdrop => backdrop.remove());
                            document.body.classList.remove('modal-open');
                            document.body.style.removeProperty('overflow');
                            document.body.style.removeProperty('padding-right');
                        }, 200);
                    }
                }
            }
        });
        
        // Show modal on validation errors
        @if($errors->has('email') || $errors->has('password'))
            setTimeout(() => {
                ensureModalBackdrop();
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {
                    backdrop: false
                });
                loginModal.show();
            }, 100);
        @endif
        
        @if($errors->has('name') || $errors->has('username') || $errors->has('terms'))
            setTimeout(() => {
                ensureModalBackdrop();
                const signupModal = new bootstrap.Modal(document.getElementById('signupModal'), {
                    backdrop: false
                });
                signupModal.show();
            }, 100);
        @endif
    });

    // Password toggle
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(inputId + 'Icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>
    
    @yield('scripts')
</body>
</html>