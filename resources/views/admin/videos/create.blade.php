<x-layout>
<div class="min-h-screen bg-base-100 flex">
  <!-- Sidebar -->
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
      <a href="{{ route('admin.videos') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--video] size-5"></span>
        <span>Videos</span>
      </a>
      <a href="{{ route('admin.password.edit') }}" onclick="return checkAdminSessionBeforeNavigate(event)" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--lock-password] size-5"></span>
        <span>Change Password</span>
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
      <h1 class="text-3xl font-bold text-base-content">Add New Video</h1>
      <p class="text-base-content/60 mt-1">Add a video from Google Drive to display on the homepage</p>
    </div>

    <!-- Content -->
    <div class="flex-1 overflow-auto p-6">
      @if($errors->any())
        <div class="alert alert-error mb-6 shadow-lg">
          <span class="icon-[tabler--alert-circle] size-5"></span>
          <div>
            <h3 class="font-bold">Validation Error</h3>
            <ul class="list-disc list-inside">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-error mb-6 shadow-lg">
          <span class="icon-[tabler--alert-circle] size-5"></span>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <div class="card bg-base-100 shadow-lg max-w-2xl">
        <div class="card-body">
          <form method="POST" action="{{ route('admin.videos.store') }}" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <div>
              <label class="label">
                <span class="label-text font-semibold">Video Title</span>
              </label>
              <input type="text" name="title" value="{{ old('title') }}" class="input input-bordered w-full" required>
              @error('title')
                <span class="text-error text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label class="label">
                <span class="label-text font-semibold">Description</span>
              </label>
              <textarea name="description" rows="3" class="textarea textarea-bordered w-full">{{ old('description') }}</textarea>
              @error('description')
                <span class="text-error text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label class="label">
                <span class="label-text font-semibold">Google Drive Embed URL</span>
                <span class="label-text-alt text-xs text-base-content/60">Paste the embed URL from Google Drive</span>
              </label>
              <textarea name="embed_url" rows="3" class="textarea textarea-bordered w-full font-mono text-xs" placeholder='Example: https://drive.google.com/file/d/FILE_ID/preview' required>{{ old('embed_url') }}</textarea>
              @error('embed_url')
                <span class="text-error text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label class="label">
                <span class="label-text font-semibold">Display Order</span>
              </label>
              <input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="input input-bordered w-full">
              @error('display_order')
                <span class="text-error text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label class="label cursor-pointer">
                <span class="label-text font-semibold">Active</span>
                <input type="checkbox" name="is_active" class="checkbox" {{ old('is_active') ? 'checked' : '' }}>
              </label>
            </div>

            <div class="flex gap-2 pt-4">
              <button type="submit" class="btn btn-primary">Create Video</button>
              <a href="{{ route('admin.videos') }}" class="btn btn-ghost">Cancel</a>
            </div>
          </form>
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
