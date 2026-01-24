<x-dashboard-layout>
  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-primary to-primary-focus text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Upgrade Your Account</h1>
        <p class="text-white/80 text-lg">Unlock more tasks and higher earnings with our premium plans</p>
      </div>
    </div>
  </section>

  <!-- Current Plan -->
  <section class="py-8 bg-base-200">
    <div class="container mx-auto px-4">
      <div class="max-w-2xl mx-auto">
        <div class="alert alert-info">
          <span class="icon-[tabler--info-circle] size-6"></span>
          <div>
            <h3 class="font-bold">Current Plan: {{ $currentCategory->name }}</h3>
            <div class="text-sm">
              {{ $currentCategory->tasks_per_week }} {{ $currentCategory->tasks_per_week == 1 ? 'task' : 'tasks' }} per week
              @if($currentCategory->earning_per_task > 0)
                • ${{ number_format($currentCategory->earning_per_task, 0) }} per task
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pricing Plans -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        @foreach($categories as $category)
        <div class="card bg-base-100 shadow-xl border-2 {{ $currentCategory->id == $category->id ? 'border-primary' : 'border-base-300' }} hover:shadow-2xl transition">
          <div class="card-body">
            <!-- Plan Header -->
            <div class="text-center mb-6">
              @if($category->name == 'Basic')
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span class="icon-[tabler--star] size-8 text-blue-500"></span>
                </div>
              @elseif($category->name == 'Pro')
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span class="icon-[tabler--stars] size-8 text-purple-500"></span>
                </div>
              @else
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span class="icon-[tabler--crown] size-8 text-orange-500"></span>
                </div>
              @endif
              
              <h2 class="text-2xl font-bold mb-2">{{ $category->name }}</h2>
              <div class="text-4xl font-bold text-primary mb-2">
                ${{ number_format($category->price, 0) }}
                <span class="text-base font-normal text-base-content/60">/month</span>
              </div>
            </div>

            <!-- Features -->
            <div class="space-y-3 mb-6">
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span><strong>{{ $category->tasks_per_week }}</strong> tasks per week</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span><strong>${{ number_format($category->earning_per_task, 0) }}</strong> per task</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span>Potential: <strong>${{ number_format($category->tasks_per_week * $category->earning_per_task * 4, 0) }}/month</strong></span>
              </div>
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span>Priority support</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span>Access to premium tasks</span>
              </div>
            </div>

            <!-- CTA Button -->
            @if($currentCategory->id == $category->id)
              <button class="btn btn-outline btn-disabled w-full" disabled>
                Current Plan
              </button>
            @elseif($currentCategory->id > $category->id)
              <button class="btn btn-ghost w-full" disabled>
                Lower Tier
              </button>
            @else
              <form action="{{ route('dashboard.upgrade.process', $category->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary w-full gap-2" onclick="return confirm('Upgrade to {{ $category->name }} plan for ${{ number_format($category->price, 0) }}/month?')">
                  <span class="icon-[tabler--arrow-up] size-5"></span>
                  Upgrade Now
                </button>
              </form>
            @endif
          </div>
        </div>
        @endforeach
      </div>

      <!-- Benefits Section -->
      <div class="max-w-4xl mx-auto mt-16">
        <h2 class="text-3xl font-bold text-center mb-8">Why Upgrade?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="card bg-base-200">
            <div class="card-body items-center text-center">
              <span class="icon-[tabler--trending-up] size-12 text-primary mb-4"></span>
              <h3 class="card-title text-lg">Higher Earnings</h3>
              <p class="text-base-content/70">Earn significantly more per task with premium plans</p>
            </div>
          </div>
          <div class="card bg-base-200">
            <div class="card-body items-center text-center">
              <span class="icon-[tabler--calendar-check] size-12 text-primary mb-4"></span>
              <h3 class="card-title text-lg">More Tasks</h3>
              <p class="text-base-content/70">Complete more tasks per week to maximize income</p>
            </div>
          </div>
          <div class="card bg-base-200">
            <div class="card-body items-center text-center">
              <span class="icon-[tabler--lock-open] size-12 text-primary mb-4"></span>
              <h3 class="card-title text-lg">Exclusive Access</h3>
              <p class="text-base-content/70">Get access to premium tasks not available to free users</p>
            </div>
          </div>
        </div>
      </div>

      <!-- ROI Calculator -->
      <div class="max-w-4xl mx-auto mt-16 card bg-gradient-to-br from-primary/10 to-secondary/10 shadow-xl">
        <div class="card-body">
          <h2 class="card-title text-2xl mb-6">Return on Investment</h2>
          <div class="overflow-x-auto">
            <table class="table">
              <thead>
                <tr>
                  <th>Plan</th>
                  <th>Monthly Cost</th>
                  <th>Potential Earnings</th>
                  <th>Net Profit</th>
                  <th>ROI</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td class="font-semibold">{{ $category->name }}</td>
                  <td>${{ number_format($category->price, 0) }}</td>
                  <td class="text-success font-semibold">${{ number_format($category->tasks_per_week * $category->earning_per_task * 4, 0) }}</td>
                  <td class="text-primary font-bold">${{ number_format(($category->tasks_per_week * $category->earning_per_task * 4) - $category->price, 0) }}</td>
                  <td class="font-bold">{{ number_format(((($category->tasks_per_week * $category->earning_per_task * 4) - $category->price) / $category->price) * 100, 0) }}%</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <p class="text-sm text-base-content/60 mt-4">
            * Based on completing all available tasks per week for 4 weeks
          </p>
        </div>
      </div>
    </div>
  </section>
</x-dashboard-layout>
