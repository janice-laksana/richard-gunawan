<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="{{ url('/admin') }}">
                    <img src="{{ asset('img/freelancy_logo.png') }}" alt="Freelancy" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="{{ url('/admin') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-table"></i>DATA</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{ url('/admin/user') }}">User</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/jasa') }}">Jasa</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/request') }}">Request</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ url('/admin') }}">
            <img src="{{ asset('img/freelancy_logo.png') }}" alt="Freelancy" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="{{ url('/admin') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-table"></i>DATA</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ url('/admin/user') }}">User</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/jasa') }}">Jasa</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/request') }}">Request</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
