@extends('layouts.app')

@section('title', $category->name . ' News')

@section('styles')
<style>
    :root {
        --primary-black: #1a1a1a;
        --text-gray: #6b7280;
        --light-gray: #f3f4f6;
        --border-gray: #e5e7eb;
        --white: #ffffff;
        --orange-accent: #f97316;
        --hover-gray: #f9fafb;
    }

    body {
        background-color: var(--light-gray);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        color: var(--primary-black);
    }

    .category-header {
        background: linear-gradient(135deg, var(--primary-black) 0%, #2d2d2d 100%);
        color: var(--white);
        padding: 4rem 0 3rem;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .category-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        pointer-events: none;
    }

    .category-header-content {
        position: relative;
        z-index: 2;
    }

    .category-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
        line-height: 1.1;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .category-description {
        color: rgba(255, 255, 255, 0.85);
        font-size: 1.2rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 600px;
        font-weight: 300;
    }

    .category-meta {
        display: flex;
        align-items: center;
        gap: 2.5rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 500;
    }

    .meta-item i {
        font-size: 1rem;
        opacity: 0.8;
    }

    .main-article {
        background: var(--white);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        margin-bottom: 3rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .main-article:hover {
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2);
        transform: translateY(-4px);
    }

    .main-article-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .main-article-image {
        width: 100%;
        height: 450px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .main-article:hover .main-article-image {
        transform: scale(1.02);
    }

    .main-article-content {
        padding: 2.5rem;
    }

    .article-category-tag {
        background: var(--orange-accent);
        color: var(--white);
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        margin-bottom: 1.5rem;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .main-article-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary-black);
        line-height: 1.2;
        margin-bottom: 1.2rem;
        letter-spacing: -0.03em;
    }

    .main-article-excerpt {
        color: var(--text-gray);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 2rem;
        font-weight: 400;
    }

    .article-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid var(--border-gray);
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .author-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .author-name {
        font-weight: 600;
        color: var(--primary-black);
        font-size: 0.875rem;
    }

    .article-time {
        color: var(--text-gray);
        font-size: 0.875rem;
    }

    .sidebar-articles {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .sidebar-article {
        background: var(--white);
        border-radius: 12px;
        padding: 1.8rem;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        border: 1px solid var(--border-gray);
        position: relative;
        overflow: hidden;
    }

    .sidebar-article::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        background: var(--orange-accent);
        transform: scaleY(0);
        transition: transform 0.3s ease;
        transform-origin: bottom;
    }

    .sidebar-article:hover {
        background: var(--hover-gray);
        text-decoration: none;
        color: inherit;
        transform: translateX(6px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .sidebar-article:hover::before {
        transform: scaleY(1);
    }

    /* Fix navbar untuk guest user di category page */
    .navbar {
        position: relative !important;
        z-index: 1050 !important;
    }

    .dropdown-menu {
        z-index: 1060 !important;
        position: absolute !important;
    }

    .user-menu-button {
        position: relative !important;
    }

    .dropdown {
        position: relative !important;
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }

    .modal {
        z-index: 1050 !important;
    }

    .navbar .dropdown-menu {
        margin-top: 0.5rem !important;
    }

    .sidebar-article-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-black);
        line-height: 1.4;
        margin-bottom: 0.8rem;
        letter-spacing: -0.01em;
    }

    .sidebar-article-time {
        color: var(--text-gray);
        font-size: 0.85rem;
        font-weight: 500;
    }

    .articles-section {
        margin-top: 3rem;
    }

    .section-header {
        background: linear-gradient(135deg, var(--white) 0%, #fafafa 100%);
        padding: 3rem 2rem;
        border-radius: 16px;
        margin-bottom: 3rem;
        text-align: center;
        border: 1px solid var(--border-gray);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-black);
        margin-bottom: 0.8rem;
        letter-spacing: -0.03em;
    }

    .section-subtitle {
        color: var(--text-gray);
        font-size: 1.1rem;
        font-weight: 400;
        max-width: 500px;
        margin: 0 auto;
    }

    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .article-card {
        background: var(--white);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border-gray);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        color: inherit;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .article-card:hover {
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.16);
        transform: translateY(-6px);
        text-decoration: none;
        color: inherit;
        border-color: rgba(0, 0, 0, 0.1);
    }

    .article-card-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .article-card:hover .article-card-image {
        transform: scale(1.05);
    }

    .article-card-content {
        padding: 2rem;
    }

    .article-card-category {
        background: var(--orange-accent);
        color: var(--white);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .article-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-black);
        line-height: 1.3;
        margin-bottom: 1rem;
        letter-spacing: -0.01em;
    }

    .article-card-excerpt {
        color: var(--text-gray);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid var(--border-gray);
    }

    .card-author-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-author-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        object-fit: cover;
    }

    .card-author-name {
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--primary-black);
    }

    .card-article-time {
        color: var(--text-gray);
        font-size: 0.8rem;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    .no-articles {
        background: var(--white);
        border-radius: 12px;
        padding: 4rem 2rem;
        text-align: center;
        border: 1px solid var(--border-gray);
        margin: 2rem 0;
    }

    .no-articles-icon {
        font-size: 3rem;
        color: var(--text-gray);
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    .no-articles h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 0.75rem;
    }

    .no-articles p {
        color: var(--text-gray);
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    .btn-primary {
        background: var(--primary-black);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        color: var(--white);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        background: #000;
        color: var(--white);
        text-decoration: none;
        transform: translateY(-1px);
    }

        /* Responsive Design */
        @media (max-width: 768px) {
            .category-title {
                font-size: 2.5rem;
            }

            .category-header {
                padding: 3rem 0 2rem;
            }

            .main-article-content {
                padding: 2rem;
            }

            .main-article-title {
                font-size: 1.8rem;
            }

            .articles-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .article-card-content {
                padding: 1.5rem;
            }

            .sidebar-articles {
                margin-top: 2rem;
            }

            .category-meta {
                flex-wrap: wrap;
                gap: 1.5rem;
            }

            .section-header {
                padding: 2rem 1.5rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .category-header {
                padding: 2rem 0 1.5rem;
            }

            .category-title {
                font-size: 2rem;
            }

            .main-article-content {
                padding: 1.5rem;
            }

            .sidebar-article {
                padding: 1.5rem;
            }

            .section-header {
                padding: 1.5rem 1rem;
            }

            .section-title {
                font-size: 1.8rem;
            }
        }
</style>
@endsection

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <div class="category-header-content">
            <h1 class="category-title">{{ $category->name }}</h1>
            <p class="category-description">
                {{ $category->description ?? 'Latest news and updates in ' . $category->name . ' from our expert contributors.' }}
            </p>
            <div class="category-meta">
                <div class="meta-item">
                    <i class="fas fa-newspaper"></i>
                    <span>{{ $articles->total() }} Articles</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>Updated Daily</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-users"></i>
                    <span>Expert Contributors</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
@if($articles->count() > 0)
<div class="container">
    <div class="row">
        <!-- Main Featured Article -->
        <div class="col-lg-8">
            @php $featuredArticle = $articles->first(); @endphp
            <div class="main-article">
                <a href="{{ route('articles.show', $featuredArticle) }}" class="main-article-link">
                    @if($featuredArticle->cover_image)
                        <img src="{{ asset('storage/' . $featuredArticle->cover_image) }}" alt="{{ $featuredArticle->title }}" class="main-article-image">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $featuredArticle->title }}" class="main-article-image">
                    @endif
                    <div class="main-article-content">
                        <span class="article-category-tag">{{ $category->name }}</span>
                        <h2 class="main-article-title">{{ $featuredArticle->title }}</h2>
                        <p class="main-article-excerpt">
                            {{ Str::limit(strip_tags($featuredArticle->content), 200) }}
                        </p>
                        <div class="article-meta">
                            <div class="author-info">
                                @if($featuredArticle->user->profile_image)
                                    <img src="{{ asset('storage/' . $featuredArticle->user->profile_image) }}" alt="{{ $featuredArticle->user->name }}" class="author-avatar">
                                @else
                                    <img src="{{ asset('img/image1.png') }}" alt="{{ $featuredArticle->user->name }}" class="author-avatar">
                                @endif
                                <span class="author-name">{{ $featuredArticle->user->name }}</span>
                            </div>
                            <span class="article-time">{{ $featuredArticle->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Sidebar Articles -->
        <div class="col-lg-4">
            <div class="sidebar-articles">
                @foreach($articles->skip(1)->take(4) as $article)
                <a href="{{ route('articles.show', $article) }}" class="sidebar-article">
                    <h3 class="sidebar-article-title">{{ $article->title }}</h3>
                    <span class="sidebar-article-time">{{ $article->created_at->diffForHumans() }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Latest Articles Section -->
<div class="container articles-section">
    <div class="section-header">
        <h2 class="section-title">Latest in {{ $category->name }}</h2>
        <p class="section-subtitle">Stay updated with our most recent {{ strtolower($category->name) }} coverage</p>
    </div>
    
    <div class="articles-grid">
        @foreach($articles->skip(5) as $article)
        <a href="{{ route('articles.show', $article) }}" class="article-card">
            @if($article->cover_image)
                <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="article-card-image">
            @else
                <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="article-card-image">
            @endif
            <div class="article-card-content">
                <span class="article-card-category">{{ $category->name }}</span>
                <h3 class="article-card-title">{{ $article->title }}</h3>
                <p class="article-card-excerpt">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                <div class="article-card-meta">
                    <div class="card-author-info">
                        @if($article->user->profile_image)
                            <img src="{{ asset('storage/' . $article->user->profile_image) }}" alt="{{ $article->user->name }}" class="card-author-avatar">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $article->user->name }}" class="card-author-avatar">
                        @endif
                        <span class="card-author-name">{{ $article->user->name }}</span>
                    </div>
                    <span class="card-article-time">{{ $article->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="pagination-wrapper">
        {{ $articles->links() }}
    </div>
    @endif
</div>

@else
<!-- No Articles State -->
<div class="container">
    <div class="no-articles">
        <div class="no-articles-icon">
            <i class="far fa-newspaper"></i>
        </div>
        <h3>No {{ $category->name }} Articles Yet</h3>
        <p>Be the first to contribute to the {{ strtolower($category->name) }} section!</p>
        @auth
            <a href="{{ route('articles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Write First Article
            </a>
        @else
            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i>
                Login to Write
            </a>
        @endauth
    </div>
</div>
@endif
@endsection