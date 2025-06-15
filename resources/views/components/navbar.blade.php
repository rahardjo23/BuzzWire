<!-- Simple Clean Navbar - Konsisten di Semua Halaman -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="/">BuzzWire</a>

        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <!-- Centered Search Box -->
            <div class="mx-auto">
                <form action="{{ route('articles.search') }}" method="GET" class="search-form">
                    <div class="input-group search-box">
                        <input 
                            type="text" 
                            name="q"
                            id="searchInput"
                            class="form-control search-input" 
                            placeholder="Search articles..."
                            value="{{ request('q') }}"
                        >
                        <button class="btn search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    
                    <!-- Search Suggestions -->
                    <div class="search-suggestions" id="searchSuggestions" style="display: none;">
                        <div class="suggestions-list"></div>
                    </div>
                </form>
            </div>

            <!-- User Menu -->
            <div class="d-flex align-items-center ms-auto">
                @auth
                    <a href="{{ route('articles.create') }}" class="btn publish-btn me-3">
                        <i class="bi bi-pencil-square me-1"></i>
                        Write
                    </a>
                @endauth

                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center user-menu-button" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        @auth
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" class="user-avatar">
                            @else
                                <div class="user-avatar" style="width: 32px; height: 32px; background-color: #f97316; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 14px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="text-white ms-2">{{ Auth::user()->username }}</span>
                        @else
                            <div class="user-avatar"></div>
                            <span class="text-white ms-2">Login</span>
                        @endauth
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @auth
                            <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person me-2"></i>Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">
                                <i class="bi bi-person-plus me-2"></i>Sign Up
                            </a></li>
                        @endauth
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>

<style>
/* FORCE TEXT STYLING CONSISTENCY - CATEGORY PAGE STYLE */
.navbar * {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    text-rendering: optimizeLegibility !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

/* Override untuk memastikan konsistensi navbar component */
.navbar .container-fluid {
    padding: 0 1rem !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    flex-wrap: nowrap !important;
}

.navbar-collapse {
    flex-grow: 1 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

/* Brand text consistency */
.navbar-brand {
    font-size: 28px !important;
    font-weight: bold !important;
    color: white !important;
    padding-left: 15px !important;
    line-height: 1.2 !important;
    margin-right: 2rem !important;
    white-space: nowrap !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    text-rendering: optimizeLegibility !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

/* Search form consistency */
.search-form {
    flex: 0 0 auto !important;
    margin: 0 2rem !important;
    position: relative;
    z-index: 100;
}

/* Search input text */
.search-input {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    text-rendering: optimizeLegibility !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

.search-input::placeholder {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
}

/* Right side menu consistency */
.navbar .ms-auto {
    flex: 0 0 auto !important;
    margin-left: auto !important;
    display: flex !important;
    align-items: center !important;
    gap: 1rem !important;
}

/* Publish button text consistency */
.publish-btn {
    background-color: #212121 !important;
    border: 1px solid #333 !important;
    color: white !important;
    border-radius: 4px !important;
    padding: 8px 15px !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    transition: all 0.2s ease;
    white-space: nowrap !important;
    height: 40px !important;
    display: flex !important;
    align-items: center !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    font-size: 14px !important;
    text-rendering: optimizeLegibility !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

.publish-btn:hover {
    background-color: #333 !important;
    color: white !important;
    text-decoration: none !important;
}

/* User menu button text consistency */
.user-menu-button {
    background: #1a1a1a !important;
    border: 1px solid #333 !important;
    border-radius: 12px !important;
    padding: 8px 14px !important;
    color: white !important;
    min-width: 120px !important;
    height: 48px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    white-space: nowrap !important;
    transition: all 0.3s ease !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    text-rendering: optimizeLegibility !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

.user-menu-button:hover {
    background: #000000 !important;
    border-color: #444 !important;
    color: white !important;
    transform: none !important;
}

/* User avatar consistency */
.user-avatar {
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    margin-right: 8px !important;
    flex-shrink: 0 !important;
    object-fit: cover !important;
    background-color: #ccc !important;
}

/* Username text consistency */
.user-menu-button .text-white {
    font-weight: 500 !important;
    font-size: 15px !important;
    margin-left: 8px !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    max-width: 100px !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    text-rendering: optimizeLegibility !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
    color: #ffffff !important;
}

/* Dropdown menu text consistency */
.dropdown-menu {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
}

.dropdown-item {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    text-rendering: optimizeLegibility !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

/* Search Suggestions - Component specific */
.search-suggestions {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    max-height: 300px;
    overflow-y: auto;
}

.suggestion-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background-color 0.2s ease;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
}

.suggestion-item:hover {
    background-color: #f8f9fa;
}

.suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-title {
    font-weight: 500;
    color: #333;
    margin-bottom: 4px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
}

.suggestion-category {
    font-size: 12px;
    color: #f97316;
    background-color: rgba(249, 115, 22, 0.1);
    padding: 2px 8px;
    border-radius: 12px;
    display: inline-block;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
}

/* Mobile responsiveness - Component level */
@media (max-width: 991px) {
    .search-box {
        width: 100% !important;
        max-width: 100% !important;
        min-width: auto !important;
        margin: 12px 0 !important;
    }
    
    .search-form {
        margin: 0 !important;
        flex: 1 !important;
    }
    
    .publish-btn {
        margin: 10px 0;
        width: 100%;
        text-align: center;
        justify-content: center;
    }
    
    .user-menu-button {
        min-width: 100px !important;
        width: 100% !important;
        margin-top: 10px !important;
        justify-content: center;
    }
    
    .navbar-collapse {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    
    .navbar .ms-auto {
        flex-direction: column !important;
        width: 100% !important;
        margin-left: 0 !important;
        gap: 0.5rem !important;
    }
}

@media (max-width: 768px) {
    .user-menu-button {
        padding: 6px 10px !important;
    }
    
    .user-avatar {
        width: 28px !important;
        height: 28px !important;
        margin-right: 6px !important;
    }
    
    .user-menu-button .text-white {
        font-size: 14px !important;
    }
    
    .publish-btn {
        padding: 6px 12px !important;
        height: 36px !important;
    }
    
    .navbar-brand {
        font-size: 24px !important;
        padding-left: 10px !important;
    }
}

@media (max-width: 576px) {
    .search-input {
        font-size: 16px !important; /* Prevents zoom on iOS */
        padding: 12px 16px !important;
    }
}
</style>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="/">BuzzWire</a>

        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <!-- Centered Search Box -->
            <div class="mx-auto">
                <form action="{{ route('articles.search') }}" method="GET" class="search-form">
                    <div class="input-group search-box">
                        <input 
                            type="text" 
                            name="q"
                            id="searchInput"
                            class="form-control search-input" 
                            placeholder="Search articles..."
                            value="{{ request('q') }}"
                        >
                        <button class="btn search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    
                    <!-- Search Suggestions -->
                    <div class="search-suggestions" id="searchSuggestions" style="display: none;">
                        <div class="suggestions-list"></div>
                    </div>
                </form>
            </div>

            <!-- User Menu -->
            <div class="d-flex align-items-center ms-auto">
                @auth
                    <a href="{{ route('articles.create') }}" class="btn publish-btn me-3">
                        <i class="bi bi-pencil-square me-1"></i>
                        Write
                    </a>
                @endauth

                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center user-menu-button" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        @auth
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" class="user-avatar">
                            @else
                                <div class="user-avatar" style="width: 32px; height: 32px; background-color: #f97316; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 14px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="text-white ms-2">{{ Auth::user()->username }}</span>
                        @else
                            <div class="user-avatar"></div>
                            <span class="text-white ms-2">Login</span>
                        @endauth
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @auth
                            <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person me-2"></i>Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">
                                <i class="bi bi-person-plus me-2"></i>Sign Up
                            </a></li>
                        @endauth
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>

<style>
/* Override untuk memastikan konsistensi navbar component */
.navbar .container-fluid {
    padding: 0 1rem !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    flex-wrap: nowrap !important;
}

.navbar-collapse {
    flex-grow: 1 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

/* Search form consistency */
.search-form {
    flex: 0 0 auto !important;
    margin: 0 2rem !important;
    position: relative;
    z-index: 100;
}

/* Right side menu consistency */
.navbar .ms-auto {
    flex: 0 0 auto !important;
    margin-left: auto !important;
    display: flex !important;
    align-items: center !important;
    gap: 1rem !important;
}

/* Publish button fixed styling */
.publish-btn {
    background-color: #212121 !important;
    border: 1px solid #333 !important;
    color: white !important;
    border-radius: 4px !important;
    padding: 8px 15px !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    transition: all 0.2s ease;
    white-space: nowrap !important;
    height: 40px !important;
    display: flex !important;
    align-items: center !important;
}

.publish-btn:hover {
    background-color: #333 !important;
    color: white !important;
    text-decoration: none !important;
}

/* User menu button consistency */
.user-menu-button {
    background: #1a1a1a !important;
    border: 1px solid #333 !important;
    border-radius: 12px !important;
    padding: 8px 14px !important;
    color: white !important;
    min-width: 120px !important;
    height: 48px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    white-space: nowrap !important;
    transition: all 0.3s ease !important;
}

.user-menu-button:hover {
    background: #000000 !important;
    border-color: #444 !important;
    color: white !important;
    transform: none !important;
}

/* User avatar consistency */
.user-avatar {
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    margin-right: 8px !important;
    flex-shrink: 0 !important;
    object-fit: cover !important;
    background-color: #ccc !important;
}

/* Username text consistency */
.user-menu-button .text-white {
    font-weight: 500 !important;
    font-size: 15px !important;
    margin-left: 8px !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    max-width: 100px !important;
}

/* Search Suggestions - Component specific */
.search-suggestions {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    max-height: 300px;
    overflow-y: auto;
}

.suggestion-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.suggestion-item:hover {
    background-color: #f8f9fa;
}

.suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-title {
    font-weight: 500;
    color: #333;
    margin-bottom: 4px;
}

.suggestion-category {
    font-size: 12px;
    color: #f97316;
    background-color: rgba(249, 115, 22, 0.1);
    padding: 2px 8px;
    border-radius: 12px;
    display: inline-block;
}

/* Mobile responsiveness - Component level */
@media (max-width: 991px) {
    .search-box {
        width: 100% !important;
        max-width: 100% !important;
        min-width: auto !important;
        margin: 12px 0 !important;
    }
    
    .search-form {
        margin: 0 !important;
        flex: 1 !important;
    }
    
    .publish-btn {
        margin: 10px 0;
        width: 100%;
        text-align: center;
        justify-content: center;
    }
    
    .user-menu-button {
        min-width: 100px !important;
        width: 100% !important;
        margin-top: 10px !important;
        justify-content: center;
    }
    
    .navbar-collapse {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    
    .navbar .ms-auto {
        flex-direction: column !important;
        width: 100% !important;
        margin-left: 0 !important;
        gap: 0.5rem !important;
    }
}

@media (max-width: 768px) {
    .user-menu-button {
        padding: 6px 10px !important;
    }
    
    .user-avatar {
        width: 28px !important;
        height: 28px !important;
        margin-right: 6px !important;
    }
    
    .user-menu-button .text-white {
        font-size: 14px !important;
    }
    
    .publish-btn {
        padding: 6px 12px !important;
        height: 36px !important;
    }
}

@media (max-width: 576px) {
    .search-input {
        font-size: 16px !important; /* Prevents zoom on iOS */
        padding: 12px 16px !important;
    }
    
    .navbar-brand {
        font-size: 24px !important;
        padding-left: 10px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    const suggestionsContainer = searchSuggestions ? searchSuggestions.querySelector('.suggestions-list') : null;
    let searchTimeout;

    if (searchInput && searchSuggestions && suggestionsContainer) {
        // Auto-suggest functionality
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                searchSuggestions.style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(() => {
                fetchSuggestions(query);
            }, 300);
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.style.display = 'none';
            }
        });

        // Fetch suggestions via AJAX
        function fetchSuggestions(query) {
            fetch(`/api/search-suggestions?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    displaySuggestions(data);
                })
                .catch(error => {
                    console.log('Search suggestions not available');
                    searchSuggestions.style.display = 'none';
                });
        }

        // Display suggestions
        function displaySuggestions(suggestions) {
            if (!suggestions || suggestions.length === 0) {
                searchSuggestions.style.display = 'none';
                return;
            }

            suggestionsContainer.innerHTML = '';
            
            suggestions.forEach(suggestion => {
                const item = document.createElement('div');
                item.className = 'suggestion-item';
                item.innerHTML = `
                    <div class="suggestion-title">${highlightMatch(suggestion.title, searchInput.value)}</div>
                    <span class="suggestion-category">${suggestion.category}</span>
                `;
                
                item.addEventListener('click', function() {
                    window.location.href = `/articles/${suggestion.id}`;
                });
                
                suggestionsContainer.appendChild(item);
            });

            searchSuggestions.style.display = 'block';
        }

        // Highlight matching text
        function highlightMatch(text, query) {
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<strong>$1</strong>');
        }

        // Handle form submission
        document.querySelector('.search-form').addEventListener('submit', function(e) {
            const query = searchInput.value.trim();
            if (!query) {
                e.preventDefault();
                searchInput.focus();
            }
        });

        // Enhanced search with Enter key
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                searchSuggestions.style.display = 'none';
            }
        });
    }

    // Ensure dropdown functionality works consistently
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdownMenu = this.nextElementSibling;
            if (dropdownMenu) {
                dropdownMenu.classList.toggle('show');
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
    });
});
</script>