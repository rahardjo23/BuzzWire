@extends('layouts.app')

@section('title', 'Search Results - ' . $query)

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

    /* Search Header - Matching Category Style */
    .search-header {
        background: linear-gradient(135deg, var(--primary-black) 0%, #2d2d2d 100%);
        color: var(--white);
        padding: 4rem 0 3rem;
        margin-top: 0;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .search-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        pointer-events: none;
    }

    .search-header-content {
        position: relative;
        z-index: 2;
    }

    .search-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
        line-height: 1.1;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .search-meta {
        color: rgba(255, 255, 255, 0.85);
        font-size: 1.2rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 600px;
        font-weight: 300;
    }

    .search-query {
        color: var(--orange-accent);
        font-weight: 600;
    }

    .search-stats {
        display: flex;
        align-items: center;
        gap: 2.5rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 500;
    }

    .stat-item i {
        font-size: 1rem;
        opacity: 0.8;
    }

    /* Filter Section - Elegant Style */
    .search-filters {
        background: linear-gradient(135deg, var(--white) 0%, #fafafa 100%);
        padding: 2.5rem;
        border-radius: 16px;
        margin-bottom: 3rem;
        text-align: center;
        border: 1px solid var(--border-gray);
        box-shadow: var(--shadow-light);
    }

    .filter-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-black);
        margin-bottom: 2rem;
        letter-spacing: -0.02em;
    }

    .filter-form {
        display: flex;
        justify-content: center;
        align-items: end;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        min-width: 200px;
        text-align: left;
    }

    .filter-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-gray);
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .filter-select {
        background: var(--white);
        border: 1px solid var(--border-gray);
        border-radius: 8px;
        padding: 0.875rem 1rem;
        font-size: 0.95rem;
        color: var(--primary-black);
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-black);
        box-shadow: 0 0 0 3px rgba(26, 26, 26, 0.1);
    }

    .filter-apply-btn {
        background: var(--primary-black);
        color: var(--white);
        border: none;
        border-radius: 8px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        height: fit-content;
    }

    .filter-apply-btn:hover {
        background: #000;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Results Info */
    .results-info {
        background: linear-gradient(135deg, var(--white) 0%, #fafafa 100%);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        text-align: center;
        border: 1px solid var(--border-gray);
        box-shadow: var(--shadow-light);
    }

    .results-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-black);
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
    }

    .results-subtitle {
        color: var(--text-gray);
        font-size: 1rem;
        font-weight: 400;
    }

    /* Search Results Grid - Matching Category Cards */
    .search-results-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .search-result-card {
        background: var(--white);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-light);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        color: inherit;
        border: 1px solid var(--border-gray);
    }

    .search-result-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-medium);
        text-decoration: none;
        color: inherit;
        border-color: rgba(0, 0, 0, 0.1);
    }

    .search-result-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .search-result-card:hover .search-result-image {
        transform: scale(1.05);
    }

    .search-result-content {
        padding: 2rem;
    }

    .search-result-category {
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

    .search-result-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.3;
        color: var(--primary-black);
        letter-spacing: -0.01em;
    }

    .search-result-excerpt {
        color: var(--text-gray);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .search-result-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--border-gray);
        font-size: 0.85rem;
        color: var(--text-gray);
    }

    .search-result-author {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .search-result-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .search-highlight {
        background: linear-gradient(120deg, rgba(249, 115, 22, 0.2) 0%, rgba(249, 115, 22, 0.3) 100%);
        padding: 0.125rem 0.25rem;
        border-radius: 4px;
        font-weight: 600;
        color: var(--primary-black);
    }

    /* No Results - Matching Category Style */
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--white);
        border-radius: 16px;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-gray);
    }

    .no-results-icon {
        font-size: 4rem;
        color: var(--text-gray);
        margin-bottom: 2rem;
        opacity: 0.5;
    }

    .no-results-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-black);
        margin-bottom: 1rem;
    }

    .no-results-text {
        color: var(--text-gray);
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .btn-primary {
        background: var(--primary-black);
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        color: var(--white);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .btn-primary:hover {
        background: #000;
        color: var(--white);
        text-decoration: none;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    /* Loading */
    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top: 2px solid var(--white);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 0.5rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .search-title {
            font-size: 2.5rem;
        }

        .search-header {
            padding: 3rem 0 2rem;
        }

        .search-filters {
            padding: 2rem;
        }

        .filter-form {
            flex-direction: column;
            align-items: stretch;
            gap: 1.5rem;
        }

        .filter-group {
            min-width: auto;
        }

        .filter-apply-btn {
            width: 100%;
        }

        .search-results-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .search-result-content {
            padding: 1.5rem;
        }

        .search-result-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .search-stats {
            flex-wrap: wrap;
            gap: 1rem;
        }

        .results-info {
            padding: 1.5rem;
        }

        .filter-title {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 576px) {
        .search-header {
            padding: 2rem 0 1.5rem;
        }

        .search-title {
            font-size: 2rem;
        }

        .search-filters {
            padding: 1.5rem;
        }

        .search-result-content {
            padding: 1.25rem;
        }

        .no-results {
            padding: 3rem 1.5rem;
        }

        .results-info {
            padding: 1.25rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Search Header - Matching Category Style -->
<div class="search-header">
    <div class="container">
        <div class="search-header-content">
            <h1 class="search-title">Search Results</h1>
            <p class="search-meta">
                @if($articles->total() > 0)
                    Found <strong>{{ number_format($articles->total()) }}</strong> 
                    {{ Str::plural('result', $articles->total()) }} for 
                    "<span class="search-query">{{ $query }}</span>"
                @else
                    No results found for "<span class="search-query">{{ $query }}</span>"
                @endif
            </p>
            <div class="search-stats">
                <div class="stat-item">
                    <i class="fas fa-search"></i>
                    <span>{{ $articles->total() }} Results</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-clock"></i>
                    <span>Search completed</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-tags"></i>
                    <span>{{ $categories->count() }} Categories</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Search Filters - Elegant Section Header Style -->
    <div class="search-filters">
        <h2 class="filter-title">Refine Your Search</h2>
        <form method="GET" action="{{ route('articles.search') }}" class="filter-form" id="searchFilterForm">
            <input type="hidden" name="q" value="{{ $query }}">
            
            <div class="filter-group">
                <label for="category" class="filter-label">Category</label>
                <select name="category" id="category" class="filter-select">
                    <option value="all" {{ request('category') == 'all' || !request('category') ? 'selected' : '' }}>
                        All Categories
                    </option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-group">
                <label for="sort" class="filter-label">Sort By</label>
                <select name="sort" id="sort" class="filter-select">
                    <option value="relevance" {{ request('sort') == 'relevance' || !request('sort') ? 'selected' : '' }}>
                        Most Relevant
                    </option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                        Newest First
                    </option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                        Oldest First
                    </option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>
                        Most Popular
                    </option>
                </select>
            </div>
            
            <button type="submit" class="filter-apply-btn">
                Apply Filters
            </button>
        </form>
    </div>

    @if($articles->count() > 0)
        <!-- Results Info - Section Header Style -->
        <div class="results-info">
            <h2 class="results-title">Search Results</h2>
            <p class="results-subtitle">
                Showing {{ $articles->firstItem() }}–{{ $articles->lastItem() }} of {{ $articles->total() }} results
            </p>
        </div>
        
        <!-- Search Results Grid - Matching Article Cards -->
        <div class="search-results-grid">
            @foreach($articles as $article)
                <a href="{{ route('articles.show', $article) }}" class="search-result-card">
                    @if($article->cover_image)
                        <img src="{{ asset('storage/' . $article->cover_image) }}" 
                             alt="{{ $article->title }}" 
                             class="search-result-image">
                    @else
                        <img src="{{ asset('img/image1.png') }}" 
                             alt="{{ $article->title }}" 
                             class="search-result-image">
                    @endif
                    
                    <div class="search-result-content">
                        <span class="search-result-category">
                            {{ $article->category->name ?? 'Uncategorized' }}
                        </span>
                        
                        <h3 class="search-result-title">
                            {!! highlightSearchTerm($article->title, $query) !!}
                        </h3>
                        
                        <p class="search-result-excerpt">
                            {!! highlightSearchTerm(Str::limit(strip_tags($article->content), 150), $query) !!}
                        </p>
                        
                        <div class="search-result-meta">
                            <div class="search-result-author">
                                <i class="fas fa-user"></i>
                                <span>{{ $article->user->name }}</span>
                            </div>
                            <div class="search-result-date">
                                <i class="fas fa-calendar"></i>
                                <span>{{ $article->publish_time ? $article->publish_time->format('M j, Y') : $article->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $articles->appends(request()->query())->links() }}
        </div>
    @else
        <!-- No Results - Matching Category Style -->
        <div class="no-results">
            <div class="no-results-icon">
                <i class="fas fa-search"></i>
            </div>
            <h2 class="no-results-title">No Articles Found</h2>
            <p class="no-results-text">
                We couldn't find any articles matching "<strong>{{ $query }}</strong>". 
                Try different keywords or search terms.
            </p>
            
            <a href="{{ route('home') }}" class="btn-primary">
                <i class="fas fa-home"></i>
                Back to Home
            </a>
        </div>
    @endif
</div>

@php
function highlightSearchTerm($text, $term) {
    if (empty($term)) return $text;
    
    $highlighted = preg_replace('/(' . preg_quote($term, '/') . ')/i', '<span class="search-highlight">$1</span>', $text);
    return $highlighted;
}
@endphp
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('searchFilterForm');
    const submitBtn = form.querySelector('.filter-apply-btn');
    const categorySelect = document.getElementById('category');
    const sortSelect = document.getElementById('sort');
    
    function showLoadingState() {
        const originalText = submitBtn.textContent;
        submitBtn.innerHTML = '<div class="loading-spinner"></div>Filtering...';
        submitBtn.disabled = true;
        
        setTimeout(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 3000);
    }
    
    function submitSearchForm() {
        showLoadingState();
        form.submit();
    }
    
    if (categorySelect) {
        categorySelect.addEventListener('change', submitSearchForm);
    }
    
    if (sortSelect) {
        sortSelect.addEventListener('change', submitSearchForm);
    }
    
    form.addEventListener('submit', function(e) {
        showLoadingState();
    });

    // Smooth scroll for results
    const resultCards = document.querySelectorAll('.search-result-card');
    resultCards.forEach(card => {
        card.addEventListener('click', function(e) {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
});
</script>
@endsection