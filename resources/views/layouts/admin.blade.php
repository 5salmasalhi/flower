<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Flower Shop Admin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="flex">
            <!-- Sidebar -->
            <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
                <div class="flex-1 flex flex-col min-h-0 bg-pink-800">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <span class="text-white text-xl font-bold">Flower Shop Admin</span>
                        </div>
                        <nav class="mt-5 flex-1 px-2 space-y-1">
    <div class="mb-2 text-xs uppercase text-pink-200 tracking-wider">Gestion boutique</div>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-pink-900 text-white' : 'text-pink-100 hover:bg-pink-700' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Dashboard
    </a>
    <!-- PRODUITS -->
    <div class="relative group">
        <button onclick="toggleSubMenu('products-submenu')" type="button" class="w-full flex items-center px-2 py-2 text-sm font-medium rounded-md text-pink-100 hover:bg-pink-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
            Produits
            <svg class="ml-auto h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="products-submenu" class="hidden ml-8 mt-1 space-y-1">
            <a href="{{ route('admin.products.index') }}" class="block text-pink-100 hover:bg-pink-700 rounded px-2 py-1">Lister</a>
            <a href="{{ route('admin.products.create') }}" class="block text-pink-100 hover:bg-pink-700 rounded px-2 py-1">Ajouter</a>
        </div>
    </div>
    <!-- COMMANDES -->
    <div class="relative group">
        <button onclick="toggleSubMenu('orders-submenu')" type="button" class="w-full flex items-center px-2 py-2 text-sm font-medium rounded-md text-pink-100 hover:bg-pink-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
            Commandes
            <svg class="ml-auto h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="orders-submenu" class="hidden ml-8 mt-1 space-y-1">
            <a href="{{ route('admin.orders.index') }}" class="block text-pink-100 hover:bg-pink-700 rounded px-2 py-1">Lister</a>
        </div>
    </div>
    <!-- CATEGORIES -->
    <div class="relative group">
        <button onclick="toggleSubMenu('categories-submenu')" type="button" class="w-full flex items-center px-2 py-2 text-sm font-medium rounded-md text-pink-100 hover:bg-pink-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6M4 17h16M4 21h16" /></svg>
            Catégories
            <svg class="ml-auto h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="categories-submenu" class="hidden ml-8 mt-1 space-y-1">
            <a href="{{ route('admin.categories.index') }}" class="block text-pink-100 hover:bg-pink-700 rounded px-2 py-1">Lister</a>
            <a href="{{ route('admin.categories.create') }}" class="block text-pink-100 hover:bg-pink-700 rounded px-2 py-1">Ajouter</a>
        </div>
    </div>
    <div class="my-3 border-t border-pink-700"></div>
    <div class="mb-2 text-xs uppercase text-pink-200 tracking-wider">Autres tables</div>
    <span class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-pink-400 cursor-not-allowed opacity-60" title="À venir">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Clients
    </span>
    <span class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-pink-400 cursor-not-allowed opacity-60" title="À venir">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        Articles
    </span>
    <span class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-pink-400 cursor-not-allowed opacity-60" title="À venir">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" />
        </svg>
        Modes de règlement
    </span>
    <a href="{{ route('home') }}" class="text-pink-100 hover:bg-pink-700 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Retour à la boutique
    </a>
</nav>
<script>
function toggleSubMenu(id) {
    const el = document.getElementById(id);
    if (el.classList.contains('hidden')) {
        el.classList.remove('hidden');
    } else {
        el.classList.add('hidden');
    }
}
</script>
                    </div>
                    <div class="flex-shrink-0 flex border-t border-pink-700 p-4">
                        <div class="flex-shrink-0 w-full group block">
                            <div class="flex items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-pink-300 rounded-full bg-pink-700 p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-white">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="text-xs font-medium text-pink-200 group-hover:text-white">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="md:pl-64 flex flex-col flex-1">
                <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-gray-100">
                    <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pink-500" onclick="toggleSidebar()">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile sidebar -->
                <div id="mobile-sidebar" class="fixed inset-0 flex z-40 md:hidden hidden" role="dialog" aria-modal="true">
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true" onclick="toggleSidebar()"></div>
                    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-pink-800">
                        <div class="absolute top-0 right-0 -mr-12 pt-2">
                            <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" onclick="toggleSidebar()">
                                <span class="sr-only">Close sidebar</span>
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                            <div class="flex-shrink-0 flex items-center px-4">
                                <span class="text-white text-xl font-bold">Flower Shop Admin</span>
                            </div>
                            <nav class="mt-5 px-2 space-y-1">
                                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-pink-900 text-white' : 'text-pink-100 hover:bg-pink-700' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>

                                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'bg-pink-900 text-white' : 'text-pink-100 hover:bg-pink-700' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                    Products
                                </a>

                                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'bg-pink-900 text-white' : 'text-pink-100 hover:bg-pink-700' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Orders
                                </a>

                                <a href="{{ route('home') }}" class="text-pink-100 hover:bg-pink-700 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Back to Store
                                </a>
                            </nav>
                        </div>
                        <div class="flex-shrink-0 flex border-t border-pink-700 p-4">
                            <div class="flex-shrink-0 group block">
                                <div class="flex items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink-300 rounded-full bg-pink-700 p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-white">
                                            {{ Auth::user()->name }}
                                        </p>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="text-sm font-medium text-pink-200 group-hover:text-white">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="flex-1">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-2xl font-semibold text-gray-900">{{ $header ?? 'Admin Panel' }}</h1>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Flash Messages -->
                            @if (session('success'))
                                <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif

                            <!-- Page Content -->
                            <div class="py-4">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>
</body>
</html>