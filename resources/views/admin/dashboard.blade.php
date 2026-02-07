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
        <span>Finance</span>
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
              <h3 class="text-3xl font-bold mt-2">12,480</h3>
              <p class="text-success text-sm mt-1">
                <span class="icon-[tabler--arrow-up] inline size-4"></span>
                12% from last month
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
              <h3 class="text-3xl font-bold mt-2">$48,500</h3>
              <p class="text-success text-sm mt-1">
                <span class="icon-[tabler--arrow-up] inline size-4"></span>
                8% from last month
              </p>
            </div>
            <div class="bg-success/10 rounded-lg p-3">
              <span class="icon-[tabler--currency-dollar] size-8 text-success"></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Active Orders Card -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-base-content/60 text-sm">Active Orders</p>
              <h3 class="text-3xl font-bold mt-2">892</h3>
              <p class="text-warning text-sm mt-1">
                <span class="icon-[tabler--arrow-down] inline size-4"></span>
                3% from last month
              </p>
            </div>
            <div class="bg-warning/10 rounded-lg p-3">
              <span class="icon-[tabler--shopping-cart] size-8 text-warning"></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Customer Satisfaction Card -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-base-content/60 text-sm">Satisfaction</p>
              <h3 class="text-3xl font-bold mt-2">98.5%</h3>
              <p class="text-success text-sm mt-1">
                <span class="icon-[tabler--arrow-up] inline size-4"></span>
                2.5% from last month
              </p>
            </div>
            <div class="bg-info/10 rounded-lg p-3">
              <span class="icon-[tabler--stars] size-8 text-info"></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts and Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
      <!-- Revenue Chart -->
      <div class="lg:col-span-2">
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <h2 class="card-title text-lg">Revenue Overview</h2>
            <p class="text-base-content/60 text-sm">Last 12 months revenue trend</p>
            <div class="mt-6 h-64 flex items-center justify-center bg-base-200 rounded-lg">
              <div class="text-center">
                <span class="icon-[tabler--chart-line] size-12 text-base-content/30 mx-auto block mb-2"></span>
                <p class="text-base-content/50">Chart placeholder</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Top Products -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <h2 class="card-title text-lg">Top Products</h2>
          <p class="text-base-content/60 text-sm">This month</p>
          <div class="space-y-4 mt-4">
            <div class="flex items-center justify-between">
              <span class="text-sm">Product A</span>
              <div class="badge badge-primary">4,250</div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-sm">Product B</span>
              <div class="badge badge-secondary">3,890</div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-sm">Product C</span>
              <div class="badge badge-accent">2,450</div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-sm">Product D</span>
              <div class="badge badge-info">1,890</div>
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
                <th>Action</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                      <div class="bg-primary text-white rounded-full w-10">
                        <span>JD</span>
                      </div>
                    </div>
                    <div>
                      <p class="font-semibold">John Doe</p>
                      <p class="text-xs text-base-content/60">john@example.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="text-sm">Placed Order</span>
                </td>
                <td>
                  <div class="badge badge-success gap-2">
                    <span class="icon-[tabler--check] size-3"></span>
                    Completed
                  </div>
                </td>
                <td class="text-sm">2024-01-19</td>
                <td>
                  <button class="btn btn-ghost btn-xs">
                    <span class="icon-[tabler--eye] size-4"></span>
                  </button>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                      <div class="bg-secondary text-white rounded-full w-10">
                        <span>SM</span>
                      </div>
                    </div>
                    <div>
                      <p class="font-semibold">Sarah Miller</p>
                      <p class="text-xs text-base-content/60">sarah@example.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="text-sm">Updated Profile</span>
                </td>
                <td>
                  <div class="badge badge-warning gap-2">
                    <span class="icon-[tabler--clock] size-3"></span>
                    Pending
                  </div>
                </td>
                <td class="text-sm">2024-01-18</td>
                <td>
                  <button class="btn btn-ghost btn-xs">
                    <span class="icon-[tabler--eye] size-4"></span>
                  </button>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                      <div class="bg-accent text-white rounded-full w-10">
                        <span>MJ</span>
                      </div>
                    </div>
                    <div>
                      <p class="font-semibold">Mike Johnson</p>
                      <p class="text-xs text-base-content/60">mike@example.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="text-sm">Made Payment</span>
                </td>
                <td>
                  <div class="badge badge-success gap-2">
                    <span class="icon-[tabler--check] size-3"></span>
                    Completed
                  </div>
                </td>
                <td class="text-sm">2024-01-17</td>
                <td>
                  <button class="btn btn-ghost btn-xs">
                    <span class="icon-[tabler--eye] size-4"></span>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-8 flex flex-col sm:flex-row gap-4">
      <button class="btn btn-primary gap-2">
        <span class="icon-[tabler--plus] size-5"></span>
        Create Report
      </button>
      <button class="btn btn-outline gap-2">
        <span class="icon-[tabler--download] size-5"></span>
        Export Data
      </button>
      <button class="btn btn-ghost gap-2">
        <span class="icon-[tabler--refresh] size-5"></span>
        Refresh
      </button>
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
        const response = await fetch('{{ route("auth.logout") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
          },
        });
        
        const data = await response.json();
        
        if (data.success) {
          alert('Logged out successfully!');
          window.location.href = '{{ route("admin.login") }}';
        } else {
          alert('Logout failed');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
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
