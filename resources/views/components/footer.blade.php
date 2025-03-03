<footer class="footer-div theme-1">
    <div class="footer-shape">
        <svg data-name="Layer 1" xmlns="#" viewBox="0 0 1200 120"
            preserveAspectRatio="none">
            <path
                d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                class="shape-fill"></path>
        </svg>
    </div>
    <div class="footer-nav-div div-padding theme-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/assets/images/logo/logo-one.png') }}" height="50" alt="Site Logo">
                        </a>
                    </div>
                    <div class="footer-text pe-lg-3">
                        <p class="mb-4">
                            Yencor - The AI-Powered Smart Public Transportation.
                        </p>
                    </div>
                    <div class="helpline">
                        <h3 class="mb-0">Toll Free <span>Helpline</span></h3>
                        <p class="mb-0">(+233) 20 970 5088</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h4>Useful links</h4>
                    <nav class="footer-navigation">
                        <ul>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('vehicle') }}">Our vehicles</a></li>
                            <li><a href="{{ route('service') }}">Services</a></li>
                            <li><a href="{{ route('package') }}">Packages</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            <li><a href="{{ route('blog') }}">Latest News</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ route('book-ride') }}">Book a Ride</a></li>
                            <li><a href="{{ route('register') }}">Become a Driver</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('terms.show') }}">Terms &amp; Conditions</a></li>
                            <li><a href="{{ route('policy.show') }}">Privacy policy</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h4>Head Office</h4>
                    <address class="company-address">
                        <p class="m-b-20">
                                Sakumono, Tema, 
                            <span class="d-block">Accra, Ghana</span>
                        </p>
                        <p class="m-b-8">Phone number: (+233) 20 970 5088</p>
                        <p class="m-b-8">Email Address: <a href="cdn-cgi/l/email-protection.html" class="__cf_email__"
                            data-cfemail="">info@yencor.com <br/> support@yencor.com</a>
                        </p>
                    </address>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h4>Download Mobile App</h4>
                    <div class="app-download-box">
                        <a href="#"><img src="assets/assets/images/icon/google-play.webp" alt="Google play"></a>
                        <a href="#"><img src="assets/assets/images/icon/apple-store.webp" alt="Apple store"></a>
                    </div>
                    <div class="cta-button">
                        <a href="{{ route('register') }}" class="button button-light big">Become a Driver</a>
                        <a href="{{ route('book-ride') }}" class="button button-black big">Ride with Yencor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-div">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>
                        &copy; <script>document.write(new Date().getFullYear());</script> 
                        Yencor App. All Right Reserved.
                    </p>
                </div>
                <div class="col-lg-6">
                    <ul class="social-nav">
                        <!-- <li>
                            <a href="#" class="facebook" aria-label="facebook"><i class="fab fa-facebook-f"></i></a>
                        </li> -->
                        <li>
                            <a target="_blank" href="https://x.com/yencordotcom" class="twitter" aria-label="twitter">
                                <i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a target="_blank" href="https://t.me/yencordotcom" class="telegram" aria-label="instagram">
                                <i class="fab fa-telegram"></i></a>
                        </li>
                        <!-- <li>
                            <a target="_blank" href="#" class="linkedin" aria-label="linkedin"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>