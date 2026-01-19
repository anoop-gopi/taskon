<div class="space-y-6">
  <!-- Search Bar -->
  <div class="card bg-base-100 shadow-md">
    <div class="card-body">
      <div class="flex gap-4">
        <input 
          type="text" 
          placeholder="Search by name or description..." 
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

  <!-- Tasks Table -->
  <div class="card bg-base-100 shadow-md">
    <div class="card-body">
      <h2 class="card-title text-lg mb-4">All Tasks</h2>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Description</th>
              <th>Task Fee</th>
              <th>Count</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($tasks as $index => $task)
              <tr class="hover:bg-base-200 cursor-pointer transition" onclick="window.location.href='{{ route('admin.task.show', $task['id']) }}'">
                <td class="font-semibold">{{ $index + 1 }}</td>
                <td>
                  <div class="font-semibold text-primary">{{ $task['name'] }}</div>
                </td>
                <td>
                  <span class="text-base-content/60">{{ substr($task['description'], 0, 40) }}...</span>
                </td>
                <td>
                  <div class="badge badge-success gap-2">
                    <span class="icon-[tabler--currency-dollar] size-3"></span>
                    {{ number_format($task['fee'], 2) }}
                  </div>
                </td>
                <td>
                  <div class="badge badge-info">{{ $task['count'] }}</div>
                </td>
                <td>
                  <a href="{{ route('admin.task.show', $task['id']) }}" class="btn btn-ghost btn-xs gap-1">
                    <span class="icon-[tabler--eye] size-4"></span>
                    View
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-8">
                  <div class="flex flex-col items-center justify-center">
                    <span class="icon-[tabler--inbox] size-12 text-base-content/30 mb-2"></span>
                    <p class="text-base-content/60">No tasks found</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($tasks->count() > 0)
        <div class="mt-6">
          <p class="text-sm text-base-content/60">Showing {{ $tasks->count() }} of 8 tasks</p>
        </div>
      @endif
    </div>
  </div>
</div>
