<x-layout>
<div class="min-h-screen bg-base-100 flex">
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
        <span>Mock Tests</span>
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
      <a href="{{ route('admin.password.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--lock-password] size-5"></span>
        <span>Change Password</span>
      </a>
    </nav>

    <div class="p-4 border-t border-base-300">
      <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error font-medium transition">
        <span class="icon-[tabler--logout] size-5"></span>
        <span>Logout</span>
      </button>
    </div>
  </div>

  <div class="lg:hidden absolute top-4 left-4 z-50">
    <button class="btn btn-square btn-ghost" id="mobile-menu-btn">
      <span class="icon-[tabler--menu] size-6"></span>
    </button>
  </div>

  <div class="flex-1 flex flex-col">
    <div class="bg-gradient-to-r from-primary to-primary-focus">
      <div class="px-4 md:px-8 py-8">
        <div class="flex items-center gap-4">
          <a href="{{ route('admin.tasks') }}" class="btn btn-ghost btn-circle">
            <span class="icon-[tabler--arrow-left] size-6 text-white"></span>
          </a>
          <div>
            <h1 class="text-3xl font-bold text-white">Mock Test Details</h1>
            <p class="text-white/80 text-sm">{{ $mockTest->title }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex-1 px-4 md:px-8 py-8 space-y-6">

      @if (session()->has('success'))
        <div class="alert alert-success">
          <span class="icon-[tabler--circle-check] size-5"></span>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- Overview card --}}
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <h2 class="card-title">Overview</h2>
          <p class="text-base-content/70">{{ $mockTest->description ?: 'No description provided.' }}</p>
          <div class="mt-3 flex flex-wrap gap-3">
            <div class="badge badge-neutral">Created {{ $mockTest->created_at->format('d M Y') }}</div>
          </div>
        </div>
      </div>

      {{-- Live question manager --}}
      <livewire:mock-test-question-manager :mockTestId="$mockTest->id" />

    </div>
  </div>
</div>

<script>
  document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
    const sidebar = document.querySelector('.w-64');
    sidebar.classList.toggle('hidden');
  });
</script>
</x-layout>
