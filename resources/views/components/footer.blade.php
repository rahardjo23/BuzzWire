<footer class="simple-footer">
    <div class="container">
        <div class="row">
            <!-- Brand Section -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand">
                    <h3 class="brand-name">BuzzWire</h3>
                    <p class="brand-description">
                        Your trusted source for breaking news and compelling stories from around the world.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Categories - First Column -->
            <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                <div class="footer-section">
                    <h4 class="section-title">Categories</h4>
                    <ul class="footer-links">
                        @php
                            $footerCategories = App\Models\Category::orderBy('id', 'asc')->take(4)->get();
                        @endphp
                        @foreach($footerCategories as $category)
                            <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Categories - Second Column -->
            <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                <div class="footer-section">
                    <h4 class="section-title">More News</h4>
                    <ul class="footer-links">
                        @php
                            $moreCategories = App\Models\Category::orderBy('id', 'asc')->skip(4)->take(4)->get();
                        @endphp
                        @foreach($moreCategories as $category)
                            <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
                <div class="footer-section">
                    <h4 class="section-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('articles.index') }}">All Articles</a></li>
                        <li><a href="{{ route('trending') }}">Trending</a></li>
                        @auth
                            <li><a href="{{ route('articles.create') }}">Write</a></li>
                            <li><a href="{{ route('profile') }}">Profile</a></li>
                        @else
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; 2025 BuzzWire. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">