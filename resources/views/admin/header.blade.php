<div class="header-mobile-wrapper sticky-top">
    <div class="app-header__logo">

        @if ( Auth::user()->isAdmin() )
            <a href="{{ route('admin.dashboard') }}">
                <img height="70px" src="{{ asset('assets/assets/images/logo/logo-one.png') }}" data-toggle="tooltip" data-placement="bottom" title="Admin" alt="Site Logo">
            </a>
        @endif

        <button type="button" class="hamburger hamburger--elastic mobile-toggle-sidebar-nav">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
    </div>
</div>

<div class="app-header sticky-top">
    <div class="page-title-heading">
        ADMINISTRATOR
        <div class="page-title-subheading">
            Signed in as {{ Auth()->user()->firstname." ".Auth()->user()->lastname }}
        </div>
    </div>
    <div class="app-header-right">
        <div class="search-wrapper">
            <i class="search-icon-wrapper typcn typcn-zoom-outline"></i>
            <input type="text" placeholder="Search...">
        </div>
        <div class="header-btn-lg pr-0">
            <div class="header-dots">

                <div class="dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 btn btn-link">
                        <i class="typcn typcn-bell"></i>
                        <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                        <div class="dropdown-menu-header mb-0">
                            <div class="dropdown-menu-header-inner bg-night-sky">
                                <div class="menu-header-image opacity-5" style="background-image: url('assets/images/dropdown-header/city2.jpg');"></div>
                                <div class="menu-header-content text-light">
                                    <h5 class="menu-header-title">Notifications</h5>
                                    <h6 class="menu-header-subtitle">You have <b>0</b> unread messages</h6>
                                </div>
                            </div>
                        </div>
                        <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                            <li class="nav-item">
                                <a role="tab" class="nav-link active" data-toggle="tab" href="#tab-messages-header">
                                    <span>Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-events-header">
                                    <span>Events</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-errors-header">
                                    <span>System</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">
                                        <div class="p-3">
                                            <div class="notifications-box">
                                                <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                    <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">Build the production release
                                                                    <span class="badge badge-danger ml-2">Old</span>
                                                                </h4>
                                                                <span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-events-header" role="tabpanel">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">
                                        <div class="p-3">
                                            <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4>
                                                            <p>Wednesdays at <a href="javascript:void(0);">8:00 PM</a></p><span class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-errors-header" role="tabpanel">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">
                                        <div class="no-results pt-3 pb-0">
                                            <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                <span class="swal2-success-line-tip"></span>
                                                <span class="swal2-success-line-long"></span>
                                                <div class="swal2-success-ring"></div>
                                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                            </div>
                                            <div class="results-subtitle">All caught up!</div>
                                            <div class="results-title">There are no system errors!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <ul class="nav flex-column">
                            <li class="nav-item-divider nav-item"></li>
                            <li class="nav-item-btn text-center nav-item">
                                <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest Changes</button>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="header-btn-lg pr-0">
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                            
                                @php
                                    $user = Auth::user();

                                    $image = $user->profile_photo_path;
                                    $photo_path = $image ? asset('storage/' . $image) : asset('assets/assets/images/avatar.png');
                                @endphp

                                <img width="42" class="rounded" src="{{ $photo_path }}" alt="{{ $user->firstname }}">
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                              
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-info">
                                        <div class="menu-header-image opacity-2" 
                                            style="background-image: url('{{ asset("assets/admin/images/dropdown-header/city1.jpg") }}');">
                                        </div>
                                        <div class="menu-header-content text-left">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">

                                                        <img width="42" class="rounded-circle" src="{{ $photo_path }}" alt="{{ $user->firstname }}">

                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">
                                                            {{ $user->firstname ." ". $user->lastname }}
                                                        </div>
                                                        <div class="widget-subheading opacity-8">Ghana
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-right mr-2">
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf

                                                            <button class="btn-pill btn-shadow btn-shine btn btn-focus">Logout Now</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- <ul class="nav flex-column">
                                    <li class="nav-item-divider mb-0 nav-item"></li>
                                </ul> -->
                                <div class="grid-menu grid-menu-2col">
                                    <div class="no-gutters row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('admin.edit-profile.edit') }}" class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success" >
                                                <i class="pe-7s-settings icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i>
                                                Profile Settings
                                            </a> 
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{ route('admin.change-password.edit') }}" class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning" >
                                                <i class="pe-7s-lock icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
                                                Change Password
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div class="app-header-overlay d-none animated fadeIn"></div>
</div>