<div class="space-y-6">
  <!-- Search Bar -->
  <div class="card bg-base-100 shadow-md">
    <div class="card-body">
      <div class="flex gap-4">
        <input 
          type="text" 
          placeholder="Search by name or email..." 
          class="input input-bordered flex-1"
          wire:model.live="search"
        />
        <button class="btn btn-primary gap-2">
          <span class="icon-[tabler--search] size-5"></span>
          Search
        </button>
      </div>
    </div>
  </div>

  <!-- Users Table -->
  <div class="card bg-base-100 shadow-md">
    <div class="card-body">
      <h2 class="card-title text-lg mb-4">All Users</h2>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Joined Date</th>
              <th>Total Earnings</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
              <tr class="hover:bg-base-200 cursor-pointer transition" onclick="window.location.href='{{ route('admin.user.show', $user['id']) }}'">
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                      <div class="bg-primary text-white rounded-full w-10">
                        <span>{{ substr($user['name'], 0, 1) }}</span>
                      </div>
                    </div>
                    <div>
                      <p class="font-semibold">{{ $user['name'] }}</p>
                    </div>
                  </div>
                </td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['joined_date'] }}</td>
                <td>
                  <div class="badge badge-success gap-2">
                    <span class="icon-[tabler--currency-dollar] size-3"></span>
                    {{ number_format($user['earnings'], 2) }}
                  </div>
                </td>
                <td>
                  <a href="{{ route('admin.user.show', $user['id']) }}" class="btn btn-ghost btn-xs gap-1">
                    <span class="icon-[tabler--eye] size-4"></span>
                    View
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-8">
                  <div class="flex flex-col items-center justify-center">
                    <span class="icon-[tabler--inbox] size-12 text-base-content/30 mb-2"></span>
                    <p class="text-base-content/60">No users found</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($users->count() > 0)
        <div class="mt-6">
          <p class="text-sm text-base-content/60">Showing {{ $users->count() }} of 8 users</p>
        </div>
      @endif
    </div>
  </div>
</div>
