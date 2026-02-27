<x-public-layout>
  <!-- Hero Section -->
  <section class="hero bg-primary text-white">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-8 items-center">
      <div>
        <h1 class="text-5xl font-bold mb-6">Join the Decentralized Workforce Today</h1>
        <p class="text-lg text-white/90 mb-6">Access thousands of data entry project, and gig opportunities from vetted employers.</p>
        <div class="flex gap-4">
          <button type="button" class="btn btn-lg btn-primary gap-2 border-2 border-white" onclick="openAuthModal(event)">
            <span class="icon-[tabler--rocket] size-6"></span>
            Get Started
          </button>
          <a href="{{ route('public.how-it-works') }}" class="btn btn-lg btn-primary gap-2 border-2 border-white">
            <span class="icon-[tabler--book] size-6"></span>
            Learn More
          </a>
        </div>
      </div>
      <div class="flex justify-center">
        <div class="w-full max-w-2xl">
          <img src="{{ asset('assets/img/header_img.png') }}" alt="Header image" class="w-full h-auto object-contain" />
        </div>
      </div>
    </div>
  </section>

  <!-- Make Money Section -->
  <section id="earn" class="py-16 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">Why Choose Us?</h2>
        <p class="text-xl text-base-content/70">Start earning with the most trusted platform for flexible work</p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <!-- Flexible Work -->
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--clock] size-8 text-primary"></span>
            </div>
            <h3 class="card-title">Flexible Work</h3>
            <p class="text-base-content/70">Work whenever you want, wherever you want. No fixed hours or schedules.</p>
          </div>
        </div>

        <!-- Quick Payments -->
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--wallet] size-8 text-primary"></span>
            </div>
            <h3 class="card-title">Quick Payments</h3>
            <p class="text-base-content/70">Get paid fast! Withdraw your earnings weekly or whenever you reach the minimum.</p>
          </div>
        </div>

        <!-- No Experience Needed -->
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--sparkles] size-8 text-primary"></span>
            </div>
            <h3 class="card-title">Easy to Start</h3>
            <p class="text-base-content/70">No special skills required. Start making money in minutes with simple tasks.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Image Slider Section -->
  <section class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">Browse Available Tasks</h2>
        <p class="text-xl text-base-content/70">Choose from thousands of tasks across different categories</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Task Category Cards -->
        <div class="card bg-base-100 image-full shadow-lg hover:shadow-xl transition">
          <div class="bg-gradient-to-br from-blue-400 to-blue-600"></div>
          <div class="card-body justify-end">
            <span class="icon-[tabler--pencil] size-8 text-white mb-2"></span>
            <h2 class="card-title text-white">Writing</h2>
            <p class="text-white/90">Write articles, blogs, and content</p>
          </div>
        </div>

        <div class="card bg-base-100 image-full shadow-lg hover:shadow-xl transition">
          <div class="bg-gradient-to-br from-purple-400 to-purple-600"></div>
          <div class="card-body justify-end">
            <span class="icon-[tabler--code] size-8 text-white mb-2"></span>
            <h2 class="card-title text-white">Programming</h2>
            <p class="text-white/90">Develop software and web apps</p>
          </div>
        </div>

        <div class="card bg-base-100 image-full shadow-lg hover:shadow-xl transition">
          <div class="bg-gradient-to-br from-pink-400 to-pink-600"></div>
          <div class="card-body justify-end">
            <span class="icon-[tabler--brush] size-8 text-white mb-2"></span>
            <h2 class="card-title text-white">Design</h2>
            <p class="text-white/90">Create graphics and visuals</p>
          </div>
        </div>

        <div class="card bg-base-100 image-full shadow-lg hover:shadow-xl transition">
          <div class="bg-gradient-to-br from-green-400 to-green-600"></div>
          <div class="card-body justify-end">
            <span class="icon-[tabler--volume] size-8 text-white mb-2"></span>
            <h2 class="card-title text-white">Marketing</h2>
            <p class="text-white/90">Promote and market products</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Video Section -->
  <section class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
      @php
        $bannerVideo = \App\Models\Video::where('is_active', true)->orderBy('display_order')->first();
      @endphp

      <div class="grid md:grid-cols-2 gap-10 items-center">
        @if($bannerVideo)
          <div class="bg-black/10 rounded-lg overflow-hidden shadow-lg" style="height: 360px;">
            <iframe
              src="{{ $bannerVideo->embed_url }}"
              width="100%"
              height="100%"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        @endif

        <div>
          <h2 class="text-4xl font-bold mb-4">Video Tutorials</h2>
          <p class="text-xl text-base-content/70">Explore our comprehensive video tutorials designed to help you get started quickly and confidently. Each tutorial provides step-by-step guidance to walk you through key features and essential workflows. You’ll learn practical tips and best practices to maximize efficiency and productivity.</p>
          <br> <p class="text-xl text-base-content/70">Our videos are suitable for both beginners and advanced users looking to refine their skills. Discover real-world success stories and see how others have achieved outstanding results using our platform. Stay updated with new features and enhancements through regularly added content.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Steps to Earn Section -->
  <section id="how-it-works" class="py-16 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">How It Works</h2>
        <p class="text-xl text-base-content/70">Get started in 4 simple steps</p>
      </div>

      <div class="max-w-4xl mx-auto">
        <div class="space-y-8">
          <!-- Step 1 -->
          <div class="flex gap-6">
            <div class="flex flex-col items-center">
              <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold">1</div>
              <div class="w-1 h-16 bg-primary/20"></div>
            </div>
            <div class="pb-8">
              <h3 class="text-2xl font-bold mb-2">Create Your Account</h3>
              <p class="text-base-content/70">Sign up with your email and complete your profile. It takes less than 5 minutes.</p>
            </div>
          </div>

          <!-- Step 2 -->
          <div class="flex gap-6">
            <div class="flex flex-col items-center">
              <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold">2</div>
              <div class="w-1 h-16 bg-primary/20"></div>
            </div>
            <div class="pb-8">
              <h3 class="text-2xl font-bold mb-2">Browse Available Tasks</h3>
              <p class="text-base-content/70">Explore thousands of tasks from employers worldwide. Choose what interests you.</p>
            </div>
          </div>

          <!-- Step 3 -->
          <div class="flex gap-6">
            <div class="flex flex-col items-center">
              <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold">3</div>
              <div class="w-1 h-16 bg-primary/20"></div>
            </div>
            <div class="pb-8">
              <h3 class="text-2xl font-bold mb-2">Complete Tasks</h3>
              <p class="text-base-content/70">Work at your own pace and submit your completed work for review.</p>
            </div>
          </div>

          <!-- Step 4 -->
          <div class="flex gap-6">
            <div class="flex flex-col items-center">
              <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold">4</div>
            </div>
            <div>
              <h3 class="text-2xl font-bold mb-2">Get Paid</h3>
              <p class="text-base-content/70">Once approved, your earnings are credited. Withdraw anytime to your preferred method.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="learn" class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
      @php
        $bannerVideo = $bannerVideo ?? \App\Models\Video::where('is_active', true)->orderBy('display_order')->first();
        $videoTestimonials = \App\Models\Video::where('is_active', true)
          ->when($bannerVideo, function ($query) use ($bannerVideo) {
            $query->where('id', '!=', $bannerVideo->id);
          })
          ->orderBy('display_order', 'desc')
          ->limit(2)
          ->get();
      @endphp

      <div class="grid md:grid-cols-4 gap-8">
        <div class="md:col-span-2 flex flex-col justify-center items-center text-center h-full">
          <h2 class="text-4xl font-bold mb-4">What Users Say</h2>
          <p class="text-xl text-base-content/70">Join thousands of happy earners</p>
        </div>

        @forelse($videoTestimonials as $video)
        <div class="card bg-base-100 shadow-lg overflow-hidden md:col-span-1">
          <div class="bg-black/10 flex items-center justify-center" style="height: 350px;">
            <iframe
              src="{{ $video->embed_url }}"
              width="100%"
              height="100%"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
        @empty
        <div class="card bg-base-100 shadow-lg md:col-span-2">
          <div class="card-body text-center">
            <p class="text-base-content/70">Video testimonials will be available soon. Check back later!</p>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Is It Legit Section -->
  <section class="py-16 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
        <!-- Left Column - Content -->
        <div>
          <h2 class="text-4xl font-bold mb-6">Is it legit to earn crypto rewards online?</h2>
          <p class="text-lg text-base-content/70 mb-8">Yes, earning crypto assets online is real when you use a trusted platform. Many people assume free crypto offers are scams or require hidden investments, but that is not always true.</p>
          <p class="text-lg text-base-content/70 mb-8">JumpTask works with verified partners, including global advertisers, app developers, and data providers. These companies pay for real user actions, and you earn rewards for your time and attention. It is a simple value exchange that benefits everyone involved.</p>
          <p class="text-lg text-base-content/70 mb-8">Millions of users have already earned assets through microtasks. Payouts are sent directly to your wallet. There are no tricks, no locked assets, and no barriers. Join a growing community that trusts JumpTask for fair and transparent rewards.</p>
          
          <div class="space-y-4">







          </div>
        </div>

        <!-- Right Column - Image -->
        <div class="relative">
          @php
            //$userCount = \App\Models\User::where('is_admin', false)->count();
            //$paidOutTotal = \App\Models\UserEarning::sum('earning');
            $tasksCompletedCount = \App\Models\TaskCompleted::count();
          @endphp
          <div class="bg-gradient-to-br from-primary/10 to-secondary/10 rounded-2xl p-8 flex items-center justify-center min-h-[400px]">
            <div class="text-center">
              <span class="icon-[tabler--shield-check-filled] size-32 text-primary/40 mb-6 block mx-auto"></span>
              <div class="grid grid-cols-2 gap-4 max-w-sm mx-auto">
                <div class="bg-base-100 rounded-lg p-4 shadow-md">
                  <span class="icon-[tabler--users] size-8 text-info mb-2 block"></span>
                  <p class="text-2xl font-bold">50K+</p>
                  <p class="text-xs text-base-content/60">Users</p>
                </div>
                <div class="bg-base-100 rounded-lg p-4 shadow-md">
                  <span class="icon-[tabler--wallet] size-8 text-success mb-2 block"></span>
                  <p class="text-2xl font-bold">$5M+</p>
                  <p class="text-xs text-base-content/60">Paid Out</p>
                </div>
                <div class="bg-base-100 rounded-lg p-4 shadow-md">
                  <span class="icon-[tabler--certificate] size-8 text-warning mb-2 block"></span>
                  <p class="text-2xl font-bold">100K+</p>
                  <p class="text-xs text-base-content/60">Tasks</p>
                </div>
                <div class="bg-base-100 rounded-lg p-4 shadow-md">
                  <span class="icon-[tabler--star-filled] size-8 text-yellow-400 mb-2 block"></span>
                  <p class="text-2xl font-bold">24/7</p>
                  <p class="text-xs text-base-content/60">Support</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  @php
    //$statsUserCount = \App\Models\User::where('is_admin', false)->count();
    //$statsPaidOutTotal = \App\Models\UserEarning::sum('earning');
    //$statsTasksCompleted = \App\Models\TaskCompleted::count();
  @endphp
  <section class="py-16 bg-primary text-white">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-4 gap-8 text-center">
        <div>
          <h3 class="text-5xl font-bold mb-2 text-white">50K+</h3>
          <p class="text-lg text-white/90">Active Users</p>
        </div>
        <div>
          <h3 class="text-5xl font-bold mb-2 text-white">100K+</h3>
          <p class="text-lg text-white/90">Tasks Completed</p>
        </div>
        <div>
          <h3 class="text-5xl font-bold mb-2 text-white">$5M+</h3>
          <p class="text-lg text-white/90">Paid Out</p>
        </div>
        <div>
          <h3 class="text-5xl font-bold mb-2 text-white">24/7</h3>
          <p class="text-lg text-white/90">Support</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-20 bg-base-100">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-4xl font-bold mb-6">Ready to Start Earning?</h2>
      <p class="text-xl text-base-content/70 mb-8 max-w-2xl mx-auto">Join thousands of people making money online. Sign up today and get access to exclusive tasks.</p>
      <button type="button" class="btn btn-lg btn-primary gap-2" onclick="openAuthModal(event)">
        <span class="icon-[tabler--rocket] size-6"></span>
        Create Free Account
      </button>
    </div>
  </section>
</x-public-layout>
