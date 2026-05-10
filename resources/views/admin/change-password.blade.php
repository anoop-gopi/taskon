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
        <span>Mock Tests</span>
      </a>
      <a href="{{ route('admin.approvals') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--checkbox] size-5"></span>
        <span>Approvals</span>
      </a>
      <a href="{{ route('admin.upgrade-requests') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--file-invoice] size-5"></span>
        <span>Upgrade Requests</span>
      </a>
      <a href="{{ route('admin.finance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--wallet] size-5"></span>
        <span>Payment Requests</span>
      </a>
      <a href="{{ route('admin.videos') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--video] size-5"></span>
        <span>Videos</span>
      </a>
      <a href="{{ route('admin.password.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--lock-password] size-5"></span>
        <span>Change Password</span>
      </a>
    </nav>

    <div class="p-4 border-t border-base-300">
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error font-medium transition">
          <span class="icon-[tabler--logout] size-5"></span>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>

  <!-- Main Content Wrapper -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-primary-focus">
      <div class="px-4 md:px-8 py-12">
        <h1 class="text-4xl font-bold text-white mb-2">Change Password</h1>
        <p class="text-white/80">Update your admin account password securely</p>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 px-4 md:px-8 py-8">
      <div class="max-w-2xl">
        @if(session('success'))
          <div class="alert alert-success mb-6 shadow-lg">
            <span class="icon-[tabler--check] size-5"></span>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-error mb-6 shadow-lg">
            <span class="icon-[tabler--alert-circle] size-5"></span>
            <span>{{ session('error') }}</span>
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-error mb-6 shadow-lg">
            <span class="icon-[tabler--alert-circle] size-5"></span>
            <div>
              @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
              @endforeach
            </div>
          </div>
        @endif

        <div class="card bg-base-100 shadow-md">
          <div class="card-body">
            <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-5">
              @csrf

              <div>
                <label class="label" for="current_password">
                  <span class="label-text font-medium">Current Password</span>
                </label>
                <input
                  id="current_password"
                  name="current_password"
                  type="password"
                  class="input input-bordered w-full"
                  required>
              </div>

              <div>
                <label class="label" for="new_password">
                  <span class="label-text font-medium">New Password</span>
                </label>
                <input
                  id="new_password"
                  name="new_password"
                  type="password"
                  class="input input-bordered w-full"
                  required>
              </div>

              <div>
                <label class="label" for="new_password_confirmation">
                  <span class="label-text font-medium">Confirm New Password</span>
                </label>
                <input
                  id="new_password_confirmation"
                  name="new_password_confirmation"
                  type="password"
                  class="input input-bordered w-full"
                  required>
              </div>

              <div>
                <button type="submit" class="btn btn-primary gap-2">
                  <span class="icon-[tabler--device-floppy] size-5"></span>
                  Update Password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</x-layout>
