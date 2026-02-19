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
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
              <tr class="hover:bg-base-200 transition">
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                      <div class="bg-primary text-white rounded-full w-10">
                        <span>{{ substr($user->name, 0, 1) }}</span>
                      </div>
                    </div>
                    <div>
                      <p class="font-semibold">{{ $user->name }}</p>
                    </div>
                  </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>
                  @if($user->status_id == 1)
                    <div class="badge badge-warning gap-1">
                      <span class="icon-[tabler--clock] size-3"></span>
                      {{ $user->userStatus->name }}
                    </div>
                  @elseif($user->status_id == 2)
                    <div class="badge badge-success gap-1">
                      <span class="icon-[tabler--check] size-3"></span>
                      {{ $user->userStatus->name }}
                    </div>
                  @else
                    <div class="badge badge-error gap-1">
                      <span class="icon-[tabler--x] size-3"></span>
                      {{ $user->userStatus->name }}
                    </div>
                  @endif
                </td>
                <td>
                  <div class="flex gap-2">
                    @if($user->status_id == 1)
                      <form action="{{ route('admin.user.approve', $user->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-xs gap-1" onclick="return confirm('Approve this user?')">
                          <span class="icon-[tabler--check] size-4"></span>
                          Approve
                        </button>
                      </form>
                      <form action="{{ route('admin.user.reject', $user->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-error btn-xs gap-1" onclick="return confirm('Reject this user?')">
                          <span class="icon-[tabler--x] size-4"></span>
                          Reject
                        </button>
                      </form>
                    @else
                      <span class="text-sm text-base-content/60">-</span>
                    @endif
                  </div>
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
        <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <p class="text-sm text-base-content/60">
            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} users
          </p>
          <div class="ml-auto">
            {{ $users->links() }}
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
