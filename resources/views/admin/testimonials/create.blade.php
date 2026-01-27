<x-admin-layout>
  <!-- Header -->
  <div class="bg-gradient-to-r from-primary to-primary-focus">
    <div class="px-4 md:px-8 py-12">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
          <h1 class="text-4xl font-bold text-white mb-2">Add New Testimonial</h1>
          <p class="text-white/80">Create a new customer testimonial</p>
        </div>
        <div class="mt-6 md:mt-0">
          <a href="{{ route('admin.testimonials') }}" class="btn btn-secondary gap-2">
            <span class="icon-[tabler--arrow-left] size-5"></span>
            Back to List
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex-1 px-4 md:px-8 py-8 overflow-y-auto">
    <div class="max-w-3xl mx-auto">
      <div class="card bg-base-100 shadow-lg">
        <div class="card-body">
          <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <!-- Customer Name -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text font-semibold">Customer Name <span class="text-error">*</span></span>
                </label>
                <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="John Doe" class="input input-bordered @error('customer_name') input-error @enderror" required />
                @error('customer_name')
                  <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                @enderror
              </div>

              <!-- Job Title -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text font-semibold">Job Title <span class="text-error">*</span></span>
                </label>
                <input type="text" name="job_title" value="{{ old('job_title') }}" placeholder="Freelance Writer" class="input input-bordered @error('job_title') input-error @enderror" required />
                @error('job_title')
                  <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                @enderror
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <!-- Email -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text font-semibold">Email</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" class="input input-bordered @error('email') input-error @enderror" />
                @error('email')
                  <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                @enderror
              </div>

              <!-- Phone -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text font-semibold">Phone</span>
                </label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 234 567 8900" class="input input-bordered @error('phone') input-error @enderror" />
                @error('phone')
                  <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                @enderror
              </div>
            </div>

            <!-- Photo Upload -->
            <div class="form-control mb-6">
              <label class="label">
                <span class="label-text font-semibold">Profile Photo</span>
              </label>
              <input type="file" name="photo" accept="image/*" class="file-input file-input-bordered @error('photo') file-input-error @enderror" />
              <label class="label">
                <span class="label-text-alt">Leave empty to use default avatar. Max 2MB.</span>
              </label>
              @error('photo')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
              @enderror
            </div>

            <!-- Stars Rating -->
            <div class="form-control mb-6">
              <label class="label">
                <span class="label-text font-semibold">Rating <span class="text-error">*</span></span>
              </label>
              <select name="stars" class="select select-bordered @error('stars') select-error @enderror" required>
                <option value="">Select rating</option>
                @for($i = 5; $i >= 1; $i--)
                  <option value="{{ $i }}" {{ old('stars') == $i ? 'selected' : '' }}>
                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                  </option>
                @endfor
              </select>
              @error('stars')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
              @enderror
            </div>

            <!-- Feedback -->
            <div class="form-control mb-6">
              <label class="label">
                <span class="label-text font-semibold">Feedback <span class="text-error">*</span></span>
              </label>
              <textarea name="feedback" rows="4" placeholder="Enter customer feedback..." class="textarea textarea-bordered @error('feedback') textarea-error @enderror" required>{{ old('feedback') }}</textarea>
              @error('feedback')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
              @enderror
            </div>

            <!-- Status -->
            <div class="form-control mb-6">
              <label class="label cursor-pointer justify-start gap-4">
                <input type="checkbox" name="is_active" value="1" class="checkbox checkbox-primary" {{ old('is_active', true) ? 'checked' : '' }} />
                <span class="label-text font-semibold">Display on website</span>
              </label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 justify-end">
              <a href="{{ route('admin.testimonials') }}" class="btn btn-ghost">Cancel</a>
              <button type="submit" class="btn btn-primary gap-2">
                <span class="icon-[tabler--check] size-5"></span>
                Create Testimonial
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
