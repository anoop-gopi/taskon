<x-admin-layout>
  <!-- Header -->
  <div class="bg-gradient-to-r from-primary to-primary-focus">
    <div class="px-4 md:px-8 py-12">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
          <h1 class="text-4xl font-bold text-white mb-2">Testimonials Management</h1>
          <p class="text-white/80">Manage customer testimonials</p>
        </div>
        <div class="mt-6 md:mt-0">
          <a href="{{ route('admin.testimonials.create') }}" class="btn btn-secondary gap-2">
            <span class="icon-[tabler--plus] size-5"></span>
            Add Testimonial
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex-1 px-4 md:px-8 py-8 overflow-y-auto">
    @if(session('success'))
    <div class="alert alert-success mb-6">
      <span class="icon-[tabler--check] size-5"></span>
      <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="card bg-base-100 shadow-lg">
      <div class="card-body">
        <div class="overflow-x-auto">
          <table class="table table-zebra">
            <thead>
              <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Job Title</th>
                <th>Rating</th>
                <th>Feedback</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($testimonials as $testimonial)
              <tr>
                <td>
                  <div class="avatar">
                    <div class="w-12 h-12 rounded-full">
                      @if($testimonial->photo === 'default_profile_pic.jpg')
                        <div class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center">
                          <span class="text-lg font-bold">{{ substr($testimonial->customer_name, 0, 1) }}</span>
                        </div>
                      @else
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->customer_name }}" />
                      @endif
                    </div>
                  </div>
                </td>
                <td>
                  <div class="font-bold">{{ $testimonial->customer_name }}</div>
                  @if($testimonial->email)
                    <div class="text-sm opacity-50">{{ $testimonial->email }}</div>
                  @endif
                </td>
                <td>{{ $testimonial->job_title }}</td>
                <td>
                  <div class="flex gap-0.5">
                    @for($i = 1; $i <= 5; $i++)
                      <span class="icon-[tabler--star-filled] size-4 {{ $i <= $testimonial->stars ? 'text-yellow-400' : 'text-gray-300' }}"></span>
                    @endfor
                  </div>
                  <span class="text-sm">{{ $testimonial->stars }}/5</span>
                </td>
                <td>
                  <div class="max-w-xs truncate">{{ $testimonial->feedback }}</div>
                </td>
                <td>
                  @if($testimonial->is_active)
                    <span class="badge badge-success gap-1">
                      <span class="icon-[tabler--check] size-3"></span>
                      Active
                    </span>
                  @else
                    <span class="badge badge-ghost gap-1">
                      <span class="icon-[tabler--x] size-3"></span>
                      Inactive
                    </span>
                  @endif
                </td>
                <td>
                  <div class="flex gap-2">
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-ghost text-info">
                      <span class="icon-[tabler--edit] size-4"></span>
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-ghost text-error">
                        <span class="icon-[tabler--trash] size-4"></span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center py-8">
                  <div class="flex flex-col items-center gap-4">
                    <span class="icon-[tabler--message-off] size-16 text-base-content/30"></span>
                    <p class="text-base-content/60">No testimonials found. Add your first testimonial!</p>
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">Add Testimonial</a>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
