@extends('layouts.app')

@section('title', $article->title)

@section('styles')
<style>
    .article-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .article-header {
        margin-bottom: 25px;
    }
    
    .article-title {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #212121;
        /* FIX: Prevent title overflow */
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        line-height: 1.2;
    }
    
    .article-meta {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        color: #6c757d;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .article-author {
        display: flex;
        align-items: center;
    }
    
    .author-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }
    
    .article-date, .article-category, .article-views {
        display: flex;
        align-items: center;
    }
    
    .article-date i, .article-category i, .article-views i {
        margin-right: 5px;
    }
    
    .article-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 30px;
    }
    
    .article-content {
        font-size: 18px;
        line-height: 1.8;
        color: #333;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    .article-content p {
        margin-bottom: 20px;
    }
    
    .article-content img {
        max-width: 100%;
        border-radius: 8px;
        margin: 20px 0;
    }
    
    .article-content blockquote {
        border-left: 4px solid #f97316;
        padding-left: 20px;
        margin: 20px 0;
        font-style: italic;
        color: #555;
    }
    
    .article-content h2 {
        font-size: 28px;
        margin-top: 40px;
        margin-bottom: 20px;
        color: #212121;
    }
    
    .article-content h3 {
        font-size: 24px;
        margin-top: 30px;
        margin-bottom: 15px;
        color: #212121;
    }

    /* Comment Section Styles */
    .comment-section {
        margin-top: 3rem;
        border-top: 1px solid #e0e0e0;
        padding-top: 2rem;
    }

    .comment-form {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
    }

    .comment-form h4 {
        margin-bottom: 1rem;
        color: #333;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .comment-form textarea {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0.75rem;
        resize: vertical;
        min-height: 100px;
        width: 100%;
        font-size: 16px;
    }

    .comment-form textarea:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
        outline: none;
    }

    .btn-comment {
        background-color: #1a73e8;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-comment:hover {
        background-color: #1765cc;
        color: white;
    }

    .btn-comment:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .comments-list h4 {
        margin-bottom: 1.5rem;
        color: #333;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .comment-item {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: box-shadow 0.3s ease;
    }

    .comment-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .comment-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .comment-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 0.75rem;
        object-fit: cover;
    }

    .comment-user-info {
        flex-grow: 1;
    }

    .comment-username {
        font-weight: 600;
        color: #333;
        margin: 0;
        font-size: 1rem;
    }

    .comment-date {
        color: #666;
        font-size: 0.875rem;
        margin: 0;
    }

    .comment-content {
        color: #333;
        line-height: 1.6;
        font-size: 16px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .no-comments {
        text-align: center;
        color: #666;
        font-style: italic;
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .comment-count {
        color: #666;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .login-prompt {
        background: #e3f2fd;
        border: 1px solid #bbdefb;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-prompt p {
        margin: 0 0 1rem 0;
        color: #1565c0;
    }

    .login-prompt a {
        color: #1a73e8;
        text-decoration: none;
        font-weight: 500;
    }

    .login-prompt a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .article-title {
            font-size: 28px;
        }

        .article-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .article-content {
            font-size: 16px;
        }

        .comment-form {
            padding: 1rem;
        }

        .comment-item {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="article-container">
        <div class="article-header">
            <h1 class="article-title">{{ $article->title }}</h1>
            
            <div class="article-meta">
                <div class="article-author">
                    @if($article->user->profile_image)
                        <img src="{{ asset('storage/' . $article->user->profile_image) }}" alt="{{ $article->user->name }}" class="author-avatar">
                    @else
                        <img src="{{ asset('img/image1.png') }}" alt="{{ $article->user->name }}" class="author-avatar">
                    @endif
                    <span>{{ $article->user->name }}</span>
                </div>
                
                <div class="article-date">
                    <i class="far fa-calendar-alt"></i>
                    @if($article->publish_time)
                        {{ is_object($article->publish_time) ? $article->publish_time->format('F j, Y') : $article->publish_time }}
                    @else
                        {{ is_object($article->created_at) ? $article->created_at->format('F j, Y') : $article->created_at }}
                    @endif
                </div>
                
                <div class="article-category">
                    <i class="fas fa-folder"></i>
                    {{ $article->category->name }}
                </div>
                
                <div class="article-views">
                    <i class="far fa-eye"></i>
                    {{ number_format($article->views) }} views
                </div>
            </div>
        </div>
        
        @if($article->cover_image)
            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="article-image">
        @endif
        
        <div class="article-content">
            {!! $article->content !!}
        </div>
    </div>

    <!-- Comment Section -->
    <div class="comment-section">
        <div class="comment-count">
            <i class="far fa-comments"></i>
            {{ $article->comments->count() }} {{ Str::plural('Comment', $article->comments->count()) }}
        </div>

        @auth
            <!-- Comment Form -->
            <div class="comment-form">
                <h4><i class="far fa-edit"></i> Write a Comment</h4>
                <form action="{{ route('comments.store', $article) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea 
                            name="content" 
                            class="form-control @error('content') is-invalid @enderror" 
                            placeholder="Share your thoughts about this article..."
                            required
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-comment">
                        <i class="far fa-paper-plane"></i> Post Comment
                    </button>
                </form>
            </div>
        @else
            <!-- Login Prompt -->
            <div class="login-prompt">
                <p><i class="fas fa-sign-in-alt"></i> Want to join the conversation?</p>
                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a> or 
                <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a> to leave a comment.
            </div>
        @endauth

        <!-- Comments List -->
        <div class="comments-list">
            <h4><i class="far fa-comments"></i> Comments</h4>
            
            @if($article->comments->count() > 0)
                @foreach($article->comments->sortByDesc('created_at') as $comment)
                    <div class="comment-item">
                        <div class="comment-header">
                            @if($comment->user->profile_image)
                                <img src="{{ asset('storage/' . $comment->user->profile_image) }}" alt="{{ $comment->user->name }}" class="comment-avatar">
                            @else
                                <img src="{{ asset('img/image1.png') }}" alt="{{ $comment->user->name }}" class="comment-avatar">
                            @endif
                            <div class="comment-user-info">
                                <p class="comment-username">{{ $comment->user->name }}</p>
                                <p class="comment-date">
                                    <i class="far fa-clock"></i>
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="comment-content">
                            {{ $comment->content }}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-comments">
                    <i class="far fa-comment-slash" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                    <p>No comments yet. Be the first to share your thoughts!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection