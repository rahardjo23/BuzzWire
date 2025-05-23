@extends('layouts.app')

@section('title', 'BuzzWire News')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
    /* Login Modal Styles */
    .modal-content {
        border-radius: 12px;
        border: none;
    }
    
    .modal-header {
        border-bottom: none;
        padding: 1.5rem 1.5rem 0.5rem;
    }
    
    .modal-body {
        padding: 1rem 1.5rem;
    }
    
    .login-form .form-control {
        padding: 0.75rem;
        border-radius: 8px;
    }
    
    .btn-login {
        background-color: #1a73e8;
        color: white;
        border-radius: 8px;
        padding: 0.75rem;
        font-weight: 500;
        width: 100%;
        margin-top: 1rem;
    }
    
    .btn-login:hover {
        background-color: #1765cc;
        color: white;
    }
    
    .signup-link {
        text-align: center;
        margin-top: 1.5rem;
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
    
    .btn-social {
        background-color: white;
        border: 1px solid #e0e0e0;
        padding: 0.75rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        margin-bottom: 1rem;
        width: 100%;
    }
    
    .btn-social img {
        margin-right: 10px;
        width: 20px;
        height: 20px;
    }

    /* FIX: Prevent text overflow and fix image width */
    .side-article-content h2 {
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.3;
    }

    .article-summary {
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.4;
    }

    .side-article-image {
        width: 120px !important;
        height: 120px !important;
        object-fit: cover;
        flex-shrink: 0;
    }

    /* Ensure container doesn't break */
    .side-article-content {
        min-width: 0;
        overflow: hidden;
    }

    /* Responsive artikel pada mobile */
    @media (max-width: 768px) {
        .main-article h1 {
            font-size: 1.5rem;
        }
        
        .side-article-content h2 {
            font-size: 1.1rem;
        }

        .side-article-image {
            width: 100px !important;
            height: 100px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- Main Article -->
        <div class="col-lg-6">
            @if($featuredArticle)
                <a href="{{ route('articles.show', $featuredArticle) }}" class="article-link">
                    <div class="author-info">
                        @if($featuredArticle->user->profile_image)
                            <img src="{{ asset('storage/' . $featuredArticle->user->profile_image) }}" alt="{{ $featuredArticle->user->name }}" class="author-avatar">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $featuredArticle->user->name }}" class="author-avatar">
                        @endif
                        <div>
                            <h4 class="author-name">{{ $featuredArticle->user->name }}</h4>
                            <div class="author-title">{{ $featuredArticle->user->bio ?? 'Author' }}</div>
                        </div>
                    </div>
                    
                    <div class="main-article">
                        <h1>{{ $featuredArticle->title }}</h1>
                        <div class="category-tag1">{{ $featuredArticle->category->name ?? 'News' }}</div>
                        @if($featuredArticle->cover_image)
                            <img src="{{ asset('storage/' . $featuredArticle->cover_image) }}" alt="{{ $featuredArticle->title }}" class="article-image">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $featuredArticle->title }}" class="article-image">
                        @endif
                    </div>
                </a>
            @else
                <!-- Fallback jika tidak ada artikel -->
                <a href="#" class="article-link">
                    <div class="author-info">
                        <img src="{{ asset('img/image1.png') }}" alt="BuzzWire" class="author-avatar">
                        <div>
                            <h4 class="author-name">BuzzWire Team</h4>
                            <div class="author-title">Editorial</div>
                        </div>
                    </div>
                    
                    <div class="main-article">
                        <h1>Welcome to BuzzWire News</h1>
                        <div class="category-tag1">News</div>
                        <img src="{{ asset('img/image1.png') }}" alt="Welcome" class="article-image">
                    </div>
                </a>
            @endif
        </div>

        <!-- Side Articles -->
        <div class="col-lg-6">
            @if($latestArticles && $latestArticles->count() > 0)
                @foreach($latestArticles as $article)
                <!-- Side Article {{ $loop->iteration }} -->
                <a href="{{ route('articles.show', $article) }}" class="side-article-link">
                    <div class="side-article-content">
                        <h2>{{ $article->title }}</h2>
                        <div class="article-summary">{{ Str::limit(strip_tags($article->content), 100) }}</div>
                        <div class="category-tag">{{ $article->category->name ?? 'News' }}</div>
                        <span class="read-more-indicator">→</span>
                    </div>
                    @if($article->cover_image)
                        <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="side-article-image">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="side-article-image">
                    @endif
                </a>
                @endforeach
            @else
                <!-- Fallback jika tidak ada artikel di sidebar -->
                @for($i = 1; $i <= 3; $i++)
                <a href="#" class="side-article-link">
                    <div class="side-article-content">
                        <h2>No Articles Available</h2>
                        <div class="article-summary">Start writing your first article to see it appear here...</div>
                        <div class="category-tag">News</div>
                        <span class="read-more-indicator">→</span>
                    </div>
                    <img src="{{ asset('img/image1.png') }}" alt="No Content" class="side-article-image">
                </a>
                @endfor
            @endif
        </div>
    </div>
</div>

@guest
<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Log in to BuzzWire</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Social Login Buttons -->
        <button class="btn btn-social">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
          </svg>
          <span class="ms-2">Continue with Google</span>
        </button>
        
        <button class="btn btn-social">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
          </svg>
          <span class="ms-2">Continue with Facebook</span>
        </button>
        
        <div class="login-divider">
          <span>or</span>
        </div>
        
        <!-- Email Password Login Form -->
        <form class="login-form" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter your password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
            <a href="#" class="float-end">Forgot password?</a>
          </div>
          <button type="submit" class="btn btn-login">Log In</button>
        </form>
        
        <div class="signup-link">
          Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Sign up</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Sign Up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Create your account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Social Signup Buttons -->
        <button class="btn btn-social">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
          </svg>
          <span class="ms-2">Sign up with Google</span>
        </button>
        
        <button class="btn btn-social">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
          </svg>
          <span class="ms-2">Sign up with Facebook</span>
        </button>
        
        <div class="login-divider">
          <span>or</span>
        </div>
        
        <!-- Email Signup Form -->
        <form class="login-form" method="POST" action="{{ route('register') }}">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Choose a username" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Create a password" required>
            <small class="text-muted">Password must be at least 8 characters long</small>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms">
            <label class="form-check-label" for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
            @error('terms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-login">Sign Up</button>
        </form>
        
        <div class="signup-link">
          Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Log in</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endguest
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle login and signup modal switches
        const loginLink = document.querySelector('a[data-bs-target="#loginModal"]');
        const signupLink = document.querySelector('a[data-bs-target="#signupModal"]');
        
        if (loginLink) {
            loginLink.addEventListener('click', function(e) {
                e.preventDefault();
                const signupModal = bootstrap.Modal.getInstance(document.getElementById('signupModal'));
                if (signupModal) signupModal.hide();
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            });
        }
        
        if (signupLink) {
            signupLink.addEventListener('click', function(e) {
                e.preventDefault();
                const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                if (loginModal) loginModal.hide();
                const signupModal = new bootstrap.Modal(document.getElementById('signupModal'));
                signupModal.show();
            });
        }
        
        // FIX: Ensure modal backdrop is removed when closing with X button
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function() {
                // Remove any leftover backdrop
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
                // Remove modal-open class from body to enable scrolling
                document.body.classList.remove('modal-open');
                // Remove inline styles added by Bootstrap
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('padding-right');
            });
        });

        // Additional fix for the close button clicks
        const closeButtons = document.querySelectorAll('.btn-close');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get parent modal
                const modal = this.closest('.modal');
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }
            });
        });
        
        // If there are validation errors, show the appropriate modal
        @if($errors->has('email') || $errors->has('password'))
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        @endif
        
        @if($errors->has('name') || $errors->has('username') || $errors->has('terms'))
            const signupModal = new bootstrap.Modal(document.getElementById('signupModal'));
            signupModal.show();
        @endif
    });
</script>
@endsection