@extends('layouts.app')

@section('title', 'Edit Article - ' . $article->title)

@section('styles')
<style>
    .publish-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .publish-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .publish-form {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        font-size: 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #f97316;
        box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.25);
    }

    .btn-publish {
        background-color: #f97316;
        border-color: #f97316;
        color: white;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 8px;
        font-size: 1.1rem;
    }

    .btn-publish:hover {
        background-color: #ea580c;
        border-color: #ea580c;
        color: white;
    }

    .btn-draft {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 8px;
        font-size: 1.1rem;
    }

    .btn-draft:hover {
        background-color: #5a6268;
        border-color: #5a6268;
        color: white;
    }

    .image-preview {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .current-image {
        margin-bottom: 1rem;
    }

    .current-image img {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="publish-container">
    <div class="publish-header">
        <h1>Edit Article</h1>
        <p class="text-muted">Update your article content and settings</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="publish-form">
        @csrf
        @method('PUT')
        
        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="form-label">Article Title</label>
            <input type="text" 
                   class="form-control @error('title') is-invalid @enderror" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $article->title) }}"
                   placeholder="Enter an engaging title (10-100 characters)"
                   required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" 
                    id="category_id" 
                    name="category_id" 
                    required>
                <option value="">Choose a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cover Image -->
        <div class="mb-4">
            <label for="cover_image" class="form-label">Cover Image</label>
            
            @if($article->cover_image)
                <div class="current-image">
                    <p class="text-muted mb-2">Current image:</p>
                    <img src="{{ asset('storage/' . $article->cover_image) }}" 
                         alt="Current cover image" 
                         class="img-fluid">
                </div>
            @endif
            
            <input type="file" 
                   class="form-control @error('cover_image') is-invalid @enderror" 
                   id="cover_image" 
                   name="cover_image"
                   accept="image/*">
            <div class="form-text">
                Upload a new image to replace the current one. Accepted formats: JPEG, PNG, JPG, WebP (Max: 2MB)
            </div>
            @error('cover_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label for="content" class="form-label">Article Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                      id="content" 
                      name="content" 
                      rows="15" 
                      placeholder="Write your article content here (minimum 100 characters)"
                      required>{{ old('content', $article->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Publication Status -->
        <div class="mb-4">
            <label class="form-label">Publication Status</label>
            <div class="form-check">
                <input class="form-check-input" 
                       type="radio" 
                       name="is_published" 
                       id="published" 
                       value="1"
                       {{ old('is_published', $article->is_published) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="published">
                    <strong>Published</strong> - Make this article publicly visible
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" 
                       type="radio" 
                       name="is_published" 
                       id="draft" 
                       value="0"
                       {{ old('is_published', $article->is_published) == '0' ? 'checked' : '' }}>
                <label class="form-check-label" for="draft">
                    <strong>Draft</strong> - Save as draft (only you can see it)
                </label>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Cancel
            </a>
            
            <div>
                <button type="submit" class="btn btn-publish">
                    <i class="bi bi-check-circle me-1"></i>Update Article
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const imageInput = document.getElementById('cover_image');
    const currentImageDiv = document.querySelector('.current-image');
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Remove existing preview if any
                const existingPreview = document.getElementById('imagePreview');
                if (existingPreview) {
                    existingPreview.remove();
                }
                
                // Create new preview
                const preview = document.createElement('div');
                preview.id = 'imagePreview';
                preview.innerHTML = `
                    <p class="text-muted mb-2 mt-3">New image preview:</p>
                    <img src="${e.target.result}" alt="Preview" class="image-preview">
                `;
                imageInput.parentNode.appendChild(preview);
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Auto-save draft functionality (optional)
    let autoSaveTimer;
    const form = document.querySelector('.publish-form');
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    
    function showAutoSaveStatus(message, type = 'success') {
        // Remove existing status
        const existingStatus = document.getElementById('autoSaveStatus');
        if (existingStatus) {
            existingStatus.remove();
        }
        
        // Create status message
        const status = document.createElement('div');
        status.id = 'autoSaveStatus';
        status.className = `alert alert-${type} alert-dismissible fade show mt-2`;
        status.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        form.insertBefore(status, form.firstChild);
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
            if (status) {
                status.remove();
            }
        }, 3000);
    }
});
</script>
@endsection