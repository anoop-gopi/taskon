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
      <h2 class="card-title text-lg mb-4">All Mock Tests</h2>
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th>No.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Total Questions</th>
              <th>Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($mockTests as $index => $mockTest)
              <tr class="hover:bg-base-200 transition">
                <td class="font-semibold">{{ $mockTests->firstItem() + $index }}</td>
                <td>
                  <div class="font-semibold text-primary">{{ $mockTest->title }}</div>
                </td>
                <td>
                  <span class="text-base-content/60">{{ Str::limit($mockTest->description, 60) }}</span>
                </td>
                <td>
                  <div class="badge badge-info gap-2">
                    <span class="icon-[tabler--help-square-rounded] size-3"></span>
                    {{ $mockTest->questions_count }}
                  </div>
                </td>
                <td>
                  <span class="text-base-content/70 text-sm">{{ $mockTest->created_at->format('d M Y') }}</span>
                </td>
                <td>
                  <a href="{{ route('admin.task.show', $mockTest->id) }}" class="btn btn-ghost btn-xs gap-1">
                    <span class="icon-[tabler--eye] size-4"></span>
                    View Questions
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-8">
                  <div class="flex flex-col items-center justify-center">
                    <span class="icon-[tabler--inbox] size-12 text-base-content/30 mb-2"></span>
                    <p class="text-base-content/60">No mock tests found</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($mockTests->count() > 0)
        <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <p class="text-sm text-base-content/60">
            Showing {{ $mockTests->firstItem() }}-{{ $mockTests->lastItem() }} of {{ $mockTests->total() }} mock tests
          </p>
          <div class="ml-auto">
            {{ $mockTests->links() }}
          </div>
        </div>
      @endif
    </div>
  </div>
</div>

