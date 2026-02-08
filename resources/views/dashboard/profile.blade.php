<x-dashboard-layout>
  <!-- Success/Error Messages -->
  @if(session('success'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-success shadow-lg">
        <span class="icon-[tabler--check] size-5"></span>
        <span>{{ session('success') }}</span>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-error shadow-lg">
        <span class="icon-[tabler--x] size-5"></span>
        <span>{{ session('error') }}</span>
      </div>
    </div>
  @endif

  @if($errors->any())
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-error shadow-lg">
        <span class="icon-[tabler--alert-circle] size-5"></span>
        <div>
          <div class="font-semibold">Please fix the following errors:</div>
          <ul class="list-disc list-inside mt-1">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
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
                <button onclick="togglePersonalEdit()" class="btn btn-sm btn-ghost gap-2" id="personal-edit-btn">
                  <span class="icon-[tabler--edit] size-4"></span>
                  Edit
                </button>
              </div>

              <!-- Display Mode -->
              <div id="personal-display" class="grid md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Full Name</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->name }}</p>
                </div>

                <!-- Company Name -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Company Name</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->company_name ?? 'Not provided' }}</p>
                </div>
              </div>

              <!-- Edit Mode -->
              <form id="personal-edit" action="{{ route('dashboard.profile.update-personal') }}" method="POST" class="hidden space-y-4">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                  <!-- Full Name -->
                  <div>
                    <label class="label">
                      <span class="label-text font-semibold text-base-content/80">Full Name</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full" required>
                  </div>

                  <!-- Company Name -->
                  <!-- Company Name -->
                  <div>
                    <label class="label">
                      <span class="label-text font-semibold text-base-content/80">Company Name</span>
                    </label>
                    <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" class="input input-bordered w-full">
                  </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                  <button type="button" onclick="togglePersonalEdit()" class="btn btn-ghost">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Contact Information Card -->
          <div class="card bg-base-100 shadow-lg border border-primary/20">
            <div class="card-body">
              <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold">Contact Information</h3>
                <button onclick="toggleContactEdit()" class="btn btn-sm btn-ghost gap-2" id="contact-edit-btn">
                  <span class="icon-[tabler--edit] size-4"></span>
                  Edit
                </button>
              </div>

              <!-- Display Mode -->
              <div id="contact-display" class="grid md:grid-cols-2 gap-6">
                <!-- Phone Number -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Phone Number</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->phone ?? 'Not provided' }}</p>
                </div>

                <!-- Alternative Email -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Alternative Email</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->alternative_email ?? 'Not provided' }}</p>
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Address</span>
                  </label>
                  <p class="text-base font-medium text-base-content">{{ $user->address ?? 'Not provided' }}</p>
                </div>
              </div>

              <!-- Edit Mode -->
              <form id="contact-edit" action="{{ route('dashboard.profile.update-contact') }}" method="POST" class="hidden space-y-4">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                  <!-- Phone Number -->
                  <div>
                    <label class="label">
                      <span class="label-text font-semibold text-base-content/80">Phone Number</span>
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input input-bordered w-full">
                  </div>

                  <!-- Alternative Email -->
                  <div>
                    <label class="label">
                      <span class="label-text font-semibold text-base-content/80">Alternative Email</span>
                    </label>
                    <input type="email" name="alternative_email" value="{{ old('alternative_email', $user->alternative_email) }}" class="input input-bordered w-full">
                  </div>

                  <!-- Address -->
                  <div class="md:col-span-2">
                    <label class="label">
                      <span class="label-text font-semibold text-base-content/80">Address</span>
                    </label>
                    <textarea name="address" class="textarea textarea-bordered w-full" rows="3">{{ old('address', $user->address) }}</textarea>
                  </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                  <button type="button" onclick="toggleContactEdit()" class="btn btn-ghost">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Account Security Card -->
          <div class="card bg-base-100 shadow-lg border border-primary/20">
            <div class="card-body">
              <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold">Account Security</h3>
                <button onclick="togglePasswordEdit()" class="btn btn-sm btn-primary gap-2" id="password-edit-btn">
                  <span class="icon-[tabler--lock] size-4"></span>
                  Change
                </button>
              </div>

              <!-- Display Mode -->
              <div id="password-display">
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Password</span>
                  </label>
                  <p class="text-base font-medium text-base-content">••••••••</p>
                  <p class="text-sm text-base-content/60 mt-1">Last updated: Recently</p>
                </div>
              </div>

              <!-- Edit Mode -->
              <form id="password-edit" action="{{ route('dashboard.profile.update-password') }}" method="POST" class="hidden space-y-4">
                @csrf
                <div class="space-y-4">
                  <!-- Current Password -->
                  <div>
                    <label class="label">
                      <span class="label-text font-semibold text-base-content/80">Current Password</span>
                    </label>
                    <input type="password" name="current_password" class="input input-bordered w-full" required>
                  </div>

                  <!-- New Password -->
                  <div>
                    <label class="label">
                      <span class="label-text font-semibold text-base-content/80">New Password</span>
                    </label>
                    <input type="password" name="new_password" class="input input-bordered w-full" required minlength="6">
                    <p class="text-sm text-base-content/60 mt-1">Minimum 6 characters</p>
                  </div>

                  <!-- Confirm New Password -->
                  <div>
                    <label class="label">
                      <span class="label-text font-semibold text-base-content/80">Confirm New Password</span>
                    </label>
                    <input type="password" name="new_password_confirmation" class="input input-bordered w-full" required minlength="6">
                  </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                  <button type="button" onclick="togglePasswordEdit()" class="btn btn-ghost">Cancel</button>
                  <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
              </form>
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
              <!-- <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg">
                <div>
                  <p class="font-semibold">Phone Verification</p>
                  <p class="text-sm text-base-content/70">Verified on Jan 15, 2026</p>
                </div>
                <div class="badge badge-success gap-1">
                  <span class="icon-[tabler--check] size-4"></span>
                  Verified
                </div>
              </div> -->

            </div>
          </div>
        </div>
      </div>

      <!-- Account Settings -->
      <!-- <div class="card bg-base-100 shadow-lg border border-primary/20">
        <div class="card-body">
          <h3 class="text-xl font-bold mb-6">Account Settings</h3>

          <div class="space-y-4"> -->
            <!-- Notifications -->
            <!-- <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg hover:bg-base-200 transition">
              <div class="flex items-center gap-3">
                <span class="icon-[tabler--bell] size-6 text-primary"></span>
                <div>
                  <p class="font-semibold">Notification Preferences</p>
                  <p class="text-sm text-base-content/70">Manage how you receive notifications</p>
                </div>
              </div>
              <button class="btn btn-sm btn-ghost">Manage</button>
            </div> -->

            <!-- Privacy -->
            <!-- <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg hover:bg-base-200 transition">
              <div class="flex items-center gap-3">
                <span class="icon-[tabler--lock] size-6 text-primary"></span>
                <div>
                  <p class="font-semibold">Privacy Settings</p>
                  <p class="text-sm text-base-content/70">Control your profile visibility</p>
                </div>
              </div>
              <button class="btn btn-sm btn-ghost">Manage</button>
            </div> -->

            <!-- Language -->
            <!-- <div class="flex items-center justify-between p-4 border border-base-300 rounded-lg hover:bg-base-200 transition">
              <div class="flex items-center gap-3">
                <span class="icon-[tabler--language] size-6 text-primary"></span>
                <div>
                  <p class="font-semibold">Language</p>
                  <p class="text-sm text-base-content/70">Currently: English</p>
                </div>
              </div>
              <button class="btn btn-sm btn-ghost">Change</button>
            </div> -->

            <!-- Danger Zone -->
            <!-- <div class="flex items-center justify-between p-4 border border-error/30 rounded-lg bg-error/5 hover:bg-error/10 transition">
              <div class="flex items-center gap-3">
                <span class="icon-[tabler--trash] size-6 text-error"></span>
                <div>
                  <p class="font-semibold text-error">Delete Account</p>
                  <p class="text-sm text-base-content/70">Permanently delete your account and data</p>
                </div>
              </div>
              <button class="btn btn-sm btn-error">Delete</button>
            </div> -->
          <!-- </div>
        </div>
      </div> -->
    </div>
  </section>

  <script>
    function togglePersonalEdit() {
      const display = document.getElementById('personal-display');
      const edit = document.getElementById('personal-edit');
      const btn = document.getElementById('personal-edit-btn');
      
      if (display.classList.contains('hidden')) {
        display.classList.remove('hidden');
        edit.classList.add('hidden');
        btn.innerHTML = '<span class="icon-[tabler--edit] size-4"></span> Edit';
      } else {
        display.classList.add('hidden');
        edit.classList.remove('hidden');
        btn.innerHTML = '<span class="icon-[tabler--x] size-4"></span> Cancel';
      }
    }

    function toggleContactEdit() {
      const display = document.getElementById('contact-display');
      const edit = document.getElementById('contact-edit');
      const btn = document.getElementById('contact-edit-btn');
      
      if (display.classList.contains('hidden')) {
        display.classList.remove('hidden');
        edit.classList.add('hidden');
        btn.innerHTML = '<span class="icon-[tabler--edit] size-4"></span> Edit';
      } else {
        display.classList.add('hidden');
        edit.classList.remove('hidden');
        btn.innerHTML = '<span class="icon-[tabler--x] size-4"></span> Cancel';
      }
    }

    function togglePasswordEdit() {
      const display = document.getElementById('password-display');
      const edit = document.getElementById('password-edit');
      const btn = document.getElementById('password-edit-btn');
      
      if (display.classList.contains('hidden')) {
        display.classList.remove('hidden');
        edit.classList.add('hidden');
        btn.innerHTML = '<span class="icon-[tabler--lock] size-4"></span> Change';
        btn.classList.remove('btn-ghost');
        btn.classList.add('btn-primary');
      } else {
        display.classList.add('hidden');
        edit.classList.remove('hidden');
        btn.innerHTML = '<span class="icon-[tabler--x] size-4"></span> Cancel';
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-ghost');
      }
    }
  </script>
</x-dashboard-layout>
