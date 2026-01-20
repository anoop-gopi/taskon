@php
$tasks = [
    1 => [
        'id' => 1,
        'title' => 'Write Product Description',
        'earnings' => 25,
        'category' => 'Writing',
        'difficulty' => 'Beginner',
    ],
    2 => [
        'id' => 2,
        'title' => 'Build a React Component',
        'earnings' => 150,
        'category' => 'Development',
        'difficulty' => 'Intermediate',
    ],
    3 => [
        'id' => 3,
        'title' => 'Design Mobile App UI',
        'earnings' => 200,
        'category' => 'Design',
        'difficulty' => 'Advanced',
    ],
    4 => [
        'id' => 4,
        'title' => 'Social Media Marketing Post',
        'earnings' => 50,
        'category' => 'Marketing',
        'difficulty' => 'Beginner',
    ],
    5 => [
        'id' => 5,
        'title' => 'Data Analysis Report',
        'earnings' => 175,
        'category' => 'Analytics',
        'difficulty' => 'Intermediate',
    ],
    6 => [
        'id' => 6,
        'title' => 'YouTube Video Editing',
        'earnings' => 120,
        'category' => 'Video Production',
        'difficulty' => 'Intermediate',
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
      <a href="{{ route('dashboard.task.show', $taskId) }}" class="inline-flex items-center text-white/80 hover:text-white mb-6 transition">
        <span class="icon-[tabler--arrow-left] size-5 mr-2"></span>
        Back to Task Details
      </a>
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
          <p class="text-white/80 text-sm mb-2 uppercase tracking-wide">Submit Your Work</p>
          <h1 class="text-4xl md:text-5xl font-bold">{{ $task['title'] }}</h1>
        </div>
        <div class="text-right">
          <p class="text-white/80 text-sm mb-1">You Will Earn</p>
          <p class="text-5xl font-bold">${{ $task['earnings'] }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Form Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4 max-w-2xl">
      <div class="card bg-base-100 shadow-lg border border-primary/20">
        <div class="card-body">
          <h2 class="text-2xl font-bold mb-8">Submit Your Work</h2>
          
          <form method="POST" action="{{ route('dashboard.task.complete', $taskId) }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Screenshot Upload -->
            <div class="form-control mb-8">
              <label class="label">
                <span class="label-text font-semibold text-base">Upload Screenshot or File</span>
                <span class="label-text-alt text-error">*</span>
              </label>
              <div class="border-2 border-dashed border-primary/30 rounded-lg p-8 text-center hover:border-primary/60 transition cursor-pointer" onclick="document.getElementById('screenshot_input').click()">
                <input type="file" id="screenshot_input" name="screenshot" accept="image/*,.pdf,.doc,.docx,.zip" class="hidden" required />
                <div class="flex justify-center mb-4">
                  <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                    <span class="icon-[tabler--cloud-upload] size-6 text-primary"></span>
                  </div>
                </div>
                <p class="text-base-content font-semibold mb-1">Click to upload or drag and drop</p>
                <p class="text-sm text-base-content/70">PNG, JPG, PDF, DOC, DOCX, ZIP up to 10MB</p>
              </div>
              <label class="label">
                <span class="label-text-alt text-base-content/70">Supported formats: PNG, JPG, PDF, DOC, DOCX, ZIP</span>
              </label>
            </div>

            <!-- Completion Date/Time -->
            <div class="form-control mb-8">
              <label class="label">
                <span class="label-text font-semibold text-base">Completion Date & Time</span>
                <span class="label-text-alt text-error">*</span>
              </label>
              <input type="datetime-local" name="completion_date" class="input input-bordered w-full" required />
              <label class="label">
                <span class="label-text-alt text-base-content/70">When did you complete this task?</span>
              </label>
            </div>

            <!-- Comments/Notes -->
            <div class="form-control mb-8">
              <label class="label">
                <span class="label-text font-semibold text-base">Comments & Notes (Optional)</span>
              </label>
              <textarea name="comments" class="textarea textarea-bordered w-full" rows="5" placeholder="Share any notes about this task completion, challenges you faced, or any additional information..."></textarea>
              <label class="label">
                <span class="label-text-alt text-base-content/70">This helps us understand your work better and provide feedback</span>
              </label>
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 justify-end pt-6 border-t border-base-300">
              <a href="{{ route('dashboard.task.show', $taskId) }}" class="btn btn-ghost">Cancel</a>
              <button type="submit" class="btn btn-primary gap-2">
                <span class="icon-[tabler--send] size-5"></span>
                Submit Completion
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Help Section -->
      <div class="mt-12 grid md:grid-cols-3 gap-6">
        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--checklist] size-5 text-primary"></span>
            </div>
            <h3 class="card-title text-lg mb-2">Review Requirements</h3>
            <p class="text-base-content/70 text-sm">Make sure you've met all the requirements before submitting</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--file-check] size-5 text-primary"></span>
            </div>
            <h3 class="card-title text-lg mb-2">Quality First</h3>
            <p class="text-base-content/70 text-sm">Submit your best work for faster approval and better ratings</p>
          </div>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
              <span class="icon-[tabler--clock-check] size-5 text-primary"></span>
            </div>
            <h3 class="card-title text-lg mb-2">Timely Submission</h3>
            <p class="text-base-content/70 text-sm">Submit before the deadline to avoid payment reduction</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-dashboard-layout>
