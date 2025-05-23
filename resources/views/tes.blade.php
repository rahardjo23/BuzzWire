<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuzzWire News</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="#">BuzzWire</a>

    <!-- Toggler/collapsible Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span> 
    </button>

    <!-- Navbar links and search/user menu -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- Centered Search Box -->
      <div class="d-flex mx-auto my-2 my-lg-0">
        <div class="input-group search-box">
          <input type="text" class="form-control bg-transparent border-0" placeholder="Search...">
          <button class="btn" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
        </div>
      </div>

      <!-- User Menu -->
      <div class="d-flex align-items-center ms-auto">
        <div class="dropdown">
          <button class="btn dropdown-toggle d-flex align-items-center user-menu-button" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="user-avatar"></div>
            <span class="text-white">Christopher</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/">Logout</a></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</nav>

<!-- Category Navigation -->
<div class="nav-links">
  <div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
      <ul class="nav mb-2 mb-lg-0">
      <li class="nav-item"><a class="nav-link active" href="/politics">Politics</a></li>
      <li class="nav-item"><a class="nav-link" href="/technology">Technology</a></li>
      <li class="nav-item"><a class="nav-link" href="/health">Health</a></li>
      <li class="nav-item"><a class="nav-link" href="/sports">Sports</a></li>                 <li class="nav-item"><a class="nav-link" href="/crime">Crime</a></li>
      <li class="nav-item"><a class="nav-link" href="/science">Science</a></li>
      <li class="nav-item"><a class="nav-link" href="/economic">Economic</a></li>
      <li class="nav-item"><a class="nav-link" href="/travel">Travel</a></li>
      </ul>

      <div>
      <a href="/publish" class="publish-button" style="text-decoration: none; display: inline-block;">Publish your Articles</a>
      </div>
    </div>
  </div>
</div>


    <!-- News Content -->
    <div class="content-container">
        <div class="container">
        <div class="row">
    <!-- Main Article -->
    <div class="col-lg-6">
        <a href="/article" class="article-link">
            <div class="author-info">
                <img src="img/image1.png" alt="Christopher Andrew" class="author-avatar">
                <div>
                    <h4 class="author-name">Christopher Andrew</h4>
                    <div class="author-title">Author</div>
                </div>
            </div>
            
            <div class="main-article">
                <h1>Women's Basketball Semifinals Preview And Schedule</h1>
                <div class="category-tag1">Olympics</div>
                <img src="img/image1.png" alt="Women's Basketball" class="article-image">
            </div>
        </a>
    </div>

    <!-- Side Articles -->
    <div class="col-lg-6">
        <!-- Side Article 1 -->
        <a href="#" class="side-article-link">
    <div class="side-article-content">
        <h2>Boom. Snoop Dogg: Breaking Electrifies Paris 2024 Olympics</h2>
        <div class="article-summary">The inaugural Olympic breaking competition kicked off at La Concorde on Friday...</div>
        <div class="category-tag">Olympics</div>
        <span class="read-more-indicator">→</span>
    </div>
    <img src="img/image1.png" alt="Breaking Competition" class="side-article-image">
</a>

        <!-- Side Article 2 -->
        <a href="#" class="side-article-link">
    <div class="side-article-content">
        <h2>Boom. Snoop Dogg: Breaking Electrifies Paris 2024 Olympics</h2>
        <div class="article-summary">The inaugural Olympic breaking competition kicked off at La Concorde on Friday...</div>
        <div class="category-tag">Olympics</div>
        <span class="read-more-indicator">→</span>
    </div>
    <img src="img/image1.png" alt="Breaking Competition" class="side-article-image">
</a>

        <!-- Side Article 3 -->
        <a href="#" class="side-article-link">
    <div class="side-article-content">
        <h2>Boom. Snoop Dogg: Breaking Electrifies Paris 2024 Olympics</h2>
        <div class="article-summary">The inaugural Olympic breaking competition kicked off at La Concorde on Friday...</div>
        <div class="category-tag">Olympics</div>
        <span class="read-more-indicator">→</span>
    </div>
    <img src="img/image1.png" alt="Breaking Competition" class="side-article-image">
</a>
    </div>
</div>

</div>
        </div>
        <div class="content-container">
        <div class="container">
        <div class="row">
    <div class="col-md-6">
        <a href="article-1.html" class="featured-link">
            <div class="featured-article">
                <img src="img/image1.png" alt="Olympic Basketball" class="featured-image">
                <div class="featured-content">
                    <div class="category-tag">Olympics</div>
                    <h2>Boom. Snoop Dogg: Breaking Electrifies Paris 2024 Olympics</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="article-2.html" class="featured-link">
            <div class="featured-article">
                <img src="img/image1.png" alt="Olympic Basketball" class="featured-image">
                <div class="featured-content">
                    <div class="category-tag">Olympics</div>
                    <h2>Boom. Snoop Dogg: Breaking Electrifies Paris 2024 Olympics</h2>
                </div>
            </div>
        </a>
    </div>
</div>

            
            <!-- Latest Articles Section -->
            <div class="section-header">
                <h2 class="section-title">Latest Articles</h2>
                <a href="#" class="show-more">Show more <span class="show-more-icon">→</span></a>
            </div>
            
            <div class="row">
            <div class="col-md-3">
    <a href="#" class="article-link latest-article-link">
        <div class="latest-article">
            <div class="image-container">
                <img src="img/image1.png" alt="Olympic Basketball" class="latest-image">
            </div>
            <div class="article-content">
                <div class="author-small">
                    <img src="img/image1.png" alt="Leslie Alexander" class="author-avatar-small">
                    <span class="author-name-small">Leslie Alexander</span>
                    <span class="mx-2">|</span>
                    <span class="category-tag">Olympics</span>
                </div>
                <h3>Kagami Yuka of Japan wins Women's wrestling freestyle 76kg gold</h3>
                <span class="read-more">Read Article</span>
            </div>
        </div>
    </a>
</div>
                
<div class="col-md-3">
    <a href="#" class="article-link latest-article-link">
        <div class="latest-article">
            <div class="image-container">
                <img src="img/image1.png" alt="Olympic Basketball" class="latest-image">
            </div>
            <div class="article-content">
                <div class="author-small">
                    <img src="img/image1.png" alt="Leslie Alexander" class="author-avatar-small">
                    <span class="author-name-small">Leslie Alexander</span>
                    <span class="mx-2">|</span>
                    <span class="category-tag">Olympics</span>
                </div>
                <h3>Kagami Yuka of Japan wins Women's wrestling freestyle 76kg gold</h3>
                <div class="read-more-link">
                    <span class="read-more">Read article</span>
                </div>
            </div>
        </div>
    </a>
</div>
                
<div class="col-md-3">
    <a href="#" class="article-link latest-article-link">
        <div class="latest-article">
            <div class="image-container">
                <img src="img/image1.png" alt="Olympic Basketball" class="latest-image">
            </div>
            <div class="article-content">
                <div class="author-small">
                    <img src="img/image1.png" alt="Leslie Alexander" class="author-avatar-small">
                    <span class="author-name-small">Leslie Alexander</span>
                    <span class="mx-2">|</span>
                    <span class="category-tag">Olympics</span>
                </div>
                <h3>Kagami Yuka of Japan wins Women's wrestling freestyle 76kg gold</h3>
                <div class="read-more-link">
                    <span class="read-more">Read article</span>
                </div>
            </div>
        </div>
    </a>
</div>
                
<div class="col-md-3">
    <a href="#" class="article-link latest-article-link">
        <div class="latest-article">
            <div class="image-container">
                <img src="img/image1.png" alt="Olympic Basketball" class="latest-image">
            </div>
            <div class="article-content">
                <div class="author-small">
                    <img src="img/image1.png" alt="Leslie Alexander" class="author-avatar-small">
                    <span class="author-name-small">Leslie Alexander</span>
                    <span class="mx-2">|</span>
                    <span class="category-tag">Olympics</span>
                </div>
                <h3>Kagami Yuka of Japan wins Women's wrestling freestyle 76kg gold</h3>
                <span class="read-more">Read Article</span>
            </div>
        </div>
    </a>
</div>
<div class="row article-section-last">
    <!-- Side Articles (Left) -->
    <div class="col-lg-6">
        <!-- Side Article 1 -->
        <a href="#" class="side-article-link">
    <div class="side-article-content">
        <h2>Boom. Snoop Dogg: Breaking Electrifies Paris 2024 Olympics</h2>
        <div class="article-summary">The inaugural Olympic breaking competition kicked off at La Concorde on Friday...</div>
        <div class="category-tag">Olympics</div>
        <span class="read-more-indicator">→</span>
    </div>
    <img src="img/image1.png" alt="Breaking Competition" class="side-article-image">
</a>

        <!-- Side Article 2 -->
        <a href="#" class="side-article-link">
    <div class="side-article-content">
        <h2>Boom. Snoop Dogg: Breaking Electrifies Paris 2024 Olympics</h2>
        <div class="article-summary">The inaugural Olympic breaking competition kicked off at La Concorde on Friday...</div>
        <div class="category-tag">Olympics</div>
        <span class="read-more-indicator">→</span>
    </div>
    <img src="img/image1.png" alt="Breaking Competition" class="side-article-image">
</a>

        <!-- Side Article 3 -->
        <a href="#" class="side-article-link">
    <div class="side-article-content">
        <h2>Boom. Snoop Dogg: Breaking Electrifies Paris 2024 Olympics</h2>
        <div class="article-summary">The inaugural Olympic breaking competition kicked off at La Concorde on Friday...</div>
        <div class="category-tag">Olympics</div>
        <span class="read-more-indicator">→</span>
    </div>
    <img src="img/image1.png" alt="Breaking Competition" class="side-article-image">
</a>
    </div>

    <!-- Main Article (Right) -->
    <div class="col-lg-6">
    <a href="main-article.html" class="article-link">
            <div class="author-info">
                <img src="img/image1.png" alt="Christopher Andrew" class="author-avatar">
                <div>
                    <h4 class="author-name">Christopher Andrew</h4>
                    <div class="author-title">Author</div>
                </div>
            </div>
            
            <div class="main-article">
                <h1>Women's Basketball Semifinals Preview And Schedule</h1>
                <div class="category-tag1">Olympics</div>
                <img src="img/image1.png" alt="Women's Basketball" class="article-image">
            </div>
        </a>
    </div>
</div>


            </div>
        </div>
 </div>

 <footer class="bg-dark text-white py-4">
  <div class="container">
    <div class="row">
      <!-- Left side with logo and categories -->
      <div class="col-md-8">
        <div class="mb-3">
          <h2 class="fw-bold">BuzzWire</h2>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <ul class="list-unstyled">
              <li class="mb-2"><a href="#" class="text-white text-decoration-none">Politics</a></li>
              <li class="mb-2"><a href="#" class="text-white text-decoration-none">Technology</a></li>
              <li class="mb-2"><a href="#" class="text-white text-decoration-none">Health</a></li>
              <li class="mb-2"><a href="#" class="text-white text-decoration-none">Sports</a></li>
            </ul>
          </div>
          <div class="col-sm-6">
            <ul class="list-unstyled">
              <li class="mb-2"><a href="#" class="text-white text-decoration-none">Crime</a></li>
              <li class="mb-2"><a href="#" class="text-white text-decoration-none">Science</a></li>
              <li class="mb-2"><a href="#" class="text-white text-decoration-none">Economic and Business</a></li>
              <li class="mb-2"><a href="#" class="text-white text-decoration-none">Travel</a></li>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Right side with social media icons -->
      <div class="col-md-4 text-end">
        <div class="social-icons mb-4">
          <a href="#" class="text-white me-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
              <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
            </svg>
          </a>
          <a href="#" class="text-white mx-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            </svg>
          </a>
          <a href="#" class="text-white mx-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            </svg>
          </a>
          <a href="#" class="text-white ms-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
    
    <!-- Copyright text -->
    <div class="text-end mt-4">
      <small class="text-muted">Hak Cipta © 2025 BuzzWire. Hak Cipta Dilindungi Undang-undang.</small>
    </div>
  </div>
</footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>