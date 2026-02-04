<x-public-layout>
  <!-- Hero Section -->
  <section class="hero bg-primary text-white py-20">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-8 items-center">
      <div>
        <h1 class="text-5xl font-bold mb-6">Join the Decentralized Workforce Today</h1>
        <p class="text-lg text-white/90 mb-6">Access thousands of data entry project, and gig opportunities from vetted employers.</p>
        <div class="flex gap-4">
          <button class="btn btn-lg btn-secondary gap-2">
            <span class="icon-[tabler--rocket] size-6"></span>
            Get Started
          </button>
          <button class="btn btn-lg btn-outline border-white hover:bg-white/20">
            Learn More
          </button>
        </div>
      </div>
      <div class="flex justify-center">
        <div class="bg-white/10 rounded-2xl py-2 px-2 backdrop-blur w-[40%] max-w-xl">
          <img src="{{ asset('assets/img/header_img.png') }}" alt="Header image" class="w-full h-auto object-contain" />
        </div>
      </div>
    </div>
  </section>

  <!-- Make Money Section -->
  <section id="earn" class="py-16 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">Why Choose Jobtrackingsys?</h2>
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
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">What Users Say</h2>
        <p class="text-xl text-base-content/70">Join thousands of happy earners</p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        @forelse($testimonials->take(3) as $testimonial)
        <div class="card bg-base-100 shadow-lg">
          <div class="card-body">
            <div class="flex gap-1 mb-4">
              @for($i = 1; $i <= 5; $i++)
                <span class="icon-[tabler--star-filled] size-5 {{ $i <= $testimonial->stars ? 'text-yellow-400' : 'text-gray-300' }}"></span>
              @endfor
            </div>
            <p class="mb-4">"{{ $testimonial->feedback }}"</p>
            <div class="flex items-center gap-3">
              <div class="avatar placeholder">
                @if($testimonial->photo === 'default_profile_pic.jpg')
                  <div class="bg-primary text-white rounded-full w-10">
                    <span>{{ strtoupper(substr($testimonial->customer_name, 0, 2)) }}</span>
                  </div>
                @else
                  <div class="w-10 rounded-full">
                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->customer_name }}" />
                  </div>
                @endif
              </div>
              <div>
                <p class="font-semibold">{{ $testimonial->customer_name }}</p>
                <p class="text-sm text-base-content/60">{{ $testimonial->job_title }}</p>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="card bg-base-100 shadow-lg">
          <div class="card-body">
            <div class="flex gap-1 mb-4">
              <span class="icon-[tabler--star-filled] size-5 text-yellow-400"></span>
              <span class="icon-[tabler--star-filled] size-5 text-yellow-400"></span>
              <span class="icon-[tabler--star-filled] size-5 text-yellow-400"></span>
              <span class="icon-[tabler--star-filled] size-5 text-yellow-400"></span>
              <span class="icon-[tabler--star-filled] size-5 text-yellow-400"></span>
            </div>
            <p class="mb-4">"Flyon has completely changed my life! I was able to make substantial income while working from home in my spare time."</p>
            <div class="flex items-center gap-3">
              <div class="avatar placeholder">
                <div class="bg-primary text-white rounded-full w-10">
                  <span>JD</span>
                </div>
              </div>
              <div>
                <p class="font-semibold">John Doe</p>
                <p class="text-sm text-base-content/60">Freelance Writer</p>
              </div>
            </div>
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
          <div class="bg-gradient-to-br from-primary/10 to-secondary/10 rounded-2xl p-8 flex items-center justify-center min-h-[400px]">
            <div class="text-center">
              <span class="icon-[tabler--shield-check-filled] size-32 text-primary/40 mb-6 block mx-auto"></span>
              <div class="grid grid-cols-2 gap-4 max-w-sm mx-auto">
                <div class="bg-base-100 rounded-lg p-4 shadow-md">
                  <span class="icon-[tabler--users] size-8 text-info mb-2 block"></span>
                  <p class="text-2xl font-bold">15M+</p>
                  <p class="text-xs text-base-content/60">Users</p>
                </div>
                <div class="bg-base-100 rounded-lg p-4 shadow-md">
                  <span class="icon-[tabler--wallet] size-8 text-success mb-2 block"></span>
                  <p class="text-2xl font-bold">$2.8M</p>
                  <p class="text-xs text-base-content/60">Paid Out</p>
                </div>
                <div class="bg-base-100 rounded-lg p-4 shadow-md">
                  <span class="icon-[tabler--certificate] size-8 text-warning mb-2 block"></span>
                  <p class="text-2xl font-bold">2.8M</p>
                  <p class="text-xs text-base-content/60">Payouts</p>
                </div>
                <div class="bg-base-100 rounded-lg p-4 shadow-md">
                  <span class="icon-[tabler--star-filled] size-8 text-yellow-400 mb-2 block"></span>
                  <p class="text-2xl font-bold">4.6/5</p>
                  <p class="text-xs text-base-content/60">Rating</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
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
      <button class="btn btn-lg btn-primary gap-2">
        <span class="icon-[tabler--rocket] size-6"></span>
        Create Free Account
      </button>
    </div>
  </section>
</x-public-layout>
