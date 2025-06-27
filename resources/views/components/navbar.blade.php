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

            <!-- User Menu Only (Remove Write Button) -->
            <div class="d-flex align-items-center ms-auto">
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center user-menu-button" 
                            type="button" 
                            id="userDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        @auth
                            <img src="{{ Auth::user()->profile_image_url }}" alt="{{ Auth::user()->name }}" class="user-avatar" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #f97316; border-radius: 50%; display: none; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 14px;">
                                {{ Auth::user()->initials }}
                            </div>
                            <span class="text-white ms-2">{{ Auth::user()->username }}</span>
                        @else
                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #ccc; border-radius: 50%;"></div>
                            <span class="text-white ms-2">Login</span>
                        @endauth
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        @auth
                            <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person me-2"></i>Profile
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('articles.create') }}">
                                <i class="bi bi-plus-circle me-2"></i>Write Article
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    const suggestionsContainer = searchSuggestions ? searchSuggestions.querySelector('.suggestions-list') : null;
    let searchTimeout;

    // ===== SEARCH FUNCTIONALITY =====
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

        // Hide suggestions when clicking outside search area
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-form')) {
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

    // ===== DROPDOWN FIXES =====
    
    // Fix dropdown positioning issues
    const dropdownToggle = document.getElementById('userDropdown');
    if (dropdownToggle) {
        dropdownToggle.addEventListener('shown.bs.dropdown', function() {
            // Ensure dropdown is positioned correctly
            const dropdownMenu = this.nextElementSibling;
            if (dropdownMenu) {
                dropdownMenu.style.position = 'absolute';
                dropdownMenu.style.zIndex = '1050';
            }
        });
    }

    // Handle modal triggers from dropdown
    const modalTriggers = document.querySelectorAll('[data-bs-toggle="modal"]');
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            // Close dropdown when opening modal
            const openDropdown = document.querySelector('.dropdown-menu.show');
            if (openDropdown) {
                const dropdownInstance = bootstrap.Dropdown.getInstance(dropdownToggle);
                if (dropdownInstance) {
                    dropdownInstance.hide();
                }
            }
        });
    });

    // Prevent dropdown from closing when clicking on forms inside
    const dropdownForms = document.querySelectorAll('.dropdown-menu form');
    dropdownForms.forEach(form => {
        form.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    // ===== MOBILE NAVBAR TOGGLE =====
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        // Close mobile menu when clicking on links
        const navLinks = navbarCollapse.querySelectorAll('a:not(.dropdown-toggle)');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            });
        });
    }

    // ===== ACCESSIBILITY IMPROVEMENTS =====
    
    // Add keyboard navigation for dropdowns
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close open dropdowns
            const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
            openDropdowns.forEach(dropdown => {
                const toggle = dropdown.previousElementSibling;
                if (toggle) {
                    const dropdownInstance = bootstrap.Dropdown.getInstance(toggle);
                    if (dropdownInstance) {
                        dropdownInstance.hide();
                    }
                }
            });
            
            // Close search suggestions
            if (searchSuggestions) {
                searchSuggestions.style.display = 'none';
            }
        }
    });
});
</script>