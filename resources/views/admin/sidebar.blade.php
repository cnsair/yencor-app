<div class="app-sidebar-wrapper">
    <div class="app-sidebar sidebar-shadow bg-dark sidebar-text-light">
        <div class="app-header__logo">

            @if ( Auth::user()->isAdmin() )

                <a href="{{ route('admin.dashboard') }}">
                    <img height="70px" src="{{ asset('assets/assets/images/logo/logo-one.png') }}" data-toggle="tooltip" data-placement="bottom" title="Yenkor Admin" alt="Site Logo">
                </a>

            @endif

            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
        <div class="scrollbar-sidebar scrollbar-container">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu">
                    <li class="app-sidebar__heading">Admin Panel</li>
                    <li class="mm-active">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="metismenu-icon pe-7s-culture"></i>
                            Dashboard
                        </a>
                        <a href="#index-2.html">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Users
                        </a>
                        <a href="#index-2.html">
                            <i class="metismenu-icon pe-7s-cash"></i>
                            Finance
                        </a>
                        <a href="{{ route('admin.audit-trail.index') }}">
                            <i class="metismenu-icon pe-7s-graph3"></i>
                            Audit Trail
                        </a>
                        <a href="#index-2.html">
                            <i class="metismenu-icon pe-7s-news-paper"></i>
                            Blog
                        </a>
                        <a href="{{ route('admin.guest-msg.index') }}">
                            <i class="metismenu-icon pe-7s-mail"></i>
                            Feedback
                        </a>
                        <a href="#index-2.html">
                            <i class="metismenu-icon pe-7s-cloud-upload"></i>
                            Uploads
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-browser"></i>
                            Others
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="#pages">
                                    <i class="metismenu-icon pe-7s-vehicle"></i>
                                    Driver
                                </a>
                                <a href="#pages">
                                    <i class="metismenu-icon"></i>
                                    Rider
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>