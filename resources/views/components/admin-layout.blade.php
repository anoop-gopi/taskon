<x-layout>
<div class="min-h-screen bg-base-100 flex">
  <!-- Sidebar -->
  <div class="w-64 bg-base-200 shadow-lg flex flex-col hidden lg:flex">
    <div class="p-6 border-b border-base-300">
      <h2 class="text-2xl font-bold text-primary">Admin</h2>
      <p class="text-base-content/60 text-sm">Control Panel</p>
    </div>

    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'hover:bg-primary/10 text-base-content' }} transition">
        <span class="icon-[tabler--home] size-5"></span>
        <span>Home</span>
      </a>
      <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.users*') ? 'bg-primary text-white' : 'hover:bg-primary/10 text-base-content' }} transition">
        <span class="icon-[tabler--users] size-5"></span>
        <span>Users</span>
      </a>
      <a href="{{ route('admin.tasks') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.tasks*') ? 'bg-primary text-white' : 'hover:bg-primary/10 text-base-content' }} transition">
        <span class="icon-[tabler--checklist] size-5"></span>
        <span>Tasks</span>
      </a>
      <a href="{{ route('admin.approvals') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.approvals*') ? 'bg-primary text-white' : 'hover:bg-primary/10 text-base-content' }} transition">
        <span class="icon-[tabler--checkbox] size-5"></span>
        <span>Approvals</span>
      </a>
      <a href="{{ route('admin.upgrade-requests') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.upgrade-requests*') ? 'bg-primary text-white' : 'hover:bg-primary/10 text-base-content' }} transition">
        <span class="icon-[tabler--file-invoice] size-5"></span>
        <span>Upgrade Requests</span>
        @php
          $pendingUpgrades = \App\Models\UpgradeRequest::where('status', 'pending_approval')->count();
        @endphp
        @if($pendingUpgrades > 0)
          <span class="badge badge-error badge-sm">{{ $pendingUpgrades }}</span>
        @endif
      </a>
      <a href="{{ route('admin.finance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.finance*') ? 'bg-primary text-white' : 'hover:bg-primary/10 text-base-content' }} transition">
        <span class="icon-[tabler--wallet] size-5"></span>
        <span>Payment Requests</span>
      </a>
      <a href="{{ route('admin.videos') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.videos*') ? 'bg-primary text-white' : 'hover:bg-primary/10 text-base-content' }} transition">
        <span class="icon-[tabler--video] size-5"></span>
        <span>Videos</span>
      </a>
      <a href="{{ route('admin.testimonials') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.testimonials*') ? 'bg-primary text-white' : 'hover:bg-primary/10 text-base-content' }} transition">
        <span class="icon-[tabler--message-star] size-5"></span>
        <span>Testimonials</span>
      </a>
      <a href="#settings" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--settings] size-5"></span>
        <span>Settings</span>
      </a>
    </nav>

    <div class="p-4 border-t border-base-300">
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error font-medium transition">
          <span class="icon-[tabler--logout] size-5"></span>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>

  <!-- Mobile Menu Button -->
  <div class="lg:hidden absolute top-4 left-4 z-50">
    <button class="btn btn-square btn-ghost" id="mobile-menu-btn">
      <span class="icon-[tabler--menu] size-6"></span>
    </button>
  </div>

  <!-- Main Content Wrapper -->
  <div class="flex-1 flex flex-col overflow-hidden">
    {{ $slot }}
  </div>
</div>

<script>
  // Mobile menu toggle
  document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
    const sidebar = document.querySelector('.w-64');
    sidebar.classList.toggle('hidden');
    sidebar.classList.toggle('absolute');
    sidebar.classList.toggle('z-40');
    sidebar.classList.toggle('h-full');
  });
</script>
</x-layout>
