<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'FlyonUI') }} - Earn Money Online</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <livewire:styles />
    </head>
    <body class="bg-base-100 min-h-screen">
        <!-- Navigation Header -->
        <nav class="bg-base-100 shadow-lg sticky top-0 z-50">
            <div class="container mx-auto px-4 flex items-center justify-between h-16">
                <!-- Logo + Desktop Menu -->
                <div class="flex items-center gap-12">
                    <!-- Logo -->
                    <a href="{{ route('public.home') }}" class="text-2xl font-bold">
                        Flyon
                    </a>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex gap-8 items-center">
                        <a href="#earn" class="text-lg font-bold text-base-content/80 hover:text-primary transition">Earn Money</a>
                        <a href="#how-it-works" class="text-lg font-bold text-base-content/80 hover:text-primary transition">How It Works</a>
                        <a href="#learn" class="text-lg font-bold text-base-content/80 hover:text-primary transition">Learn</a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button class="btn btn-ghost btn-circle" onclick="document.getElementById('mobile_menu').classList.toggle('hidden')">
                        <span class="icon-[tabler--menu-2] size-6"></span>
                    </button>
                </div>

                <!-- Sign In -->
                <a href="#" onclick="document.getElementById('auth_modal').classList.add('modal-open')" class="text-base-content/80 hover:text-primary transition hidden md:inline">
                    Sign In
                </a>

                <!-- Mobile Sign In -->
                <button class="btn btn-ghost btn-circle md:hidden" onclick="document.getElementById('auth_modal').classList.add('modal-open')">
                    <span class="icon-[tabler--login] size-5"></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile_menu" class="hidden md:hidden bg-base-100 border-t border-base-300">
                <div class="container mx-auto px-4 py-4 flex flex-col gap-4">
                    <a href="#earn" class="text-base-content/80 hover:text-primary transition">Earn Money</a>
                    <a href="#how-it-works" class="text-base-content/80 hover:text-primary transition">How It Works</a>
                    <a href="#learn" class="text-base-content/80 hover:text-primary transition">Learn</a>
                    <a href="#" onclick="document.getElementById('auth_modal').classList.add('modal-open')" class="text-base-content/80 hover:text-primary transition">Sign In</a>
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
                            <span class="text-primary">Flyon</span>
                        </h3>
                        <p class="text-sm text-base-content/70 mb-4">Empower yourself to earn money online with flexible tasks and projects.</p>
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
        <div class="modal" id="auth_modal">
            <div class="modal-box w-11/12 max-w-md">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('auth_modal').classList.remove('modal-open')">✕</button>
                
                <!-- Tabs -->
                <div class="tabs tabs-bordered mb-6" role="tablist">
                    <input type="radio" name="auth_tabs" role="tab" class="tab" aria-label="Sign In" checked onchange="switchAuthTab('signin')" />
                    <div role="tabpanel" class="tab-content">
                        <h3 class="font-bold text-lg mb-6">Sign In to Flyon</h3>
                        
                        <div class="space-y-4 mb-6">
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

                        <div class="divider text-xs">OR</div>

                        <!-- Social Login -->
                        <div class="space-y-3 mb-6">
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
                        <div class="flex flex-col gap-3 text-center text-sm">
                            <a href="#" class="link link-primary">Forgot your password?</a>
                            <p class="text-base-content/70">Don't have an account? <a href="#" class="link link-primary font-semibold">Sign up</a></p>
                        </div>
                    </div>

                    <input type="radio" name="auth_tabs" role="tab" class="tab" aria-label="Sign Up" onchange="switchAuthTab('signup')" />
                    <div role="tabpanel" class="tab-content">
                        <h3 class="font-bold text-lg mb-6">Create Your Account</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Full Name</span>
                                </label>
                                <input type="text" placeholder="John Doe" class="input input-bordered" />
                            </div>
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
                            <button class="btn btn-primary w-full">Create Account</button>
                        </div>

                        <div class="divider text-xs">OR</div>

                        <!-- Social Signup -->
                        <div class="space-y-3 mb-6">
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
                        <p class="text-center text-sm text-base-content/70">Already have an account? <a href="#" class="link link-primary font-semibold">Sign in</a></p>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop" onclick="document.getElementById('auth_modal').classList.remove('modal-open')"></div>
        </div>

        <script>
            function switchAuthTab(tab) {
                // Tab switching is handled by the radio button's onchange event
            }
        </script>

        <livewire:scripts />
    </body>
</html>
