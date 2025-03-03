<footer class="theme-2">
    <div class="footer-nav-div div-padding theme-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/assets/images/logo/logo-one.png') }}" height="50" alt="Site Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="social-nav">
                        <!-- <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li> -->
                        <li><a target="_blank" href="https://x.com/yencordotcom" class="twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://t.me/yencordotcom" class="telegram"><i class="fab fa-telegram"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <div class="app-download-box">
                        <a href="#"><img src="{{ asset('assets/assets/images/icon/google-play.webp') }}" alt="Google play"></a>
                        <a href="#"><img src="{{ asset('assets/assets/images/icon/apple-store.webp') }}" alt="Apple store"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-div theme-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>&copy; <script>document.write(new Date().getFullYear());</script> Yenkor App. All Right Reserved.</p>
                </div>
                <div class="col-lg-6">
                    <ul class="social-nav">
                        <li><a href="{{ route('policy.show') }}">Privacy</a></li>
                        <li><a href="{{ route('terms.show') }}">Terms</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>