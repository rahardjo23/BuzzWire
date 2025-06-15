<!-- Footer Component - FULL WIDTH -->
<footer class="elegant-footer">
    <div class="footer-content">
        <div class="container-fluid"> <!-- Changed from container to container-fluid -->
            <div class="row">
                <!-- Brand Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <h3 class="brand-name">BuzzWire</h3>
                        <p class="brand-description">
                            Your trusted source for breaking news, in-depth analysis, and compelling stories from around the world.
                        </p>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="footer-section">
                        <h4 class="section-title">Categories</h4>
                        <ul class="footer-links">
                            <li><a href="/politics">Politics</a></li>
                            <li><a href="/technology">Technology</a></li>
                            <li><a href="/health">Health</a></li>
                            <li><a href="/sports">Sports</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="footer-section">
                        <h4 class="section-title">More News</h4>
                        <ul class="footer-links">
                            <li><a href="/crime">Crime</a></li>
                            <li><a href="/science">Science</a></li>
                            <li><a href="/economic">Economic</a></li>
                            <li><a href="/travel">Travel</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Quick Links Section -->
                <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
                    <div class="footer-section">
                        <ul class="footer-links">
                            <li><a href="/">Home</a></li>
                            <li><a href="/articles">All Articles</a></li>
                            <li><a href="/publish">Write Article</a></li>
                            <li><a href="/profile">My Profile</a></li>
                        </ul>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container-fluid"> <!-- Changed from container to container-fluid -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; 2025 BuzzWire. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Elegant Footer Styles - FULL WIDTH */
.elegant-footer {
    background: linear-gradient(135deg, #1a1a1a 0%, #212121 50%, #1a1a1a 100%);
    color: #ffffff;
    margin-top: 4rem;
    position: relative;
    overflow: hidden;
    width: 100vw; /* Full viewport width */
    margin-left: calc(-50vw + 50%); /* Center the full-width element */
}

.elegant-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #f97316, transparent);
}

.footer-content {
    padding: 3rem 2rem 2rem; /* Added horizontal padding for full width */
    position: relative;
}

/* Brand Section */
.footer-brand .brand-name {
    font-size: 2rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.footer-brand .brand-description {
    color: #b0b0b0;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    max-width: 280px;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 0.75rem;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.social-link:hover {
    background: rgba(249, 115, 22, 0.2);
    border-color: #f97316;
    color: #f97316;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
}

.social-link i {
    font-size: 1.1rem;
}

/* Footer Sections */
.footer-section .section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 1.25rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer-section .section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 30px;
    height: 2px;
    background: #f97316;
    border-radius: 1px;
}

/* Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: #b0b0b0;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 1rem;
}

.footer-links a::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 4px;
    background: rgba(249, 115, 22, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #f97316;
    padding-left: 1.25rem;
}

.footer-links a:hover::before {
    background: #f97316;
    width: 6px;
    height: 6px;
}

/* Newsletter Section */
.newsletter-text {
    color: #b0b0b0;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.newsletter-form {
    margin-top: 1rem;
}

.newsletter-input {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px 0 0 8px;
    color: #ffffff;
    font-size: 0.9rem;
    padding: 0.75rem 1rem;
    backdrop-filter: blur(10px);
}

.newsletter-input:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: #f97316;
    box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2);
    color: #ffffff;
    outline: none;
}

.newsletter-input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.newsletter-btn {
    background: #f97316;
    border: 1px solid #f97316;
    border-radius: 0 8px 8px 0;
    color: #ffffff;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.newsletter-btn:hover {
    background: #ea580c;
    border-color: #ea580c;
    color: #ffffff;
    transform: translateY(-1px);
}

/* Footer Bottom */
.footer-bottom {
    background: rgba(0, 0, 0, 0.3);
    padding: 1.5rem 2rem; /* Added horizontal padding for full width */
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.copyright {
    color: #888888;
    font-size: 0.9rem;
    margin: 0;
}

.footer-bottom-links {
    display: flex;
    justify-content: flex-end;
    gap: 1.5rem;
}

.footer-bottom-links a {
    color: #888888;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #f97316;
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-content {
        padding: 2rem 1rem 1.5rem; /* Reduced padding on mobile */
    }
    
    .footer-bottom {
        padding: 1.5rem 1rem; /* Reduced padding on mobile */
    }
    
    .footer-brand .brand-name {
        font-size: 1.75rem;
    }
    
    .social-links {
        justify-content: center;
        margin-bottom: 2rem;
    }
    
    .footer-section {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .footer-section .section-title::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .footer-links a {
        padding-left: 0;
    }
    
    .footer-links a::before {
        display: none;
    }
    
    .footer-bottom-links {
        justify-content: center;
        margin-top: 1rem;
    }
    
    .copyright {
        text-align: center;
    }
}

@media (max-width: 576px) {
    .footer-content {
        padding: 2rem 0.5rem 1.5rem; /* Even less padding on small screens */
    }
    
    .footer-bottom {
        padding: 1.5rem 0.5rem;
    }
    
    .footer-bottom-links {
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
    }
    
    .newsletter-form .input-group {
        flex-direction: column;
    }
    
    .newsletter-input {
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }
    
    .newsletter-btn {
        border-radius: 8px;
        width: 100%;
    }
}

/* Subtle Animation */
.footer-links a,
.social-link,
.newsletter-btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Background Pattern */
.elegant-footer::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, rgba(249, 115, 22, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.02) 0%, transparent 50%);
    pointer-events: none;
}
</style>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">