<div>
    @if (session()->has('success'))
        <div class="alert alert-success mb-4">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="space-y-6">
            <!-- Mock Test Title -->
            <div class="form-control">
                <div class="label">
                    <span class="label-text font-semibold">Mock Test Title *</span>
                </div>
                <input
                    type="text"
                    wire:model="title"
                    class="input input-bordered w-full @error('title') input-error @enderror"
                    placeholder="Enter mock test title"
                />
                @error('title')
                    <div class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-control">
                <div class="label">
                    <span class="label-text font-semibold">Description</span>
                </div>
                <textarea
                    wire:model="description"
                    class="textarea textarea-bordered w-full h-32 @error('description') textarea-error @enderror"
                    placeholder="Enter mock test description (optional)"
                ></textarea>
                @error('description')
                    <div class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="alert alert-info">
                <span class="icon-[tabler--info-circle] size-5"></span>
                <span>After creating the test, you will be taken to the test page where you can add questions one by one.</span>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('admin.tasks') }}" class="btn btn-ghost">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="icon-[tabler--arrow-right] size-5"></span>
                    Create &amp; Add Questions
                </button>
            </div>
        </div>
    </form>
</div>

