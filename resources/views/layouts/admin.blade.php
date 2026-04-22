<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>

    <!-- Bootstrap 5 -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #adb5bd;
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .sidebar .nav-link:hover {
            background: #495057;
            color: #fff;
        }

        .content {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark sidebar p-3">
        <h4 class="text-white">Admin</h4>
        <hr class="text-secondary">
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    Users
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}"
                   class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    Settings
                </a>
            </li>
        </ul>
        <hr class="text-secondary">
        <div class="text-white small">
            {{ auth()->user()->getNameOrEmail() }}
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button class="btn btn-sm btn-outline-light w-100">Logout</button>
        </form>
    </div>

    <!-- Main -->
    <div class="content">
        <!-- Topbar -->
        <nav class="navbar navbar-light bg-light border-bottom px-3">
            <span class="navbar-brand mb-0 h5">
                @yield('title', 'Admin panel')
            </span>
        </nav>
        <!-- Page content -->
        <div class="container-fluid p-4">
            {{-- flash messages --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')

        </div>
    </div>
</div>
<script src="/js/bootstrap.js"></script>
</body>
</html>
