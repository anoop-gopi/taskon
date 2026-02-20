<x-layout>
<div class="min-h-screen bg-base-100 flex">
  <!-- Sidebar -->
  <div class="w-64 bg-base-200 shadow-lg flex flex-col hidden lg:flex">
    <div class="p-6 border-b border-base-300">
      <h2 class="text-2xl font-bold text-primary">Admin</h2>
      <p class="text-base-content/60 text-sm">Control Panel</p>
    </div>

    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('admin.dashboard') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--home] size-5"></span>
        <span>Home</span>
      </a>
      <a href="{{ route('admin.users') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--users] size-5"></span>
        <span>Users</span>
      </a>
      <a href="{{ route('admin.tasks') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--checklist] size-5"></span>
        <span>Tasks</span>
      </a>
      <a href="{{ route('admin.approvals') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--checkbox] size-5"></span>
        <span>Approvals</span>
      </a>
      <a href="{{ route('admin.upgrade-requests') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--file-invoice] size-5"></span>
        <span>Upgrade Requests</span>
      </a>
      <a href="{{ route('admin.finance') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--wallet] size-5"></span>
        <span>Payment Requests</span>
      </a>
      <a href="{{ route('admin.videos') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--video] size-5"></span>
        <span>Videos</span>
      </a>
      <a href="{{ route('admin.testimonials') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--message-star] size-5"></span>
        <span>Testimonials</span>
      </a>
      <a href="#settings" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--settings] size-5"></span>
        <span>Settings</span>
      </a>
    </nav>

    <div class="p-4 border-t border-base-300">
      <button onclick="handleAdminLogout(event)" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error font-medium transition">
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
      <div class="px-4 md:px-8 py-12">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <div>
            <h1 class="text-4xl font-bold text-white mb-2">Admin Dashboard</h1>
            <p class="text-white/80">Welcome back! Here's your performance overview</p>
          </div>
          <div class="mt-6 md:mt-0">
            <div class="badge badge-secondary gap-2">
              <span class="icon-[tabler--circle-filled] size-3"></span>
              Live
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 px-4 md:px-8 py-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <!-- Total Users Card -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-base-content/60 text-sm">Total Users</p>
              <h3 class="text-3xl font-bold mt-2">{{ $totalUsers }}</h3>
              <p class="text-base-content/50 text-sm mt-1">
                <span class="icon-[tabler--user-check] inline size-4"></span>
                Active users
              </p>
            </div>
            <div class="bg-primary/10 rounded-lg p-3">
              <span class="icon-[tabler--users] size-8 text-primary"></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Revenue Card -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-base-content/60 text-sm">Total Revenue</p>
              <h3 class="text-3xl font-bold mt-2">${{ number_format($totalRevenue, 0) }}</h3>
              <p class="text-base-content/50 text-sm mt-1">
                <span class="icon-[tabler--check-circle] inline size-4"></span>
                From approved upgrades
              </p>
            </div>
            <div class="bg-success/10 rounded-lg p-3">
              <span class="icon-[tabler--currency-dollar] size-8 text-success"></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Tasks Card -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-base-content/60 text-sm">Total Tasks</p>
              <h3 class="text-3xl font-bold mt-2">{{ $totalTasks }}</h3>
              <p class="text-base-content/50 text-sm mt-1">
                <span class="icon-[tabler--checklist] inline size-4"></span>
                Available tasks
              </p>
            </div>
            <div class="bg-warning/10 rounded-lg p-3">
              <span class="icon-[tabler--tasks] size-8 text-warning"></span>
            </div>
          </div>
        </div>
      </div>

      <!-- User Earnings Card -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-base-content/60 text-sm">User Earnings</p>
              <h3 class="text-3xl font-bold mt-2">${{ number_format($userEarnings, 0) }}</h3>
              <p class="text-base-content/50 text-sm mt-1">
                <span class="icon-[tabler--coin] inline size-4"></span>
                Total distributed
              </p>
            </div>
            <div class="bg-info/10 rounded-lg p-3">
              <span class="icon-[tabler--coins] size-8 text-info"></span>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- Recent Activity Table -->
    <div class="card bg-base-100 shadow-md">
      <div class="card-body">
        <h2 class="card-title text-lg mb-4">Recent Activity</h2>
        <div class="overflow-x-auto">
          <table class="table table-compact w-full">
            <thead>
              <tr>
                <th>User</th>
                <th>Activity</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentActivity as $activity)
              <tr>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                      <div class="bg-primary text-white rounded-full w-10">
                        <span>{{ substr($activity['user_name'], 0, 2) }}</span>
                      </div>
                    </div>
                    <div>
                      <p class="font-semibold">{{ $activity['user_name'] }}</p>
                      <p class="text-xs text-base-content/60">{{ $activity['email'] }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="text-sm">{{ $activity['activity_type'] }}</span>
                </td>
                <td>
                  @if($activity['type'] === 'user')
                    <div class="badge badge-success gap-2">
                      <span class="icon-[tabler--check] size-3"></span>
                      New User
                    </div>
                  @elseif($activity['type'] === 'payment')
                    @if($activity['status'] === 'pending')
                      <div class="badge badge-warning gap-2">
                        <span class="icon-[tabler--clock] size-3"></span>
                        Pending
                      </div>
                    @else
                      <div class="badge badge-success gap-2">
                        <span class="icon-[tabler--check] size-3"></span>
                        {{ ucfirst($activity['status']) }}
                      </div>
                    @endif
                  @elseif($activity['type'] === 'upgrade')
                    @if($activity['status'] === 'pending_approval')
                      <div class="badge badge-warning gap-2">
                        <span class="icon-[tabler--clock] size-3"></span>
                        Pending
                      </div>
                    @elseif($activity['status'] === 'approved')
                      <div class="badge badge-success gap-2">
                        <span class="icon-[tabler--check] size-3"></span>
                        Approved
                      </div>
                    @elseif($activity['status'] === 'rejected')
                      <div class="badge badge-error gap-2">
                        <span class="icon-[tabler--x] size-3"></span>
                        Rejected
                      </div>
                    @endif
                  @endif
                </td>
                <td class="text-sm">{{ $activity['date'] }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center py-8">
                  <p class="text-base-content/60">No recent activity</p>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
</div>

<script>
  // Check admin session before navigating
  async function checkAdminSessionBeforeNavigate(event) {
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

      if (!data.authenticated || !data.user || !data.user.is_admin) {
        // Session expired or not admin
        alert('Session expired. Redirecting to admin login...');
        window.location.href = '{{ route("admin.login") }}';
        return false; // Prevent navigation
      }
      
      // Session valid and is admin, allow navigation
      return true;
    } catch (error) {
      console.error('Session check error:', error);
      // On error, allow navigation (server will handle auth)
      return true;
    }
  }

  // Handle admin logout
  async function handleAdminLogout(event) {
    event.preventDefault();
    
    if (confirm('Are you sure you want to logout?')) {
      try {
        const response = await fetch('{{ route("admin.logout") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
          },
          credentials: 'same-origin',
        });
        
        // Redirect regardless of response since admin.logout redirects
        window.location.href = '{{ route("admin.login") }}';
      } catch (error) {
        console.error('Error:', error);
        // Still redirect on error
        window.location.href = '{{ route("admin.login") }}';
      }
    }
  }

  // Check session on page load
  window.addEventListener('DOMContentLoaded', function() {
    checkAdminSessionOnLoad();
  });

  // Validate admin session on page load
  async function checkAdminSessionOnLoad() {
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

      if (!data.authenticated || !data.user || !data.user.is_admin) {
        // Session expired or not admin
        alert('Session expired. Redirecting to admin login...');
        window.location.href = '{{ route("admin.login") }}';
      }
    } catch (error) {
      console.error('Session validation error:', error);
      // On error, allow page to continue (server will handle auth)
    }
  }

    const sidebar = document.querySelector('.w-64');
    sidebar.classList.toggle('hidden');
  });
</script>
</x-layout>
