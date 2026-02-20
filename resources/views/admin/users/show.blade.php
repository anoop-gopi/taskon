<x-layout>
<div class="min-h-screen bg-base-100 flex">
  <!-- Sidebar -->
  <div class="w-64 bg-base-200 shadow-lg flex flex-col hidden lg:flex">
    <div class="p-6 border-b border-base-300">
      <h2 class="text-2xl font-bold text-primary">Admin</h2>
      <p class="text-base-content/60 text-sm">Control Panel</p>
    </div>

    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--home] size-5"></span>
        <span>Home</span>
      </a>
      <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--users] size-5"></span>
        <span>Users</span>
      </a>
      <a href="{{ route('admin.tasks') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--checklist] size-5"></span>
        <span>Tasks</span>
      </a>
      <a href="{{ route('admin.approvals') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--checkbox] size-5"></span>
        <span>Approvals</span>
      </a>
      <a href="{{ route('admin.finance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--wallet] size-5"></span>
        <span>Payment Requests</span>
      </a>
      <a href="{{ route('admin.videos') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--video] size-5"></span>
        <span>Videos</span>
      </a>
      <a href="{{ route('admin.testimonials') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--message-star] size-5"></span>
        <span>Testimonials</span>
      </a>
      <a href="#settings" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--settings] size-5"></span>
        <span>Settings</span>
      </a>
    </nav>

    <div class="p-4 border-t border-base-300">
      <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error font-medium transition">
        <span class="icon-[tabler--logout] size-5"></span>
        <span>Logout</span>
      </button>
    </div>
  </div>

  <!-- Mobile Menu Button -->
  <div class="lg:hidden absolute top-4 left-4 z-50">
    <button class="btn btn-square btn-ghost" id="mobile-menu-btn">
      <span class="icon-[tabler--menu] size-6"></span>
    </button>
  </div>

  <!-- Main Content Wrapper -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-primary-focus">
      <div class="px-4 md:px-8 py-8">
        <div class="flex items-center gap-4">
          <a href="{{ route('admin.users') }}" class="btn btn-ghost btn-circle">
            <span class="icon-[tabler--arrow-left] size-6 text-white"></span>
          </a>
          <div>
            <h1 class="text-3xl font-bold text-white">User Details</h1>
            <p class="text-white/80 text-sm">Detailed user information and statistics</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 px-4 md:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
          <div class="card bg-base-100 shadow-md">
            <div class="card-body items-center text-center">
              <div class="avatar placeholder mb-4">
                <div class="bg-primary text-white rounded-full w-24">
                  <span class="text-3xl">{{ substr($user['name'], 0, 1) }}</span>
                </div>
              </div>
              <h2 class="card-title text-2xl">{{ $user['name'] }}</h2>
              <p class="text-base-content/60">{{ $user['email'] }}</p>
              <div class="divider my-2"></div>
              <div class="w-full space-y-2">
                <div class="flex justify-between">
                  <span class="text-base-content/60">Status:</span>
                  <div class="badge badge-success gap-1">
                    <span class="icon-[tabler--circle-filled] size-2"></span>
                    Active
                  </div>
                </div>
                <div class="flex justify-between">
                  <span class="text-base-content/60">Member Since:</span>
                  <span class="font-semibold">{{ $user['joined_date'] }}</span>
                </div>
              </div>
              <div class="card-actions w-full mt-4">
                <button class="btn btn-primary btn-block gap-2">
                  <span class="icon-[tabler--pencil] size-5"></span>
                  Edit User
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- User Statistics -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Earnings Card -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg">Financial Overview</h3>
              <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                  <p class="text-base-content/60 text-sm mb-1">Total Earnings</p>
                  <p class="text-2xl font-bold text-success">${{ number_format($user['earnings'], 2) }}</p>
                </div>
                <div>
                  <p class="text-base-content/60 text-sm mb-1">This Month</p>
                  <p class="text-2xl font-bold text-primary">$450.50</p>
                </div>
              </div>
              <div class="mt-4 bg-base-200 rounded-lg p-4">
                <p class="text-sm text-base-content/60">Average Monthly</p>
                <p class="text-xl font-bold">${{ number_format($user['earnings'] / 6, 2) }}</p>
              </div>
            </div>
          </div>

          <!-- Account Information -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg">Account Information</h3>
              <div class="space-y-3 mt-4">
                <div class="flex justify-between border-b border-base-300 pb-2">
                  <span class="text-base-content/60">Email Address</span>
                  <span class="font-semibold">{{ $user['email'] }}</span>
                </div>
                <div class="flex justify-between border-b border-base-300 pb-2">
                  <span class="text-base-content/60">Phone Number</span>
                  <span class="font-semibold">+1 (555) 123-4567</span>
                </div>
                <div class="flex justify-between border-b border-base-300 pb-2">
                  <span class="text-base-content/60">Country</span>
                  <span class="font-semibold">United States</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-base-content/60">Timezone</span>
                  <span class="font-semibold">EST (UTC-5)</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Activity History -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <h3 class="card-title text-lg mb-4">Recent Activity</h3>
          <div class="space-y-3">
            <div class="flex items-center justify-between border-b border-base-300 pb-3">
              <div class="flex items-center gap-3">
                <div class="bg-primary/10 rounded-lg p-2">
                  <span class="icon-[tabler--user] size-5 text-primary"></span>
                </div>
                <div>
                  <p class="font-semibold">Logged in</p>
                  <p class="text-base-content/60 text-sm">Today at 9:30 AM</p>
                </div>
              </div>
              <span class="text-success text-sm">Successful</span>
            </div>

            <div class="flex items-center justify-between border-b border-base-300 pb-3">
              <div class="flex items-center gap-3">
                <div class="bg-success/10 rounded-lg p-2">
                  <span class="icon-[tabler--shopping-cart] size-5 text-success"></span>
                </div>
                <div>
                  <p class="font-semibold">Made a purchase</p>
                  <p class="text-base-content/60 text-sm">Yesterday at 2:15 PM</p>
                </div>
              </div>
              <span class="badge badge-success">$250.00</span>
            </div>

            <div class="flex items-center justify-between border-b border-base-300 pb-3">
              <div class="flex items-center gap-3">
                <div class="bg-info/10 rounded-lg p-2">
                  <span class="icon-[tabler--user-check] size-5 text-info"></span>
                </div>
                <div>
                  <p class="font-semibold">Updated profile</p>
                  <p class="text-base-content/60 text-sm">3 days ago</p>
                </div>
              </div>
              <span class="text-info text-sm">Completed</span>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="bg-warning/10 rounded-lg p-2">
                  <span class="icon-[tabler--mail] size-5 text-warning"></span>
                </div>
                <div>
                  <p class="font-semibold">Email verification</p>
                  <p class="text-base-content/60 text-sm">1 week ago</p>
                </div>
              </div>
              <span class="text-warning text-sm">Verified</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('mobile-menu-btn').addEventListener('click', function() {
    const sidebar = document.querySelector('.w-64');
    sidebar.classList.toggle('hidden');
  });
</script>
</x-layout>
