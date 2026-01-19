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
      <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
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
      <a href="{{ route('admin.finance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--wallet] size-5"></span>
        <span>Finance</span>
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
      <div class="px-4 md:px-8 py-12">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <div>
            <h1 class="text-4xl font-bold text-white mb-2">Finance Overview</h1>
            <p class="text-white/80">Track earnings and financial metrics</p>
          </div>
          <div class="mt-6 md:mt-0">
            <button class="btn btn-secondary gap-2">
              <span class="icon-[tabler--download] size-5"></span>
              Export Report
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 px-4 md:px-8 py-8">
      <!-- Earnings Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <!-- Total Earnings -->
        <div class="card bg-base-100 shadow-md lg:col-span-1">
          <div class="card-body">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-base-content/60 text-sm">Total Earnings</p>
                <h3 class="text-3xl font-bold mt-2">$156,890</h3>
                <p class="text-success text-sm mt-1">
                  <span class="icon-[tabler--arrow-up] inline size-4"></span>
                  +15% all time
                </p>
              </div>
              <div class="bg-primary/10 rounded-lg p-3">
                <span class="icon-[tabler--currency-dollar] size-8 text-primary"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Today's Earnings -->
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-base-content/60 text-sm">Today</p>
                <h3 class="text-3xl font-bold mt-2">$2,450</h3>
                <p class="text-success text-sm mt-1">
                  <span class="icon-[tabler--arrow-up] inline size-4"></span>
                  +8% vs yesterday
                </p>
              </div>
              <div class="bg-success/10 rounded-lg p-3">
                <span class="icon-[tabler--calendar-event] size-8 text-success"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- This Week -->
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-base-content/60 text-sm">This Week</p>
                <h3 class="text-3xl font-bold mt-2">$15,680</h3>
                <p class="text-success text-sm mt-1">
                  <span class="icon-[tabler--arrow-up] inline size-4"></span>
                  +12% vs last week
                </p>
              </div>
              <div class="bg-info/10 rounded-lg p-3">
                <span class="icon-[tabler--calendar] size-8 text-info"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- This Month -->
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-base-content/60 text-sm">This Month</p>
                <h3 class="text-3xl font-bold mt-2">$58,420</h3>
                <p class="text-success text-sm mt-1">
                  <span class="icon-[tabler--arrow-up] inline size-4"></span>
                  +18% vs last month
                </p>
              </div>
              <div class="bg-warning/10 rounded-lg p-3">
                <span class="icon-[tabler--calendar-month] size-8 text-warning"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- This Year -->
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-base-content/60 text-sm">This Year</p>
                <h3 class="text-3xl font-bold mt-2">$156,890</h3>
                <p class="text-success text-sm mt-1">
                  <span class="icon-[tabler--arrow-up] inline size-4"></span>
                  +22% vs last year
                </p>
              </div>
              <div class="bg-secondary/10 rounded-lg p-3">
                <span class="icon-[tabler--calendar-year] size-8 text-secondary"></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Transactions Table -->
      <div class="card bg-base-100 shadow-md mb-8">
        <div class="card-body">
          <h2 class="card-title text-lg mb-4">Recent Transactions</h2>
          <div class="overflow-x-auto">
            <table class="table table-compact w-full">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>2024-01-19</td>
                  <td>Website Design - John Doe</td>
                  <td>
                    <div class="badge badge-primary">Services</div>
                  </td>
                  <td class="font-semibold text-success">+$500.00</td>
                  <td>
                    <div class="badge badge-success gap-2">
                      <span class="icon-[tabler--check] size-3"></span>
                      Completed
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2024-01-18</td>
                  <td>API Development - Tech Corp</td>
                  <td>
                    <div class="badge badge-primary">Services</div>
                  </td>
                  <td class="font-semibold text-success">+$750.00</td>
                  <td>
                    <div class="badge badge-success gap-2">
                      <span class="icon-[tabler--check] size-3"></span>
                      Completed
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2024-01-18</td>
                  <td>Product Purchase - Sarah Miller</td>
                  <td>
                    <div class="badge badge-success">Products</div>
                  </td>
                  <td class="font-semibold text-success">+$350.00</td>
                  <td>
                    <div class="badge badge-success gap-2">
                      <span class="icon-[tabler--check] size-3"></span>
                      Completed
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2024-01-17</td>
                  <td>Consulting Session - Mike Johnson</td>
                  <td>
                    <div class="badge badge-info">Consulting</div>
                  </td>
                  <td class="font-semibold text-success">+$600.00</td>
                  <td>
                    <div class="badge badge-success gap-2">
                      <span class="icon-[tabler--check] size-3"></span>
                      Completed
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2024-01-17</td>
                  <td>Mobile App Development - Emily Davis</td>
                  <td>
                    <div class="badge badge-primary">Services</div>
                  </td>
                  <td class="font-semibold text-success">+$1,200.00</td>
                  <td>
                    <div class="badge badge-warning gap-2">
                      <span class="icon-[tabler--clock] size-3"></span>
                      Pending
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Monthly Trend Chart -->
        <div class="lg:col-span-2">
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h2 class="card-title text-lg">Monthly Earnings Trend</h2>
              <p class="text-base-content/60 text-sm">Last 12 months</p>
              <div class="mt-6 h-64 flex items-center justify-center bg-base-200 rounded-lg">
                <div class="text-center">
                  <span class="icon-[tabler--chart-line] size-12 text-base-content/30 mx-auto block mb-2"></span>
                  <p class="text-base-content/50">Chart placeholder - Earnings trend visualization</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Revenue by Category -->
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <h2 class="card-title text-lg">Revenue Sources</h2>
            <p class="text-base-content/60 text-sm">Breakdown</p>
            <div class="space-y-4 mt-4">
              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-sm font-medium">Services</span>
                  <span class="text-sm text-base-content/60">45%</span>
                </div>
                <div class="w-full bg-base-300 rounded-full h-2">
                  <div class="bg-primary h-2 rounded-full" style="width: 45%"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-sm font-medium">Products</span>
                  <span class="text-sm text-base-content/60">35%</span>
                </div>
                <div class="w-full bg-base-300 rounded-full h-2">
                  <div class="bg-success h-2 rounded-full" style="width: 35%"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-sm font-medium">Consulting</span>
                  <span class="text-sm text-base-content/60">20%</span>
                </div>
                <div class="w-full bg-base-300 rounded-full h-2">
                  <div class="bg-info h-2 rounded-full" style="width: 20%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Financial Metrics -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Average Transaction -->
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <h3 class="card-title text-lg">Average Transaction</h3>
            <div class="mt-4">
              <p class="text-base-content/60 text-sm mb-2">This Month</p>
              <p class="text-3xl font-bold text-primary">$1,280</p>
              <p class="text-base-content/60 text-sm mt-2">Based on 46 transactions</p>
            </div>
          </div>
        </div>

        <!-- Total Transactions -->
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <h3 class="card-title text-lg">Total Transactions</h3>
            <div class="mt-4">
              <p class="text-base-content/60 text-sm mb-2">This Month</p>
              <p class="text-3xl font-bold text-success">46</p>
              <p class="text-success text-sm mt-2">
                <span class="icon-[tabler--arrow-up] inline size-4"></span>
                +12% vs last month
              </p>
            </div>
          </div>
        </div>

        <!-- Conversion Rate -->
        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <h3 class="card-title text-lg">Conversion Rate</h3>
            <div class="mt-4">
              <p class="text-base-content/60 text-sm mb-2">This Month</p>
              <p class="text-3xl font-bold text-info">3.8%</p>
              <p class="text-info text-sm mt-2">
                <span class="icon-[tabler--arrow-up] inline size-4"></span>
                +0.5% vs last month
              </p>
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
