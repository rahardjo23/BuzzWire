@extends('layouts.app')

@section('title', 'Publish Article')

@section('styles')

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle image preview
        const coverImageInput = document.getElementById('cover_image');
        const previewImageContainer = document.getElementById('previewImageContainer');
        const previewImage = document.getElementById('previewImage');
        const removeImageButton = document.getElementById('removeImage');

        coverImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImageContainer.classList.remove('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        removeImageButton.addEventListener('click', function() {
            coverImageInput.value = '';
            previewImageContainer.classList.add('d-none');
            previewImage.src = '';
        });

        // WYSIWYG Editor
        const editorContent = document.getElementById('articleContent');
        const contentInput = document.getElementById('content');
        const formatButtons = document.querySelectorAll('.format-btn');

        // Update hidden textarea with editor content before form submission
        document.querySelector('form').addEventListener('submit', function() {
            contentInput.value = editorContent.innerHTML;
        });

        // Format buttons
        formatButtons.forEach(button => {
            button.addEventListener('click', function() {
                const command = this.dataset.command;
                const value = this.dataset.value || null;
                document.execCommand(command, false, value);
                editorContent.focus();
            });
        });

        // Insert link
        document.getElementById('insertLink').addEventListener('click', function() {
            const url = prompt('Enter the link URL:');
            if (url) {
                document.execCommand('createLink', false, url);
            }
            editorContent.focus();
        });

        // Insert image within content
        document.getElementById('insertImage').addEventListener('click', function() {
            const url = prompt('Enter the image URL:');
            if (url) {
                document.execCommand('insertImage', false, url);
            }
            editorContent.focus();
        });

        // Sync editor content to hidden textarea
        editorContent.addEventListener('input', function() {
            contentInput.value = this.innerHTML;
        });

        // Initialize editor with existing content if any
        if (contentInput.value) {
            editorContent.innerHTML = contentInput.value;
        }
    });
</script>
@endsection
<style>
    /* Publish Article Page Specific Styles */
    .publish-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .publish-container:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .publish-header {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .publish-header h1 {
        font-size: 32px;
        font-weight: bold;
        color: #212121;
    }

    .publish-header p {
        color: #6c757d;
        font-size: 16px;
        margin-top: 10px;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #212121;
    }

    /* FIXED - Form controls dengan background putih */
    .form-control,
    .form-select,
    .category-select {
        background-color: #fff !important;
        color: #212121 !important;
        border: 1px solid #ced4da !important;
        border-radius: 8px !important;
        padding: 12px !important;
        transition: all 0.3s ease !important;
    }

    .form-control:focus,
    .form-select:focus,
    .category-select:focus {
        background-color: #fff !important;
        color: #212121 !important;
        border-color: #f97316 !important;
        box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.25) !important;
    }

    .form-control::placeholder {
        color: #6c757d !important;
    }

    .form-text {
        color: #6c757d;
        font-size: 14px;
        margin-top: 5px;
    }

    .image-upload-container {
        border: 2px dashed #ced4da;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        margin-bottom: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #fff !important;
    }

    .image-upload-container:hover {
        border-color: #f97316;
        background-color: rgba(249, 115, 22, 0.03) !important;
    }

    .image-icon {
        font-size: 48px;
        color: #f97316;
        margin-bottom: 15px;
    }

    .image-upload-text h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #212121;
    }

    .image-upload-text p {
        color: #6c757d;
        font-size: 14px;
    }

    .preview-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .editor-toolbar {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-bottom: none;
        border-radius: 8px 8px 0 0;
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .editor-button {
        background-color: #fff !important;
        color: #495057 !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 4px !important;
        padding: 5px 10px !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
    }

    .editor-button:hover {
        background-color: #f1f3f5 !important;
        border-color: #ced4da !important;
        color: #212121 !important;
    }

    .editor-content {
        background-color: #fff !important;
        color: #212121 !important;
        border: 1px solid #ced4da !important;
        border-radius: 0 0 8px 8px !important;
        min-height: 300px !important;
        padding: 15px !important;
    }

    .editor-content:focus {
        background-color: #fff !important;
        color: #212121 !important;
        border-color: #f97316 !important;
        outline: none !important;
    }

    .publish-button {
        background-color: #1a1a1a;
        color: #ffffff;
        border: 1px solid #ffffff;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    
    .publish-button:hover {
        background-color: #2a2a2a;
    }

    .save-draft-button {
        background-color: #fff !important;
        color: #212121 !important;
        border: 1px solid #ced4da !important;
        border-radius: 8px !important;
        padding: 12px 24px !important;
        font-size: 16px !important;
        font-weight: 500 !important;
        transition: all 0.3s ease !important;
    }

    .save-draft-button:hover {
        background-color: #f8f9fa !important;
        color: #000 !important;
        border-color: #adb5bd !important;
    }

    .guidelines-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 25px;
    }

    .guidelines-container h3 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #212121;
    }

    .guidelines-list {
        padding-left: 20px;
    }

    .guidelines-list li {
        margin-bottom: 12px;
        color: #495057;
    }

    .tip-card {
        background-color: #fff3e0;
        border-left: 4px solid #f97316;
        padding: 15px;
        border-radius: 8px;
        margin-top: 25px;
    }

    .tip-card h4 {
        font-size: 18px;
        color: #ea580c;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- Main Publish Form -->
        <div class="col-lg-8">
            <div class="publish-container">
                <div class="publish-header">
                    <h1>Publish Your Article</h1>
                    <p>Share your thoughts, insights, and stories with the BuzzWire community</p>
                </div>

                <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
    @csrf
    
    <!-- Article Title -->
    <div class="mb-4">
        <label for="title" class="form-label">Article Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter a compelling title...">
        <div class="form-text">Make it catchy and relevant (60-100 characters recommended)</div>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Article Category -->
   <div class="mb-4">
    <label for="category_id" class="form-label">Select Category</label>
    <select class="form-select category-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
        <option value="">Choose a category</option>
        <option value="1">Politik</option>
        <option value="2">Teknologi</option>
        <option value="3">Kesehatan</option>
        <option value="4">Olahraga</option>
        <option value="5">Kriminal</option>
        <option value="6">Sains</option>
        <option value="7">Ekonomi</option>
        <option value="8">Wisata</option>
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

    <!-- Featured Image -->
    <div class="mb-4">
        <label class="form-label">Featured Image</label>
        <div class="image-upload-container" onclick="document.getElementById('cover_image').click();">
            <div class="image-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <div class="image-upload-text">
                <h4>Drag & Drop your image here</h4>
                <p>or click to browse from your computer</p>
                <p class="text-muted small">Supports: JPG, PNG, WebP (Recommended size: 1200 × 675px)</p>
            </div>
        </div>
        <input type="file" id="cover_image" name="cover_image" class="d-none @error('cover_image') is-invalid @enderror" accept="image/*">
        @error('cover_image')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Article Preview Image -->
    <div class="mb-4 d-none" id="previewImageContainer">
        <img src="" id="previewImage" class="preview-image" alt="Preview">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-sm btn-outline-danger" id="removeImage">
                <i class="fas fa-trash-alt me-1"></i> Remove Image
            </button>
        </div>
    </div>

    <!-- Article Content Editor -->
    <div class="mb-4">
        <label for="content" class="form-label">Article Content</label>
        <div class="editor-toolbar">
            <button type="button" class="editor-button format-btn" data-command="bold"><i class="fas fa-bold"></i></button>
            <button type="button" class="editor-button format-btn" data-command="italic"><i class="fas fa-italic"></i></button>
            <button type="button" class="editor-button format-btn" data-command="underline"><i class="fas fa-underline"></i></button>
            <button type="button" class="editor-button format-btn" data-command="formatBlock" data-value="h2"><i class="fas fa-heading"></i></button>
            <button type="button" class="editor-button format-btn" data-command="insertUnorderedList"><i class="fas fa-list-ul"></i></button>
            <button type="button" class="editor-button format-btn" data-command="insertOrderedList"><i class="fas fa-list-ol"></i></button>
            <button type="button" class="editor-button format-btn" data-command="formatBlock" data-value="blockquote"><i class="fas fa-quote-right"></i></button>
            <button type="button" class="editor-button" id="insertLink"><i class="fas fa-link"></i></button>
            <button type="button" class="editor-button" id="insertImage"><i class="fas fa-image"></i></button>
        </div>
        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" style="display:none;">{{ old('content') }}</textarea>
        <div class="editor-content" contenteditable="true" id="articleContent">{{ old('content') }}</div>
        <div class="form-text mt-2">Write your article using the editing tools above. Min 500 words recommended.</div>
        @error('content')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Buttons -->
    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="save-draft-button" name="is_published" value="0">
            <i class="far fa-save me-2"></i> Save Draft
        </button>
        <button type="submit" class="publish-button" name="is_published" value="1">
            <i class="fas fa-paper-plane me-2"></i> Publish Article
        </button>
    </div>
</form>
            </div>
        </div>

        <!-- Guidelines Sidebar -->
        <div class="col-lg-4">
            <div class="guidelines-container sticky-top" style="top: 20px;">
                <h3>Submission Guidelines</h3>
                <ul class="guidelines-list">
                    <li><strong>Original Content:</strong> Ensure your article is original and not published elsewhere.</li>
                    <li><strong>Quality Writing:</strong> Proofread your article for grammar and spelling errors.</li>
                    <li><strong>Factual Accuracy:</strong> Verify facts and provide sources for claims when necessary.</li>
                    <li><strong>Proper Attribution:</strong> Credit all external information, quotes, and media used.</li>
                    <li><strong>Engaging Structure:</strong> Use clear headings, subheadings, and concise paragraphs.</li>
                    <li><strong>Relevant Media:</strong> Include high-quality images that enhance your content.</li>
                </ul>

                <div class="tip-card">
                    <h4><i class="far fa-lightbulb me-2"></i>Pro Tips</h4>
                    <p>Articles with compelling headlines, high-quality images, and well-structured content receive up to 3x more engagement.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle image upload display
        const coverImageUpload = document.getElementById('cover_image');
        const coverImageUploadContainer = document.getElementById('coverImageUploadContainer');
        const previewImageContainer = document.getElementById('previewImageContainer');
        const previewImage = document.getElementById('previewImage');
        const removeImageBtn = document.getElementById('removeImage');
        
        // Rich text editor handling
        const editorContent = document.getElementById('articleContent');
        const hiddenInput = document.getElementById('content');
        
        // Initialize with any existing content
        if (hiddenInput.value) {
            editorContent.innerHTML = hiddenInput.value;
        }
        
        // Update hidden input with editor content before form submission
        document.querySelector('form').addEventListener('submit', function() {
            hiddenInput.value = editorContent.innerHTML;
        });
        
        // Trigger file input when container is clicked
        coverImageUploadContainer.addEventListener('click', function() {
            coverImageUpload.click();
        });
        
        // Preview image when selected
        coverImageUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    coverImageUploadContainer.classList.add('d-none');
                    previewImageContainer.classList.remove('d-none');
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Remove image preview
        removeImageBtn.addEventListener('click', function() {
            previewImage.src = '';
            coverImageUpload.value = '';
            previewImageContainer.classList.add('d-none');
            coverImageUploadContainer.classList.remove('d-none');
        });
        
        // Drag and drop functionality
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            coverImageUploadContainer.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            coverImageUploadContainer.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            coverImageUploadContainer.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            coverImageUploadContainer.classList.add('border-primary');
        }
        
        function unhighlight() {
            coverImageUploadContainer.classList.remove('border-primary');
        }
        
        coverImageUploadContainer.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files && files.length) {
                coverImageUpload.files = files;
                const event = new Event('change');
                coverImageUpload.dispatchEvent(event);
            }
        }
    });
    
    // Rich text formatting functions
    function formatText(command) {
        const editor = document.getElementById('articleContent');
        
        switch(command) {
            case 'bold':
                document.execCommand('bold', false, null);
                break;
            case 'italic':
                document.execCommand('italic', false, null);
                break;
            case 'underline':
                document.execCommand('underline', false, null);
                break;
            case 'h2':
                document.execCommand('formatBlock', false, '<h2>');
                break;
            case 'ul':
                document.execCommand('insertUnorderedList', false, null);
                break;
            case 'ol':
                document.execCommand('insertOrderedList', false, null);
                break;
            case 'quote':
                document.execCommand('formatBlock', false, '<blockquote>');
                break;
            case 'link':
                const url = prompt('Enter the link URL:');
                if (url) {
                    document.execCommand('createLink', false, url);
                }
                break;
        }
        
        editor.focus();
    }
</script>
@endsection