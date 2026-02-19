<x-dashboard-layout>
  <!-- Hero Section -->
  <section class="bg-primary text-white py-12">
    <div class="container mx-auto px-4">
      <a href="{{ route('dashboard.task.show', $task->id) }}" class="inline-flex items-center text-white/80 hover:text-white mb-6 transition">
        <span class="icon-[tabler--arrow-left] size-5 mr-2"></span>
        Back to Task Details
      </a>
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
          <p class="text-white/80 text-sm mb-2 uppercase tracking-wide">Submit Your Work</p>
          <h1 class="text-4xl md:text-5xl font-bold">{{ $task->name }}</h1>
        </div>
        <div class="text-right">
          <p class="text-white/80 text-sm mb-1">You Will Earn</p>
          <p class="text-5xl font-bold">${{ number_format($task->earning, 2) }}</p>
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
          
          <form method="POST" action="{{ route('dashboard.task.complete', $task->id) }}" enctype="multipart/form-data">
            @csrf
            
            <!-- File Upload -->
            <div class="form-control mb-8">
              <label class="label">
                <span class="label-text font-semibold text-base">Upload Image or File</span>
                <span class="label-text-alt text-error">*</span>
              </label>
              <div class="border-2 border-dashed border-primary/30 rounded-lg p-8 text-center hover:border-primary/60 transition cursor-pointer" onclick="document.getElementById('image_input').click()">
                <input type="file" id="image_input" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="hidden" required onchange="displayFileName(this)" />
                <div class="flex justify-center mb-4">
                  <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                    <span class="icon-[tabler--cloud-upload] size-6 text-primary"></span>
                  </div>
                </div>
                <p class="text-base-content font-semibold mb-1">Click to upload or drag and drop</p>
                <p class="text-sm text-base-content/70">JPG, PNG, GIF, PDF, XLS, XLSX up to 10MB</p>
              </div>
              <div id="file_name_display" class="mt-2 text-sm text-primary font-semibold hidden">
                <span class="icon-[tabler--file] size-4 inline-block"></span>
                <span id="file_name_text"></span>
              </div>
              @error('image')
                <label class="label">
                  <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
              @enderror
              <label class="label">
                <span class="label-text-alt text-base-content/70">Supported formats: JPG, PNG, GIF, PDF, XLS, XLSX</span>
              </label>
            </div>

            <!-- Comments/Notes -->
            <div class="form-control mb-8">
              <label class="label">
                <span class="label-text font-semibold text-base">Comments & Notes (Optional)</span>
              </label>
              <textarea name="notes" class="textarea textarea-bordered w-full" rows="5" placeholder="Share any notes about this task completion, challenges you faced, or any additional information..."></textarea>
              @error('notes')
                <label class="label">
                  <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
              @enderror
              <label class="label">
                <span class="label-text-alt text-base-content/70">This helps us understand your work better and provide feedback</span>
              </label>
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 justify-end pt-6 border-t border-base-300">
              <a href="{{ route('dashboard.task.show', $task->id) }}" class="btn btn-ghost">Cancel</a>
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

  <script>
    function displayFileName(input) {
      const fileNameDisplay = document.getElementById('file_name_display');
      const fileNameText = document.getElementById('file_name_text');
      
      if (input.files && input.files[0]) {
        fileNameText.textContent = input.files[0].name;
        fileNameDisplay.classList.remove('hidden');
      } else {
        fileNameDisplay.classList.add('hidden');
      }
    }
  </script>
</x-dashboard-layout>
