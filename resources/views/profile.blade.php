@extends('layouts.app')

@section('title', 'My Profile')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Profile Page Specific Styles */
    .profile-header {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #f97316;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .profile-photo-upload {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }

    .photo-upload-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #f97316;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .photo-upload-icon:hover {
        transform: scale(1.1);
        background-color: #ea580c;
    }

    .profile-name {
        font-size: 26px;
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 5px;
    }

    .profile-bio {
        color: #6c757d;
        margin-bottom: 20px;
    }

    .edit-profile-btn {
        background-color: #212121;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .edit-profile-btn:hover {
        background-color: #333;
    }

    .nav-tabs .nav-link {
        color: #495057;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 15px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        color: #f97316;
        background-color: transparent;
        border-bottom: 2px solid #f97316;
    }

    .article-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden; /* Pastikan konten tidak keluar */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 20px;
        word-wrap: break-word; /* Paksa kata panjang untuk wrap */
        word-break: break-word; /* Break kata panjang jika perlu */
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .article-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .article-content {
        padding: 20px;
        overflow: hidden; /* Cegah konten keluar */
    }

    .article-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #212121;
        line-height: 1.4;
        /* Batasi judul menjadi maksimal 2 baris */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        word-wrap: break-word;
        word-break: break-word;
        hyphens: auto; /* Tambahkan hyphenation untuk kata panjang */
    }

    .article-date {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 15px;
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .article-summary {
        color: #495057;
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.6;
        /* Batasi ringkasan menjadi maksimal 3 baris */
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        word-wrap: break-word;
        word-break: break-word;
    }

    .article-stats {
        display: flex;
        align-items: center;
        color: #6c757d;
        font-size: 14px;
    }

    .article-stats div {
        margin-right: 20px;
    }

    .article-stats i {
        margin-right: 5px;
    }

    .article-category {
        color: #f97316;
        font-weight: 500;
        font-size: 14px;
        margin-bottom: 10px;
        display: inline-block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .article-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .action-button {
        padding: 8px 15px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .edit-btn {
        background-color: #f8f9fa;
        color: #212121;
        border: 1px solid #dee2e6;
    }

    .edit-btn:hover {
        background-color: #e9ecef;
    }

    .delete-btn {
        background-color: #fff0f0;
        color: #dc3545;
        border: 1px solid #ffcccc;
    }

    .delete-btn:hover {
        background-color: #ffe0e0;
    }

    .new-article-btn {
        background-color: #f97316;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .new-article-btn:hover {
        background-color: #ea580c;
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    .empty-state {
        text-align: center;
        padding: 60px 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .empty-state img {
        width: 120px;
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .empty-state h3 {
        font-size: 22px;
        font-weight: 600;
        color: #212121;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #6c757d;
        margin-bottom: 25px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 1px solid #f1f1f1;
        padding: 20px 30px;
    }

    .modal-title {
        font-weight: 600;
        color: #212121;
    }

    .modal-body {
        padding: 30px;
    }

    .modal-footer {
        border-top: 1px solid #f1f1f1;
        padding: 20px 30px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #dee2e6;
    }

    .form-control:focus {
        border-color: #f97316;
        box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.25);
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #212121;
    }

    .save-profile-btn {
        background-color: #f97316;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 500;
    }

    .save-profile-btn:hover {
        background-color: #ea580c;
    }

    .cancel-btn {
        background-color: #f8f9fa;
        color: #212121;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 500;
    }

    .cancel-btn:hover {
        background-color: #e9ecef;
    }

    /* Perbaikan untuk grid container */
    .row {
        margin-right: -10px;
        margin-left: -10px;
    }

    .col-md-6, .col-lg-4 {
        padding-right: 10px;
        padding-left: 10px;
    }

    /* Pastikan tidak ada elemen yang overflow */
    .article-card * {
        max-width: 100%;
        box-sizing: border-box;
    }

    /* Perbaikan khusus untuk konten HTML yang tidak di-escape */
    .article-summary * {
        word-wrap: break-word !important;
        word-break: break-word !important;
        max-width: 100% !important;
    }

    /* Responsive fixes */
    @media (max-width: 768px) {
        .article-card {
            margin: 0 5px 20px 5px;
        }
        
        .article-title {
            font-size: 16px;
        }
        
        .article-content {
            padding: 15px;
        }
    }

    @media (max-width: 576px) {
        .row {
            margin-right: -5px;
            margin-left: -5px;
        }
        
        .col-md-6, .col-lg-4 {
            padding-right: 5px;
            padding-left: 5px;
        }
    }

<defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .delete-modal .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .delete-modal .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
        position: relative;
        z-index: 1;
    }

    .delete-modal .btn-close:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    .delete-modal .modal-body {
        padding: 35px 30px;
        text-align: center;
        background: white;
    }

    .delete-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        animation: pulse 2s infinite;
    }

    .delete-icon i {
        font-size: 36px;
        color: white;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
        }
        70% {
            box-shadow: 0 0 0 20px rgba(220, 53, 69, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
        }
    }

    .delete-modal .modal-body h4 {
        color: #212121;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .delete-modal .modal-body p {
        color: #6c757d;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 0;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .delete-modal .modal-footer {
        border: none;
        padding: 20px 30px 30px;
        background: #f8f9fa;
        gap: 15px;
    }

    .delete-modal .btn-cancel {
        background: white;
        color: #6c757d;
        border: 2px solid #dee2e6;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        flex: 1;
    }

    .delete-modal .btn-cancel:hover {
        background: #f8f9fa;
        color: #495057;
        border-color: #adb5bd;
        transform: translateY(-2px);
    }

    .delete-modal .btn-delete {
        background: linear-gradient(135deg, #212121, #333333);
        color: #f97316;
        border: 2px solid #f97316;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        flex: 1;
        position: relative;
        overflow: hidden;
    }

    .delete-modal .btn-delete:hover {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: white;
        border-color: #f97316;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(249, 115, 22, 0.3);
    }

    .delete-modal .btn-delete:active {
        transform: translateY(0);
    }

    .delete-modal .btn-delete::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(249,115,22,0.2), transparent);
        transition: left 0.5s;
    }

    .delete-modal .btn-delete:hover::before {
        left: 100%;
    }

    /* Loading state */
    .btn-delete.loading {
        pointer-events: none;
    }

    .btn-delete.loading i {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Modal animation */
    .delete-modal.fade .modal-dialog {
        transform: scale(0.8) translateY(-50px);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .delete-modal.show .modal-dialog {
        transform: scale(1) translateY(0);
        opacity: 1;
    }

    /* Article preview dalam modal */
    .article-preview {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        margin: 20px 0;
        border-left: 4px solid #f97316;
    }

    .article-preview h6 {
        color: #f97316;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .article-preview .article-title-preview {
        color: #212121;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 5px;
    }

    .article-preview .article-meta {
        color: #6c757d;
        font-size: 0.85rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-md-3 text-center text-md-start">
                <div class="profile-photo-upload">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="profile-photo">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $user->name }}" class="profile-photo">
                    @endif
                    <div class="photo-upload-icon" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="profile-name">{{ $user->name }}</h1>
                <p class="profile-bio">{{ $user->bio ?? 'No bio yet' }}</p>
                <div class="d-flex gap-2">
                    <span class="me-4"><i class="fas fa-newspaper me-2"></i> {{ count($publishedArticles) }} Articles</span>
                    <span><i class="fas fa-eye me-2"></i> 0 Views</span>
                </div>
            </div>
            <div class="col-md-3 text-md-end text-center mt-3 mt-md-0">
                <button class="edit-profile-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fas fa-edit me-2"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" id="published-tab" data-bs-toggle="tab" href="#published">Published Articles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="drafts-tab" data-bs-toggle="tab" href="#drafts">Drafts</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Published Articles Tab -->
        <div class="tab-pane fade show active" id="published">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Published Articles</h2>
                <a href="/publish" class="new-article-btn">
                    <i class="fas fa-plus"></i> New Article
                </a>
            </div>

            @if(count($publishedArticles) > 0)
            <div class="row">
                @foreach($publishedArticles as $article)
                <div class="col-md-6 col-lg-4">
                    <div class="article-card">
                        @if($article->cover_image)
                            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="article-image">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="article-image">
                        @endif
                        <div class="article-content">
                            <span class="article-category">{{ $article->category->name ?? 'Uncategorized' }}</span>
                            <h3 class="article-title">{{ $article->title }}</h3>
                            <span class="article-date"><i class="far fa-calendar-alt me-2"></i> {{ $article->formatted_publish_time ?? $article->formatted_created_at }}</span>
                            <p class="article-summary">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                            <div class="article-stats">
                                <div><i class="far fa-eye"></i> {{ $article->views ?? 0 }}</div>
                                <div><i class="far fa-comment"></i> {{ $article->comments_count ?? 0 }}</div>
                                <div><i class="far fa-heart"></i> {{ $article->likes_count ?? 0 }}</div>
                            </div>
                            <div class="article-actions">
                                <a href="/articles/{{ $article->id }}/edit" class="action-button edit-btn">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="/articles/{{ $article->id }}" method="POST" class="d-inline" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="action-button delete-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal"
                                        data-article-title="{{ $article->title }}"
                                        data-article-category="{{ $article->category->name ?? 'Uncategorized' }}"
                                        data-article-id="{{ $article->id }}"
                                        data-article-date="{{ $article->formatted_publish_time ?? $article->formatted_created_at }}">
                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <img src="{{ asset('img/image1.png') }}" alt="No articles" style="opacity: 0.5; max-width: 120px;">
                <h3>No published articles yet</h3>
                <p>When you publish articles, they will appear here. Start writing your first article now!</p>
                <a href="/publish" class="new-article-btn">
                    <i class="fas fa-plus"></i> Create Your First Article
                </a>
            </div>
            @endif
        </div>

        <!-- Drafts Tab -->
        <div class="tab-pane fade" id="drafts">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Draft Articles</h2>
                <a href="/publish" class="new-article-btn">
                    <i class="fas fa-plus"></i> New Draft
                </a>
            </div>

            @if(count($drafts) > 0)
            <div class="row">
                @foreach($drafts as $draft)
                <div class="col-md-6 col-lg-4">
                    <div class="article-card">
                        @if($draft->cover_image)
                            <img src="{{ asset('storage/' . $draft->cover_image) }}" alt="{{ $draft->title }}" class="article-image">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $draft->title }}" class="article-image">
                        @endif
                        <div class="article-content">
                            <span class="article-category">{{ $draft->category->name ?? 'Uncategorized' }}</span>
                            <h3 class="article-title">{{ $draft->title }}</h3>
                            <span class="article-date"><i class="far fa-edit me-2"></i> Last edited: {{ $draft->updated_at->format('F j, Y') }}</span>
                            <p class="article-summary">{{ Str::limit(strip_tags($draft->content), 100) }}</p>
                            <div class="article-actions">
                                <a href="/articles/{{ $draft->id }}/edit" class="action-button edit-btn">
                                    <i class="fas fa-edit me-1"></i> Edit Draft
                                </a>
                                <form action="/articles/{{ $draft->id }}/publish" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="action-button btn btn-success">
                                        <i class="fas fa-paper-plane me-1"></i> Publish
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <img src="{{ asset('img/image1.png') }}" alt="No drafts" style="opacity: 0.5; max-width: 120px;">
                <h3>No drafts saved</h3>
                <p>Drafts let you save your articles before publishing. Start writing and save as a draft to continue later.</p>
                <a href="/publish" class="new-article-btn">
                    <i class="fas fa-plus"></i> Create New Draft
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Photo" class="profile-photo mb-3" id="preview-image">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="Profile Photo" class="profile-photo mb-3" id="preview-image">
                        @endif
                        <div>
                            <label for="profile_image" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-camera me-2"></i> Change Photo
                            </label>
                            <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" value="{{ $user->username }}" disabled>
                        <small class="text-muted">Username cannot be changed</small>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changePassword">
                            <label class="form-check-label" for="changePassword">
                                Change Password
                            </label>
                        </div>
                    </div>
                    <div id="passwordFields" style="display: none;">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="save-profile-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Enhanced Delete Confirmation Modal -->
<div class="modal fade delete-modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Hapus Artikel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="delete-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h4>Hapus Artikel Ini?</h4>
                <p>Artikel yang sudah dihapus tidak dapat dikembalikan. Pastikan Anda yakin dengan keputusan ini.</p>
                
                <!-- Article Preview -->
                <div class="article-preview">
                    <h6 id="previewCategory">KATEGORI</h6>
                    <div class="article-title-preview" id="previewTitle">Judul Artikel</div>
                    <div class="article-meta">
                        <i class="far fa-calendar-alt me-1"></i>
                        <span id="previewDate">Tanggal publikasi</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>
                    Batal
                </button>
                <button type="button" class="btn btn-delete" id="confirmDeleteBtn">
                    <i class="fas fa-trash-alt me-2"></i>
                    Ya, Hapus Artikel
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview profile image before upload
        const profileImageInput = document.getElementById('profile_image');
        const previewImage = document.getElementById('preview-image');
        
        if (profileImageInput && previewImage) {
            profileImageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        // Toggle password fields
        const changePasswordCheckbox = document.getElementById('changePassword');
        const passwordFields = document.getElementById('passwordFields');
        
        if (changePasswordCheckbox && passwordFields) {
            changePasswordCheckbox.addEventListener('change', function() {
                passwordFields.style.display = this.checked ? 'block' : 'none';
                
                // Clear password fields when checkbox is unchecked
                if (!this.checked) {
                    document.getElementById('current_password').value = '';
                    document.getElementById('password').value = '';
                    document.getElementById('password_confirmation').value = '';
                }
            });
        }

        // Enhanced Delete Modal functionality
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        let currentForm = null;

        // Ketika modal delete dibuka
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const articleTitle = button.getAttribute('data-article-title');
            const articleCategory = button.getAttribute('data-article-category');
            const articleDate = button.getAttribute('data-article-date');
            
            // Update preview dalam modal
            document.getElementById('previewTitle').textContent = articleTitle;
            document.getElementById('previewCategory').textContent = articleCategory.toUpperCase();
            document.getElementById('previewDate').textContent = articleDate;

            // Cari form yang sesuai
            currentForm = button.closest('.article-actions').querySelector('form');
        });

        // Ketika tombol konfirmasi diklik
        confirmDeleteBtn.addEventListener('click', function() {
            if (currentForm) {
                // Tambahkan loading state
                this.classList.add('loading');
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...';
                this.disabled = true;
                
                // Submit form
                currentForm.submit();
            }
        });

        // Reset modal ketika ditutup
        deleteModal.addEventListener('hidden.bs.modal', function () {
            confirmDeleteBtn.classList.remove('loading');
            confirmDeleteBtn.innerHTML = '<i class="fas fa-trash-alt me-2"></i>Ya, Hapus Artikel';
            confirmDeleteBtn.disabled = false;
            currentForm = null;
        });
    });
</script>
@endsection