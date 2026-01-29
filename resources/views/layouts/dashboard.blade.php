<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Taskon') }} - Dashboard</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <livewire:styles />
    </head>
    <body class="bg-base-100 min-h-screen">
        <div class="flex h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-base-200 shadow-lg hidden md:flex flex-col">
                <!-- Logo -->
                <div class="p-6 border-b border-base-300">
                    <a href="{{ route('public.home') }}" class="text-2xl font-bold">
                        Taskon
                    </a>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-6 overflow-y-auto">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-base-300 transition {{ request()->routeIs('dashboard.profile') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--user] size-5"></span>
                                <span class="font-semibold">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.tasks') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-base-300 transition {{ request()->routeIs('dashboard.tasks') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--clipboard-list] size-5"></span>
                                <span class="font-semibold">Tasks</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.earnings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-base-300 transition {{ request()->routeIs('dashboard.earnings') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--wallet] size-5"></span>
                                <span class="font-semibold">Earnings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.activity') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-base-300 transition {{ request()->routeIs('dashboard.activity') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--history] size-5"></span>
                                <span class="font-semibold">My Activity</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- Mobile Sidebar Toggle -->
            <div class="md:hidden fixed bottom-4 right-4 z-40">
                <button class="btn btn-circle btn-primary" onclick="document.getElementById('mobile_sidebar').classList.toggle('hidden')">
                    <span class="icon-[tabler--menu-2] size-6"></span>
                </button>
            </div>

            <!-- Mobile Sidebar -->
            <div id="mobile_sidebar" class="hidden fixed inset-0 bg-black/50 z-30 md:hidden" onclick="document.getElementById('mobile_sidebar').classList.add('hidden')"></div>
            <div id="mobile_sidebar" class="hidden fixed left-0 top-0 h-screen w-64 bg-base-200 shadow-lg z-40 md:hidden flex flex-col">
                <div class="p-6 border-b border-base-300">
                    <a href="{{ route('public.home') }}" class="text-2xl font-bold">
                        Taskon
                    </a>
                </div>
                <nav class="flex-1 px-4 py-6 overflow-y-auto">
                    <ul class="space-y-2">
                        <li><a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-base-300 text-base-content">
                            <span class="icon-[tabler--user] size-5"></span>
                            <span class="font-semibold">Profile</span>
                        </a></li>
                        <li><a href="{{ route('dashboard.tasks') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-base-300 text-base-content">
                            <span class="icon-[tabler--clipboard-list] size-5"></span>
                            <span class="font-semibold">Tasks</span>
                        </a></li>
                        <li><a href="{{ route('dashboard.earnings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-base-300 text-base-content">
                            <span class="icon-[tabler--wallet] size-5"></span>
                            <span class="font-semibold">Earnings</span>
                        </a></li>
                        <li><a href="{{ route('dashboard.activity') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-base-300 text-base-content">
                            <span class="icon-[tabler--history] size-5"></span>
                            <span class="font-semibold">My Activity</span>
                        </a></li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <main class="flex-1 overflow-auto">
                <div class="p-6 md:p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <livewire:scripts />
    </body>
</html>
