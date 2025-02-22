<header class="theme-1">
    <div class="header__upper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="header__upper--left">
                        <div class="d-none d-lg-block logo">
                            <a href="{{ route('home') }}"><img height="60" src="{{ asset('assets/assets/images/logo/logo-one.png') }}" alt="Site Logo"></a>
                        </div>
                        <div class="d-block d-lg-none logo">
                            <a href="{{ route('home') }}"><img width="100" src="{{ asset('assets/assets/images/logo/logo-one.png') }}" alt="Site Logo"></a>
                        </div>
                        <!-- <div class="search-bar">
                            <form class="form">
                                <span class="icon icon-left"><i class="fas fa-map-marker-alt"></i></span>
                                <input class="form-control" type="search" name="search-bar"
                                    placeholder="Tell us your location" id="search-bar" aria-label="search-bar">
                                <button class="button button-dark" type="submit" aria-label="search-btn">
                                    <i class="fal fa-arrow-right"></i>
                                </button>
                            </form>
                        </div> -->
                        <button type="button" class="nav-toggle-btn a-nav-toggle ms-auto d-block d-lg-none"
                            aria-label="toggle-nav">
                            <span class="nav-toggle nav-toggle-sm">
                                <span class="stick stick-1"></span>
                                <span class="stick stick-2"></span>
                                <span class="stick stick-3"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-6" style="padding-left: 32%;">
                    <div class="header__upper--right">
                        <!--register-->
                        <a href="{{ route('book-ride') }}" class="button p-0">
                            <i class="far fa-user-astronaut"></i> Book Ride
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header__lower">
        <div class="container">
            <div class="row">
                <div class="d-none d-lg-block col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> 

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home') }}">
                                        <i class="fas fa-home"></i>Home
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('about') }}">
                                        <i class="fas fa-exclamation-circle"></i>About
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('vehicle') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('vehicle') }}">
                                        <i class="fas fa-taxi"></i>Our Vehicles
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('blog') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('blog') }}">
                                        <i class="fas fa-home"></i>Blog
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('contact') }}">
                                        <i class="fas fa-map-marker-alt"></i>Contact Us</a>
                                </li>
                            </ul>
                            <div class="my-2 my-lg-0 d-inline-flex">
                                <a href="{{ route('login') }}" class="button button-light big">Sign In</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>