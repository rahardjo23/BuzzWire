@extends('layouts.app')

@section('title', 'Trending Articles - BuzzWire News')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
    /* CRITICAL: Remove gap between navbar and hero section */
    body {
        margin: 0;
        padding: 0;
    }

    /* Override content-container padding for this page */
    .content-container {
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    /* Elegant Trending Hero Section - Matching Navbar Style */
    .trending-hero {
        background-color: #212121;
        color: white;
        padding: 3rem 0 2.5rem;
        margin-top: 0;
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
        border-bottom: 1px solid #333;
    }

    .trending-hero-content {
        position: relative;
        z-index: 2;
    }

    .trending-hero h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
        letter-spacing: -0.02em;
        line-height: 1.2;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .trending-icon {
        font-size: 2.5rem;
        color: #f97316;
        display: inline-block;
    }

    .trending-hero p {
        font-size: 1.1rem;
        color: #ccc;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.5;
        font-weight: 400;
    }

    .trending-stats {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(249, 115, 22, 0.1);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        text-align: center;
    }

    .stat-item {
        padding: 1rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #f97316;
        display: block;
    }

    .stat-label {
        font-size: 1rem;
        color: #666;
        margin-top: 0.5rem;
    }

    .trending-filters {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .filter-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-btn {
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
        color: #333;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .filter-btn:hover {
        background: #212121;
        color: white;
        border-color: #212121;
        text-decoration: none;
    }

    .filter-btn.active {
        background: #212121;
        color: white;
        border-color: #212121;
    }

    /* Trending Article Cards */
    .trending-article-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 2rem;
        transition: all 0.5s ease;
        position: relative;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .trending-article-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .trending-article-card .article-link {
        display: block;
        text-decoration: none;
        color: inherit;
        padding: 0;
        background: transparent !important;
        border-radius: 0 !important;
        transition: none !important;
    }

    .trending-article-card .article-link:hover {
        transform: none !important;
        box-shadow: none !important;
        background: transparent !important;
    }

    .trending-rank {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        background: #f97316;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(249, 115, 22, 0.3);
    }

    .trending-rank.rank-1 {
        background: #212121;
        color: white;
        box-shadow: 0 2px 8px rgba(33, 33, 33, 0.3);
    }

    .trending-rank.rank-2 {
        background: #333;
        color: white;
        box-shadow: 0 2px 8px rgba(51, 51, 51, 0.3);
    }

    .trending-rank.rank-3 {
        background: #555;
        color: white;
        box-shadow: 0 2px 8px rgba(85, 85, 85, 0.3);
    }

    .trending-card-horizontal {
        display: flex;
        align-items: flex-start;
        gap: 2rem;
        padding: 2rem;
    }

    .trending-card-image {
        width: 250px;
        height: 180px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        transition: all 0.7s ease;
    }

    .trending-article-card:hover .trending-card-image {
        transform: scale(1.05);
        filter: brightness(1.05);
    }

    .trending-card-content {
        flex: 1;
        min-width: 0;
    }

    .trending-article-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #333;
        line-height: 1.3;
        transition: color 0.3s ease;
    }

    .trending-article-card:hover .trending-article-title {
        color: #212121;
    }

    .trending-article-excerpt {
        color: #666;
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .trending-article-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .trending-author-info {
        display: flex;
        align-items: center;
    }

    .trending-author-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 1rem;
        object-fit: cover;
    }

    .trending-author-details h4 {
        font-weight: 600;
        margin: 0;
        color: #333;
        font-size: 1rem;
    }

    .trending-author-details .author-title {
        color: #666;
        font-size: 0.9rem;
    }

    .trending-stats-info {
        display: flex;
        align-items: center;
        gap: 2rem;
        color: #666;
        font-size: 0.9rem;
    }

    .trending-views {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        color: #f97316;
    }

    .trending-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .load-more-section {
        text-align: center;
        margin: 3rem 0;
    }

    .load-more-btn {
        background: #212121;
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .load-more-btn:hover {
        background: #333;
        transform: translateY(-2px);
    }

    /* Use consistent category tags */
    .category-tag {
        color: #f97316;
        font-weight: 500;
        margin-bottom: 1rem;
        display: inline-block;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .trending-hero {
            padding: 3rem 0 2rem;
        }

        .trending-hero h1 {
            font-size: 2.5rem;
            flex-direction: column;
            gap: 0.5rem;
        }

        .trending-icon {
            font-size: 2.5rem;
        }

        .trending-hero p {
            font-size: 1rem;
        }

        .trending-card-horizontal {
            flex-direction: column;
            gap: 1rem;
            padding: 1.5rem;
        }

        .trending-card-image {
            width: 100%;
            height: 200px;
        }

        .trending-article-title {
            font-size: 1.3rem;
        }

        .trending-article-meta {
            justify-content: flex-start;
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .trending-stats-info {
            justify-content: flex-start;
        }

        .filter-buttons {
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .trending-rank {
            top: 1rem;
            right: 1rem;
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .trending-hero h1 {
            font-size: 2rem;
        }

        .trending-card-horizontal {
            padding: 1rem;
        }

        .trending-article-title {
            font-size: 1.2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Elegant Trending Hero Section -->
<div class="trending-hero">
    <div class="container">
        <div class="trending-hero-content">
            <h1>
                <span class="trending-icon">🔥</span>
                Trending Local Articles
            </h1>
            <p>Discover the most popular and widely-read local articles on BuzzWire, ranked by reader engagement and views</p>
        </div>
    </div>
</div>

<!-- Trending Stats -->
<div class="container">
    <div class="trending-stats">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">{{ $articles->count() }}</span>
                <div class="stat-label">Total Articles</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $articles->sum('views') }}</span>
                <div class="stat-label">Total Views</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $articles->where('views', '>', 100)->count() }}</span>
                <div class="stat-label">Popular Articles</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $articles->pluck('user')->unique('id')->count() }}</span>
                <div class="stat-label">Active Authors</div>
            </div>
        </div>
    </div>

    <!-- Trending Filters -->
    <div class="trending-filters">
        <div class="filter-buttons">
            <span style="font-weight: 600; color: #333; margin-right: 1rem;">Filter by:</span>
            <a href="{{ route('trending') }}" class="filter-btn {{ !request('period') && !request('category') ? 'active' : '' }}">
                All Time
            </a>
            <a href="{{ route('trending', ['period' => 'week']) }}" class="filter-btn {{ request('period') == 'week' ? 'active' : '' }}">
                This Week
            </a>
            <a href="{{ route('trending', ['period' => 'month']) }}" class="filter-btn {{ request('period') == 'month' ? 'active' : '' }}">
                This Month
            </a>
            @if($categories && $categories->count() > 0)
                @foreach($categories->take(5) as $category)
                <a href="{{ route('trending', ['category' => $category->id]) }}" class="filter-btn {{ request('category') == $category->id ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Trending Articles List - LOCAL ARTICLES ONLY -->
    @if($articles && $articles->count() > 0)
        @foreach($articles as $index => $article)
        <article class="trending-article-card">
            <a href="{{ route('articles.show', $article) }}" class="article-link">
                <div class="trending-rank rank-{{ min($index + 1, 10) }}">{{ $index + 1 }}</div>
                <div class="trending-card-horizontal">
                    @if($article->cover_image)
                        <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="trending-card-image">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="trending-card-image">
                    @endif
                    
                    <div class="trending-card-content">
                        <div class="category-tag">{{ $article->category->name ?? 'News' }}</div>
                        <h2 class="trending-article-title">{{ $article->title }}</h2>
                        <p class="trending-article-excerpt">{{ Str::limit(strip_tags($article->content), 200) }}</p>
                        
                        <div class="trending-article-meta">
                            <div class="trending-author-info">
                                @if($article->user->profile_image)
                                    <img src="{{ asset('storage/' . $article->user->profile_image) }}" alt="{{ $article->user->name }}" class="trending-author-avatar">
                                @else
                                    <img src="{{ asset('img/image1.png') }}" alt="{{ $article->user->name }}" class="trending-author-avatar">
                                @endif
                                <div class="trending-author-details">
                                    <h4>{{ $article->user->name }}</h4>
                                    <div class="author-title">{{ $article->user->bio ?? 'Author' }}</div>
                                </div>
                            </div>
                            
                            <div class="trending-stats-info">
                                <div class="trending-views">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                    </svg>
                                    {{ number_format($article->views ?? 0) }} views
                                </div>
                                <div class="trending-date">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.1 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                                    </svg>
                                    {{ $article->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </article>
        @endforeach

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $articles->links() }}
        </div>

    @else
        <!-- No Articles -->
        <div class="text-center py-5">
            <div class="trending-article-card" style="padding: 3rem; text-align: center;">
                <h3>No Trending Articles Found</h3>
                <p class="text-muted">There are no published local articles to display in the trending section yet.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    @endif

    <!-- Load More Section -->
    @if($articles->count() >= 10)
    <div class="load-more-section">
        <button class="load-more-btn" onclick="window.location.href='{{ route('articles.index') }}'">
            View All Articles
        </button>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Add any JavaScript for filtering or interactions here
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll for any anchor links
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
@endsection