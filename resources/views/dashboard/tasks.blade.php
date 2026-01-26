<x-dashboard-layout>
  <!-- Hero Section -->
  <section class="bg-primary text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-2">My Tasks</h1>
      <p class="text-white/80">View your completed tasks and track your progress</p>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--check-circle] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Total Completed</p>
            <p class="text-3xl font-bold mt-2">{{ $completedTasks->count() }}</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--wallet] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Total Earned</p>
            <p class="text-3xl font-bold mt-2">${{ number_format($completedTasks->where('status', 2)->sum(function($ct) { return $ct->task->earning ?? 0; }), 2) }}</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--star] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Approved</p>
            <p class="text-3xl font-bold mt-2">{{ $completedTasks->where('status', 2)->count() }}</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--percentage] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Approval Rate</p>
            <p class="text-3xl font-bold mt-2">{{ $completedTasks->count() > 0 ? number_format(($completedTasks->where('status', 2)->count() / $completedTasks->count()) * 100, 0) : 0 }}%</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Filters Section -->
  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row gap-4 items-start md:items-center mb-8">
        <h2 class="text-3xl font-bold">Completed Tasks</h2>
        <div class="flex flex-col md:flex-row gap-2 ml-auto w-full md:w-auto">
          <input type="text" placeholder="Search tasks..." class="input input-bordered input-sm flex-1" />
          <select class="select select-bordered select-sm">
            <option selected>All Categories</option>
            <option>Writing</option>
            <option>Design</option>
            <option>Programming</option>
            <option>Marketing</option>
          </select>
          <select class="select select-bordered select-sm">
            <option selected>All Status</option>
            <option>Approved</option>
            <option>Pending</option>
            <option>Rejected</option>
          </select>
        </div>
      </div>

      <!-- Tasks Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($completedTasks as $completedTask)
        @php
          $task = $completedTask->task;
          $statusColors = [
            1 => ['badge' => 'badge-warning', 'text' => 'text-warning', 'icon' => 'icon-[tabler--hourglass-mid]', 'label' => 'Pending'],
            2 => ['badge' => 'badge-success', 'text' => 'text-success', 'icon' => 'icon-[tabler--check]', 'label' => 'Approved'],
            3 => ['badge' => 'badge-error', 'text' => 'text-error', 'icon' => 'icon-[tabler--x]', 'label' => 'Rejected'],
          ];
          $statusConfig = $statusColors[$completedTask->status] ?? $statusColors[1];
          $gradientColors = ['blue', 'purple', 'pink', 'green', 'yellow', 'orange'];
          $colorIndex = $loop->index % count($gradientColors);
          $color = $gradientColors[$colorIndex];
        @endphp
        <div class="card bg-base-100 shadow-lg border border-base-300 hover:shadow-xl transition overflow-hidden {{ $completedTask->status == 3 ? 'opacity-75' : '' }}">
          <figure class="h-40 bg-gradient-to-br from-{{ $color }}-400 to-{{ $color }}-600 flex items-center justify-center relative">
            <span class="icon-[tabler--checklist] size-16 text-white/50"></span>
            <div class="absolute top-3 right-3 badge {{ $statusConfig['badge'] }} gap-1">
              <span class="{{ $statusConfig['icon'] }} size-4"></span>
              {{ $statusConfig['label'] }}
            </div>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">{{ $task->name }}</h3>
            <div class="flex items-center gap-2 text-xs text-base-content/60 mb-2">
              <span class="icon-[tabler--calendar] size-4"></span>
              {{ $completedTask->date_time->format('M d, Y') }}
            </div>
            <p class="text-base-content/70 text-sm mb-2">{{ Str::limit($task->description, 100) }}</p>
            @if($completedTask->notes)
            <div class="mb-4">
              <p class="text-xs text-base-content/60 mb-1">Your Notes:</p>
              <p class="text-sm italic text-base-content/70">{{ Str::limit($completedTask->notes, 80) }}</p>
            </div>
            @endif
            <div class="flex items-center justify-between pt-4 border-t border-base-300">
              <div>
                <p class="text-xs text-base-content/60">{{ $completedTask->status == 2 ? 'You Earned' : ($completedTask->status == 3 ? 'Potential' : 'Pending') }}</p>
                <p class="text-xl font-bold {{ $statusConfig['text'] }}">${{ number_format($task->earning, 2) }}</p>
              </div>
              <a href="{{ route('dashboard.task.show', $task->id) }}" class="btn btn-sm btn-ghost">View Details</a>
            </div>
          </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
          <span class="icon-[tabler--clipboard-off] size-16 text-base-content/30 mx-auto mb-4"></span>
          <p class="text-base-content/60 text-lg">No completed tasks yet. Start completing tasks to see them here!</p>
          <a href="{{ route('dashboard.home') }}" class="btn btn-primary mt-4">Browse Available Tasks</a>
        </div>
        @endforelse
      </div>
    </div>
  </section>
</x-dashboard-layout>
