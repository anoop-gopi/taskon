<x-dashboard-layout>
  <!-- Success Message -->
  @if(session('success'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-success shadow-lg">
        <span class="icon-[tabler--check] size-5"></span>
        <span>{{ session('success') }}</span>
      </div>
    </div>
  @endif

  <!-- Hero Section -->
  <section class="bg-primary text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-bold">My Profile</h1>
      <p class="text-white/80 mt-2">Manage your account and personal information</p>
    </div>
  </section>

  <!-- Content Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4 max-w-4xl">
      <div class="grid md:grid-cols-3 gap-6 mb-8">
        <!-- Profile Card -->
        <div class="md:col-span-1">
          <div class="card bg-base-100 shadow-lg border border-primary/20">
            <div class="card-body text-center">
              <div class="w-24 h-24 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="icon-[tabler--user] size-12 text-white"></span>
              </div>
              <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
              <p class="text-base-content/70 text-sm">{{ $user->category->name }} Member</p>
              <div class="mt-6 pt-6 border-t border-base-300">
                <div class="flex justify-center gap-4">
                  <div class="text-center">
                    <p class="text-2xl font-bold text-primary">24</p>
                    <p class="text-xs text-base-content/60">Tasks Completed</p>
                  </div>
                  <div class="text-center">
                    <p class="text-2xl font-bold text-primary">4.8</p>
                    <p class="text-xs text-base-content/60">Rating</p>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary w-full mt-6">Edit Profile Picture</button>
            </div>
          </div>
        </div>

        <!-- Personal Information -->
        <div class="md:col-span-2 space-y-6">
          <!-- Personal Details Card -->
          <div class="card bg-base-100 shadow-lg border border-primary/20">
            <div class="card-body">
              <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold">Personal Information</h3>
                <button class="btn btn-sm btn-ghost gap-2">
                  <span class="icon-[tabler--edit] size-4"></span>
                  Edit
                </button>
              </div>

              <div class="grid md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Full Name</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->name }}</p>
                </div>

                <!-- Email -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Email Address</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->email }}</p>
                </div>

                <!-- Company Name -->
                @if($user->company_name)
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Company Name</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->company_name }}</p>
                </div>
                @endif

                <!-- Member Since -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Member Since</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Contact Information Card -->
          <div class="card bg-base-100 shadow-lg border border-primary/20">
            <div class="card-body">
              <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold">Contact Information</h3>
                <button class="btn btn-sm btn-ghost gap-2">
                  <span class="icon-[tabler--edit] size-4"></span>
                  Edit
                </button>
              </div>

              <div class="grid md:grid-cols-2 gap-6">
                <!-- Phone -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Primary Phone</span>
                  </label>
                  <p class="text-base font-medium text-base-content">+1 (555) 123-4567</p>
                </div>

                <!-- Alternative Email -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Alternative Email</span>
                  </label>
                  <p class="text-base font-medium text-base-content">john.alternative@example.com</p>
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Address</span>
                  </label>
                  <p class="text-base font-medium text-base-content">123 Main Street, New York, NY 10001</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Payment Information -->
      <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Payment Methods Card -->
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-xl font-bold">Payment Methods</h3>
            </div>

            <div class="space-y-4">
              <!-- Crypto Wallet (USDT) -->
              <div class="border-2 border-warning/30 bg-warning/5 rounded-lg p-4">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-12 h-12 bg-warning/20 rounded-lg flex items-center justify-center">
                    <span class="icon-[tabler--currency-dollar] size-6 text-warning"></span>
                  </div>
                  <div class="flex-1">
                    <p class="font-semibold flex items-center gap-2">
                      USDT Wallet (TRC20)
                      <span class="badge badge-warning badge-sm">Crypto</span>
                    </p>
                    @if($user->crypto_wallet)
                      <p class="text-sm text-base-content/70 font-mono break-all">{{ $user->crypto_wallet }}</p>
                    @else
                      <p class="text-sm text-base-content/50 italic">Not configured</p>
                    @endif
                  </div>
                </div>
                
                <form action="{{ route('dashboard.profile.update-wallet') }}" method="POST" class="space-y-3">
                  @csrf
                  <div class="form-control">
                    <label class="label">
                      <span class="label-text text-sm">
                        <span class="icon-[tabler--info-circle] size-4 inline"></span>
                        Enter your USDT (TRC20) wallet address
                      </span>
                    </label>
                    <input 
                      type="text" 
                      name="crypto_wallet" 
                      value="{{ old('crypto_wallet', $user->crypto_wallet) }}"
                      class="input input-bordered input-sm w-full font-mono" 
                      placeholder="TRC20 wallet address (e.g., TXXXxxx...)"
                    />
                    @error('crypto_wallet')
                      <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                      </label>
                    @enderror
                  </div>
                  
                  <div class="flex gap-2">
                    <button type="submit" class="btn btn-warning btn-sm gap-2">
                      <span class="icon-[tabler--check] size-4"></span>
                      {{ $user->crypto_wallet ? 'Update' : 'Add' }} Wallet
                    </button>
                    @if($user->crypto_wallet)
                      <button 
                        type="submit" 
                        name="crypto_wallet" 
                        value="" 
                        class="btn btn-ghost btn-sm text-error"
                        onclick="return confirm('Are you sure you want to remove your crypto wallet?')"
                      >
                        Remove
                      </button>
                    @endif
                  </div>
                </form>
                
                <div class="alert alert-info mt-4">
                  <span class="icon-[tabler--alert-circle] size-4"></span>
                  <span class="text-xs">
                    <strong>Important:</strong> Only TRC20 (Tron) USDT addresses are supported. 
                    Double-check your address before saving to avoid loss of funds.
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Account Security Card -->
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <h3 class="text-xl font-bold mb-6">Account Security</h3>

            <div class="space-y-4">
              <!-- Password -->
              <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg">
                <div>
                  <p class="font-semibold">Password</p>
                  <p class="text-sm text-base-content/70">Last changed 3 months ago</p>
                </div>
                <button class="btn btn-sm btn-ghost">Change</button>
              </div>

              <!-- Two-Factor Authentication -->
              <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg">
                <div>
                  <p class="font-semibold">Two-Factor Authentication</p>
                  <p class="text-sm text-base-content/70">Not enabled</p>
                </div>
                <button class="btn btn-sm btn-primary">Enable</button>
              </div>

              <!-- Email Verification -->
              <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg">
                <div>
                  <p class="font-semibold">Email Verification</p>
                  <p class="text-sm text-base-content/70">Verified on Jan 10, 2026</p>
                </div>
                <div class="badge badge-success gap-1">
                  <span class="icon-[tabler--check] size-4"></span>
                  Verified
                </div>
              </div>

              <!-- Phone Verification -->
              <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg">
                <div>
                  <p class="font-semibold">Phone Verification</p>
                  <p class="text-sm text-base-content/70">Verified on Jan 15, 2026</p>
                </div>
                <div class="badge badge-success gap-1">
                  <span class="icon-[tabler--check] size-4"></span>
                  Verified
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Account Settings -->
      <div class="card bg-base-100 shadow-lg border border-primary/20">
        <div class="card-body">
          <h3 class="text-xl font-bold mb-6">Account Settings</h3>

          <div class="space-y-4">
            <!-- Notifications -->
            <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg hover:bg-base-200 transition">
              <div class="flex items-center gap-3">
                <span class="icon-[tabler--bell] size-6 text-primary"></span>
                <div>
                  <p class="font-semibold">Notification Preferences</p>
                  <p class="text-sm text-base-content/70">Manage how you receive notifications</p>
                </div>
              </div>
              <button class="btn btn-sm btn-ghost">Manage</button>
            </div>

            <!-- Privacy -->
            <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg hover:bg-base-200 transition">
              <div class="flex items-center gap-3">
                <span class="icon-[tabler--lock] size-6 text-primary"></span>
                <div>
                  <p class="font-semibold">Privacy Settings</p>
                  <p class="text-sm text-base-content/70">Control your profile visibility</p>
                </div>
              </div>
              <button class="btn btn-sm btn-ghost">Manage</button>
            </div>

            <!-- Language -->
            <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg hover:bg-base-200 transition">
              <div class="flex items-center gap-3">
                <span class="icon-[tabler--language] size-6 text-primary"></span>
                <div>
                  <p class="font-semibold">Language</p>
                  <p class="text-sm text-base-content/70">Currently: English</p>
                </div>
              </div>
              <button class="btn btn-sm btn-ghost">Change</button>
            </div>

            <!-- Danger Zone -->
            <div class="flex items-center justify-between p-4 border border-error/30 rounded-lg bg-error/5 hover:bg-error/10 transition">
              <div class="flex items-center gap-3">
                <span class="icon-[tabler--trash] size-6 text-error"></span>
                <div>
                  <p class="font-semibold text-error">Delete Account</p>
                  <p class="text-sm text-base-content/70">Permanently delete your account and data</p>
                </div>
              </div>
              <button class="btn btn-sm btn-error">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-dashboard-layout>
