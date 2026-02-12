<x-layout>
<div class="min-h-screen bg-base-100 flex">
  <!-- Sidebar (from admin dashboard) -->
  <div class="w-64 bg-base-200 shadow-lg flex flex-col hidden lg:flex">
    <div class="p-6 border-b border-base-300">
      <h2 class="text-2xl font-bold text-primary">Admin</h2>
      <p class="text-base-content/60 text-sm">Control Panel</p>
    </div>

    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('admin.dashboard') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
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
      <a href="{{ route('admin.videos') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--video] size-5"></span>
        <span>Videos</span>
      </a>
    </nav>

    <div class="p-4 border-t border-base-300">
      <button onclick="handleAdminLogout(event)" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error font-medium transition" type="button">
        <span class="icon-[tabler--logout] size-5"></span>
        <span>Logout</span>
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-base-300 p-6">
      <h1 class="text-3xl font-bold text-base-content">Manage Videos</h1>
      <p class="text-base-content/60 mt-1">Add and edit homepage promotional videos</p>
    </div>

    <!-- Content -->
    <div class="flex-1 overflow-auto p-6">
      @if(session('success'))
        <div class="alert alert-success shadow-lg mb-6">
          <span class="icon-[tabler--check] size-5"></span>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <div class="card bg-base-100 shadow-lg">
        <div class="card-body">
          <div class="flex justify-between items-center mb-6">
            <h2 class="card-title">Videos</h2>
            <a href="{{ route('admin.videos.create') }}" class="btn btn-primary btn-sm">
              <span class="icon-[tabler--plus] size-4"></span>
              Add Video
            </a>
          </div>

          @if($videos->isEmpty())
            <p class="text-base-content/60">No videos yet. Create your first video to display on the homepage.</p>
          @else
            <div class="overflow-x-auto">
              <table class="table w-full">
                <thead class="bg-base-200">
                  <tr>
                    <th>Order</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($videos as $video)
                    <tr class="hover:bg-base-200/50">
                      <td>{{ $video->display_order }}</td>
                      <td class="font-semibold">{{ $video->title }}</td>
                      <td class="text-sm text-base-content/70">{{ Str::limit($video->description, 50) }}</td>
                      <td>
                        @if($video->is_active)
                          <span class="badge badge-success">Active</span>
                        @else
                          <span class="badge badge-ghost">Inactive</span>
                        @endif
                      </td>
                      <td class="flex gap-2">
                        <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-xs btn-ghost">
                          <span class="icon-[tabler--edit] size-4"></span>
                        </a>
                        <form method="POST" action="{{ route('admin.videos.destroy', $video->id) }}" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-xs btn-error" onclick="return confirm('Delete this video?')">
                            <span class="icon-[tabler--trash] size-4"></span>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script>
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
        
        // Redirect to admin login
        window.location.href = '{{ route("admin.login") }}';
      } catch (error) {
        console.error('Error:', error);
        window.location.href = '{{ route("admin.login") }}';
      }
    }
  }
</script>
</x-layout>
