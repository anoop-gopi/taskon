<x-dashboard-layout>
  <!-- Success Message -->
  @if(session('success'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-success shadow-lg">
        <span class="icon-[tabler--check] size-5"></span>
        <span>{{ session('success') }}</span>
      </div>
    </div>
  @endif

  <!-- Hero Section -->
  <section class="bg-primary text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-2">Welcome back, {{ auth()->user()->name ?? 'User' }}!</h1>
      <p class="text-white/80">Browse available tasks and start earning today</p>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--wallet] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Total Earnings</p>
            <p class="text-3xl font-bold mt-2">${{ number_format($totalEarnings, 2) }}</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--check] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Completed Tasks</p>
            <p class="text-3xl font-bold mt-2">{{ $completedTasks }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Available Mock Tests Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-3xl font-bold">Available Mock Tests</h2>
          <p class="text-sm text-base-content/60 mt-1">Each correct answer gives 1 mark. Wrong answers give 0.</p>
        </div>
        <a href="{{ route('dashboard.mock-tests') }}" class="btn btn-outline btn-sm gap-2">
          <span class="icon-[tabler--list] size-4"></span>
          View All Tests
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($mockTests as $mockTest)
          @php
            $latestScore = $latestMockTestScores->get($mockTest->id);
          @endphp
          <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition">
            <div class="card-body">
              <div class="flex items-start justify-between gap-3">
                <h3 class="card-title text-lg">{{ $mockTest->title }}</h3>
                <div class="badge badge-info gap-1 shrink-0">
                  <span class="icon-[tabler--help-square-rounded] size-3"></span>
                  {{ $mockTest->questions_count }}
                </div>
              </div>

              <p class="text-base-content/70 text-sm">{{ Str::limit($mockTest->description, 100) ?: 'No description provided.' }}</p>

              @if($latestScore)
                <div class="mt-3 p-2 rounded-lg bg-primary/5 border border-primary/20 text-sm">
                  <span class="text-base-content/70">Last Score:</span>
                  <span class="font-bold text-primary">{{ $latestScore->score }}/{{ $latestScore->total_questions }}</span>
                </div>
              @endif

              <div class="mt-4">
                <a href="{{ route('dashboard.mock-tests.show', $mockTest->id) }}" class="btn btn-primary btn-sm gap-2">
                  <span class="icon-[tabler--player-play] size-4"></span>
                  {{ $latestScore ? 'Retake Test' : 'Start Test' }}
                </a>
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-full text-center py-10">
            <span class="icon-[tabler--inbox] size-12 text-base-content/30"></span>
            <p class="text-base-content/60 mt-2">No mock tests available yet.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Available Tasks Section -->
  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4">
      <!-- Upgrade Banner for Free Users -->
      @if($userCategory && $userCategory->id == 1)
        <div class="alert alert-warning shadow-lg mb-8">
          <span class="icon-[tabler--crown] size-6"></span>
          <div class="flex-1">
            <h3 class="font-bold">You're on the Free Plan</h3>
            <div class="text-sm">Upgrade to access more tasks and earn up to $24,000/month!</div>
          </div>
          <a href="{{ route('dashboard.upgrade') }}" class="btn btn-sm btn-primary gap-2">
            <span class="icon-[tabler--arrow-up] size-4"></span>
            Upgrade Now
          </a>
        </div>
      @endif

      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-3xl font-bold">Available Tasks</h2>
          @if($userCategory)
            <p class="text-sm text-base-content/60 mt-1">
              Your Plan: <span class="font-semibold">{{ $userCategory->name }}</span>
              ({{ $userCategory->tasks_per_week }} {{ $userCategory->tasks_per_week == 1 ? 'task' : 'tasks' }}/month)
            </p>
          @endif
        </div>
        <div class="flex flex-col md:flex-row gap-2">
          <input type="text" placeholder="Search tasks..." class="input input-bordered input-sm" />
          <select class="select select-bordered select-sm">
            <option>All Categories</option>
            <option>Writing</option>
            <option>Design</option>
            <option>Programming</option>
            <option>Marketing</option>
          </select>
        </div>
      </div>

      <!-- Task Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tasks as $task)
        <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-{{ ['blue', 'purple', 'pink', 'green', 'yellow', 'orange'][($loop->index) % 6] }}-400 to-{{ ['blue', 'purple', 'pink', 'green', 'yellow', 'orange'][($loop->index) % 6] }}-600 flex items-center justify-center">
            <span class="icon-[tabler--checklist] size-16 text-white/50"></span>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">{{ $task->name }}</h3>
            <p class="text-base-content/70 text-sm mb-2">{{ Str::limit($task->description, 100) }}</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-primary/20">
              <div>
                <p class="text-xs text-base-content/60">Earnings</p>
                <p class="text-xl font-bold text-primary">${{ number_format($task->earning, 2) }}</p>
              </div>
              @if($task->completion_status)
                @if($task->completion_status === 'Pending')
                  <span class="badge badge-warning gap-1">
                    <span class="icon-[tabler--clock] size-4"></span>
                    Awaiting Approval
                  </span>
                @elseif($task->completion_status === 'Accepted')
                  <span class="badge badge-success gap-1">
                    <span class="icon-[tabler--check] size-4"></span>
                    Completed
                  </span>
                @elseif($task->completion_status === 'Rejected')
                  <a href="{{ route('dashboard.task.show', $task->id) }}" class="btn btn-sm btn-error">Resubmit</a>
                @endif
              @else
                @if($userCategory && $task->category_id > $userCategory->id)
                  <a href="{{ route('dashboard.upgrade') }}" class="btn btn-sm btn-warning">
                    Upgrade to Start
                  </a>
                @else
                  <a href="{{ route('dashboard.task.show', $task->id) }}" class="btn btn-sm btn-primary">Start Task</a>
                @endif
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
          <p class="text-base-content/60 text-lg">No tasks available at the moment. Check back soon!</p>
        </div>
        @endforelse
      </div>

      <!-- Load More Button -->
      <div class="text-center mt-12">
        <a href="{{ route('dashboard.tasks') }}" class="btn btn-outline btn-lg">View All Tasks</a>
      </div>
    </div>
  </section>
</x-dashboard-layout>
