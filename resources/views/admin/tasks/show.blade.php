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
      <a href="{{ route('admin.tasks') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--checklist] size-5"></span>
        <span>Tasks</span>
      </a>
      <a href="{{ route('admin.approvals') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--checkbox] size-5"></span>
        <span>Approvals</span>
      </a>
      <a href="{{ route('admin.finance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
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
      <div class="px-4 md:px-8 py-8">
        <div class="flex items-center gap-4">
          <a href="{{ route('admin.tasks') }}" class="btn btn-ghost btn-circle">
            <span class="icon-[tabler--arrow-left] size-6 text-white"></span>
          </a>
          <div>
            <h1 class="text-3xl font-bold text-white">Task Details</h1>
            <p class="text-white/80 text-sm">Task information and statistics</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 px-4 md:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Task Info Card -->
        <div class="lg:col-span-1">
          <div class="card bg-base-100 shadow-md">
            <div class="card-body items-center text-center">
              <div class="bg-primary/10 rounded-lg p-4 mb-4">
                <span class="icon-[tabler--checklist] size-12 text-primary"></span>
              </div>
              <h2 class="card-title text-2xl">{{ $task['name'] }}</h2>
              <p class="text-base-content/60 text-sm">Task ID: #{{ str_pad($task['id'], 4, '0', STR_PAD_LEFT) }}</p>
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
                  <span class="text-base-content/60">Task Fee:</span>
                  <span class="font-semibold text-success">${{ number_format($task['fee'], 2) }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-base-content/60">Count:</span>
                  <span class="font-semibold">{{ $task['count'] }}</span>
                </div>
              </div>
              <div class="card-actions w-full mt-4">
                <button class="btn btn-primary btn-block gap-2">
                  <span class="icon-[tabler--pencil] size-5"></span>
                  Edit Task
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Task Statistics -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Task Details Card -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg">Task Description</h3>
              <p class="text-base-content/60 mt-4">
                {{ $task['description'] }}
              </p>
              <div class="mt-4 bg-base-200 rounded-lg p-4">
                <p class="text-sm text-base-content/60 mb-2">Full Description</p>
                <p class="text-base">
                  This task involves comprehensive {{ strtolower($task['name']) }} services. It requires professional expertise and attention to detail to ensure high-quality deliverables that meet client expectations and industry standards.
                </p>
              </div>
            </div>
          </div>

          <!-- Task Metrics -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg">Task Metrics</h3>
              <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="bg-success/10 rounded-lg p-3">
                  <p class="text-base-content/60 text-sm mb-1">Total Fee</p>
                  <p class="text-2xl font-bold text-success">${{ number_format($task['fee'], 2) }}</p>
                </div>
                <div class="bg-info/10 rounded-lg p-3">
                  <p class="text-base-content/60 text-sm mb-1">Task Count</p>
                  <p class="text-2xl font-bold text-info">{{ $task['count'] }}</p>
                </div>
                <div class="bg-warning/10 rounded-lg p-3">
                  <p class="text-base-content/60 text-sm mb-1">Avg. Per Item</p>
                  <p class="text-2xl font-bold text-warning">${{ number_format($task['fee'] / max(1, $task['count']), 2) }}</p>
                </div>
                <div class="bg-primary/10 rounded-lg p-3">
                  <p class="text-base-content/60 text-sm mb-1">Priority</p>
                  <p class="text-2xl font-bold text-primary">High</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Task Progress/Timeline -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <h3 class="card-title text-lg mb-4">Recent Updates</h3>
          <div class="space-y-3">
            <div class="flex items-center justify-between border-b border-base-300 pb-3">
              <div class="flex items-center gap-3">
                <div class="bg-primary/10 rounded-lg p-2">
                  <span class="icon-[tabler--check] size-5 text-primary"></span>
                </div>
                <div>
                  <p class="font-semibold">Task Created</p>
                  <p class="text-base-content/60 text-sm">Initial setup completed</p>
                </div>
              </div>
              <span class="text-success text-sm">Today</span>
            </div>

            <div class="flex items-center justify-between border-b border-base-300 pb-3">
              <div class="flex items-center gap-3">
                <div class="bg-success/10 rounded-lg p-2">
                  <span class="icon-[tabler--check-circle] size-5 text-success"></span>
                </div>
                <div>
                  <p class="font-semibold">{{ $task['count'] }} Items Assigned</p>
                  <p class="text-base-content/60 text-sm">Distributed to team members</p>
                </div>
              </div>
              <span class="text-success text-sm">Yesterday</span>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="bg-info/10 rounded-lg p-2">
                  <span class="icon-[tabler--info-circle] size-5 text-info"></span>
                </div>
                <div>
                  <p class="font-semibold">Updated Details</p>
                  <p class="text-base-content/60 text-sm">Task description updated</p>
                </div>
              </div>
              <span class="text-info text-sm">3 days ago</span>
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
