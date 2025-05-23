<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuzzWire Politics</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/politics.css">
</head>
<body>
    <!-- Navbar -->
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
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
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
                <a href="/publish" class="publish-button" style="text-decoration: none; display: inline-block;">
                Publish Your Article</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Politics Header Section -->
    <div class="politics-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="politics-main-title">Health</h1>
                    <p class="politics-subtitle">Breaking news and in-depth analysis on government affairs, policy decisions, and political developments from around the world.</p>
                </div>
                <div class="col-md-6">
                    <div class="politics-tags">
                        <a href="#" class="politics-tag">Elections</a>
                        <a href="#" class="politics-tag">Government</a>
                        <a href="#" class="politics-tag">Policy</a>
                        <a href="#" class="politics-tag">International</a>
                        <a href="#" class="politics-tag">Analysis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Politics News -->
    <div class="content-container bg-light">
        <div class="container">
            <div class="row">
                <!-- Main Featured Article -->
                <div class="col-lg-8">
                    <a href="politics-article.html" class="featured-politics-link">
                        <div class="featured-politics">
                            <img src="img/image1.png" alt="Senate Debate" class="featured-politics-image">
                            <div class="featured-politics-content">
                                <div class="politics-category-tag">Breaking News</div>
                                <h2>Senate Approves Critical Infrastructure Bill After Marathon Debate Session</h2>
                                <p class="featured-politics-summary">Lawmakers finally reach consensus on the $1.2 trillion package after months of negotiations, sending it to the House for final approval.</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Side Politics Articles -->
                <div class="col-lg-4">
                    <div class="politics-side-container">
                        <a href="#" class="politics-side-article">
                            <div class="politics-side-content">
                                <div class="politics-category-tag">International</div>
                                <h3>UN Security Council Calls Emergency Meeting Over Rising Tensions</h3>
                            </div>
                            <div class="politics-timestamp">
                                <span class="politics-time">2 hours ago</span>
                            </div>
                        </a>
                        
                        <a href="#" class="politics-side-article">
                            <div class="politics-side-content">
                                <div class="politics-category-tag">Elections</div>
                                <h3>Governor Race Tightens as New Poll Shows Candidates in Dead Heat</h3>
                            </div>
                            <div class="politics-timestamp">
                                <span class="politics-time">5 hours ago</span>
                            </div>
                        </a>
                        
                        <a href="#" class="politics-side-article">
                            <div class="politics-side-content">
                                <div class="politics-category-tag">Analysis</div>
                                <h3>What the Latest Diplomatic Crisis Means for Regional Stability</h3>
                            </div>
                            <div class="politics-timestamp">
                                <span class="politics-time">Yesterday</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Politics Articles -->
    <div class="content-container">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Latest in Politics</h2>
                <a href="#" class="show-more">Show more <span class="show-more-icon">→</span></a>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <a href="#" class="article-link politics-card">
                        <div class="latest-article">
                            <div class="image-container">
                                <img src="img/image1.png" alt="Policy Brief" class="latest-image">
                            </div>
                            <div class="article-content">
                                <div class="author-small">
                                    <img src="img/image1.png" alt="Sarah Johnson" class="author-avatar-small">
                                    <span class="author-name-small">Sarah Johnson</span>
                                    <span class="mx-2">|</span>
                                    <span class="category-tag">Policy</span>
                                </div>
                                <h3>New Healthcare Policy Proposal Targets Prescription Drug Pricing</h3>
                                <span class="read-more">Read Article</span>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-3">
                    <a href="#" class="article-link politics-card">
                        <div class="latest-article">
                            <div class="image-container">
                                <img src="img/image1.png" alt="International Summit" class="latest-image">
                            </div>
                            <div class="article-content">
                                <div class="author-small">
                                    <img src="img/image1.png" alt="Michael Rodriguez" class="author-avatar-small">
                                    <span class="author-name-small">Michael Rodriguez</span>
                                    <span class="mx-2">|</span>
                                    <span class="category-tag">International</span>
                                </div>
                                <h3>G20 Summit Concludes with New Commitments on Climate Change</h3>
                                <span class="read-more">Read Article</span>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-3">
                    <a href="#" class="article-link politics-card">
                        <div class="latest-article">
                            <div class="image-container">
                                <img src="img/image1.png" alt="Campaign Trail" class="latest-image">
                            </div>
                            <div class="article-content">
                                <div class="author-small">
                                    <img src="img/image1.png" alt="Jennifer Lewis" class="author-avatar-small">
                                    <span class="author-name-small">Jennifer Lewis</span>
                                    <span class="mx-2">|</span>
                                    <span class="category-tag">Elections</span>
                                </div>
                                <h3>Candidates Face Off in Final Debate Before Crucial Midterm Elections</h3>
                                <span class="read-more">Read Article</span>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-3">
                    <a href="#" class="article-link politics-card">
                        <div class="latest-article">
                            <div class="image-container">
                                <img src="img/image1.png" alt="Supreme Court" class="latest-image">
                            </div>
                            <div class="article-content">
                                <div class="author-small">
                                    <img src="img/image1.png" alt="Robert Chen" class="author-avatar-small">
                                    <span class="author-name-small">Robert Chen</span>
                                    <span class="mx-2">|</span>
                                    <span class="category-tag">Judiciary</span>
                                </div>
                                <h3>Supreme Court Issues Landmark Ruling on Digital Privacy Rights</h3>
                                <span class="read-more">Read Article</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Analysis & Opinion Section -->
    <!-- Analysis & Opinion Section -->
<div class="content-container bg-light analysis-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Analysis & Opinion</h2>
            <a href="#" class="show-more">Show more <span class="show-more-icon">→</span></a>
        </div>
        
        <div class="row">
            <!-- Left side with featured analysis -->
            <div class="col-lg-6">
                <a href="#" class="analysis-featured-link">
                    <div class="analysis-featured">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="img/image1.png" alt="Political Analysis" class="analysis-image">
                            </div>
                            <div class="col-md-7">
                                <div class="analysis-content">
                                    <div class="analysis-tag">Editorial</div>
                                    <h3>Democracy's Inflection Point: The Critical Challenges Ahead</h3>
                                    <p class="analysis-excerpt">As global institutions face mounting pressures, understanding what's at stake has never been more important.</p>
                                    <div class="analysis-author">
                                        <img src="img/image1.png" alt="David Mitchell" class="author-avatar-small">
                                        <span>By David Mitchell, Political Editor</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Right side with opinion/analysis/column cards -->
            <div class="col-lg-6">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <div class="col">
                        <a href="#" class="opinion-card-link">
                            <div class="opinion-card">
                                <div class="opinion-header">
                                    <div class="opinion-tag">Opinion</div>
                                </div>
                                <h4>A Bipartisan Approach to Education Reform Is Possible</h4>
                                <div class="opinion-author">
                                    <img src="img/image1.png" alt="Amanda Torres" class="opinion-author-img">
                                    <span>Amanda Torres</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="#" class="opinion-card-link">
                            <div class="opinion-card">
                                <div class="opinion-header">
                                    <div class="opinion-tag">Opinion</div>
                                </div>
                                <h4>Energy Policy Needs to Balance Security and Climate Goals</h4>
                                <div class="opinion-author">
                                    <img src="img/image1.png" alt="James Wilson" class="opinion-author-img">
                                    <span>James Wilson</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="#" class="opinion-card-link">
                            <div class="opinion-card">
                                <div class="opinion-header">
                                    <div class="opinion-tag">Analysis</div>
                                </div>
                                <h4>The Changing Dynamics of Urban Voting Patterns</h4>
                                <div class="opinion-author">
                                    <img src="img/image1.png" alt="Priya Sharma" class="opinion-author-img">
                                    <span>Priya Sharma</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="#" class="opinion-card-link">
                            <div class="opinion-card">
                                <div class="opinion-header">
                                    <div class="opinion-tag">Column</div>
                                </div>
                                <h4>Defense Spending: Are We Asking the Right Questions?</h4>
                                <div class="opinion-author">
                                    <img src="img/image1.png" alt="Thomas Grant" class="opinion-author-img">
                                    <span>Thomas Grant</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> <!-- End inner row -->
            </div> <!-- End right column -->
        </div> <!-- End outer row -->
    </div> <!-- End container -->
</div> <!-- End section -->


    <!-- International Politics Section -->
    <div class="content-container">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">International Politics</h2>
                <a href="#" class="show-more">Show more <span class="show-more-icon">→</span></a>
            </div>
            
            <div class="row">
                <!-- Left column with main international article -->
                <div class="col-lg-4">
                    <a href="#" class="international-main-link">
                        <div class="international-main">
                            <img src="img/image1.png" alt="International Summit" class="international-main-img">
                            <div class="international-main-content">
                                <div class="international-region-tag">Europe</div>
                                <h3>EU Leaders Reach Historic Agreement on Digital Market Regulations</h3>
                                <p class="international-excerpt">New framework aims to curb tech giants' market dominance and protect consumer privacy across the European Union.</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Middle column with list of international articles -->
                <div class="col-lg-4">
                    <div class="international-list">
                        <a href="#" class="international-list-item">
                            <div class="international-region-tag">Asia</div>
                            <h4>Regional Trade Pact Set to Reshape Economic Ties in Southeast Asia</h4>
                            <div class="international-item-footer">
                                <span class="international-time">4 hours ago</span>
                            </div>
                        </a>
                        
                        <a href="#" class="international-list-item">
                            <div class="international-region-tag">Middle East</div>
                            <h4>Water Security Agreement Signals Diplomatic Breakthrough</h4>
                            <div class="international-item-footer">
                                <span class="international-time">Yesterday</span>
                            </div>
                        </a>
                        
                        <a href="#" class="international-list-item">
                            <div class="international-region-tag">Africa</div>
                            <h4>Election Observers Report Peaceful Vote in Landmark Democratic Transition</h4>
                            <div class="international-item-footer">
                                <span class="international-time">2 days ago</span>
                            </div>
                        </a>
                        
                        <a href="#" class="international-list-item">
                            <div class="international-region-tag">Americas</div>
                            <h4>Climate Coalition Forms Among Latin American Nations Ahead of Summit</h4>
                            <div class="international-item-footer">
                                <span class="international-time">3 days ago</span>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Right column with featured profiles -->
                <div class="col-lg-4">
                    <div class="profiles-container">
                        <h3 class="profiles-title">Leaders in Focus</h3>
                        
                        <a href="#" class="leader-profile">
                            <div class="profile-image-container">
                                <img src="img/image1.png" alt="Leader Profile" class="profile-image">
                            </div>
                            <div class="profile-info">
                                <h4 class="profile-name">Angela Schmidt</h4>
                                <p class="profile-position">German Chancellor</p>
                                <span class="profile-read">Read Profile →</span>
                            </div>
                        </a>
                        
                        <a href="#" class="leader-profile">
                            <div class="profile-image-container">
                                <img src="img/image1.png" alt="Leader Profile" class="profile-image">
                            </div>
                            <div class="profile-info">
                                <h4 class="profile-name">Hiroshi Tanaka</h4>
                                <p class="profile-position">Japanese Prime Minister</p>
                                <span class="profile-read">Read Profile →</span>
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