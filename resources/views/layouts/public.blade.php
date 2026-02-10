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
        <nav class="navbar bg-base-100 shadow-lg sticky top-0 z-50">
            <div class="flex-1">
                <a href="{{ route('public.home') }}" class="btn btn-ghost normal-case text-2xl font-bold">
                    <span class="text-primary">Flyon</span>
                </a>
            </div>
            <div class="flex-none gap-4 hidden md:flex">
                <a href="#earn" class="btn btn-ghost">Earn Money</a>
                <a href="#how-it-works" class="btn btn-ghost">How It Works</a>
                <a href="#learn" class="btn btn-ghost">Learn</a>
            </div>
            <div class="flex-none gap-2">
                <button class="btn btn-ghost" onclick="document.getElementById('auth_modal').classList.toggle('modal-open')">
                    <span class="icon-[tabler--login] size-5"></span>
                </button>
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
                <div class="bg-base-300 rounded-lg p-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex items-center gap-3">
                            <span class="icon-[tabler--mail] size-6 text-primary"></span>
                            <div>
                                <p class="text-xs text-base-content/60">Email</p>
                                <p class="font-semibold">support@jobtrackingsys.com</p>
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
            <div class="modal-box w-11/12 max-w-sm">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('auth_modal').classList.toggle('modal-open')">✕</button>
                <h3 class="font-bold text-lg mb-4">Sign In to Flyon</h3>
                
                <div class="space-y-4">
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

                <div class="space-y-2">
                    <p class="text-sm text-center text-base-content/70">Don't have an account?</p>
                    <button class="btn btn-outline w-full">Create Account</button>
                </div>
            </div>
            <div class="modal-backdrop" onclick="document.getElementById('auth_modal').classList.toggle('modal-open')"></div>
        </div>

        <livewire:scripts />
    </body>
</html>
