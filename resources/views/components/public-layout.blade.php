<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <title>{{ config('app.name', 'Jobtrackingsys') }} - Earn Money Online</title>

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
    </head>
    <body class="bg-base-100 min-h-screen">
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
                    
                    <!-- Mobile Sign In link (shown when not logged in) -->
                    <a id="mobile_signin_link" href="javascript:void(0);" onclick="openAuthModal(event)" class="text-base-content/80 hover:text-primary transition">Sign In</a>
                    
                    <!-- Mobile User Menu (shown when logged in) -->
                    <div id="mobile_user_menu" class="hidden flex flex-col gap-2 border-t border-base-300 pt-2">
                        <div class="text-base-content font-medium px-2 py-1">
                            <span id="mobile_user_name">User</span>
                        </div>
                        <a href="{{ route('dashboard.profile') }}" class="text-base-content/80 hover:text-primary transition px-2">Profile</a>
                        <a href="javascript:void(0);" onclick="handleLogout(event)" class="text-base-content/80 hover:text-primary transition px-2">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-base-200 text-base-content pt-12 pb-6 mt-20">
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
                            <li><a href="{{ route('public.how-it-works') }}" class="link link-hover">How It Works</a></li>
                            <li><a href="{{ route('public.earn-money') }}" class="link link-hover">Earn Money</a></li>
                            <li><a href="{{ route('public.learn') }}" class="link link-hover">Learn</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h4 class="font-bold text-sm mb-4 uppercase">Support</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('public.help-center') }}" class="link link-hover">Help Center</a></li>
                            <li><a href="{{ route('public.contact') }}" class="link link-hover">Contact Us</a></li>
                            <li><a href="{{ route('public.faq') }}" class="link link-hover">FAQ</a></li>
                            <li><a href="{{ route('public.community') }}" class="link link-hover">Community</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h4 class="font-bold text-sm mb-4 uppercase">Legal</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('public.privacy-policy') }}" class="link link-hover">Privacy Policy</a></li>
                            <li><a href="{{ route('public.terms') }}" class="link link-hover">Terms of Service</a></li>
                            <li><a href="{{ route('public.cookie-policy') }}" class="link link-hover">Cookie Policy</a></li>
                            <li><a href="{{ route('public.disclaimer') }}" class="link link-hover">Disclaimer</a></li>
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
                                <p class="font-semibold text-sm">support@jobtrackingsys.com</p>
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
                <div class="border-t border-base-300 pt-6 mt-8 text-center text-sm text-base-content/60">
                    <p>&copy; {{ date('Y') }} Jobtrackingsys. All rights reserved.</p>
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

        <!-- Signup Modal -->
        <div id="signup_modal" class="auth-modal" onclick="if(event.target === this) closeSignupModal()">
            <div class="auth-modal-content">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="closeSignupModal()">✕</button>
                
                <h3 class="font-bold text-lg mb-6" style="padding: 1.5rem 1.5rem 0 1.5rem;">Create Your Account</h3>
                
                <form id="signup_form" onsubmit="handleSignup(event)" class="space-y-4 mb-6" style="padding: 0 1.5rem;">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Full Name</span>
                        </label>
                        <input type="text" id="signup_name" name="name" placeholder="John Doe" class="input input-bordered" required />
                        <span class="text-error text-sm hidden" id="signup_name_error"></span>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Company Name</span>
                        </label>
                        <input type="text" id="signup_company_name" name="company_name" placeholder="Your Company" class="input input-bordered" required />
                        <span class="text-error text-sm hidden" id="signup_company_name_error"></span>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" id="signup_email" name="email" placeholder="your@email.com" class="input input-bordered" required />
                        <span class="text-error text-sm hidden" id="signup_email_error"></span>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" id="signup_password" name="password" placeholder="••••••••" class="input input-bordered" required />
                        <span class="text-error text-sm hidden" id="signup_password_error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-full" id="signup_btn">Create Account</button>
                </form>

                <div class="divider text-xs" style="margin: 1.5rem;">OR</div>

                <!-- Social Signup -->
                <div class="space-y-3 mb-6" style="padding: 0 1.5rem;">
                    <button class="btn btn-outline w-full gap-2">
                        <span class="icon-[tabler--brand-google] size-5"></span>
                        Sign up with Google
                    </button>
                    <button class="btn btn-outline w-full gap-2">
                        <span class="icon-[tabler--brand-facebook] size-5"></span>
                        Sign up with Facebook
                    </button>
                </div>

                <!-- Links -->
                <p class="text-center text-sm text-base-content/70" style="padding: 0 1.5rem 1.5rem 1.5rem;">Already have an account? <a href="javascript:void(0);" onclick="closeSignupModal(); openAuthModal(event)" class="link link-primary font-semibold">Sign in</a></p>
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
                        credentials: 'same-origin',
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

            async function handleSignup(event) {
                event.preventDefault();
                
                const name = document.getElementById('signup_name').value;
                const companyName = document.getElementById('signup_company_name').value;
                const email = document.getElementById('signup_email').value;
                const password = document.getElementById('signup_password').value;
                const btn = document.getElementById('signup_btn');
                
                // Clear previous errors
                document.getElementById('signup_name_error').classList.add('hidden');
                document.getElementById('signup_company_name_error').classList.add('hidden');
                document.getElementById('signup_email_error').classList.add('hidden');
                document.getElementById('signup_password_error').classList.add('hidden');
                
                // Disable button
                btn.disabled = true;
                const originalText = btn.textContent;
                btn.textContent = 'Creating...';
                
                try {
                    const response = await fetch('{{ route("auth.signup") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            name: name,
                            company_name: companyName,
                            email: email,
                            password: password,
                        }),
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Success - show toast with approval message
                        showToast(data.message || 'Account created! Awaiting admin approval.', 'info', 5000);
                        closeSignupModal();
                        document.getElementById('signup_form').reset();
                        // Don't redirect - user needs to wait for approval
                    } else {
                        // Show errors
                        if (data.errors) {
                            if (data.errors.name) {
                                document.getElementById('signup_name_error').textContent = data.errors.name[0];
                                document.getElementById('signup_name_error').classList.remove('hidden');
                            }
                            if (data.errors.company_name) {
                                document.getElementById('signup_company_name_error').textContent = data.errors.company_name[0];
                                document.getElementById('signup_company_name_error').classList.remove('hidden');
                            }
                            if (data.errors.email) {
                                document.getElementById('signup_email_error').textContent = data.errors.email[0];
                                document.getElementById('signup_email_error').classList.remove('hidden');
                            }
                            if (data.errors.password) {
                                document.getElementById('signup_password_error').textContent = data.errors.password[0];
                                document.getElementById('signup_password_error').classList.remove('hidden');
                            }
                            showToast('Please fix the errors above', 'error', 3000);
                        } else {
                            showToast(data.message || 'Signup failed', 'error', 3000);
                        }
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
                const mobileSigninLink = document.getElementById('mobile_signin_link');
                const mobileUserMenu = document.getElementById('mobile_user_menu');
                const mobileUserName = document.getElementById('mobile_user_name');
                
                // Hide sign in elements
                if (signinLink) signinLink.classList.add('!hidden');
                if (signinBtnMobile) signinBtnMobile.classList.add('!hidden');
                if (mobileSigninLink) mobileSigninLink.classList.add('!hidden');
                
                // Show user menu elements
                if (userMenu) {
                    userMenu.classList.remove('hidden');
                    userMenu.classList.add('flex', 'items-center');
                }
                if (mobileUserMenu) {
                    mobileUserMenu.classList.remove('hidden');
                    mobileUserMenu.classList.add('flex');
                }
                
                // Set user name
                if (userName) userName.textContent = user.name;
                if (mobileUserName) mobileUserName.textContent = user.name;
            }

            // Check if user is logged in on page load
            function checkLoginStatus() {
                // First check if Laravel has an authenticated user
                if (window.laravelUser) {
                    // Sync Laravel session to localStorage
                    localStorage.setItem('user', JSON.stringify(window.laravelUser));
                    updateUserMenu(window.laravelUser);
                    return;
                }
                
                // Otherwise check localStorage
                const user = localStorage.getItem('user');
                if (user) {
                    try {
                        const userData = JSON.parse(user);
                        updateUserMenu(userData);
                    } catch (e) {
                        console.error('Error parsing user data:', e);
                        localStorage.removeItem('user');
                    }
                } else {
                    // Ensure sign in is visible if no user
                    resetUserMenu();
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
                        credentials: 'same-origin',
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
                const mobileSigninLink = document.getElementById('mobile_signin_link');
                const mobileUserMenu = document.getElementById('mobile_user_menu');
                
                // Show sign in elements
                if (signinLink) signinLink.classList.remove('!hidden');
                if (signinBtnMobile) signinBtnMobile.classList.remove('!hidden');
                if (mobileSigninLink) mobileSigninLink.classList.remove('!hidden');
                
                // Hide user menu elements
                if (userMenu) {
                    userMenu.classList.add('hidden');
                    userMenu.classList.remove('flex', 'items-center');
                }
                if (mobileUserMenu) {
                    mobileUserMenu.classList.add('hidden');
                    mobileUserMenu.classList.remove('flex');
                }
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
                // Check if session expired
                const params = new URLSearchParams(window.location.search);
                if (params.get('session_expired') === '1') {
                    // Remove the parameter from URL without reloading
                    window.history.replaceState({}, document.title, window.location.pathname);
                    
                    // Clear localStorage FIRST
                    localStorage.removeItem('user');
                    
                    // Reset the menu to show Sign In
                    resetUserMenu();
                    
                    // Show session expired message
                    showToast('Your session has expired. Please sign in again.', 'error', 5000);
                    
                    // Skip checkLoginStatus since we already reset everything
                    return;
                }
                
                checkLoginStatus();
                
                // Initialize FlyonUI dropdowns if library is available
                if (typeof HSDropdown !== 'undefined') {
                    HSDropdown.autoInit();
                }
            });
        </script>

        <livewire:scripts />
    </body>
</html>
