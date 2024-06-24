@php
    $userRole = Auth::user()->role; // Mendapatkan role pengguna yang login
    $dashboardRoute = 'dashboard'; // Default route tetapi akan mengarahkan ke halaman kosong (404)
    $inventoriRoute = 'inventori'; // Default route untuk inventori
    $inventoriCreateRoute = 'admin.inventori.create'; // Default route untuk inventori create
    $anggotaRoute = 'anggota'; // Default route untuk kelola anggota
    $suratRoute = 'surat'; // Default route untuk surat
    $suratCreateRoute = 'admin.surat.create'; // Default route untuk surat create
    $pemasukanRoute = 'keuangan.pemasukan'; // Default route untuk pemasukan
    if ($userRole == 'admin') {
        $dashboardRoute = 'admin.dashboard'; // Route dashboard admin
        $inventoriRoute = 'admin.inventori'; // Route inventori admin
        $inventoriCreateRoute = 'admin.inventori.create'; // Route inventori create admin
        $anggotaRoute = 'admin.anggota'; // Route kelola anggota admin
        $suratRoute = 'admin.surat'; // Route kelola surat admin
        $pemasukanRoute = 'admin.keuangan.pemasukan'; // Route kelola pemasukan admin
    } elseif ($userRole == 'user') {
        $dashboardRoute = 'user.dashboard'; // Route dashboard user
        $inventoriRoute = 'user.inventori'; // Route inventori user
    } elseif ($userRole == 'rt') {
        $dashboardRoute = 'rt.dashboard'; // Route dashboard RT
        $suratRoute = 'rt.surat'; // Route surat RT
    }
@endphp
{{-- CSS --}}
<style>
    .sidebar {
        width: 225px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #ffffff !important;
        border-right: 1px solid #e5e7eb;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
    }

    .navlink {
        display: block;
        padding: 10px 20px;
        text-decoration: none;
        color: #4a5568;
    }

    .navlink:hover {
        background-color: #f7fafc;
        color: #2d3748;
    }

    .main-content {
        margin-left: 200px;
        /* padding: 20px; */

        /* width: calc(100% - 200px); */
        box-sizing: border-box;
    }
</style>


<nav x-data="{ open: false }" class="bg-white border-r border-gray-100 h-screen fixed">
    <div class="sidebar w-64 h-full bg-white shadow-md">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="shrink-0 flex items-center p-4">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 px-4">
                <x-nav-link :href="route($dashboardRoute)" :active="request()->routeIs($dashboardRoute)" class="navlink">
                    {{ __('Dashboard') }}
                </x-nav-link>
                @if ($userRole != 'rt')
                    <x-nav-link :href="route($inventoriRoute)" :active="request()->routeIs($inventoriRoute)" class="navlink">
                        {{ __('Inventori') }}
                    </x-nav-link>
                    <x-nav-link :href="route($anggotaRoute)" :active="request()->routeIs($anggotaRoute)" class="navlink">
                        {{ __('Anggota') }}
                    </x-nav-link>
                    <x-nav-link :href="route($pemasukanRoute)" :active="request()->routeIs($pemasukanRoute)" class="navlink">
                        {{ __('Keuangan') }}
                    </x-nav-link>
                @endif
                <x-nav-link :href="route($suratRoute)" :active="request()->routeIs($suratRoute)" class="navlink">
                    {{ __('Kelola Surat') }}
                </x-nav-link>
            </div>

            <!-- Settings Dropdown -->
            <div class="p-4">
                <x-dropdown align="right" width="48" class="dropdown">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content" class="dropdown-menu">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
