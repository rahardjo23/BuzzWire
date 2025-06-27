@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Test NewsAPI</h2>
    
    {{-- Debug: Tampilkan raw data --}}
    @if(isset($news))
        <div class="alert alert-info">
            <strong>Status:</strong> {{ $news['status'] ?? 'Unknown' }}<br>
            <strong>Total Results:</strong> {{ $news['totalResults'] ?? 0 }}
        </div>
        
        @if(isset($news['articles']) && count($news['articles']) > 0)
            <div class="row">
                @foreach($news['articles'] as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if(!empty($article['urlToImage']))
                                <img src="{{ $article['urlToImage'] }}" class="card-img-top" alt="{{ $article['title'] }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $article['title'] ?? 'No Title' }}</h5>
                                <p class="card-text">{{ Str::limit($article['description'] ?? '', 100) }}</p>
                                <p class="text-muted small">
                                    Source: {{ $article['source']['name'] ?? 'Unknown' }}<br>
                                    {{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y H:i') }}
                                </p>
                                <a href="{{ $article['url'] }}" target="_blank" class="btn btn-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning">
                No articles found.
            </div>
        @endif
    @else
        <div class="alert alert-danger">
            <strong>Error:</strong> Failed to fetch news from API.<br>
            Please check your API key and internet connection.
        </div>
        
        {{-- Debug info --}}
        <div class="card">
            <div class="card-header">Debug Information</div>
            <div class="card-body">
                <p><strong>API Key Status:</strong> {{ config('newsapi.api_key') ? 'Set (hidden)' : 'NOT SET' }}</p>
                <p><strong>Base URL:</strong> {{ config('newsapi.base_url') }}</p>
            </div>
        </div>
    @endif
</div>
@endsection