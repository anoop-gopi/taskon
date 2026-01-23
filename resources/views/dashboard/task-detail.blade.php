<x-dashboard-layout>
  <!-- Hero Section -->
  <section class="bg-primary text-white py-12">
    <div class="container mx-auto px-4">
      <a href="{{ route('dashboard.home') }}" class="inline-flex items-center text-white/80 hover:text-white mb-6 transition">
        <span class="icon-[tabler--arrow-left] size-5 mr-2"></span>
        Back to Dashboard
      </a>
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
          <p class="text-white/80 text-sm mb-2 uppercase tracking-wide">Task Details</p>
          <h1 class="text-4xl md:text-5xl font-bold">{{ $task->name }}</h1>
        </div>
        <div class="text-right">
          <p class="text-white/80 text-sm mb-1">You Will Earn</p>
          <p class="text-5xl font-bold">${{ number_format($task->earning, 2) }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Task Overview Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-2 gap-8">
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--currency-dollar] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Earning Amount</p>
            <p class="text-2xl font-bold mt-2">${{ number_format($task->earning, 2) }}</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--calendar] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Created Date</p>
            <p class="text-2xl font-bold mt-2">{{ $task->created_at->format('M d, Y') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Description Section -->
  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4 max-w-4xl">
      <h2 class="text-3xl font-bold mb-6">Task Description</h2>
      <div class="card bg-base-100 shadow-lg border border-primary/20">
        <div class="card-body">
          <p class="text-base-content/70 leading-relaxed text-lg whitespace-pre-line">{{ $task->description }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Important Notes Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4 max-w-4xl">
      <div class="card bg-warning/5 shadow-lg border border-warning/30">
        <div class="card-body">
          <div class="flex items-start gap-4 mb-6">
            <div class="w-10 h-10 bg-warning/20 rounded-lg flex items-center justify-center flex-shrink-0">
              <span class="icon-[tabler--alert-circle] size-5 text-warning"></span>
            </div>
            <h3 class="text-xl font-bold text-warning">Important Notes</h3>
          </div>
          <ul class="space-y-3">
            <li class="flex gap-3">
              <span class="icon-[tabler--point-filled] size-2 text-warning mt-2 flex-shrink-0"></span>
              <span class="text-base-content/70">Please review all requirements before starting the task</span>
            </li>
            <li class="flex gap-3">
              <span class="icon-[tabler--point-filled] size-2 text-warning mt-2 flex-shrink-0"></span>
              <span class="text-base-content/70">Late submissions may result in lower payment or rejection</span>
            </li>
            <li class="flex gap-3">
              <span class="icon-[tabler--point-filled] size-2 text-warning mt-2 flex-shrink-0"></span>
              <span class="text-base-content/70">Quality and attention to detail are our top priorities</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4 max-w-4xl">
      <div class="text-center">
        <h2 class="text-2xl font-bold mb-4">Ready to Start This Task?</h2>
        <p class="text-base-content/70 mb-8 text-lg">Complete all requirements and submit your work to get paid.</p>
        <a href="{{ route('dashboard.task.complete.form', $task->id) }}" class="btn btn-lg btn-primary gap-2">
          <span class="icon-[tabler--check] size-5"></span>
          Mark Task as Completed
        </a>
      </div>
    </div>
  </section>
</x-dashboard-layout>
