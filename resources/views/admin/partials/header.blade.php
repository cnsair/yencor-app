<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-3 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
        <i class="pe-7s-car mr-2"></i> {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link px-3 bg-transparent border-0">
                    <i class="pe-7s-power mr-1"></i> Sign out
                </button>
            </form>
        </div>
    </div>
</header>