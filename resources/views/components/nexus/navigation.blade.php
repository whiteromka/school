<div class="container-fluid px-0">
    <nav class="nexus-nav" role="navigation" aria-label="Main navigation">
        <div class="nav-logo">NEXUS</div>
        <ul class="nav-links d-none d-md-flex">
            <li><a href="{{ route('site.index') }}">Главная</a></li>
            <li><a href="{{ route('site.front') }}">Front</a></li>
            <li><a href="{{ route('site.back') }}">Back</a></li>
            <li><a href="{{ route('site.gamedev') }}">Gamedev</a></li>
            <li><a href="#">English</a></li>
        </ul>
        <!-- MENU DROPDOWN -->
        <div class="nav-status dropdown">
            <span class="dot"></span>
            <a
                class="guest dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                menu
            </a>
            <ul class="dropdown-menu dropdown-menu-end nexus-dropdown">
                {{-- Эти будут показываться если устройство меньше чем md --}}
                <li class="d-md-none"><a class="dropdown-item" href="{{ route('site.index') }}">Главная</a></li>
                <li class="d-md-none"><a class="dropdown-item" href="{{ route('site.front') }}">Front</a></li>
                <li class="d-md-none"><a class="dropdown-item" href="{{ route('site.back') }}">Back</a></li>
                <li class="d-md-none"><a class="dropdown-item" href="{{ route('site.gamedev') }}">Gamedev</a></li>
                <li class="d-md-none"><a class="dropdown-item" href="#">English</a></li>
                @guest
                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                    <li><a class="dropdown-item" href="{{ route('register') }}">Registration</a></li>
                @else
                    <li><a class="dropdown-item" href="{{ route('account') }}">Account</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</div>
