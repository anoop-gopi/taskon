<x-dashboard-layout>
  @if(session('success'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-success shadow-lg">
        <span class="icon-[tabler--check] size-5"></span>
        <span>{{ session('success') }}</span>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-error shadow-lg">
        <span class="icon-[tabler--alert-circle] size-5"></span>
        <span>{{ session('error') }}</span>
      </div>
    </div>
  @endif

  <section class="bg-primary text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-2">Mock Tests</h1>
      <p class="text-white/80">Attempt tests and track your score progress</p>
    </div>
  </section>

  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($mockTests as $mockTest)
          @php
            $latest = $latestAttempts->get($mockTest->id);
          @endphp
          <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition">
            <div class="card-body">
              <div class="flex items-start justify-between gap-3">
                <h2 class="card-title text-lg">{{ $mockTest->title }}</h2>
                <div class="badge badge-info gap-1 shrink-0">
                  <span class="icon-[tabler--help-square-rounded] size-3"></span>
                  {{ $mockTest->questions_count }} Q
                </div>
              </div>

              <p class="text-sm text-base-content/70 mt-1">{{ Str::limit($mockTest->description, 110) ?: 'No description provided.' }}</p>

              @if($latest)
                <div class="mt-4 p-3 rounded-lg bg-primary/5 border border-primary/20">
                  <p class="text-xs text-base-content/60 uppercase tracking-wide">Latest Score</p>
                  <p class="text-xl font-bold text-primary mt-1">{{ $latest->score }} / {{ $latest->total_questions }}</p>
                  <p class="text-xs text-base-content/60 mt-1">{{ $latest->completed_at->format('d M Y h:i A') }}</p>
                </div>
              @endif

              <div class="mt-5 flex items-center justify-between gap-2">
                <a href="{{ route('dashboard.mock-tests.show', $mockTest->id) }}" class="btn btn-primary btn-sm gap-2">
                  <span class="icon-[tabler--player-play] size-4"></span>
                  {{ $latest ? 'Retake Test' : 'Start Test' }}
                </a>

                @if($latest)
                  <a href="{{ route('dashboard.mock-tests.result', ['id' => $mockTest->id, 'attemptId' => $latest->id]) }}" class="btn btn-ghost btn-sm gap-1">
                    <span class="icon-[tabler--chart-bar] size-4"></span>
                    Last Result
                  </a>
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-full text-center py-12">
            <span class="icon-[tabler--inbox] size-14 text-base-content/30"></span>
            <p class="text-base-content/60 mt-3">No mock tests are available right now.</p>
          </div>
        @endforelse
      </div>

      <div class="mt-8">
        {{ $mockTests->links() }}
      </div>
    </div>
  </section>
</x-dashboard-layout>
