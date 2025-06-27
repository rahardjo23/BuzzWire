@extends('layouts.app')

@section('title', 'BuzzWire News')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
    /* Clean Local Filter Section */
    .filter-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .filter-section .form-label {
        font-weight: 600;
        color: white;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .filter-section .form-select,
    .filter-section .form-control {
        border-radius: 8px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .filter-section .form-select:focus,
    .filter-section .form-control:focus {
        border-color: #ffd700;
        box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
        background: white;
    }

    .filter-section .btn-primary {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        border: none;
        color: #333;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 24px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }

    .filter-section .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        background: linear-gradient(45deg, #ffed4e, #ffd700);
    }

    .filter-stats {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
        backdrop-filter: blur(10px);
    }

    .filter-stats small {
        color: rgba(255, 255, 255, 0.9);
    }

    /* Article Styles - Keep existing */
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

    .side-article-content {
        min-width: 0;
        overflow: hidden;
    }

    .trending-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    @media (min-width: 1400px) {
        .trending-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (min-width: 1200px) and (max-width: 1399px) {
        .trending-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 768px) and (max-width: 1199px) {
        .trending-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 767px) {
        .trending-grid {
            grid-template-columns: 1fr;
        }
    }

    .trending-grid .article-link {
        padding: 0 !important;
        background: transparent !important;
        border-radius: 0 !important;
    }

    .trending-grid .article-link:hover {
        transform: none !important;
        box-shadow: none !important;
    }

    .trending-card {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .trending-grid .article-link:hover .trending-card {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .trending-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .trending-grid .article-link:hover .trending-image {
        transform: scale(1.05);
    }

    .trending-content {
        padding: 20px;
    }

    .trending-title {
        font-size: 17px;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 12px;
        transition: color 0.2s ease;
    }

    .trending-grid .article-link:hover .trending-title {
        color: #212121;
    }

    /* Hero spotlight and other existing styles */
    .hero-spotlight {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .hero-spotlight-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
    }

    .hero-spotlight-content {
        padding: 30px;
        border-radius: 0 0 12px 12px;
    }

    .hero-spotlight-title {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 15px;
        line-height: 1.3;
        color: #333;
    }

    .compact-list-item {
        background-color: #fff;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        padding: 16px;
    }

    .compact-list-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        background-color: #fafafa;
    }

    .compact-image {
        width: 100px;
        height: 100px;
        border-radius: 6px;
        object-fit: cover;
        margin-right: 15px;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .compact-list-item:hover .compact-image {
        transform: scale(1.02);
    }

    .compact-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.3;
        color: #333;
        transition: color 0.2s ease;
    }

    .compact-list-item:hover .compact-title {
        color: #212121;
    }

    .featured-spotlight {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        height: 500px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .article-link:hover .featured-spotlight {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .featured-spotlight-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .article-link:hover .featured-spotlight-image {
        transform: scale(1.02);
    }

    .featured-spotlight-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 30px;
    }

    .featured-spotlight-title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 15px;
        line-height: 1.3;
        color: white;
    }

    .featured-spotlight-overlay .article-summary {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 15px;
    }

    .featured-spotlight-overlay .author-info {
        margin-bottom: 0;
    }

    .featured-spotlight-overlay .author-name {
        color: white;
    }

    .featured-spotlight-overlay .author-title {
        color: rgba(255, 255, 255, 0.8);
    }

    /* Mobile responsiveness */
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
        
        .filter-section .row > div {
            margin-bottom: 15px;
        }
        
        .filter-section .btn-primary {
            width: 100%;
        }
        
        .hero-spotlight-title {
            font-size: 24px;
        }
        
        .hero-spotlight-content {
            padding: 20px;
        }
        
        .featured-spotlight-title {
            font-size: 20px;
        }
        
        .featured-spotlight-overlay {
            padding: 20px;
        }
        
        .compact-list-item {
            flex-direction: column;
            padding: 12px;
        }
        
        .compact-image {
            width: 100%;
            height: 120px;
            margin-right: 0;
            margin-bottom: 10px;
        }
        
        .compact-title {
            font-size: 16px;
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
                <div class="article-link">
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
                        <p class="mt-3 text-muted">
                            Selamat datang di BuzzWire News! Platform berita lokal terpercaya.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Side Articles - LOCAL ONLY -->
        <div class="col-lg-6">
            @if($latestArticles->count() > 0)
                @foreach($latestArticles->take(4) as $article)
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
                @for($i = 1; $i <= 4; $i++)
                <div class="side-article-link">
                    <div class="side-article-content">
                        <h2>No Articles Available</h2>
                        <div class="article-summary">Start writing your first article to see it appear here...</div>
                        <div class="category-tag">News</div>
                        <span class="read-more-indicator">→</span>
                    </div>
                    <img src="{{ asset('img/image1.png') }}" alt="No Content" class="side-article-image">
                </div>
                @endfor
            @endif
        </div>
    </div>
</div>

<!-- Trending Local Articles Section -->
<div class="container article-section-last">
    <div class="section-header">
        <h2 class="section-title">🏠 Trending Berita Lokal</h2>
        <a href="{{ route('trending') }}" class="show-more">View All <span class="show-more-icon">→</span></a>
    </div>
    
    <div class="trending-grid">
        @if($latestArticles->count() > 0)
            @foreach($latestArticles->take(8) as $article)
                <a href="{{ route('articles.show', $article) }}" class="article-link trending-link">
                    <div class="trending-card">
                        @if($article->cover_image)
                            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="trending-image">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="trending-image">
                        @endif
                        <div class="trending-content">
                            <div class="category-tag">{{ $article->category->name ?? 'News' }}</div>
                            <h3 class="trending-title">{{ $article->title }}</h3>
                            <div class="article-summary">{{ Str::limit(strip_tags($article->content), 120) }}</div>
                            <div class="author-small">
                                @if($article->user->profile_image)
                                    <img src="{{ asset('storage/' . $article->user->profile_image) }}" alt="{{ $article->user->name }}" class="author-avatar-small">
                                @else
                                    <img src="{{ asset('img/image1.png') }}" alt="{{ $article->user->name }}" class="author-avatar-small">
                                @endif
                                <span class="author-name-small">{{ $article->user->name }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            @for($i = 1; $i <= 4; $i++)
            <div class="article-link trending-link">
                <div class="trending-card">
                    <img src="{{ asset('img/image1.png') }}" alt="No Content" class="trending-image">
                    <div class="trending-content">
                        <div class="category-tag">News</div>
                        <h3 class="trending-title">No Articles Available</h3>
                        <div class="article-summary">Start writing your first article to see it appear here...</div>
                        <div class="author-small">
                            <img src="{{ asset('img/image1.png') }}" alt="BuzzWire Team" class="author-avatar-small">
                            <span class="author-name-small">BuzzWire Team</span>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        @endif
    </div>
</div>

<!-- Featured Spotlight Section -->
<div class="container article-section-last">
    <div class="section-header">
        <h2 class="section-title">⭐ Editor's Pick</h2>
        <a href="#" class="show-more">Read More <span class="show-more-icon">→</span></a>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            @if($featuredArticle)
                <div class="featured-spotlight">
                    <a href="{{ route('articles.show', $featuredArticle) }}" class="article-link" style="padding: 0; background: transparent; border-radius: 12px; overflow: hidden; display: block; height: 100%;">
                        @if($featuredArticle->cover_image)
                            <img src="{{ asset('storage/' . $featuredArticle->cover_image) }}" alt="{{ $featuredArticle->title }}" class="featured-spotlight-image">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $featuredArticle->title }}" class="featured-spotlight-image">
                        @endif
                        <div class="featured-spotlight-overlay">
                            <div class="category-tag1">{{ $featuredArticle->category->name ?? 'News' }}</div>
                            <h2 class="featured-spotlight-title">{{ $featuredArticle->title }}</h2>
                            <div class="article-summary">{{ Str::limit(strip_tags($featuredArticle->content), 150) }}</div>
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
                        </div>
                    </a>
                </div>
            @else
                <div class="featured-spotlight">
                    <div class="article-link" style="padding: 0; background: transparent; border-radius: 12px; overflow: hidden; display: block; height: 100%;">
                        <img src="{{ asset('img/image1.png') }}" alt="Welcome" class="featured-spotlight-image">
                        <div class="featured-spotlight-overlay">
                            <div class="category-tag1">News</div>
                            <h2 class="featured-spotlight-title">Welcome to BuzzWire News</h2>
                            <div class="article-summary">Platform berita lokal terpercaya dengan konten berkualitas.</div>
                            <div class="author-info">
                                <img src="{{ asset('img/image1.png') }}" alt="BuzzWire" class="author-avatar">
                                <div>
                                    <h4 class="author-name">BuzzWire Team</h4>
                                    <div class="author-title">Editorial</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            @if($latestArticles && $latestArticles->count() > 0)
                @foreach($latestArticles->take(3) as $article)
                <a href="{{ route('articles.show', $article) }}" class="side-article-link compact-list-item">
                    @if($article->cover_image)
                        <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="compact-image">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="compact-image">
                    @endif
                    <div class="side-article-content">
                        <h3 class="compact-title">{{ $article->title }}</h3>
                        <div class="article-summary">{{ Str::limit(strip_tags($article->content), 60) }}</div>
                        <div class="category-tag">{{ $article->category->name ?? 'News' }}</div>
                        <span class="read-more-indicator">→</span>
                    </div>
                </a>
                @endforeach
            @else
                @for($i = 1; $i <= 3; $i++)
                <div class="side-article-link compact-list-item">
                    <img src="{{ asset('img/image1.png') }}" alt="No Content" class="compact-image">
                    <div class="side-article-content">
                        <h3 class="compact-title">No Articles Available</h3>
                        <div class="article-summary">Start writing your first article to see it appear here...</div>
                        <div class="category-tag">News</div>
                        <span class="read-more-indicator">→</span>
                    </div>
                </div>
                @endfor
            @endif
        </div>
    </div>
</div>

<!-- Latest Updates Section -->
<div class="container article-section-last">
    <div class="section-header">
        <h2 class="section-title">📰 Latest Local Updates</h2>
        <a href="#" class="show-more">See All <span class="show-more-icon">→</span></a>
    </div>
    
    <div class="row">
        @if($latestArticles->count() > 0)
            @foreach($latestArticles->take(6) as $article)
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('articles.show', $article) }}" class="article-link">
                    <div class="latest-article">
                        @if($article->cover_image)
                            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="latest-image">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="latest-image">
                        @endif
                        <div class="author-small">
                            @if($article->user->profile_image)
                                <img src="{{ asset('storage/' . $article->user->profile_image) }}" alt="{{ $article->user->name }}" class="author-avatar-small">
                            @else
                                <img src="{{ asset('img/image1.png') }}" alt="{{ $article->user->name }}" class="author-avatar-small">
                            @endif
                            <span class="author-name-small">{{ $article->user->name }}</span>
                        </div>
                        <h3>{{ $article->title }}</h3>
                        <div class="category-tag">{{ $article->category->name ?? 'News' }}</div>
                        <div class="read-more-link">
                            <span class="read-more">Read Article</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        @else
            @for($i = 1; $i <= 6; $i++)
            <div class="col-lg-4 col-md-6">
                <div class="article-link">
                    <div class="latest-article">
                        <img src="{{ asset('img/image1.png') }}" alt="No Content" class="latest-image">
                        <div class="author-small">
                            <img src="{{ asset('img/image1.png') }}" alt="BuzzWire Team" class="author-avatar-small">
                            <span class="author-name-small">BuzzWire Team</span>
                        </div>
                        <h3>No Articles Available</h3>
                        <div class="category-tag">News</div>
                        <div class="read-more-link">
                            <span class="read-more">Read Article</span>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        @endif
    </div>
</div>

<!-- Hero Spotlight Section -->
<div class="container article-section-last">
    <div class="section-header">
        <h2 class="section-title">🎯 Must Read Local</h2>
        <a href="#" class="show-more">Explore <span class="show-more-icon">→</span></a>
    </div>
    
    @if($featuredArticle)
        <a href="{{ route('articles.show', $featuredArticle) }}" class="article-link">
            <div class="hero-spotlight">
                @if($featuredArticle->cover_image)
                    <img src="{{ asset('storage/' . $featuredArticle->cover_image) }}" alt="{{ $featuredArticle->title }}" class="hero-spotlight-image">
                @else
                    <img src="{{ asset('img/image1.png') }}" alt="{{ $featuredArticle->title }}" class="hero-spotlight-image">
                @endif
                <div class="hero-spotlight-content">
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
                    <h2 class="hero-spotlight-title">{{ $featuredArticle->title }}</h2>
                    <div class="category-tag1">{{ $featuredArticle->category->name ?? 'News' }}</div>
                    <div class="article-summary">{{ Str::limit(strip_tags($featuredArticle->content), 180) }}</div>
                </div>
            </div>
        </a>
    @else
        <div class="article-link">
            <div class="hero-spotlight">
                <img src="{{ asset('img/image1.png') }}" alt="Welcome" class="hero-spotlight-image">
                <div class="hero-spotlight-content">
                    <div class="author-info">
                        <img src="{{ asset('img/image1.png') }}" alt="BuzzWire" class="author-avatar">
                        <div>
                            <h4 class="author-name">BuzzWire Team</h4>
                            <div class="author-title">Editorial</div>
                        </div>
                    </div>
                    <h2 class="hero-spotlight-title">Welcome to BuzzWire News</h2>
                    <div class="category-tag1">News</div>
                    <div class="article-summary">Platform berita lokal terpercaya dengan konten berkualitas tinggi.</div>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit filter form when category changes
    document.getElementById('category').addEventListener('change', function() {
        this.closest('form').submit();
    });
});
</script>
@endsection