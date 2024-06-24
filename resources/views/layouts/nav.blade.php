@php
    $userRole = Auth::user()->role; // Mendapatkan role pengguna yang login
    $dashboardRoute = 'dashboard'; // Default route tetapi akan mengarahkan ke halaman kosong (404)
    $inventoriRoute = 'inventori'; // Default route untuk inventori
    $inventoriCreateRoute = 'admin.inventori.create'; // Default route untuk inventori create
    $anggotaRoute = 'anggota'; // Default route untuk kelola anggota

    if ($userRole == 'admin') {
        $dashboardRoute = 'admin.dashboard'; // Route dashboard admin
        $inventoriRoute = 'admin.inventori'; // Route inventori admin
        $inventoriCreateRoute = 'admin.inventori.create'; // Route inventori create admin
        $anggotaRoute = 'admin.anggota'; // Route kelola anggota admin
    } elseif ($userRole == 'user') {
        $dashboardRoute = 'user.dashboard'; // Route dashboard user
        $inventoriRoute = 'user.inventori'; // Route inventori user
    } elseif ($userRole == 'rt') {
        $dashboardRoute = 'rt.dashboard'; // Route dashboard RT
    }
@endphp

<!DOCTYPE html>a
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <link rel="stylesheet" href="{{ asset('layouts/css/style.css') }}">
    <script src="{{ asset('layouts/js/script.js') }}"></script>
    <nav x-data="{ open: false }">
        <div class="wrapper">
            <aside id="sidebar">
                <div class="d-flex">
                    <button class="toggle-btn" type="button">
                        <i class="lni lni-grid-alt"></i>
                    </button>
                    <div class="sidebar-logo">
                        <a href="#">SIIRKAV</a>
                        <div>{{ Auth::user()->name }}</div>
                    </div>
                </div>
                <!-- Navigation Links -->
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <x-nav-link :href="route($dashboardRoute)" :active="request()->routeIs($dashboardRoute)" class="sidebar-link">
                            <i class="lni lni-user"></i>
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#task" aria-expanded="false" aria-controls="task">
                            <i class="lni lni-agenda"></i>
                            <span>Task</span>
                        </a>
                        <ul id="task" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Kelola Kegiatan</a>
                            </li>
                            <li class="sidebar-item">
                                <x-nav-link :href="route($anggotaRoute)" :active="request()->routeIs($anggotaRoute)" class="sidebar-link">
                                    {{ __('Anggota') }}
                                </x-nav-link>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Kelola Keuangan</a>
                            </li>
                            <li class="sidebar-item">
                                <x-nav-link :href="route($inventoriRoute)" :active="request()->routeIs($inventoriRoute)" class="sidebar-link">
                                    {{ __('Inventori') }}
                                </x-nav-link>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="lni lni-protection"></i>
                            <span>Auth</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Registrasi Akun</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="lni lni-cog"></i>
                            <span>Pengaturan Akun</span>
                        </a>
                    </li>
                </ul>
                <div class="sidebar-footer">
                    <form action="{{ route('logout') }}" method="post"
                        onsubmit="event.preventDefault(); this.submit();">
                        @csrf
                        @method('post')
                        <button type="submit" class="sidebar-link">
                            <i class="lni lni-exit"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </nav>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
