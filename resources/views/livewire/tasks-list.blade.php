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
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($tasks as $index => $task)
              <tr class="hover:bg-base-200 transition">
                <td class="font-semibold">{{ $tasks->firstItem() + $index }}</td>
                <td>
                  <div class="font-semibold text-primary">{{ $task->name }}</div>
                </td>
                <td>
                  <span class="text-base-content/60">{{ Str::limit($task->description, 40) }}</span>
                </td>
                <td>
                  <div class="badge badge-success gap-2">
                    <span class="icon-[tabler--currency-dollar] size-3"></span>
                    {{ number_format($task->earning, 2) }}
                  </div>
                </td>
                <td>
                  @if($task->category_id == 1)
                    <div class="badge badge-neutral">{{ $task->category->name }}</div>
                  @elseif($task->category_id == 2)
                    <div class="badge badge-info">{{ $task->category->name }}</div>
                  @elseif($task->category_id == 3)
                    <div class="badge badge-secondary">{{ $task->category->name }}</div>
                  @else
                    <div class="badge badge-warning">{{ $task->category->name }}</div>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.task.show', $task->id) }}" class="btn btn-ghost btn-xs gap-1">
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
        <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <p class="text-sm text-base-content/60">
            Showing {{ $tasks->firstItem() }}–{{ $tasks->lastItem() }} of {{ $tasks->total() }} tasks
          </p>
          <div class="ml-auto">
            {{ $tasks->links() }}
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
