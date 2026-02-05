<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <title>{{ config('app.name', 'Jobtrackingsys') }} - Dashboard</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            .auth-modal {
                display: none;
                position: fixed;
                inset: 0;
                z-index: 9999;
                justify-content: center;
                align-items: center;
                background-color: rgba(0, 0, 0, 0.5);
            }

            .auth-modal.active {
                display: flex;
            }

            .auth-modal-content {
                background-color: var(--color-base-100, white);
                border-radius: 0.5rem;
                width: 100%;
                max-width: 28rem;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                position: relative;
                animation: slideIn 0.3s ease-out;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Toast Notification Styles */
            .toast-container {
                position: fixed;
                top: 1.5rem;
                right: 1.5rem;
                z-index: 10000;
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
            }

            .toast {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 1rem 1.25rem;
                border-radius: 0.5rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                animation: slideInRight 0.3s ease-out;
                min-width: 300px;
            }

            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(100px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes slideOutRight {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100px);
                }
            }

            .toast.success {
                background-color: #10b981;
                color: white;
            }

            .toast.error {
                background-color: #ef4444;
                color: white;
            }

            .toast.info {
                background-color: #3b82f6;
                color: white;
            }

            .toast-close {
                margin-left: auto;
                cursor: pointer;
                font-size: 1.25rem;
                line-height: 1;
                opacity: 0.7;
                transition: opacity 0.2s;
            }

            .toast-close:hover {
                opacity: 1;
            }
        </style>

        <livewire:styles />
    </head>
    <body class="bg-base-100 min-h-screen flex flex-col">
        <!-- Pass Laravel auth state to JavaScript -->
        <script>
            window.laravelUser = @json(auth()->check() ? auth()->user() : null);
        </script>
        
        <!-- Navigation Header -->
        <nav class="bg-base-100 shadow-lg sticky top-0 z-50">
            <div class="container mx-auto px-4 flex items-center justify-between h-16">
                <!-- Logo + Desktop Menu -->
                <div class="flex items-center gap-12">
                    <!-- Logo -->
                    <a href="{{ route('public.home') }}" class="text-2xl font-bold">
                        Jobtrackingsys
                    </a>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex gap-8 items-center">
                        <a href="{{ route('public.earn-money') }}" class="text-lg font-bold text-base-content/80 hover:text-primary transition">Earn Money</a>
                        <a href="{{ route('public.how-it-works') }}" class="text-lg font-bold text-base-content/80 hover:text-primary transition">How It Works</a>
                        <a href="{{ route('public.learn') }}" class="text-lg font-bold text-base-content/80 hover:text-primary transition">Learn</a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button class="btn btn-ghost btn-circle" onclick="document.getElementById('mobile_menu').classList.toggle('hidden')">
                        <span class="icon-[tabler--menu-2] size-6"></span>
                    </button>
                </div>

                <!-- Auth Container: Sign In or User Menu -->
                <div class="flex items-center gap-4">
                    <!-- Sign In (shown when not logged in) -->
                    <a id="signin_link" href="javascript:void(0);" onclick="openAuthModal(event)" class="text-base-content/80 hover:text-primary transition hidden md:inline">
                        Sign In
                    </a>

                    <!-- Mobile Sign In (shown when not logged in) -->
                    <button id="signin_btn_mobile" class="btn btn-ghost btn-circle md:hidden" onclick="openAuthModal(event)">
                        <span class="icon-[tabler--login] size-5"></span>
                    </button>

                    <!-- User Menu (shown when logged in) -->
                    <div id="user_menu" class="hidden">
                        <div class="dropdown">
                            <button class="text-base-content hover:text-primary transition font-semibold flex items-center gap-1" type="button" id="user-dropdown" data-dropdown-toggle="user-dropdown-menu" aria-haspopup="true" aria-expanded="false">
                                <span id="user_name">User</span>
                                <span class="icon-[tabler--chevron-down] size-4"></span>
                            </button>
                            <ul id="user-dropdown-menu" class="dropdown-menu dropdown-open:opacity-100 hidden" role="menu">
                                <li>
                                    <a class="dropdown-item text-sm" href="{{ route('dashboard.profile') }}">
                                        <span class="icon-[tabler--user] size-4"></span>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-sm" href="javascript:void(0);" onclick="handleLogout(event)">
                                        <span class="icon-[tabler--logout] size-4"></span>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile_menu" class="hidden md:hidden bg-base-100 border-t border-base-300">
                <div class="container mx-auto px-4 py-4 flex flex-col gap-4">
                    <a href="{{ route('public.earn-money') }}" class="text-base-content/80 hover:text-primary transition">Earn Money</a>
                    <a href="{{ route('public.how-it-works') }}" class="text-base-content/80 hover:text-primary transition">How It Works</a>
                    <a href="{{ route('public.learn') }}" class="text-base-content/80 hover:text-primary transition">Learn</a>
                    <a href="javascript:void(0);" onclick="openAuthModal(event)" class="text-base-content/80 hover:text-primary transition">Sign In</a>
                </div>
            </div>
        </nav>

        <!-- Main Content with Sidebar -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-64 bg-base-200 shadow-sm hidden md:flex flex-col border-r border-base-content/10">
                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-6 overflow-y-auto">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard.home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary transition {{ request()->routeIs('dashboard.home') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--home] size-5"></span>
                                <span class="font-semibold">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary transition {{ request()->routeIs('dashboard.profile') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--user] size-5"></span>
                                <span class="font-semibold">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.tasks') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary transition {{ request()->routeIs('dashboard.tasks') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--clipboard-list] size-5"></span>
                                <span class="font-semibold">Tasks</span>
                            </a>
                        </li>
                        {{-- Temporarily hidden
                        <li>
                            <a href="{{ route('dashboard.earnings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary transition {{ request()->routeIs('dashboard.earnings') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--wallet] size-5"></span>
                                <span class="font-semibold">Earnings</span>
                            </a>
                        </li>
                        --}}
                        {{-- Temporarily hidden
                        <li>
                            <a href="{{ route('dashboard.activity') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary transition {{ request()->routeIs('dashboard.activity') ? 'bg-primary text-white' : 'text-base-content' }}">
                                <span class="icon-[tabler--history] size-5"></span>
                                <span class="font-semibold">My Activity</span>
                            </a>
                        </li>
                        --}}
                        <li>
                            <a href="{{ route('dashboard.upgrade') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-warning/10 hover:text-warning transition {{ request()->routeIs('dashboard.upgrade') ? 'bg-warning text-white' : 'text-warning' }}">
                                <span class="icon-[tabler--crown] size-5"></span>
                                <span class="font-semibold">Upgrade Plan</span>
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
                <nav class="flex-1 px-4 py-6 overflow-y-auto">
                    <ul class="space-y-2">
                        <li><a href="{{ route('dashboard.home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary text-base-content transition">
                            <span class="icon-[tabler--home] size-5"></span>
                            <span class="font-semibold">Dashboard</span>
                        </a></li>
                        <li><a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary text-base-content transition">
                            <span class="icon-[tabler--user] size-5"></span>
                            <span class="font-semibold">Profile</span>
                        </a></li>
                        <li><a href="{{ route('dashboard.tasks') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary text-base-content transition">
                            <span class="icon-[tabler--clipboard-list] size-5"></span>
                            <span class="font-semibold">Tasks</span>
                        </a></li>
                        {{-- Temporarily hidden
                        <li><a href="{{ route('dashboard.earnings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary text-base-content transition">
                            <span class="icon-[tabler--wallet] size-5"></span>
                            <span class="font-semibold">Earnings</span>
                        </a></li>
                        --}}
                        {{-- Temporarily hidden
                        <li><a href="{{ route('dashboard.activity') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary text-base-content transition">
                            <span class="icon-[tabler--history] size-5"></span>
                            <span class="font-semibold">My Activity</span>
                        </a></li>
                        --}}
                        <li><a href="{{ route('dashboard.upgrade') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-warning/10 hover:text-warning text-warning transition">
                            <span class="icon-[tabler--crown] size-5"></span>
                            <span class="font-semibold">Upgrade Plan</span>
                        </a></li>
                    </ul>
                </nav>
                <div class="p-4 border-t border-base-300">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error">
                        <span class="icon-[tabler--logout] size-5"></span>
                        <span class="font-semibold">Logout</span>
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 overflow-auto">
                <div class="p-6 md:p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Footer -->
        <footer class="bg-base-200 text-base-content pt-12 pb-6">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <!-- Company Info -->
                    <div>
                        <h3 class="font-bold text-lg mb-4">
                            <span class="text-primary">Jobtrackingsys</span>
                        </h3>
                        <p class="text-sm text-base-content/70 mb-4">Empower yourself to earn money online with flexible tasks and projects on Jobtrackingsys.</p>
                        <div class="flex gap-3">
                            <a href="#" class="btn btn-ghost btn-sm btn-circle">
                                <span class="icon-[tabler--brand-facebook] size-5"></span>
                            </a>
                            <a href="#" class="btn btn-ghost btn-sm btn-circle">
                                <span class="icon-[tabler--brand-twitter] size-5"></span>
                            </a>
                            <a href="#" class="btn btn-ghost btn-sm btn-circle">
                                <span class="icon-[tabler--brand-instagram] size-5"></span>
                            </a>
                            <a href="#" class="btn btn-ghost btn-sm btn-circle">
                                <span class="icon-[tabler--brand-linkedin] size-5"></span>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-bold text-sm mb-4 uppercase">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="link link-hover">About Us</a></li>
                            <li><a href="#" class="link link-hover">How It Works</a></li>
                            <li><a href="#" class="link link-hover">Browse Tasks</a></li>
                            <li><a href="#" class="link link-hover">Pricing</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h4 class="font-bold text-sm mb-4 uppercase">Support</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="link link-hover">Help Center</a></li>
                            <li><a href="#" class="link link-hover">Contact Us</a></li>
                            <li><a href="#" class="link link-hover">FAQ</a></li>
                            <li><a href="#" class="link link-hover">Community</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h4 class="font-bold text-sm mb-4 uppercase">Legal</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="link link-hover">Privacy Policy</a></li>
                            <li><a href="#" class="link link-hover">Terms of Service</a></li>
                            <li><a href="#" class="link link-hover">Cookie Policy</a></li>
                            <li><a href="#" class="link link-hover">Disclaimer</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="pt-8 mt-8 border-t border-base-300">
                    <h4 class="font-bold text-sm mb-6 uppercase">Contact Us</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex items-start gap-3">
                            <span class="icon-[tabler--mail] size-6 text-primary mt-1"></span>
                            <div>
                                <p class="text-xs text-base-content/60 mb-1">Email</p>
                                <p class="font-semibold text-sm">support@Jobtrackingsys.com</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="icon-[tabler--phone] size-6 text-primary mt-1"></span>
                            <div>
                                <p class="text-xs text-base-content/60 mb-1">Phone</p>
                                <p class="font-semibold text-sm">+1 (555) 123-4567</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="icon-[tabler--map-pin] size-6 text-primary mt-1"></span>
                            <div>
                                <p class="text-xs text-base-content/60 mb-1">Address</p>
                                <p class="font-semibold text-sm">123 Main St, USA</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-base-300 pt-6 mt-8 flex flex-col md:flex-row justify-between items-center text-sm text-base-content/70">
                    <p>&copy; 2026 Jobtrackingsys. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Auth Modal -->
        <div id="auth_modal" class="auth-modal" onclick="if(event.target === this) closeAuthModal()">
            <div class="auth-modal-content">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="closeAuthModal()">✕</button>
                
                <h3 class="font-bold text-lg mb-6" style="padding: 1.5rem 1.5rem 0 1.5rem;">Sign In to Jobtrackingsys</h3>
                
                <form id="signin_form" onsubmit="handleSignin(event)" class="space-y-4 mb-6" style="padding: 0 1.5rem;">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" id="signin_email" name="email" placeholder="your@email.com" class="input input-bordered" required />
                        <span class="text-error text-sm hidden" id="signin_email_error"></span>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" id="signin_password" name="password" placeholder="••••••••" class="input input-bordered" required />
                        <span class="text-error text-sm hidden" id="signin_password_error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-full" id="signin_btn">Sign In</button>
                </form>

                <div class="divider text-xs" style="margin: 1.5rem;">OR</div>

                <!-- Social Login -->
                <div class="space-y-3 mb-6" style="padding: 0 1.5rem;">
                    <a href="{{ route('auth.google.redirect') }}" class="btn btn-outline w-full gap-2">
                        <span class="icon-[tabler--brand-google] size-5"></span>
                        Sign in with Google
                    </a>
                    <a href="{{ route('auth.facebook.redirect') }}" class="btn btn-outline w-full gap-2">
                        <span class="icon-[tabler--brand-facebook] size-5"></span>
                        Sign in with Facebook
                    </a>
                </div>

                <!-- Links -->
                <div class="flex flex-col gap-3 text-center text-sm" style="padding: 0 1.5rem 1.5rem 1.5rem;">
                    <a href="#" class="link link-primary">Forgot your password?</a>
                    <p class="text-base-content/70">Don't have an account? <a href="javascript:void(0);" onclick="closeAuthModal(); openSignupModal(event)" class="link link-primary font-semibold">Sign up</a></p>
                </div>
            </div>
        </div>

        <!-- Toast Container -->
        <div id="toast_container" class="toast-container"></div>

        <script>
            // Toast Notification Function
            function showToast(message, type = 'success', duration = 4000) {
                const container = document.getElementById('toast_container');
                const toast = document.createElement('div');
                toast.className = `toast ${type}`;
                
                let icon = '';
                if (type === 'success') {
                    icon = '<span class="icon-[tabler--check] size-5"></span>';
                } else if (type === 'error') {
                    icon = '<span class="icon-[tabler--x] size-5"></span>';
                } else if (type === 'info') {
                    icon = '<span class="icon-[tabler--info-circle] size-5"></span>';
                }
                
                toast.innerHTML = `
                    ${icon}
                    <span>${message}</span>
                    <span class="toast-close" onclick="this.parentElement.remove()">✕</span>
                `;
                
                container.appendChild(toast);
                
                // Auto remove after duration
                if (duration > 0) {
                    setTimeout(() => {
                        toast.style.animation = 'slideOutRight 0.3s ease-out forwards';
                        setTimeout(() => toast.remove(), 300);
                    }, duration);
                }
            }

            function openAuthModal(event) {
                if (event) event.preventDefault();
                const modal = document.getElementById('auth_modal');
                if (modal) {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeAuthModal() {
                const modal = document.getElementById('auth_modal');
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }

            function openSignupModal(event) {
                if (event) event.preventDefault();
                const modal = document.getElementById('signup_modal');
                if (modal) {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeSignupModal() {
                const modal = document.getElementById('signup_modal');
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }

            async function handleSignin(event) {
                event.preventDefault();
                
                const email = document.getElementById('signin_email').value;
                const password = document.getElementById('signin_password').value;
                const btn = document.getElementById('signin_btn');
                
                // Clear previous errors
                document.getElementById('signin_email_error').classList.add('hidden');
                document.getElementById('signin_password_error').classList.add('hidden');
                
                // Disable button
                btn.disabled = true;
                const originalText = btn.textContent;
                btn.textContent = 'Signing in...';
                
                try {
                    const response = await fetch('{{ route("auth.signin") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        },
                        body: JSON.stringify({
                            email: email,
                            password: password,
                        }),
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Store user data in localStorage
                        localStorage.setItem('user', JSON.stringify(data.user));
                        // Update header to show user name
                        updateUserMenu(data.user);
                        // Success - show toast and redirect
                        showToast('Signed in successfully!', 'success', 2000);
                        closeAuthModal();
                        document.getElementById('signin_form').reset();
                        // Redirect to dashboard after 1.5 seconds
                        setTimeout(() => {
                            window.location.href = '{{ route("dashboard.home") }}';
                        }, 1500);
                    } else {
                        // Show error
                        showToast(data.message || 'Sign in failed', 'error', 3000);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('An error occurred. Please try again.', 'error', 3000);
                } finally {
                    btn.disabled = false;
                    btn.textContent = originalText;
                }
            }

            // Update user menu in header
            function updateUserMenu(user) {
                const signinLink = document.getElementById('signin_link');
                const signinBtnMobile = document.getElementById('signin_btn_mobile');
                const userMenu = document.getElementById('user_menu');
                const userName = document.getElementById('user_name');
                
                // Hide sign in elements
                if (signinLink) signinLink.classList.add('!hidden');
                if (signinBtnMobile) signinBtnMobile.classList.add('!hidden');
                
                // Show user menu elements
                if (userMenu) {
                    userMenu.classList.remove('hidden');
                    userMenu.classList.add('flex');
                }
                
                // Set user name
                if (userName) userName.textContent = user.name;
            }

            // Check if user is logged in on page load
            function checkLoginStatus() {
                // Check if the page is a dashboard page
                const isDashboardPage = window.location.pathname.startsWith('/dashboard');
                
                if (isDashboardPage) {
                    // For dashboard pages, verify session with server
                    validateServerSession();
                } else {
                    // For non-dashboard pages, just check localStorage
                    if (window.laravelUser) {
                        updateUserMenu(window.laravelUser);
                        return;
                    }
                    
                    const user = localStorage.getItem('user');
                    if (user) {
                        try {
                            const userData = JSON.parse(user);
                            updateUserMenu(userData);
                        } catch (e) {
                            console.error('Error parsing user data:', e);
                        }
                    }
                }
            }

            // Validate session with server
            async function validateServerSession() {
                try {
                    const response = await fetch('{{ route("auth.validate-session") }}', {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    });

                    const data = await response.json();

                    if (data.authenticated && data.user) {
                        // Session is valid
                        updateUserMenu(data.user);
                        localStorage.setItem('user', JSON.stringify(data.user));
                    } else {
                        // Session expired
                        localStorage.removeItem('user');
                        showToast('Session expired. Redirecting to login...', 'error', 2000);
                        setTimeout(() => {
                            window.location.href = '{{ route("public.home") }}';
                        }, 2000);
                    }
                } catch (error) {
                    console.error('Session validation error:', error);
                    // If validation fails, clear user and redirect
                    localStorage.removeItem('user');
                    showToast('Session validation failed. Redirecting to login...', 'error', 2000);
                    setTimeout(() => {
                        window.location.href = '{{ route("public.home") }}';
                    }, 2000);
                }
            }
                        updateUserMenu(userData);
                    } catch (e) {
                        console.error('Error parsing user data:', e);
                    }
                }
            }

            // Logout function
            async function handleLogout(event) {
                event.preventDefault();
                
                try {
                    const response = await fetch('{{ route("auth.logout") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        },
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Clear user data from localStorage
                        localStorage.removeItem('user');
                        // Reset header
                        resetUserMenu();
                        // Show toast
                        showToast('Logged out successfully!', 'success', 2000);
                        // Redirect to home
                        setTimeout(() => {
                            window.location.href = '{{ route("public.home") }}';
                        }, 1500);
                    } else {
                        showToast('Logout failed', 'error', 3000);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('An error occurred. Please try again.', 'error', 3000);
                }
            }

            // Reset user menu back to sign in
            function resetUserMenu() {
                const signinLink = document.getElementById('signin_link');
                const signinBtnMobile = document.getElementById('signin_btn_mobile');
                const userMenu = document.getElementById('user_menu');
                
                // Show sign in, hide user menu
                signinLink.classList.remove('hidden');
                signinBtnMobile.classList.remove('hidden');
                userMenu.classList.add('hidden');
                userMenu.classList.remove('flex');
            }

            // Close modals with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeAuthModal();
                    closeSignupModal();
                }
            });

            // Check login status on page load
            window.addEventListener('DOMContentLoaded', function() {
                checkLoginStatus();
            });
        </script>

        <livewire:scripts />
        
        @stack('scripts')
    </body>
</html>
