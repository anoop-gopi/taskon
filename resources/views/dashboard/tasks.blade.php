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
            <p class="text-3xl font-bold mt-2">24</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--wallet] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Total Earned</p>
            <p class="text-3xl font-bold mt-2">$2,450</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--star] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Avg. Rating</p>
            <p class="text-3xl font-bold mt-2">4.8/5</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--percentage] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Approval Rate</p>
            <p class="text-3xl font-bold mt-2">98%</p>
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
        <!-- Task 1 - Approved -->
        <div class="card bg-base-100 shadow-lg border border-base-300 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center relative">
            <span class="icon-[tabler--pencil] size-16 text-white/50"></span>
            <div class="absolute top-3 right-3 badge badge-success gap-1">
              <span class="icon-[tabler--check] size-4"></span>
              Approved
            </div>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Write Product Description</h3>
            <div class="flex items-center gap-2 text-xs text-base-content/60 mb-2">
              <span class="icon-[tabler--calendar] size-4"></span>
              Jan 15, 2026
            </div>
            <p class="text-base-content/70 text-sm mb-2">Write an engaging product description for an e-commerce website.</p>
            <div class="flex gap-2 mb-4">
              <span class="badge badge-outline">Writing</span>
              <span class="badge badge-outline">Beginner</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-base-300">
              <div>
                <p class="text-xs text-base-content/60">You Earned</p>
                <p class="text-xl font-bold text-success">$25</p>
              </div>
              <button class="btn btn-sm btn-ghost">View Details</button>
            </div>
          </div>
        </div>

        <!-- Task 2 - Approved -->
        <div class="card bg-base-100 shadow-lg border border-base-300 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center relative">
            <span class="icon-[tabler--code] size-16 text-white/50"></span>
            <div class="absolute top-3 right-3 badge badge-success gap-1">
              <span class="icon-[tabler--check] size-4"></span>
              Approved
            </div>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Build a React Component</h3>
            <div class="flex items-center gap-2 text-xs text-base-content/60 mb-2">
              <span class="icon-[tabler--calendar] size-4"></span>
              Jan 12, 2026
            </div>
            <p class="text-base-content/70 text-sm mb-2">Create a reusable React component for data visualization with TypeScript.</p>
            <div class="flex gap-2 mb-4">
              <span class="badge badge-outline">Programming</span>
              <span class="badge badge-outline">Intermediate</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-base-300">
              <div>
                <p class="text-xs text-base-content/60">You Earned</p>
                <p class="text-xl font-bold text-success">$150</p>
              </div>
              <button class="btn btn-sm btn-ghost">View Details</button>
            </div>
          </div>
        </div>

        <!-- Task 3 - Pending -->
        <div class="card bg-base-100 shadow-lg border border-base-300 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center relative">
            <span class="icon-[tabler--brush] size-16 text-white/50"></span>
            <div class="absolute top-3 right-3 badge badge-warning gap-1">
              <span class="icon-[tabler--hourglass-mid] size-4"></span>
              Pending
            </div>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Design Mobile App UI</h3>
            <div class="flex items-center gap-2 text-xs text-base-content/60 mb-2">
              <span class="icon-[tabler--calendar] size-4"></span>
              Jan 10, 2026
            </div>
            <p class="text-base-content/70 text-sm mb-2">Design mockups for a mobile app UI including 5 key screens in Figma.</p>
            <div class="flex gap-2 mb-4">
              <span class="badge badge-outline">Design</span>
              <span class="badge badge-outline">Advanced</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-base-300">
              <div>
                <p class="text-xs text-base-content/60">Potential Earnings</p>
                <p class="text-xl font-bold text-warning">$200</p>
              </div>
              <button class="btn btn-sm btn-ghost">View Details</button>
            </div>
          </div>
        </div>

        <!-- Task 4 - Approved -->
        <div class="card bg-base-100 shadow-lg border border-base-300 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center relative">
            <span class="icon-[tabler--volume] size-16 text-white/50"></span>
            <div class="absolute top-3 right-3 badge badge-success gap-1">
              <span class="icon-[tabler--check] size-4"></span>
              Approved
            </div>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Social Media Marketing Post</h3>
            <div class="flex items-center gap-2 text-xs text-base-content/60 mb-2">
              <span class="icon-[tabler--calendar] size-4"></span>
              Jan 8, 2026
            </div>
            <p class="text-base-content/70 text-sm mb-2">Create engaging social media content for Instagram and TikTok with captions.</p>
            <div class="flex gap-2 mb-4">
              <span class="badge badge-outline">Marketing</span>
              <span class="badge badge-outline">Beginner</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-base-300">
              <div>
                <p class="text-xs text-base-content/60">You Earned</p>
                <p class="text-xl font-bold text-success">$50</p>
              </div>
              <button class="btn btn-sm btn-ghost">View Details</button>
            </div>
          </div>
        </div>

        <!-- Task 5 - Approved -->
        <div class="card bg-base-100 shadow-lg border border-base-300 hover:shadow-xl transition overflow-hidden">
          <figure class="h-40 bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center relative">
            <span class="icon-[tabler--analytics] size-16 text-white/50"></span>
            <div class="absolute top-3 right-3 badge badge-success gap-1">
              <span class="icon-[tabler--check] size-4"></span>
              Approved
            </div>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">Data Analysis Report</h3>
            <div class="flex items-center gap-2 text-xs text-base-content/60 mb-2">
              <span class="icon-[tabler--calendar] size-4"></span>
              Jan 5, 2026
            </div>
            <p class="text-base-content/70 text-sm mb-2">Analyze sales data and create comprehensive report with visualizations.</p>
            <div class="flex gap-2 mb-4">
              <span class="badge badge-outline">Analytics</span>
              <span class="badge badge-outline">Intermediate</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-base-300">
              <div>
                <p class="text-xs text-base-content/60">You Earned</p>
                <p class="text-xl font-bold text-success">$175</p>
              </div>
              <button class="btn btn-sm btn-ghost">View Details</button>
            </div>
          </div>
        </div>

        <!-- Task 6 - Rejected -->
        <div class="card bg-base-100 shadow-lg border border-base-300 hover:shadow-xl transition overflow-hidden opacity-75">
          <figure class="h-40 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center relative">
            <span class="icon-[tabler--video] size-16 text-white/50"></span>
            <div class="absolute top-3 right-3 badge badge-error gap-1">
              <span class="icon-[tabler--x] size-4"></span>
              Rejected
            </div>
          </figure>
          <div class="card-body">
            <h3 class="card-title text-lg">YouTube Video Editing</h3>
            <div class="flex items-center gap-2 text-xs text-base-content/60 mb-2">
              <span class="icon-[tabler--calendar] size-4"></span>
              Dec 28, 2025
            </div>
            <p class="text-base-content/70 text-sm mb-2">Edit raw footage into polished YouTube video with transitions and effects.</p>
            <div class="flex gap-2 mb-4">
              <span class="badge badge-outline">Video</span>
              <span class="badge badge-outline">Intermediate</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-base-300">
              <div>
                <p class="text-xs text-base-content/60">Reason</p>
                <p class="text-sm font-semibold text-error">Quality Issues</p>
              </div>
              <button class="btn btn-sm btn-ghost">View Feedback</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-dashboard-layout>
