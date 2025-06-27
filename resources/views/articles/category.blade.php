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
        --shadow-light: 0 4px 16px rgba(0, 0, 0, 0.08);
        --shadow-medium: 0 8px 32px rgba(0, 0, 0, 0.16);
        --shadow-heavy: 0 16px 48px rgba(0, 0, 0, 0.2);
    }

    body {
        background-color: var(--light-gray);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        color: var(--primary-black);
        margin: 0;
        padding: 0;
    }

    /* Override content-container padding for this page */
    .content-container {
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    .category-header {
        background: linear-gradient(135deg, var(--primary-black) 0%, #2d2d2d 100%);
        color: var(--white);
        padding: 4rem 0 3rem;
        margin-top: 0;
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

    /* HERO ARTICLE SECTION */
    .hero-article {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-light);
        margin-bottom: 4rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.06);
        position: relative;
    }

    .hero-article:hover {
        box-shadow: var(--shadow-heavy);
        transform: translateY(-8px);
    }

    .hero-article-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .hero-article-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .hero-article:hover .hero-article-image {
        transform: scale(1.03);
    }

    .hero-article-content {
        padding: 3rem;
        position: relative;
    }

    .hero-badge {
        position: absolute;
        top: -15px;
        left: 3rem;
        background: var(--orange-accent);
        color: var(--white);
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.7rem 1.5rem;
        border-radius: 25px;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
    }

    .hero-article-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-black);
        line-height: 1.2;
        margin-bottom: 1.5rem;
        letter-spacing: -0.03em;
    }

    .hero-article-excerpt {
        color: var(--text-gray);
        font-size: 1.2rem;
        line-height: 1.7;
        margin-bottom: 2.5rem;
        font-weight: 400;
    }

    .hero-article-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1.5rem;
        border-top: 2px solid var(--border-gray);
    }

    .hero-author-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .hero-author-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--light-gray);
    }

    .hero-author-details h4 {
        font-weight: 600;
        color: var(--primary-black);
        margin: 0;
    }

    .hero-author-details span {
        color: var(--text-gray);
        font-size: 0.9rem;
    }

    .hero-stats {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        color: var(--text-gray);
        font-size: 0.9rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* FEATURED GRID SECTION */
    .featured-section {
        margin-bottom: 4rem;
    }

    .section-header {
        background: linear-gradient(135deg, var(--white) 0%, #fafafa 100%);
        padding: 3rem 2rem;
        border-radius: 16px;
        margin-bottom: 3rem;
        text-align: center;
        border: 1px solid var(--border-gray);
        box-shadow: var(--shadow-light);
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

    .featured-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: repeat(2, 300px);
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .featured-large {
        grid-row: span 2;
    }

    .featured-card {
        background: var(--white);
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        transition: all 0.4s ease;
        text-decoration: none;
        color: inherit;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-gray);
    }

    .featured-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-medium);
        text-decoration: none;
        color: inherit;
    }

    .featured-card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .featured-card:hover .featured-card-image {
        transform: scale(1.05);
    }

    .featured-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.9));
        padding: 2rem;
        color: var(--white);
    }

    .featured-card-category {
        background: var(--orange-accent);
        color: var(--white);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .featured-card-title {
        font-size: 1.3rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 0.8rem;
        color: var(--white);
    }

    .featured-large .featured-card-title {
        font-size: 1.8rem;
    }

    .featured-card-meta {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
    }

    /* MAGAZINE STYLE SECTION */
    .magazine-section {
        margin-bottom: 4rem;
    }

    .magazine-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .magazine-card {
        background: var(--white);
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        transition: all 0.4s ease;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-gray);
        display: flex;
        min-height: 200px;
    }

    .magazine-card:hover {
        transform: translateX(8px);
        box-shadow: var(--shadow-medium);
        text-decoration: none;
        color: inherit;
    }

    .magazine-card-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        flex-shrink: 0;
        transition: transform 0.6s ease;
    }

    .magazine-card:hover .magazine-card-image {
        transform: scale(1.05);
    }

    .magazine-card-content {
        padding: 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .magazine-card-category {
        background: var(--orange-accent);
        color: var(--white);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        display: inline-block;
        letter-spacing: 0.5px;
        align-self: flex-start;
    }

    .magazine-card-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary-black);
        line-height: 1.3;
        margin-bottom: 1rem;
    }

    .magazine-card-excerpt {
        color: var(--text-gray);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
    }

    .magazine-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid var(--border-gray);
    }

    /* LIST STYLE SECTION */
    .list-section {
        margin-bottom: 4rem;
    }

    .articles-list {
        background: var(--white);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-gray);
    }

    .list-article {
        display: flex;
        align-items: center;
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--border-gray);
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        position: relative;
    }

    .list-article:last-child {
        border-bottom: none;
    }

    .list-article:hover {
        background: var(--hover-gray);
        transform: translateX(8px);
        text-decoration: none;
        color: inherit;
        margin: 0 -2rem;
        padding-left: 2rem;
        padding-right: 2rem;
        border-radius: 8px;
    }

    .list-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--orange-accent);
        width: 60px;
        text-align: center;
        margin-right: 1.5rem;
        opacity: 0.7;
    }

    .list-article-image {
        width: 100px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 1.5rem;
        flex-shrink: 0;
    }

    .list-article-content {
        flex: 1;
    }

    .list-article-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-black);
        line-height: 1.3;
        margin-bottom: 0.5rem;
    }

    .list-article-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: var(--text-gray);
        font-size: 0.85rem;
    }

    /* COMPACT GRID SECTION */
    .compact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .compact-card {
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-gray);
    }

    .compact-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-medium);
        text-decoration: none;
        color: inherit;
    }

    .compact-card-image {
        width: 100%;
        height: 160px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .compact-card:hover .compact-card-image {
        transform: scale(1.05);
    }

    .compact-card-content {
        padding: 1.5rem;
    }

    .compact-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-black);
        line-height: 1.3;
        margin-bottom: 0.8rem;
    }

    .compact-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text-gray);
        font-size: 0.8rem;
    }

    /* PAGINATION AND UTILITIES */
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

    /* RESPONSIVE DESIGN */
    @media (max-width: 1200px) {
        .featured-grid {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 300px 300px 300px;
        }
        
        .featured-large {
            grid-row: span 1;
            grid-column: span 2;
        }
    }

    @media (max-width: 768px) {
        .category-title {
            font-size: 2.5rem;
        }

        .category-header {
            padding: 3rem 0 2rem;
        }

        .hero-article-content {
            padding: 2rem;
        }

        .hero-article-title {
            font-size: 2rem;
        }

        .featured-grid {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(4, 250px);
        }

        .featured-large {
            grid-row: span 1;
            grid-column: span 1;
        }

        .magazine-grid {
            grid-template-columns: 1fr;
        }

        .magazine-card {
            flex-direction: column;
            min-height: auto;
        }

        .magazine-card-image {
            width: 100%;
            height: 200px;
        }

        .compact-grid {
            grid-template-columns: 1fr;
        }

        .list-article {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .list-number {
            align-self: flex-start;
        }

        .list-article-image {
            width: 100%;
            height: 150px;
            margin-right: 0;
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

        .hero-article-content {
            padding: 1.5rem;
        }

        .hero-article-title {
            font-size: 1.8rem;
        }

        .section-header {
            padding: 1.5rem 1rem;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .articles-list {
            padding: 1rem;
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

<!-- Hero Article Section -->
<div class="container">
    @php $heroArticle = $articles->first(); @endphp
    <div class="hero-article">
        <a href="{{ route('articles.show', $heroArticle) }}" class="hero-article-link">
            @if($heroArticle->cover_image)
                <img src="{{ asset('storage/' . $heroArticle->cover_image) }}" alt="{{ $heroArticle->title }}" class="hero-article-image">
            @else
                <img src="{{ asset('img/image1.png') }}" alt="{{ $heroArticle->title }}" class="hero-article-image">
            @endif
            <div class="hero-article-content">
                <span class="hero-badge">Featured Story</span>
                <h2 class="hero-article-title">{{ $heroArticle->title }}</h2>
                <p class="hero-article-excerpt">
                    {{ Str::limit(strip_tags($heroArticle->content), 250) }}
                </p>
                <div class="hero-article-meta">
                    <div class="hero-author-info">
                        @if($heroArticle->user->profile_image)
                            <img src="{{ asset('storage/' . $heroArticle->user->profile_image) }}" alt="{{ $heroArticle->user->name }}" class="hero-author-avatar">
                        @else
                            <img src="{{ asset('img/image1.png') }}" alt="{{ $heroArticle->user->name }}" class="hero-author-avatar">
                        @endif
                        <div class="hero-author-details">
                            <h4>{{ $heroArticle->user->name }}</h4>
                            <span>{{ $heroArticle->user->bio ?? 'Contributor' }}</span>
                        </div>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <i class="fas fa-eye"></i>
                            <span>{{ number_format($heroArticle->views ?? 0) }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ $heroArticle->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

@if($articles->count() > 1)
<!-- Featured Grid Section -->
<div class="container featured-section">
    <div class="section-header">
        <h2 class="section-title">Top Stories</h2>
        <p class="section-subtitle">Don't miss these trending {{ strtolower($category->name) }} articles</p>
    </div>
    
    <div class="featured-grid">
        @foreach($articles->slice(1, 4) as $index => $article)
        <a href="{{ route('articles.show', $article) }}" class="featured-card {{ $index === 0 ? 'featured-large' : '' }}">
            @if($article->cover_image)
                <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="featured-card-image">
            @else
                <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="featured-card-image">
            @endif
            <div class="featured-card-overlay">
                <span class="featured-card-category">{{ $category->name }}</span>
                <h3 class="featured-card-title">{{ Str::limit($article->title, $index === 0 ? 80 : 60) }}</h3>
                <div class="featured-card-meta">
                    <span>{{ $article->user->name }}</span>
                    <span>{{ $article->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

@if($articles->count() > 5)
<!-- Magazine Style Section -->
<div class="container magazine-section">
    <div class="section-header">
        <h2 class="section-title">In-Depth Coverage</h2>
        <p class="section-subtitle">Detailed analysis and comprehensive reporting</p>
    </div>
    
    <div class="magazine-grid">
        @foreach($articles->slice(5, 4) as $article)
        <a href="{{ route('articles.show', $article) }}" class="magazine-card">
            @if($article->cover_image)
                <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="magazine-card-image">
            @else
                <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="magazine-card-image">
            @endif
            <div class="magazine-card-content">
                <div>
                    <span class="magazine-card-category">{{ $category->name }}</span>
                    <h3 class="magazine-card-title">{{ $article->title }}</h3>
                    <p class="magazine-card-excerpt">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                </div>
                <div class="magazine-card-meta">
                    <span>{{ $article->user->name }}</span>
                    <span>{{ $article->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

@if($articles->count() > 9)
<!-- List Style Section -->
<div class="container list-section">
    <div class="section-header">
        <h2 class="section-title">Popular This Week</h2>
        <p class="section-subtitle">Most read {{ strtolower($category->name) }} stories</p>
    </div>
    
    <div class="articles-list">
        @foreach($articles->slice(9, 5) as $index => $article)
        <a href="{{ route('articles.show', $article) }}" class="list-article">
            <div class="list-number">{{ $index + 1 }}</div>
            @if($article->cover_image)
                <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="list-article-image">
            @else
                <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="list-article-image">
            @endif
            <div class="list-article-content">
                <h3 class="list-article-title">{{ $article->title }}</h3>
                <div class="list-article-meta">
                    <span>{{ $article->user->name }}</span>
                    <span>{{ $article->created_at->diffForHumans() }}</span>
                    <span>{{ number_format($article->views ?? 0) }} views</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

@if($articles->count() > 14)
<!-- Compact Grid Section -->
<div class="container">
    <div class="section-header">
        <h2 class="section-title">More {{ $category->name }} Stories</h2>
        <p class="section-subtitle">Catch up on additional {{ strtolower($category->name) }} coverage</p>
    </div>
    
    <div class="compact-grid">
        @foreach($articles->slice(14) as $article)
        <a href="{{ route('articles.show', $article) }}" class="compact-card">
            @if($article->cover_image)
                <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="compact-card-image">
            @else
                <img src="{{ asset('img/image1.png') }}" alt="{{ $article->title }}" class="compact-card-image">
            @endif
            <div class="compact-card-content">
                <h3 class="compact-card-title">{{ Str::limit($article->title, 80) }}</h3>
                <div class="compact-card-meta">
                    <span>{{ $article->user->name }}</span>
                    <span>{{ $article->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

<!-- Pagination -->
@if($articles->hasPages())
<div class="container">
    <div class="pagination-wrapper">
        {{ $articles->links() }}
    </div>
</div>
@endif

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

<!-- Newsletter Section (Optional) -->
@if($articles->count() > 5)
<div class="container">
    <div class="section-header" style="background: linear-gradient(135deg, var(--primary-black) 0%, #2d2d2d 100%); color: white; margin-top: 4rem;">
        <h2 class="section-title" style="color: white;">Stay Updated</h2>
        <p class="section-subtitle" style="color: rgba(255,255,255,0.8);">Get the latest {{ strtolower($category->name) }} news delivered to your inbox</p>
        <div style="margin-top: 2rem;">
            <form class="newsletter-form" style="display: flex; gap: 1rem; max-width: 400px; margin: 0 auto;">
                <input type="email" placeholder="Enter your email" style="flex: 1; padding: 0.75rem 1rem; border: 1px solid rgba(255,255,255,0.3); border-radius: 8px; background: rgba(255,255,255,0.1); color: white; font-size: 0.95rem;">
                <button type="submit" class="btn" style="background: var(--orange-accent); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">Subscribe</button>
            </form>
            <p style="font-size: 0.8rem; color: rgba(255,255,255,0.6); margin-top: 1rem;">No spam, unsubscribe anytime</p>
        </div>
    </div>
</div>
@endif

<!-- Related Categories -->
@if($articles->count() > 0)
<div class="container" style="margin-top: 4rem;">
    <div class="section-header">
        <h2 class="section-title">Explore More Categories</h2>
        <p class="section-subtitle">Discover other news topics you might be interested in</p>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 3rem;">
        @php
            $relatedCategories = App\Models\Category::where('id', '!=', $category->id)->take(6)->get();
        @endphp
        @foreach($relatedCategories as $relatedCategory)
        <a href="{{ route('category.show', $relatedCategory->id) }}" style="background: var(--white); border: 1px solid var(--border-gray); border-radius: 12px; padding: 1.5rem; text-decoration: none; color: inherit; transition: all 0.3s ease; text-align: center; box-shadow: var(--shadow-light);" 
           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-medium)'" 
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-light)'">
            <h4 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--primary-black);">{{ $relatedCategory->name }}</h4>
            <p style="color: var(--text-gray); font-size: 0.85rem; margin: 0;">
                @php
                    $articleCount = App\Models\Article::where('category_id', $relatedCategory->id)->where('is_published', 1)->count();
                @endphp
                {{ $articleCount }} {{ Str::plural('article', $articleCount) }}
            </p>
        </a>
        @endforeach
    </div>
</div>
@endif

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Newsletter form handler
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                // You can add actual newsletter signup logic here
                alert('Thank you for subscribing to {{ $category->name }} updates!');
                this.querySelector('input[type="email"]').value = '';
            }
        });
    }

    // Smooth scroll for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Lazy loading for images (if you want to add this feature)
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => {
        imageObserver.observe(img);
    });

    // Add reading time estimation (optional feature)
    const articles = document.querySelectorAll('[data-content]');
    articles.forEach(article => {
        const content = article.dataset.content;
        const wordsPerMinute = 200;
        const wordCount = content.split(/\s+/).length;
        const readingTime = Math.ceil(wordCount / wordsPerMinute);
        
        const timeElement = article.querySelector('.reading-time');
        if (timeElement) {
            timeElement.textContent = `${readingTime} min read`;
        }
    });
});
</script>
@endsection