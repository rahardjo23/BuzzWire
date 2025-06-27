@extends('layouts.app')

@section('title', 'Edit Article - ' . $article->title)

@section('styles')
<style>
    /* Base styles consistent with your light theme */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #212529;
        line-height: 1.6;
    }

    .edit-container {
        max-width: 900px;
        margin: 30px auto;
        padding: 0 15px;
    }

    .edit-header {
        text-align: center;
        margin-bottom: 40px;
        position: relative;
        padding-bottom: 20px;
    }

    .edit-header::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: #f97316;
        border-radius: 2px;
    }

    .edit-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .edit-header p {
        color: #6c757d;
        font-size: 16px;
        margin: 0;
    }

    .edit-form {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 40px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .edit-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #f97316, #ea580c, #f97316);
    }

    .form-section {
        margin-bottom: 30px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 12px;
        font-weight: 600;
        color: #212529;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label .emoji {
        font-size: 18px;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 15px 18px;
        font-size: 16px;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #f97316;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.15);
        background-color: #fff;
        color: #212529;
    }

    .form-control::placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-select option {
        background: white;
        color: #212529;
    }

    #content {
        min-height: 300px;
        resize: vertical;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Current image styling */
    .current-image {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 2px dashed #e9ecef;
        margin-bottom: 20px;
        text-align: center;
    }

    .current-image img {
        max-width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .current-image p {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 15px;
        font-weight: 500;
    }

    /* Enhanced file input */
    .file-input-wrapper {
        position: relative;
        display: block;
        width: 100%;
    }

    .file-input-custom {
        position: relative;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #ced4da;
        border-radius: 10px;
        padding: 30px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        display: block;
    }

    .file-input-custom:hover {
        border-color: #f97316;
        background: linear-gradient(135deg, #fff5f0 0%, #fed7aa 100%);
    }

    .file-input-custom input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        top: 0;
        left: 0;
    }

    .file-upload-icon {
        font-size: 40px;
        color: #f97316;
        margin-bottom: 10px;
    }

    .file-upload-text {
        font-weight: 500;
        color: #212529;
        margin-bottom: 5px;
    }

    .file-upload-hint {
        font-size: 14px;
        color: #6c757d;
    }

    /* Image preview */
    .image-preview {
        margin-top: 20px;
        text-align: center;
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
    }

    .image-preview img {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .preview-label {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 10px;
        font-weight: 500;
    }

    /* Publication status - elegant card design */
    .publication-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 15px;
    }

    .form-check {
        position: relative;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 0;
    }

    .form-check:hover {
        border-color: #f97316;
        background: #fff5f0;
        box-shadow: 0 2px 8px rgba(249, 115, 22, 0.1);
    }

    .form-check-input {
        position: absolute;
        opacity: 0;
    }

    .form-check-input:checked + .form-check-label {
        color: #f97316;
    }

    .form-check-input:checked + .form-check-label::before {
        background-color: #f97316;
        border-color: #f97316;
    }

    .form-check.active {
        border-color: #f97316;
        background: #fff5f0;
        box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
    }

    .form-check-label {
        color: #212529;
        font-size: 16px;
        cursor: pointer;
        position: relative;
        padding-left: 35px;
        font-weight: 500;
        display: block;
        margin-bottom: 0;
    }

    .form-check-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 2px;
        width: 20px;
        height: 20px;
        border: 2px solid #ced4da;
        border-radius: 50%;
        background: white;
        transition: all 0.3s ease;
    }

    .form-check-label::after {
        content: '';
        position: absolute;
        left: 6px;
        top: 8px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
        transform: scale(0);
        transition: transform 0.2s ease;
    }

    .form-check-input:checked + .form-check-label::after {
        transform: scale(1);
    }

    .publication-description {
        font-size: 14px;
        color: #6c757d;
        margin-top: 5px;
        font-weight: 400;
    }

    /* Buttons consistent with your design */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 30px;
        border-top: 2px solid #e9ecef;
        margin-top: 40px;
        gap: 20px;
    }

    .btn-outline-secondary {
        background-color: transparent;
        border: 2px solid #6c757d;
        color: #6c757d;
        padding: 12px 24px;
        font-weight: 500;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-primary {
        background-color: #f97316;
        border: 2px solid #f97316;
        color: white;
        padding: 12px 32px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 16px;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        background-color: #ea580c;
        border-color: #ea580c;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3);
    }

    .btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    /* Form helpers and validation */
    .form-text {
        font-size: 14px;
        color: #6c757d;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 14px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    /* Alerts consistent with your design */
    .alert {
        border-radius: 10px;
        border: none;
        margin-bottom: 30px;
        padding: 16px 20px;
    }

    .alert-success {
        background-color: #d1f2eb;
        color: #0f6848;
        border-left: 4px solid #28a745;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    /* Character/word counters */
    .counter {
        font-size: 12px;
        color: #6c757d;
        text-align: right;
        margin-top: 5px;
    }

    .counter.warning {
        color: #f97316;
    }

    .counter.danger {
        color: #dc3545;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .edit-form {
            padding: 25px;
            margin: 15px;
        }

        .edit-header h1 {
            font-size: 28px;
        }

        .publication-options {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
            gap: 15px;
        }

        .btn-outline-secondary, .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }

    /* Loading state */
    .btn-primary:disabled::after {
        content: '';
        width: 16px;
        height: 16px;
        border: 2px solid #ffffff;
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 8px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Enhanced focus states for accessibility */
    .form-check:focus-within {
        outline: 2px solid #f97316;
        outline-offset: 2px;
    }

    /* Icon styling */
    .icon {
        margin-right: 0.5rem;
        font-size: 16px;
    }
</style>
@endsection

@section('content')
<div class="edit-container">
    <div class="edit-header">
        <h1><span class="emoji">✏️</span> Edit Article</h1>
        <p>Polish your story and make it shine</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="edit-form" id="editForm">
        @csrf
        @method('PUT')
        
        <!-- Title Section -->
        <div class="form-section">
            <label for="title" class="form-label">
                <span class="emoji">📝</span> Article Title
            </label>
            <input type="text" 
                   class="form-control @error('title') is-invalid @enderror" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $article->title) }}"
                   placeholder="Enter a compelling title that captures attention..."
                   required
                   maxlength="100">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">
                <span class="emoji">💡</span> A great title is clear, specific, and intriguing
            </div>
            <div class="counter" id="titleCounter">0/100 characters</div>
        </div>

        <!-- Category Section -->
        <div class="form-section">
            <label for="category_id" class="form-label">
                <span class="emoji">🏷️</span> Category
            </label>
            <select class="form-select @error('category_id') is-invalid @enderror" 
                    id="category_id" 
                    name="category_id" 
                    required>
                <option value="">Choose a category that fits your content</option>
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
            <div class="form-text">
                <span class="emoji">📊</span> Select the most relevant category for better discoverability
            </div>
        </div>

        <!-- Cover Image Section -->
        <div class="form-section">
            <label class="form-label">
                <span class="emoji">🖼️</span> Cover Image
            </label>
            
            @if($article->cover_image)
                <div class="current-image">
                    <p>Current cover image:</p>
                    <img src="{{ asset('storage/' . $article->cover_image) }}" 
                         alt="Current cover image" 
                         class="img-fluid">
                </div>
            @endif
            
            <div class="file-input-wrapper">
                <label class="file-input-custom">
                    <input type="file" 
                           class="form-control @error('cover_image') is-invalid @enderror" 
                           id="cover_image" 
                           name="cover_image"
                           accept="image/*">
                    <div class="file-upload-icon">📤</div>
                    <div class="file-upload-text">Upload a new image</div>
                    <div class="file-upload-hint">Drag & drop or click to browse (JPEG, PNG, JPG, WebP - Max: 2MB)</div>
                </label>
            </div>

            @error('cover_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- Image Preview (will be shown when new image is selected) -->
            <div class="image-preview d-none" id="imagePreview">
                <div class="preview-label">New image preview:</div>
                <img id="previewImg" alt="Preview">
            </div>
        </div>

        <!-- Content Section -->
        <div class="form-section">
            <label for="content" class="form-label">
                <span class="emoji">📄</span> Article Content
            </label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                      id="content" 
                      name="content" 
                      rows="15" 
                      placeholder="Tell your story... Share insights, experiences, and knowledge that will captivate your readers."
                      required>{{ old('content', $article->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">
                <span class="emoji">✍️</span> Write with passion and authenticity – your unique voice is what makes your content special
            </div>
            <div class="counter" id="contentCounter">0 words</div>
        </div>

        <!-- Publication Status Section -->
        <div class="form-section">
            <label class="form-label">
                <span class="emoji">🚀</span> Publication Status
            </label>
            <div class="publication-options">
                <div class="form-check {{ old('is_published', $article->is_published) == '1' ? 'active' : '' }}" id="publishedOption">
                    <input class="form-check-input" 
                           type="radio" 
                           name="is_published" 
                           id="published" 
                           value="1"
                           {{ old('is_published', $article->is_published) == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">
                        <strong><span class="emoji">📢</span> Published</strong>
                        <div class="publication-description">Make this article publicly visible to all readers</div>
                    </label>
                </div>
                <div class="form-check {{ old('is_published', $article->is_published) == '0' ? 'active' : '' }}" id="draftOption">
                    <input class="form-check-input" 
                           type="radio" 
                           name="is_published" 
                           id="draft" 
                           value="0"
                           {{ old('is_published', $article->is_published) == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="draft">
                        <strong><span class="emoji">📝</span> Draft</strong>
                        <div class="publication-description">Save as private draft (only you can see it)</div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('articles.show', $article) }}" class="btn-outline-secondary">
                <span class="icon">←</span>Cancel Changes
            </a>
            
            <button type="submit" class="btn-primary" id="submitBtn">
                <span class="icon">💾</span>Update Article
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for title
    const titleInput = document.getElementById('title');
    const titleCounter = document.getElementById('titleCounter');
    
    function updateTitleCounter() {
        const currentLength = titleInput.value.length;
        titleCounter.textContent = `${currentLength}/100 characters`;
        
        if (currentLength > 80) {
            titleCounter.className = 'counter warning';
        } else if (currentLength > 95) {
            titleCounter.className = 'counter danger';
        } else {
            titleCounter.className = 'counter';
        }
    }
    
    titleInput.addEventListener('input', updateTitleCounter);
    updateTitleCounter(); // Initial call

    // Word counter for content
    const contentInput = document.getElementById('content');
    const contentCounter = document.getElementById('contentCounter');
    
    function updateContentCounter() {
        const wordCount = contentInput.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        contentCounter.textContent = `${wordCount} words`;
    }
    
    contentInput.addEventListener('input', updateContentCounter);
    updateContentCounter(); // Initial call

    // Image preview functionality
    const imageInput = document.getElementById('cover_image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('d-none');
        }
    });

    // Publication option styling
    const publishedRadio = document.getElementById('published');
    const draftRadio = document.getElementById('draft');
    const publishedOption = document.getElementById('publishedOption');
    const draftOption = document.getElementById('draftOption');
    
    function updatePublicationOptions() {
        publishedOption.classList.toggle('active', publishedRadio.checked);
        draftOption.classList.toggle('active', draftRadio.checked);
    }
    
    publishedRadio.addEventListener('change', updatePublicationOptions);
    draftRadio.addEventListener('change', updatePublicationOptions);

    // Form submission handling
    const form = document.getElementById('editForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="icon">💾</span>Updating Article...';
    });

    // Auto-resize textarea
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }
    
    contentInput.addEventListener('input', function() {
        autoResize(this);
    });
    
    // Initial resize
    autoResize(contentInput);
});
</script>
@endsection