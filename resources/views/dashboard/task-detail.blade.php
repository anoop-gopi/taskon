@php
$tasks = [
    1 => [
        'id' => 1,
        'title' => 'Write Product Description',
        'earnings' => 25,
        'category' => 'Writing',
        'difficulty' => 'Beginner',
        'time_estimate' => '2-3 hours',
        'description' => 'We need a compelling product description for our new SaaS tool. The description should highlight key features, benefits, and unique value propositions. It should be suitable for both the website landing page and product listing pages.',
        'requirements' => [
            'Write 200-300 word description',
            'Highlight key features (at least 5)',
            'Include benefits for target audience',
            'Use persuasive language',
            'Ensure SEO optimization with relevant keywords',
            'Include call-to-action',
            'Submit in plain text format'
        ],
        'deliverables' => [
            'One well-structured product description',
            'Include metadata suggestions (title, meta description)',
            'Word count: 200-300 words'
        ]
    ],
    2 => [
        'id' => 2,
        'title' => 'Build a React Component',
        'earnings' => 150,
        'category' => 'Development',
        'difficulty' => 'Intermediate',
        'time_estimate' => '8-12 hours',
        'description' => 'Create a reusable React component for data visualization. This component should be flexible, well-documented, and include TypeScript support. The component should work with various data formats and support customization.',
        'requirements' => [
            'Create functional React component with TypeScript',
            'Support responsive design',
            'Include 5+ customizable props',
            'Add comprehensive prop validation',
            'Write unit tests (Jest)',
            'Create detailed documentation',
            'Package as ES6 module',
            'Include usage examples'
        ],
        'deliverables' => [
            'React component source code',
            'TypeScript type definitions',
            'Unit test file',
            'README with documentation',
            'Example usage file'
        ]
    ],
    3 => [
        'id' => 3,
        'title' => 'Design Mobile App UI',
        'earnings' => 200,
        'category' => 'Design',
        'difficulty' => 'Advanced',
        'time_estimate' => '15-20 hours',
        'description' => 'Design professional mockups for a mobile fitness tracking app UI. Include 5 key screens with a cohesive design system, consistent typography, and modern visual style. Deliverables should be in Figma format.',
        'requirements' => [
            'Design 5 key app screens',
            'Create consistent design system (colors, typography, components)',
            'Include interactive elements and states (hover, active, disabled)',
            'Design for iOS and Android (show platform variations)',
            'Create reusable components library',
            'Include dark mode variants',
            'Add micro-interactions specifications'
        ],
        'deliverables' => [
            'Figma file with all screens',
            'Design system documentation',
            'Component library',
            'Dark mode variants',
            'Handoff specs for developers'
        ]
    ],
    4 => [
        'id' => 4,
        'title' => 'Social Media Marketing Post',
        'earnings' => 50,
        'category' => 'Marketing',
        'difficulty' => 'Beginner',
        'time_estimate' => '4-6 hours',
        'description' => 'Create engaging and shareable social media content for Instagram and TikTok. The content should align with our brand voice and be optimized for each platform\'s audience and format.',
        'requirements' => [
            'Create 3 original posts (1 for Instagram feed, 2 for TikTok)',
            'Write engaging captions with relevant hashtags',
            'Include call-to-action in each post',
            'Design graphics using Canva or similar tool',
            'Follow brand guidelines',
            'Optimize for mobile viewing',
            'Include trending sounds/music suggestions for TikTok'
        ],
        'deliverables' => [
            '3 social media posts with graphics',
            'Captions with hashtags',
            'Sound/music recommendations for video',
            'Files in PNG format (1080x1350 for IG, 1080x1920 for TikTok)'
        ]
    ],
    5 => [
        'id' => 5,
        'title' => 'Data Analysis Report',
        'earnings' => 175,
        'category' => 'Analytics',
        'difficulty' => 'Intermediate',
        'time_estimate' => '10-14 hours',
        'description' => 'Analyze our Q3 sales data and create a comprehensive report with visualizations, key insights, and actionable recommendations for the business team.',
        'requirements' => [
            'Clean and validate provided dataset',
            'Create 8-10 relevant visualizations (charts, graphs)',
            'Identify key trends and patterns',
            'Provide statistical analysis',
            'Generate 5+ actionable insights',
            'Include recommendations for next quarter',
            'Format in professional report style'
        ],
        'deliverables' => [
            'Comprehensive data analysis report (8-10 pages)',
            'Data visualizations (charts, graphs, heatmaps)',
            'Excel spreadsheet with calculations',
            'Executive summary (1-2 pages)',
            'Recommendations document'
        ]
    ],
    6 => [
        'id' => 6,
        'title' => 'YouTube Video Editing',
        'earnings' => 120,
        'category' => 'Video Production',
        'difficulty' => 'Intermediate',
        'time_estimate' => '12-16 hours',
        'description' => 'Edit raw footage into a polished YouTube video. The final video should include professional transitions, effects, color grading, and properly timed subtitles for accessibility.',
        'requirements' => [
            'Edit raw footage (15-20 min of footage)',
            'Add smooth transitions between scenes',
            'Include motion graphics and text overlays',
            'Apply color grading for consistency',
            'Add background music and audio effects',
            'Create and sync subtitles (SRT format)',
            'Optimize for YouTube (1080p, 16:9)',
            'Add thumbnail design'
        ],
        'deliverables' => [
            'Final edited video (MP4 format, 1080p)',
            'Subtitle file (SRT format)',
            'YouTube thumbnail (1280x720px)',
            'Project file (editable)',
            'Audio tracks (separately exported)'
        ]
    ]
];

$task = $tasks[$taskId] ?? null;

if (!$task) {
    abort(404);
}
@endphp

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
          <p class="text-white/80 text-sm mb-2 uppercase tracking-wide">{{ $task['category'] }}</p>
          <h1 class="text-4xl md:text-5xl font-bold">{{ $task['title'] }}</h1>
        </div>
        <div class="text-right">
          <p class="text-white/80 text-sm mb-1">You Will Earn</p>
          <p class="text-5xl font-bold">${{ $task['earnings'] }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Task Overview Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-3 gap-8">
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--alert-circle] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Difficulty Level</p>
            <p class="text-2xl font-bold mt-2">{{ $task['difficulty'] }}</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--clock] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Estimated Time</p>
            <p class="text-2xl font-bold mt-2">{{ $task['time_estimate'] }}</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--list-check] size-6 text-primary"></span>
            </div>
            <p class="text-xs text-base-content/60 uppercase tracking-wide font-semibold">Total Items</p>
            <p class="text-2xl font-bold mt-2">{{ count($task['requirements']) }}</p>
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
          <p class="text-base-content/70 leading-relaxed text-lg">{{ $task['description'] }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Requirements Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4 max-w-4xl">
      <h2 class="text-3xl font-bold mb-8">What We Need From You</h2>
      <div class="grid md:grid-cols-2 gap-6">
        @foreach($task['requirements'] as $index => $requirement)
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                <span class="icon-[tabler--check] size-5 text-primary"></span>
              </div>
              <p class="text-base-content/70">{{ $requirement }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Deliverables Section -->
  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4 max-w-4xl">
      <h2 class="text-3xl font-bold mb-8">Deliverables</h2>
      <div class="grid md:grid-cols-2 gap-6">
        @foreach($task['deliverables'] as $deliverable)
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                <span class="icon-[tabler--package] size-5 text-primary"></span>
              </div>
              <p class="text-base-content/70">{{ $deliverable }}</p>
            </div>
          </div>
        </div>
        @endforeach
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
        <a href="{{ route('dashboard.task.complete.form', $taskId) }}" class="btn btn-lg btn-primary gap-2">
          <span class="icon-[tabler--check] size-5"></span>
          Mark Task as Completed
        </a>
      </div>
    </div>
  </section>
</x-dashboard-layout>
