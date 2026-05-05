<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
x-data="{
    open:false,
    dark: localStorage.getItem('dark') === 'true'
}"
x-init="$watch('dark', val => localStorage.setItem('dark', val))"
:class="dark ? 'dark bg-gray-900 text-white' : 'bg-gray-100 text-gray-800'"
class="transition-colors duration-300 overflow-x-hidden"
>

@if(session('error'))
     <div class="mb-4 p-3 rounded-lg bg-red-500 text-white">
        {{ session('error') }}
    </div>
@endif

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside
        :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 h-screen w-64 z-40
            bg-[#0f172a] text-gray-300
            border-r border-gray-800 p-5
            transition-transform duration-200
            md:static md:translate-x-0 md:h-auto">

        <h2 class="text-xl font-bold text-white mb-6">Bengkel App</h2>

        <nav class="space-y-2">

            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('customers.index') }}"
               class="sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Customer
            </a>

            <a href="{{ route('items.index') }}"
               class="sidebar-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Barang
            </a>

            <a href="{{ route('estimations.index') }}"
               class="sidebar-link {{ request()->routeIs('estimations.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Estimasi
            </a>

            <a href="{{ route('invoices.index') }}"
               class="sidebar-link {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Transaksi
            </a>

            <a href="{{ route('bills.index') }}"
               class="sidebar-link {{ request()->routeIs('bills.*') ? 'active' : '' }}">
               <i class="bi bi-cash-stack"></i> Tagihan
            </a>

        </nav>

        <div class="mt-10 border-t border-gray-700 pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="sidebar-link w-full text-red-400 hover:bg-red-500/10">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Overlay -->
    <div x-show="open" @click="open=false"
        class="fixed inset-0 bg-black/50 z-30 md:hidden"></div>

    <!-- Content -->
    <main class="flex-1 w-full max-w-7xl mx-auto p-4 md:p-6">

        <!-- Topbar -->
        <div class="flex justify-between items-center mb-6">

            <div class="flex items-center gap-3">
                <button @click="open = !open" class="md:hidden text-xl">☰</button>
                <h1 class="text-lg md:text-xl font-semibold">@yield('title')</h1>
            </div>

            <div class="flex items-center gap-3">

                <!-- Dark Mode -->
                <button @click="dark = !dark"
                    class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700">

                    <i x-show="!dark" class="bi bi-moon"></i>
                    <i x-show="dark" class="bi bi-sun text-yellow-400"></i>

                </button>

                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ auth()->user()->name }}
                </span>

            </div>

        </div>

        <!-- Content + Footer Wrapper -->
        <div class="flex flex-col min-h-[calc(100vh-120px)]">

            <!-- Page Content -->
            <div class="flex-1">
                @yield('content')
            </div>
            @if(session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-500 text-white">
                {{ session('success') }}
            </div>
            @endif

            <!-- Footer -->
            <footer class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4 text-sm text-gray-500 dark:text-gray-400 flex flex-col md:flex-row justify-between items-center gap-2">

                <span>
                    © {{ date('Y') }} <strong>Bengkel App</strong>. All rights reserved.
                </span>

                <span class="flex items-center gap-1">
                    Made with
                    <i class="bi bi-heart-fill text-red-500"></i>
                    by Wildans-Developer
                </span>

            </footer>

        </div>

    </main>

</div>

</body>
</html>
