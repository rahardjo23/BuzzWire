@extends('layouts.app')

@section('title', 'Search Results - ' . $query)

@section('styles')
<style>
    .search-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-bottom: 1px solid #dee2e6;
    }

    .search-title {
        font-size: 2rem;
        font-weight: 700;
        color: #212121;
        margin-bottom: 0.5rem;
    }

    .search-meta {
        color: #6c757d;
        font-size: 1.1rem;
    }

    .search-filters {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    .filter-title {
        font-weight: 600;
        margin-bottom: 1rem;
        color: #333;
    }

    .search-results-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .search-result-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .search-result-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        text-decoration: none;
        color: inherit;
    }

    .search-result-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .search-result-card:hover .search-result-image {
        transform: scale(1.05);
    }

    .search-result-content {
        padding: 1.5rem;
    }

    .search-result-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        line-height: 1.3;
        color: #212121;
    }

    .search-result-excerpt {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .search-result-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
        color: #6c757d;
    }

    .search-result-category {
        background-color: rgba(249, 115, 22, 0.1);
        color: #f97316;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-weight: 500;
    }

    .search-result-date {
        display: flex;
        align-items: center;
    }

    .search-highlight {
        background-color: rgba(249, 115, 22, 0.2);
        padding: 0.125rem 0.25rem;
        border-radius: 3px;
        font-weight: 500;
    }

    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .no-results-icon {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1.5rem;
    }

    .no-results-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 1rem;
    }

    .no-results-text {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .search-suggestions {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 12px;
        margin-top: 2rem;
    }

    .suggestions-title {
        font-weight: 600;
        margin-bottom: 1rem;
        color: #495057;
    }

    .suggestion-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .suggestion-tag {
        background: white;
        color: #495057;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
    }

    .suggestion-tag:hover {
        background: #f97316;
        color: white;
        text-decoration: none;
        border-color: #f97316;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .search-results-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .search-title {
            font-size: 1.5rem;
        }

        .search-filters {
            padding: 1rem;
        }
    }

    /* Loading Animation */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #f97316;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Search Header -->
    <div class="search-header">
        <div class="container">
            <h1 class="search-title">Search Results</h1>
            <p class="search-meta">
                @if($articles->total() > 0)
                    Found <strong>{{ number_format($articles->total()) }}</strong> 
                    {{ Str::plural('result', $articles->total()) }} for 
                    "<strong>{{ $query }}</strong>"
                @else
                    No results found for "<strong>{{ $query }}</strong>"
                @endif
            </p>
        </div>
    </div>

    <!-- Search Filters -->
    <div class="search-filters">
        <h5 class="filter-title">
            <i class="bi bi-funnel me-2"></i>Filter Results
        </h5>
        <form method="GET" action="{{ route('articles.search') }}" class="row g-3">
            <input type="hidden" name="q" value="{{ $query }}">
            
            <div class="col-md-4">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                    <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="sort" class="form-label">Sort By</label>
                <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                    <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Most Relevant</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                </select>
            </div>
            
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-clockwise me-1"></i>Apply Filters
                </button>
            </div>
        </form>
    </div>

    @if($articles->count() > 0)
        <!-- Search Results Grid -->
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
                        <h3 class="search-result-title">
                            {!! highlightSearchTerm($article->title, $query) !!}
                        </h3>
                        
                        <p class="search-result-excerpt">
                            {!! highlightSearchTerm(Str::limit(strip_tags($article->content), 150), $query) !!}
                        </p>
                        
                        <div class="search-result-meta">
                            <span class="search-result-category">
                                {{ $article->category->name ?? 'Uncategorized' }}
                            </span>
                            <span class="search-result-date">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $article->publish_time ? $article->publish_time->format('M j, Y') : $article->created_at->format('M j, Y') }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $articles->appends(request()->query())->links() }}
        </div>
    @else
        <!-- No Results -->
        <div class="no-results">
            <div class="no-results-icon">
                <i class="bi bi-search"></i>
            </div>
            <h2 class="no-results-title">No Articles Found</h2>
            <p class="no-results-text">
                We couldn't find any articles matching "<strong>{{ $query }}</strong>". 
                Try adjusting your search terms or browse our popular categories below.
            </p>
            
            <div class="search-suggestions">
                <h5 class="suggestions-title">Popular Categories</h5>
                <div class="suggestion-tags">
                    @foreach($categories->take(8) as $category)
                        <a href="{{ route('category.show', $category) }}" class="suggestion-tag">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="bi bi-house me-1"></i>Back to Home
                </a>
            </div>
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