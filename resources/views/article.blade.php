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
        font-size: 24px;
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
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .comment-user-section {
        display: flex;
        align-items: center;
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

    .comment-actions {
        display: flex;
        gap: 8px;
    }

    .comment-action-btn {
        background: none;
        border: none;
        color: #666;
        font-size: 0.875rem;
        padding: 4px 8px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .comment-action-btn:hover {
        background-color: #f0f0f0;
    }

    .comment-action-btn.edit-btn:hover {
        color: #1a73e8;
    }

    .comment-action-btn.delete-btn:hover {
        color: #dc3545;
    }

    .comment-content {
        color: #333;
        line-height: 1.6;
        font-size: 16px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .comment-edit-form {
        display: none;
        margin-top: 1rem;
    }

    .comment-edit-form textarea {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0.75rem;
        font-size: 16px;
        min-height: 80px;
        resize: vertical;
    }

    .comment-edit-form textarea:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
        outline: none;
    }

    .comment-edit-actions {
        margin-top: 0.75rem;
        display: flex;
        gap: 8px;
    }

    .btn-save {
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn-save:hover {
        background-color: #218838;
    }

    .btn-cancel {
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
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

    /* Simple Toast Notification - Centered */
    .toast-notification {
        position: fixed;
        top: 30px;
        left: 50%;
        transform: translateX(-50%) translateY(-100px);
        padding: 18px 25px;
        border-radius: 12px;
        color: white;
        font-weight: 500;
        z-index: 9999;
        min-width: 400px;
        max-width: 600px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        text-align: center;
        font-size: 15px;
    }

    .toast-notification.show {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
    }

    .toast-notification.success {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .toast-notification.error {
        background: linear-gradient(135deg, #dc3545, #fd7e14);
    }

    .toast-notification.info {
        background: linear-gradient(135deg, #17a2b8, #6f42c1);
    }

    .toast-notification .toast-icon {
        display: inline-block;
        margin-right: 8px;
        font-size: 16px;
    }

    .toast-notification .toast-close {
        position: absolute;
        top: 8px;
        right: 12px;
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        padding: 0;
        opacity: 0.8;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    .toast-notification .toast-close:hover {
        opacity: 1;
        background: rgba(255, 255, 255, 0.2);
    }

    /* Custom Delete Confirmation Modal */
    .delete-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 10000;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .delete-modal-overlay.show {
        display: flex;
        opacity: 1;
        align-items: center;
        justify-content: center;
    }

    .delete-modal {
        background: white;
        border-radius: 16px;
        padding: 30px;
        max-width: 450px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transform: scale(0.8);
        transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        text-align: center;
    }

    .delete-modal-overlay.show .delete-modal {
        transform: scale(1);
    }

    .delete-modal-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #ff6b6b, #ff5252);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
    }

    .delete-modal h3 {
        color: #333;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .delete-modal p {
        color: #666;
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 30px;
    }

    .delete-modal-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .delete-modal-btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 120px;
    }

    .delete-modal-btn.cancel {
        background: #f8f9fa;
        color: #666;
        border: 2px solid #e0e0e0;
    }

    .delete-modal-btn.cancel:hover {
        background: #e9ecef;
        border-color: #ccc;
    }

    .delete-modal-btn.confirm {
        background: linear-gradient(135deg, #ff6b6b, #ff5252);
        color: white;
        border: 2px solid transparent;
    }

    .delete-modal-btn.confirm:hover {
        background: linear-gradient(135deg, #ff5252, #e53935);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
    }

    /* Responsive toast */
    @media (max-width: 768px) {
        .toast-notification {
            min-width: 320px;
            max-width: 90vw;
            left: 50%;
            margin: 0 20px;
        }
        
        .delete-modal {
            padding: 25px 20px;
            margin: 20px;
        }
        
        .delete-modal-actions {
            flex-direction: column;
        }
        
        .delete-modal-btn {
            width: 100%;
        }
        
        .article-title {
            font-size: 28px;
        }

        .article-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .comment-form {
            padding: 1rem;
        }

        .comment-item {
            padding: 1rem;
        }

        .comment-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .comment-actions {
            align-self: flex-end;
        }
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <!-- Simple Toast Notifications -->
    @if(session('success'))
    <div class="toast-notification success show" id="toast-notification">
        <span class="toast-icon">✓</span>
        {{ session('success') }}
        <button class="toast-close" onclick="hideToast()">&times;</button>
    </div>
    @endif

    @if(session('error'))
    <div class="toast-notification error show" id="toast-notification">
        <span class="toast-icon">✕</span>
        {{ session('error') }}
        <button class="toast-close" onclick="hideToast()">&times;</button>
    </div>
    @endif

    @if(session('info'))
    <div class="toast-notification info show" id="toast-notification">
        <span class="toast-icon">ℹ</span>
        {{ session('info') }}
        <button class="toast-close" onclick="hideToast()">&times;</button>
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
                    <div class="comment-item" id="comment-{{ $comment->id }}">
                        <div class="comment-header">
                            <div class="comment-user-section">
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
                                        @if($comment->created_at != $comment->updated_at)
                                            <span class="text-muted">(edited)</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons (Only for comment owner) -->
                            @auth
                            @if($comment->user_id === auth()->id())
                            <div class="comment-actions">
                                <button 
                                    type="button"
                                    class="comment-action-btn edit-btn"
                                    onclick="editComment({{ $comment->id }})"
                                >
                                    <i class="far fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline" id="comment-delete-form-{{ $comment->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="button" 
                                        class="comment-action-btn delete-btn"
                                        onclick="showDeleteModal({{ $comment->id }})"
                                    >
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>

                        <!-- Comment Content -->
                        <div class="comment-content" id="comment-content-{{ $comment->id }}">
                            {{ $comment->content }}
                        </div>

                        <!-- Edit Form (Hidden by default) -->
                        <div class="comment-edit-form" id="comment-edit-form-{{ $comment->id }}">
                            <form action="{{ route('comments.update', $comment) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <textarea 
                                    name="content" 
                                    required
                                    placeholder="Edit your comment..."
                                >{{ $comment->content }}</textarea>
                                <div class="comment-edit-actions">
                                    <button type="submit" class="btn-save">
                                        <i class="far fa-save"></i> Save
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn-cancel"
                                        onclick="cancelEdit({{ $comment->id }})"
                                    >
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </div>
                            </form>
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

<!-- Custom Delete Confirmation Modal -->
<div class="delete-modal-overlay" id="deleteModal">
    <div class="delete-modal">
        <div class="delete-modal-icon">
            <i class="far fa-trash-alt"></i>
        </div>
        <h3>Delete Comment</h3>
        <p>Are you sure you want to delete this comment?<br>This action cannot be undone.</p>
        <div class="delete-modal-actions">
            <button type="button" class="delete-modal-btn cancel" onclick="hideDeleteModal()">
                Cancel
            </button>
            <button type="button" class="delete-modal-btn confirm" onclick="confirmDeleteAction()">
                Delete Comment
            </button>
        </div>
    </div>
</div>

<script>
// Toast notification functions
function hideToast() {
    const toast = document.getElementById('toast-notification');
    if (toast) {
        toast.classList.remove('show');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }
}

// Auto hide toast after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.getElementById('toast-notification');
    if (toast) {
        setTimeout(hideToast, 5000);
    }
});

// Global variable to store the comment ID to be deleted
let commentIdToDelete = null;

// Show custom delete modal
function showDeleteModal(commentId) {
    // Store the comment ID
    commentIdToDelete = commentId;
    
    console.log('Comment ID to delete:', commentId); // Debug
    
    // Show modal
    const modal = document.getElementById('deleteModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

// Hide delete modal
function hideDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('show');
    document.body.style.overflow = '';
    commentIdToDelete = null;
}

// Confirm delete action
function confirmDeleteAction() {
    if (commentIdToDelete) {
        const form = document.getElementById('comment-delete-form-' + commentIdToDelete);
        
        console.log('Comment ID:', commentIdToDelete); // Debug
        console.log('Form found:', form); // Debug
        
        if (form) {
            console.log('Form action:', form.action); // Debug
            console.log('Form method:', form.method); // Debug
            
            // Show loading toast
            showToast('Deleting comment...', 'info');
            
            // Hide modal
            hideDeleteModal();
            
            // Submit form directly
            console.log('Submitting form...'); // Debug
            form.submit();
        } else {
            console.error('Form not found for comment ID:', commentIdToDelete); // Debug
            showToast('Error: Form not found', 'error');
        }
    } else {
        console.error('No comment ID to delete!'); // Debug
        showToast('Error: No comment selected', 'error');
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target === modal) {
        hideDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        hideDeleteModal();
    }
});

// Comment edit functions
function editComment(commentId) {
    // Hide content, show edit form
    document.getElementById('comment-content-' + commentId).style.display = 'none';
    document.getElementById('comment-edit-form-' + commentId).style.display = 'block';
}

function cancelEdit(commentId) {
    // Show content, hide edit form
    document.getElementById('comment-content-' + commentId).style.display = 'block';
    document.getElementById('comment-edit-form-' + commentId).style.display = 'none';
}

// Function to show custom toast (for dynamic notifications)
function showToast(message, type = 'success') {
    // Remove existing toast if any
    const existingToast = document.getElementById('toast-notification');
    if (existingToast) {
        existingToast.classList.remove('show');
        setTimeout(() => {
            existingToast.remove();
        }, 300);
    }
    
    // Create new toast
    const toast = document.createElement('div');
    toast.id = 'toast-notification';
    toast.className = `toast-notification ${type}`;
    
    let icon = '✓';
    if (type === 'error') icon = '✕';
    if (type === 'info') icon = 'ℹ';
    
    toast.innerHTML = `
        <span class="toast-icon">${icon}</span>
        ${message}
        <button class="toast-close" onclick="hideToast()">&times;</button>
    `;
    
    document.body.appendChild(toast);
    
    // Show with animation
    setTimeout(() => {
        toast.classList.add('show');
    }, 100);
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        if (document.getElementById('toast-notification')) {
            hideToast();
        }
    }, 5000);
}
</script>
@endsection