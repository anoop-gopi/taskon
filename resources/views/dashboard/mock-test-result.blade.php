<x-dashboard-layout>
  <section class="bg-primary text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl md:text-4xl font-bold mb-2">Test Completed</h1>
      <p class="text-white/80">{{ $mockTest->title }}</p>
    </div>
  </section>

  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4 max-w-3xl">
      <div class="card bg-base-100 shadow-xl border border-primary/20">
        <div class="card-body items-center text-center">
          <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center mb-4">
            <span class="icon-[tabler--chart-bar] size-10 text-primary"></span>
          </div>

          <h2 class="text-2xl font-bold mb-2">Your Score</h2>
          <p class="text-5xl font-extrabold text-primary mb-2">{{ $attempt->score }} / {{ $attempt->total_questions }}</p>
          <p class="text-base-content/70">
            Percentage: {{ $attempt->total_questions > 0 ? number_format(($attempt->score / $attempt->total_questions) * 100, 2) : '0.00' }}%
          </p>

          <div class="divider"></div>

          <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
            <div class="p-4 rounded-lg bg-success/10 border border-success/30">
              <p class="text-xs uppercase text-base-content/60">Correct Answers</p>
              <p class="text-2xl font-bold text-success">{{ $attempt->score }}</p>
              <p class="text-sm text-base-content/70">+1 score per correct answer</p>
            </div>
            <div class="p-4 rounded-lg bg-error/10 border border-error/30">
              <p class="text-xs uppercase text-base-content/60">Wrong Answers</p>
              <p class="text-2xl font-bold text-error">{{ $attempt->total_questions - $attempt->score }}</p>
              <p class="text-sm text-base-content/70">0 score per wrong answer</p>
            </div>
          </div>

          <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ route('dashboard.mock-tests.show', $mockTest->id) }}" class="btn btn-primary gap-2">
              <span class="icon-[tabler--reload] size-5"></span>
              Retake Test
            </a>
            <a href="{{ route('dashboard.mock-tests') }}" class="btn btn-outline gap-2">
              <span class="icon-[tabler--list] size-5"></span>
              All Mock Tests
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-dashboard-layout>

