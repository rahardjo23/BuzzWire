@extends('layouts.app')

@section('title', 'My Profile')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary-color: #f97316;
        --primary-dark: #ea580c;
        --black: #000000;
        --dark-gray: #1a1a1a;
        --medium-gray: #333333;
        --light-gray: #666666;
        --border-gray: #e5e5e5;
        --white: #ffffff;
        --text-primary: #000000;
        --text-secondary: #666666;
        --text-muted: #999999;
    }

    body {
        background: 
            radial-gradient(circle at 20% 50%, rgba(249, 115, 22, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(0, 0, 0, 0.04) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(249, 115, 22, 0.02) 0%, transparent 50%),
            linear-gradient(135deg, #fafafa 0%, #ffffff 50%, #f8f9fa 100%);
        color: var(--text-primary);
        line-height: 1.6;
        position: relative;
    }
    
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            linear-gradient(90deg, rgba(0,0,0,0.02) 1px, transparent 1px),
            linear-gradient(180deg, rgba(0,0,0,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
        z-index: -1;
        opacity: 0.3;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    /* Clean Profile Header */
    .profile-header {
        background: var(--white);
        border: 1px solid var(--border-gray);
        border-radius: 16px;
        padding: 3rem;
        margin-bottom: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-color);
        transition: all 0.2s ease;
    }

    .profile-photo:hover {
        transform: scale(1.02);
    }

    .profile-photo-container {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }

    .photo-edit-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 36px;
        height: 36px;
        background: var(--primary-color);
        border: 3px solid var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        color: var(--white);
        font-size: 14px;
    }

    .photo-edit-btn:hover {
        background: var(--primary-dark);
        transform: scale(1.1);
    }

    .profile-name {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 1.5rem 0 0.5rem;
        letter-spacing: -0.02em;
    }

    .profile-bio {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }

    .profile-stats {
        display: flex;
        gap: 2rem;
        font-size: 0.9rem;
        color: var(--text-secondary);
    }

    .profile-stats span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .profile-stats i {
        color: var(--primary-color);
        width: 16px;
    }

    .edit-profile-btn {
        background: var(--black);
        color: var(--white);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .edit-profile-btn:hover {
        background: var(--medium-gray);
        color: var(--white);
        transform: translateY(-1px);
    }

    /* Clean Navigation */
    .nav-container {
        background: var(--white);
        border: 1px solid var(--border-gray);
        border-radius: 12px;
        padding: 0.25rem;
        margin-bottom: 2rem;
        display: inline-flex;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .nav-tabs {
        border: none;
        gap: 0.25rem;
    }

    .nav-tabs .nav-link {
        color: var(--text-secondary);
        background: transparent;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .nav-tabs .nav-link:hover {
        color: var(--text-primary);
        background: #f8f9fa;
    }

    .nav-tabs .nav-link.active {
        color: var(--white);
        background: var(--black);
    }

    /* Section Headers */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        letter-spacing: -0.02em;
    }

    .new-article-btn {
        background: var(--primary-color);
        color: var(--white);
        text-decoration: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
    }

    .new-article-btn:hover {
        background: var(--primary-dark);
        color: var(--white);
        text-decoration: none;
        transform: translateY(-1px);
    }

    /* Clean Article Cards */
    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    .article-card {
        background: var(--white);
        border: 1px solid var(--border-gray);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .article-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-color: var(--primary-color);
    }

    .article-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        background: #f8f9fa;
    }

    .article-content {
        padding: 1.5rem;
    }

    .article-category {
        display: inline-block;
        background: #f8f9fa;
        color: var(--primary-color);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.75rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    .article-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        letter-spacing: -0.01em;
    }

    .article-date {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .article-summary {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-stats {
        display: flex;
        gap: 1.5rem;
        padding: 0.75rem 0;
        border-top: 1px solid #f1f1f1;
        border-bottom: 1px solid #f1f1f1;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .article-stats div {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .article-actions {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        flex: 1;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        border: none;
        cursor: pointer;
    }

    .edit-btn {
        background: #f8f9fa;
        color: var(--text-primary);
        border: 1px solid var(--border-gray);
    }

    .edit-btn:hover {
        background: var(--black);
        color: var(--white);
        text-decoration: none;
    }

    .delete-btn {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .delete-btn:hover {
        background: #dc2626;
        color: var(--white);
        border-color: #dc2626;
    }

    .publish-btn {
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }

    .publish-btn:hover {
        background: #16a34a;
        color: var(--white);
        border-color: #16a34a;
    }

    /* Clean Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: var(--white);
        border: 1px solid var(--border-gray);
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--text-muted);
        font-size: 1.5rem;
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        letter-spacing: -0.01em;
    }

    .empty-state p {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.5;
    }

    /* Clean Modals */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-header {
        padding: 2rem 2rem 1rem;
        border-bottom: 1px solid var(--border-gray);
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }

    .modal-body {
        padding: 1.5rem 2rem;
    }

    .modal-footer {
        padding: 1rem 2rem 2rem;
        border-top: 1px solid var(--border-gray);
        gap: 0.75rem;
    }

    .form-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border: 1px solid var(--border-gray);
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: var(--white);
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }

    .btn-primary {
        background: var(--primary-color);
        color: var(--white);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #f8f9fa;
        color: var(--text-primary);
        border: 1px solid var(--border-gray);
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .btn-secondary:hover {
        background: var(--border-gray);
        color: var(--text-primary);
    }

    /* Delete Modal */
    .delete-modal .modal-body {
        text-align: center;
        padding: 2rem;
    }

    .delete-icon {
        width: 64px;
        height: 64px;
        background: #fef2f2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: #dc2626;
        font-size: 1.5rem;
    }

    .delete-modal h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .delete-modal p {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
    }

    .article-preview {
        background: #f8f9fa;
        border: 1px solid var(--border-gray);
        border-radius: 8px;
        padding: 1rem;
        text-align: left;
        margin-bottom: 1.5rem;
    }

    .article-preview-category {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--primary-color);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .article-preview-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .article-preview-date {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .btn-danger {
        background: #dc2626;
        color: var(--white);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        flex: 1;
    }

    .btn-danger:hover {
        background: #b91c1c;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: #f8f9fa;
        color: var(--text-primary);
        border: 1px solid var(--border-gray);
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        flex: 1;
    }

    .btn-cancel:hover {
        background: var(--border-gray);
    }

    /* Alerts */
    .alert {
        border: none;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .profile-header {
            padding: 2rem 1.5rem;
        }

        .profile-stats {
            flex-direction: column;
            gap: 0.75rem;
        }

        .section-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .articles-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .nav-container {
            width: 100%;
        }

        .nav-tabs {
            width: 100%;
        }

        .nav-tabs .nav-link {
            flex: 1;
            text-align: center;
        }
    }

    /* Subtle animations */
    .article-card, .profile-header, .nav-container, .empty-state {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                <div class="profile-photo-container">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="profile-photo">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $user->name }}" class="profile-photo">
                    @endif
                    <div class="photo-edit-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="profile-name">{{ $user->name }}</h1>
                <p class="profile-bio">{{ $user->bio ?? 'Writer and content creator' }}</p>
                <div class="profile-stats">
                    <span><i class="fas fa-newspaper"></i> {{ count($publishedArticles) }} Articles</span>
                    <span><i class="fas fa-eye"></i> 0 Views</span>
                    <span><i class="fas fa-calendar"></i> Member since {{ $user->created_at->format('M Y') }}</span>
                </div>
            </div>
            <div class="col-md-3 text-md-end text-center">
                <button class="edit-profile-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="nav-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#published">
                    Published Articles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#drafts">
                    Draft Articles
                </a>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Published Articles -->
        <div class="tab-pane fade show active" id="published">
            <div class="section-header">
                <h2 class="section-title">Published Articles</h2>
                <a href="/publish" class="new-article-btn">
                    <i class="fas fa-plus"></i> New Article
                </a>
            </div>

            @if(count($publishedArticles) > 0)
            <div class="articles-grid">
                @foreach($publishedArticles as $article)
                <div class="article-card">
                    @if($article->cover_image)
                        <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="article-image">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="article-image">
                    @endif
                    <div class="article-content">
                        <div class="article-category">{{ $article->category->name ?? 'Uncategorized' }}</div>
                        <h3 class="article-title">{{ $article->title }}</h3>
                        <div class="article-date">
                            <i class="far fa-calendar"></i>
                            {{ $article->formatted_publish_time ?? $article->formatted_created_at }}
                        </div>
                        <p class="article-summary">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                        <div class="article-stats">
                            <div><i class="far fa-eye"></i> {{ $article->views ?? 0 }}</div>
                            <div><i class="far fa-comment"></i> {{ $article->comments_count ?? 0 }}</div>
                            <div><i class="far fa-heart"></i> {{ $article->likes_count ?? 0 }}</div>
                        </div>
                        <div class="article-actions">
                            <a href="/articles/{{ $article->id }}/edit" class="action-btn edit-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="/articles/{{ $article->id }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="action-btn delete-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal"
                                    data-article-title="{{ $article->title }}"
                                    data-article-category="{{ $article->category->name ?? 'Uncategorized' }}"
                                    data-article-date="{{ $article->formatted_publish_time ?? $article->formatted_created_at }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3>No articles published yet</h3>
                <p>Start writing and share your thoughts with the world. Your published articles will appear here.</p>
                <a href="/publish" class="new-article-btn">
                    <i class="fas fa-plus"></i> Write Your First Article
                </a>
            </div>
            @endif
        </div>

        <!-- Draft Articles -->
        <div class="tab-pane fade" id="drafts">
            <div class="section-header">
                <h2 class="section-title">Draft Articles</h2>
                <a href="/publish" class="new-article-btn">
                    <i class="fas fa-plus"></i> New Draft
                </a>
            </div>

            @if(count($drafts) > 0)
            <div class="articles-grid">
                @foreach($drafts as $draft)
                <div class="article-card">
                    @if($draft->cover_image)
                        <img src="{{ asset('storage/' . $draft->cover_image) }}" alt="{{ $draft->title }}" class="article-image">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $draft->title }}" class="article-image">
                    @endif
                    <div class="article-content">
                        <div class="article-category">{{ $draft->category->name ?? 'Uncategorized' }}</div>
                        <h3 class="article-title">{{ $draft->title }}</h3>
                        <div class="article-date">
                            <i class="far fa-edit"></i>
                            Last edited {{ $draft->updated_at->format('M j, Y') }}
                        </div>
                        <p class="article-summary">{{ Str::limit(strip_tags($draft->content), 120) }}</p>
                        <div class="article-actions">
                            <a href="/articles/{{ $draft->id }}/edit" class="action-btn edit-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="/articles/{{ $draft->id }}/publish" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="action-btn publish-btn">
                                    <i class="fas fa-paper-plane"></i> Publish
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>No drafts saved</h3>
                <p>Save your work in progress as drafts. You can continue editing and publish them when ready.</p>
                <a href="/publish" class="new-article-btn">
                    <i class="fas fa-plus"></i> Start Writing
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" class="profile-photo mb-3" id="preview-image">
                            @else
                                <img src="{{ asset('img/image1.png') }}" alt="Profile" class="profile-photo mb-3" id="preview-image">
                            @endif
                            <div>
                                <label for="profile_image" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-camera me-1"></i> Change Photo
                                </label>
                                <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="changePassword">
                        <label class="form-check-label" for="changePassword">
                            Change Password
                        </label>
                    </div>
                    
                    <div id="passwordFields" style="display: none;">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade delete-modal" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="delete-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h4>Are you sure?</h4>
                <p>This action cannot be undone. The article will be permanently deleted.</p>
                
                <div class="article-preview">
                    <div class="article-preview-category" id="previewCategory">CATEGORY</div>
                    <div class="article-preview-title" id="previewTitle">Article Title</div>
                    <div class="article-preview-date" id="previewDate">Publication date</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-danger" id="confirmDeleteBtn">Delete Article</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Profile image preview
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

        // Password fields toggle
        const changePasswordCheckbox = document.getElementById('changePassword');
        const passwordFields = document.getElementById('passwordFields');
        
        if (changePasswordCheckbox && passwordFields) {
            changePasswordCheckbox.addEventListener('change', function() {
                passwordFields.style.display = this.checked ? 'block' : 'none';
                
                if (!this.checked) {
                    document.getElementById('current_password').value = '';
                    document.getElementById('password').value = '';
                    document.getElementById('password_confirmation').value = '';
                }
            });
        }

        // Delete modal functionality
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        let currentForm = null;

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const articleTitle = button.getAttribute('data-article-title');
            const articleCategory = button.getAttribute('data-article-category');
            const articleDate = button.getAttribute('data-article-date');
            
            document.getElementById('previewTitle').textContent = articleTitle;
            document.getElementById('previewCategory').textContent = articleCategory.toUpperCase();
            document.getElementById('previewDate').textContent = articleDate;

            currentForm = button.closest('.article-actions').querySelector('form');
        });

        confirmDeleteBtn.addEventListener('click', function() {
            if (currentForm) {
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Deleting...';
                this.disabled = true;
                currentForm.submit();
            }
        });

        deleteModal.addEventListener('hidden.bs.modal', function () {
            confirmDeleteBtn.innerHTML = 'Delete Article';
            confirmDeleteBtn.disabled = false;
            currentForm = null;
        });

        // Smooth tab transitions
        const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Add smooth transition effect
                const targetPane = document.querySelector(this.getAttribute('href'));
                if (targetPane) {
                    setTimeout(() => {
                        targetPane.style.opacity = '0';
                        targetPane.style.transform = 'translateY(10px)';
                        
                        setTimeout(() => {
                            targetPane.style.transition = 'all 0.3s ease';
                            targetPane.style.opacity = '1';
                            targetPane.style.transform = 'translateY(0)';
                        }, 50);
                    }, 100);
                }
            });
        });
    });
</script>
@endsection