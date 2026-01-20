<x-dashboard-layout>
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
              <h2 class="text-2xl font-bold">John Doe</h2>
              <p class="text-base-content/70 text-sm">Verified Member</p>
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
                  <p class="text-base font-medium text-base-content">John Doe</p>
                </div>

                <!-- Email -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Email Address</span>
                  </label>
                  <p class="text-base font-medium text-base-content">john.doe@example.com</p>
                </div>

                <!-- Mobile -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Mobile Number</span>
                  </label>
                  <p class="text-base font-medium text-base-content">+1 (555) 123-4567</p>
                </div>

                <!-- Date of Birth -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Date of Birth</span>
                  </label>
                  <p class="text-base font-medium text-base-content">January 15, 1995</p>
                </div>

                <!-- Country -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">Country</span>
                  </label>
                  <p class="text-base font-medium text-base-content">United States</p>
                </div>

                <!-- City -->
                <div>
                  <label class="label">
                    <span class="label-text font-semibold text-base-content/80">City</span>
                  </label>
                  <p class="text-base font-medium text-base-content">New York</p>
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
              <button class="btn btn-sm btn-primary gap-2">
                <span class="icon-[tabler--plus] size-4"></span>
                Add Method
              </button>
            </div>

            <div class="space-y-4">
              <!-- Visa Card -->
              <div class="border border-base-300 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                  <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                      <span class="icon-[tabler--credit-card] size-6 text-blue-600"></span>
                    </div>
                    <div>
                      <p class="font-semibold">Visa Card</p>
                      <p class="text-sm text-base-content/70">**** **** **** 4242</p>
                    </div>
                  </div>
                  <div class="badge badge-success gap-1">
                    <span class="icon-[tabler--check] size-4"></span>
                    Default
                  </div>
                </div>
                <div class="flex gap-2">
                  <button class="btn btn-xs btn-ghost">Edit</button>
                  <button class="btn btn-xs btn-ghost text-error">Remove</button>
                </div>
              </div>

              <!-- PayPal Account -->
              <div class="border border-base-300 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                  <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                      <span class="icon-[tabler--brand-paypal] size-6 text-blue-600"></span>
                    </div>
                    <div>
                      <p class="font-semibold">PayPal Account</p>
                      <p class="text-sm text-base-content/70">john.doe@paypal.com</p>
                    </div>
                  </div>
                </div>
                <div class="flex gap-2">
                  <button class="btn btn-xs btn-ghost">Edit</button>
                  <button class="btn btn-xs btn-ghost text-error">Remove</button>
                </div>
              </div>

              <!-- Bank Transfer -->
              <div class="border border-base-300 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                  <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                      <span class="icon-[tabler--building-bank] size-6 text-green-600"></span>
                    </div>
                    <div>
                      <p class="font-semibold">Bank Account</p>
                      <p class="text-sm text-base-content/70">Chase Bank - ****5678</p>
                    </div>
                  </div>
                </div>
                <div class="flex gap-2">
                  <button class="btn btn-xs btn-ghost">Edit</button>
                  <button class="btn btn-xs btn-ghost text-error">Remove</button>
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
