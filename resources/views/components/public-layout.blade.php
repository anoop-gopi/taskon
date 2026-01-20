<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <title>{{ config('app.name', 'Taskon') }} - Earn Money Online</title>

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
        </style>
    </head>
    <body class="bg-base-100 min-h-screen">
        <!-- Navigation Header -->
        <nav class="bg-base-100 shadow-lg sticky top-0 z-50">
            <div class="container mx-auto px-4 flex items-center justify-between h-16">
                <!-- Logo + Desktop Menu -->
                <div class="flex items-center gap-12">
                    <!-- Logo -->
                    <a href="{{ route('public.home') }}" class="text-2xl font-bold">
                        Taskon
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

                <!-- Sign In -->
                <a href="javascript:void(0);" onclick="openAuthModal(event)" class="text-base-content/80 hover:text-primary transition hidden md:inline">
                    Sign In
                </a>

                <!-- Mobile Sign In -->
                <button class="btn btn-ghost btn-circle md:hidden" onclick="openAuthModal(event)">
                    <span class="icon-[tabler--login] size-5"></span>
                </button>
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
                            <span class="text-primary">Taskon</span>
                        </h3>
                        <p class="text-sm text-base-content/70 mb-4">Empower yourself to earn money online with flexible tasks and projects on Taskon.</p>
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
                <div class="bg-base-100 border border-base-300 rounded-lg p-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex items-center gap-3">
                            <span class="icon-[tabler--mail] size-6 text-primary"></span>
                            <div>
                                <p class="text-xs text-base-content/60">Email</p>
                                <p class="font-semibold">support@flyon.com</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="icon-[tabler--phone] size-6 text-primary"></span>
                            <div>
                                <p class="text-xs text-base-content/60">Phone</p>
                                <p class="font-semibold">+1 (555) 123-4567</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="icon-[tabler--map-pin] size-6 text-primary"></span>
                            <div>
                                <p class="text-xs text-base-content/60">Address</p>
                                <p class="font-semibold">123 Main St, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Auth Modal -->
        <div id="auth_modal" class="auth-modal" onclick="if(event.target === this) closeAuthModal()">
            <div class="auth-modal-content">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="closeAuthModal()">✕</button>
                
                <h3 class="font-bold text-lg mb-6" style="padding: 1.5rem 1.5rem 0 1.5rem;">Sign In to Taskon</h3>
                
                <div class="space-y-4 mb-6" style="padding: 0 1.5rem;">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" placeholder="your@email.com" class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" placeholder="••••••••" class="input input-bordered" />
                    </div>
                    <button class="btn btn-primary w-full">Sign In</button>
                </div>

                <div class="divider text-xs" style="margin: 1.5rem;">OR</div>

                <!-- Social Login -->
                <div class="space-y-3 mb-6" style="padding: 0 1.5rem;">
                    <button class="btn btn-outline w-full gap-2">
                        <span class="icon-[tabler--brand-google] size-5"></span>
                        Sign in with Google
                    </button>
                    <button class="btn btn-outline w-full gap-2">
                        <span class="icon-[tabler--brand-facebook] size-5"></span>
                        Sign in with Facebook
                    </button>
                </div>

                <!-- Links -->
                <div class="flex flex-col gap-3 text-center text-sm" style="padding: 0 1.5rem 1.5rem 1.5rem;">
                    <a href="#" class="link link-primary">Forgot your password?</a>
                    <p class="text-base-content/70">Don't have an account? <a href="javascript:void(0);" onclick="closeAuthModal(); openSignupModal(event)" class="link link-primary font-semibold">Sign up</a></p>
                </div>
            </div>
        </div>

        <script>
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

            // Close modals with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeAuthModal();
                    closeSignupModal();
                }
            });
        </script>

        <livewire:scripts />
    </body>
</html>
