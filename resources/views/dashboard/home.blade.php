<x-dashboard-layout>
  <!-- Hero Section -->
  <section class="bg-primary text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-2">Welcome back, John!</h1>
      <p class="text-white/80">Browse available tasks and start earning today</p>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--clipboard-check] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Active Tasks</p>
            <p class="text-3xl font-bold mt-2">3</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--wallet] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Total Earnings</p>
            <p class="text-3xl font-bold mt-2">$2,450</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--star] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Rating</p>
            <p class="text-3xl font-bold mt-2">4.8/5</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--check] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Completed</p>
            <p class="text-3xl font-bold mt-2">24</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Available Tasks Section -->
  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold">Available Tasks</h2>
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
        <!-- Task 1 -->
        <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
            <span class="icon-[tabler--pencil] size-16 text-white/50"></span>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Write Product Description</h3>
            <p class="text-base-content/70 text-sm mb-2">Write an engaging product description for an e-commerce website. 500-700 words required.</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-primary/20">
              <div>
                <p class="text-xs text-base-content/60">Earnings</p>
                <p class="text-xl font-bold text-primary">$25</p>
              </div>
              <a href="{{ route('dashboard.task.show', 1) }}" class="btn btn-sm btn-primary">Start Task</a>
            </div>
          </div>
        </div>

        <!-- Task 2 -->
        <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
            <span class="icon-[tabler--code] size-16 text-white/50"></span>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Build a React Component</h3>
            <p class="text-base-content/70 text-sm mb-2">Create a reusable React component for data visualization. Must include TypeScript.</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-primary/20">
              <div>
                <p class="text-xs text-base-content/60">Earnings</p>
                <p class="text-xl font-bold text-primary">$150</p>
              </div>
              <a href="{{ route('dashboard.task.show', 2) }}" class="btn btn-sm btn-primary">Start Task</a>
            </div>
          </div>
        </div>

        <!-- Task 3 -->
        <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center">
            <span class="icon-[tabler--brush] size-16 text-white/50"></span>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Design Mobile App UI</h3>
            <p class="text-base-content/70 text-sm mb-2">Design mockups for a mobile app UI including 5 key screens. Figma files required.</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-primary/20">
              <div>
                <p class="text-xs text-base-content/60">Earnings</p>
                <p class="text-xl font-bold text-primary">$200</p>
              </div>
              <a href="{{ route('dashboard.task.show', 3) }}" class="btn btn-sm btn-primary">Start Task</a>
            </div>
          </div>
        </div>

        <!-- Task 4 -->
        <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
            <span class="icon-[tabler--volume] size-16 text-white/50"></span>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Social Media Marketing Post</h3>
            <p class="text-base-content/70 text-sm mb-2">Create engaging social media content for Instagram and TikTok. 3 posts with captions.</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-primary/20">
              <div>
                <p class="text-xs text-base-content/60">Earnings</p>
                <p class="text-xl font-bold text-primary">$50</p>
              </div>
              <a href="{{ route('dashboard.task.show', 4) }}" class="btn btn-sm btn-primary">Start Task</a>
            </div>
          </div>
        </div>

        <!-- Task 5 -->
        <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
            <span class="icon-[tabler--analytics] size-16 text-white/50"></span>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Data Analysis Report</h3>
            <p class="text-base-content/70 text-sm mb-2">Analyze sales data and create comprehensive report with visualizations and insights.</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-primary/20">
              <div>
                <p class="text-xs text-base-content/60">Earnings</p>
                <p class="text-xl font-bold text-primary">$175</p>
              </div>
              <a href="{{ route('dashboard.task.show', 5) }}" class="btn btn-sm btn-primary">Start Task</a>
            </div>
          </div>
        </div>

        <!-- Task 6 -->
        <div class="card bg-base-100 shadow-lg border border-primary/20 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
            <span class="icon-[tabler--video] size-16 text-white/50"></span>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">YouTube Video Editing</h3>
            <p class="text-base-content/70 text-sm mb-2">Edit raw footage into polished YouTube video with transitions, effects, and subtitles.</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-primary/20">
              <div>
                <p class="text-xs text-base-content/60">Earnings</p>
                <p class="text-xl font-bold text-primary">$120</p>
              </div>
              <a href="{{ route('dashboard.task.show', 6) }}" class="btn btn-sm btn-primary">Start Task</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Load More Button -->
      <div class="text-center mt-12">
        <button class="btn btn-outline btn-lg">Load More Tasks</button>
      </div>
    </div>
  </section>
</x-dashboard-layout>
