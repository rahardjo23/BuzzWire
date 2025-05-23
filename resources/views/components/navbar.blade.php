<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="/">BuzzWire</a>

    <!-- Toggler/collapsible Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links and search/user menu -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- Centered Search Box (Enhanced with Form) -->
      <div class="d-flex mx-auto my-2 my-lg-0">
        <form action="{{ route('articles.search') }}" method="GET" class="search-form">
          <div class="input-group search-box">
            <input 
              type="text" 
              name="q"
              id="searchInput"
              class="form-control bg-transparent border-0 search-input" 
              placeholder="Search articles, topics..."
              value="{{ request('q') }}"
              autocomplete="off"
            >
            <button class="btn search-btn" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
              </svg>
            </button>
          </div>
          
          <!-- Search Suggestions Dropdown (Hidden by default) -->
          <div class="search-suggestions" id="searchSuggestions" style="display: none;">
            <div class="suggestions-list"></div>
          </div>
        </form>
      </div>

      <!-- User Menu -->
      <div class="d-flex align-items-center ms-auto">
        @auth
          <!-- Publish Button for Logged Users -->
          <a href="{{ route('articles.create') }}" class="btn publish-btn me-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            Write
          </a>
        @endauth

        <div class="dropdown">
          <button class="btn dropdown-toggle d-flex align-items-center user-menu-button" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="user-avatar">
              @auth
                @if(Auth::user()->profile_image)
                  <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">
                @else
                  <div style="width: 36px; height: 36px; background-color: #ccc; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #666; font-weight: bold;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                  </div>
                @endif
              @else
                <div style="width: 36px; height: 36px; background-color: #ccc; border-radius: 50%;"></div>
              @endauth
            </div>
            @auth
                <span class="text-white ms-2">{{ Auth::user()->username }}</span>
            @else
                <span class="text-white ms-2">Login</span>
            @endauth
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            @auth
                <li><a class="dropdown-item" href="{{ route('profile') }}">
                  <i class="bi bi-person me-2"></i>Profile
                </a></li>
                <li><a class="dropdown-item" href="{{ route('articles.my') }}">
                  <i class="bi bi-file-text me-2"></i>My Articles
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
/* Enhanced Search Box Styles */
.search-form {
  position: relative;
  width: 100%;
}

.search-box {
  background-color: #e0e0e0;
  border-radius: 8px;
  width: 400px;
  max-width: 450px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}

.search-box:focus-within {
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  transform: translateY(-1px);
}

.search-input {
  background-color: transparent !important;
  border: none !important;
  color: #333 !important;
  font-size: 16px;
  padding: 12px 16px;
}

.search-input:focus {
  box-shadow: none !important;
  outline: none !important;
  background-color: transparent !important;
}

.search-input::placeholder {
  color: #666;
  font-size: 15px;
}

.search-btn {
  background-color: transparent;
  border: none;
  color: #666;
  padding: 12px 16px;
  transition: color 0.3s ease;
}

.search-btn:hover {
  color: #333;
  background-color: rgba(0,0,0,0.05);
}

/* Search Suggestions Dropdown */
.search-suggestions {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: white;
  border-radius: 8px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.15);
  z-index: 1000;
  margin-top: 4px;
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

/* Enhanced Publish Button */
.publish-btn {
  background-color: #f97316;
  border: 1px solid #f97316;
  color: white;
  border-radius: 6px;
  padding: 8px 16px;
  font-weight: 500;
  transition: all 0.3s ease;
  text-decoration: none;
}

.publish-btn:hover {
  background-color: #ea580c;
  border-color: #ea580c;
  color: white;
  transform: translateY(-1px);
  box-shadow: 0 4px 8px rgba(249, 115, 22, 0.3);
}

/* User Menu Enhancements */
.user-menu-button {
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 8px;
  padding: 6px 12px;
  transition: all 0.3s ease;
}

.user-menu-button:hover {
  border-color: rgba(255, 255, 255, 0.5);
  background-color: rgba(255, 255, 255, 0.1);
}

/* Responsive Design */
@media (max-width: 991px) {
  .search-box {
    width: 100%;
    max-width: 100%;
    margin: 10px 0;
  }
  
  .publish-btn {
    margin: 10px 0;
    width: 100%;
    text-align: center;
  }
}

@media (max-width: 576px) {
  .search-input {
    font-size: 16px; /* Prevents zoom on iOS */
  }
  
  .navbar-brand {
    font-size: 24px;
  }
}

/* Loading state for search */
.search-loading {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  color: #666;
}

.search-no-results {
  padding: 20px;
  text-align: center;
  color: #666;
  font-style: italic;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    const suggestionsContainer = searchSuggestions.querySelector('.suggestions-list');
    let searchTimeout;

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
});
</script>