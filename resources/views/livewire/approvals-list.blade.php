<div class="space-y-6">
  <!-- Search Bar -->
  <div class="card bg-base-100 shadow-md">
    <div class="card-body">
      <div class="flex gap-4">
        <input 
          type="text" 
          placeholder="Search by email, task name or ID..." 
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

  <!-- Approvals Table -->
  <div class="card bg-base-100 shadow-md">
    <div class="card-body">
      <h2 class="card-title text-lg mb-4">Pending Approvals</h2>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th>User Email</th>
              <th>Task ID/Name</th>
              <th>Completion Date</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($approvals as $approval)
              <tr class="hover:bg-base-200 cursor-pointer transition" onclick="window.location.href='{{ route('admin.approval.show', $approval['id']) }}'">
                <td>
                  <div class="flex items-center gap-2">
                    <div class="avatar placeholder">
                      <div class="bg-primary text-white rounded-full w-8">
                        <span class="text-xs">{{ substr($approval['user_email'], 0, 1) }}</span>
                      </div>
                    </div>
                    <span class="text-sm">{{ $approval['user_email'] }}</span>
                  </div>
                </td>
                <td>
                  <div>
                    <p class="font-semibold text-primary">{{ $approval['task_id'] }}</p>
                    <p class="text-base-content/60 text-sm">{{ $approval['task_name'] }}</p>
                  </div>
                </td>
                <td>
                  <div class="text-sm">
                    <p class="font-medium">{{ \Carbon\Carbon::parse($approval['completion_date'])->format('M d, Y') }}</p>
                    <p class="text-base-content/60">{{ \Carbon\Carbon::parse($approval['completion_date'])->format('H:i A') }}</p>
                  </div>
                </td>
                <td>
                  <div class="badge badge-success gap-2">
                    <span class="icon-[tabler--currency-dollar] size-3"></span>
                    {{ number_format($approval['amount'], 2) }}
                  </div>
                </td>
                <td>
                  <a href="{{ route('admin.approval.show', $approval['id']) }}" class="btn btn-ghost btn-xs gap-1">
                    <span class="icon-[tabler--eye] size-4"></span>
                    Review
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-8">
                  <div class="flex flex-col items-center justify-center">
                    <span class="icon-[tabler--inbox] size-12 text-base-content/30 mb-2"></span>
                    <p class="text-base-content/60">No pending approvals</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($approvals->count() > 0)
        <div class="mt-6">
          <p class="text-sm text-base-content/60">Showing {{ $approvals->count() }} of 8 pending approvals</p>
        </div>
      @endif
    </div>
  </div>
</div>
