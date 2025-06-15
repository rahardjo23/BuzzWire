<!-- Dynamic Category Navigation Component -->
<div class="nav-links">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <ul class="nav mb-2 mb-lg-0">
                @php
                    $categories = App\Models\Category::orderBy('id', 'asc')->get();
                    $currentRoute = request()->route()->getName();
                    $currentCategory = request()->route('category') ?? null;
                @endphp
                
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('category/' . $category->id) ? 'active' : '' }}" 
                           href="{{ route('category.show', $category->id) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div>
                @auth
                    <a href="{{ route('articles.create') }}" class="elegant-publish-btn">
                        <span class="btn-text">Publish Your Article</span>
                        <span class="btn-icon">→</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
.elegant-publish-btn {
    background: #1a1a1a;
    color: white;
    padding: 14px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    letter-spacing: 0.3px;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    min-width: 180px;
    transition: all 0.2s ease;
    border: 1px solid #2a2a2a;
    position: relative;
    overflow: hidden;
}

.elegant-publish-btn .btn-text {
    flex: 1;
    text-align: left;
}

.elegant-publish-btn .btn-icon {
    font-size: 16px;
    font-weight: 600;
    opacity: 0.7;
    transition: all 0.2s ease;
}

.elegant-publish-btn:hover {
    background: #2a2a2a;
    color: white;
    text-decoration: none;
    border-color: #404040;
    transform: translateY(-1px);
}

.elegant-publish-btn:hover .btn-icon {
    opacity: 1;
    transform: translateX(4px);
}

.elegant-publish-btn:active {
    transform: translateY(0);
    background: #151515;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .elegant-publish-btn {
        padding: 12px 20px;
        font-size: 13px;
        min-width: 160px;
    }
}

/* Dark theme enhancement */
@media (prefers-color-scheme: dark) {
    .elegant-publish-btn {
        background: #0f0f0f;
        border-color: #333;
    }
    
    .elegant-publish-btn:hover {
        background: #1f1f1f;
        border-color: #444;
    }
}
</style>